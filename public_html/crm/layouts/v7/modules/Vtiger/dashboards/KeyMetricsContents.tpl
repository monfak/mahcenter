{************************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************}
{strip}
<div>
	{foreach item=KEYMETRIC from=$KEYMETRICS}
	<div style="padding-bottom:6px;">
		<span class="pull-right">{$KEYMETRIC.count}</span>
		<a href="?module={$KEYMETRIC.module}&view=List&viewname={$KEYMETRIC.id}">{**PVTPATCHER-52454138D27EDAC4E728E8C96D21D39E-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{vtranslate($KEYMETRIC.name)}
{** REPLACED-52454138D27EDAC4E728E8C96D21D39E// {$KEYMETRIC.name}**}
{**PVTPATCHER-52454138D27EDAC4E728E8C96D21D39E-FINISH**}</a>
	</div>	
	{/foreach}
</div>
{/strip}
