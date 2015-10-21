
var InviteHelper = {
    map: {},

    _map: function() {
    	this.map = {
            inviteForm: $('#invite-form'),
            userDetails: $('#invite-form #invite-user-details'),
            inviteStatus: $('#invite-form #invite-status'),
            iviteCheck: $('#invite-form #check-status'),
            iviteCheckName: $('#invite-form #check-status #user-name'),
            inviteStatusFail: $('#invite-form #status-fail'),
            inviteStatusExists: $('#invite-form #status-exists'),
            inviteStatusUser: $('#invite-form #status-user'),
            inviteNextButton: $('#invite-form #invite-next-button'),
            inviteSaveButton: $('#invite-form #invite-save-button'),
            inviteMailRow: $('#invite-form #mail-row'),
            inviteMail: $('#invite-form #User_mail'),
            fieldRows: $('#invite-form .form-group'),
            errorMessages: $('#invite-form .text-danger')
        };
    },
    
    init: function() {
        var $this = this;
        $this._map();
        $this.map.inviteNextButton.click(function() { return $this.inviteNext(this); });
        $this.map.inviteForm.ajaxForm({
            dataType: 'json',
            success: function(response) { return $this.saveInvite(response); }
        });
    },

    inviteNext: function() {
        var $this = this;
        var mail = $this.map.inviteMail.val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/colleague/checkUser',
            cache: false,
            data: { mail: mail },
            success: function (response) { $this.checkUser(response); },
        });
        return false;
    },

    checkUser: function(response)
    {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();

        if(response.result == 'exists') {
            // Exists
            $this.map.inviteStatusExists.removeClass('hidden');
            
        } else {
            if(response.result == 'fail') {
                // Fail
                $this.map.inviteStatusFail.removeClass('hidden');
                for (error in response.errors) {
                    var errorElement = '#' + error + '-error-row';
                    $this.map.inviteForm.find(errorElement).removeClass('hidden');
                    $this.map.inviteForm.find(errorElement).html(response.errors[error][0]);
                    $this.map.inviteForm.find('#' + error + '-row').addClass('error');
                    $this.map.inviteMailRow.find('label').addClass('has-error text-danger');
                    $this.map.inviteMailRow.find('input').addClass('has-error text-danger');
                }
            } else {
                // Success
                $this.map.inviteMail.attr('readonly', true);
                $this.map.inviteNextButton.addClass('hidden');
                $this.map.inviteSaveButton.removeClass('hidden');
                if(response.user == 'newuser') {
                    $this.map.inviteStatusUser.removeClass('hidden');
                    $this.map.userDetails.removeClass('hidden');
                } else {
                    $this.map.iviteCheck.removeClass('hidden');
                    var userInvite = response.user.first_name + ' ' + response.user.last_name; // !!!!!!!! (a-to-do) (a-done)
                    if(userInvite.length > 1){
                        $this.map.iviteCheckName.removeClass('hidden');
                        $this.map.iviteCheckName.find('span').html(userInvite);
                    }
                }
            }
        }
    },

    saveInvite: function(response)
    {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();

        if (response.result == 'fail') {
            $this.map.inviteStatus.find('#status-' + response.result).removeClass('hidden');
            for (error in response.errors) {
                var errorElement = '#' + error + '-error-row';
                $this.map.inviteForm.find(errorElement).removeClass('hidden');
                $this.map.inviteForm.find(errorElement).html(response.errors[error][0]);
                $this.map.inviteForm.find('#' + error + '-row').addClass('error');

                var row = '#' + error + '-row';
                $(row).find('label').addClass('has-error text-danger');
                if(error == 'country'){
                    $(row).find('select').addClass('has-error text-danger');
                } else {
                    $(row).find('input').addClass('has-error text-danger');
                }
            }
        } else if(response.result == 'success') {
            $('#invite-modal').modal('hide');
            $this.map.inviteForm.resetForm();
            $this.map.inviteMail.attr('readonly', false);
            $this.map.userDetails.addClass('hidden');
            $this.map.inviteSaveButton.addClass('hidden');
            $this.map.inviteNextButton.removeClass('hidden');
        }
        return false;
    },
        
    hideMessages: function() {
        var $this = this;
        $this.map.inviteStatus.find('div').addClass('hidden');
        $this.map.iviteCheckName.addClass('hidden');
        $this.map.iviteCheckName.find('span').html("");
    },
    
    hideErrors: function() {
        var $this = this;
        $this.map.fieldRows.removeClass('error');
        $this.map.errorMessages.addClass('hidden');
        $this.map.inviteForm.find('label').removeClass('has-error text-danger');
        $this.map.inviteForm.find('input').removeClass('has-error text-danger');
    }
};

$(function() {
    InviteHelper.init();
});