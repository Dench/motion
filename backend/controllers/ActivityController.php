<?php

namespace backend\controllers;

use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
