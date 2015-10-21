
var WidgetHelper = {
    map: {},

    _map: function () {
    	this.map = {
    		container: $('#container'),
    		backing: $('#backing'),
    		containerTabs: $('.tabs-container > div'),
    		navigationLinks: $('.tabs-navigation a'),
            tabPayoutStatistic: $('#tab-payout-statistic'),
            tabPayoutCreate: $('#tab-payout-create'),
            tabMailsList: $('#tab-mail-list'),
            tabMailsImport: $('#tab-mail-import')
    	};
    },
    
    init: function (page) {
        var $this = this;
        $this._map();
        $this.hideBacking();
        $this.initTabs();
    },
    
    hideBacking: function () {
        var $this = this;
    	$this.map.backing.hide();
    },
    
    initTabs: function () {
        var $this = this;
        $this.map.containerTabs.hide().filter(':first').show();
        $this.map.navigationLinks.click(function() { return $this.selectTab(this); });
        $this.map.navigationLinks.filter(':first').click();            
    },
    
    selectTab: function (element) {
        var $this = this;
        var tabName = element.hash;
        $this.map.containerTabs.hide();
        $this.map.containerTabs.filter(tabName).show();
        $this.map.navigationLinks.parent('li').removeClass('selected');
        $(element).parent('li').addClass('selected');
        $this.loadTab(tabName);
        //return false;
    },
    
    loadTab: function (tabName) {
        var $this = this;
        $this.loadContent(tabName, $this.map.tabPayoutStatistic);
        $this.loadContent(tabName, $this.map.tabPayoutCreate);
        $this.loadContent(tabName, $this.map.tabMailsList);
        return false;
    },
    
    loadContent: function (tabName, element) {
        var $this = this,
            actionName = tabName.substr(5),
            url = 'track/' + actionName.replace('-', '/');
            
        if (tabName.substr(1) == element.attr('id')
                && element.find('.content-block') != undefined) {
            element.find('.content-block').load(url, function() {
                element.find('img.loader').hide();
                $this.map.container.find('.tabs-navigation a').click(function() { return $this.selectTab(this); });
            });
        }
        return false;
    }
};

$(function () {
    WidgetHelper.init();
});