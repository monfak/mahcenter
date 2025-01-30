{* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** *}
{strip}
    <script src="layouts/{vglobal('default_layout')}/modules/ParsVT/resources/masked-input/jquery.maskedinput.js"></script>
    <link type="text/css" rel="stylesheet" href="layouts/{vglobal('default_layout')}/modules/ParsVT/resources/Plaque/Plaque.css" media="all"/>
    {assign var="FIELD_INFO" value=$FIELD_MODEL->getFieldInfo()}
    {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
    {assign var="PLAQUE_VALUE" value=Vtiger_Mplaque_UIType::getPlaqueValue($FIELD_MODEL->get('fieldvalue'))}

    {if (!$FIELD_NAME)}
        {assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
    {/if}
    <input id="{$MODULE}_editView_fieldName_{$FIELD_NAME}" type="text" data-fieldname="{$FIELD_NAME}" style="width: 0 !important; height: 0 !important; opacity: 0 !important;"
           data-fieldtype="string" class="inputElement {if $FIELD_MODEL->isNameField()}nameField{/if}"
           name="{$FIELD_NAME}" value="{$FIELD_MODEL->get('fieldvalue')}"
           {if !empty($SPECIAL_VALIDATOR)}data-validator="{Zend_Json::encode($SPECIAL_VALIDATOR)}"{/if}
            {if $FIELD_INFO["mandatory"] eq true} data-rule-required="true" {/if}
            {if ParsVT_Module_Model::php7_count($FIELD_INFO['validator'])}
                data-specific-rules='{ZEND_JSON::encode($FIELD_INFO["validator"])}'
            {/if}
    />

    <div class="w-middle plaque-pay col-sm-4">
        <div class="form-group">
            <div class="text">
                <label>
                    {vtranslate('Plaque','ParsVT')}
                </label>
            </div>
            <div class="input">
                <div class="Plaque">
                    <div style="flex-grow: 1; padding: 0px 5px; border: 1px solid #c2c2c2" class="in plaque-ins col-xs-4">
                        <input type="text" style="border: 0" tabindex="1" class="form-control en" dir="ltr" placeholder="---" id="{$FIELD_NAME}_plaquePart1"  value="{if $PLAQUE_VALUE}{$PLAQUE_VALUE[0]}{/if}">
                        <input type="text" style="border: 0" tabindex="2" class="form-control en" dir="ltr"  placeholder="-----" id="{$FIELD_NAME}_plaquePart2" value="{if $PLAQUE_VALUE}{$PLAQUE_VALUE[1]}{/if}">
                        <div class="pic2">
                            <img src="layouts/{vglobal('default_layout')}/modules/ParsVT/resources/Plaque/pelak.png" alt="">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#{$FIELD_NAME}_plaquePart1').mask("999", { placeholder: "---" });
            $('#{$FIELD_NAME}_plaquePart2').mask("99999", { placeholder: "-----" });

            $("#{$FIELD_NAME}_plaquePart1").keyup(function () {
                var char = $(this).val();
                char = char.replace("-", "");
                if (char.length == 3) {
                    updateMPlaqueValue('{$FIELD_NAME}');
                    $(this).closest(".in").prev().find("select").focus();
                }
            });

            $("#{$FIELD_NAME}_plaquePart2").keyup(function () {
                var char = $(this).val();
                char = char.replace("-", "");
                if (char.length == 5) {
                    updateMPlaqueValue('{$FIELD_NAME}');
                }
            });

            function updateMPlaqueValue(target) {
                var _plaquePart1 = $("#"+target+"_plaquePart1").val();
                var _plaquePart2 = $("#"+target+"_plaquePart2").val();
                if (_plaquePart1.length == 3 && _plaquePart2.length == 5){
                    $('[name='+target+']').val(_plaquePart1+'-'+_plaquePart2);
                }
            }
        });
    </script>
{/strip}
