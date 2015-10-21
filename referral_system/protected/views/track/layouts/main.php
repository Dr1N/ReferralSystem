<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <title>Tracking</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/track.css" />
    <?php if (isset($_GET['example'])): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/track-small.css" />
    <?php endif; ?>
	<?php
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/WidgetHelper.js');
        
        if (Yii::app()->user->isGuest):
    		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/general/RegisterHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/general/LoginHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/general/PasswordHelper.js');
        else:
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/ProfileHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/MailHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/FacebookHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/TwitterHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/LinkHelper.js');
            //$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/RewardsHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/track/PayoutHelper.js');
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/library/zeroclipboard/ZeroClipboard.js');
        endif;
      
    	$am = Yii::app()->assetManager;
    	
    	$cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/ui.jqgrid.css'));
    	$cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/jquery-ui-widget.css'));
    	//$cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/ui.multiselect.css'));
    
    	$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/grid.locale-en.js'));
    	$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/jquery.jqGrid.min.js'));
    	//$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/jquery-ui-custom.min.js'));
    	$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/ui.multiselect.js'));
    	$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js.jqgrid').'/grid.jqueryui.js'));
    	$cs->registerScriptFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.js').'/grid.build.js'));
	?>
</head>
<body>
    <div id="backing"></div>
    <div id="container">
        <div id="tabs">
            <?php echo $content; ?>
        </div>
    </div>
	<script type="text/javascript">
        /*<![CDATA[*/
            var AREA = "track";
        /*]]>*/
    </script>
</body>
</html>