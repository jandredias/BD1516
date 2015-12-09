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
          <span class="mdl-layout-title"><?php echo Configuration::$_sitetitle ?></span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation. We hide it in small screens. -->
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=pagina" <?php } ?>>Página</a>
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=tiposRegisto"  <?php } ?>>Tipos de Registo</a>
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=perfil" <?php } ?>>O meu perfil</a>
            <a class="mdl-navigation__link" <?php if($_GET['page'] != "login"){ ?>
               href="index.php?page=logout" <?php } ?>>Terminar sessão</a>
          </nav>
        </div>
      </header>
    </div>
    <!-- END OF HEADER -->
    <!-- MAIN CONTENT -->
    <main class="mdl-layout__content" style="padding-top:64px;">
      <?php if(isset($_GET['page']) &&
               in_array($_GET['page'], array("login", "pagina", "registo",
                                             "tiposRegisto", "perfil",
                                             "exception")))
              include $_GET['page'].".php";
            else include "index_default.php"; ?>
    </main>
    <!-- END OF MAIN CONTENT -->
  </div>
  <!-- END Main Container -->
</body>
</html>
