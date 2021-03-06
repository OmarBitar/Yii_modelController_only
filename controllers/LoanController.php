<?php

namespace app\controllers;

use app\models\Book;
use app\models\Loan;
use app\models\Member;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class LoanController extends \yii\rest\Controller
{
    public $enableCsrfValidation = false;
    
    protected function verbs()
    {
        return [
            'index'  => ['GET'],
            'view'  => ['GET'],
            'borrow'  => ['POST'],
        ];
    }

    public function behaviors()
    {
        return [
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::className(),
                'except' => ['index'],
                'authMethods' => [
                    \yii\filters\auth\HttpBearerAuth::class,
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $loans = Loan::find()->all();

        return $this->asJson($loans);
    }

    public function actionView($id) 
    {
        return $this->asJson(Loan::find()->where(['id'=>$id])->one());
    }

    private function errorResponse($message)
    {
                
        // set response code to 400
        \Yii::$app->response->statusCode = 400;

        return $this->asJson(['error' => $message]);
    }

    public function actionBorrow()
    {
        // docs on requestParameters: https://www.yiiframework.com/doc/guide/2.0/en/runtime-requests
        $request = \Yii::$app->request;

        $bookId = $request->post('book_id'); // matches the params in postman
        $book = Book::findOne($bookId);

        if (is_null($book)) {
            return $this->errorResponse('Could not find book with provided ID');
        }

        if (!$book->is_available_for_loan) {
            return $this->errorResponse('This book is not available for loan');
        }

        $borrowerId = $request->post('member_id'); // matches the params in postman

        if (is_null(Member::findOne($borrowerId))) {
            return $this->errorResponse('Could not find member with provided ID');
        }

        $loan = new Loan();
        $returnDate = strtotime('+ 1 month');
        $loan->attributes =
            [
                'book_id'           => $bookId,
                'borrower_id'       => $borrowerId,
                'borrowed_on'       => date('Y-m-d H:i:s'),
                'to_be_returned_on' => date('Y-m-d H:i:s', $returnDate)
            ];

        $book->markAsBorrowed();
        $loan->save();

        return $this->asJson(
            $loan
        );
    }
}