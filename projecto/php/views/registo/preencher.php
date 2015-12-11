<?php defined('_BD1516') or die; global $connection; ?>
<h2>Preencher campos do registo criado</h2>

<form action="index.php?page=registo&accao=inserir"
      method="post">
  <input type="hidden" name="pid"
         value="<?php echo $_POST['pid'] ?>" />
  <input type="hidden" name="nomeRegisto"
         value="<?php echo $_POST['nomeRegisto'] ?>" />
  <input type="hidden" name="tipoID"
         value="<?php echo $_POST['tipoID'] ?>" />
  <?php foreach($campos as $campo){ ?>
  <div class="mdl-textfield mdl-js-textfield
              mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text"
           name="<?php echo $campo->campocnt ?>">
    <label class="mdl-textfield__label"
           for="<?php echo $campo->campocnt ?>"><?php 
                      echo $campo->nome; ?></label>
  </div>
  <br />
  <?php } ?>
  <button class="mdl-button mdl-js-button mdl-button--raised
                 mdl-js-ripple-effect" type="submit"
          name="Submit">Criar</button>
</form>
