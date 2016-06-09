<?php
/* @var $this yii\web\View */
/* @var $labels array */
/* @var $data array */
/* @var $time integer */

use dench\chartjs\ChartJs;

$this->title = 'Activity';
?>

<div class="row">
    <div class="col-md-4">
        <?php
        echo \backend\widgets\Calendar::widget([
            'time' => $time,
            'defaultColor' => 'red',
            'labels' => $labels,
        ]);
        ?>
    </div>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Hello</h3>
            </div>
            <div class="box-body">
                <?php
                $color['default'] = '60, 141, 188';
                $color['active'] = '255, 0, 0';
                $datasets = [
                    [
                        'label' => 'Activity',
                        'backgroundColor' => 'rgba('.$color['default'].', 0.4)',
                        'borderColor' => 'rgb('.$color['default'].')',
                        'data' => $data
                    ]
                ];
                $labels = [];
                foreach ($data as $key => $value) {
                    if ($value > 0) {
                        $active = 'rgb('.$color['active'].')';
                    } else {
                        $active = 'rgb('.$color['default'].')';
                    }
                    $datasets[0]['pointBorderColor'][] = $datasets[0]['pointBackgroundColor'][] = $active;
                    $labels[] = $key;
                }

                echo ChartJs::widget([
                    'type' => 'line',
                    'options' => [
                        'height' => 50
                    ],
                    'clientOptions' => [
                        'legend' => [
                            'display' => false
                        ],
                        /*'tooltips' => [
                            'callbacks' => [
                                'title' => new \yii\web\JsExpression("function(){}"),
                                'label' => new \yii\web\JsExpression("function(item, data){ return item.yLabel; }"),
                            ]
                        ],*/
                    ],
                    'data' => [
                        'labels' => $labels,
                        'datasets' => $datasets
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>