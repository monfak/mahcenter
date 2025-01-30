{*<!--
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}

{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
<style>
    #lngeditor * {
        text-align: center;
    }

    #lngeditor {
        table-layout: fixed;
        word-wrap: break-word;
    }

    .pvtdash dt {
        padding: 0 40px;
    }

    .pvtdash li, #tablelists * {
        #font-size: 90% !important;
    }

    .confTable * {
        #font-size: 90% !important;
        direction: ltr;
        text-align: center;
    }

    .confTable2 * {
        #font-size: 90% !important;
        text-align: center;
        font-weight: normal !important;
    }

    .backupTable tr td label {
        #font-size: 90% !important;
        text-align: center;
    }

    .blink_me {
        animation: blinker 3s linear infinite;
        font-weight: bold;
    }

    @keyframes blinker {
        50% {
            opacity: 0.25;
        }
    }

    .vtToolBox {
        background-color: #ffffff;
        border: 1px solid #000;
        padding: 5px;
        margin: 5px;
    }

    .vtToolBox legend {
        padding: 5px;
        font-size: 14px;
        width: auto;
        border: none;
        margin-bottom: 0;
        line-height: 130%;
    }

    div.select2-drop {
        z-index: 30000;
    }

    .box-info {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #eeeff2;
        margin-left: 1px;
        padding-top: 5px;
    }

    .needattention {
        color: #a94442 !important;
        background-color: #f2dede !important;
        border-color: #ebccd1 !important;
    }

    .needoptimize {
        color: #8a6d3b !important;
        background-color: #fcf8e3 !important;
        border-color: #faebcc !important;
    }

    .okattention {
        color: #3c763d !important;
        background-color: #dff0d8 !important;
        border-color: #d6e9c6 !important;

    }

    .normalattention {
        color: #31708f !important;
        background-color: #d9edf7 !important;
        border-color: #bce8f1 !important;
    }

    .codecolor > li.active > a, .codecolor > li.active > a:hover, .codecolor > li.active > a:focus {
        color: black;
        background-color: #fcd900;
    }

    #datatable_filter > label > input[type="search"] {
        border-radius: 1px;
        box-shadow: none;
        border: 1px solid #cccccc;
        margin-right: 0.5em;
    }

    .dataTables_wrapper .dataTables_filter {
        float: left !important;
    }

    .lngcolor {
        border-color: #a4aaab;
        box-shadow: 0 0 5px #a4aaab;
    }

    .lngjscolor {
        border-color: #ad8b8b;
        box-shadow: 0 0 5px #a4aaab;
    }

    .lng:focus {
        border-color: #cfdc00;
        box-shadow: 0 0 2px #fcd900, inset 0 0 101px #fcd900;
    }

    {if $CURRENT_USER_MODEL->get('language') neq 'fa_ir'}
    .bootstrap-switch-container {
        min-width: 130px;
    }

    {/if}
    .parsvtfeatures {
        background-position: {if $RTLCSS}20px{else}right{/if} center;
        background-repeat: no-repeat;
    {literal} background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTI4cHgiIGhlaWdodD0iMTI4cHgiPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00MzcuMzMzLDE5MmgtMzJ2LTQyLjY2N0M0MDUuMzMzLDY2Ljk5LDMzOC4zNDQsMCwyNTYsMFMxMDYuNjY3LDY2Ljk5LDEwNi42NjcsMTQ5LjMzM1YxOTJoLTMyICAgIEM2OC43NzEsMTkyLDY0LDE5Ni43NzEsNjQsMjAyLjY2N3YyNjYuNjY3QzY0LDQ5Mi44NjUsODMuMTM1LDUxMiwxMDYuNjY3LDUxMmgyOTguNjY3QzQyOC44NjUsNTEyLDQ0OCw0OTIuODY1LDQ0OCw0NjkuMzMzICAgIFYyMDIuNjY3QzQ0OCwxOTYuNzcxLDQ0My4yMjksMTkyLDQzNy4zMzMsMTkyeiBNMjg3LjkzOCw0MTQuODIzYzAuMzMzLDMuMDEtMC42MzUsNi4wMzEtMi42NTYsOC4yOTIgICAgYy0yLjAyMSwyLjI2LTQuOTE3LDMuNTUyLTcuOTQ4LDMuNTUyaC00Mi42NjdjLTMuMDMxLDAtNS45MjctMS4yOTItNy45NDgtMy41NTJjLTIuMDIxLTIuMjYtMi45OS01LjI4MS0yLjY1Ni04LjI5Mmw2LjcyOS02MC41MSAgICBjLTEwLjkyNy03Ljk0OC0xNy40NTgtMjAuNTIxLTE3LjQ1OC0zNC4zMTNjMC0yMy41MzEsMTkuMTM1LTQyLjY2Nyw0Mi42NjctNDIuNjY3czQyLjY2NywxOS4xMzUsNDIuNjY3LDQyLjY2NyAgICBjMCwxMy43OTItNi41MzEsMjYuMzY1LTE3LjQ1OCwzNC4zMTNMMjg3LjkzOCw0MTQuODIzeiBNMzQxLjMzMywxOTJIMTcwLjY2N3YtNDIuNjY3QzE3MC42NjcsMTAyLjI4MSwyMDguOTQ4LDY0LDI1Niw2NCAgICBzODUuMzMzLDM4LjI4MSw4NS4zMzMsODUuMzMzVjE5MnoiIGZpbGw9IiNlZDk0NzQiLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
    }

    {/literal}

