{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
	{assign var="FIELD_INFO" value=$FIELD_MODEL->getFieldInfo()}
	{assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}

	{if (!$FIELD_NAME)}
		{assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
	{/if}
	{assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
	<textarea name="{$FIELD_NAME}" class="hide">{$FIELD_VALUE}</textarea>
	<input id="{$MODULE}_editView_fieldName_{$FIELD_NAME}" type="text" data-fieldname="{$FIELD_NAME}_VALUE" data-fieldtype="string" class="inputElement {if $FIELD_MODEL->isNameField()}nameField{/if}" name="{$FIELD_NAME}_value" value="{$FIELD_MODEL->getDisplayValue($FIELD_VALUE)}"
		{if !empty($SPECIAL_VALIDATOR)}data-validator="{Zend_Json::encode($SPECIAL_VALIDATOR)}"{/if}
		{if $FIELD_INFO["mandatory"] eq true} data-rule-required="true" {/if}
		{if count($FIELD_INFO['validator'])}
			data-specific-rules='{ZEND_JSON::encode($FIELD_INFO["validator"])}'
		{/if} />
{/strip}
