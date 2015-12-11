<?php defined('_BD1516') or die; global $connection; ?>
<h2>Inserir registo</h2>
<?php if(count($tipos)) { ?>
  <form action="index.php?page=registo&accao=preencher"
        method="post">
    <input type="hidden" name="pid"
           value="<?php echo $_GET['pid'] ?>" />
    <div class="mdl-textfield mdl-js-textfield
                mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text"
             id="nomeRegisto" name="nomeRegisto" />
      <label class="mdl-textfield__label"
             for="nomeRegisto">Nome do Registo</label>
    </div>
    <br>
    <?php $test = true; foreach($tipos as $tipo){ ?>
    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect"
           for="<?php echo $tipo->typeid ?>">
      <input type="radio" id="<?php echo $tipo->typeid ?>"
             class="mdl-radio__button" name="tipoID"
             value="<?php echo $tipo->typeid ?>">
      <span class="mdl-radio__label"><?php echo $tipo->nome; ?>
      </span>
    </label>
    <?php } ?>
    <br>
    <button class="mdl-button mdl-js-button mdl-button--raised
                   mdl-js-ripple-effect" type="submit" 
             name="Submit">Inserir</button>
  </form>

<?php }
