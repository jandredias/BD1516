<?php

class Registo {

  private $userid      = NULL;
  private $nome        = NULL;
  private $regid       = NULL;
  private $tipoRegisto = NULL;
  private $campos      = NULL;

  public function __construct($userid, $regid, $typeid){
    $this->userid = $userid;
    $this->redig  = $regid;
    $this->redig  = $regid;
    //TODO
    //SELECT FROM DATABASE
  }

  public function __get($property){
    if(property_exists($this, $property))
      return $this->property;
  }
  public function __set($property, $value){
    if(property_exists($this, $property))
      $this->$property = $value
  }
}
