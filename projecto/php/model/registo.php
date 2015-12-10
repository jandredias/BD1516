<?php defined('_BD1516') or die; global $connection; ?>
<?php
  $accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";

switch($accao){
  case "inserir":
    $tipos = $this->user->tiposRegisto;
    break;
  case "preencher":
    $tipo = new TipoRegisto($this->user->userid, $_POST['tipoID']);
    $campos = $tipo->campos;
    break;
  default:
    break;
}
?>
