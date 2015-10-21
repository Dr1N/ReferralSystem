<link href="<?= $baseUrl ?>/css/campaign.css" rel="stylesheet" />
<?php
/* @var $this CampaignController */
/* @var $model Campaign */

if (User::hasSociety()):
    $this->menu=array(
    	//array('label'=>'List Campaign', 'url'=>array('list'), 'linkOptions' => array('class' => 'btn btn-primary')),
    	array('label'=>'Add Campaign', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-success')),
    );
endif;
?>

<h1>Manage Campaigns</h1>

<?php if (User::hasSociety()): ?>

    <?php foreach($campaigns as $i => $campaign): ?>
        <!-- campaign -->
        <div class="row border-row campaign">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <h3><?php echo $campaign->name ?></h3>
                <a href="<?php echo $campaign->site_url ?>" target="_blank"><?php echo $campaign->site_url ?></a><br />
                <small>Active: <?php echo $campaign->active ?></small>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="pull-right">
                    <img src="/images/analytics.png" />
                </div>
            </div>
            <!--div class="clearfix visible-xs"></div-->
            <div class="hidden-xs col-sm-4 col-md-4"> <!-- col-xs-6 -->
                <ul class="list-unstyled">
                    <li><small>Advocates Bonus: $<?php echo $campaign->setting->referral_prize ?></small></li>
                    <li><small>Offer Value: $<?php echo $campaign->setting->recipient_prize ?></small></li>
                    <li><small>Min Payout Request: $<?php echo $campaign->setting->min_payout ?></small></li>
                </ul>
            </div>
        </div>
        <!-- info -->
        <div class="row button-row campaign">
            <div class="col-md-4">
                <a href="/campaign/update/id/<?php echo $campaign->id ?>" class="btn btn-default btn-lg">
                    <div class="row">
                        <div class="col-xs-3">Setings</div>
                        <div class="col-md-4 col-md-offset-2">
                            <ul class="list-unstyled">
                                <li><small>Enable mail: <?php echo $campaign->setting->enable_mail ?></small></li>
                                <li><small>Enable facebook: <?php echo $campaign->setting->enable_facebook ?></small></li>
                                <li><small>Enable twitter: <?php echo $campaign->setting->enable_twitter ?></small></li>
                                <li><small>Enable link: <?php echo $campaign->setting->enable_link ?></small></li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/campaign/users/id/<?php echo $campaign->id ?>" class="btn btn-success btn-lg">
                    <div class="row">
                        <div class="col-xs-3">Advocates</div>
                        <div class="col-md-4 col-md-offset-2">
                            <ul class="list-unstyled">
                                <li><small>Advocates: <?php echo CampaignUser::getUserAmount($campaign->id)?></small></li>
                                <li><small>Shares: ????</small></li>
                                <li><small>Clicks: <?php echo CampaignClick::getClicksAmount($campaign->id); ?></small></li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/payout" class="btn btn-info btn-lg">
                    <div class="row">
                        <div class="col-xs-3">Payouts</div>
                        <div class="col-md-4 col-md-offset-2">
                            <ul class="list-unstyled">
                                <li><small>Clicks: <?php echo CampaignClick::getClicksAmount($campaign->id); ?></small></li>
                                <li><small>Purchases: <?php echo CampaignPurchase::getPurchaseAmount($campaign->id); ?></small></li>
                                <li><small>Payouts: $<?php echo CampaignPurchase::getPurchaseTotal($campaign->id); ?></small></li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
    
    <!-- -----------------------------------------------
    <?php $form=$this->beginWidget('CActiveForm'); ?>
    
    <?php $this->widget('ext.jqGridView.jqGridView', array(
    	'module' => 'campaign',
    	'elementId' => 'list',
    	'buttonSearch' => 'grid-search',
    	'contentId' => 'content',
    	'parameters' => array(
    		'sortname' => 't.name',
    		'sortorder' => 'ASC',
    		'caption' => 'Campaigns',
    		'shrinkToFit' => true,
    	),
    	'columns' => array(
    		jqCaption::caption($form->labelEx($model,'id')) => array(
    			'name' => 't.id',
    			'index' => 't.id',
    			'width' => '3%',
    			'searchtype' => 'integer',
    			'align' => 'right',
    		),
    		jqCaption::caption($form->labelEx($model,'name')) => array(
    			'name' => 't.name',
    			'index' => 't.name',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($model,'alias')) => array(
    			'name' => 't.alias',
    			'index' => 't.alias',
    			'width' => '7%',
    		),
    		jqCaption::caption('Creator Name') => array(
    			'name' => 'user.first_name',
    			'index' => 'user.first_name',
    			'width' => '10%',
    		),
            jqCaption::caption($form->labelEx($model,'site_url')) => array(
    			'name' => 't.site_url',
    			'index' => 't.site_url',
    			'width' => '9%',
    		),
            jqCaption::caption($form->labelEx($model,'image')) => array(
                'name' => 't.image',
                'index' => 't.image',
                'width' => '5%',
            ),
    		jqCaption::caption($form->labelEx($model,'active')) => array(
    			'name' => 't.active',
    			'index' => 't.active',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($model,'setting.referral_prize')) => array(
    			'name' => 'setting.referral_prize',
    			'index' => 'setting.referral_prize',
    			'searchtype' => 'number',
    			'formatter' => 'currency',
    			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
    			'align' => 'right',
    			'width' => '6%',
    		),
    		jqCaption::caption($form->labelEx($model,'setting.recipient_prize')) => array(
    			'name' => 'setting.recipient_prize',
    			'index' => 'setting.recipient_prize',
    			'searchtype' => 'number',
    			'formatter' => 'currency',
    			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
    			'align' => 'right',
    			'width' => '6%', 
    		),
    		jqCaption::caption($form->labelEx($model,'setting.min_payout')) => array(
    			'name' => 'setting.min_payout',
    			'index' => 'setting.min_payout',
    			'searchtype' => 'number',
    			'formatter' => 'currency',
    			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
    			'align' => 'right',
    			'width' => '5%',
    		),
    		'Clicks' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'align' => 'right',
    			'width' => '5%',
    			'sortable' => false,
        		'search' => false,
    		),
    		'Purchases' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'align' => 'right',
    			'width' => '5%',
    			'sortable' => false,
        		'search' => false,
    		),
    		'Payouts' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'formatter' => 'currency',
    			'formatoptions'=> array('decimalPlaces'=> 2, 'prefix'=> '$'),
    			'align' => 'right',
    			'width' => '5%',
    			'sortable' => false,
        		'search' => false,
    		),
    		jqCaption::caption($form->labelEx($model,'setting.enable_mail')) => array(
    			'name' => 'setting.enable_mail',
    			'index' => 'setting.enable_mail',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($model,'setting.enable_facebook')) => array(
    			'name' => 'setting.enable_facebook',
    			'index' => 'setting.enable_facebook',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($model,'setting.enable_twitter')) => array(
    			'name' => 'setting.enable_twitter',
    			'index' => 'setting.enable_twitter',
    			'width' => '5%',
    		),
    		jqCaption::caption($form->labelEx($model,'setting.enable_link')) => array(
    			'name' => 'setting.enable_link',
    			'index' => 'setting.enable_link',
    			'width' => '5%',
    		),
    		'Options' => array(
    			'name' => 'row.options',
    			'index' => 'row.options',
    			'width' => '9%',
    			'align' => 'center',
    			'sortable' => false,
    			'search' => false,
    		),
    	),
    )); ?>
    
    <?php $this->endWidget(); ?>
    ----------------------------------------------- -->

<?php else: ?>
    <?php echo $this->renderPartial('../layouts/_noSociety'); ?>
<?php endif; ?>