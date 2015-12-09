<?php defined('_BD1516') or die; $accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";
global $connection;
?>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--6-col" style="text-align:center;">
    <div class="mdl-card mdl-shadow--2dp" style="margin: 0 auto;width:100%;padding:30px">
      <?php include "tiposRegisto/".($accao == "remove" ? "list" : $accao) .".php"; ?>
    </div>
  </div>
</div>
