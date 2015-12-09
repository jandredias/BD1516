<?php defined('_BD1516') or die;
global $connection;
$accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";

switch($accao){
  case 'list':

    break;
  case "inserir":
    if(isset($_POST['nomeRegisto']) && isset($_POST['tipoID'])){
      $nome = $_POST['nomeRegisto'];
      $tipoID = $_POST['tipoID'];
      $tipo = new TipoRegisto($this->user->userid, $tipoID);
      
    }
    break;
  default:
    break;
}
