
var CampaignHelper = {
    map: {},

    _map: function() {
    	this.map = {
            campaignForm: $('#campaign-form'),
            nextButton: $('#campaign-form #next-button'),
            prevButton: $('#campaign-form #prev-button'),
            generalBlock: $('#campaign-form #block-general'),
            settingBlock: $('#campaign-form #block-setting')
        };
    },
    
    init: function() {
        var $this = this;
        $this._map();
        $this.map.nextButton.click(function() { return $this.nextStep(this); });
        $this.map.prevButton.click(function() { return $this.prevStep(this); });
    },

    nextStep: function() {
        var $this = this;
        $this.map.generalBlock.slideToggle();
        $this.map.settingBlock.slideToggle();
        return false;
    },

    prevStep: function() {
        var $this = this;
        $this.map.generalBlock.slideToggle();
        $this.map.settingBlock.slideToggle();
        return false;
    }    
};

$(function() {
    CampaignHelper.init();
});