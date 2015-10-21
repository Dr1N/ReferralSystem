<?php

return CMap::mergeArray(
    // extends of main.php
    require(dirname(__FILE__).'/main.php'),
    array(
    	//'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    	'name'=>'Widget :: Referral System',
    	'defaultController' => 'site',
        //'homeUrl'=>array('/site'),
        
    	// application components
    	'components'=>array(
            'request' => array(
                //'homeUrl' => 'track',
                //'baseUrl' => 'track',
            ),
    		// uncomment the following to enable URLs in path-format
    		'urlManager'=>array(
    			'urlFormat'=>'path',
    			'showScriptName'=> false,
                'rules'=>array(
                    'track'=>'',
                    'track/<_c>'=>'<_c>',
                    'track/<_c>/<_a>'=>'<_c>/<_a>',
                    'track/<_c>/<_a>/id/<id:\d+>/code/<code:\w+>'=>'<_c>/<_a>',
                ),
            )
        )
    )
);