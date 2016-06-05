<?php

use yii\db\Migration;

/**
 * Handles the creation for table `motion`.
 */
class m160603_085250_create_motion extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('motion', [
            'id' => $this->primaryKey(),
            'object_id' => $this->integer()->notNull(),
            'device_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-motion-object_id', 'motion', 'object_id', 'object', 'id', 'CASCADE');

        $this->addForeignKey('fk-motion-device_id', 'motion', 'device_id', 'device', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-motion-object_id', 'motion');
        
        $this->dropForeignKey('fk-motion-device_id', 'motion');
        
        $this->dropTable('motion');
    }
}
