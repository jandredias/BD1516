<?php defined('_BD1516') or die; global $connection; ?>
<?php
class Registo {

  public $userid      = NULL;
  public $regid       = NULL;
  public $tipoRegisto = NULL;
  public $nome        = NULL;
  public $valores     = NULL;

  public function __construct($userid, $regid, $typeid){
    global $connection;
    $this->userid       = $userid;
    $this->regid        = $regid;
    $this->tipoRegisto  = $typeid;

    /* Get Name */
    $query = $connection->prepare(
      "SELECT nome
       FROM registo
       WHERE userid=:userid      AND
             typecounter=:typeid AND
             regcounter=:regid   AND
             ativo=1");
    $query->execute(array(':userid' => $userid,
                          ':typeid' => $typeid,
                          ':regid' => $regid));
    $result = $query->fetch();
    $this->nome = $result;

    $tipo = new TipoRegisto($this->userid, $this->tipoRegisto);

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
                            ':campoid' => $campo->campocnt));

      $c = new Campo($this->userid,
                     $this->tipoRegisto,
                     $campo->campocnt);

      $result = $query->fetch();
      $this->valores[] = array($c, $result[0]);
    }
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
