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
}
