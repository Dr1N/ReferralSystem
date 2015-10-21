jqGridController = function() {
    
    var self = this; 
    var grid = null;
    var settings = {};
    var rowsPerPage = 20;
    var rowList = [20, 30, 50];
    var defaultHeight = 480;
    
    this.init = function(parameters) {
		self.settings = parameters;
   		self.grid = $('#' + self.settings.elementId);
    	
    	// Grif initialization
		if (self.settings.selectedScheme == undefined) {
			self.initGrid();
			self.gridBuildOptions();
		}
		else
			self.initGridScheme();
		
		self.initResizeGrid();
		self.initGridButtons();
		self.initSelectOptions();
    }
		
	// Grif initialization
    this.initGrid = function() {
		if (self.settings.extraNames != undefined) {
			self.settings.columnNames = self.settings.columnNames.concat(self.settings.extraNames);
			self.settings.columnModel = self.settings.columnModel.concat(self.settings.extraModel);
		}

		var parameters = {
			url : '/' + self.settings.module + '/grid',
			datatype : 'json',
			mtype : 'GET',
			colNames : self.settings.columnNames,
			colModel : self.settings.columnModel,
			pager : '#pager-' + self.settings.elementId,
			rowNum : rowsPerPage,
			rowList : rowList,
			viewrecords : true,
			height : defaultHeight,
			search: true,
			imgpath: '/images/jqgrid/',
			//postData: { filters: '{"groupOp":"AND","rules":[{"field":"fraud.id","op":"nn","data":""}]}'},
			//navigator: true,
			//scroll: true,
			grouping: true,
			//groupingView: { groupField : ['transaction.paydate'] },
			//gridComplete: self.addGridOptions,
			//autowidth: true,
		};
		
		if (self.settings.detailsId != undefined) {
			parameters.onSelectRow = function (id) {
				self.getContestInfo(id);
				self.getContestBilling(id);
			};
		}
		
		//parameters = $.extend(self.settings.parameters, parameters);
        parameters = $.extend(parameters, self.settings.parameters);
		self.grid.jqGrid(parameters);
   	}
   	
    this.initGridScheme = function() {
		self.settings.selectedScheme = $('#scheme').val();
		$.ajax({
		    url: '/fraudScheme/getScheme/id/' + self.settings.selectedScheme,
		    type: 'GET',
		    dataType: "json",
		    success: function (data) {
		    	
		    	// And missing extra fields
				data.remapColumns = new Array();
		    	for (var i = 0; i < self.settings.extraModel.length; i++) {
		    		var indexOfElement = data.colNames.indexOf(self.settings.extraNames[i]);
		    		if (indexOfElement == -1
							|| data.colModel[indexOfElement].name != self.settings.extraModel[i].name 
					    	|| data.colModel[indexOfElement].index != self.settings.extraModel[i].index
					    	|| data.colModel[indexOfElement].width != self.settings.extraModel[i].width) {
				    	data.colNames = data.colNames.concat(self.settings.extraNames[i]);
				    	data.colModel = data.colModel.concat(self.settings.extraModel[i]);
		    		}
		    	}
		    	
				$('#grid-' + self.settings.elementId).html('<table id="' + self.settings.elementId + '"></table><div id="pager-' + self.settings.elementId + '"></div>');	
		    	self.grid = $('#' + self.settings.elementId);
		    	self.grid.jqGrid(data);
		    	self.gridBuildOptions();
				self.grid.jqGrid('setGridParam', {
					onSelectRow: function (id) {
						self.getContestInfo(id);
						self.getContestBilling(id);
					}
				});
				self.grid.jqGrid('setGridParam', {
					gridComplete: self.addGridOptions
				});
		    },             
		});
   	}
   	
   	// Save the user’s grid options as a scheme
   	this.saveScheme = function() {
		var gridParameters = self.grid.getGridParam();
		gridParameters.remapColumns = new Array();
		var gridoptionsStr = JSON.stringify(gridParameters, self.stringifyReplacer);
		
		$('#' + self.settings.optionForm).val(gridoptionsStr);
		$('#' + self.settings.optionForm + '-scheme').submit();
   	}
	
   	// Replacer for serialisation the grid parameters
   	this.stringifyReplacer = function(key, value) {
	    if (typeof value === 'number' && !isFinite(value))
	        return String(value);
	    if (typeof value === 'string' && !isFinite(value))
	        return String(value).replace("&apos;","'");
	    return value;
   	}
	
	this.gridBuildOptions = function() {
		self.grid.setGridWidth($('#' + self.settings.contentId).width());
		self.grid.jqGrid('setFrozenColumns');
		
		// Set navigator with search enabled
		self.grid.jqGrid('navGrid', '#pager-' + self.settings.elementId, {
				add: false,
				edit: false,
				del: false
			}, {}, {}, {}, {
				multipleSearch: true,
				multipleGroup: true,
				showQuery: false,
				width: 600,
				top: -110,
				left: 220,
				overlay: 0
			}
		);
		
	    // Add the Choose Columns button
		self.grid.jqGrid('navButtonAdd', '#pager-' + self.settings.elementId, {
			caption: "",
			buttonicon: "ui-icon-calculator",
			title: "Choose Columns",
			onClickButton: function() {
				self.grid.jqGrid('columnChooser', {
					dialog_opts: {
						resizable: false,
					}
				});
			}
		});
		
		if (self.settings.headers != undefined) {
			// Add extra field header
			if (self.settings.firstExtraFields != undefined && self.settings.firstExtraFields != false)
				self.settings.headers = self.settings.headers.concat([{
					startColumnName: self.settings.firstExtraFields,
					numberOfColumns: 1000,
					titleText: 'Extra Checks'
				}
			]);
			
		    // Add the grouped headers
			self.grid.jqGrid('setGroupHeaders',{
				useColSpanStyle: false,
				groupHeaders : self.settings.headers
			});
		}
		
		// Remove grouping
		self.grid.jqGrid('groupingRemove', true);
   	}
   	
    this.initSelectOptions = function() {
	    // Add grouping
	    $('.chngroup').change(self.changeGrouping);
	    $('.delete-group').click(self.deleteGrouping);
	    $('.add-group').click(self.addGrouping);
     
	    // Add filtering
	    if (self.settings.filteringIds != undefined) {
		    for (var i = 0; i < self.settings.filteringIds.length; i++)
		    	$('#' + self.settings.filteringIds[i]).change(self.changeFiltering);
	    }
	    
	    // Add change scheme function
	    if (self.settings.schemeId != undefined)
	    	$('#' + self.settings.schemeId).change(self.initGridScheme);
		
		if (self.settings.detailsId != undefined)
		    $('#' + self.settings.detailsId).tabs();
   	}

	this.initGridButtons = function() {
	    // Reaction on the Advanced Search button click
	    if (self.settings.buttonSearch != undefined) {
		    $('#' + self.settings.buttonSearch).click(function(){
		    	$('.ui-icon-search').click();
		    	return false;
		    });
	    }
	    
	    // Reaction on the Grouping Parameters button click
	    if (self.settings.buttonGrouping != undefined) {
		    $('#' + self.settings.buttonGrouping).click(function(){
		    	$("#grouping-dialog").dialog();
		    	return false;
		    });
	    }
	    
	    // Save the user’s grid options as a scheme
	    if (self.settings.buttonScheme != undefined)
		    $('#' + self.settings.buttonScheme).click(self.saveScheme);
   	}

	// Grid resize on the window resize
    this.initResizeGrid = function() {
		$(window).bind('resize', function() {
			self.grid.setGridWidth($('#' + self.settings.contentId).width());
		}).trigger('resize');
   	}

	// Change grouping function
    this.changeGrouping = function() {
		var groupingElements = $('.chngroup').size(),
			currrentElements = null,
			groupingGroupBy = [];
			
		for (var i = 0; i < groupingElements; i++) {
			currrentElements = $('#chngroup-' + i);
			if (currrentElements.val() != '')
				groupingGroupBy.push(currrentElements.val());
		}
	
		self.grid.jqGrid('groupingGroupBy',groupingGroupBy);
   	}

    this.deleteGrouping = function() {
		$('#chngroup-' + $(this).data('id')).val('').css('display','none')
				.next().css('display','none');
		self.changeGrouping();
   	}

    this.addGrouping = function() {
		var groupingElements = $('.chngroup').size();
		$('.chngroup').first().clone(true).css('display','inline').attr('id', 'chngroup-' + groupingElements).appendTo('#grouping-dialog');
		$('.delete-group').first().clone(true).css('display','inline').data('id', groupingElements).appendTo('#grouping-dialog');	
   	}
   	
   	// Change filtering function
   	this.changeFiltering = function() {
		var filter = new Array();
	    
	    // Filtering by the status
		var status = $('#status').val();
	    if (status != '')
	        filter[filter.length] = '{"field":"t.status_int","op":"eq","data":"' + status + '"}';
	                    
	    // Filtering by the type
		var type = $('#type').val();
	    if (type != '')
	        filter[filter.length] = '{"field":"t.ctype","op":"eq","data":"' + type + '"}';
	    
	    // Filtering by the show field
		var show = $('#show').val();
		if (show == 'checked')
			filter[filter.length] = '{"field":"fraud.id","op":"nn","data":""}';
        else if (show == 'not_checked')
			filter[filter.length] = '{"field":"fraud.id","op":"nu","data":""}';
        
	    // Applying the filter
	    var filterStr = filter.join(',');
		self.grid.jqGrid('setGridParam', {
			postData: { filters: '{"groupOp":"AND","rules":[' + filterStr + ']}'},
		});
		self.grid[0].p.search = true;
		self.grid.trigger('reloadGrid');	
   	}
   	
	this.getContestInfo = function(id) {
		$.ajax({
		    url: '/contest/get/id/' + id,
		    type: 'GET',
		    dataType: "json",
		    success: function (data) {
				jQuery.each(data, function(key, value) {
					if($("#_" + key).attr('rel') == 'extra')
						$("#_" + key).val(value);
					else {
						if (value == null || value == '')
							value = 'empty';
						$("#_" + key).html(value);
					}
				});
				
				// Show/hide the "All the client's IPs" button
				$('#show-winner-ips').css('display', 'inline');
				// Show/hide the "All the winner's IPs" button if we have/don't have a contest winner
				var display = (data.winner_username != null) ? 'inline' : 'none';
				$('#show-winner-ips').css('display', display);
				// Add reload/reacquire maxmind values button in case if mm requests have run out
				var display = (data.fraud_mm_reload == 1) ? 'inline' : 'none';
				$('#mm-reload').css('display', display);
					
				$('#details').css('display', 'block');
				$('#extra-submit').attr('disabled', false);
				$('#client-ips-details').css('display', 'none');
				$('#winner-ips-details').css('display', 'none');
		    },             
		});
	}
	
	this.getContestBilling = function(id) {
		$.ajax({
		    url: '/fraudDetectionDetail/getList/contestId/' + id,
		    type: 'GET',
		    dataType: "json",
		    success: function (data) {
		    	var isShown = parseInt(data.records, 10) == 0 ? 'none' : 'block';
		    	$('#detection-details').css('display', isShown);
		    	var detailStr = '';
	            if (data.rows != undefined) {
	    			jQuery.each(data.rows, function(key, value) {
	    				detailStr += '<tr>'
		    				+ '<td>' + value.billing_address_1 + '</td>'
		    				+ '<td>' + value.billing_address_2 + '</td>'
		    				+ '<td class="credit-card-end">*' + value.credit_card_end + '</td>'
		    				+ '<td>' + value.expiry_date + '</td>'
		    				+ '<td>' + value.phone + '</td>'
		    				+ '</tr>';
	    			});
	            }
				$('#details-table tbody').html(detailStr);
		    },             
		});
	}
}

jqGrid = new jqGridController();