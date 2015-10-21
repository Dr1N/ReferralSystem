<div id="grid-<?= $elementId ?>">
	<table id="<?= $elementId ?>"></table> 
	<div id="pager-<?= $elementId ?>"></div>
</div>

<script type="text/javascript">
	$(function(){
	    jqGrid.init({
    		module: '<?= $module ?>',
    		elementId: '<?= $elementId ?>',
			columnNames: <?= $columnNames ?>,
			columnModel: <?= $columnModel ?>,
			parameters: <?= $parameters ?>,
			<?php if($headers): ?>
				headers: <?= $headers ?>,
			<?php endif; ?>
			<?php if($extraNames): ?>
				extraNames: <?= $extraNames ?>,
			<?php endif; ?>
			<?php if($extraModel): ?>
				extraModel: <?= $extraModel ?>,
			<?php endif; ?>
			<?php if($groupingHeaders): ?>
				groupingHeaders: <?= $groupingHeaders ?>,
			<?php endif; ?>
			<?php if($buttonSearch): ?>
				buttonSearch: '<?= $buttonSearch ?>',
			<?php endif; ?>
			<?php if($buttonGrouping): ?>
				buttonGrouping: '<?= $buttonGrouping ?>',
			<?php endif; ?>
			<?php if($buttonScheme): ?>
				buttonScheme: '<?= $buttonScheme ?>',
			<?php endif; ?>
			<?php if($contentId): ?>
				contentId: '<?= $contentId ?>',
			<?php endif; ?>
			<?php if($optionForm): ?>
				optionForm: '<?= $optionForm ?>',
			<?php endif; ?>
			<?php if($filteringIds): ?>
				filteringIds: <?= $filteringIds ?>,
			<?php endif; ?>
			<?php if($schemeId): ?>
				schemeId: '<?= $schemeId ?>',
			<?php endif; ?>
			<?php if($selectedScheme): ?>
				selectedScheme: '<?= $selectedScheme ?>',
			<?php endif; ?>
			<?php if($firstExtraFields): ?>
				firstExtraFields: '<?= $firstExtraFields ?>',
			<?php endif; ?>
			<?php if($detailsId): ?>
				detailsId: '<?= $detailsId ?>',
			<?php endif; ?>
		});
	});
</script>