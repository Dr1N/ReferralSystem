
var PayoutHelper = {
    map: {},

    _map: function() {
    	this.map = {
            payoutForm: $('#payout-form'),
            payoutDetails: $('#payout-form #payout-details'),
            payoutStatus: $('#payout-form #payout-status'),
            payoutStatusFail: $('#payout-form #status-fail'),
            payoutNextButton: $('#payout-form #payout-next-button'),
            payoutCreateButton: $('#payout-form #payout-create-button'),
            payoutMailRow: $('#payout-form #mail-row'),
            payoutMail: $('#payout-form #User_mail'),
            payoutMailError: $('#payout-form #mail-error-row'),
            payoutWayRadio: $('#payout-form input:radio#payout_way'),
            payoutPaypalBlock: $('#payout-form #paypal-block'),
            payoutPaypalForm: $('#payout-form #paypal-block #paypal-form'),
            payoutWesterunionBlock: $('#payout-form #westernunion-block'),
            payoutWesterunionForm: $('#payout-form #westernunion-block #westernunion-form'),
            payoutCampaignSelect: $('#payout-form #campaign')
        };
    },
    
    init: function() {
        var $this = this;
        $this._map();
        $this.map.payoutPaypalForm.load('paypal');
        $this.map.payoutNextButton.click(function() { return $this.payoutNext(this); });
        $this.map.payoutWayRadio.change(function() { return $this.showForm(this)});
        $this.map.payoutForm.ajaxForm({
            dataType: 'json',
            success: function(response) { return $this.createPayout(response); }
        });
    },

    payoutNext: function() {
        var $this = this;
        var mail = $this.map.payoutMail.val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/payout/checkMail',
            cache: false,
            data: { mail: mail },
            success: function (response) { PayoutHelper.checkMail(response); },
        });
        return false;
    },

    checkMail: function(response)
    {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();
       
        if(response.result == 'success')
        {
            $this.map.payoutDetails.removeClass('hidden');
            $this.map.payoutMail.attr('readonly', 'true');
            $this.map.payoutNextButton.addClass('hidden');
            $this.map.payoutCreateButton.removeClass('hidden');
            $.each(response.campaign, function(key, value) {
                $this.map.payoutCampaignSelect.append($("<option></option>", {
                    value: key,
                    text: value
                }));
            });
        }
        else if(response.result == 'fail')
        {
            $this.map.payoutStatusFail.removeClass('hidden');
            $this.map.payoutMailError.removeClass('hidden');
            $this.map.payoutMailError.html(response.errors);
            $this.map.payoutMailRow.find('label').addClass('has-error text-danger');
            $this.map.payoutMailRow.find('input').addClass('has-error text-danger');
        }
    },

    showForm: function(element) {
        var $this = this;
        switch($(element).val()) {
            case 'paypal':
                if($this.map.payoutPaypalForm.html() == '') {
                    $this.map.payoutPaypalForm.load('paypal');
                } else {
                    $this.map.payoutPaypalBlock.removeClass('hidden');
                }
                $this.map.payoutWesterunionBlock.addClass('hidden');
                break;
            
            case 'westernunion':
                if($this.map.payoutWesterunionForm.html() == '') {
                    $this.map.payoutWesterunionForm.load('westernunion');
                } else {
                    $this.map.payoutWesterunionBlock.removeClass('hidden');
                }
                $this.map.payoutPaypalBlock.addClass('hidden');    
                break;
        }
    },

    createPayout: function(response)
    {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();
        if (response.result == 'fail') {
            $this.map.payoutStatus.find('#status-' + response.result).removeClass('hidden');
            for (error in response.errors) {
                var errorElement = error != 'mail' ? '#' + error + '-error-row' : '#payout-' + error + '-error-row';
                $this.map.payoutForm.find(errorElement).removeClass('hidden');
                $this.map.payoutForm.find(errorElement).html(response.errors[error][0]);
                $this.map.payoutForm.find('#' + error + '-row').addClass('error');
                
                var row = error != 'mail' ? '#' + error + '-row' : '#payout-' + error + '-row';            
                $(row).find('label').addClass('has-error text-danger');
                if(error == 'country')
                    $(row).find('select').addClass('has-error text-danger');   
                else 
                    $(row).find('input').addClass('has-error text-danger');
            }
        } else {
            $('#payout-modal').modal('hide');
            $this.map.payoutMail.removeAttr('readonly');
            $this.map.payoutCampaignSelect.empty();
            $this.map.payoutForm.resetForm();
            $this.map.payoutDetails.addClass('hidden');
            $this.map.payoutNextButton.removeClass('hidden');
            $this.map.payoutCreateButton.addClass('hidden');
            location.reload();
        }
        return false;
    },
        
    hideMessages: function() {
        var $this = this;
        $this.map.payoutStatus.find('div').addClass('hidden');
    },
    
    hideErrors: function() {
        var $this = this;
        //$this.map.payoutForm.find('.form-group').removeClass('error');
        $this.map.payoutForm.find('div.text-danger').addClass('hidden');
        $this.map.payoutForm.find('label.text-danger').removeClass('has-error text-danger');
        $this.map.payoutForm.find('input.text-danger').removeClass('has-error text-danger');
        $this.map.payoutForm.find('select.text-danger').removeClass('has-error text-danger');
    }
};

$(function() {
    PayoutHelper.init();
});