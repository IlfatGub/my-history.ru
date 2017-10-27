<?php
/**
 * Created by PhpStorm.
 * User: 01gig
 * Date: 27.10.2017
 * Time: 13:08
 */

namespace common\models;


use yii\base\InvalidParamException;
use yii\base\Model;

class AccountActivate extends Model
{

    private $_user;

    public function __construct($key, array $config = [])
    {
        if(empty($key))
            throw new InvalidParamException('Ключ не может быть пустым');

        $this->_user = User::findBySecretKey($key);

        if(!$this->_user)
            throw new InvalidParamException('Не верный ключ');

        parent::__construct($config);
    }

    public function activateAccount(){
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeSecretKey();
        $user->save();
    }

    public function getUsername(){
        $user = $this->_user;
        return $user->username;
    }
}