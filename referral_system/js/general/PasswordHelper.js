
var PasswordHelper = {
    map: {},

    _map: function () {
    	this.map = {
    		restoreForm: $('#restore-form'),
            mailField: $('#restore-form #User_mail'),
            mailRow: $('#restore-form #mail-row'),
            mailErrorRow: $('#restore-form #mail-error-row'),
            saveRestoreStatus: $('#restore-form #save-restore-status'),
            restoreButton: $('#restore-form input#restore')
        };
    },
    
    init: function () {
        var $this = this;
        $this._map();
        $this.map.restoreForm.submit(function() {  return $this.restore(this); });
    	$this.map.restoreButton.click(function() {  return $this.restore(this); });
    },
    
    restore: function (element) {
        var $this = this;
        var linkUrl = $this.map.restoreForm.attr('action');
        var mail = $this.map.mailField.val();
        
        $this.hideErrors();
        $this.map.restoreButton.attr('disabled', true);
        
        $.ajax({
            type: 'POST',
            url: linkUrl,
            data: { mail: mail },
            dataType: 'json',
            success: function (response) {
                $this.map.restoreButton.attr('disabled', false);
                $this.map.saveRestoreStatus.find('div').addClass('hidden');
                $this.map.saveRestoreStatus.find('#status-' + response.result).removeClass('hidden');
                if (response.result == 'fail') {
                    $this.map.mailRow.addClass('has-error');
                    $this.map.mailErrorRow.removeClass('hidden');
                    $this.map.mailErrorRow.html(response.errors.mail[0]);
                }
            }
        });
        
        return false;
    },
    
    hideErrors: function () {
        var $this = this;
        $this.map.mailRow.removeClass('has-error');
        $this.map.mailErrorRow.addClass('hidden');
        $this.map.mailErrorRow.html('');
    },
    
    hideMessages: function () {
        var $this = this;
        $this.map.saveRestoreStatus.find('div').addClass('hidden');
    } 
};

$(function () {
    PasswordHelper.init();
});