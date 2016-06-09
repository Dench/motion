<?php

namespace backend\widgets;

class Calendar extends \yii\bootstrap\Widget
{
    public $time;

    public $defaultColor = 'primary';

    public $labels;
    
    public function run()
    {
        if (empty($this->time)) $this->time = time();
        
        $M = date('n', $this->time);
        $Y = date('Y', $this->time);

        $start_month = mktime(0, 0, 0, $M, 1, $Y);

        $w =  date('w', $start_month);

        $t =  date('t', $start_month);

        $from =  (1-$w > 0) ? -6 : 1-$w;
        $to = $t+7-($t-$from)%7;

        $days = [];
        
        for ($i = $from; $i < $to; $i++) {
            $start_day = $start_month + $i*3600*24;
            if ($M == date('n', $start_day)) {
                $other = 0;
            } else {
                $other = 1;
            }
            if (date('j-n', $this->time) == date('j-n', $start_day)) {
                $active = 1;
            } else {
                $active = 0;
            }
            if (date('j-n', time()) == date('j-n', $start_day)) {
                $now = 1;
            } else {
                $now = 0;
            }
            $date = date('d.m.Y', $start_day);
            $label = [];
            if (isset($this->labels[$date])) {
                if (is_array($this->labels[$date])) {
                    foreach ($this->labels[$date] as $l) {
                        if (!is_array($l)) {
                            $l = [
                                'color' => $this->defaultColor,
                                'value' => $l
                            ];
                        }
                        $label[] = [
                            'color' => 'bg-' . $l['color'],
                            'value' => $l['value']
                        ];
                    }
                } else {
                    $this->labels[$date] = [
                        'color' => $this->defaultColor,
                        'value' => $this->labels[$date]
                    ];
                    $label[] = [
                        'color' => 'bg-' . $this->labels[$date]['color'],
                        'value' => $this->labels[$date]['value']
                    ];
                }
            }
            $days[] = [
                'value' => date('j', $start_day),
                'date' => $date,
                'time' => $start_day,
                'other' => $other,
                'active' => $active,
                'now' => $now,
                'label' => $label
            ];
        }

        //$start = $start_month + $from*3600*24; // Начало календаря
        //$end = $start_month + $to*3600*24-1; // Конец календаря
        
        $next = $start_month + $t*3600*24;
        
        $before = $start_month - 3600*24;
        
        return $this->render('calendar', [
            'days' => $days,
            'month' => date('F', $this->time),
            'year' => $Y,
            'next' => $next,
            'before' => $before
        ]);
    }
}
