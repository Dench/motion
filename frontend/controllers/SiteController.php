<?php
namespace frontend\controllers;

use common\models\Debug;
use common\models\Device;
use common\models\Motion;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @param $id
     * @return integer
     */
    public function actionIndex($id)
    {
        $time = time();

        $device = Device::findOne($id);
        $device->time = $time;
        $device->save();

        if (!empty(Yii::$app->request->get('motion'))) {
            $motion = explode('.', Yii::$app->request->get('motion'));

            foreach ($motion as $d) {
                $motion = new Motion();
                $motion->object_id = $device->object_id;
                $motion->device_id = $id;
                $motion->time = $d*60;
                $motion->save();
            }
        }

        if (!empty(Yii::$app->request->get('debug'))) {
            $debug = explode('|', Yii::$app->request->get('debug'));

            foreach ($debug as $d) {
                $debug = new Debug();
                $debug->data = urldecode($d);
                $debug->device_id = $id;
                $debug->save();
            }
        }

        $return['time'] = round($time/60);

        //$return['fs'] = true;
        /*$return['write'] = [
            'filename' => '/data/12345.txt',
            'data' => '24434523.24434524'
        ];*/
        //$return['reset'] = true;

        return json_encode($return);
    }
}
