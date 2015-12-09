<?php defined('_BD1516') or die;
global $connection;
?>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--6-col" style="text-align:center;">
    <div class="mdl-card mdl-shadow--2dp" style="margin: 0 auto;width:100%;padding:30px">
      <?php if($accao != "inserir"){ ?>
      <a href="index.php?page=registo&accao=inserir" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Criar registo</a>
      <br>
      <?php }

       switch($accao){
         case 'remove':
         case 'list':
          $this->user->getRegistos();
         ?>
        <?php break;
        case 'verRegistos':?>

        <?php break;
        case 'ver':?>

        <?php }
       ?>
    </div>
  </div>
</div>
