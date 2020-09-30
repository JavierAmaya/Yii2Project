<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Formulario</h1>

<?= Html ::beginForm(
    Url:: toRoute("site/request"), //action
    "get",//metodo
    ['class' => 'form-inline']///options

);
?>
<div class="form-group">
    <?= Html::label("Introduce tu nombre","nombre")?>
    <?= Html::textInput( "nombre", null)?>
</div> 
<?= Html:: endForm()?>