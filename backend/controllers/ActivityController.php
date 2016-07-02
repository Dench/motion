<?php

namespace backend\controllers;

use common\models\Debug;
use common\models\Motion;
use Yii;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex($id)
    {
        $time = Yii::$app->request->get('time');

        $labels = Motion::monthActivity($id, $time);
        
        $motion = Motion::dayActivity($id, $time);

        $debug = Debug::dayActivity($id, $time);

        return $this->render('index', [
            'time' => $time,
            'labels' => $labels,
            'motion' => $motion,
            'debug' => $debug
        ]);
    }
}
