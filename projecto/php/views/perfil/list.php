<?php defined('_BD1516') or die; ?>
<div class="mdl-card__title mdl-card--expand">
  <h2 class="mdl-card__title-text">O meu perfil</h2>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%;padding:20px;margin: 0 auto;">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"style="width:90%;padding:20px;margin: 0 auto;">
    <tbody>
      <tr>
        <td>Nome</td>
        <td><?php echo $this->user->nome; ?></td>
      </tr>
      <tr>
        <td>E-mail</td>
        <td><?php echo $this->user->email; ?></td>
      </tr>
      <tr>
        <td>País</td>
        <td><?php echo $this->user->pais; ?></td>
      </tr>
      <tr>
        <td>Categoria</td>
        <td><?php echo $this->user->categoria; ?></td>
      </tr>
    </tbody>
  </table>
</div>
