
var PayoutUpdateHelper = {
    map: {},

    _map: function() {
        this.map = {
            updateButton: $('.nowrap a.update'),
            updateForm: $('#payout-update-form'),
            updateStatus: $('#payout-update-form #payout-update-status'),
            updateContainer: $('#payout-update'),
        };
    },
    
    init: function() {
        var INIT_TIME = 1000;
        var $this = this;

        //wait update button (delegation?)     
        setTimeout(function() {
            $this._map();
            $this.map.updateButton.click(function() { return $this.updateShowForm(this); });
        }, INIT_TIME );
     },

    updateShowForm: function(element){
        var INIT_TIME = 1000;
        var $this = this;
        $this.map.updateContainer.removeClass('hidden');
        $this.map.updateContainer.load($(element).attr('href'));
        //connection ajaxForm to modal form (see _form.php)
        // setTimeout(function() {
        //     $('#payout-update-form').ajaxForm({
        //         dataType: 'json',
        //         url: 'updatePayout',
        //         success: function(response) { return $this.updateSave(response); }
        //     });
        // }, INIT_TIME);
        return false;
    },

    updateSave: function(response){
        var $this = this;
        $this.hideMessages();
        $this.hideErrors();
        if(response.result == 'fail'){
            $this.map.updateStatus.find('#status-' + response.result).removeClass('hidden');
            for (error in response.errors){
                var errorElement = '#' + error + '-error-row';
                $this.map.updateForm.find(errorElement).removeClass('hidden');
                $this.map.updateForm.find(errorElement).html(response.errors[error][0]);
                $this.map.updateForm.find('#' + error + '-row').addClass('error');
            }
        } else if(response.result == 'success'){
            $('#payout-update-modal').modal('hide');
            $this.map.updateContainer.addClass('hidden');
            $this.map.updateContainer.html("");
            location.reload();
        }
        return false;
    },

    hideMessages: function() {
        var $this = this;
        $this.map.updateStatus.find('div').addClass('hidden');
    },
    
    hideErrors: function() {
        var $this = this;
        $this.map.updateForm.find('.form-group').removeClass('error');
        $this.map.updateForm.find('.text-danger').addClass('hidden');
    }
};

$(function() {
    PayoutUpdateHelper.init();
});