
var ProfileHelper = {
    map: {},

    _map: function () {
    	this.map = {
            userForm: $('#user-form'),
            passwordForm: $('#password-form'),
            passwordFields: $('#password-form input:password'),
            saveProfileStatus: $('#user-form #save-profile-status'),
            savePasswordStatus: $('#password-form #save-password-status'),
            fieldRows: $('#user-form .form-group, #password-form .form-group'),
            errorMessages: $('#user-form .text-danger, #password-form .text-danger'),
            logoutLink: $('a#logout-link')
        };
    },
    
    init: function () {
        var $this = this;
        $this._map();
        $this.map.logoutLink.click(function() { return $this.siteLogout(this); });
    },
    
    saveProfile: function (response) {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();
        $this.map.saveProfileStatus.find('#status-' + response.result).removeClass('hidden');
        
        if (response.result == 'fail') {
            for (error in response.errors) {
                var errorElement = '#' + error + '-error-row';
                $this.map.userForm.find(errorElement).removeClass('hidden');
                $this.map.userForm.find(errorElement).html(response.errors[error][0]);
                $this.map.userForm.find('#' + error + '-row').addClass('error');
            }
        }
    },
    
    savePassword: function (response) {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();
        $this.map.savePasswordStatus.find('#status-' + response.result).removeClass('hidden');

        if (response.result == 'fail') {
            for (error in response.errors) {
                var errorElement = '#' + error + '-error-row';
                $this.map.passwordForm.find(errorElement).removeClass('hidden');
                $this.map.passwordForm.find(errorElement).html(response.errors[error][0]);
                $this.map.passwordForm.find('#' + error + '-row').addClass('error');
            }
        } else {
            $this.map.passwordFields.val('');
        }
    },
    
    hideMessages: function () {
        var $this = this;
        $this.map.saveProfileStatus.find('div').addClass('hidden');
        $this.map.savePasswordStatus.find('div').addClass('hidden');
    },
    
    hideErrors: function () {
        var $this = this;
        $this.map.fieldRows.removeClass('error');
        $this.map.errorMessages.addClass('hidden');
    },
    
    siteLogout: function (element) {
        location.href = $(element).attr('href');
        return false;
    }
};

$(function () {
    ProfileHelper.init();
});