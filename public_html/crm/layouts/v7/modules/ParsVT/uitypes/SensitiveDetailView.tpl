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
{if $RECORD}
    {assign var=RECORD_MODEL value=$RECORD}
{/if}
{if $RECORD_STRUCTURE_MODEL && $RECORD_STRUCTURE_MODEL->getRecord()}
    {assign var=RECORD_MODEL value=$RECORD_STRUCTURE_MODEL->getRecord()}
{/if}
{if $RECORD_MODEL}
    {assign var=RECORDID value=$RECORD_MODEL->getId()}
{/if}
{if (!$FIELD_NAME)}
    {assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
{/if}
{assign var="FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
<span class="ParsVTSensitiveField">
    {if !empty($FIELD_VALUE)}
		{$FIELD_MODEL->getDisplayValue($FIELD_VALUE)}
	{if $RECORDID}
		<br>
		<button onclick="javascript:ParsVTCustomFields_Js.viewSensitiveFieldValue('{$RECORDID}','{$MODULE}','{$FIELD_NAME}','{$FIELD_VALUE}');" type="button" class="btn btn-info" style="font-size: 11px"><i class="fa fa-eye"></i>&nbsp;{vtranslate("Show Information","ParsVT")}
	{/if}
  </button>
	{/if}
</span>
<script>
	$( document ).ready(function() {
		setTimeout(function () {
			var ParsVTSensitiveField = $('span.ParsVTSensitiveField').parent().parent();
			ParsVTSensitiveField.find('span.edit').remove();
			ParsVTSensitiveField.find('span.action').remove();

		},100);
	});
</script>