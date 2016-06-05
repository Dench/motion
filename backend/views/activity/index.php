<?php
/* @var $this yii\web\View */

$this->title = 'Activity';

?>


<?php
    echo \backend\widgets\Calendar::widget([
        'time' => Yii::$app->request->get('time'),
        'defaultColor' => 'red',
        'labels' => [
            '01.06.2016' => 'Motion',
            '07.06.2016' => 'Motion',
        ],
    ]);
?>