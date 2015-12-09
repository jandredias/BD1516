<?php defined('_BD1516') or die; global $connection; ?>
<a href="index.php?page=registo&accao=inserir" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Criar registo</a>
<br>
<?php
 $pagina = new Pagina($this->user->userid, $_GET['pid']);
 $pagina->getRegistos();

 ?>
