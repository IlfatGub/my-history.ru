<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */


echo 'Hello '.Html::encode($user->username).'.';
echo Html::a("Для активации аккаунта перейдите по этой ссылке.",
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/user/activate-account',
            'key' => $user->auth_key
        ]
    ));

