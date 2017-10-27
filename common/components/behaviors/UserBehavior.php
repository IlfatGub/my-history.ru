<?php
namespace common\components\behaviors;

use common\models\User;
use yii\db\ActiveRecord;

class UserBehavior extends \yii\base\Behavior
{

    public $statusList =    [User::STATUS_ACTIVE => 'Активный',User::STATUS_DELETED => 'Заблокирован'];
    public $roleList =      [User::USER_ROLE_ADMIN => 'Администратор', User::USER_ROLE_DEFAULT => 'Пользователь'];

    /**
     * @var string the attribute that will receive timestamp value
     * Set this property to false if you do not want to record the creation time.
     */
    public $statusAttribute = 'status';
    /**
     * @var string the attribute that will receive timestamp value.
     * Set this property to false if you do not want to record the update time.
     */
    public $roleAttribute = 'role';


    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }


    public function getStatusList() {
        return $this->statusList;
    }

    public function getStatusName() {
        $list = self::getStatusList();
        return $list[$this->owner->{$this->statusAttribute}];
    }

    public function getRoleList() {
        return $this->roleList;
    }

    public function getRoleName() {
        $list = self::getRoleList();
        return $list[$this->owner->{$this->roleAttribute}];
    }

    /*
     * EVENT_BEFORE_INSERT
     */
    public function beforeInsert(){
        $this->owner->{$this->statusAttribute} = User::STATUS_ACTIVE;
        $this->owner->{$this->roleAttribute} = User::USER_ROLE_DEFAULT;
    }
}