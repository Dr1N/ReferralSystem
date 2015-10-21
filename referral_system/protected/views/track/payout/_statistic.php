<div class="table">
	<table>
		<thead>
			<tr>
				<th></th>
				<th>Mail</th>
				<th>Facebook</th>
				<th>Twitter</th>
				<th>Link</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th class="text-left">Clicks</th>
				<td><?=$statistic['clicks']['mail']?></td>
				<td><?=$statistic['clicks']['facebook']?></td>
				<td><?=$statistic['clicks']['twitter']?></td>
				<td><?=$statistic['clicks']['link']?></td>
			</tr>
			<tr>
				<th class="text-left">Purchases</th>
				<td><?=$statistic['purchases']['mail']?></td>
				<td><?=$statistic['purchases']['facebook']?></td>
				<td><?=$statistic['purchases']['twitter']?></td>
				<td><?=$statistic['purchases']['link']?></td>
			</tr>
			<tr>
				<th class="text-left">Earned</th>
				<td>$<?=$statistic['total']['mail']?></td>
				<td>$<?=$statistic['total']['facebook']?></td>
				<td>$<?=$statistic['total']['twitter']?></td>
				<td>$<?=$statistic['total']['link']?></td>
			</tr>
		</tbody>
	</table>
</div>

<span class="tabs-navigation">
    <br />
    <a class="italic" href="#tab-payout-create"><small>Request Payout</small></a><br /><br />
</span>

<div id="payouts-table" class="grid-view">
	<?php if (!empty($payoutModel)): ?>
        <?php $this->renderPartial('_list',array(
            'model' => $payoutModel,
        )); ?>
    <?php endif; ?>
</div>