<?php defined('_BD1516') or die; global $connection; ?>
<?php
  $accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";

switch($accao){
  case "inserir":
    $tipos = $this->user->tiposRegisto;
    if(count($tipos) == 0){
      $this->addWarningMessage("Não tem tipos de registos.");
    }
    break;
  case "preencher":
    if(!isset($_POST['tipoID'])){
      header("location: index.php?page=registo&accao=inserir&pid=".$_POST['pid']."&erro");
    }
    $tipo = new TipoRegisto($this->user->userid,
                            $_POST['tipoID']);
    $campos = $tipo->campos;
    break;
  default:
    break;
}
?>
