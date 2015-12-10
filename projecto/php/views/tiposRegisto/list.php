<?php defined('_BD1516') or die; global $connection; ?>
<a href="index.php?page=tiposRegisto&accao=inserir" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Criar Tipo de Registo</a>
<br>
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

<?php if($this->user->tiposRegisto != NULL)
  foreach($this->user->tiposRegisto as $tipo){ ?>
  <tr>
    <td><a href="index.php?page=tiposRegisto&accao=remove&tid=<?php echo $tipo->typeid ?>">X</a></td>
    <td><?php echo $tipo->typeid ?></td>
    <td><a href="index.php?page=tiposRegisto&accao=verTipoRegisto&tid=<?php echo $tipo->typeid ?>"><?php echo $tipo->nome ?></a></td>
  </tr>
<?php } ?>

</tbody>
</table>
