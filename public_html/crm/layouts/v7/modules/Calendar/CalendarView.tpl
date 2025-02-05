{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
{* modules/Calendar/views/Calendar.php *}
{strip}
<input type="hidden" id="currentView" value="{$smarty.request.view}" />
<input type="hidden" id="start_day" value="{$CURRENT_USER->get('dayoftheweek')}" />
<input type="hidden" id="activity_view" value="{$CURRENT_USER->get('activity_view')}" />
<input type="hidden" id="time_format" value="{$CURRENT_USER->get('hour_format')}" />
<input type="hidden" id="start_hour" value="{$CURRENT_USER->get('start_hour')}" />
<input type="hidden" id="date_format" value="{$CURRENT_USER->get('date_format')}" />
<input type="hidden" id="hideCompletedEventTodo" value="{$CURRENT_USER->get('hidecompletedevents')}">
<input type="hidden" id="show_allhours" value="{$CURRENT_USER->get('showallhours')}" />
<div id="mycalendar" class="calendarview col-lg-12">
	{**PVTPATCHER-2CB131912AA8F58A6FCD17AF9C4200D3-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
{assign var=LEFTPANELHIDE value=$CURRENT_USER_MODEL->get('leftpanelhide')}
{** REPLACED-2CB131912AA8F58A6FCD17AF9C4200D3// {assign var=LEFTPANELHIDE value=$CURRENT_USER_MODEL->get('leftpanelhide')}**}
{**PVTPATCHER-2CB131912AA8F58A6FCD17AF9C4200D3-FINISH**}
	<div class="essentials-toggle" title="{vtranslate('LBL_LEFT_PANEL_SHOW_HIDE', 'Vtiger')}">
		<span class="essentials-toggle-marker fa {if $LEFTPANELHIDE eq '1'}fa-chevron-right{else}fa-chevron-left{/if} cursorPointer"></span>
	</div>
</div>
{/strip}
