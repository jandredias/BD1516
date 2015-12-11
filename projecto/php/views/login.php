<?php defined('_BD1516') or die; ?>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--4-col"></div>
  <div class="mdl-cell mdl-cell--4-col" style="text-align:center;">
    <div class="mdl-card mdl-shadow--2dp"
         style="max-width: 960px;margin: 0 auto;">
      <form action="index.php?page=logging" method="post">

        <div class="mdl-card__title mdl-card--expand">
          <h2 class="mdl-card__title-text">Iniciar sessão</h2>
        </div>
        <div class="mdl-textfield mdl-js-textfield
                    mdl-textfield--floating-label"
             style="max-width: 960px;margin: 0 auto;">
          <input class="mdl-textfield__input inputbox"
                 id="username"
                 type="text" name="username" size="50" />
          <label class="mdl-textfield__label"
                 for="username">Nome de Utilizador</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield
                    mdl-textfield--floating-label"
             style="max-width: 960px;margin: 0 auto;">
          <input class="mdl-textfield__input inputbox" id="password"
                 type="password" name="password" size="50" />
          <label class="mdl-textfield__label"
                 for="password">Palavra-chave</label>
        </div>
        <!-- Login Button -->
        <div class="mdl-card__actions mdl-card--border">
          <button type="submit" name="Submit"
                  class="mdl-button mdl-button--colored
                         mdl-js-button mdl-js-ripple-effect">
            Iniciar sessão</button>
        </div>
        <div class="mdl-card__actions mdl-card--border">
          <a href="index.php?page=login"
             class="mdl-button mdl-button--colored mdl-js-button
                    mdl-js-ripple-effect">Criar conta</a>
        </div>
        <!-- End Login Button -->
        <!-- Login Button -->
        <div class="mdl-card__actions mdl-card--border">
          <a href="index.php?page=login"
             class="mdl-button mdl-button--colored mdl-js-button
                    mdl-js-ripple-effect">Recuperar password?</a>
        </div>
        <!-- End Login Button -->
      </form>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--4-col"></div>
</div>
