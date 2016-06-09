<?php
/* @var $this yii\web\View */
/* @var $labels array */
/* @var $motion array */
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
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Active hourly</h3>
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
                        'data' => $motion
                    ]
                ];
                $labels = [];
                foreach ($motion as $key => $value) {
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
                    ],
                    'data' => [
                        'labels' => $labels,
                        'datasets' => $datasets
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Debug</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div id="debug">
                    <?php
                    foreach ($debug as $key => $value) {
                        if (strpos($value['data'], 'Wi-Fi') ||
                            strpos($value['data'], 'Timeout') ||
                            strpos($value['data'], 'failed') ||
                            strpos($value['data'], 'ESP8266')) {
                            $class = ' class="red"';
                        } elseif (strpos($value['data'], 'Motion')) {
                            $class = ' class="ok"';
                        } elseif (strpos($value['data'], 'Up')) {
                            $class = ' class="up"';
                        } else {
                            $class = '';
                        }
                        echo '<div'.$class.'>'.date('H:i:s', $value['time']).' --- '.$value['data'].'</div>';
                    }
                    ?>
                </div>

                <style>
                    #debug .red {
                        color: red;
                    }
                    #debug .ok {
                        color: green;
                    }
                    #debug .up {
                        color: blue;
                    }
                </style>
            </div>
        </div>
    </div>
</div>