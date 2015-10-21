<?php

return CMap::mergeArray(
    // extends of main.php
    require(dirname(__FILE__).'/local.php'),
    require(dirname(__FILE__).'/admin.php'),
    array(
		'components'=>array(
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=referral_system',
				'username' => 'root',
				'password' => '',
			)
        )
   )
);