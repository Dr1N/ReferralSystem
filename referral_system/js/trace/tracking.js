
var tracking = {
    
    base_url: 'http://216.194.168.62/', // !!!!!!!!!!!!!!!!!!!
    type: null,
    campaign_id: null,
    code_id: null,
    purchase_id: null,

    init: function (type, campaign_id, code_id, purchase_id) {
        tracking.type = type;
        tracking.campaign_id = campaign_id;
        tracking.code_id = code_id;
        if (purchase_id != undefined) {
            tracking.purchase_id = purchase_id;
        }
    },
    
    track: function () {
        var xmlhttp;
        var url = tracking.base_url + 'trace/' + tracking.type + '/campaign_id/' + tracking.campaign_id + '/code_id/' +tracking.code_id + '/';
        if (tracking.purchase_id != null) {
            url += 'purchase_id/' + tracking.purchase_id; 
        }

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById('myDiv').innerHTML = xmlhttp.responseText;
            }
        }
        
        xmlhttp.open('GET', url, true);
        xmlhttp.send();
    }
}

tracking.init(track_type, track_campaign_id, track_code_id);
tracking.track();