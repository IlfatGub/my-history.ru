<?php
/**
 * Created by PhpStorm.
 * User: Ilfat
 * Date: 29.10.2017
 * Time: 22:58
 */

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
                        'rules' => [
                            [
                                'allow' => true,
                                'controller' => ['site', 'user'],
                                'actions' => ['login', 'error', 'reg', 'activate-account', 'send-email', 'reset-password'],
                                'roles' => ['?'],
                            ],
                            [
                                'controller' => ['site', 'user'],
                                'allow' => true,
                                'actions' => ['logout', 'index', 'reg'],
                                'roles' => ['@'],
                            ],
                        ],
                    ]
                ]
            ]
        ];
    }
}