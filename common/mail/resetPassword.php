<?php
/**
 * Created by PhpStorm.
 * User: Ilfat
 * Date: 28.10.2017
 * Time: 22:24
 */


use yii\helpers\Html;

echo "привет". Html::encode($user->username);
echo Html::a('Для смены паоля перейдите по ссылке.',
        Yii::$app->urlManager->createAbsoluteUrl(
            [
                '/site/reset-password',
                'key' => $user->secret_key
            ]
        )
    );