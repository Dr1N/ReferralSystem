<div id="tab-link">
    <?php $this->renderPartial('../layouts/_left_menu'); ?>
    <div class="right-conte">
        <div class="zaglogin">
            <span class="prof-rew-icon"></span>
            <h1 class="uppercase">Share Your Personal Link</h1>
            <p>
                <small>
                    Use this link on your site, blog, chat, Google+, LinkedIn, etc.<br />
                    It's a handy way to share the deal with all your friends.
                </small>
            </p>
        </div>
        
        <div class="form-horizontal">      
            <div>
                <?php echo CHtml::label('Personal Link','link'); ?>
                <?php echo CHtml::textField('link-text', $campaign->site_url . '?rs_trck=' . $user->id . '_sdfxcva54g', array('readonly' => true)); ?>
            </div>
            
            <div class="form-group">
                <button name="link-button" id="link-button" class="btn">Copy</button>
                <span id="status-copying" class="space-small text-success hidden" align="right">The link was copied to the clipboard</span>
            </div>
        </div>
    </div>
</div>