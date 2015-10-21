<?php $this->pageTitle=Yii::app()->name; ?>

<div class="header">
    <div class="brend text-center">REFER A FRIEND</div>
    <div class="top-line">
        <p class="text-center"><big>EARN A <?= $campaign->setting->referral_prize ?> REWARD</big> for every friend you refer!</p>
        <!--a class="boxclose" id="boxclose">X</a-->
    </div>
    <div class="tabs-line">
        <ul class="tabs-navigation">
            <?php if(Yii::app()->user->isGuest): ?>
                <li><a href="#tab-login">LOGIN</a></li>
                <li><a href="#tab-register">REGISTER</a></li>
            <?php else: ?>
                <?php if ($campaign->setting->enable_mail == 'yes'): ?>
                    <li><a class="email" href="#tab-mail"><span class="circ"></span></a></li>
                <?php endif; ?>
                <?php if ($campaign->setting->enable_facebook == 'yes'): ?>
                    <li><a class="facebook" href="#tab-facebook"><span class="circ"></span></a></li>
                <?php endif; ?>
                <?php if ($campaign->setting->enable_twitter == 'yes'): ?>
                    <li><a class="twitter" href="#tab-twitter"><span class="circ"></span></a></li>
                <?php endif; ?>
                <?php if ($campaign->setting->enable_link == 'yes'): ?>
                    <li><a class="link" href="#tab-link" id="a-link"><span class="circ"></span></a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="bone">
    <div class="tabs-container">
        <?php if(Yii::app()->user->isGuest): ?>
            <?php $this->renderPartial('../user/_login', array('model' => $loginModel)); ?>
            <?php $this->renderPartial('../user/_restorePassword', array('model' => $userModel)); ?>
            <?php $this->renderPartial('../user/_register', array('model' => $userModel)); ?>
        <?php else: ?>
            <?php if ($campaign->setting->enable_mail == 'yes'): ?>
                <?php $this->renderPartial('../mail/_mail', array('campaign' => $campaign, 'user' => $user)); ?>
            <?php endif; ?>
            <?php if ($campaign->setting->enable_facebook == 'yes'): ?>
                <?php $this->renderPartial('../facebook/_facebook', array('campaign' => $campaign, 'user' => $user)); ?>
            <?php endif; ?>
            <?php if ($campaign->setting->enable_twitter == 'yes'): ?>
                <?php $this->renderPartial('../twitter/_twitter', array('campaign' => $campaign, 'user' => $user)); ?>
            <?php endif; ?>
            <?php if ($campaign->setting->enable_link == 'yes'): ?>
                <?php $this->renderPartial('../link/_link', array('campaign' => $campaign, 'user' => $user)); ?>
            <?php endif; ?>
            <?php $this->renderPartial('../payout/_payout', array()); ?>
            <?php $this->renderPartial('../user/_profile', array('model' => $user)); ?>
            <?php $this->renderPartial('../user/_changePassword', array('model' => $passwordModel)); ?>
        <?php endif; ?>
    </div>
</div>

<div class="footer">
    <?php if($campaignUser): ?>
        <div class="footer-text">
            <p>
                <strong>
                    Rewards Earned: $<?= $campaignUser->amount_earned ?> <br />
                    Pending: $<?= $campaignUser->amount_pending ?>
                </strong>
            </p>
        </div>
    <?php endif; ?>
    <img src="../images/track/footlogo.png" class="img-footer" alt="" />
</div>
