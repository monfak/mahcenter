/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class('ParsVTManual_Js', {}, {
	registerActiveEvent : function() {
		var InstallModule = jQuery('#InstallModule');
		InstallModule.on('click', '.runtime', function(e) {
			var params = {};
			params['module'] = app.getModuleName();
			params['parent'] = app.getParentModuleName();
			params['action'] = 'PersianPack';
			params['mode'] = 'Manual';
            var progressIndicatorElement = jQuery.progressIndicator({
                'message': '',
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });
            AppConnector.request(params).then(
                function (data) {
                    app.helper.hideProgress();
                    if (data.success) {
                        app.helper.showSuccessNotification({
                            message: data.result.message
                        });
                        if (data.result.refresh) {
                            setTimeout(function () {
                                window.location.reload(1);
                            }, 3000);
                        }
                    }
                },
                function (error) {
                    console.log('error =', error);
                    app.helper.hideProgress();
                }
            );
            return false;
		});
	},
	/**
	 * Function to register events
	 */
	registerEvents : function(){
		this.registerActiveEvent();
	}
})
jQuery(document).ready(function(){
	var ParsVTManualInstance = new ParsVTManual_Js();
	ParsVTManualInstance.registerEvents();
})