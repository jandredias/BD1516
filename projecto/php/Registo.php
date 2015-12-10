<?php defined('_BD1516') or die; global $connection; ?>
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
  public function insereValor($count, $value){
    //TODO
  }
  public function __get($property){
    if(property_exists($this, $property))
      return $this->property;
  }
  public function __set($property, $value){
    if(property_exists($this, $property))
      $this->$property = $value
  }

  public function campos(){
    $tipo = new TipoRegisto($this->userid, $this->TipoRegisto);
    foreach($tipo->campos as $campo){
      $query = $connection->prepare(
        "SELECT valor
         FROM valor
         WHERE userid=:userid AND
               typeid=:typeid AND
               regid=:regid AND
               campoid=:campoid AND
               ativo=1");
      $query->execute(array(':userid'  => $this->userid,
                            ':typeid'  => $this->tipoRegisto,
                            ':regid'   => $this->regid,
                            ':campoid' => $this->campocnt));
      $this->campos[new Campo($this->userid, $this->tipoRegisto, $this->campocnt)] = $query->fetch()[0];
    }


  }
}
