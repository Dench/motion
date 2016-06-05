<?php

use yii\db\Migration;

/**
 * Handles the creation for table `device`.
 */
class m160603_084049_create_device extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('device', [
            'id' => $this->integer()->notNull(),
            'key' => $this->string(32)->unique()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull()
        ]);
        
        $this->addPrimaryKey('pk-device-id', 'device', 'id');
        
        $this->addForeignKey('fk-device-object_id', 'device', 'object_id', 'object', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-device-object_id', 'device');
                
        $this->dropTable('device');
    }
}
