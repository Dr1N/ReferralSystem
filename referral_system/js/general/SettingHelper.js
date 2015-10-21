
var SettingHelper = {
    
    map: {},

    _map: function() {
    	this.map = {
            campaignForm:   $('#campaign-form'),
    		referralWays:   ['mail', 'facebook', 'twitter']
    	};
    },

    init: function() {
        var $this = this;
        $this._map();

        for(var i = 0; i < $this.map.referralWays.length; i++) {
            $(function(i) {
                var referralWays = $this.map.referralWays[i],
                    button = $this.map.campaignForm.find('input[name="CampaignSetting[enable_' + referralWays + ']"]'),
                    checkedButton = $this.map.campaignForm.find('input[name="CampaignSetting[enable_' + referralWays + ']"]:checked'),
                    field = $this.map.campaignForm.find('textarea[name="CampaignSetting[message_' + referralWays + ']"]');
                
                $this.toggleTextArea(field, checkedButton);
                button.change(function() { return $this.toggleTextArea(field, $(this))});
            }(i));
        }
    },

    toggleTextArea: function(field, button) {
        var messageBlock = field.parent().parent();
        if (button.val() == 'yes') {
            messageBlock.show();
        } else {
            messageBlock.hide();
        }
        return false;        
    }
};

$(function() {
    SettingHelper.init();
});