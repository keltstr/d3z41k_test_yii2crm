<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
     'mail' => [
        'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.mail.ru',
            'username' => 'dd@animmonion.ru',
            'password' => '61zm0_n1xxx',
            'port' => '465',
            'encryption' => 'ssl',
            ],
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
     
		/*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                
                
                '<action>'=>'site/<action>',
            ],
        ], 
         'assetManager' => [
             'basePath' => '@webroot/assets',
             'baseUrl' => '@web/assets'
        ],  
        'request' => [
            'baseUrl' => ''
        ]*/
    ],
    'params' => $params,
];
