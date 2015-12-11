<?php defined('_BD1516') or die; global $connection; ?>
<h2>Adicionar campo</h2>
<form
action="index.php?page=tiposRegisto&accao=adicionaCampo&tid=<?php
echo $_GET['tid'] ?>" method="post">
  <div class="mdl-textfield mdl-js-textfield
              mdl-textfield--floating-label">
    <input type="hidden" name="tid"
           value="<?php echo $_GET['tid'] ?>" />
    <input class="mdl-textfield__input" type="text"
           id="nomeCampo" name="nomeCampo" />
    <label class="mdl-textfield__label"
           for="nomeCampo">Nome do campo</label>
  </div>
  <button class="mdl-button mdl-js-button mdl-button--raised
                 mdl-js-ripple-effect" type="submit"
          name="Submit">Adicionar campo</button>
</form>
