/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class("DBAction_Js", {}, {
    registerEventForUpgradeButton: function () {
        var that = this;
        jQuery('.fixError').on('click', function () {
            var progressIndicatorElement = jQuery.progressIndicator({
                'message': '',
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });

            var params = {};
            params['module'] = app.getModuleName();
            params['action'] = 'DBAction';
            params['mode'] = 'fixError';
            params['parent'] = 'Settings';
            //params['data'] = formData;
            AppConnector.request(params).then(
                function (data) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    if (data.success && data.success == true) {
                        app.helper.showSuccessNotification({'message': data.result});
                    } else if (data.error) {
                        app.helper.showErrorNotification({'message': data.error.code});
                    }
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 3000);
                },
                function (error) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    app.helper.showErrorNotification({'message': app.vtranslate('Operation Failed : Error !')});
                }
            );
        });
    },

    showNotify: function (customParams) {
        var params = {
            title: app.vtranslate('JS_MESSAGE'),
            text: customParams.text,
            animation: 'show',
            type: customParams.type
        };
        Vtiger_Helper_Js.showPnotify(params);
    },
    registerEvents: function () {
        this.registerEventForUpgradeButton();
    }
});


jQuery(document).ready(function () {
    var DBActions = new DBAction_Js();
    DBActions.registerEvents();
})