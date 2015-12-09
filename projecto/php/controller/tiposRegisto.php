<?php
if($_GET['page'] == "tiposRegisto" && isset($_GET['accao'])){
  switch($_GET['accao']){
    case "inserir":
      if(isset($_POST['nomeTipo']))
        $this->user->adicionaTipoRegisto($_POST['nomeTipo']);
      break;
    case "remove":
      if(isset($_GET['tid']))
        $this->user->removeTipoRegisto($_GET['tid']);
      break;
    default:
      break;
  }
}
 ?>
