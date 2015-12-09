<?php defined('_BD1516') or die; global $connection; ?>
<?php
  $accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";
  switch($accao){
    case "verTipoRegisto":
        $tipoRegisto = new TipoRegisto($this->user->userid, $_GET['tid']);
      break;
    default:
      break;
  }
?>
