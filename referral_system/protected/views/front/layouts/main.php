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
    <link href="<?= $baseUrl ?>/css/styles.css" rel="stylesheet" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerScriptFile($baseUrl.'/js/library/bootstrap/bootstrap.min.js');
        $cs->registerScriptFile($baseUrl.'/js/library/jquery.form.js');
        $cs->registerScriptFile($baseUrl.'/js/general/SettingHelper.js');
		$cs->registerScriptFile($baseUrl.'/js/front/FrontHelper.js');
        $cs->registerScriptFile($baseUrl.'/js/front/InviteHelper.js');
        $cs->registerScriptFile($baseUrl.'/js/front/PayoutHelper.js');
        $cs->registerScriptFile($baseUrl.'/js/front/CampaignHelper.js');
        $cs->registerScriptFile($baseUrl.'/js/front/PayoutUpdateHelper.js');
        $am = Yii::app()->assetManager; // !!!!!!!!!!!!!!!!!!!!!!!!!!
        $cs->registerCssFile($am->publish(Yii::getPathOfAlias('ext.jqGridView.assets.css').'/jquery-ui-widget.css')); // !!!!!!!!!!!!!!!!!!!!!!!!!!
	?>
    <!--[if lt IE 9]>
        <script src="<?php echo $baseUrl; ?>/js/library/bootstrap/html5shiv.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/library/bootstrap/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container" id="page">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/site/index">
                    <img src="/images/logo.png" class="logo" alt="<?php echo CHtml::encode(Yii::app()->name); ?>" />
                    <?php echo CHtml::encode(Yii::app()->name); ?>
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <?php $pages = Page::getFrontMenuPages('yes'); ?>
                    <?php $organizationId = User::organizationId() ?>
                    <?php $campaigns = $organizationId ? Campaign::getCampaigns($organizationId) : array(); ?>
                    <!-- first menu -->
                    <?php for($i = 0; $i < count($pages); $i++): ?>
                        <?php if($pages[$i]['url'] != 'site/index' && $pages[$i]['visible']): ?>
                            <?php if($pages[$i]['dropdown'] == 'no'): ?>
                                <li><a href="/<?= $pages[$i]['url'] ?>"><?= $pages[$i]['label'] ?></a></li> <!-- class="active" -->
                            <?php else: ?>
                                <li class="dropdown">
                                    <a href="/<?= $pages[$i]['url'] ?>" class="dropdown-toggle" data-toggle="dropdown"><?= $pages[$i]['label'] ?>  <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/<?= $pages[$i]['url'] ?>">All <?= $pages[$i]['label'] ?></a></li>
                                        <li role="presentation" class="divider"></li>
                                        <?php foreach($campaigns as $campaignId => $campaignName): ?>
                                            <li><a href="/<?= str_replace('list', '', $pages[$i]['url']) ?>update/id/<?= $campaignId ?>"><?= $campaignName ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <!-- second menu -->
                    <!--li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Microsoft <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php $pages = Page::getFrontMenuPages(); ?>
                            <?php for($i = 0; $i < count($pages); $i++): ?>
                                <?php if($pages[$i]['visible']): ?>
                                    <?php if($pages[$i]['dropdown'] == 'yes'): ?>
                                        <li class="divider"></li>
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="/<?= $pages[$i]['url'] ?>"><?= $pages[$i]['label'] ?></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/<?= $pages[$i]['url'] ?>">All <?= $pages[$i]['label'] ?></a></li>
                                                <li><a href="#">Campaigns#1</a></li>
                                                <li><a href="#">Campaigns#2</a></li>
                                            </ul>
                                        </li>	
                                    <?php else: ?>
                                        <li><a href="/<?= $pages[$i]['url'] ?>"><?= $pages[$i]['label'] ?></a></li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </ul>
                    </li-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="/user/profile" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo User::avatar() ? User::avatar() : '/images/user.png'; ?>" class="logo" alt="<?php echo User::fullName(); ?>" />
                            <span class="hidden-md hidden-sm inline">
                                <?php echo User::fullName(); ?> <b class="caret"></b>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if(Yii::app()->user->isGuest): ?>
                                <li><a href="/">Login</a></li>
                            <?php else: ?>
                                <li><a href="/user/profile">User Settings</a></li>
                                <li><a href="/user/update">Update Profile</a></li>
                                <li><a href="/user/changePassword">Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="/site/logout">Logout</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
		<!--div id="mainmenu">
        <?php echo $baseUrl; ?>
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>Page::getFrontMenuPages(),
			)); ?>
		</div-->
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs
			)); ?>
		<?php endif?>
		<?php echo $content; ?>
        <br />
        <div class="bottom-menu text-center">
            <ul class="list-unstyled inline">
                <?php $pages = Page::getFrontMenuPages(null, 'yes'); ?>
                <?php for($i = 0; $i < count($pages); $i++): ?>
                    <li><a href="/<?= $pages[$i]['url'] ?>"><?= $pages[$i]['label'] ?></a></li>
                <?php endfor; ?>
                <li>
                    <a href="/"><?php echo CHtml::encode(Yii::app()->name); ?></a>
                    &copy; 2012-<?php echo date('Y'); ?>
                </li>
            </ul>
        </div>
	</div>
    <script type="text/javascript">
    /*<![CDATA[*/
        var AREA = "front";
        var CONTROLLER = "<?=Yii::app()->controller->id?>";
        var ACTION = "<?=Yii::app()->controller->action->id?>";
    /*]]>*/
    </script>
</body>
</html>