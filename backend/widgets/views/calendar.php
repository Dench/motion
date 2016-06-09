<?php
use yii\helpers\Url;
?>

<div class="box">
    <div class="box-header with-border text-center">
        <h3 class="box-title"><?= $month ?>, <?= $year ?></h3>
        <div class="box-tools pull-right">
            <a href="<?= Url::to(['activity/index', 'time' => $next]) ?>" class="btn btn-default btn-sm">
                <i class="fa fa-chevron-right"></i>
            </a>
        </div>
        <div class="box-tools box-tools-left pull-left">
            <a href="<?= Url::to(['activity/index', 'time' => $before]) ?>" class="btn btn-default btn-sm">
                <i class="fa fa-chevron-left"></i>
            </a>
        </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-bordered calendar">
            <thead>
                <tr>
                    <th>Пн</th>
                    <th>Вт</th>
                    <th>Ср</th>
                    <th>Чт</th>
                    <th>Пт</th>
                    <th>Сб</th>
                    <th>Вс</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    foreach ($days as $k => $v) {
                        if ($k%7 == 0) echo '</tr><tr>';
                        echo '<td><a href="' . Url::to(['activity/index', 'time' => $v['time']]) . '"';
                        if ($v['other'] || $v['active'] || $v['now']) {
                            echo ' class="';
                            if ($v['other']) echo 'other ';
                            if ($v['active']) echo 'active ';
                            if ($v['now']) echo 'now ';
                            echo '"';
                        }
                        echo '>' . $v['value'];
                        if (!empty($v['label'])) {
                            foreach ($v['label'] as $l) {
                                echo '<div class="label ' . $l['color'] . '" data-toggle="tooltip" title="' . $l['value'] . '"> </div>';
                            }
                        }
                        echo '</a></td>';
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .calendar td {
        width: calc(100% / 7);
    }
    .calendar>tbody>tr>td {
        padding: 0;
        border: 1px solid #eeeeee;
    }
    .calendar td a {
        display: block;
        padding: 5% 8% 45% 8%;
        text-align: right;
        font-size: 17px;
        cursor: pointer;
        color: #000;
        background: #fff;
    }
    .calendar a.other {
        color: #CCC;
    }
    .calendar a.active,
    .calendar a.active:hover,
    .calendar td a:hover {
        background: #f5f5f5;
    }
    .calendar a.now,
    .calendar a.now:hover {
        background: #ecf0f5;
    }
    .calendar a .label {
        float: left;
        margin: 1%;
        padding: 10%;
        border-radius: 50%;
        width: 0;
        height: 0;
    }
    .box-header>.box-tools-left {
        right: auto;
        left: 10px;
    }
</style>