<?php defined('_BD1516') or die;
global $connection;
$accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";

switch($accao){
  case "remove":
    $userid = $this->user->userid;
    $email = $this->user->email;
    $pid = $_GET['pid'];
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
    break;
  case "inserir":
   if(isset($_POST['nomePagina'])){
       //CONTROLLER inserir pagina

       $connection->begintransaction();

       $userid = $this->user->userid;
       $email = $this->user->email;
       $nome = $_POST['nomePagina'];
       $date=(date('Y-m-d H:i:s'));

       //Insere na tabela sequencia
       $query = $connection->prepare("INSERT INTO sequencia(userid,moment)
                                      VALUES (:userid,:date);");
       $query->execute(array(':userid' => $userid, ':date' => $date));

       //Retorna o maior contador de sequencia da base de dados
       $query = $connection->prepare("SELECT contador_sequencia
                                      FROM sequencia
                                      WHERE contador_sequencia >= ALL(
                                        SELECT contador_sequencia
                                        FROM sequencia);");
       $query->execute();
       $seqid = $query->fetch()[0];
       $query = $connection->prepare(
         "SELECT pagecounter + 1 AS pg
          FROM(
            SELECT userid, pagecounter, nome, idseq, ativa
            FROM pagina
            WHERE pagecounter >= ALL(
              SELECT pagecounter FROM pagina)) naoserverparanadaestealias;");
       $query->execute();
       $page_counter= $query->fetch()[0];
       $query = $connection->prepare("INSERT INTO pagina(userid,pagecounter,nome,idseq,ativa) VALUES (:userid, :page_counter, :nome, :seqid, 1);");
       $query->execute(array(':userid' => $userid,
                             ':page_counter' => $page_counter,
                             ':nome' => $nome,
                             ':seqid' => $seqid));
       $connection->commit();
     }
     break;
  default:
    break;
} ?>
