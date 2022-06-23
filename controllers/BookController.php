<?php
// documentation for rest only controller 
// https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start#creating-controller
namespace app\controllers;

use app\models\Book;

class BookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->asJson(Book::find()->all());
    }
}