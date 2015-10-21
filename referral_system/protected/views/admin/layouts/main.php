<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <?php $baseUrl = Yii::app()->request->baseUrl; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?= $baseUrl ?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <!--link href="<?= $baseUrl ?>/css/bootstrap.min.css" rel="stylesheet" />
    <!--link href="<?= $baseUrl ?>/css/bootstrap/bootstrap-theme.css" rel="stylesheet" /-->
    <link href="<?= $baseUrl ?>/css/admin.css" rel="stylesheet" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerScriptFile($baseUrl.'/js/library/bootstrap/bootstrap.min.js');
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/AdminHelper.js');
	?>
    <!--[if lt IE 9]>
        <script src="<?php echo $baseUrl; ?>/js/library/bootstrap/html5shiv.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/library/bootstrap/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	          	</button>
				<a href="/admin" class="navbar-brand"><?php echo CHtml::encode(Yii::app()->name); ?></a>
			</div>
			<nav class="navbar-collapse collapse">
    			<?php $this->widget('zii.widgets.CMenu',array(
    				'items'=>array(
    					array('label'=>'Users', 'url'=>array('user/index'), 'visible'=>!Yii::app()->user->isGuest),
    					array('label'=>'Organizations', 'url'=>array('organization/index'), 'visible'=>!Yii::app()->user->isGuest),
    					array('label'=>'Campaigns', 'url'=>array('campaign/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Payouts', 'url'=>array('payout/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Purchases', 'url'=>array('purchase/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Pages', 'url'=>array('page/index'), 'visible'=>!Yii::app()->user->isGuest),
    					array('label'=>'Countries', 'url'=>array('country/index'), 'visible'=>!Yii::app()->user->isGuest),
    					array('label'=>'Industries', 'url'=>array('industry/index'), 'visible'=>!Yii::app()->user->isGuest),
    					//array('label'=>'Help', 'url'=>array('site/help'), 'visible'=>!Yii::app()->user->isGuest),
    					array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
                        //array('label'=>'Logout', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
    				),
					'htmlOptions' => array(
		            	'class' => 'nav navbar-nav'
					)
    			)); ?>
    	        <p class="navbar-text pull-right">
    	        	<a href="/admin/user/update/id/<?= Yii::app()->user->id; ?>" class="navbar-link" title="My profile"><span class="glyphicon glyphicon-user"></span></a>  &nbsp;
    	        	<a href="/admin/site/logout" class="navbar-link" title="Log out"><span class="glyphicon glyphicon-log-out"></span></a>
    	        </p>
	        </nav>
		</div>
	</header>
    
    <div class="planshet_space">&nbsp;</div> <!-- collapse !!!!!!!!!!!!!!!! -->
    
	<div class="wrap">
    	<div class="container" id="page">
    		<?php if(isset($this->breadcrumbs)):?>
    			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
    				'links'=>$this->breadcrumbs,
    			)); ?>
    		<?php endif?>
    		<?php echo $content; ?>
    		<div class="clear"></div>
    	</div>
	</div>
    
    <div class="footer">
        <div class="container text-center">
            <a href="/admin"><?php echo CHtml::encode(Yii::app()->name); ?></a>
            &copy; 2012-<?php echo date('Y'); ?>
        </div>
    </div>
    
    <script type="text/javascript">
    /*<![CDATA[*/
        var AREA = "admin";
        var CONTROLLER = "<?=Yii::app()->controller->id?>";
        var ACTION = "<?=Yii::app()->controller->action->id?>";
    /*]]>*/
    </script>
</body>
</html>