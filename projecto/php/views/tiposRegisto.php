<?php defined('_BD1516') or die; $accao = (isset($_GET['accao'])) ? $_GET['accao'] : "list";
global $connection;
?>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-cell mdl-cell--6-col" style="text-align:center;">
    <div class="mdl-card mdl-shadow--2dp" style="margin: 0 auto;width:100%;padding:30px">
      <?php if($accao != "inserir"){ ?>
      <a href="index.php?page=tiposRegisto&accao=inserir" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Criar Tipo de Registo</a>
      <br>
      <?php }

       switch($accao){
         case 'remove': ?>

        <?php case 'list': ?>
          <h2>Tipos de Registo</h2>
          <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="margin:0 auto; width:90%;">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>NOME</th>
              </tr>
            </thead>
            <tbody>
              <?php var_dump($this->user->tiposRegisto()); ?>
          <?php foreach($this->user->tiposRegisto() as $tipo){ ?>
            <tr>
              <td><a href="index.php?page=tipoRegisto&accao=remove&tid=<?php echo $tipo->typeid ?>">X</a></td>
              <td><?php echo $tipo->typeid ?></td>
              <td><a href="index.php?page=tipoRegisto&accao=verRegistos&tid=<?php echo $tipo->nome ?>"><?php echo $tipo->nome ?></a></td>
            </tr>
          <?php } ?>

          </tbody>
        </table>
        <?php break;
        case 'inserir':?>

        <?php break;
        case 'verRegistos':?>

        <?php break;
        case 'ver':?>

        <?php }
       ?>
    </div>
  </div>
</div>