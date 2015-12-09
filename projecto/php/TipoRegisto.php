<?php
class TipoRegisto{
  private $userid = NULL;
  private $typeid = NULL;
  private $nome   = NULL;
  private $campos = NULL;
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
    foreach($query->fetchAll() as $row)
      $this->campos[] = new Campo($row[0]);
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
}
 ?>
