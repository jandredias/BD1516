<?php defined('_BD1516') or die; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./views/mdl/material.min.css">
  <script src="./views/mdl/material.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
  <!-- Main Container -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header has-drawer"
      style="background-color: #f3f3f3;">
    <!-- HEADER -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title" onclick="location.href = 'index.php';"><?php echo Configuration::$_sitetitle ?></span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation. We hide it in small screens. -->
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=pagina" <?php } ?>>Página</a>
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=tiposRegisto"  <?php } ?>>Tipos de Registo</a>
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=perfil&accao=list" <?php } ?>>O meu perfil</a>
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=logout" <?php } ?>>Terminar sessão</a>
          </nav>
        </div>
      </header>
    </div>
    <!-- END OF HEADER -->
    <!-- MAIN CONTENT -->
    <main class="mdl-layout__content" style="padding-top:64px;">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--1-col"></div>
        <div class="mdl-cell mdl-cell--1-col"></div>
        <div class="mdl-cell mdl-cell--1-col"></div>
        <div class="mdl-cell mdl-cell--6-col" style="text-align:center;">
          <?php if(count($this->getSuccessMessage())){ ?>
          <div class="mdl-card mdl-shadow--2dp"
          style="margin: 0 auto;width:100%;padding:20px;background:green;color:white;min-height:50px;">
          <?php foreach($this->getSuccessMessage() as $message) echo $message; ?>
          </div>
          <?php } ?>
          <?php if(count($this->getWarningMessage())){ ?>
          <div class="mdl-card mdl-shadow--2dp"
          style="margin: 0 auto;width:100%;padding:20px;background:#ff9900;color:white;min-height:50px;">
          <?php foreach($this->getWarningMessage() as $message) echo $message; ?>
          </div>
          <?php } ?>
          <?php if(count($this->getErrorMessage())){ ?>
          <div class="mdl-card mdl-shadow--2dp"
          style="margin: 0 auto;width:100%;padding:20px;background:red;color:white;min-height:50px;">
            <?php foreach($this->getErrorMessage() as $message) echo $message;?>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php if(isset($_GET['page']) &&
               in_array($_GET['page'], array("pagina", "registo",
                                             "tiposRegisto", "perfil"))){
            ?>
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--1-col"></div>
              <div class="mdl-cell mdl-cell--1-col"></div>
              <div class="mdl-cell mdl-cell--1-col"></div>
              <div class="mdl-cell mdl-cell--6-col" style="text-align:center;">
                <div class="mdl-card mdl-shadow--2dp" style="margin: 0 auto;width:100%;padding:20px;">
                    <?php include $_GET['page']."/".($accao == "remove" ? "list" : $accao).".php"; ?>
                </div>
              </div>
            </div>
            <?php
           }else if( in_array($_GET['page'], array("login","exception"))){
              include $_GET['page'].".php";
           }
            else include "index_default.php"; ?>
    </main>
    <!-- END OF MAIN CONTENT -->
  </div>
  <!-- END Main Container -->
</body>
</html>
