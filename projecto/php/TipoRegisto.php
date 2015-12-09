<?php
class TipoRegisto{
  private $userid;
  private $typeid;
  private $nome;

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
  }
  public function __get($property){
    if(property_exists($this, $property))
      return $this->property;
  }
  public function __set($property, $value){
    if(property_exists($this, $property))
      $this->$property = $value;
  }
}
 ?>
