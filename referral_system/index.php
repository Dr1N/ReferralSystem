<?php
$webRoot=dirname(__FILE__);

// If the host equals localhost then switch on the debug mode and include the test configuration
if($_SERVER['HTTP_HOST']=='referral_system'){
    define('YII_DEBUG', true);
    require_once(dirname($webRoot).'/framework/yii.php');
    $configFile=$webRoot.'/protected/config/local.php';
}
// Otherwise  switch off the debug mode and include the real configuration
else { 
    define('YII_DEBUG', false);
    require_once(dirname($webRoot).'/framework/yiilite.php');
    $configFile=$webRoot.'/protected/config/main.php';
}

$app = Yii::createWebApplication($configFile)->runSiteArea('front');