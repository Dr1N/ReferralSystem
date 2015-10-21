<div id="first_name-row" class="form-group">
    <?php echo CHtml::label('First Name *', 'Westernunion[first_name]', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    <div class="col-md-9 col-sm-9">
        <?php echo CHtml::textField('Westernunion[first_name]','',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        <div id="first_name-error-row" class="text-danger hidden"></div>
    </div>
</div>

<div id="last_name-row" class="form-group">
    <?php echo CHtml::label('Last Name *', 'Westernunion[last_name]', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    <div class="col-md-9 col-sm-9">
        <?php echo CHtml::textField('Westernunion[last_name]','',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
        <div id="last_name-error-row" class="text-danger hidden"></div>
    </div>
</div>

<div id="country-row" class="form-group">
    <?php echo CHtml::label('Country *', 'Westernunion[country]', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    <div class="col-md-9 col-sm-9">
        <?php echo CHtml::dropDownList('Westernunion[country]', '', Country::getCountries(true), array('class'=>'form-control')); ?>
        <div id="country-error-row" class="text-danger hidden"></div>
    </div>
</div>

<div id="city-row" class="form-group">
    <?php echo CHtml::label('City *', 'Westernunion[city]', array('class'=>'col-md-3 col-sm-3 control-label')); ?>
    <div class="col-md-9 col-sm-9">
        <?php echo CHtml::textField('Westernunion[city]','',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
         <div id="city-error-row" class="text-danger hidden"></div>
    </div>
</div>