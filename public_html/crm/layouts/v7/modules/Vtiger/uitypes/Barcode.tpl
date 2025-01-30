{*<!--
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}

{strip}
	<script src="layouts/{vglobal('default_layout')}/modules/ParsVT/resources/Barcode/JsBarcode.all.min.js"></script>
    {*https://github.com/lindell/JsBarcode/wiki/Options*}
	{assign var="FIELD_INFO" value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_MODEL->getFieldInfo()))}
	{assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
	{assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
	{assign var="FIELD_NAME" value=$FIELD_MODEL->get('name')}
	{assign var="RANDNAME" value={$FIELD_NAME|md5|mb_substr:0:3}}
	<script>
		$("#{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}").focus(function(){
			jQuery("#{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}").addClass("inputElement");
		});
        var barcodeparams{$RANDNAME} = {
            format: "{if !empty($FIELD_MODEL->get('helpinfo'))}{$FIELD_MODEL->get('helpinfo')}{else}CODE39{/if}",
            lineColor: "#2D2D2D",
            width: 1,
            height: 40,
            displayValue: true
        };

		function displayBarCode{$RANDNAME}(obj){
			JsBarcode("#"+obj.name+"_display", obj.value, barcodeparams{$RANDNAME});
			jQuery("#{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}").addClass("inputElement");
		}


	</script>

	<input type="text" class="inputElement "  name="{$FIELD_NAME}" tabindex="{$vt_tab}" id="{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}" value="{$FIELD_MODEL->get('fieldvalue')}" class="detailedViewTextBox" onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox';displayBarCode{$RANDNAME}(this);" onChange="displayBarCode{$RANDNAME}(this);" onKeyup="displayBarCode{$RANDNAME}(this);"/>
	<br/>

	<img id="{$FIELD_NAME}_display"/>
	{if $FIELD_MODEL->get('fieldvalue') != ''}
        <script>
            JsBarcode("#{$FIELD_MODEL->get('name')}"+"_display", "{$FIELD_MODEL->get('fieldvalue')}", barcodeparams{$RANDNAME});
			jQuery("#{$MODULE}_editView_fieldName_{$FIELD_MODEL->get('name')}").addClass("inputElement");
        </script>
	{/if}
{/strip}