/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class("ParsVTLTVCalculator_Js", {
    getInstance: function () {
        return new ParsVTLTVCalculator_Js();
    }
}, {

    ltv_values : {},
    setLVTValues: function () {
        var instance = this;
        if (jQuery('#ltv_values').length > 0) {
            instance.ltv_values = JSON.parse(jQuery('#ltv_values').val());
        }
    },
    SourceModuleUpdate: function () {
        var instance = this;
        jQuery('#modulename').on('change', function (e) {
            var module1 = jQuery(this).val();
            jQuery('#statusfield').find('option').remove().end().append('<option value="">--</option>').val('--').trigger('liszt:updated');
            jQuery('#datefield').find('option').remove().end().append('<option value="-">--</option>').val('--').trigger('liszt:updated');
            jQuery('#currencyfield').find('option').remove().end().append('<option value="-">--</option>').val('--').trigger('liszt:updated');
            jQuery('#fieldname').find('option').remove().end().append('<option value="-">--</option>').val('--').trigger('liszt:updated');
            app.helper.showProgress();
            //by hamid
            jQuery("#statusfield").html('');
            jQuery("#statusfield").val(null);
            jQuery("#datefield").html('');
            jQuery("#datefield").val(null);
            jQuery("#currencyfield").html('');
            jQuery("#currencyfield").val(null);
            jQuery("#fieldname").html('');
            jQuery("#fieldname").val(null);
            jQuery.each(instance.ltv_values[module1]['currencyfield'], function (i, item) {
                var o = new Option(item, i);
                jQuery(o).html(item);
                jQuery("#currencyfield").append(o);
            });
            jQuery("#currencyfield").select2();
            jQuery("#currencyfield").trigger('liszt:updated');
            jQuery.each(instance.ltv_values[module1]['datefield'], function (i, item) {
                var o = new Option(item, i);
                jQuery(o).html(item);
                jQuery("#datefield").append(o);
            });
            jQuery("#datefield").select2();
            jQuery("#datefield").trigger('liszt:updated');

            jQuery.each(instance.ltv_values[module1]['fields'], function (i, item) {
                var o = new Option(item, i);
                jQuery(o).html(item);
                jQuery("#fieldname").append(o);
            });
            jQuery("#fieldname").select2();
            jQuery("#fieldname").trigger('liszt:updated');

            var status_field = Object.keys(instance.ltv_values[module1]['fields'])[0];
            jQuery.each(instance.ltv_values[module1]['statusfields'][status_field], function (i, item) {
                var o = new Option(item, i);
                jQuery(o).html(item);
                jQuery("#statusfield").append(o);
            });
            jQuery("#statusfield").select2();
            jQuery("#statusfield").trigger('liszt:updated');
            app.helper.hideProgress();
        });
        jQuery('#fieldname').on('change', function (e) {
            var fieldname1 = jQuery(this).val();
            var module1 = jQuery('#modulename').val();
            jQuery('#statusfield').find('option').remove().end().append('<option value="">--</option>').val('--').trigger('liszt:updated');
            app.helper.showProgress();
            jQuery.each(instance.ltv_values[module1]['statusfields'][fieldname1], function (i, item) {
                var o = new Option(item, i);
                jQuery(o).html(item);
                jQuery("#statusfield").append(o);
            });
            jQuery("#statusfield").select2();
            jQuery("#statusfield").trigger('liszt:updated');
            app.helper.hideProgress();
        });
    }, SaveRecord: function () {
        jQuery('#customViewSubmit').on('click', function (e) {
            if (jQuery('#statusfield').val() != '' && jQuery('#statusfield').val() != null) {
                jQuery('#status_values').val(jQuery('#statusfield').val().join());
            } else {
                app.helper.showErrorNotification({message: app.vtranslate('Please choose one status')});
                event.preventDefault();
                return false;
            }
            if (jQuery('#modulename').val() == '-' || jQuery('#currencyfield').val() == '-' || jQuery('#datefield').val() == '-' || jQuery('#status_values').val() == '') {
                app.helper.showErrorNotification({message: app.vtranslate('All fields are Mandatory')});
                event.preventDefault();
                return false;
            }

        });
    }, updateOldRecords: function () {
        jQuery('#updateLTV').on('click', function (e) {
            app.helper.showProgress();
            var dataUrl = "module=ParsVTExtras&action=UpdateLTV";
            AppConnector.request(dataUrl).then(function (data) {
                app.helper.hideProgress();
                if (data.success) {
                    if (data.result == 'ok') {
                        app.helper.showSuccessNotification({message: app.vtranslate('Records Successfuly Updated')});

                    } else {
                        app.helper.showErrorNotification({message: app.vtranslate('Error updating the records')});
                    }
                }
            }, function (error, err) {
                app.helper.showErrorNotification({message: app.vtranslate('Error updating the records')});
            });
        });
    }, registerEvents: function () {
        var instance = this;
        instance.setLVTValues();
        instance.SourceModuleUpdate();
        instance.SaveRecord();
        instance.updateOldRecords();

    }
});
jQuery(document).ready(function () {
    var ParsVTLTVCalculatorInstance = ParsVTLTVCalculator_Js.getInstance();
    ParsVTLTVCalculatorInstance.registerEvents();
    //Vtiger_Index_Js.getInstance().registerEvents();
});
