<?php

class Pagina {

  public $userid   = NULL;
  public $pageid   = NULL;
  public $nome     = NULL;
  public $registos = NULL;
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
    $this->pageid = $pageid;
    $this->nome   = $result[1];

    $query = $connection->prepare(
      "SELECT r.regcounter, r.typecounter
      FROM registo r, reg_pag rp
      WHERE r.typecounter=rp.typeid AND
            r.userid=rp.userid AND
            r.regcounter=rp.regid AND
            r.userid=:userid AND
            rp.pageid=:pageid AND
            r.ativo=1 AND
            rp.ativa=1;");
    $query->execute(array(':userid' => $this->userid, ':pageid' => $this->pageid));
    $this->registos = array();
    foreach($query->fetchAll() as $registo)
      $this->registos[] = new Registo($this->userid, $registo[0], $registo[1]);
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
