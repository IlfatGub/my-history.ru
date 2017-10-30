<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class BehaviorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site', 'user'],
                        'actions' => ['login', 'error', 'reg', 'activate-account', 'send-email', 'reset-password'],
                        'verbs' => ['POST', 'GET'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site', 'user'],
                        'actions' => ['logout', 'index', 'reg'],
                        'roles' => ['?'],
                    ],
                ]
            ]
        ];
    }
}
