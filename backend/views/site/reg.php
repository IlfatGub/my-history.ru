<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
?>
<div class="main-reg">
    <div class="row col-lg-4 col-lg-offset-4">
    <h2>Registration</h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary col-xs-12']) ?>
    </div>
    <?php ActiveForm::end(); ?>



    <?php if($model->scenario === 'emailActivation'): ?>
        <br><br><br>
        <i>*На указанный емайл будет отправлено письмо для активации аккаунта.</i>
        <?php
    endif;
    ?>
    </div>

</div>

