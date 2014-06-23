<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Blog Demo',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.YiiFacebook.*'
	),
	'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123456',
        ),
    ),

	'defaultController'=>'site',
	'homeUrl'=>array('site/index'),
	
	// application components
	'components'=>array(
		'facebook' => array(
         'class' => 'application.extensions.YiiFacebook.Facebook',
         
      	),
		/*'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;port=3306;dbname=manage_image',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
			'enableParamLogging' => true,
		),
		'log'=>array(
		    'class'=>'CLogRouter',
		    'routes'=>array( 
		      array(
		        'class'=>'CFileLogRoute',
		        'levels'=>'trace,log',
		        'categories' => 'system.db.CDbCommand',
		        'logFile' => 'db.log',
		      ),
		), 
		), 
		'session' => array(
            'class' => 'system.web.CDbHttpSession',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php')
);