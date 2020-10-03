<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<h1>Validar Formulario Ajax</h1>
<h3><?= $msg ?> </h3>

<?php $form = ActiveForm::begin([ //begin -> es para abrir el formulario -- validacion del lado del cliente
    'method' => 'post',
    'id' => "formulario", /// adding un id al formulario
    'enableClientValidation' => false, // en false se desactiva la validacion del lado del cliente
    'enableAjaxValidation' => true                      // por defecto viene en false
])?>

<div class="form-group">
    <?= $form -> field($model,'nombre') -> input('text') ?>
</div>
<div class="form-group">
    <?= $form -> field($model,'email') -> input('email') ?>
</div>
<?= Html::submitButton('Enviar',['class' => 'btn btn-primary'])?>

<?php $form -> end()?>
