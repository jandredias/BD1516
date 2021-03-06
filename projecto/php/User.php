<?php defined('_BD1516') or die;

class User {
  private $userid       = NULL;
  private $email        = NULL;
  private $nome         = NULL;
  private $questao1     = NULL;
  private $resposta1    = NULL;
  private $questao2     = NULL;
  private $resposta2    = NULL;
  private $pais         = NULL;
  private $categoria    = NULL;

  private $tiposRegisto = NULL;

  public function __construct($email){
    global $connection;
    $query = $connection->prepare(
      "SELECT userid, email, nome, password, questao1, resposta1,
              questao2, resposta2, pais, categoria
       FROM utilizador
       WHERE email=:email");

    $query->bindParam(":email", $email);

    $query->execute();

    if($query->rowCount() != 1){
      throw new Exception("Dados inválidos");
    }
    $array = $query->fetch();

    $this->userid = $array["userid"];
    $this->email = $array["email"];
    $this->nome = $array["nome"];
    $this->questao1 = $array["questao1"];
    $this->resposta1 = $array["resposta1"];
    $this->questao2 = $array["questao2"];
    $this->resposta2 = $array["resposta2"];
    $this->pais = $array["pais"];
    $this->categoria = $array["categoria"];

    $query = $connection->prepare(
      "SELECT typecnt
      FROM tipo_registo
      WHERE userid=:userid AND
      ativo=1;");
    $query->execute(array(':userid' => $this->userid));
    foreach($query->fetchAll() as $row)
      $this->tiposRegisto[] = new TipoRegisto($this->userid, $row[0]);
  }

  public function reloadTipos(){
    global $connection;
    $this->tiposRegisto = array();
    $query = $connection->prepare(
      "SELECT typecnt
      FROM tipo_registo
      WHERE userid=:userid AND
      ativo=1;");
    $query->execute(array(':userid' => $this->userid));
    foreach($query->fetchAll() as $row)
      $this->tiposRegisto[] = new TipoRegisto($this->userid, $row[0]);
  }
  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }
  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
  }
  public function adicionaPagina($nome){
    global $connection;
    $connection->begintransaction();

    $query = $connection->prepare(
      "SELECT COUNT(*)
       FROM pagina
       WHERE userid=:userid AND
             nome=:nome");
    $query->execute(array(':userid' => $this->userid, ":nome" => $nome));
    $result = $query->fetch();
    $result = $result[0];
    if($result == 0){//Temos de inserir uma pagima nova
      $userid = $this->userid;
      $email = $this->email;
      $seqid = $this->sequencia();

      $query = $connection->prepare(
        "SELECT pagecounter + 1 AS pg
         FROM(
           SELECT userid, pagecounter, nome, idseq, ativa
           FROM pagina
           WHERE pagecounter >= ALL(
             SELECT pagecounter FROM pagina)) naoserverparanadaestealias;");
      $query->execute();
      $page_counter= $query->fetch()[0];
      $query = $connection->prepare(
      "INSERT INTO pagina(userid,pagecounter,nome,idseq,ativa)
      VALUES (:userid, :page_counter, :nome, :seqid, 1);");

      $query->execute(array(':userid' => $userid,
                            ':page_counter' => $page_counter,
                            ':nome' => $nome,
                            ':seqid' => $seqid));
      //OLD END
    }else{
      $query = $connection->prepare(
        "UPDATE pagina
         SET ativa=1
         WHERE userid=:userid AND
               nome=:nome AND
               ppagecounter IS NULL;");
      $query->execute(array(':userid' => $this->userid, ":nome" => $nome));
    }
    $connection->commit();
  }
  public function removePagina($page){
    global $connection;
    $userid = $this->userid;
    $email = $this->email;
    $pid = $page;
    $date=(date('Y-m-d H:i:s'));
    /* BEGIN TRANSACTION */
    $connection->begintransaction();
    /*$query = $connection->prepare(
      "INSERT INTO sequencia(userid,moment)
       VALUES (:userid,:date);");
    $query->execute(array(':userid' => $userid, ':date' => $date));
    */
    $query = $connection->prepare(
      "UPDATE pagina
       SET ativa=0
       WHERE userid=:userid
       AND pagecounter=:pagecounter;");
    $query->execute(array(':userid' => $userid,':pagecounter' => $pid));

    $connection->commit();
    /* END TRANSACTION */
  }
  public function removeTipoRegisto($tid){
    global $connection;
    $userid = $this->userid;
    $date=(date('Y-m-d H:i:s'));
    /* BEGIN TRANSACTION */
    $connection->begintransaction();
    /*$query = $connection->prepare(
      "INSERT INTO sequencia(userid,moment)
       VALUES (:userid,:date);");
    $query->execute(array(':userid' => $userid, ':date' => $date));
    */
    $query = $connection->prepare(
      "UPDATE tipo_registo
       SET ativo=0
       WHERE userid=:userid
       AND typecnt=:typecnt;");
    $query->execute(array(':userid' => $userid,':typecnt' => $tid));

    $connection->commit();
    /* END TRANSACTION */
  }
  public function adicionaTipoRegisto($nome){
    global $connection;
    $connection->begintransaction();
    $query = $connection->prepare(
      "SELECT COUNT(*)
       FROM tipo_registo
       WHERE userid=:userid AND
             nome=:nome");
    $query->execute(array(':userid' => $this->userid, ":nome" => $nome));
    $result = $query->fetch();
    $result = $result[0];
    if($result == 0){//Temos de inserir um registo novo
      $seqid = $this->sequencia();
      $query = $connection->prepare(
        "SELECT typecnt + 1 AS pg
         FROM(
           SELECT typecnt
           FROM tipo_registo
           WHERE typecnt >= ALL(
             SELECT typecnt FROM tipo_registo)) nop;");

      $query->execute();
      $type_counter = $query->fetch()[0];

      $query = $connection->prepare(
      "INSERT INTO tipo_registo(userid,typecnt,nome,ativo,idseq)
      VALUES (:userid, :typecnt, :nome, 1, :idseq);");
      $query->execute(array(':userid' => $this->userid,
                            ':typecnt' => $type_counter,
                            ':nome' => $nome,
                            ':idseq' => $seqid));
    }else{
      $query = $connection->prepare(
        "UPDATE tipo_registo
         SET ativo=1
         WHERE userid=:userid AND
               nome=:nome AND
               ptypecnt IS NULL;");
      $query->execute(array(':userid' => $this->userid,
                            ':nome' => $nome));
    }
    $connection->commit();
  }
  public function adicionaRegistoAPagina($typeid,
                                         $nomeRegisto,
                                         $pageId){
      global $connection;
      $connection->begintransaction();
      $seqid = $this->sequencia();

      /* Get Numero de Registo */
      $query = $connection->prepare(
       "SELECT regcounter
        FROM registo
        WHERE userid=:userid
                AND typecounter=:typeid
                AND ativo=1
                AND nome=:nome;");

      $query->execute(array(
        ':userid' => $this->userid,
        ':typeid' => $typeid,
        ':nome' => $nomeRegisto));

      $result = $query->fetch();
      $nrRegisto = $result[0];

      /* get idregpag */
      $query = $connection->prepare(
        "SELECT idregpag + 1 AS pg
         FROM(
           SELECT userid, idregpag
           FROM reg_pag
           WHERE idregpag >= ALL(
             SELECT idregpag FROM reg_pag)) nope;");
      $query->execute();
      $idregpag = $query->fetch()[0];

      $query = $connection->prepare(

      "INSERT INTO reg_pag
         (userid,typeid,regid,pageid,idseq,ativa,idregpag)
      VALUES
         (:userid, :typecnt, :regcounter, :pageid,
          :idseq, 1, :idregpag);");
      $query->execute(array(':userid'     => $this->userid,
                            ':typecnt'    => $typeid,
                            ':regcounter' => $nrRegisto,
                            ':pageid'     => $pageId,
                            ':idregpag'   => $idregpag,
                            ':idseq'      => $seqid));
      $connection->commit();

  }
  public function adicionaRegisto($nome, $typeid){
    global $connection;
    $connection->begintransaction();
    $query = $connection->prepare(
      "SELECT COUNT(*)
       FROM registo
       WHERE userid=:userid AND
             typecounter=:typeid AND
             nome=:nome");
    $query->execute(array(':userid' => $this->userid,
                          ':typeid' => $typeid,
                          ':nome' => $nome));
    $result = $query->fetch();
    $result = $result[0];
    if($result == 0){//Temos de inserir um registo novo

    /*regcounter */
    $query = $connection->prepare(
      "SELECT regcounter + 1 AS pg
       FROM(
         SELECT regcounter
         FROM registo
         WHERE regcounter >= ALL(
           SELECT regcounter FROM registo)) nop;");

    $query->execute();
    $regcounter = $query->fetch()[0];
    $seqid = $this->sequencia();

    /* the real insert */
    $query = $connection->prepare(
    "INSERT INTO registo
       (userid,typecounter,regcounter,nome,ativo,idseq)
       VALUES
       (:userid, :typecnt, :regcounter, :nome, 1, :idseq);");
    $query->execute(array(':userid' => $this->userid,
                          ':typecnt' => $typeid,
                          ':regcounter' => $regcounter,
                          ':nome' => $nome,
                          ':idseq' => $seqid));



    }else{
      $query = $connection->prepare(
        "UPDATE registo
         SET ativo=1
         WHERE userid=:userid      AND
               typecounter=:typeid AND
               nome=:nome          AND
               pregcounter IS NULL;");
      $query->execute(array(':userid' => $this->userid,
                            ':typeid' => $typeid,
                            ':nome' => $nome));
    }
    $connection->commit();
  }
  public function adicionaValor($campo,
                                $tipoRegisto,
                                $nome,
                                $valor){
    global $connection;
    $connection->begintransaction();
    $seqid = $this->sequencia();

    $query = $connection->prepare(
     "SELECT regcounter
      FROM registo
      WHERE userid=:userid
      AND typecounter=:typeid
      AND ativo=1
      AND nome=:nome;");

    $query->execute(array(
      ':userid' => $this->userid,
      ':typeid' => $tipoRegisto,
      ':nome' => $nome));

    $result = $query->fetch();
    $nrRegisto = $result[0];

    $query = $connection->prepare(
    "INSERT INTO valor
       (userid,typeid,regid,campoid,valor,idseq,ativo)
    VALUES
       (:userid, :typecnt, :regcounter,
        :campoid, :valor, :idseq, 1);");
    $query->execute(array(':userid'     => $this->userid,
                          ':typecnt'    => $tipoRegisto,
                          ':regcounter' => $nrRegisto,
                          ':campoid'    => $campo,
                          ':valor'      => $valor,
                          ':idseq'      => $seqid));
    $connection->commit();
  }
  public function sequencia(){
    //Insere na tabela sequencia
    global $connection;

    $date=(date('Y-m-d H:i:s'));
    $query = $connection->prepare(
    "INSERT INTO sequencia(userid,moment)
       VALUES (:userid,:date);");
    $query->execute(array(':userid' => $this->userid,
                          ':date' => $date));

    //Retorna o maior contador de sequencia da base de dados
    $query = $connection->prepare(
    "SELECT contador_sequencia
     FROM sequencia
     WHERE contador_sequencia >= ALL(
     SELECT contador_sequencia
     FROM sequencia);");
    $query->execute();
    return $query->fetch()[0];
  }
}
?>
