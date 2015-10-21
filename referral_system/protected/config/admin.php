<?php

return CMap::mergeArray(
    // extends of main.php
    require(dirname(__FILE__).'/main.php'),
    array(
    	//'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    	'name'=>'Admin :: Referral System',
    	'defaultController' => 'user',
        //'homeUrl'=>array('/site'),
        
    	// application components
    	'components'=>array(
    		'user'=>array(
                'loginUrl' => '/admin/site/login',
    		),
            'request' => array(
                //'homeUrl' => 'admin',
                //'baseUrl' => 'admin',
            ),
    		// uncomment the following to enable URLs in path-format
    		'urlManager'=>array(
    			'urlFormat'=>'path',
    			'showScriptName'=> false,
                'rules'=>array(
                    'admin'=>'',
                    'admin/<_c>'=>'<_c>',
                    'admin/<_c>/<_a>'=>'<_c>/<_a>',
                    'admin/<_c>/<_a>/id/<id:\d+>'=>'<_c>/<_a>',
                ),
            )
        )
    )
);