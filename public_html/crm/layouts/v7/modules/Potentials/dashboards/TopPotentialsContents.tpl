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
<div style='padding:5px'>
{if count($MODELS) > 0}
	<div>
        <div class='row'>
            <div class='col-lg-4'>
                <b>{vtranslate('Potential Name', $MODULE_NAME)}</b>
            </div>
            <div class='col-lg-4'>
                <b>{vtranslate('Amount', $MODULE_NAME)}</b>
            </div>
            <div class='col-lg-4'>
                <b>{vtranslate('Related To', $MODULE_NAME)}</b>
            </div>
        </div>
		<hr>
		{foreach item=MODEL from=$MODELS}
		<div class='row'>
			<div class='col-lg-4'>
				<a href="{$MODEL->getDetailViewUrl()}">{$MODEL->getName()}</a>
			</div>
			<div class='col-lg-4'>
				{CurrencyField::appendCurrencySymbol($MODEL->getDisplayValue('amount'), $USER_CURRENCY_SYMBOL)}
			</div>
			<div class='col-lg-4'>
				{$MODEL->getDisplayValue('related_to')}
			</div>
		</div>
		{/foreach}
	</div>
{else}
	<span class="noDataMsg">
		{**PVTPATCHER-838040990E1780E4F3CDBB5235D80251-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
		{if $CURRENT_USER_MODEL->get('language') eq 'fa_ir' or  $CURRENT_USER_MODEL->get('language') eq 'fa_af'}
		      {vtranslate('No %s records matched this criteria to view', 'ParsVT',vtranslate($MODULE_NAME, $MODULE_NAME))}
		{else}
		      {vtranslate('LBL_NO')} {vtranslate($MODULE_NAME, $MODULE_NAME)} {vtranslate('LBL_MATCHED_THIS_CRITERIA')}
		{/if}
{** REPLACED-838040990E1780E4F3CDBB5235D80251// {vtranslate('LBL_NO')} {vtranslate($MODULE_NAME, $MODULE_NAME)} {vtranslate('LBL_MATCHED_THIS_CRITERIA')}**}
{**PVTPATCHER-838040990E1780E4F3CDBB5235D80251-FINISH**}
	</span>
{/if}
</div>