{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{* modules/Settings/Groups/views/DeleteAjax.php *}

{strip}
    <div class="modal-dialog modelContainer">
        {**PVTPATCHER-D74DD80217244A53F884787C57CF9D10-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{assign var=HEADER_TITLE value={vtranslate('LBL_DELETE_RECORD', $QUALIFIED_MODULE)}|cat:" "|cat:{vtranslate('SINGLE_'|cat:$MODULE, $QUALIFIED_MODULE)}|cat:" - "|cat:{vtranslate($RECORD_MODEL->getName())}}
{** REPLACED-D74DD80217244A53F884787C57CF9D10// {assign var=HEADER_TITLE value={vtranslate('LBL_DELETE_RECORD', $QUALIFIED_MODULE)}|cat:" "|cat:{vtranslate('SINGLE_'|cat:$MODULE, $QUALIFIED_MODULE)}|cat:" - "|cat:{$RECORD_MODEL->getName()}}**}
{**PVTPATCHER-D74DD80217244A53F884787C57CF9D10-FINISH**}
        {include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
        <div class="modal-content">
            <form class="form-horizontal" id="DeleteModal" name="AddComment" method="post" action="index.php">
                <input type="hidden" name="module" value="{$MODULE}" />
                <input type="hidden" name="parent" value="Settings" />
                <input type="hidden" name="action" value="DeleteAjax" />
                <input type="hidden" name="record" id="record" value="{$RECORD_MODEL->getId()}" />
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="form-group">
                            <span class="control-label fieldLabel col-sm-5">
                                <strong>
                                    {vtranslate('LBL_TRANSFORM_OWNERSHIP', $QUALIFIED_MODULE)} {vtranslate('LBL_TO', $QUALIFIED_MODULE)}&nbsp;<span class="redColor">*</span>
                                </strong>
                            </span>
                            <div class="controls fieldValue col-xs-6">
                                <select id="transfer_record" name="transfer_record" class="select2">
                                    <optgroup label="{vtranslate('LBL_USERS', $QUALIFIED_MODULE)}">
                                        {foreach from=$ALL_USERS key=USER_ID item=USER_MODEL}
                                            <option value="{$USER_ID}">{$USER_MODEL->getName()}</option>
                                        {/foreach}
                                    </optgroup>
                                    <optgroup label="{vtranslate('LBL_GROUPS', $QUALIFIED_MODULE)}">
                                        {foreach from=$ALL_GROUPS key=GROUP_ID item=GROUP_MODEL}
                                            {if $RECORD_MODEL->getId() != $GROUP_ID }
                                                <option value="{$GROUP_ID}">{**PVTPATCHER-1F3B6BA9A2C0D29ACC60941387C28813-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{vtranslate($GROUP_MODEL->getName())}
{** REPLACED-1F3B6BA9A2C0D29ACC60941387C28813// {$GROUP_MODEL->getName()}**}
{**PVTPATCHER-1F3B6BA9A2C0D29ACC60941387C28813-FINISH**}</option>
                                            {/if}
                                        {/foreach}
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {include file='ModalFooter.tpl'|@vtemplate_path:'Vtiger'}
            </form>
        </div>
    </div>
{/strip}
