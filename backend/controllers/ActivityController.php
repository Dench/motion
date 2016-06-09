<?php

namespace backend\controllers;

use common\models\Debug;
use common\models\Motion;
use Yii;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex()
    {
        $time = Yii::$app->request->get('time');

        $labels = Motion::monthActivity(1, $time);
        
        $motion = Motion::dayActivity(1, $time);

        $debug = Debug::dayActivity(1, $time);

        return $this->render('index', [
            'time' => $time,
            'labels' => $labels,
            'motion' => $motion,
            'debug' => $debug
        ]);
    }
}
