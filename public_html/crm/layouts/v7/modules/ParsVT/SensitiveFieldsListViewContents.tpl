{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}

{strip}
    <input type="hidden" id="pageStartRange" value="{$PAGING_MODEL->getRecordStartRange()}" />
    <input type="hidden" id="pageEndRange" value="{$PAGING_MODEL->getRecordEndRange()}" />
    <input type="hidden" id="previousPageExist" value="{$PAGING_MODEL->isPrevPageExists()}" />
    <input type="hidden" id="nextPageExist" value="{$PAGING_MODEL->isNextPageExists()}" />
    <input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
    <input type="hidden" value="{$ORDER_BY}" id="orderBy">
    <input type="hidden" value="{$SORT_ORDER}" id="sortOrder">
    <input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
    <input type='hidden' value="{$PAGE_NUMBER}" id='pageNumber'>
    <input type='hidden' value="{$PAGING_MODEL->getPageLimit()}" id='pageLimit'>
    <input type="hidden" value="{$LISTVIEW_ENTIRES_COUNT}" id="noOfEntries">
    <div class="clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h3 style="margin-top: 0px;">{vtranslate('Encrypted Field Access Logs', $QUALIFIED_MODULE)}</h3>
        </div>
    </div>
    <hr>
	<div class="col-sm-12 col-xs-12 ">
		<div id="listview-actions" class="listview-actions-container">
            <div class="listSearchActionContainer">
                <div class="col-md-6 pull-right">
                    {assign var=RECORD_COUNT value=$LISTVIEW_ENTIRES_COUNT}
                    {include file="Pagination.tpl"|vtemplate_path:$MODULE SHOWPAGEJUMP=true}
                </div>
            </div>
            <div class="list-content row">
				<div class="col-sm-12 col-xs-12 ">
                    <div id="table-content" class="table-container" style="padding-top:0px !important;">
                        <table id="listview-table"  class="table listview-table">
                            {assign var="NAME_FIELDS" value=$MODULE_MODEL->getNameFields()}
                            {assign var=WIDTHTYPE value=$CURRENT_USER_MODEL->get('rowheight')}
                            <thead>
                                <tr class="listViewContentHeader">
                                    <th> </th>
                                    {foreach key=LISTVIEW_HEADER_NAME item=LISTVIEW_FIELD_INFO from=$FIELDS_INFO}
                                        <th nowrap>
                                            <a>{vtranslate($LISTVIEW_FIELD_INFO['label'], $QUALIFIED_MODULE)}</a>&nbsp;
                                        </th>
                                    {/foreach}
                                </tr>
                                
                                <tr class="searchRow listViewSearchContainer">
                                    <th class="inline-search-btn">
                                        <div class="table-actions" style="width : auto !important; display: flex">
                                            <button class="searchBtn btn btn-primary"  data-trigger="sensitive_listSearch">
                                                <i class="fa fa-search"></i> {vtranslate('LBL_SEARCH', $MODULE)}
                                            </button>
                                            <button class="searchAndClearButton btn btn-danger {if !$SEARCH_DETAILS ||count($SEARCH_DETAILS) eq 0}hide{/if}" style="width: auto !important;" data-trigger="sensitive_ClearSearch"><i class="fa fa-close"></i></button>
                                        </div>      
                                    </th>
                                    {foreach key=LISTVIEW_HEADER_NAME item=LISTVIEW_FIELD_INFO from=$FIELDS_INFO}
                                        <th>
                                            {if $LISTVIEW_HEADER_NAME eq 'performedon'} 
                                                <input type="text" name="performedon" placeholder="{vtranslate('LBL_SELECT_DATE_RANGE',$MODULE)}" class="listSearchContributor inputElement dateField" data-date-format="{$CURRENT_USER_MODEL->get('date_format')}" data-calendar-type="range" value="{$SEARCH_DETAILS[$LISTVIEW_HEADER_NAME]}"  data-field-type="datetime" id="sensitive_{$LISTVIEW_HEADER_NAME}"/>
                                            {else if $LISTVIEW_FIELD_INFO['type'] eq 'picklist'}
                                                {assign var=PICKLIST_VALUES value=ParsVT_SensitiveFieldsList_View::getSearchableValues($LISTVIEW_HEADER_NAME)}
                                                <select class="select2 col-lg-11 col-md-11 col-sm-11 listSearchContributor" name="{$LISTVIEW_HEADER_NAME}" {if $LISTVIEW_HEADER_NAME eq 'module'} id="moduleName" {else} id="sensitive_{$LISTVIEW_HEADER_NAME}" {/if} >
                                                    <option value="">{vtranslate('LBL_SELECT_OPTION', $QUALIFIED_MODULE)}</option>
                                                    {if $LISTVIEW_HEADER_NAME eq 'fieldname'}
                                                        {foreach item=OPTION_VALUES key=FIELDS_MODULE_NAME from=$PICKLIST_VALUES}
                                                            <optgroup label="{vtranslate($FIELDS_MODULE_NAME, $FIELDS_MODULE_NAME)}"> 
                                                                {foreach item=OPTION_VALUE key=OPTION_KEY from=$OPTION_VALUES}
                                                                    <option value="{$OPTION_KEY}" {if $OPTION_KEY eq $SEARCH_DETAILS[$LISTVIEW_HEADER_NAME]} selected {/if}>{$OPTION_VALUE}</option>
                                                                {/foreach}
                                                            </optgroup>
                                                        {/foreach}
                                                    {else}
                                                        {foreach item=OPTION_VALUE key=OPTION_KEY from=$PICKLIST_VALUES}
                                                            <option value="{$OPTION_KEY}"
                                                                    name="{$OPTION_VALUE}" {if $OPTION_KEY eq $SEARCH_DETAILS[$LISTVIEW_HEADER_NAME]} selected {/if}>{$OPTION_VALUE}</option>
                                                        {/foreach}
                                                    {/if}
                                                </select>
                                            {else}
                                                <input type="text" name="{$LISTVIEW_HEADER_NAME}" class="listSearchContributor inputElement" value="{$SEARCH_DETAILS[$LISTVIEW_HEADER_NAME]}" id="sensitive_{$LISTVIEW_HEADER_NAME}"/>
                                            {/if}
                                        </th>
                                    {/foreach}
                                </tr>
                            </thead>
                            <tbody class="overflow-y">
                            {foreach key=RECORD_ID item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES}
                                <tr class="listViewEntries" data-id="{$RECORD_ID}">
                                    <td> {$LISTVIEW_ENTRY['id']}</td>
                                    {foreach key=LISTVIEW_HEADERNAME item=LISTVIEW_FIELD_INFO from=$FIELDS_INFO}
                                        <td class="listViewEntryValue textOverflowEllipsis {$WIDTHTYPE}"
                                            width="{$WIDTH}%" nowrap style='cursor:text;padding-left: 5px'>
                                            {$LISTVIEW_ENTRY[$LISTVIEW_HEADERNAME]}
                                        </td>
                                    {/foreach}
                                </tr>
                            {/foreach}

                            {if $LISTVIEW_ENTIRES_COUNT eq '0'}
                                {assign var=COLSPAN_WIDTH value={count($LISTVIEW_HEADERS)}+1}
                                <tr class="emptyRecordsDiv">
                                    <td colspan="{$COLSPAN_WIDTH}">
                                        <div class="emptyRecordsContent">
                                            {if $CURRENT_USER_MODEL->get('language') eq 'fa_ir' or  $CURRENT_USER_MODEL->get('language') eq 'fa_af'}
                                                {vtranslate('LBL_NO_RECORDS_FOUND', 'ParsVT')}
                                            {else}
                                                {vtranslate('LBL_NO')} {vtranslate($MODULE, $QUALIFIED_MODULE)} {vtranslate('LBL_FOUND')}.
                                            {/if}

                                        </div>
                                    </td>
                                </tr>
                            {/if}
                            </tbody>
                        </table>
                    </div>
                    <div id="scroller_wrapper" class="bottom-fixed-scroll">
                        <div id="scroller" class="scroller-div"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    {if $FIELDS_INFO neq null}
        <script>
            var uimeta = (function() {
                var fieldInfo  = {json_encode($FIELDS_INFO)};
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
{/strip}
