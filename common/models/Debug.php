<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "debug".
 *
 * @property integer $id
 * @property integer $device_id
 * @property integer $time
 * @property string $data
 *
 * @property Device $device
 */
class Debug extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'debug';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['time'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id'], 'integer'],
            [['data'], 'string'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Device ID',
            'time' => 'Time',
            'data' => 'Data',
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
     * @param $object_id
     * @param $time
     * @return array
     */
    public static function dayActivity($device_id, $time)
    {
        if (empty($time)) $time = time();

        $start = mktime(0, 0, 0, date('n', $time), date('j', $time), date('Y', $time));

        $end = $start+3600*24;

        $query = static::find()->where(['device_id' => $device_id]);

        $query->andWhere(['>', 'time', $start]);
        $query->andWhere(['<', 'time', $end]);

        return $query->orderBy(['id' => SORT_DESC])->asArray()->all();
    }
}
