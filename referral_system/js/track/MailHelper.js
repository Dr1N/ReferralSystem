
var MailHelper = {
    map: {},

    _map: function () {
    	this.map = {
    	    tabMailList: $('#tab-mail-list'),
    	    sendEmailsForm: $('#send-email-form'),
    	    sendMailStatus: $('#send-email-form #send-mail-status'),
            fieldRows:  $('#send-email-form .form-group'),
            errorMessages: $('#send-email-form .text-danger'),
            mailToSelected: '.mail-to-selected',
            mailsTextArea: $('#send-email-form #mails')
        };
    },
    
    init: function () {
        var $this = this;
        $this._map();
        $this.map.tabMailList.delegate($this.map.mailToSelected, 'click', function() {  return $this.showSelectedEmailsSend(this); });
    },
    
    sendEmail: function (response) {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();
        $this.map.sendMailStatus.find('#status-' + response.result).removeClass('hidden');
        
        if (response.result == 'fail') {
            for (error in response.errors) {
                var errorElement = '#' + error + '-error-row';
                $this.map.sendEmailsForm.find(errorElement).removeClass('hidden');
                $this.map.sendEmailsForm.find(errorElement).html(response.errors[error][0]);
                $this.map.sendEmailsForm.find('#' + error + '-row').addClass('error');
            }
        } else {
            $this.map.mailsTextArea.attr("value", "");
        }
    },

    showSelectedEmailsSend: function (element){
        var $this = this;
        var mails = [];
        var mailList = '';
        $.each($("input.mail-box:checked"), function() {
            mails.push($(this).val());
        })
        mailList = mails.join(', ');
        $this.map.mailsTextArea.attr("value", mailList);
        $this.hideErrors();
        $this.hideMessages();
        return false;
    },

    hideMessages: function () {
        var $this = this;
        $this.map.sendMailStatus.find('div').addClass('hidden');
    },
    
    hideErrors: function () {
        var $this = this;
        $this.map.fieldRows.removeClass('error');
        $this.map.errorMessages.addClass('hidden');
    }
};

$(function () {
    MailHelper.init();
});