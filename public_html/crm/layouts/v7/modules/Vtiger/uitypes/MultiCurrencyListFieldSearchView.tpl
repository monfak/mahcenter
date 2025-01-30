{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}
    {assign var="FIELD_INFO" value=Zend_Json::encode($FIELD_MODEL->getFieldInfo())}
	{assign var="{$FIELD_MODEL->get('name')|strtoupper}_SEARCH_VALUE" value=""}
	{if $USER_MODEL->get('conv_rate') gte 0 && $SEARCH_INFO['searchValue'] && is_numeric($SEARCH_INFO['searchValue']) && $SEARCH_INFO['searchValue'] gt 0}
		{assign var="{$FIELD_MODEL->get('name')|strtoupper}_SEARCH_VALUE" value=$SEARCH_INFO['searchValue']/$USER_MODEL->get('conv_rate')}
	{/if}


	<div class="input-group input-group-sm">
		<span class="input-group-addon">{$USER_MODEL->get('currency_symbol')}</span>
		<input type="hidden" name="{$FIELD_MODEL->get('name')}" class="listSearchContributor inputElement" value="{$SEARCH_INFO['searchValue']}" data-field-type="{$FIELD_MODEL->getFieldDataType()}" data-fieldinfo="{$FIELD_INFO|escape}">
        <input type="text" id="{$FIELD_MODEL->get('name')}_search"  class="inputElement" value="{${$FIELD_MODEL->get('name')|strtoupper}_SEARCH_VALUE}" data-field-type="{$FIELD_MODEL->getFieldDataType()}" data-fieldinfo='{$FIELD_INFO|escape}'/>
    </div>
{/strip}
<script>
	jQuery('body').on('change input', '#{$FIELD_MODEL->get('name')}_search', function () {
		 jQuery('input[name="{$FIELD_MODEL->get('name')}"]').val(ParsVTCustomFields_Js.convertToDollar(jQuery('#{$FIELD_MODEL->get('name')}_search').val(), '{$USER_MODEL->get('conv_rate')}'))
	 });
</script>