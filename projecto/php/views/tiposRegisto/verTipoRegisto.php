<?php defined('_BD1516') or die; global $connection; ?>
<a href="index.php?page=tiposRegisto&accao=adicionaCampo&tid=<?php echo $tipoRegisto->typeid ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="width:200px;margin:0 auto;">Adicionar campo</a>
<br>
<h2>Tipo de Registo</h2>
Nome do Tipo: <?php echo $tipoRegisto->nome ?><br /><br />
<?php if(count($tipoRegisto->campos) > 0){ ?>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:90%;margin:0 auto;">
  <thead>
    <tr>
      <th style="text-align:center;">Nome do Campo</th>
    </tr>
  </thead>
  <tbody>
    <?php
     foreach($tipoRegisto->campos as $campo): ?>
      <tr>
        <td style="text-align:center;"><?php echo $campo->nome ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php }else{ ?>Não existem campos neste tipo de registo.<?php } ?>
