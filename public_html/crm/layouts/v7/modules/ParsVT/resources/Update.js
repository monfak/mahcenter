/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class('ParsVT_Js', {}, {
	registerActiveEvent : function() {
		var InstallModule = jQuery('#InstallModule');
		InstallModule.on('click', '.runtime', function(e) {
			var params = {};
			params['module'] = app.getModuleName();
			params['parent'] = app.getParentModuleName();
			params['action'] = 'Update';
            if (confirm(app.vtranslate('Are you sure you want to continue?'))) { } else {return;}
           
			AppConnector.request(params).then(
				function(data) {
					var params = {};
					params['text'] = data.result;
					jQuery('#installation_step3').show();	
					jQuery('#newinstall').hide();	
					jQuery('#installed').show();	
					Settings_Vtiger_Index_Js.showMessage(params);
  					
				},
				function(error) {
					var params = {};
					params['text'] = error;
					Settings_Vtiger_Index_Js.showMessage(params);
				}
			);
		})
	},

    /*
     * Function to show the confirmation messagebox
     */
    showConfirmationBox : function(data){
        var aDeferred = jQuery.Deferred();
        var bootBoxModal = bootbox.confirm(data['message'],app.vtranslate('JS_CANCEL'),app.vtranslate('JS_DELETE'), function(result) {
            if(result){
                aDeferred.resolve();
            } else{
                aDeferred.reject();
            }
        });

        bootBoxModal.on('hidden',function(e){
            //In Case of multiple modal. like mass edit and quick create, if bootbox is shown and hidden , it will remove
            // modal open
            if(jQuery('#globalmodal').length > 0) {
                // Mimic bootstrap modal action body state change
                jQuery('body').addClass('modal-open');
            }
        })
        return aDeferred.promise();
    },
	
	/**
	 * Function to register events
	 */
	registerEvents : function(){
		this.registerActiveEvent();
	}
})
jQuery(document).ready(function(){
	var UpdateInstance = new ParsVT_Js();
	UpdateInstance.registerEvents();
});