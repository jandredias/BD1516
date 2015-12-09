<?php

class Pagina {

  private $userid   = NULL;
  private $pageid   = NULL;
  private $nome     = NULL;
  private $registos = NULL;
  public function __construct($userid, $pageid){
    global $connection;
    $query = $connection->prepare(
      "SELECT pagecounter, nome
       FROM pagina
       WHERE userid=:userid AND
             ativa=1 AND
             pagecounter=:pagecounter");
    $query->execute(array(':userid' => $userid, ':pagecounter' => $pageid));
    $result = $query->fetch();
    $this->userid = $userid;
    $this->pageid = $padeig;
    $this->nome   = $result[1];
  }
  public function delete(){
    global $connection;
    $connection->begintransaction();
    $query = $connection->prepare(
      "UPDATE pagina
       SET ativa=0
       WHERE userid=:userid
       AND pagecounter=:pagecounter;");
    $query->execute(array(':userid' => $this->userid,':pagecounter' => $this->pageid));
    $connection->commit();
  }
  public function rename(){
    //TODO
  }
}
