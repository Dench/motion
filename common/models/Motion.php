<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "motion".
 *
 * @property integer $id
 * @property integer $object_id
 * @property integer $device_id
 * @property integer $time
 *
 * @property Device $device
 * @property Object $object
 */
class Motion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'motion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'device_id', 'time'], 'required'],
            [['object_id', 'device_id', 'time'], 'integer'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['object_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'device_id' => 'Device ID',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
    }

    /**
     * @param $object_id
     * @param $time
     * @return array
     */
    public static function monthActivity($object_id, $time)
    {
        if (empty($time)) $time = time();

        $start = mktime(0, 0, 0, date('n', $time), 0, date('Y', $time));
        $end = mktime(0, 0, 0, date('n', $time), date('t', $time), date('Y', $time)) + 3600*24;

        $query = static::find()->select(['FROM_UNIXTIME(time, "%d.%m.%Y") date', 'COUNT(*) count'])->groupBy('date')->where(['object_id' => $object_id]);

        $query->andWhere(['>', 'time', $start]);
        $query->andWhere(['<', 'time', $end]);

        $temp =  $query->asArray()->all();

        $return = [];

        foreach ($temp as $t) {
            $return[$t['date']] = $t['count'];
        }

        return $return;
    }

    /**
     * @param $object_id
     * @param $time
     * @return array
     */
    public static function dayActivity($object_id, $time)
    {
        if (empty($time)) $time = time();

        $start = mktime(0, 0, 0, date('n', $time), date('j', $time), date('Y', $time));
        
        $end = $start+3600*24;

        $query = static::find()->select(['FROM_UNIXTIME(time, "%k") hour', 'COUNT(*) count'])->groupBy('hour')->where(['object_id' => $object_id]);

        $query->andWhere(['>', 'time', $start]);
        $query->andWhere(['<', 'time', $end]);

        $temp =  $query->asArray()->all();

        $hour = [];

        foreach ($temp as $t) {
            $hour[$t['hour']] = $t['count'];
        }

        $return = [];
        
        for ($i = 0; $i < 24; $i++) {
            $return[$i] = @$hour[$i]+0;
        }

        return $return;
    }
}
