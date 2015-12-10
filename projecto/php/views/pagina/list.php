<?php defined('_BD1516') or die; global $connection; ?>
<a href="index.php?page=pagina&accao=inserir&pid=<?php echo $page['pagecounter'] ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Criar página</a>
<br>
<h2>Lista de páginas</h2>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="margin:0 auto; width:90%;">
  <thead>
    <tr>
      <th></th>
      <th>ID</th>
      <th>NOME</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($paginas as $page){ ?>
    <tr>
      <td><a href="index.php?page=pagina&accao=remove&pid=<?php echo $page['pagecounter'] ?>">X</a></td>
      <td><?php echo $page['pagecounter'] ?></td>
      <td><a href="index.php?page=pagina&accao=view&pid=<?php echo $page['pagecounter'] ?>"><?php echo $page['nome'] ?></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
