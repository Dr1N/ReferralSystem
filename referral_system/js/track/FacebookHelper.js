
var FacebookHelper = {
    map: {},

     _map: function () {
        this.map = {
            sendStatus: $('#send-facebook-form #send-facebook-status'),
            errorField: $('#send-facebook-form #facebook-errors')
        };
    },

    init: function (page) {
        var $this = this;
        $this._map();
    },
      
    sendFacebook: function(response)
    {
        var $this = this,
            windowWidth = 1000,
            windowHeight = 700;
       
        if(response.url)
            window.open(response.url, 'Facebook', 'width=' + windowWidth + ', height=' + windowHeight);
        else {
            $this.hideMessages();
            $this.map.sendStatus.find('#status-' + response.result).removeClass('hidden');
            if(response.result == 'fail' && response.errors){
                $this.map.errorField.html(response.errors);
                $this.map.errorField.removeClass('hidden');
            }
        }
        return false;
    },

    hideMessages: function () {
        var $this = this;
        $this.map.sendStatus.find('div').addClass('hidden');
        $this.map.errorField.html("");
    },
};

$(function () {
    FacebookHelper.init();
});