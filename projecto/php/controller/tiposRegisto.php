<?php
if($_GET['page'] == "tiposRegisto" && isset($_GET['accao'])){
  switch($_GET['accao']){
    case "inserir":
      if(isset($_POST['nomeTipo'])){
        $user = $this->user;
        var_dump($user);
        $user->adicionaTipoRegisto($_POST['nomeTipo']);
      }
      break;
    case "remove":
      if(isset($_GET['tid'])){
        //FIXME
      }
      break;
    default:
      break;
  }
}
 ?>
