<?php
class TipoRegisto{
  public $userid = NULL;
  public $typeid = NULL;
  public $nome   = NULL;
  public $campos = NULL;
  public function __construct($userid, $typeid){
    global $connection;
    $query = $connection->prepare(
      "SELECT nome
       FROM tipo_registo
       WHERE userid=:userid AND
             ativo=1 AND
             typecnt=:typeid");
    $query->execute(array(':userid' => $userid, ':typeid' => $typeid));
    $result = $query->fetch();
    $this->userid = $userid;
    $this->typeid = $typeid;
    $this->nome   = $result[0];

    //Get Campos from Database
    $query = $connection->prepare(
      "SELECT campocnt
       FROM campo
       WHERE userid=:userid AND
             ativo=1 AND
             typecnt=:typecnt");
    $query->execute(array(':userid' => $userid, ':typecnt' => $typeid));
    $this->campos = array();
    foreach($query->fetchAll() as $row){
      $this->campos[] = new Campo($this->userid, $this->typeid, $row[0]);
    }
  }
  //Magic functions
  public function __get($property){
    if(property_exists($this, $property))
      return $this->$property;
  }
  public function __set($property, $value){
    if(property_exists($this, $property))
      $this->$property = $value;
  }

  public function insereCampo($nome){
    global $connection;
    $connection->begintransaction();
    $query = $connection->prepare(
      "SELECT COUNT(*)
       FROM campo
       WHERE userid=:userid AND
             typecnt=:typeid AND
             nome=:nome");
    $query->execute(array(':userid' => $this->userid, ':typeid' => $this->typeid, ":nome" => $nome));
    $result = $query->fetch();
    $result = $result[0];
    if($result == 0){//Temos de inserir um campo novo
      $campoCount = 0;
      $query = $connection->prepare(
        "SELECT campocnt + 1 AS pg
         FROM(
           SELECT campocnt
           FROM campo
           WHERE campocnt >= ALL(
             SELECT campocnt FROM campo)) naoserverparanadaestealias;");
      $query->execute();
      $campoCount = $query->fetch()[0];
      $query = $connection->prepare(
      "INSERT INTO campo(userid,typecnt,campocnt,idseq,ativo, nome)
      VALUES (:userid, :typecnt, :campocnt, :idseq, 1, :nome);");
      $query->execute(array(':userid' => $this->userid,
                            ':typecnt' => $this->typeid,
                            ':campocnt' => $campoCount,
                            ':idseq' => $this->sequencia(),
                            ':nome' => $nome));
    }else{//Caso contrario o campo ja existe e apenas temos de o ativar
      $query = $connection->prepare(
        "UPDATE campo
         SET ativo=1
         WHERE userid=:userid AND
               typecnt=:typecnt AND
               nome=:nome AND
               pcampocnt IS NULL;");
      $query->execute(array(':userid' => $this->userid, ':typecnt' => $this->typeid, ":nome" => $nome));
    }
    $connection->commit();
  }
  public function removeCampo( $campoId ){
    global $connection;
    $connection->begintransaction();
    $query = $connection->prepare(
      "UPDATE campo
       SET ativo=0
       WHERE userid=:userid AND
             typecnt=:typecnt AND
             campocnt=:campocnt AND
             pcampocnt IS NULL;");
    $query->execute(array(':userid' => $this->userid, ':typecnt' => $this->typeid, ":campocnt" => $campoId));
    $connection->commit();
  }
  public function sequencia(){
    global $connection;

    $date=(date('Y-m-d H:i:s'));
    $query = $connection->prepare("INSERT INTO sequencia(userid,moment)
                                   VALUES (:userid,:date);");
    $query->execute(array(':userid' => $this->userid, ':date' => $date));

    //Retorna o maior contador de sequencia da base de dados
    $query = $connection->prepare("SELECT contador_sequencia
                                   FROM sequencia
                                   WHERE contador_sequencia >= ALL(
                                     SELECT contador_sequencia
                                     FROM sequencia);");
    $query->execute();
    return $query->fetch()[0];
  }
}
 ?>
