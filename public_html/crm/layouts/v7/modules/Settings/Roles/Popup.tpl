{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
{* modules/Settings/Roles/views/Popup.php *}

{* START YOUR IMPLEMENTATION FROM BELOW. Use {debug} for information *}
{strip}
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE={vtranslate('LBL_ASSIGN_ROLE',"Settings:Roles")}}
        <div class="modal-body">
            <div id="popupPageContainer" class="contentsDiv padding30px">
                <div class="clearfix treeView">
                    <ul>
                        <li data-role="{$ROOT_ROLE->getParentRoleString()}" data-roleid="{$ROOT_ROLE->getId()}">
                            <div class="toolbar-handle">
                                <a href="javascript:;" class="btn btn-primary">{**PVTPATCHER-83EF97A192A1980A7367DFFEED110FA1-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{vtranslate($ROOT_ROLE->getName())}
{** REPLACED-83EF97A192A1980A7367DFFEED110FA1// {$ROOT_ROLE->getName()}**}
{**PVTPATCHER-83EF97A192A1980A7367DFFEED110FA1-FINISH**}</a>
                            </div>
                            {assign var="ROLE" value=$ROOT_ROLE}
                            {include file=vtemplate_path("RoleTree.tpl", "Settings:Roles")}
                        </li>
                    </ul>
            </div>
            </div>
        </div>
    </div>
</div>    
{/strip}
