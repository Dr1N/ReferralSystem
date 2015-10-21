<div class="modal fade" id="invite-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <?php $form=$this->beginWidget('CActiveForm', array(
        			'id'=>'invite-form',
        			'action'=>'invite',
        			'enableAjaxValidation'=>false,
        			'htmlOptions' => array(
        				'class' => 'form-horizontal',
        				'enctype'=>'multipart/form-data'
        			),
        	)); ?>
            
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 class="modal-title" id="myModalLabel">Invite User</h3>
            </div>
        
            <div class="modal-body form">
                
            	<div id="invite-status">
        			<div id="check-status" class="alert alert-success hidden">
                        The user with the entered e-mail has been found in our database.
                        <span id="user-name" class="hidden">His/her have a name <span></span>. </span> 
                        Please click the Invite button to send an invitation to the user.
                    </div>
                	<div id="status-fail" class="alert alert-danger hidden">Please fix the input errors.</div>
                	<div id="status-success" class="alert alert-success hidden">User invited.</div>
                	<div id="status-exists" class="alert alert-danger hidden">This e-mail is already taken by a user who is register in an organization.</div>
                	<div id="status-user" class="alert alert-success hidden">To invite the user please enter additional information about him/her if you need and click the Invite button.</div>
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
        
        		<div id="invite-user-details" class="hidden">
        			<div id="first_name-row" class="form-group">
        				<?php echo $form->labelEx($model,'first_name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		    		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		    		<?php echo $form->error($model,'first_name'); ?>
        		    		<div id="first_name-error-row" class="text-danger hidden"></div>
        		        </div>
        			</div>
        
        			<div id="last_name-row" class="form-group">
        				<?php echo $form->labelEx($model,'last_name',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		    		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		    		<?php echo $form->error($model,'last_name'); ?>
        		    		<div id="last_name-error-row" class="text-danger hidden"></div> 
        		        </div>
        			</div>
        
        			<div id="country_id-row" class="form-group">
        				<?php echo $form->labelEx($model,'country_id',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		    		<?php echo $form->dropDownList($model,'country_id',Country::getCountries(true),array('class'=>'form-control')); ?> 
        		    		<?php echo $form->error($model,'country_id'); ?>
        		    		<div id="country_id-error-row" class="text-danger hidden"></div> 
        		        </div>
        			</div>
        
        			<div id="city-row" class="form-group">
        				<?php echo $form->labelEx($model,'city',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		    		<?php echo $form->textField($model,'city',array('class'=>'form-control')); ?> 
        		    		<?php echo $form->error($model,'city'); ?>
        		    		<div id="city-error-row" class="text-danger hidden"></div>
        		        </div>
        			</div>
        
        			<div id="address-row" class="form-group">
        				<?php echo $form->labelEx($model,'address',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		    		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        		    		<?php echo $form->error($model,'address'); ?>
        		    		<div id="address-error-row" class="text-danger hidden"></div>
        		        </div>
        			</div>
        
        			<div id="phone-row" class="form-group">
        				<?php echo $form->labelEx($model,'phone',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		    		<?php echo $form->textField($model,'phone',array('size'=>14,'maxlength'=>14,'class'=>'form-control')); ?>
        		    		<?php echo $form->error($model,'phone'); ?>
        		    		<div id="phone-error-row" class="text-danger hidden"></div>  
        		        </div>
        			</div>
        
        			<div id="birthday-row" class="form-group">
        				<?php echo $form->labelEx($model,'birthday',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        				<div class="col-md-9 col-sm-9">
        					<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
        						array(
        			    		    'name'=>'datepicker-month-year-menu',
        			    		    'flat'=>false,
        			                'value'=>strtotime($model->birthday) ? DateHandler::dateView($model->birthday) : '',
        			                'options'=>array(
        			    			    'dateFormat'=>'mm/dd/yy',
        			                    'showAnim'=>'fadeIn',
        			    		        'changeMonth'=>true,
        			    		        'changeYear'=>true,
        			    		        'yearRange'=>'1950:2013',
        			    		        'minDate'=>'01/01/1950',
        			    		        'maxDate'=>'31/12/2013',
        			    		    ),
        			    		    'htmlOptions'=>array(
        			    		    	'name'=>'User[birthday]',
        			                    'class'=>'form-control',
        		    		   		)
        		    			)
        		    		); ?>
        					<?php echo $form->error($model,'birthday'); ?>
        					<div id="birthday-error-row" class="text-danger hidden"></div>
        				</div>
        		    </div>
        
        			<div id="image-row" class="form-group">
        		        <?php echo $form->labelEx($model,'image',array('class'=>'col-md-3 col-sm-3 control-label')); ?>
        		        <div class="col-md-9 col-sm-9">
        		            <?php echo $form->fileField($model,'image',array('class'=>'form-control'));?>
        		            <?php echo $form->error($model,'image'); ?>
        		            <div id="image-error-row" class="text-danger hidden"></div>
        		        </div>
        	    	</div>
        		</div>
        
            </div>
        
            <div class="modal-footer">
        	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	    <?php echo CHtml::submitButton('Next', array('class'=>'btn btn-success', 'id'=>'invite-next-button')); ?>
        	    <?php echo CHtml::submitButton('Invite', array('class'=>'btn btn-success hidden', 'id'=>'invite-save-button')); ?>
        	</div>
            
            <?php $this->endWidget(); ?>
            
        </div>
    </div>
</div>