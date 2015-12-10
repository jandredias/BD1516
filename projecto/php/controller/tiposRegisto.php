<?php
if($_GET['page'] == "tiposRegisto" && isset($_GET['accao'])){
  switch($_GET['accao']){
    case "verTipoRegisto":
      if(isset($_GET['removeCampoID'])){
        $tipo = new TipoRegisto($this->user->userid, $_GET['tid']);
        $tipo->removeCampo($_GET['removeCampoID']);
        $this->addSuccessMessage("Campo removido com sucesso");
      }
      break;
    case "inserir":
      if(isset($_POST['nomeTipo'])){
        $this->user->adicionaTipoRegisto($_POST['nomeTipo']);
        $this->addSuccessMessage("Tipo de registo adicionado com sucesso");
      }
      break;
    case "remove":
      if(isset($_GET['tid'])){
        $this->user->removeTipoRegisto($_GET['tid']);
        $this->addSuccessMessage("Tipo de registo removido com sucesso");
        $this->user->reloadTipos();
      }
      break;
    case "adicionaCampo":
      if(isset($_POST['nomeCampo']) && isset($_POST['tid'])){
        $campo_nome = $_POST['nomeCampo'];
        $tid = $_POST['tid'];
        $tipo = new TipoRegisto($this->user->userid, $tid);
        $tipo->insereCampo($campo_nome);
        $this->addSuccessMessage("Campo inserido com sucesso");
      }
      break;
    default:
      break;
  }
}
 ?>
