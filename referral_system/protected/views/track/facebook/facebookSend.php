<div class="form">
	<?php if($response['result'] == 'success'):?>
		<div class="alert alert-success">Message was sent</div>
	<?php endif?>
    
	<?php if($response['result'] == 'fail'):?>
		<div class="alert alert-danger">
            Sending message error
            <div><?=$response['errors']?></div>
        </div>
	<?php endif; ?>
</div>
