<?php

namespace app\models;

use yii\base\Model;
use common\models\User;
use yii\base\InvalidParamException;

class ResetPasswordForm extends Model
{

    public $_user;
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

    public function __construct($key, array $config = [])
    {
        if(empty($key) and is_string($key))
            throw new InvalidParamException('Ключ не может быть пустым');
        $this->_user = User::findBySecretKey($key);
        if(!$this->_user)
            throw new InvalidParamException();
        parent::__construct($config);
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