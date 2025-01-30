Settings_Vtiger_List_Js("Settings_ParsVT_SensitiveFieldsList_Js",{
	viewSensitiveLog: function (record) {
		app.helper.showProgress();
		var params = {
			'module': 'ParsVT',
			'action': 'Fields',
			'mode': 'viewSensitiveLog',
			'record': record
		};
		app.request.post({data: params}).then(
			function (err, data) {
				if (err == null) {
					app.helper.showModal(data);
					app.helper.hideProgress();
				}
			}
		);
	}
},{

	initializePaginationEvents: function () {
		var thisInstance = this;
		var paginationObj = this.getComponentInstance('Vtiger_Pagination_Js');
		var listViewContainer = thisInstance.getListViewContainer();
		paginationObj.initialize(listViewContainer);
		app.event.on(paginationObj.nextPageButtonClickEventName, function () {
			var pageLimit = listViewContainer.find('#pageLimit').val();
			var noOfEntries = listViewContainer.find('#noOfEntries').val();
			var nextPageExist = listViewContainer.find('#nextPageExist').val();
			var pageNumber = listViewContainer.find('#pageNumber').val();
			var nextPageNumber = parseInt(parseFloat(pageNumber)) + 1;
			if (noOfEntries === pageLimit && nextPageExist) {
				listViewContainer.find("#pageNumber").val(nextPageNumber);
				pageNumber = listViewContainer.find('#pageNumber').val();
				var module = 'ParsVT';
				var parent = 'Settings';
				var orderBy = listViewContainer.find('[name="orderBy"]').val();
				var sortOrder = listViewContainer.find('[name="sortOrder"]').val();
				var appName = listViewContainer.find('#appName').val();
				var search_params = {};
				if ($("#sensitive_performedon").length > 0 && $("#sensitive_performedon").val() != '') {
					search_params['performedon'] = $("#sensitive_performedon").val();
				}
				if ($("#sensitive_record_id").length > 0 && $("#sensitive_record_id").val() != '') {
					search_params['record_id'] = $("#sensitive_record_id").val();
				}
				if ($("#sensitive_fieldname").length > 0 && $("#sensitive_fieldname").val() != '') {
					search_params['fieldname'] = $("#sensitive_fieldname").val();
				}
				if ($("#moduleName").length > 0 && $("#moduleName").val() != '') {
					search_params['module'] = $("#moduleName").val();
				}
				if ($("#sensitive_whodid").length > 0 && $("#sensitive_whodid").val() != '') {
					search_params['whodid'] = $("#sensitive_whodid").val();
				}
				if ($("#sensitive_action").length > 0 && $("#sensitive_action").val() != '') {
					search_params['action'] = $("#sensitive_action").val();
				}
				var params = {
					'module': module,
					'parent': parent,
					'page': pageNumber,
					'view': "SensitiveFieldsList",
					'orderby': orderBy,
					'sortorder': sortOrder,
					'search_params' : JSON.stringify(search_params)
				}
				window.location.href = 'index.php?'+$.param(params);
				return true;
				//thisInstance.loadListViewRecords(urlParams);
			}
		});

		app.event.on(paginationObj.previousPageButtonClickEventName, function () {
			var pageNumber = listViewContainer.find('#pageNumber').val();
			var previousPageNumber = parseInt(parseFloat(pageNumber)) - 1;
			if (pageNumber > 1) {
				listViewContainer.find("#pageNumber").val(previousPageNumber);
				pageNumber = listViewContainer.find('#pageNumber').val();
				var module = 'ParsVT';
				var parent = 'Settings';
				var orderBy = listViewContainer.find('[name="orderBy"]').val();
				var sortOrder = listViewContainer.find('[name="sortOrder"]').val();
				var appName = listViewContainer.find('#appName').val();
				var search_params = {};
				if ($("#sensitive_performedon").length > 0 && $("#sensitive_performedon").val() != '') {
					search_params['performedon'] = $("#sensitive_performedon").val();
				}
				if ($("#sensitive_record_id").length > 0 && $("#sensitive_record_id").val() != '') {
					search_params['record_id'] = $("#sensitive_record_id").val();
				}
				if ($("#sensitive_fieldname").length > 0 && $("#sensitive_fieldname").val() != '') {
					search_params['fieldname'] = $("#sensitive_fieldname").val();
				}
				if ($("#moduleName").length > 0 && $("#moduleName").val() != '') {
					search_params['module'] = $("#moduleName").val();
				}
				if ($("#sensitive_whodid").length > 0 && $("#sensitive_whodid").val() != '') {
					search_params['whodid'] = $("#sensitive_whodid").val();
				}
				if ($("#sensitive_action").length > 0 && $("#sensitive_action").val() != '') {
					search_params['action'] = $("#sensitive_action").val();
				}
				var params = {
					'module': module,
					'parent': parent,
					'page': pageNumber,
					'view': "SensitiveFieldsList",
					'orderby': orderBy,
					'sortorder': sortOrder,
					'search_params' : JSON.stringify(search_params)
				}
				window.location.href = 'index.php?'+$.param(params);
				return true;
			}
		});

		app.event.on(paginationObj.pageJumpButtonClickEventName, function (event, currentEle) {
			thisInstance.pageJump();
		});

		app.event.on(paginationObj.totalNumOfRecordsButtonClickEventName, function (event, currentEle) {
			thisInstance.totalNumOfRecords(currentEle);
		});

		app.event.on(paginationObj.pageJumpSubmitButtonClickEvent, function (event, currentEle) {
			thisInstance.pageJumpOnSubmit(currentEle);
		});
	},

	pageJumpOnSubmit: function (element) {
		var thisInstance = this;
		var container = this.getListViewContainer();
		var currentPageElement = container.find('#pageNumber');
		var currentPageNumber = parseInt(currentPageElement.val());
		var newPageNumber = parseInt(container.find('#pageToJump').val());
		var totalPages = parseInt(container.find('#totalPageCount').text());
		if (newPageNumber > totalPages) {
			var message = app.vtranslate('JS_PAGE_NOT_EXIST');
			app.helper.showErrorNotification({'message': message})
			return;
		}

		if (newPageNumber === currentPageNumber) {
			var message = app.vtranslate('JS_YOU_ARE_IN_PAGE_NUMBER') + " " + newPageNumber;
			app.helper.showAlertNotification({'message': message});
			return;
		}

		element.closest('.btn-group ').removeClass('open');

		var module = 'ParsVT';
		var parent = 'Settings';
		var orderBy = container.find('[name="orderBy"]').val();
		var sortOrder = container.find('[name="sortOrder"]').val();
		var search_params = {};
		if ($("#sensitive_performedon").length > 0 && $("#sensitive_performedon").val() != '') {
			search_params['performedon'] = $("#sensitive_performedon").val();
		}
		if ($("#sensitive_record_id").length > 0 && $("#sensitive_record_id").val() != '') {
			search_params['record_id'] = $("#sensitive_record_id").val();
		}
		if ($("#sensitive_fieldname").length > 0 && $("#sensitive_fieldname").val() != '') {
			search_params['fieldname'] = $("#sensitive_fieldname").val();
		}
		if ($("#moduleName").length > 0 && $("#moduleName").val() != '') {
			search_params['module'] = $("#moduleName").val();
		}
		if ($("#sensitive_whodid").length > 0 && $("#sensitive_whodid").val() != '') {
			search_params['whodid'] = $("#sensitive_whodid").val();
		}
		if ($("#sensitive_action").length > 0 && $("#sensitive_action").val() != '') {
			search_params['action'] = $("#sensitive_action").val();
		}
		var params = {
			'module': module,
			'parent': parent,
			'page': newPageNumber,
			'view': "SensitiveFieldsList",
			'orderby': orderBy,
			'sortorder': sortOrder,
			'search_params' : JSON.stringify(search_params)
		}
		window.location.href = 'index.php?'+$.param(params);
	},

    /**
   	 * Function to get Page Jump Params
   	 */
   	getPageJumpParams : function(){
   		var module = app.getModuleName();
   		var parent = app.getParentModuleName();
		var search_params = {};
		if ($("#sensitive_performedon").length > 0 && $("#sensitive_performedon").val() != '') {
			search_params['performedon'] = $("#sensitive_performedon").val();
		}
		if ($("#sensitive_record_id").length > 0 && $("#sensitive_record_id").val() != '') {
			search_params['record_id'] = $("#sensitive_record_id").val();
		}
		if ($("#sensitive_fieldname").length > 0 && $("#sensitive_fieldname").val() != '') {
			search_params['fieldname'] = $("#sensitive_fieldname").val();
		}
		if ($("#moduleName").length > 0 && $("#moduleName").val() != '') {
			search_params['module'] = $("#moduleName").val();
		}
		if ($("#sensitive_whodid").length > 0 && $("#sensitive_whodid").val() != '') {
			search_params['whodid'] = $("#sensitive_whodid").val();
		}
		if ($("#sensitive_action").length > 0 && $("#sensitive_action").val() != '') {
			search_params['action'] = $("#sensitive_action").val();
		}
   		var pageJumpParams = {
   			'module' : module,
   			'parent' : parent,
   			'view' : "SensitiveFieldsListAjax",
   			'mode' : "getPageCount",
   			'search_params' : search_params,
   		};
   		return pageJumpParams;
   	},
	/**
	 * Function to register the list view row search event
	 */
	registerSensitiveListViewSearch: function () {
		var listViewPageDiv = this.getListViewContainer();
		var thisInstance = this;
		var module = app.getModuleName();
		var parent = app.getParentModuleName();
		listViewPageDiv.on('click', '[data-trigger="sensitive_listSearch"]', function (e) {
			e.preventDefault();
			var search_params = {};
			if ($("#sensitive_performedon").length > 0 && $("#sensitive_performedon").val() != '') {
				search_params['performedon'] = $("#sensitive_performedon").val();
			}
			if ($("#sensitive_record_id").length > 0 && $("#sensitive_record_id").val() != '') {
				search_params['record_id'] = $("#sensitive_record_id").val();
			}
			if ($("#sensitive_fieldname").length > 0 && $("#sensitive_fieldname").val() != '') {
				search_params['fieldname'] = $("#sensitive_fieldname").val();
			}
			if ($("#moduleName").length > 0 && $("#moduleName").val() != '') {
				search_params['module'] = $("#moduleName").val();
			}
			if ($("#sensitive_whodid").length > 0 && $("#sensitive_whodid").val() != '') {
				search_params['whodid'] = $("#sensitive_whodid").val();
			}
			if ($("#sensitive_action").length > 0 && $("#sensitive_action").val() != '') {
				search_params['action'] = $("#sensitive_action").val();
			}
 		var myData = {
 			'module' : module,
 			'parent' : parent,
 			'view' : "SensitiveFieldsList",
			'page': '1',
 			'search_params' : JSON.stringify(search_params),
 		};
			window.location.href = 'index.php?'+$.param(myData);
		});
		listViewPageDiv.on('click', '[data-trigger="sensitive_ClearSearch"]', function (e) {
			e.preventDefault();
 		var myData = {
 			'module' : module,
 			'parent' : parent,
 			'view' : "SensitiveFieldsList"
 		};
			window.location.href = 'index.php?'+$.param(myData);
		});
	},
    registerEvents : function() {
        this._super();
        this.registerSensitiveListViewSearch();
    }
    
});
