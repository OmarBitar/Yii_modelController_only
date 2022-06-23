<?php
// documentation for rest only controller 
// https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start#creating-controller
namespace app\controllers;

use app\models\Book;
use Yii;

class BookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->asJson(Book::find()->all());
    }

    public function actionPublish()
    {
        $book = new Book();
        $request = Yii::$app->request;

            $book->attributes = 
            [
                "name"                  => $request->post('name'),
                "author"                => $request->post('author'),
                "release_year"          => $request->post('release_year'),
                "is_available_for_loan" => $request->post('is_available_for_loan')
            ];
        if ($book->validate()) {
            // all inputs are valid
            $book->save();
            return $this->asJson(['created: ',$book]);
        } 
        else {
            // validation failed: $errors is an array containing error messages
            $errors = $book->errors;
            // var_dump($errors);
            return $this->asJson(['ERROR: ',$errors]);
        }
    }
}