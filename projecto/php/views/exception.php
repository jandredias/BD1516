<?php defined('_BD1516') or die; ?>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--4-col"></div>
  <div class="mdl-cell mdl-cell--4-col" 
       style="text-align:center;">
    <div class="mdl-card mdl-shadow--2dp"
         style="max-width: 960px;margin: 0 auto;">
        <div class="mdl-card__title mdl-card--expand">
          <h2 class="mdl-card__title-text">Erro!</h2>
        </div>
        <div class="mdl-textfield mdl-js-textfield
                    mdl-textfield--floating-label"
             style="max-width: 960px;margin: 0 auto;">
          <?php echo $_GET['message']; ?>
        </div>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--4-col"></div>
</div>
