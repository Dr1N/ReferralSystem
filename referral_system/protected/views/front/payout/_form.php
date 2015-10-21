<div class="modal fade" id="payout-update-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
    <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'payout-update-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array(
	        'class' => 'form-horizontal'
		),
	)); ?>
    
    <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h3 class="modal-title" id="myModalLabel">Update Payout</h3>
    </div>

    <div class="modal-body form">

        <p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

    	<div id="payout-update-status">
			<div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
        	<div id="status-success" class="alert alert-success hidden">Payout updated.</div>
        </div>
             
        <div class="form-group">
            <div class="col-md-offset-3 col-sm-offset-3 col-sm-9">
        		<h3>Payout Information</h3>
            </div>
        </div>
            
        <?php echo $form->textField($model,'id', array('value'=>$model->id, 'class'=>'hidden')); ?>

        <div class="form-group">
    		<?php echo $form->labelEx($model,'user_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'user_id',array('value'=>$model->user->mail,'disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'user_id'); ?>
                <div id="user_id-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'campaign_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->textField($model,'campaign_id',array('value'=>$model->campaign->name,'disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'campaign_id'); ?>
                <div id="campaign_id-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
        
        <div class="form-group">
    		<?php echo $form->labelEx($model,'amount',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
            		<?php echo $form->textField($model,'amount',array('disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		</div>
                <?php echo $form->error($model,'amount'); ?>
                <div id="amount-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'end_amount',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
            		<?php echo $form->textField($model,'end_amount',array('disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		</div>
                <?php echo $form->error($model,'end_amount'); ?>
                <div id="end_amount-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'created_at',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <?php echo $form->textField($model,'created_at',array('disabled'=>true,'value'=>$model->isNewRecord ? DateHandler::nowView() : DateHandler::dateTimeView($model->created_at), 'class'=>'form-control')); ?>
                <?php echo $form->hiddenField($model,'created_at',array('value'=>$model->isNewRecord ? DateHandler::now() : DateHandler::dateTime($model->created_at))); ?>
        		<?php echo $form->error($model,'created_at'); ?>
                <div id="created_at-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'payout_way',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
        		<?php echo $form->dropDownList($model,'payout_way',Payout::$payoutWay,array('disabled'=>!$model->isNewRecord,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'payout_way'); ?>
                <div id="payout_way-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'status',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <div class="btn-group" data-toggle="buttons" id="payout-status">
                    <label class="btn btn-success <?php echo $model->status == 'completed' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'status',array('value'=>'completed','uncheckValue'=>null)) . ' Completed'; ?>
                    </label>
                    <label class="btn btn-warning <?php echo $model->status == 'pending' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'status',array('value'=>'pending','uncheckValue'=>null)) . ' Pending'; ?>
                    </label>
                    <label class="btn btn-danger <?php echo $model->status == 'rejected' ? 'active' : '' ?>">
                		<?php echo $form->radioButton($model,'status',array('value'=>'rejected','uncheckValue'=>null)) . ' Rejected'; ?>
                    </label>
                </div>
        		<?php echo $form->error($model,'status'); ?>
                <div id="status-error-row" class="text-danger hidden"></div>
            </div>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'details',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
            <div class="col-md-9 col-sm-9">
                <?php echo $form->textArea($model,'details',array('value'=>Payout::parseDetails($model->details), 'disabled'=>!$model->isNewRecord, 'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'details'); ?>
                <div id="details-error-row" class="text-danger hidden"></div>
            </div>
    	</div>

    </div>

    <div class="modal-footer">
        <?php echo CHtml::submitButton('Save', array('class'=>'btn btn-success', 'id'=>'payout-update-button')); ?>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
    
    <?php $this->endWidget(); ?>
    </div>
  </div>
</div>

<script>
    $(function() {
        $('#payout-update-modal').modal({show: true});
        $('#payout-update-modal').on('shown.bs.modal', function() {
            $('#payout-update-form').ajaxForm({
                dataType: 'json',
                url: 'updatePayout',
                success: function(response) { return PayoutUpdateHelper.updateSave(response); }
            });
        })
    });
</script>