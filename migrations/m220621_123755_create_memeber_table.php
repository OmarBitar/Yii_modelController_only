<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%memeber}}`.
 */
class m220621_123755_create_memeber_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%memeber}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'started_on' => $this->dateTime()->defaultValue(date('Y-m-d H:i:s'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%memeber}}');
    }
}
