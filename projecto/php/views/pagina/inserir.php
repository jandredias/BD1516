<?php defined('_BD1516') or die; global $connection; ?>
<h2>Criar página</h2>
  <form action="index.php?page=pagina&accao=inserir" method="post">
    <input type="hidden" name="pid" value="<?php echo $_GET['pid'] ?>" />
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="nomePagina" name="nomePagina" />
      <label class="mdl-textfield__label" for="nomePagina">Nome da página</label>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit" name="Submit">Criar</button>
  </form>
