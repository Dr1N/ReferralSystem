<div id="payout-mail-row" class="form-group">
    <?php echo CHtml::label('E-mail *', 'Paypal[mail]', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    <div class="col-md-9 col-sm-9">
    	<div class="input-group">
    		<span class="input-group-addon">@</span>
    		<?php echo CHtml::textField('Paypal[mail]','', array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
    	</div>
    	<div id="payout-mail-error-row" class="text-danger hidden"></div>
    </div>
</div>