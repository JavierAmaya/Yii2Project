<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h2><?=$mensaje?></h2>
<h1>Formulario</h1>
<p style="background-color: green"><?=$estado?></p>
<?= Html :: beginForm(
    Url:: toRoute("site/request"), //action
    "get",//metodo
    ['class' => 'form-inline']///options

);
?>
<div class="form-group">
    <?= Html::label("Introduce tu nombre",'nombre')?>
    <?= Html::textInput( 'nombre', null, ["class" => "form-control"] )?>
    <?= Html::label("Introduce tu correo",'correo')?>;
    <?= Html::textInput('correo',null,["class"=> "form-control"])?> 
    <?= Html::submitInput("Enviar nombre",["class" => "btn btn-primary"])?>
</div> 
<?= Html:: endForm()?>