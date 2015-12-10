<?php defined('_BD1516') or die; global $connection; ?>
<a href="index.php?page=registo&accao=inserir&pid=<?php echo $_GET['pid'] ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Criar registo</a>
<br>
<h2>Registos existentes na página</h2>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
       style="margin:0 auto;width:90%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pagina->registos as $registo){ ?>
    <tr>
      <td><?php echo $registo->regid; ?></td>
      <td><?php echo $registo->nome[0]; ?></td>
      <td>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="margin:0 auto;width:90%;margin:10px;margin-bottom:20px;">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($registo->valores as $valor){ ?>
            <tr>
              <td><?php var_dump($valor); echo $valor[0]->nome ?></td>
              <td><?php echo $valor[1] ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </td>
    </tr>
  <?php } ?>

  </tbody>
</table>
<?php
