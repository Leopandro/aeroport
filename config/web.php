<?php
use \kartik\datecontrol\Module;
$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'CRM',
	'language' => 'ru-RU',
	'name' => 'Такси аэропорт УФА',
	'sourceLanguage' => 'en-US',
	'timeZone' => 'Europe/Moscow',
	'basePath' => dirname(__DIR__),
	'defaultRoute' => '/site/index',
	'bootstrap' => ['log'],
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableConfirmation' => false,
			'enableRegistration' => false,
			'enablePasswordRecovery' => true,
			'admins' => ['admin'],
			'modelMap' => [
				'User' => 'app\models\User',
				'UserSearch' => 'app\models\UserSearch',
				'Profile' => 'app\models\Profile',
				'LoginForm' => 'app\models\LoginForm',
			],
			'controllerMap' => [
				'security' => 'app\controllers\SecurityController',
				'admin' => 'app\controllers\AdminController'
			],
		],
		'gridview' =>  [
			'class' => '\kartik\grid\Module',
			// enter optional module parameters below - only if you need to
			// use your own export download action or custom translation
			// message source
			// 'downloadAction' => 'gridview/export/download',
			// 'i18n' => []
		]
	],
	'components' => [
		'view' => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@app/views/user'
				],
			],
		],
		'assetManager' => [
			'bundles' => [
				'vova07\imperavi\Asset' => [
					//'sourcePath' => null,
					'js' => [
						'js/redactor.min.js' => '../../js/redactor.min.js'
					],
				],
				'dmstr\adminlte\Asset' => [
					'css' => [
						'css/AdminLTE.min.css' => '@web/dist/css/skins/AdminLTE.css'
					]
				]
			]
		],
		'i18n' => [
			'translations' => [
				'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					//'basePath' => '@app/messages',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'app' => 'app.php',
						'app/error' => 'error.php',
						'app/person' => 'person.php'
					],
				],
			],
		],
		'urlManager' => [
			'baseUrl' => '/',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
			],
		],
		'imap' => [
			'class' => '\roopz\imap\Imap',
			'connection' => [
				'imapPath' => '{imap.yandex.ru:993/imap/ssl}INBOX',
				'imapLogin' => '',
				'imapPassword' => '',
				'serverEncoding'=>'encoding' // utf-8 default.
			],
		],

		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'dateFormat' => 'php:d.m.Y',
			'datetimeFormat' => 'php:d.m.Y H:i',
			'timeFormat' => 'php:H:i:s',
			'nullDisplay' => ''
		],
		'request' => [
			'baseUrl' => '',
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'FOKv4eLGP1g6_rs2inVhHL-MubUPSoMO',
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
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			/*'useFileTransport' => true,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.yandex.ru',
				'username' => '',
				'password' => '',
				'port' => '587',
				'encryption' => 'tls',
			],*/
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
		'db' => require(__DIR__ . '/db.php'),
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];
//    $config['components']['assetManager']['forceCopy'] = true;
	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
//		'allowedIPs' => ['*']
        'allowedIPs' => ['127.0.0.1', '::1']
	];
}

return $config;
