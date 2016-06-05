<?php

use yii\db\Migration;

/**
 * Handles the creation for table `debug`.
 */
class m160603_102631_create_debug extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('debug', [
            'id' => $this->primaryKey(),
            'device_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull(),
            'data' => $this->text()
        ]);

        $this->addForeignKey('fk-debug-device_id', 'debug', 'device_id', 'device', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-debug-device_id', 'debug');
        
        $this->dropTable('debug');
    }
}
