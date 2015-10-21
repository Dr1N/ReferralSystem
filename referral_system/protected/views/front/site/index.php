<?php
    $this->pageTitle=Yii::app()->name;
    
    $leftWidth = 7;
    $rightWidth = 5;
    if (Yii::app()->user->isGuest):
        $leftWidth = 5;
        $rightWidth = 7;
    endif;
?>

<div class="row">
    <div class="col-md-<?php echo $leftWidth; ?> login">
        <h2>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h2>
        <?php if(Yii::app()->user->isGuest): ?>
            <?php $this->widget('zii.widgets.jui.CJuiTabs',array(
                'tabs'=>array(
                    'Login'=>array('id'=>'tab-login','content'=>$this->renderPartial('_login', array('model' => $model), true)),
                    'Restore Password'=>array('id'=>'tab-restorePassword','content'=>$this->renderPartial('_restorePassword', array('model' => $userModel), true)),
                    'Registration'=>array('id'=>'tab-register','content'=>$this->renderPartial('_register', array('model' => $userModel), true)),
                ),
                'options'=>array(
                    'collapsible'=>true,
                ),
                'id'=>'widget-menu',
            )); ?>
        <?php else: ?>
            <?php $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>array(
                    //'colors' => array('#0000cc', '#cc0000', '#33cc66', '#660099', '#33ccff', '#ff9900', '#3399ff'),
                    'title' => array('text' => 'Fruit Consumption'),
                    'xAxis' => array(
                        'categories' => array('Apples', 'Bananas', 'Oranges')
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Fruit eaten')
                    ),
                    'series' => array(
                        array('name' => 'Jane', 'data' => array(1, 0, 4)),
                        array('name' => 'John', 'data' => array(5, 7, 3))
                    ),
                    'credits' => array('enabled' => false),
                    'chart' => array('type' => 'line'), // line, spline, area, areaspline, column, bar, pie, scatter, gauge, arearange, areasplinerange, columnrange, bubble, box plot, error bars, funnel, waterfall, polar chart types.
                    //'theme' => 'gray',
                ),
                'scripts' => array(
                    'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                    'modules/exporting', // adds Exporting button/menu to chart
                    //'themes/grid'        // applies global 'grid' theme to all charts
                ),
            )); ?>
        <?php endif; ?>
    </div>
    <div class="col-md-<?php echo $rightWidth; ?>">
        <h2><?php echo $page->link_name; ?></h2>	
        <?php echo $page->text_page; ?>
    </div>
</div>

<?php
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/general/RegisterHelper.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/general/PasswordHelper.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/general/LoginHelper.js');
?>