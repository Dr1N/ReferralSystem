
var TwitterHelper = {
    map: {},
    maxTweetLength: 140,

    _map: function () {
        this.map = {
            tweeterSubmit: $('#tab-twitter #tweeter-submit'),
            tweetText: $('#tab-twitter #tweet-text'),
            charsLeft: $('#tab-twitter #chars-left'),
            sendTwitterStatus: $('#send-twitter-form #send-twitter-status'),
            errorText: $('#send-twitter-form #twitter-error-message')
        };
    },

    init: function (page) {
        var $this = this;
        $this._map();
        $this.map.tweeterSubmit.click(function() { return $this.sendTweet(this); });
        $this.map.tweetText.keypress(function() { return $this.changeTweet(this); });
        $this.map.tweetText.keyup(function() { return $this.changeTweet(this); });
        if ($this.map.tweetText.val() != undefined) {
            $this.changeTweet($this.map.tweetText);
        }
    },
        
    changeTweet: function (element) {
        var $this = this;
        var text = $this.map.tweetText.val();
        var length = text.length;
              
        if (length > $this.maxTweetLength) {
            length = $this.maxTweetLength;
            $this.map.tweetText.val(text.substr(0, length));
        }
        var lengthLeft = $this.maxTweetLength - length;
        $this.map.charsLeft.html(lengthLeft);
    },

    sendTweet: function (response) {
        var $this = this,
            windowWidth = 700,
            windowHeight = 500;
               
        if(response.token == false){
            window.open(response.url, 'Twitter', 'width=' + windowWidth + ', height=' + windowHeight);
        } else {
            $this.hideErrors();
            $this.hideMessages();
            $this.map.sendTwitterStatus.find('#status-' + response.result).removeClass('hidden');
            if (response.result = 'fail'){
                $this.map.errorText.removeClass('hidden');
                $this.map.errorText.html(response.errors);
            }
        }
    },

    hideMessages: function () {
        var $this = this;
        $this.map.sendTwitterStatus.find('div').addClass('hidden');
    },
    
    hideErrors: function () {
        var $this = this;
        $this.map.errorText.addClass('hidden');
    }
};

$(function () {
    TwitterHelper.init();
});