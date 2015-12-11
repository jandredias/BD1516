<?php

class Campo{
  public $userid;
  public $typecnt;
  public $campocnt;
  public $nome;

  function __construct($userid, $typecnt, $campocnt){
    global $connection;
    $query = $connection->prepare(
      "SELECT nome
       FROM campo
       WHERE userid=:userid AND
             ativo=1 AND
             typecnt=:typecnt AND
             campocnt=:campocnt");
    $query->execute(array(':userid' => $userid, 
                          ':typecnt' => $typecnt,
                          ':campocnt' => $campocnt));
    $result = $query->fetch();
    $this->typecnt  = $typecnt;
    $this->userid   = $userid;
    $this->campocnt = $campocnt;
    $this->nome     = $result[0];
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
