<div class="form-group">
    <div id="first_name-row" class="left">
        <?php echo CHtml::label('First Name*', 'Westernunion[first_name]',array('class'=>'label-small')); ?>
        <?php echo CHtml::textField('Westernunion[first_name]','',array('class'=>'profile-control')); ?>
        <div id="first_name-error-row" class="text-danger hidden"></div>
    </div>
    
    <div id="last_name-row" class="left">
        <?php echo CHtml::label('Last Name*', 'Westernunion[last_name]',array('class'=>'label-small')); ?>
        <?php echo CHtml::textField('Westernunion[last_name]','',array('class'=>'profile-control')); ?>
        <div id="last_name-error-row" class="text-danger hidden"></div>
    </div>
</div>

<div class="form-group">
    <div id="country-row" class="left">
        <?php echo CHtml::label('Country*', 'Westernunion[country]',array('class'=>'label-small')); ?>
        <?php echo CHtml::dropDownList('Westernunion[country]', '', Country::getCountries(true),array('class'=>'profile-control')); ?>
        <div id="country-error-row" class="text-danger hidden"></div>
    </div>
    
    <div id="city-row" class="left">
        <?php echo CHtml::label('City*', 'Westernunion[city]',array('class'=>'label-small')); ?>
        <?php echo CHtml::textField('Westernunion[city]','',array('class'=>'profile-control')); ?>
        <div id="city-error-row" class="text-danger hidden"></div>
    </div>
</div>