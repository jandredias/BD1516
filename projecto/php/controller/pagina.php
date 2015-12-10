<?php defined('_BD1516') or die;
global $connection;
$accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";

switch($accao){
  case "remove":
    $this->user->removePagina($_GET['pid']);
    $this->addSuccessMessage("Página removida com sucesso");
    break;
  case "inserir":
   if(isset($_POST['nomePagina'])){
       $this->user->adicionaPagina($_POST['nomePagina']);
       $this->addSuccessMessage("Página criada com sucesso");
    }
    break;
  default:
    break;
} ?>
