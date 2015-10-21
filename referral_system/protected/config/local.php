<?php

return CMap::mergeArray(
    // extends of main.php
    require(dirname(__FILE__).'/main.php'),
    array(
		'modules'=>array(
			// enable the Gii tool
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'nfyz',
				'ipFilters'=>array('127.0.0.1','::1'),
			),
		),
		// application components
		'components'=>array(
			// use a MySQL database
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=referral_system',
				'username' => 'root',
				'password' => '',
				//'charset' => 'utf8',
                //'tablePrefix' => 'rf_',
			),
			'log'=>array(
				'routes'=>array(
					/*array(
						'class'=>'CWebLogRoute',
						'levels'=>'error, warning, trace, info',
						'categories'=>'system.db.CDbCommand, php'
					),*/
					array(
						'class'=>'CProfileLogRoute',
					),
					/*// to show log messages on web pages
					array(
						'class'=>'CWebLogRoute',
					),
					*/
				),
			),
		),
		'params'=>array(
			'cacheDuration'=>0,
			'mainSitePatch'=>'/home/referral_system/www/',
		),
    )
);