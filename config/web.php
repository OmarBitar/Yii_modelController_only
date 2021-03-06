<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4V3UgEutJ9pAYz6KKmsid4yL-fVgfjOM',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        // routing w/ urlManager docs: https://www.yiiframework.com/doc/guide/2.0/en/runtime-routing#url-formats
        'urlManager' => [
            'enablePrettyUrl' => false,
            // since line above is disabled. URL looks like this: /index.php?r=book
            'showScriptName' => false,
            // make sure to set pluralize to false if you wish to use 'book' instead of 'books' in URL
            // https://stackoverflow.com/a/34076499/11379938
            'rules' => [
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'member'],
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'book', 'pluralize'=>false],
                // 'GET loans' => 'loan/index', // points to 'actionIndex()' in LoanController
                // 'POST loans' => 'loan/borrow'// points to 'actionBorrow()' in LoanController
                // so now post will look as follows: 
                // URL: http://localhost:8080/index?r=loan/borrow
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
