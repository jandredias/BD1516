<?php defined('_BD1516') or die; global $connection; ?>
<h2>Criar tipo de registo</h2>
<form action="index.php?page=tiposRegisto&accao=inserir" method="post">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="nomeTipo" name="nomeTipo" />
    <label class="mdl-textfield__label" for="nomeTipo">Nome do tipo de registo</label>
  </div>
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit" name="Submit">Criar</button>
</form>
