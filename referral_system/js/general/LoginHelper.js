
var LoginHelper = {
    map: {},

    _map: function () {
    	this.map = {
            loginLink:           $('#restore-form #login'),
            restorePasswordLink: $('#login-form #restore-password'),
            restorePasswordClick:$('#widget-menu a[title="tab-restorePassword"]'),
            restoreLoginClick:   $('#widget-menu a[title="tab-login"]')
        };
    },

    init: function () {
        var $this = this;
        $this._map();
        $this.map.restorePasswordClick.parent().addClass('hidden');
        $this.map.loginLink.click(function() { return $this.showLogin(this); });
        $this.map.restorePasswordLink.click(function() { return $this.showRestorePassword(this); });
    },

    showLogin: function (element) {
        var $this = this;
        $this.map.restoreLoginClick.parent().removeClass('hidden');
        $this.map.restorePasswordClick.parent().addClass('hidden');
        $this.map.restoreLoginClick.click();
        return false;
    },

    showRestorePassword: function (element) {
        var $this = this;
        $this.map.restorePasswordClick.parent().removeClass('hidden');
        $this.map.restoreLoginClick.parent().addClass('hidden');
        $this.map.restorePasswordClick.click();
        return false;
    }
};

$(function () {
    LoginHelper.init();
});