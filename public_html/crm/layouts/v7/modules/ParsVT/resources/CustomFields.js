/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
//On Page Load
jQuery(document).ready(function () {
    Vtiger_Index_Js.getInstance().registerEvents();
    if (jQuery('#gridColumnsUi').length > 0) {
        jQuery('#gridColumnsUi').select2('destroy');
        jQuery('#gridRowsUi').select2('destroy');
        var select2params = {tags: [], tokenSeparators: [","]};
        app.showSelect2ElementView($('#gridColumnsUi'), select2params);
        app.showSelect2ElementView($('#gridRowsUi'), select2params);
    }
    if (jQuery('.fieldTypesList').length > 0) {
        jQuery('.fieldTypesList').select2('destroy');
        jQuery('.fieldTypesList').select2();
    }
    $("body").delegate("#ListModules", "change", function () {
        app.helper.showProgress();
        window.location.href = 'index.php?parent=Settings&module=ParsVT&view=CustomFields&tabid=' + $('#ListModules').val();
    });
    $("body").delegate("#fieldcontents form.customfieldform #expressionValue, #fieldcontents form.customfieldform #suffixValue, #fieldcontents form.customfieldform #prefixValue", "focusout", function (e) {
        if ($("#fieldcontents form.customfieldform").length > 0) {
            var targetvalue = jQuery(e.currentTarget).val();
            if (targetvalue != '') {
                $.ajax({
                    url: "index.php?module=ParsVT&action=Fields&mode=checkExpression",
                    type: "POST",
                    data: {value: targetvalue}
                }).done(function (data) {
                    app.helper.hideProgress();
                    if (!data.success) {
                        app.helper.showErrorNotification({'message': data.error});
                        $("#fieldcontents form.customfieldform .saveButton").attr('disabled', 'disabled');
                    } else {
                        $("#fieldcontents form.customfieldform .saveButton").removeAttr('disabled');
                    }
                }).fail(function () {
                    app.helper.hideProgress();
                    $("#fieldcontents form.customfieldform .saveButton").removeAttr('disabled');
                });
            } else {
                $("#fieldcontents form.customfieldform .saveButton").removeAttr('disabled');
            }
        }
    });
    $(document).on('change', '#ListFields', function () {
        var fieldid = $(this).val();
        var tabid = $('#ListModules').val();
        var url = 'index.php';
        app.helper.showProgress();
        jQuery.ajax({
            url: url,
            data: {
                module: 'ParsVT',
                action: 'Fields',
                mode: 'getCustomField',
                tabid: tabid,
                fieldid: fieldid
            },
            async: false,
            success: function (response) {
                $("#fieldcontents").html(response);
                if (jQuery('#gridColumnsUi').length > 0) {
                    jQuery('#gridColumnsUi').select2('destroy');
                    jQuery('#gridRowsUi').select2('destroy');
                    var select2params = {tags: [], tokenSeparators: [","]};
                    app.showSelect2ElementView($('#gridColumnsUi'), select2params);
                    app.showSelect2ElementView($('#gridRowsUi'), select2params);
                }
                if (jQuery('.fieldTypesList').length > 0) {
                    jQuery('.fieldTypesList').select2('destroy');
                    jQuery('.fieldTypesList').select2();
                }
                setTimeout(function () {
                    app.helper.hideProgress();
                }, 500);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                app.helper.hideProgress();
            }
        });
    });
    var saveCustomField = function (e) {
        e.preventDefault();
        app.helper.showProgress();
        var theForm = $(this);
        var datastring = theForm.serialize();
        var url = 'index.php';
        jQuery.ajax({
            type: "POST",
            url: url,
            data: datastring,
        }).done(function (data) {
            app.helper.hideProgress();
            if (data == '' || data == 'undefined') {
                app.helper.showErrorNotification({'message': app.vtranslate('Failed to Save Settings')});
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
                return false;
            }
            app.helper.showSuccessNotification({'message': app.vtranslate('Settings Saved successfully!')});
            return false;
        }).fail(function () {
            app.helper.hideProgress();
            app.helper.showErrorNotification({'message': app.vtranslate('Failed to Save Settings')});
            e.preventDefault(); // avoid to execute the actual submit of the form.
            setTimeout(function () {
                window.location.reload();
            }, 1000);
            return false;
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
        return false;
    }

    $(document).on('submit', "#fieldcontents form.customfieldform", saveCustomField);

});

function updateMissingAutoNumberRecords(fieldid) {
    app.helper.showProgress();
    var objParams = {
        'module': 'ParsVT',
        'action': 'Fields',
        'mode': 'updateMissingAutoNumberRecords',
        'fieldid': fieldid,
    };
    app.request.post({data: objParams}).then(
        function (err, data) {
            app.helper.hideProgress();
            if (err == null && data) {
                app.helper.showSuccessNotification({'message': data});
            } else {
                app.helper.showSuccessNotification({'message': app.vtranslate('Unknown Error')});
                console.dir(err);
            }
        }
    );
}