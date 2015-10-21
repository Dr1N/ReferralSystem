
var FrontHelper = {
    map: {},

    init: function (page) {
        var $this = this;
        $this.general();
        
        switch(page)
        {
            case 'colleague_list':
                $this.colleagueList();
                break;
            case 'user_update':
                $this.entityUpdate();
                break; 
            case 'campaign_update':
                $this.entityUpdate();
                break; 
        }
    },
    
    general: function () {
        var $this = this;
    	$('table').delegate('a.delete', 'click', function() {  return $this._deleteRecord(this); });
    },
    
    colleagueList: function () {
        var $this = this;
    	$('table').delegate('a.deleteLink', 'click', function() {  return $this._deleteLink(this); });
    },
    
    entityUpdate: function () { 
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
    
    _deleteLink: function (element) {
    	if(!confirm('Are you sure you want to delete this user from your organization?'))
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
            success: function (response) {},
        });
        return false;
    }
};

$(function () {
    FrontHelper.init(CONTROLLER + '_' + ACTION);
});