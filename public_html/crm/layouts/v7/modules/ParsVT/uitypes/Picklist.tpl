{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}

{strip}
{assign var="FIELD_INFO" value=$FIELD_MODEL->getFieldInfo()}
{assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
{if isset($FIELD_INFO['editablepicklistvalues']) && !empty($FIELD_INFO['editablepicklistvalues'])}
	{assign var=PICKLIST_VALUES value=$FIELD_INFO['editablepicklistvalues']}
{else}
	{assign var=PICKLIST_VALUES value=$FIELD_INFO['picklistvalues']}
{/if}
{assign var=PICKLIST_COLORS value=$FIELD_INFO['picklistColors']}
{assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
{if $FIELD_NAME|strstr:'cf_pcf_rbf' && $FIELD_NAME|strpos:'cf_pcf_rbf' == '0'}
	{assign var=counter value=1}
	{if $FIELD_MODEL->isEmptyPicklistOptionAllowed()}
		<input data-fieldname="{$FIELD_MODEL->getFieldName()}" data-fieldtype="radio" class="inputElement select2 {if $OCCUPY_COMPLETE_WIDTH} row {/if}" type="radio" name="{$FIELD_MODEL->getFieldName()}" {if !empty($SPECIAL_VALIDATOR)}data-validator="{Zend_Json::encode($SPECIAL_VALIDATOR)}"{/if} data-selected-value="{$FIELD_MODEL->get('fieldvalue')}" {if $FIELD_INFO["mandatory"] eq true} data-rule-required="true"{/if} {if count($FIELD_INFO["validator"])} data-specific-rules="{ZEND_JSON::encode($FIELD_INFO['validator'])}"{/if} id="{$FIELD_MODEL->getFieldName()}{$counter}" value="" />
		<label for="{$FIELD_MODEL->getFieldName()}{$counter}">&nbsp;{vtranslate('LBL_BLANK', $MODULE)}</label><br>
	{/if}
	{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
		{assign var=counter value=$counter+1}
		{assign var=CLASS_NAME value="picklistColor_{$FIELD_MODEL->getFieldName()}_{$PICKLIST_NAME|replace:' ':'_'}"}
		<input data-fieldname="{$FIELD_MODEL->getFieldName()}" data-fieldtype="radio" class="inputElement select2 {if $OCCUPY_COMPLETE_WIDTH} row {/if}" type="radio" name="{$FIELD_MODEL->getFieldName()}" {if !empty($SPECIAL_VALIDATOR)}data-validator="{Zend_Json::encode($SPECIAL_VALIDATOR)}"{/if} data-selected-value="{$FIELD_MODEL->get('fieldvalue')}" {if $FIELD_INFO["mandatory"] eq true} data-rule-required="true"{/if} {if count($FIELD_INFO["validator"])} data-specific-rules="{ZEND_JSON::encode($FIELD_INFO['validator'])}"{/if} id="{$FIELD_MODEL->getFieldName()}{$counter}" value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" {if trim(decode_html($FIELD_MODEL->get('fieldvalue'))) eq trim($PICKLIST_NAME)} checked="checked" {/if}>
		<label for="{$FIELD_MODEL->getFieldName()}{$counter}" {if $PICKLIST_COLORS[$PICKLIST_NAME]}class="{$CLASS_NAME}"{/if}>&nbsp;{$PICKLIST_VALUE}</label><br>
	{/foreach}
	<style>
		input[type=radio] {
			border: 1px solid #b9b9b9 !important;
		}
	</style>
{else}
	<select data-fieldname="{$FIELD_MODEL->getFieldName()}" data-fieldtype="picklist" class="inputElement select2 {if $OCCUPY_COMPLETE_WIDTH} row {/if}" type="picklist" name="{$FIELD_MODEL->getFieldName()}" {if !empty($SPECIAL_VALIDATOR)}data-validator='{Zend_Json::encode($SPECIAL_VALIDATOR)}'{/if} data-selected-value='{$FIELD_MODEL->get('fieldvalue')}'
		{if $FIELD_INFO["mandatory"] eq true} data-rule-required="true" {/if}
		{if !empty($FIELD_INFO['validator']) && is_array(empty($FIELD_INFO['validator']))}
			data-specific-rules='{ZEND_JSON::encode($FIELD_INFO["validator"])}'
		{/if}
		>
		{if $FIELD_MODEL->isEmptyPicklistOptionAllowed()}<option value="">{vtranslate('LBL_SELECT_OPTION','Vtiger')}</option>{/if}
		{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
			{assign var=CLASS_NAME value="picklistColor_{$FIELD_MODEL->getFieldName()}_{$PICKLIST_NAME|replace:' ':'_'}"}
			<option value="{Vtiger_Util_Helper::toSafeHTML($PICKLIST_NAME)}" {if isset($PICKLIST_COLORS[$PICKLIST_NAME]) && $PICKLIST_COLORS[$PICKLIST_NAME]}class="{$CLASS_NAME}"{/if} {if trim(decode_html($FIELD_MODEL->get('fieldvalue'))) eq trim($PICKLIST_NAME)} selected {/if}>{$PICKLIST_VALUE}</option>
		{/foreach}
	</select>
{/if}
{if $PICKLIST_COLORS}
	<style type="text/css">
		{foreach item=PICKLIST_VALUE key=PICKLIST_NAME from=$PICKLIST_VALUES}
		{assign var=CLASS_NAME value="{$FIELD_MODEL->getFieldName()}_{$PICKLIST_NAME|replace:' ':'_'}"}
		.picklistColor_{$CLASS_NAME} {
			{if isset($PICKLIST_COLORS[$PICKLIST_NAME])}
				background-color: {$PICKLIST_COLORS[$PICKLIST_NAME]} !important;
				{if $PICKLIST_COLORS[$PICKLIST_NAME] eq '#ffffff'}
				color: #000000 !important;
				{/if}
			{/if}
		}
		.picklistColor_{$CLASS_NAME}.select2-highlighted {
			white: #ffffff !important;
			background-color: #337ab7 !important;
		}
		{/foreach}
	</style>
{/if}
{/strip}
