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
class Debug extends \yii\db\ActiveRecord
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
}
