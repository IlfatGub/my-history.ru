<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
?>
<div class="main-endEmail">
    <div class="row col-lg-4 col-lg-offset-4">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary col-xs-12']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        ?>
    </div>

</div>

