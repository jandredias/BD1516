<?php defined('_BD1516') or die; global $connection; ?>
<?php
switch(isset($_GET['page']) ? $_GET['page'] : False ){
  case default:
  case "list":
    $query = $connection->prepare("SELECT pagecounter, nome FROM pagina WHERE userid=:userid AND ativa=1;");
    $userid = $this->user->userid;
    $query->execute(array(':userid' => $userid));
    $paginas = $query->fetchAll();
  break;
}
 ?>