</style>
<div class="container-fluid" style="margin-top:10px;">
    <h3>{vtranslate('Training Videos Management', $MODULE)}</h3>
    <hr>
</div>
<div class="" style="margin-top:0px;">
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li id="VideoCategories"><a href="index.php?module=ParsVT&parent=Settings&view=Tutorials&mode=Categories">{vtranslate('Categories', $MODULE)}</a>
        </li>
        <li id="VideoSubcategories"><a href="index.php?module=ParsVT&parent=Settings&view=Tutorials&mode=SubCategories">{vtranslate('Sub Categories', $MODULE)}</a>
        </li>
        <li id="VideoList"><a href="index.php?module=ParsVT&parent=Settings&view=Tutorials&mode=Videos">{vtranslate('Videos', $MODULE)}</a>
        </li>
        <li id="VideoSettings"><a href="index.php?module=ParsVT&parent=Settings&view=Tutorials&mode=Settings">{vtranslate('Settings', $MODULE)}</a>
        </li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="clearfix"></div>
            {if $VIEW_TYPE eq 'List'}
                {if $ADD_BUTTON}
                    <div class="row">
                        <div class='col-md-5'>
                            <div class="foldersContainer pull-left">
                                <button type="button" class="btn addButton btn-default module-buttons"
                                        onclick='window.location.href = "index.php?module=ParsVT&parent=Settings&view=Tutorials&mode={if $MODE eq 'Categories'}EditCategory{elseif $MODE eq 'SubCategories'}EditSubCategory{else}EditVideo{/if}"'>
                                    <div class="fa fa-plus"></div>
                                    &nbsp;&nbsp;{vtranslate($ADD_BUTTON , $MODULE)}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                {/if}
                <div class="list-content row">
                    <div class="col-sm-12 col-xs-12 ">
                        <div id="table-content" class="table-container" style="padding-top:0px !important;">
                            <table id="myTable" class="table listview-table">
                                <thead>
                                <tr class="listViewContentHeader" style="background: #FBFBFB ">
                                    {foreach item=HEADER_FIELD from=$HEADERS}
                                        {if $HEADER_FIELD eq 'Id'}
                                            <th style="width: 75px;">{vtranslate($HEADER_FIELD , $MODULE)}</th>
                                        {else}
                                            <th nowrap>{vtranslate($HEADER_FIELD , $MODULE)}</th>
                                        {/if}
                                    {/foreach}
                                    <th nowrap style="width: 110px;">{vtranslate('Actions' , $MODULE)}</th>
                                </tr>
                                </thead>
                                {if $MODE eq "Videos"}
                                <tbody class="row_position">
                                {else}
                                <tbody class="">
                                {/if}
                                {if $RECORDS}
                                    {foreach item=LISTVIEW_ENTRY from=$RECORDS}
                                        <tr class="listViewEntries content" id="{$LISTVIEW_ENTRY['id']}">
                                            {foreach key=_KEY item=_VALUE from=$LISTVIEW_ENTRY}
                                                {if $_KEY eq 'id'}
                                                    <td style="width: 75px; padding-left: 15px; vertical-align: top; padding-top:7px;">
                                                        {if $MODE eq "Videos"}
                                                            <img src="{vimage_path('drag.png')}" class="alignTop"
                                                                 title="{vtranslate('LBL_DRAG',$QUALIFIED_MODULE)}"/>
                                                            &nbsp;
                                                        {/if}
                                                        {$_VALUE}
                                                    </td>
                                                {else}
                                                    <td style="vertical-align: top; padding-top:7px;">
                                                        {if $_KEY eq 'active' && $_VALUE eq 0}
                                                            {vtranslate('Inactive',QUALIFIED_MODULE)}
                                                        {elseif $_KEY eq 'active' && $_VALUE eq 1}
                                                            {vtranslate('Active',QUALIFIED_MODULE)}
                                                        {elseif $_KEY eq 'type'}
                                                            {vtranslate($_VALUE,QUALIFIED_MODULE)}
                                                        {else}
                                                            {$_VALUE}
                                                        {/if}
                                                    </td>
                                                {/if}
                                            {/foreach}
                                            <td>
                                                <div>
                                                    <a href="index.php?module=ParsVT&parent=Settings&view=Tutorials&mode={if $MODE eq 'Categories'}EditCategory{elseif $MODE eq 'SubCategories'}EditSubCategory{else}EditVideo{/if}&record={$LISTVIEW_ENTRY['id']}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    <a onclick="javascript:ParsVT_Tutorials_Js.deleteVideoRecord('{$MODE}','{$LISTVIEW_ENTRY['id']}');"  data-id="{$LISTVIEW_ENTRY['id']}"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                {else}
                                    <tr class="listViewEntries">
                                        <td colspan="{count($HEADERS)+1}">
                                            {vtranslate('No record found', 'ParsVT')}
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
            {elseif $VIEW_TYPE eq 'Edit'}
                <input type="hidden" id="PageType" value="{$PAGE_TYPE}">
                <input type="hidden" id="RecordID" value="{$RECORD_ID}">
                <div class="container-fluid" style="margin-top:10px;">
                    {if $MODE eq 'EditCategory'}
                        <h5>{if $PAGE_TYPE eq "Create"}{vtranslate('Create View Category', $MODULE)}{else}{vtranslate('Edit View Category', $MODULE)}{/if}</h5>
                    {elseif $MODE eq 'EditSubCategory'}
                        <h5> {if $PAGE_TYPE eq "Create"}{vtranslate('Add new subcategory', $MODULE)}{else}{vtranslate('Edit View SubCategory', $MODULE)}{/if}</h5>
                    {elseif $MODE eq 'EditVideo'}
                        <h5>{if $PAGE_TYPE eq "Create"}{vtranslate('Add new Video', $MODULE)}{else}{vtranslate('Edit View Video', $MODULE)}{/if}</h5>
                    {/if}
                    <hr>
                </div>
                <br>
                {assign var=TYPEOF value=str_replace("Edit","",$MODE)}
                {assign var="TypeListEd" value="" }
                <form method="post" id="Save{$TYPEOF}Form" class="videoform">
                    {foreach item=Field from=$FIELDS}
                        {if {$Field['name']} eq "path_video"}
                            {assign var="ClassCU" value="FieldVideoFile"}
                        {elseif {$Field['name']} eq "path_picture"}
                            {assign var="ClassCU" value="hide"}
                        {else}
                            {assign var="ClassCU" value=""}
                        {/if}
                        <div class="row {$ClassCU}">
                            <div class="form-group" style="margin-bottom: 0px">
                                <div class="col-md-2">
                                    {if $Field['isMandatory'] eq "required" && $Field['type'] eq "file" && $PAGE_TYPE eq "Edit"}
                                        {assign var="Star" value=''}
                                    {elseif $Field['isMandatory'] eq "required"}
                                        {assign var="Star" value='<span style="color: red"> *</span>'}
                                    {else}
                                        {assign var="Star" value=''}
                                    {/if}
                                    <label for="{$Field['name']}">{vtranslate($Field['label'], $MODULE)}{$Star}</label>
                                </div>
                                <div class="col-md-5">
                                    {if $Field['type'] eq "input"}
                                        {if ($MODE eq 'EditSubCategory' or $MODE eq 'EditCategory') and $Field['name'] eq 'title'}
                                            <input type="hidden" name="{$Field['name']}_original" value="{if $PAGE_TYPE eq "Edit"}{$DATA_UPDATE[$Field['name']]}{/if}">
                                        {/if}
                                        <input type="text" name="{$Field['name']}" class="form-control" value="{if $PAGE_TYPE eq "Edit"}{$DATA_UPDATE[$Field['name']]}{/if}"  placeholder="{vtranslate($Field['label'], $MODULE)}" {$Field['isMandatory']} data-rule-required="true" aria-required="true">
                                    {elseif $Field['type'] eq "textarea" }
                                        <textarea name="{$Field['name']}" class="form-control" rows="3" placeholder="{vtranslate($Field['label'], $MODULE)}">{if $PAGE_TYPE eq "Edit"}{$DATA_UPDATE[$Field['name']]}{/if}</textarea>
                                    {elseif $Field['type'] eq "picklist"}
                                        {if $Field['name'] eq "upload_type" && $PAGE_TYPE eq "Edit"}
                                            {assign var="TypeListEd" value=$DATA_UPDATE[$Field['name']] }
                                        {/if}
                                        {if $Field['name'] eq "category"}
                                            {assign var="ClassCategory" value="ClassCategoryOnChange"}
                                        {elseif ($Field['name'] eq "subcategory")}
                                            {assign var="ClassCategory" value="ClassSubCategoryOnChange" }
                                        {elseif ($Field['name'] eq "view")}
                                            {assign var="ClassCategory" value="ClassViewOnChange" }
                                        {else}
                                            {assign var="ClassCategory" value="" }
                                        {/if}
                                        {assign var="StatusCustomView" value=false}
                                        <select id="{$ClassCategory}" data-fieldname="{$Field['name']}" placeholder="" data-fieldtype="picklist" class="inputElement select2  select2-offscreen" type="picklist" name="{$Field['name']}" {$Field['isMandatory']}>
                                            <option>{vtranslate('LBL_SELECT_OPTION')}</option>
                                            {if $PAGE_TYPE eq "Edit"}
                                                {if $Field['name'] === "view"}
                                                    {if in_array($DATA_UPDATE[$Field['name']] , $Field['values'])}
                                                        {foreach key=_KEY item=_VALUE from=$Field['values'] }
                                                            {if $_KEY eq $DATA_UPDATE[$Field['name']]}
                                                                <option value="{$_KEY}" selected>{vtranslate($_VALUE, $MODULE)}</option>
                                                            {else}
                                                                <option value="{$_KEY}">{vtranslate($_VALUE, $MODULE)}</option>
                                                            {/if}
                                                        {/foreach}
                                                    {else}
                                                        {foreach key=_KEY item=_VALUE from=$Field['values'] }
                                                            {if $_KEY eq "Other"}
                                                                <option value="{$_KEY}" selected>{vtranslate($_VALUE, $MODULE)}</option>
                                                            {else}
                                                                <option value="{$_KEY}">{vtranslate($_VALUE, $MODULE)}</option>
                                                            {/if}
                                                        {/foreach}
                                                        {assign var="StatusCustomView" value=true}
                                                    {/if}
                                                {else}
                                                    {foreach key=_KEY item=_VALUE from=$Field['values'] }
                                                        {if $_KEY eq $DATA_UPDATE[$Field['name']]}
                                                            <option value="{$_KEY}" selected>{vtranslate($_VALUE, $MODULE)}</option>
                                                        {else}
                                                            <option value="{$_KEY}">{vtranslate($_VALUE, $MODULE)}</option>
                                                        {/if}
                                                    {/foreach}
                                                {/if}
                                            {else}
                                                {foreach key=_KEY item=_VALUE from=$Field['values'] }
                                                    {if $Field['values'] neq ""}
                                                        <option value="{$_KEY}">{vtranslate($_VALUE, $MODULE)}</option>
                                                    {/if}
                                                {/foreach}
                                            {/if}
                                        </select>
                                        {if $Field['name'] eq "view"}
                                            {if $PAGE_TYPE eq "Edit" && $StatusCustomView eq true}
                                                <div id="OtherSelectView">
                                                    <hr>
                                                    <input type="text" class="form-control" value="{$DATA_UPDATE[$Field['name']]}" id="" placeholder="* {vtranslate("CustomView", $MODULE)}" name="CustomViewField">
                                                </div>
                                            {else}
                                                <div id="OtherSelectView" style="display: none">
                                                    <hr>
                                                    <input type="text" class="form-control" value="" id="" placeholder="* {vtranslate("CustomView", $MODULE)}" name="CustomViewField">
                                                </div>
                                            {/if}
                                        {/if}


                                    {elseif $Field['type'] eq "file"}
                                        {if $TypeListEd eq "File"  && $PAGE_TYPE eq "Edit"}
                                            <input type="hidden" name="OldFileUploaded" value="{$VIDEO_LINK}">
                                            <input id="UploadedFiles" type="file" size="" name="{$Field['name']}"
                                                   class="form-control" value="">
                                            <iframe width="560" height="315" src="{$VIDEO_LINK}" frameborder="0"
                                                    allowfullscreen></iframe>
                                        {elseif $TypeListEd eq "URL" && $PAGE_TYPE eq "Edit"}
                                            <input type="hidden" name="OldFileUploaded" value='{$VIDEO_LINK}'>
                                            <input type="url" name="{$Field['name']}" class="form-control"
                                                   placeholder="{$Field['name']}" value="">
                                            <br>
                                            {$VIDEO_LINK}
                                        {else}
                                            <input id="UploadedFiles" type="file" size="" name="{$Field['name']}"
                                                   class="form-control"
                                                   data-rule-required="true" {$Field['isMandatory']} accept=".mp4"
                                                   value="">
                                        {/if}

                                    {elseif $Field['type'] eq "url"}
                                        <input type="url" size="" name="{$Field['name']}" class="form-control"
                                               placeholder="{$Field['name']}" {$Field['isMandatory']}>
                                    {elseif $Field['type'] eq "multipicklist"}
                                        <select id="Contacts_Edit_fieldName_{$Field['name']}" multiple=""
                                                class="inputElement select2 select2-offscreen" name="{$Field['name']}"
                                                data-fieldtype="multipicklist" tabindex="-1" aria-invalid="false">
                                            {if $PAGE_TYPE eq "Edit"}
                                                {assign var=someVar value=" |##| "|explode: $DATA_UPDATE[$Field['name']]}
                                                {foreach key=_KEY item=_VALUE from=$Field['values'] }
                                                    {if $Field['name'] eq 'view'}
                                                        <option value="{$_KEY}"
                                                                {if $_KEY eq $DATA_UPDATE[$Field['name']]}selected{/if}>{$_VALUE}</option>
                                                    {else}
                                                        <option value="{$_KEY}"
                                                                {if $_KEY eq $DATA_UPDATE[$Field['name']]}selected{/if}>{vtranslate($_VALUE, $MODULE)}</option>
                                                    {/if}
                                                {/foreach}
                                            {else}
                                                {foreach key=_KEY item=_VALUE from=$Field['values'] }
                                                    <option value="{$_KEY}">{vtranslate($_VALUE, $MODULE)}</option>
                                                {/foreach}
                                            {/if}
                                        </select>
                                    {elseif $Field['type'] eq "file"}
                                        <div class="">
                                            <input id="UploadedFiles" type="file" size="" name="{$Field['name']}"
                                                   class="form-control" {$Field['isMandatory']}>
                                        </div>
                                    {elseif $Field['type'] eq "url"}
                                        <input type="url" size="" name="{$Field['name']}" class="form-control"
                                               placeholder="{$Field['name']}" {$Field['isMandatory']} style="direction: ltr; text-align: left">
                                    {elseif $Field['type'] eq "checkbox"}
                                        <input class="inputElement" style="width:15px;height:15px;"
                                               data-fieldtype="checkbox" type="checkbox" name="{$Field['name']}"
                                               {if $PAGE_TYPE eq "Edit"}{if {$DATA_UPDATE[$Field['name']]} eq 1}checked{/if}{/if} >
                                    {/if}
                                </div>
                            </div>
                        </div>
                        <br>
                    {/foreach}

                </form>

                <hr>
                <div class="modal-overlay-footer clearfix">
                    <div class="row clearfix">
                        <div class="textAlignCenter col-lg-12 col-md-12 col-sm-12 ">
                            <button typeof="Save{$TYPEOF}Form" name="SaveTrainingVideos" type="button"
                                    class="btn btn-success SaveTrainingVideos">{vtranslate("Save", $MODULE)}</button>
                            <a class="cancelLink" href="javascript:history.back()"
                               type="reset">{vtranslate("Back", $MODULE)}</a>
                        </div>
                    </div>
                </div>
            {elseif $VIEW_TYPE eq 'Settings'}
                    <div class="row clearfix">
                        <div class="textAlignCenter col-lg-12 col-md-12 col-sm-12 ">
                            <button class="btn btn-danger" onclick="javascript:ParsVT_Tutorials_Js.cleanAllTutorials();"><strong><i class="fa fa-trash"></i>&nbsp;{'Delete all records'|@vtranslate:$MODULE}</strong></button>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
            {/if}
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#Video{$MODE}").addClass("active");
    });


</script>