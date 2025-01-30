/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class('ParsVT_EditLabel_Js', {}, {
	registerSaveButtonEvent : function() {
  jQuery('.btn-success').on('click',function(e){ 
          var form = jQuery('#moduleBlocksAndFields');
          var formData = form.serializeFormData();
          //alert(formData.toSource());

          if(typeof formData !== undefined){
          var progressIndicatorElement = jQuery.progressIndicator({
           'position' : 'html',
           'blockInfo' : {
            'enabled' : true
           }
          });
          var actionParams = {
                       'module' : app.getModuleName(),
						//'parent' : app.getParentModuleName(),
						'action' : 'SaveLabel',
                        'data': formData,
                    };
          //alert(JSON.stringify(actionParams));
          AppConnector.request(actionParams).then(
           function(data) {

            progressIndicatorElement.progressIndicator({
             'mode' : 'hide'
            });
            app.helper.showSuccessNotification({'message': app.vtranslate(data.result.message)});
           },
           function(error,err){
        
           }
          );
  }
         })
    },	
    
	registerBackLink : function(){
        jQuery('#backLink').on('click',function(e){
                window.history.back();
            });		
	},
	
	registerEvents : function(){
            this.registerBackLink();
            this.registerSaveButtonEvent(); 
	}
});
jQuery(document).ready(function(){
	var ParsVTEditLabelJsInstance = new ParsVT_EditLabel_Js();
	ParsVTEditLabelJsInstance.registerEvents();
})
