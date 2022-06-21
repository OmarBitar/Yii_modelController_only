<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property string $book_id
 * @property string $title
 * @property string|null $description
 * @property int|null $is_available
 * @property int|null $created_at
 * @property int|null $update_at
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'title'], 'required'],
            [['description'], 'string'],
            [['is_available', 'created_at', 'update_at'], 'integer'],
            [['book_id'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 512],
            [['book_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'title' => 'Title',
            'description' => 'Description',
            'is_available' => 'Is Available',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }
}
