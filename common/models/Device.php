<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property string $key
 * @property integer $object_id
 * @property integer $time
 *
 * @property Object $object
 * @property Motion[] $motions
 */
class Device extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'key', 'object_id'], 'required'],
            [['id', 'object_id', 'time'], 'integer'],
            [['key'], 'string', 'max' => 32],
            [['key'], 'unique'],
            [['time'], 'default', 'value' => 0],
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
            'key' => 'Key',
            'object_id' => 'Object ID',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotions()
    {
        return $this->hasMany(Motion::className(), ['device_id' => 'id']);
    }
}
