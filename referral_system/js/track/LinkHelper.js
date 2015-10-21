
var LinkHelper = {
    map: {},
    
    _map: function () {
        this.map = {
            linkTab: $('.tabs-navigation a#a-link'),
            linkButton: $('#tab-link #link-button'),
            linkText: $('#tab-link #link-text'),
            statusCopying: $('#status-copying')
        };
    },

    init: function (page) {
        var $this = this;
        $this._map();
        $this.map.linkTab.click(function() { return $this.copyLink(this); });
    },
      
    copyLink: function (element) {
		INIT_TIME = 500;
		FADE_TIME = 1500;
        var $this = this;
        $this.map.statusCopying.addClass('hidden');
        setTimeout(function() {
            ZeroClipboard.setMoviePath('js/library/zeroclipboard/ZeroClipboard.swf');
            var clip = new ZeroClipboard.Client();
            
            clip.addEventListener('mousedown', function() {
                clip.setText($this.map.linkText.val());
            });
            
            clip.addEventListener('complete',function(client, text) {
                $this.map.statusCopying.removeClass('hidden');
                setTimeout(function(){$this.map.statusCopying.fadeOut('slow', function() {
                    $this.map.statusCopying.addClass('hidden');
                    $this.map.statusCopying.removeAttr('style');
                })}, FADE_TIME);
            });
            clip.glue('link-button');
        }, INIT_TIME);
        return false;
    }
};

$(function () {
    LinkHelper.init();
});