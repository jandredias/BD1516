<?php defined('_BD1516') or die; global $connection;
$accao = isset($_GET['accao']) ? $_GET['accao'] : "list";
if($accao == "remove") $accao = "list";
switch($accao){
  case "list":
    $query = $connection->prepare(
      "SELECT pagecounter, nome
       FROM pagina
       WHERE userid=:userid AND
             ativa=1;");
    $userid = $this->user->userid;
    $query->execute(array(':userid' => $userid));
    $paginas = $query->fetchAll();
    break;
  case "view":
    $pagina = new Pagina($this->user->userid, $_GET['pid']);
    break;
  default:
    break;
}
 ?>
