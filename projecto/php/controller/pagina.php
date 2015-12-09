<?php defined('_BD1516') or die;
global $connection;
$accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";

switch($accao){
  case "remove":
    $this->user->removePagina($_GET['pid']);
    break;
  case "inserir":
   if(isset($_POST['nomePagina'])){
       $this->user->adicionaPagina($_POST['nomePagina']);
     }
     break;
  default:
    break;
} ?>
