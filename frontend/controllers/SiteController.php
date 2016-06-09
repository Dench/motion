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

        $motion = explode('.', Yii::$app->request->get('motion'));

        $device = Device::findOne($id);

	    $begin1 = mktime(0, 0, 0, date('n', $time), date('j', $time), date('Y', $time));

        $begin2 = mktime(0, 0, 0, date('n', $device->time), date('j', $device->time), date('Y', $device->time));

        $device->time = $time;
        $device->save();

        foreach ($motion as $d) {
            $motion = new Motion();
            $motion->object_id = $device->object_id;
            $motion->device_id = $id;
            $motion->time = $begin2+$d*60;
            $motion->save();
        }

        $debug = explode('|', Yii::$app->request->get('debug'));

	    foreach ($debug as $d) {
            $d = str_replace('_', ' ', $d);
            $d = str_replace('@', '@ ', $d);
            $debug = new Debug();
            $debug->data = $d;
            $debug->device_id = $id;
            $debug->save();
        }

        $minute = $time-$begin1;

        $return['time'] = round($minute/60);

        /*$return['setting'] = [
            'hello' => '12345'
        ];*/

        return json_encode($return);
    }
}
