/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

jQuery.Class('ParsVT_EditLanguage_Js', {}, {
    registeronSelectChangeEvent: function () {
        var thisElement = this;
        jQuery('#listViewContents').empty();
        this.ajaxSelectChangeFunction();
        jQuery('#SelectLanguage').change(function () {
            jQuery('#listViewContents').empty();
            thisElement.ajaxSelectChangeFunction();
        });
        jQuery('#SelectModule').change(function () {
            jQuery('#listViewContents').empty();
            thisElement.ajaxSelectChangeFunction();
        });
    },
    ajaxSelectChangeFunction: function () {
        var progressIndicatorElement = jQuery.progressIndicator({
            'position': 'html',
            'blockInfo': {
                'enabled': true
            }
        });
        var thisElement = this;
        var preview_lang = jQuery('#SelectLanguage').val();
        var php_module = jQuery('#SelectModule').val();
        var langPrefix = jQuery('#langPrefix').val();
        var searchValue = jQuery('#trans_search').val();
        var params = {
            "type": "POST",
            "module": app.getModuleName(),
            "parent": "Settings",
            "view": "EditLanguage",
            "previewLang": preview_lang,
            "phpModule": php_module,
            "langPrefix": langPrefix,
            "searchvalue": searchValue,
            "dataType": 'json'
        };
        if ($('#missingTrans').is(':checked')) {
            params["mode"] = "missingTranslation";
        }
        else if (!$('#missingTrans').is(':checked')) {
            params["mode"] = "Edit";
        }
        ;

        AppConnector.request(params).then(
            function (data) {
                //alert(JSON.stringify(data));
                if (data.success) {
                    jQuery('#listViewContents').html(data.result);
                    app.changeSelectElementView(jQuery('#langForCreateFile'));
                    thisElement.updateLangTranslation();
                    thisElement.updateJsLangTranslation();
                    thisElement.addNewTranslationEvent();
                    thisElement.createLangFile();
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                }
            },
            function (error, err) {

            }
        );
    },
    updateLangTranslation: function () {
        var thisElement = this;
        jQuery("input[name^='lang_']").each(function () {
            $(this).on("blur", function () {
                var value = $(this).val();
                var langkey = $(this).closest('tr').data('langkey');
                var forModuleName = $('#for_module_name').val();
                var finallyPrefix = $('#finally_prefix').val();
                var variableType = "PHP";
                var oldTranslate = $(this).closest('tr').data('langtransl');
                thisElement.saveTranslation(value, finallyPrefix, langkey, forModuleName, variableType, oldTranslate);
            });
        });
    },
    updateJsLangTranslation: function () {
        var thisElement = this;
        jQuery("input[name^='jslang_']").each(function () {
            $(this).on("blur", function () {
                var value = $(this).val();
                var langkey = $(this).closest('tr').data('jslangkey');
                var forModuleName = $('#for_module_name').val();
                var finallyPrefix = $('#finally_prefix').val();
                var variableType = "JS";
                var oldTranslate = $(this).closest('tr').data('langtransl');
                thisElement.saveTranslation(value, finallyPrefix, langkey, forModuleName, variableType, oldTranslate);
            });
        });
    },
    saveTranslation: function (value, finallyPrefix, langkey, forModuleName, variableType, oldTranslate) {
        var thisElement = this;
        var params = {
            "type": "POST",
            "module": app.getModuleName(),
            //"parent": "Settings",
            "action": "SaveLanguage",
            "newString": value,
            "langPrefix": finallyPrefix,
            "langkey": langkey,
            "forModuleName": forModuleName,
            "variableType": variableType,
            "dataType": 'json'
        };
        if (oldTranslate !== value) {
            AppConnector.request(params).then(
                function (data) {
                    var params = {
                        'message': data.result.message,
                        //type: 'info'
                    };
                    if (data.result.success)
                        app.helper.showSuccessNotification(params)
                    else
                        app.helper.showErrorNotification(params)
                },
                function (error, err) {

                });
        }
    },
    addNewTranslationEvent: function () {
        var thisElement = this;
        var contents = jQuery('#listViewContents');
        var Module = $('#SelectModule').val();
        var langPrefix = $('#langPrefix').val();
        Module = Module.replace('m_', "");
        $('.addNewTranslation').click(function (event) {
            //alert(Module);
            var url = 'index.php?module=ParsVT&parent=Settings&view=createTransModalAjax&Module=' + Module + '&langPrefix=' + langPrefix;
            app.request.get({'url': url}).then(
                function (err, data) {
                    if (err === null) {
                        app.helper.showModal(data);
                    } else {
                        app.helper.showErrorNotification({'message': err.message});
                    }
                }
            );
        });
    },
    addNewTranslation: function (form) {
        var thisInstance = this;
        var aDeferred = jQuery.Deferred();
        var formData = form.serializeFormData();
        var langPrefix = $('#finally_prefix').val();
        var forModuleName = $('#for_module_name').val();
        var params = {
            "type": "POST",
            "module": app.getModuleName(),
            //"parent": "Settings",
            "action": "AddTranslation",
            "formData": formData,
            "langPrefix": langPrefix,
            "forModuleName": forModuleName,
            "dataType": 'json'
        };
        AppConnector.request(params).then(
            function (data) {
                aDeferred.resolve(data);
            },
            function (error) {
                aDeferred.reject(error);
            }
        );
        return aDeferred.promise();
    },
    registerDeleteLanguageVariable: function () {
        var thisElement = this;
        var listViewContentDiv = jQuery('.listViewContentDiv');
        jQuery(listViewContentDiv).on('click', '.deleteRecordButton', function (e) {

            var forModuleName = $('#for_module_name').val();
            var langPrefix = $('#finally_prefix').val();
            var langkey = $(this).closest('tr').data('langkey');
            if (typeof langkey === 'undefined') {
                var langkey = $(this).closest('tr').data('jslangkey');
            }

            var params = {
                "type": "POST",
                "module": app.getModuleName(),
                "action": "DeleteTranslation",
                "langkey": langkey,
                "langPrefix": langPrefix,
                "forModuleName": forModuleName,
                "dataType": 'json'
            };
            AppConnector.request(params).then(
                function (data) {
                    var params = {
                        text: data.result.message,
                        type: 'info'
                    };
                    Vtiger_Helper_Js.showMessage(params);
                    jQuery('#listViewContents').empty();
                    thisElement.ajaxSelectChangeFunction();
                },
                function (error, err) {

                }
            );
            e.stopPropagation();
        });
    },
    registerShowMissingTranslationButtonEvent: function () {
        var thisElement = this;
        $('#missingTrans').on('click', function () {
            var progressIndicatorElement = jQuery.progressIndicator({
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });
            var preview_lang = jQuery('#SelectLanguage').val();
            var php_module = jQuery('#SelectModule').val();
            var langPrefix = jQuery('#langPrefix').val();
            var searchValue = jQuery('#trans_search').val();
            var params = {
                "type": "POST",
                "module": app.getModuleName(),
                "parent": "Settings",
                "view": "EditLanguage",
                "previewLang": preview_lang,
                "phpModule": php_module,
                "langPrefix": langPrefix,
                "searchvalue": searchValue,
                "dataType": 'json'
            };
            if ($(this).is(':checked')) {
                params["mode"] = "missingTranslation";
            }
            else if (!$(this).is(':checked')) {
                params["mode"] = "Edit";
            }
            AppConnector.request(params).then(
                function (data) {
                    if (data.success) {
                        jQuery('#listViewContents').html(data.result);
                        thisElement.updateLangTranslation();
                        thisElement.updateJsLangTranslation();
                        thisElement.addNewTranslationEvent();
                        thisElement.createLangFile();
                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    }
                },
                function (error, err) {
                }
            );
        });
    },
    registerSearchTranslationEvent: function () {
        var thisElement = this;
        $('#trans_search').keyup(function () {
            var value = $(this).val();
            var preview_lang = jQuery('#SelectLanguage').val();
            var php_module = jQuery('#SelectModule').val();
            var langPrefix = jQuery('#langPrefix').val();
            var params = {
                "type": "POST",
                "module": app.getModuleName(),
                "parent": "Settings",
                "view": "EditLanguage",
                "previewLang": preview_lang,
                "phpModule": php_module,
                "langPrefix": langPrefix,
                "searchvalue": value,
                "dataType": 'json'
            };
            if ($('#missingTrans').is(':checked')) {
                params["mode"] = "missingTranslation";
            }
            else if (!$('#missingTrans').is(':checked')) {
                params["mode"] = "Edit";
            }
            var progressIndicatorElement = jQuery.progressIndicator({
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });

            delay(function () {
                AppConnector.request(params).then(
                    function (data) {
                        if (data.success) {
                            jQuery('#listViewContents').html(data.result);
                            thisElement.updateLangTranslation();
                            thisElement.updateJsLangTranslation();
                            thisElement.addNewTranslationEvent();
                            //thisElement.createLangFile();
                        }
                    },
                    function (error, err) {
                    }
                );
            }, 400);
            progressIndicatorElement.progressIndicator({'mode': 'hide'});

        });
    },
    registerClearSearchTransButtonEvent: function () {
        var thisElement = this;
        $('#clear_trans_search').click(function () {
            $('#trans_search').val("");
            jQuery('#listViewContents').empty();
            thisElement.ajaxSelectChangeFunction();
        });
    },
    createLangFile: function () {
        var progressIndicatorElement = jQuery.progressIndicator({
            'position': 'html',
            'blockInfo': {
                'enabled': true
            }
        });
        $('#createLangFile').on('click', function () {
            var createLangPrefix = $('#langForCreateFile').val();
            var forModuleName = $('#for_module_name').val();
            var finallyPrefix = $('#finally_prefix').val();
            var params = {
                "type": "POST",
                "module": app.getModuleName(),
                "action": "LanguageAjax",
                "finallyPrefix": finallyPrefix,
                "forModule": forModuleName,
                "createLangPrefix": createLangPrefix,
                "mode": "createNewLangFile",
                "dataType": 'json'
            };
            AppConnector.request(params).then(
                function (data) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    if (data.success) {
                        if (data.result.success == true) {
                            app.helper.showSuccessNotification({'message': data.result.message});
                        } else {
                            app.helper.showErrorNotification({'message': data.result.message});
                        }
                    } else {
                        app.helper.showErrorNotification({'message': ParsVTErrors.OPFAILED});
                    }
                },
                function (error) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    app.helper.showErrorNotification({'message': ParsVTErrors.OPFAILED});
                }
            );
            progressIndicatorElement.progressIndicator({'mode': 'hide'});

            setTimeout(function () {
                window.location.reload(1);
            }, 3000);
        });
    },
    registerCopyAndSaveTranslationIconEvent: function () {
        var thisElement = this;
        var listViewContentDiv = jQuery('.listViewContentDiv');
        jQuery(listViewContentDiv).on('click', '.copyToTranslationInputAndSave', function (e) {
            var current = e.currentTarget;
            var parent = jQuery(current).closest('td');
            var inputTdParent = jQuery(parent).siblings('.closestTdWithInput').find('input');
            if (jQuery(current).hasClass('jsLang')) {
                jQuery(inputTdParent).val(parent.data('jslangtranslate'));
            } else {
                jQuery(inputTdParent).val(parent.data('langtranslate'));
            }
            jQuery(inputTdParent).trigger('blur');
        });
    },

    registerTranslate: function () {
        var thisElement = this;
        var aDeferred = jQuery.Deferred();
        jQuery(document).on('click', '.modalTranslateSaveButton', function () {
            var langVariableVal = jQuery('#langVariable');
            var langTranslationVal = jQuery('#langTranslation');
            if (langVariableVal.val().length == 0) {
                if ($(".langVariableVal")[0]) {
                    langVariableVal.focus();
                } else {
                    langVariableVal.after('<span class="langVariableVal text-danger">'+app.vtranslate('JS_PLEASE_ENTER_VALID_VALUE')+'</span>');
                    langVariableVal.focus();
                }
            } else {
                var illegalChars= /[\<\>\,\;\:\\\\"\[\]\'\/\`\&]/;
                 if(langVariableVal.val().match(illegalChars)){
                     langVariableVal.after('<span class="langVariableVal text-danger">'+app.vtranslate('JS_CONTAINS_ILLEGAL_CHARACTERS')+'</span>');
                     langVariableVal.focus();
                     return false;
                 }

                var legalChars= /^([A-Za-z0-9\-\_\.\ ]*)?$/g;
                 if(!legalChars.test(langVariableVal.val())){
                     langVariableVal.after('<span class="langVariableVal text-danger">'+app.vtranslate('JS_CONTAINS_ILLEGAL_CHARACTERS')+'</span>');
                     langVariableVal.focus();
                     return false;
                 }


                $(".langVariableVal").remove();

                if (langTranslationVal.val().length == 0) {
                    if ($(".langTranslationVal")[0]) {
                        langTranslationVal.focus();
                    } else {
                        langTranslationVal.after('<span class="langTranslationVal text-danger">'+app.vtranslate('JS_PLEASE_ENTER_VALID_VALUE')+'</span>');
                        langTranslationVal.focus();
                    }
                } else {
                    $(".langTranslationVal").remove();
                    var form = jQuery('#newTranslateForm');
                    var formData = form.serializeFormData();
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'message': '',
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        }
                    });

                    var params = {};
                    params['module'] = app.getModuleName();
                    params['action'] = 'AddTranslation';
                    params['parent'] = 'Settings';
                    params['data'] = formData;
                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            if (data.success) {
                                if (data.result.success == true) {
                                    app.helper.showSuccessNotification({'message': data.result.message});
                                } else {
                                    app.helper.showErrorNotification({'message': data.result.message});
                                }
                            } else {
                                app.helper.showErrorNotification({'message': ParsVTErrors.OPFAILED});
                            }
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            app.helper.showErrorNotification({'message': ParsVTErrors.OPFAILED});
                        }
                    );
                    jQuery('.myModal').hide();

                    setTimeout(function () {
                        window.location.reload(1);
                    }, 3000);
                }
            }
        });
    },
    registerEvents: function () {
        this.registerShowMissingTranslationButtonEvent();
        this.registeronSelectChangeEvent();
        this.registerDeleteLanguageVariable();
        this.registerSearchTranslationEvent();
        this.registerClearSearchTransButtonEvent();
        this.registerCopyAndSaveTranslationIconEvent();
        this.registerTranslate();
        this.createLangFile();
    }
});

jQuery(document).ready(function () {
    var ParsVTEditLanguageJsInstance = new ParsVT_EditLanguage_Js();
    ParsVTEditLanguageJsInstance.registerEvents();
    vtUtils.enableTooltips();
})