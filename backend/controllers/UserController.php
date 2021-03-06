<?php
namespace backend\controllers;

use app\models\RegForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class UserController extends BehaviorController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'reg'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'reg'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $string = '';
        $query = User::find();
        if(!empty(Yii::$app->request->post())){
            $string = Yii::$app->request->post('string');
            $query->where(['like', 'username', $string]);
        }

        $model = $query->all();

        return $this->render('index', [
            'model' =>  $model,
            'string' => $string,
        ]);
    }

}
