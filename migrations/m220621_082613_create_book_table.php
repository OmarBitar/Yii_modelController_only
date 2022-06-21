<?php

use yii\db\Migration;

/**
 * NOTE TO SELF: -
 * this migration was created using the following command: 
 * php yii migrate/create create_book_table --feilds="book_id:string(16):notNull,title:string(512):notNull,description:text"
 * Handles the creation of table `{{%book}}`.
 */
class m220621_082613_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'book_id' => $this->string(16)->notNull(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->text(),
            'is_available' => $this->boolean(),
            'created_at' => $this->integer(11),
            'update_at' => $this->integer(11)
        ]);

        // $this->addPrimaryKey(name, tableName, columns)
        $this->addPrimaryKey('PK_book_id', '{{%book}}', 'book_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
