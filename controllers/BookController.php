<?php

namespace app\controllers;
use yii\web\Controller;

class BookController extends Controller
/*
since name of class is 'BookController'
then the id is going to be book; which is derived
from the class name
alternativley;
if class name is 'MyBookController' then id 
will be: my-book
*/
{
    public function actionIndex()
    /*
    id is 'index'
    alternativley if class name is 'actionMyIndex';
    then id is 'my-index'
    */
    {
        return 'hello world';
    }

}