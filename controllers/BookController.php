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
        $request = Yii::$app->request;

        $book = new Book();
        $book->attributes = 
        [
            "name"                  => $request->post('name'),
            "author"                => $request->post('author'),
            "release_year"          => $request->post('release_year'),
            "is_available_for_loan" => $request->post('is_available_for_loan')
        ];
        $book->save();

        return $this->asJson(['created: ',$book]);
    }
}