<div class="modal fade" id="payout-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <?php $form=$this->beginWidget('CActiveForm', array(
        			'id'=>'payout-form',
        			'action'=>'createPayout',
        			'enableAjaxValidation'=>false,
        			'htmlOptions' => array(
        				'class' => 'form-horizontal',
        			),
        	)); ?>
            
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 class="modal-title" id="myModalLabel">Create Payout</h3>
            </div>
        
            <div class="modal-body form">
        
            	<div id="payout-status">
        			<div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
                	<div id="status-success" class="alert alert-success hidden">Payout created.</div>
                </div>
        
                <div id="mail-row" class="form-group">
        			<?php echo $form->labelEx($model,'mail',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		    <div class="col-md-9 col-sm-9">
        		        <div class="input-group">
        		            <span class="input-group-addon">@</span>
        		            <?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		        </div>
        		        <?php echo $form->error($model,'mail'); ?>
        		        <div id="mail-error-row" class="text-danger hidden"></div>
        			</div>
        		</div>
        
        		<div id="payout-details" class="hidden">
        
        			<div id="campaign-row" class="form-group">
        		        <?php echo CHtml::label('Campaign *', 'campaign', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        			        <?php echo CHtml::dropDownList('campaign', '', array(), array('class'=>'form-control')); ?>
        			       	<div id="campaign-error-row" class="text-danger hidden"></div>
        		    	</div>
        		    </div>
        
        			<div id="amount-row" class="form-group">
        		        <?php echo CHtml::label('Amount *', 'amount', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        			        <div class="input-group">
        			        	<span class="input-group-addon">$</span>
        			       		<?php echo CHtml::textField('amount', '', array('size'=>20,'maxlength'=>100,'class'=>'form-control')); ?>
        			       	</div>
        			        <div id="amount-error-row" class="text-danger hidden"></div>
        		    	</div>
        		    </div>
        
        		    <div id="way-row" class="form-group">
        		    	<?php echo CHtml::label('System', 'payout_way', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		    	<div class="col-md-9 col-sm-9">
                            <div class="btn-group" data-toggle="buttons" id="payout-way">
                                <label class="btn btn-default active">
                            		<?php echo CHtml::radioButton('payout_way', true, array('value'=>'paypal','uncheckValue'=>null)) . ' Paypal'; ?>
                                </label>
                                <label class="btn btn-default">
                            		<?php echo CHtml::radioButton('payout_way', false, array('value'=>'westernunion','uncheckValue'=>null)) . ' Westernunion'; ?>
                                </label>
                            </div>
        		        </div>
        		    </div>
        			
        			<div id="paypal-block" class="form">
               			<div id="paypal-form"></div>
            		</div>
        
        		    <div id="westernunion-block" class="form">
        		        <div id="westernunion-form"></div>
        		    </div>
        
        		</div>
        
            </div>
        
            <div class="modal-footer">
        	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	    <?php echo CHtml::submitButton('Next', array('class'=>'btn btn-success', 'id'=>'payout-next-button')); ?>
        	    <?php echo CHtml::submitButton('Create', array('class'=>'btn btn-success hidden', 'id'=>'payout-create-button')); ?>
        	</div>
            
            <?php $this->endWidget(); ?>
            
        </div>
    </div>
</div>