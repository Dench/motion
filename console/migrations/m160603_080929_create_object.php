<?php

use yii\db\Migration;

/**
 * Handles the creation for table `object`.
 */
class m160603_080929_create_object extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('object', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-object-user_id', 'object', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-object-user_id', 'object');
        
        $this->dropTable('object');
    }
}
