
var RegisterHelper = {
    map: {},

    _map: function () {
    	this.map = {
    		registerForm: $('#register-form'),
            mailField: $('#register-form #User_mail'),
            passwordField: $('#register-form #User_password'),
            mailRow: $('#register-form #mail-row'),
            passwordRow: $('#register-form #password-row'),
            mailErrorRow: $('#register-form #mail-error-row'),
            passwordErrorRow: $('#register-form #password-error-row'),
            saveRegisterStatus: $('#register-form #save-register-status'),
            registerButton: $('#register-form input#register'),
            confirmButton: $('#register-form input#confirm')
    	};
    },
    
    init: function () {
        var $this = this;
        $this._map();
    	$this.map.registerForm.submit(function() {  return $this.submitFrom(this); });
    	$this.map.registerButton.click(function() {  return $this.register(this); });
    	$this.map.confirmButton.click(function() {  return $this.confirm(this); });
    },
    
    submitFrom: function (element) {
        var $this = this;
        if($this.map.confirmButton.hasClass('hidden')) {
            $this.register(element);
        } else {
            $this.confirm(element);
        }
    },
    
    register: function (element) {
        var $this = this;
        var linkUrl = $this.map.registerForm.attr('action');
        var mail = $this.map.mailField.val();
        
        $this.hideErrors();
        $this.map.registerButton.attr('disabled', true);
        
        $.ajax({
            type: 'POST',
            url: linkUrl,
            data: { mail: mail },
            dataType: 'json',
            success: function (response) {
                $this.map.saveRegisterStatus.find('div').addClass('hidden');
                $this.map.saveRegisterStatus.find('#status-' + response.result).removeClass('hidden');
                if (response.result == 'success') {
                    $this.map.passwordRow.removeClass('hidden');
                    $this.map.mailField.attr('disabled', true);
                    $this.map.registerButton.addClass('hidden');
                    $this.map.confirmButton.removeClass('hidden');
                } else {
                    for (error in response.errors) {
                        var errorElement = '#' + error + '-error-row';
                        $this.map.registerForm.find(errorElement).removeClass('hidden');
                        $this.map.registerForm.find(errorElement).html(response.errors[error][0]); //mail row??????
                        $this.map.registerForm.find('#' + error + '-row').addClass('has-error');
                    }
                    $this.map.registerButton.attr('disabled', false);
                }
            }
        });
        
        return false;
    },
    
    confirm: function (element) {
        var $this = this;
        
        var linkUrl = '/user/confirm';
        var confirmedUrl = '/user/registered';
        if (AREA == 'track') {
            linkUrl = '/' + AREA + linkUrl;
            confirmedUrl = window.location.href;
        }
        
        var mail = $this.map.mailField.val();
        var password = $this.map.passwordField.val();
        
        $this.hideErrors();
        $this.map.confirmButton.attr('disabled', true);
        
        $.ajax({
            type: 'POST',
            url: linkUrl,
            data: { mail: mail, password: password },
            dataType: 'json',
            success: function (response) {
                if (response.result == 'success') {
                    window.location = confirmedUrl;
                } else {
                    $this.map.saveRegisterStatus.find('#status-' + response.result).removeClass('hidden');
                    $this.map.passwordRow.addClass('has-error');
                    $this.map.passwordErrorRow.removeClass('hidden');
                    $this.map.confirmButton.attr('disabled', false);
                    $this.map.passwordErrorRow.html(response.errors.password[0]);
                }
            }
        });
        return false;
    },
    
    hideErrors: function () {
        var $this = this;
        $this.map.saveRegisterStatus.find('div').addClass('hidden');
        $this.map.mailRow.removeClass('has-error');
        $this.map.passwordRow.removeClass('has-error');
        $this.map.mailErrorRow.addClass('hidden');
        $this.map.passwordErrorRow.addClass('hidden');
        $this.map.mailErrorRow.html('');
        $this.map.passwordErrorRow.html('');
    }
};

$(function () {
    RegisterHelper.init();
});