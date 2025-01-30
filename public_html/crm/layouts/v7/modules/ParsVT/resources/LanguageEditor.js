/*********************************************************************************
 * The content of this file is subject to the Language Editor 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

jQuery.Class('ParsVT_LanguageEditor_Js', {}, {
    registerPicklistModulesChangeEvent: function () {
        var thisElement = this;
        jQuery('#pickListModules').on('change', function () {
            var module = $(this).val();
            if (module.length <= 0) {
                Settings_Vtiger_Index_Js.showMessage({
                    'type': 'error',
                    'text': app.vtranslate('JS_PLEASE_SELECT_MODULE')
                });
                return;
            }
            var params = {
                module: app.getModuleName(),
                parent: app.getParentModuleName(),
                source_module: module,
                view: 'ListPicklistsAjax',
                mode: 'getPickListDetailsForModule'
            };
            var progressIndicatorElement = jQuery.progressIndicator({
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });
            AppConnector.request(params).then(function (data) {
                if (data.success) {
                    jQuery('#modulePickListContainer').html(data.result);
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    app.changeSelectElementView(jQuery('#modulePickListContainer'));
                    thisElement.registerModulePickListChangeEvent();
                    jQuery('#modulePickList').trigger('change');
                }
            });
        });
    },
    registerModulePickListChangeEvent: function () {
        var thisElement = this;
        jQuery('#modulePickList').on('change', function (e) {
            var params = {
                module: app.getModuleName(),
                parent: app.getParentModuleName(),
                source_module: jQuery('#pickListModules').val(),
                view: 'ListPicklistsAjax',
                mode: 'getPickListValueForField',
                pickListFieldId: jQuery(e.currentTarget).val()
            };
            var progressIndicatorElement = jQuery.progressIndicator({
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });
            AppConnector.request(params).then(function (data) {
                //if (data.success) {
                jQuery('#modulePickListValuesContainer').html(data.result);
                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                thisElement.registerSaveNewPicklistTranslationInputEvent();
                //}
            });
        });
    },
    registerSaveNewPicklistTranslationInputEvent: function () {
        var thisElement = this;
        var contents = jQuery('#modulePickListValuesContainer');
        contents.find('.pickListTranslation').each(function () {
            jQuery(this).on("blur", function () {
                var newValue = $(this).val();
                var langPrefix = $(this).closest('tr').data('lang');
                var key = $(this).closest('tr').data('key');
                var module = $('#pickListModules').val();
                var oldTranslate = $(this).closest('tr').data('langtranslate');
                var params = {
                    module: app.getModuleName(),
                    parent: app.getParentModuleName(),
                    source_module: jQuery('#pickListModules').val(),
                    action: 'SavePicklist',
                    forModule: module,
                    key: key,
                    transString: newValue,
                    langPrefix: langPrefix
                };

                if (oldTranslate !== newValue) {
                    AppConnector.request(params).then(
                        function (data) {
                            var params = {
                                text: data.result.message,
                                type: 'info'
                            };
                            app.helper.showSuccessNotification({'message': data.result.message});
                        }
                    );
                }
            });
        });
    },
    registerAddNewLanguageEvent: function () {
        $('#createLangButton').click(function (event) {
            var url = 'index.php?module=ParsVT&parent=Settings&view=createLanguageModalAjax';
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
    addNewLanguage: function (form) {
        var thisElement = this;

        var aDeferred = jQuery.Deferred();
        var formData = form.serializeFormData();

        var params = {
            "type": "POST",
            "module": app.getModuleName(),
            //"parent": "Settings",
            "action": "LanguageAjax",
            "formData": formData,
            "mode": "createNewLanguage",
            "dataType": 'json'
        };
        AppConnector.request(params).then(
            function (data) {
                //must check
                alert(JSON.stringify(data));
                alert(3);
                aDeferred.resolve(data);
            },
            function (error) {
                aDeferred.reject(error);
            }
        );
        return aDeferred.promise();
    },
    registerCopyLanguage: function () {
        var thisElement = this;
        var aDeferred = jQuery.Deferred();
        jQuery(document).on('click', '.modalSaveButton', function () {
            if (thisElement.validateCheckCode() == 'success') {
                var newLanguageVal = jQuery('#newLanguage');
                var langNameVal = jQuery('#langName');
                if (newLanguageVal.val().length == 0) {
                    if ($(".newLanguageVal")[0]) {
                        newLanguageVal.focus();
                    } else {
                        newLanguageVal.after('<span class="newLanguageVal text-danger">'+app.vtranslate('JS_PLEASE_ENTER_VALID_VALUE')+'</span>');
                        newLanguageVal.focus();
                    }
                } else {
                    $(".newLanguageVal").remove();

                    if (langNameVal.val().length == 0) {
                        if ($(".langNameVal")[0]) {
                            langNameVal.focus();
                        } else {
                            langNameVal.after('<span class="langNameVal text-danger">'+app.vtranslate('JS_PLEASE_ENTER_VALID_VALUE')+'</span>');
                            langNameVal.focus();
                        }
                    } else {
                        $(".langNameVal").remove();
                        var form = jQuery('#newLanguageForm');
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
                        params['action'] = 'LanguageAjax';
                        params['parent'] = 'Settings';
                        params['mode'] = 'createNewLanguage';
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
            }
        });
    },
    registerdeleteLanguage: function () {
        jQuery('.deleteLanguage').on('click', function (g) {
            var element = jQuery(g.currentTarget);
            var langprefix = element.data('langprefix');
            if (typeof langprefix == 'undefined') {
                return;
            }
            app.helper.showConfirmationBox({'message': ParsVTErrors.CONVERTDATACONFIRM}).then(
                function (e) {
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'message': '',
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        }
                    });
                    var params = {};
                    params['module'] = app.getModuleName();
                    params['action'] = 'DeleteTranslation';
                    params['parent'] = 'Settings';
                    params['langPrefix'] = langprefix;
                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            if (data.success) {
                                if (data.result.success == true) {
                                    app.helper.showSuccessNotification({'message': data.result.message});
                                } else if (data.result.error == true) {
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

                    setTimeout(function () {
                        window.location.reload(1);
                    }, 3000);


                },
                function (error, err) {
                    return false;
                });
        });
    },
    registerCopyLanguageEvent: function () {
        var thisElement = this;
        var contents = jQuery('#allLanguages');
        jQuery('.copyLanguage').each(function () {
            jQuery(this).click(function (e) {
                var lang_prefix = jQuery(this).closest('tr').data('prefix');
                var lang_label = jQuery(this).closest('tr').data('label');
                var url = 'index.php?module=ParsVT&parent=Settings&view=createLanguageModalAjax&language=' + lang_prefix + ',' + lang_label;
                app.request.get({'url': url}).then(
                    function (err, data) {
                        if (err === null) {
                            app.helper.showModal(data);
                        } else {
                            app.helper.showErrorNotification({'message': err.message});
                        }
                    }
                );
                e.stopPropagation();
            });
        });
    },
    aftervalidformaction: function (form) {
        var thisElement = this;
        var saveButton = form.find(':submit');
        saveButton.attr('disabled', 'disabled');
        thisElement.addNewLanguage(form).then(
            function (data) {
                var params = {
                    text: data.result.message
                };
                if (data.result.success === true) {
                    params['type'] = 'info';
                    app.hideModalWindow();
                }
                else if (data.result.success === false) {
                    params['type'] = 'error';
                    saveButton.attr('disabled', false);
                }

                Vtiger_Helper_Js.showMessage(params);
                window.location.reload();
            },
            function (error, err) {
            }
        );

    },
    registerLangButtonEvent: function () {
        $('.langButton').click(function (e) {
            var langPrefix = $(this).closest('tr').data('prefix');
            var langName = $(this).closest('tr').data('name');
            var langLabel = $(this).closest('tr').data('label');
            var params = {
                "type": "POST",
                "module": app.getModuleName(),
                "parent": "Settings",
                "action": "LanguageAjax",
                "name": langName,
                "label": langLabel,
                "prefix": langPrefix,
                "mode": "changeActiveStatusOfLanguage",
                "dataType": 'json'
            };
            AppConnector.request(params).then(
                function (data) {
                    if (data.success == true) {
                        app.helper.showSuccessNotification({'message': data.result.message});
                    } else if (data.error) {
                        app.helper.showErrorNotification({'message': data.error.code});
                    }
                },
                function (error) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    app.helper.showErrorNotification({'message': ParsVTErrors.OPFAILED});
                }
            );

            setTimeout(function () {
                window.location.reload(1);
            }, 3000);
        });
    },
    registerRowClickEvent: function () {
        jQuery('.listViewEntries').on('click', function (e) {
            var elem = jQuery(e.currentTarget);
            var recordUrl = elem.data('recordurl');
            if (typeof recordUrl == 'undefined') {
                return;
            }
            window.location.href = recordUrl;
        });
    },
    validateCheckCode: function () {
        var status = 'error';
        var langCodeVal = jQuery('#langCode');
        var characterReg = /^([a-z]{2}[_]{1}[a-zA-Z]{2})$/;
        if (!characterReg.test(langCodeVal.val()) || langCodeVal.val().length == 0) {
            if ($(".langCodeVal")[0]) {
                langCodeVal.focus();
            } else {
                langCodeVal.after('<span class="langCodeVal text-danger">'+app.vtranslate('JS_PLEASE_ENTER_VALID_VALUE')+'</span>');
                langCodeVal.focus();
                status = 'error';
            }
        } else {
            $(".langCodeVal").remove();
            status = 'success';
        }
        return status;
    },
    registerEvents: function () {
        this.registerPicklistModulesChangeEvent();
        this.registerModulePickListChangeEvent();
        this.registerSaveNewPicklistTranslationInputEvent();
        this.registerAddNewLanguageEvent();
        this.registerLangButtonEvent();
        this.registerCopyLanguage();
        this.registerCopyLanguageEvent();
        //this.registerRowClickEvent();
        this.registerdeleteLanguage();
    }
});

jQuery(document).ready(function () {
    var ParsVTLanguageEditorJsInstance = new ParsVT_LanguageEditor_Js();
    ParsVTLanguageEditorJsInstance.registerEvents();
})
