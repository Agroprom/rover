<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\RoverForm;
use app\models\Rover;
use app\models\QuantyForm;
use yii\base\Model;

class RoverController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionInputData($quanty, $max_x, $max_y) {
        $quanty = abs(intval($quanty));
        $max_x = abs(intval($max_x));
        $max_y = abs(intval($max_y));
        $models = [];
        for ($i = 0; $i < $quanty; $i++) {
            $model = new RoverForm();
            $models[] = $model;
        }

        if (Model::loadMultiple($models, Yii::$app->request->post()) &&
                Model::validateMultiple($models)) {
            $rovers = [];
            Rover::setBounds($max_x, $max_y);
            foreach ($models as $model) {
                $rover = new Rover($model->x, $model->y, $model->heading);
                $rover->executeCommand($model->command_line);
                array_push($rovers, $rover);
            }
            return $this->render('view-rovers', compact('rovers'));
        }
        return $this->render('input-data', compact('models', 'quanty'));
    }

    public function actionIndex() {
        $model = new QuantyForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->redirect(['input-data',
                'quanty' => $model->quanty,
                'max_x' => $model->max_x,
                'max_y' => $model->max_y,
            ]);
        }
        return $this->render('index', compact('model'));
    }
    
    public function actionShowHelp(){
        return $this->renderAjax('show-help');
    }

}
