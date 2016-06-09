<?php

namespace backend\controllers;

use common\models\Motion;
use Yii;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex()
    {
        $time = Yii::$app->request->get('time');

        $labels = Motion::monthActivity(1, $time);
        
        $data = Motion::dayActivity(1, $time);

        

        return $this->render('index', [
            'time' => $time,
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
