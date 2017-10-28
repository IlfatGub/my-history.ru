<?php
/**
 * Created by PhpStorm.
 * User: Ilfat
 * Date: 28.10.2017
 * Time: 22:29
 */

namespace app\models;


use yii\web\User;

class resetPasswordForm
{

    public function rules()
    {
        return [
            ['password', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'пароль'
        ];
    }

    public function resetPassword()
    {
        /* @var $user User */
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removeSecretKey();
        return  $user->save();
    }
}