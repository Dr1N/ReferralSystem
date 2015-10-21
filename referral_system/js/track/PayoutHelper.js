
var PayoutHelper = {
    map: {},

    _map: function() {
    	this.map = {
            payaoutTab: $('#tab-payout-create'),
            requestPayoutForm: $('#request-form'),
    	    requestWayRadio: $('#request-form input:radio[name="payout_way"]'),
    	    requestAmountField: $('#request-form #request-payout-form #amount-row'),
    	    requestPaypalBlock: $('#request-form #paypal-block'),
            requestPaypalForm: $('#request-form #paypal-block #paypal-form'),
            requestWesterunionBlock: $('#request-form #westernunion-block'),
            requestWesterunionForm: $('#request-form #westernunion-block #westernunion-form'),
            requestPayoutStatus: $('#request-form #request-payout-status'),
            requestPayoutButton: '#create-button'
        };
    },
    
    init: function() {
        var $this = this;
        $this._map();
        $this.map.requestPaypalForm.load('track/payout/paypal');
        $this.map.requestWayRadio.change(function() { return $this.showForm(this)});
        PayoutHelper.buttonInit();
    },

    buttonInit: function() {
        var $this = this;
        $this.map.payaoutTab.on('click',$this.map.requestPayoutButton, function() {
            $.ajax({
                'type':'POST',
                'dataType':'JSON',
                'success':function (response) { PayoutHelper.createPayout(response); },
                'url':'track/payout/createPayout',
                'cache':false,
                'data':$(this).parents("form").serialize()
            });
            return false;
        });
    },
    
    showForm: function(element) {
        var $this = this;
        switch($(element).val()) {
	        case 'paypal':
               	if($this.map.requestPaypalForm.html() == '') {
                    $this.map.requestPaypalForm.load('track/payout/paypal');
	       		} else {
                    $this.map.requestPaypalBlock.removeClass('hidden');
	       		}
	       		$this.map.requestWesterunionBlock.addClass('hidden');
	        	break;
	        case 'westernunion':
              	if($this.map.requestWesterunionForm.html() == '') {
                   	$this.map.requestWesterunionForm.load('track/payout/westernunion');
	        	} else {
                    $this.map.requestWesterunionBlock.removeClass('hidden');
	        	}
	        	$this.map.requestPaypalBlock.addClass('hidden');	
	        	break;
		}
    },

    createPayout: function (response) {
        var $this = this;
        $this.hideErrors();
        $this.hideMessages();
        $this.map.requestPayoutStatus.find('#status-' + response.result).removeClass('hidden');
        if (response.result == 'fail') {
            for (error in response.errors) {
                var errorElement = '#' + error + '-error-row';
                $this.map.requestPayoutForm.find(errorElement).removeClass('hidden');
                $this.map.requestPayoutForm.find(errorElement).html(response.errors[error][0]);
                $this.map.requestPayoutForm.find('#' + error + '-row').addClass('error');
            }
        } else {
            $this.map.requestPayoutForm.find('input:text').val(''); 
        }
    },

    hideMessages: function() {
        var $this = this;
        $this.map.requestPayoutStatus.find('div').addClass('hidden');
    },
    
    hideErrors: function() {
        var $this = this;
        $this.map.requestPayoutForm.find('.form-group').removeClass('error');
        $this.map.requestPayoutForm.find('.text-danger').addClass('hidden');
    }
};

/*$(function () {
   PayoutHelper.init();
});*/