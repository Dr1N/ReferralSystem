<?php $form=$this->beginWidget('CActiveForm', array(
    'action' => 'track/payout/createPayout',
	'id'=>'request-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'form-horizontal payout-form'),
));?>

    <div class="alert alert-info">
        Your balance: $<?= $campaignUser->amount_earned ? $campaignUser->amount_earned : 0 ?>
    </div>
    
    <div id="request-payout-status">
        <div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
        <div id="status-success" class="alert alert-success hidden">Request payout was created.</div>
    </div>
    
    <div id="amount-row" class="form-group">
        <?php echo CHtml::label('Amount ($)*','amount',array('class'=>'label-small')); ?>
        <?php echo CHtml::textField('amount','',array('class'=>'big-control')); ?>
        <div id="amount-error-row" class="text-danger hidden"></div>
    </div>

    <div id="way-row" class="form-group">
        <?php echo CHtml::label('System*', 'payout_way',array('class'=>'label-small')); ?>
        <?php echo CHtml::radioButtonList('payout_way', 'paypal', array('paypal'=>'Paypal', 'westernunion'=>'Westernunion'), array('template'=>"{input} {label}", 'separator'=>'&nbsp;&nbsp;')); ?>
    </div>
    
    <div id="paypal-block" class="form">
        <div id="paypal-form"></div>
    </div>

    <div id="westernunion-block" class="form">
        <div id="westernunion-form"></div>
    </div>
    
    <div class="form-group btn-payout">
        <?php echo CHtml::ajaxSubmitButton('Create', 'track/payout/createPayout', 
            array(
                'type' => 'POST',
                'dataType' => 'JSON',
                'success' => 'function(response) { PayoutHelper.createPayout(response); }',
            ),
            array(
                'id' => 'create-button',
                'name' => 'create-button',
                'class' => 'btn',
            )
        ); ?>
        <span class="tabs-navigation">
            <a class="italic space-small" href="#tab-payout-statistic"><small>Payout Statistic</small></a>
        </span>
    </div>

<?php $this->endWidget(); ?>

<script>
    $(function () {
        PayoutHelper.init();
    });
</script>