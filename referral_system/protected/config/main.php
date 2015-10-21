<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	//'baseUrl'=>'/',
	'name'=>'Referral System',
	'defaultController' => 'site',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.jqGridView.*',
		'ext.upload.*'
	),

	'modules'=>array(
	),

	// application components
	'components'=>array(
        'request' => array(
            'baseUrl' => '',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl' => '/',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=> false,
            'rules'=>array(
                'track'=>'track',
                'admin'=>'',
                //'admin/<_c>'=>'admin/<_c>',
                //'admin/<_c>/<_a>'=>'admin/<_c>/<_a>',
                //'admin/<_c>/<_a>/id/<id:\d+>'=>'<_c>/<_a>',
            ),
            /*'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),*/
		),
		// Use a MySQL database
		'db'=>array(
			'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=miniref_db',
			'emulatePrepare' => true,
			'username' => 'miniref_tanya',
			'password' => 'ZxT?IzdG~6BS',
			'charset' => 'utf8',
            'tablePrefix' => 'rf_',
			//'enableProfiling' => true, // enableProfiling!
		),
		'cache' => array(  
			'class' => 'system.caching.CFileCache'  
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'geoip' => array(
			'class' => 'ext.PcMaxmindGeoIp.PcMaxmindGeoIp',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'twitter' => array(
            'class' => 'ext.yiitwitteroauth.YiiTwitter',
            'consumer_key' => '5KnBZQT1OYtrunM9AsDkzQ',
            'consumer_secret' => 'ZtYYULzIM66o4ahprfXTrtGy5sgb4FN0Z1Nb2lzAJI',
        ),
        'facebook' => array(
   			'class' => 'ext.yii-facebook-opengraph.SFacebook',
    		'appId' => '613147892075615', // needed for JS SDK, Social Plugins and PHP SDK
    		'secret' => '8fd539bcb49666723e38b731088d7ca6', // needed for the PHP SDK
	        //'fileUpload'=>false, // needed to support API POST requests which send files
	        //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
	        //'locale'=>'en_US', // override locale setting (defaults to en_US)
	        //'jsSdk'=>true, // don't include JS SDK
	        //'async'=>true, // load JS SDK asynchronously
	        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
	        //'status'=>true, // JS SDK - check login status
	        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
	        //'oauth'=>true,  // JS SDK - enable OAuth 2.0
	        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
	        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
	        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
	        //'ogTags'=>array(  // set default OG tags
	            //'og:title'=>'MY_WEBSITE_NAME',
	            //'og:description'=>'MY_WEBSITE_DESCRIPTION',
	            //'og:image'=>'URL_TO_WEBSITE_LOGO',
	        //),
    	),
	),
    
	// autoloading behaviors
	'behaviors'=>array(
		'runSiteArea'=>array(
			'class'=>'application.behaviors.ChangeAreaBehavior',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'tanya_nazarchyk@mail.ru',
		'adminName'=>'Referral System',
		'cacheDuration'=>0, // 3600
		'mainSitePatch'=>'../',
		'image'=>array(
				'jpegQuality'=>100,
				'imageX'=>700,
				'imageY'=>600,
				'thumbImageX'=>39,
				'thumbImageY'=>34,
				'imageResize'=>true,
				'imageRatio'=>true,
				'noScript'=>false,
			),
		'user'=>array( // !!!!!!!!!!!!!!!!!! (a-to-do)
			'path'=>'/../uploads/users/',
		),
		'logo'=>array(
			'path'=>'/../uploads/campaigns/',
		),
	),
);