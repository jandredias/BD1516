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
      $this->user->adicionaRegisto($nome, $tipoID);

      $this->user->adicionaRegistoAPagina($tipoID, $nome, $_POST['pid']);

      $tipo = new TipoRegisto($this->user->userid, $tipoID);
      foreach($tipo->campos as $campo){
        $this->user->adicionaValor($campo->campocnt, $campo->typecnt, $nome, $_POST[$campo->campocnt]);
      }

    }
    break;
  default:
    break;
}
