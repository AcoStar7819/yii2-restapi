<?php

namespace app\controllers\api;

use app\models\Vacancy;
use Yii;
use yii\rest\ActiveController;

class VacancyController extends ActiveController
{
    public $modelClass = 'app\models\Vacancy';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];
    public $createScenario = Vacancy::SCENARIO_CREATE;

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ]
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['pagination']['defaultPageSize'] = 10;
        unset($actions['create']);
        return $actions;
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $exception;
        }
    }

    public function actionCreate()
    {
        $response = [
            'success' => false
        ];

        $model = new Vacancy();
        $model->scenario = Vacancy::SCENARIO_CREATE;
        $model->attributes = Yii::$app->request->post();

        if ($model->validate() && $model->save()) {
            $response['success'] = true;
            $response['id'] = $model->id;
        } else {
            $response['errors'] = $model->errors;
        }

        return $response;
    }
}