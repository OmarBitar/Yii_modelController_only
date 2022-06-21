<?php
// documentation for rest only controller 
// https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start#creating-controller
namespace app\controllers;

class BookController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Book';
}