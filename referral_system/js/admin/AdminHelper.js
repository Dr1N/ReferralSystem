
var AdminHelper = {
    map: {},

    init: function (page) {
        var $this = this;
        $this.general();
        
        switch(page)
        {
            case 'page_update':
            case 'page_create':
                $this.adminPageUpdate();
                break;
            case 'user_update':
                $this.adminUserUpdate();
                break;
            case 'campaign_update':
                $this.entityUpdate();
                break; 
        }
    },
    
    general: function () {
        var $this = this;
    	$('table').delegate('a.delete', 'click', function() { return $this._deleteRecord(this); });
    },
    
    adminPageUpdate: function () {
    	$('#show_meta_fields').on('click', function(){
        	$('#meta_fields').toggleClass('hidden');
            return false;
    	});
    },

    entityUpdate: function () { 
        var $this = this;
        $('#delete-image').on('click', function() { return $this._deleteImage(this); });
    },

    adminUserUpdate: function () {
        var $this = this;
        $('#delete-image').on('click', function() { return $this._deleteImage(this); });
    },

    _deleteRecord: function (element) {
    	if(!confirm('Are you sure you want to delete this item?'))
    		return false;
        $.ajax({
    	    url: $(element).attr('href'),
    	    type: 'POST',
     		success: function (data) {
     			window.location.href = window.location.href;
    		},
    	});
    	return false;
    },

    _deleteImage: function (element) {
        if(!confirm('Are you sure you want to delete this image?'))
            return false;
        $('#image-container').addClass('hidden');
        $.ajax({
            url: $(element).attr('href'),
            type: 'POST',
            success: function (response) {}
        });
        return false;
    }
};

$(function () {
    AdminHelper.init(CONTROLLER + '_' + ACTION);
});