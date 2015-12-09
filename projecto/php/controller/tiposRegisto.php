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
    case "adicionaCampo":
      if(isset($_POST['nomeCampo']) && isset($_POST['tid'])){
        $campo_nome = $_POST['nomeCampo'];
        $tid = $_POST['tid'];
        $tipo = new TipoRegisto($this->user->userid, $tid);
        $tipo->insereCampo($campo_nome);
      }
      break;
    default:
      break;
  }
}
 ?>
