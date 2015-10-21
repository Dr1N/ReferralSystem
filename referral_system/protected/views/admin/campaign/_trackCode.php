<script type="text/javascript">
/* <![CDATA[ */
    var track_type = "<?=$type?>";
    var track_campaign_id = <?=$model->id?>;
    var track_code_id = "<?=$model->code?>";
    <?php if ($type == 'purchase'): ?>var track_purchase_id = 0;
    <?php endif; ?>
/* ]]> */
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/trace/tracking.js"></script>
<noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/trace/<?=$type?>/campaign_id/<?=$model->id?>/code_id/<?=$model->code?><?php if ($type == 'purchase'): ?>/purchase_id/0<?php endif; ?>" />
    </div>
</noscript>