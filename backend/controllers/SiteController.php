<?php

namespace backend\controllers;

use app\models\RegForm;
use common\models\AccountActivate;
use Yii;
use yii\base\InvalidParamException;
use yii\bootstrap\Html;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use app\models\LoginForm;
use common\models\User;
use common\models\SendEmailForm;
use app\models\ResetPasswordForm;

/**
 * Site controller
 */
class SiteController extends BehaviorController
{


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
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $loginWithEmail = Yii::$app->params['loginWithEmail'];

        $model = $loginWithEmail ? new LoginForm(['scenario' => 'loginWithEmail']) : new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionReg()
    {
        $emailActivation = Yii::$app->params['emailActivation'];
        $model = $emailActivation ? new RegForm(['scenario' => 'emailActivation']) : new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->reg()) {
                if ($user->status === User::STATUS_ACTIVE) {
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                } else {
                    if ($model->sendActivationEmail($user)) {
                        Yii::$app->session->setFlash('success', 'Писмо отправлено на емайл
                            . <strong>' . Html::encode($user->email) . '</strong> (проверьте папку спам)
                            . ' . Yii::$app->urlManager->createAbsoluteUrl(
                                [
                                    '/site/activate-account',
                                    'key' => $user->secret_key
                                ]
                            ));
                    } else {
                        Yii::$app->session->setFlash('error', 'Ошибка. Писмо не отправлено');
                        Yii::error('Ошибка отправки письма');
                    }
                    return $this->refresh();
                }
            } else {
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            }
        }

        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }

    public function actionActivateAccount($key)
    {
        try {
            $user = new AccountActivate($key);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount()):
            Yii::$app->session->setFlash('success', 'Активация прошла успешно.  <strong>' . Html::encode($user->email) . '</strong> теперь вы с нами!!!');
        else:
            Yii::$app->session->setFlash('error', 'Ошибка активации');
            Yii::error('Ошибка при активации');
        endif;

        return $this->redirect(Url::to('/site/login'));
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    Yii::$app->session->setFlash('warning', 'Письмо отправлено');
                    $this->goHome();
                } else {
                    Yii::$app->getSession()->setFlash('warning', 'Пароль не возможно сбросить');
                }
            }
        }

        return $this->render('sendEmail', [
            'model' => $model
        ]);
    }

    public function actionResetPassword($key)
    {
        try {
            $model = new ResetPasswordForm($key);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Пароль изменен.');
            }
        }

        return $this->redirect('resetPassword', [
            'model' => $model
        ]);
    }
}

