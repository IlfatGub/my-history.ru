<?php
/**
 * Created by PhpStorm.
 * User: Ilfat
 * Date: 28.10.2017
 * Time: 22:12
 */

namespace common\models;


class SendEmailForm
{

    public $email;


    public function rules()
    {
        return
            [
                ['email', 'filter', 'filter' => 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'exist',
                    'targetClass' => User::className(),
                    'filter' => [
                        'status' => User::STATUS_ACTIVE
                    ],
                    'message' => "Данный емайл не зарегестрирован"
                ]
            ];
    }

    public function atribteLabels()
    {
        return
            [
                'email' => 'Емаил'
            ];
    }

    public function sendEmail()
    {
        $user = User::findOne(
            [
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]
        );

        if ($user):
            $user->generateSecretKey();
            if ($user->save()):
                return \Yii::$app->mailer->compose('resetPassword', ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . '(отправлено роботом)'])
                    ->setTo($this->email)
                    ->setSubject('Сбров пароля для' . \Yii::$app->name)
                    ->send();
            endif;
        endif;

        return false;
    }
}