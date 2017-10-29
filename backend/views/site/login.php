<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>


<div class="site-login">
    <div class="row col-lg-4 col-lg-offset-4">
        <h2>Please sign in</h2>
        <div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?php if($model->scenario === 'loginWithEmail') : ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Email") ?>
                <?php else: ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Логин") ?>
                <?php endif; ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary col-lg-12', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

            <?= Html::a('Забыли пароль?', ['site/send-email']) ?>
        </div>
    </div>
</div>
