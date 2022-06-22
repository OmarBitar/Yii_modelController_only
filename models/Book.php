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
            [['release_year', 'is_available_for_loan'], 'integer'],
            [['name', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author' => 'Author',
            'release_year' => 'Release Year',
            'is_available_for_loan' => 'Is Available For Loan',
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
    public function markAsBorrowed()
    {
        $this->is_available_for_loan = (int) false;
        $this->save();
    }
}
