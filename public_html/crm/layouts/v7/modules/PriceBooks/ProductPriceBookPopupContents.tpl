{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
{* modules/PriceBooks/views/ProductPriceBookPopupAjax.php *}

{* START YOUR IMPLEMENTATION FROM BELOW. Use {debug} for information *}
{strip}
    {include file="PicklistColorMap.tpl"|vtemplate_path:$MODULE}
    <div class="row">
        <div class="col-md-2">
            {if !empty($LISTVIEW_ENTRIES)}<button class="select btn btn-default"><strong>{vtranslate('LBL_SELECT', $MODULE)}</strong></button>{/if}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type='hidden' id='pageNumber' value="{$PAGE_NUMBER}">
            <input type='hidden' id='pageLimit' value="{$PAGING_MODEL->getPageLimit()}">
            <input type="hidden" id="noOfEntries" value="{$LISTVIEW_ENTRIES_COUNT}">
            <input type="hidden" id="pageStartRange" value="{$PAGING_MODEL->getRecordStartRange()}" />
            <input type="hidden" id="pageEndRange" value="{$PAGING_MODEL->getRecordEndRange()}" />
            <input type="hidden" id="previousPageExist" value="{$PAGING_MODEL->isPrevPageExists()}" />
            <input type="hidden" id="nextPageExist" value="{$PAGING_MODEL->isNextPageExists()}" />
            <input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
            <div class="contents-topscroll">
                <div class="topscroll-div">
                    &nbsp;
                </div>
            </div>
            <div class="popupEntriesDiv relatedContents">
                <input type="hidden" value="{$ORDER_BY}" id="orderBy">
                <input type="hidden" value="{$SORT_ORDER}" id="sortOrder">
                <input type="hidden" value="{$SOURCE_FIELD}" id="sourceField">
                <input type="hidden" value="{$SOURCE_RECORD}" id="sourceRecord">
                <input type="hidden" value="{$SOURCE_MODULE}" id="parentModule">
                <input type="hidden" value="Product_PriceBooks_Popup_Js" id="popUpClassName"/>
                <input type="hidden" value="{Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($SEARCH_DETAILS))}" id="currentSearchParams" />
                {assign var=WIDTHTYPE value=$USER_MODEL->get('rowheight')}
                <div class="popupEntriesTableContainer">
                    <table class="listview-table table-bordered listViewEntriesTable">
                        <thead>
                            <tr class="listViewHeaders">
                                <th class="{$WIDTHTYPE}">
                                    <input type="checkbox"  class="selectAllInCurrentPage" />
                                </th>
                                {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                    <th class="{$WIDTHTYPE}">
                                        <a href="javascript:void(0);" class="listViewContentHeaderValues listViewHeaderValues" data-nextsortorderval="{if $ORDER_BY eq $LISTVIEW_HEADER->get('column')}{$NEXT_SORT_ORDER}{else}ASC{/if}" data-columnname="{$LISTVIEW_HEADER->get('column')}">
                                            {if $ORDER_BY eq $LISTVIEW_HEADER->get('column')}
                                                <i class="fa fa-sort {$FASORT_IMAGE}"></i>
                                            {else}
                                                <i class="fa fa-sort customsort"></i>
                                            {/if}
                                            &nbsp;{vtranslate($LISTVIEW_HEADER->get('label'), $MODULE_NAME)}&nbsp;
                                        </a>
                                    </th>
                                {/foreach}
                                <th class="listViewHeaderValues noSorting {$WIDTHTYPE}">{vtranslate('LBL_UNIT_PRICE',$MODULE_NAME)}</th>
                                <th class="listViewHeaderValues noSorting {$WIDTHTYPE}">{vtranslate('LBL_LIST_PRICE',$MODULE_NAME)}</th>
                            </tr>
                        </thead>
                        {if $MODULE_MODEL && $MODULE_MODEL->isQuickSearchEnabled()}
                            <tr class="searchRow">
                                <td class="searchBtn">
                                    <button class="btn btn-success" data-trigger="PopupListSearch">{vtranslate('LBL_SEARCH', $MODULE )}</button>
                                </td>
                                {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                    <td>
                                        {assign var=FIELD_UI_TYPE_MODEL value=$LISTVIEW_HEADER->getUITypeModel()}
                                        {include file=vtemplate_path($FIELD_UI_TYPE_MODEL->getListSearchTemplateName(),$MODULE_NAME)
                                                    FIELD_MODEL= $LISTVIEW_HEADER SEARCH_INFO=$SEARCH_DETAILS[$LISTVIEW_HEADER->getName()] USER_MODEL=$USER_MODEL}
                                    </td>
                                {/foreach}
                                <td></td>
                                <td></td>
                            </tr>
                        {/if}

                        {foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES name=popupListView}
                            {assign var="RECORD_DATA" value="{$LISTVIEW_ENTRY->getRawData()}"}
                            <tr class="listViewEntries" data-id="{$LISTVIEW_ENTRY->getId()}" data-name='{$LISTVIEW_ENTRY->getName()}' data-currency='{$LISTVIEW_ENTRY->get('currency_id')}'
                                {if $GETURL neq '' } data-url='{$LISTVIEW_ENTRY->$GETURL()}' {/if} id="{$MODULE}_popUpListView_row_{$smarty.foreach.popupListView.index+1}">
                                <td class="{$WIDTHTYPE}">
                                    <input class="entryCheckBox" type="checkbox" />
                                </td>
                                {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                    {assign var=LISTVIEW_HEADERNAME value=$LISTVIEW_HEADER->get('name')}
                                    <td class="listViewEntryValue textOverflowEllipsis {$WIDTHTYPE}" title="{$RECORD_DATA[$LISTVIEW_HEADERNAME]}">
                                        {if $LISTVIEW_HEADER->isNameField() eq true or $LISTVIEW_HEADER->get('uitype') eq '4'}
                                            <a>{$LISTVIEW_ENTRY->get($LISTVIEW_HEADERNAME)}</a>
                                        {else}
                                            <a>{$LISTVIEW_ENTRY->get($LISTVIEW_HEADERNAME)}</a>
                                        {/if}
                                    </td>
                                {/foreach}
                                <td class="listViewEntryValue {$WIDTHTYPE}">
                                    <a>{$LISTVIEW_ENTRY->get('unit_price')}</a>
                                </td>
                                <td class="listViewEntryValue {$WIDTHTYPE}">
                                    <input type="text" value="{$LISTVIEW_ENTRY->get('unit_price')}" name="unit_price" class="inputElement invisible zeroPaddingAndMargin" data-rule-required="true" data-rule-currency="true"
                                               data-decimal-separator='{$USER_MODEL->get('currency_decimal_separator')}' data-group-separator='{$USER_MODEL->get('currency_grouping_separator')}'/>
                                </td>
                            </tr>
                        {/foreach}
                    </table>
                </div>
                    
                <!--added this div for Temporarily -->
                {if $LISTVIEW_ENTRIES_COUNT eq '0'}
                    <div class="row">
                        <div class="emptyRecordsDiv">
                                {**PVTPATCHER-60665E1A54DDEBC0346FBCC943C7CD49-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
                                                                {if $CURRENT_USER_MODEL->get('language') eq 'fa_ir' or  $CURRENT_USER_MODEL->get('language') eq 'fa_af'}
								     {vtranslate('No %s found.', 'ParsVT',vtranslate($MODULE_NAME, $MODULE_NAME))}
								{else}
								     {vtranslate('LBL_NO', $MODULE_NAME)} {vtranslate($MODULE_NAME, $MODULE_NAME)} {vtranslate('LBL_FOUND', $MODULE_NAME)}.
								{/if}
{** REPLACED-60665E1A54DDEBC0346FBCC943C7CD49// {vtranslate('LBL_NO', $MODULE_NAME)} {vtranslate($MODULE_NAME, $MODULE_NAME)} {vtranslate('LBL_FOUND', $MODULE_NAME)}.**}
{**PVTPATCHER-60665E1A54DDEBC0346FBCC943C7CD49-FINISH**}
                        </div>
                    </div>
                {/if}
            </div>
            {if $FIELDS_INFO neq null}
                <script type="text/javascript">
                    var popup_uimeta = (function() {
                        var fieldInfo  = {$FIELDS_INFO};
                        return {
                            field: {
                                get: function(name, property) {
                                    if(name && property === undefined) {
                                        return fieldInfo[name];
                                    }
                                    if(name && property) {
                                        return fieldInfo[name][property]
                                    }
                                },
                                isMandatory : function(name){
                                    if(fieldInfo[name]) {
                                        return fieldInfo[name].mandatory;
                                    }
                                    return false;
                                },
                                getType : function(name){
                                    if(fieldInfo[name]) {
                                        return fieldInfo[name].type
                                    }
                                    return false;
                                }
                            },
                        };
                    })();
                </script>
            {/if}
        </div>
    </div>
{/strip}
