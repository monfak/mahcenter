{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}

{**PVTPATCHER-20F4C1EB16F4C925C005A0E7D57A505E-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
{if $CURRENT_USER_MODEL->get('language') eq 'fa_ir' or  $CURRENT_USER_MODEL->get('language') eq 'fa_af'}
<style>
#error * {
    direction:rtl;
    text-align: right;
    font-family:tahoma;
    font-size: 12px;
}
.small {
    text-align: left !important;
}
</style>
{/if}
{strip}
{** REPLACED-20F4C1EB16F4C925C005A0E7D57A505E// {strip}**}
{**PVTPATCHER-20F4C1EB16F4C925C005A0E7D57A505E-FINISH**}
	<div class="row" style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255);position: relative; z-index: 10000000; padding: 10px; width: 80%; margin: 0 auto; margin-top: 5%;">
		<div class ="col-lg-1 col-sm-2 col-md-1" style="float: left;"><img src="{vimage_path('denied.gif')}" ></div>
		<div class ="col-lg-11 col-sm-10 col-md-11" nowrap="nowrap">
			<span class="genHeaderSmall">
				{if $IS_DUPICATES_FAILURE}
					<span>{$EXCEPTION}</span>
				{else}
					{assign var=SINGLE_MODULE value="SINGLE_$MODULE"}
					<span class="genHeaderSmall">{vtranslate($SINGLE_MODULE, $MODULE)} {vtranslate('CANNOT_CONVERT', $MODULE)}
						<br>
						<ul> {vtranslate('LBL_FOLLOWING_ARE_POSSIBLE_REASONS', $MODULE)}:
							<li>{vtranslate('LBL_LEADS_FIELD_MAPPING_INCOMPLETE', $MODULE)}</li>
							<li>{vtranslate('LBL_MANDATORY_FIELDS_ARE_EMPTY', $MODULE)}</li>
							{if $EXCEPTION}
								<li>{$EXCEPTION}</li>
							{/if}
						</ul>
					</span>
				{/if}
			</span>
			<hr>
			<div class="small" align="right" nowrap="nowrap">
				{if !$IS_DUPICATES_FAILURE && $CURRENT_USER->isAdminUser()}
					<a href="index.php?parent=Settings&module=Leads&view=MappingDetail">{vtranslate('LBL_LEADS_FIELD_MAPPING', $MODULE)}</a><br>
				{/if}
				<a href="javascript:window.history.back();">{vtranslate('LBL_GO_BACK', $MODULE)}</a><br>
			</div>
		</div>
	</div>
{/strip}

