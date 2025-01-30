{*<!--
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}
{include file='SettingsHeader.tpl'|@vtemplate_path:$QUALIFIED_MODULE}
<style>
    code, pre {
        direction: ltr;
        text-align: left;
        background-color: #f7f7f9;
        word-wrap: break-word;
    }
    .formatted code {
        color: #d14;
        padding: 2px 4px;
        font-family: monospace;
        font-size: small;
    }
    .afterlink:after {
        content: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAQElEQVR42qXKwQkAIAxDUUdxtO6/RBQkQZvSi8I/pL4BoGw/XPkh4XigPmsUgh0626AjRsgxHTkUThsG2T/sIlzdTsp52kSS1wAAAABJRU5ErkJggg==);
        margin: 0 5px 0 3px;
        position: relative;
        bottom: -2px;
    }
</style>

<br />
<div class="container-fluid">
    <div class="contents row-fluid">
        <ul class="nav nav-tabs nav-pills massEditTabs" style="margin-bottom: 0;border-bottom: 0">
            <li class="active">
				<a href="#RestSettings" data-toggle="tab"><strong>{vtranslate('Rest API Settings',$QUALIFIED_MODULE)}</strong></a>
            </li>
            <li>
				<a href="#RestAPIV1" data-toggle="tab"><strong>{vtranslate('Rest API V1 Manual',$QUALIFIED_MODULE)}</strong></a>
            </li>
            <li>
				<a href="#RestAPIV2" data-toggle="tab"><strong>{vtranslate('Rest API V2 Manual',$QUALIFIED_MODULE)}</strong></a>
            </li>
            <li>
				<a href="#ParsVTPortalAPI" data-toggle="tab"><strong>{vtranslate('ParsVT Portal API Manual',$QUALIFIED_MODULE)}</strong></a>
            </li>
            <li>
				<a href="#OData" data-toggle="tab"><strong>{vtranslate('OData Feed (Business intelligence)',$QUALIFIED_MODULE)}</strong></a>
            </li>
            <li>
                <a href="#PBXIntegration" data-toggle="tab"><strong>{vtranslate('CTI Integration',$QUALIFIED_MODULE)}</strong></a>
            </li>
            <li>
                <a href="#Zapier" data-toggle="tab"><strong>{vtranslate('Third-Party Integration',$QUALIFIED_MODULE)}</strong></a>
            </li>
            {if $APILOG}
            <li>
                <a href="index.php?module=ParsVT&view=APIAccessList&parent=Settings" target="_blank">
                            <strong>{vtranslate('API Access Logs',$QUALIFIED_MODULE)}</strong>
                </a>
            </li>
            {/if}
            <li>
                <a href="https://developer.parsvt.com/" target="_blank" rel="noopener" class="afterlink">
                            <strong>{vtranslate('Developers',$QUALIFIED_MODULE)}</strong>
                </a>
            </li>
        </ul>
        <hr>
        <div class="tab-content layoutContent padding20 themeTableColor overflowVisible">
            <div class="tab-pane active" id="RestSettings">
                <div class="row-fluid">
                    <form class="form-horizontal"
                          action='index.php?module=ParsVT&parent=Settings&view=RestAPI&action=SaveAPI' method='POST'>
                        <table class="table table-condensed">
                            <thead>
                            <tr class="blockHeader">
                                <th colspan="2" class="medium">{vtranslate('Rest API Settings',$QUALIFIED_MODULE)}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="30%" class="medium">{vtranslate('Allow All IPs',$QUALIFIED_MODULE)}</td>
                                <td class="row-fluid">
                                    <input name="allowallips" id="allowallips" style="opacity: 0;" {if !$ALLOWALLIPS} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle" data-type="allowallips" />
                                    <small>{vtranslate("Allow All IPs",$QUALIFIED_MODULE)}<br></small>
                                </td>
                            </tr>
                            <tr class="allowedips {if $ALLOWALLIPS}hide{/if}">
                                <td width="30%" class="medium">{vtranslate('Allowed IPs',$QUALIFIED_MODULE)}</td>
                                <td class="row-fluid">
                                    <small>{vtranslate("Rest API v1 & v2 will be accessible by following IP addresses only",$QUALIFIED_MODULE)}</small><br>
                                    <textarea id="allowedipsUi" class="col-sm-9 select2 pickListValues" name="allowedips" style="direction: ltr; text-align: left" placeholder="{vtranslate('IP Address', $QUALIFIED_MODULE)}" data-rule-required="true" data-rule-picklist="true" >{$ALLOWEDIPS}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%" class="medium">{vtranslate('Monitor API call',$QUALIFIED_MODULE)}</td>
                                <td class="row-fluid">
                                    <input name="apilog" id="apilog" style="opacity: 0;" {if !$APILOG} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"/>
                                    <small>{vtranslate("Log web service calls",$QUALIFIED_MODULE)}<br>{vtranslate("max_allowed_packet value must greater than 128M",$QUALIFIED_MODULE)}<br></small>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%" class="medium">{vtranslate('Token Expire Time in Webservice V1',$QUALIFIED_MODULE)}</td>
                                <td class="row-fluid"><input class="inputElement " type="number" name="expirationTimeout" value="{$expirationTimeout}" required style="max-width: 200px">
                                    <small>{vtranslate("in seconds",$QUALIFIED_MODULE)}</small>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%" class="medium">{vtranslate('OCR API Key',$QUALIFIED_MODULE)}</td>
                                <td class="row-fluid"><input class="inputElement " type="text" name="ocr_apikey" value="{$ocr_apikey}" required  style="max-width: 200px">
                                    <small><a href="https://ocr.space/OCRAPI" target="_blank"> {vtranslate("get free api from here",$QUALIFIED_MODULE)}</a></small>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="widget_header row-fluid">
                            <div class="span4 btn-toolbar">
                                <div>
                                    <button class="btn btn-success saveButton" type="submit" title="{vtranslate("Save",$QUALIFIED_MODULE)}">
                                        <strong>{vtranslate("Save",$QUALIFIED_MODULE)}</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="tab-pane" id="PBXIntegration">
                <div class="row-fluid formatted">
                    {ParsVT_WhiteLabel_Model::changeLabel(str_replace('http://yourcrm.com/',vglobal('site_URL'),$PARSEDOWN->text($PBXINTEGRATION)))}
                    <br/>
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="tab-pane" id="RestAPIV1">
                <div class="row-fluid formatted">
                    {ParsVT_WhiteLabel_Model::changeLabel(str_replace('http://yourcrm.com/',vglobal('site_URL'),$PARSEDOWN->text($HELP)))}
                    <br/>
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="tab-pane" id="RestAPIV2">
                <div class="row-fluid formatted">
                    {if isset($_SERVER['HTTPS'])}
                        {assign var="serverprotocol" value='https'}
                    {else}
                        {assign var="serverprotocol" value='http'}
                    {/if}
                    {ParsVT_WhiteLabel_Model::changeLabel(str_replace('serverport',$smarty.server.SERVER_PORT,str_replace('serverhostname',$smarty.server.HTTP_HOST,str_replace('serverprotocol',$serverprotocol,str_replace('http://yourcrm.com/',vglobal('site_URL'),$PARSEDOWN->text($HELP2))))))}
                    <br/>
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="tab-pane" id="ParsVTPortalAPI">
                <div class="row-fluid formatted">
                    {if !$ParsVTPortal}
                        <div class = "alert alert-danger" style="margin: 20px 0">
                            {vtranslate('The ParsVTPortal module is not installed. Visit VTfarsi.ir to order the module', $QUALIFIED_MODULE)}
                        </div>
                    {/if}
                    {if isset($_SERVER['HTTPS'])}
                        {assign var="serverprotocol" value='https'}
                    {else}
                        {assign var="serverprotocol" value='http'}
                    {/if}
                    {ParsVT_WhiteLabel_Model::changeLabel(str_replace('serverport',$smarty.server.SERVER_PORT,str_replace('serverhostname',$smarty.server.HTTP_HOST,str_replace('serverprotocol',$serverprotocol,str_replace('http://yourcrm.com/',vglobal('site_URL'),$PARSEDOWN->text($HELPPORTAL))))))}
                    <br/>
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="tab-pane" id="OData">
                <div class="row-fluid">
                    {if !$ParsPowerBI}
                        <div class = "alert alert-danger" style="margin: 20px 0">
                            {vtranslate('The ParsPowerBI module is not installed. Visit VTfarsi.ir to order the module', $QUALIFIED_MODULE)}
                        </div>
                    {/if}
                    {ParsVT_WhiteLabel_Model::changeLabel(str_replace('http://yourcrm.com/',vglobal('site_URL'),$PARSEDOWN->text($ParsPowerBIManual)))}
                </div>
            </div>
            <div class="tab-pane" id="Zapier">
                <div class="row-fluid">
                    <a href="http://www.zapier.com" target="_blank"><img src="layouts/{vglobal('default_layout')}/modules/ParsVT/images/Zapier.png"></a><br />
                    <a href="http://www.make.com" target="_blank"><img src="layouts/{vglobal('default_layout')}/modules/ParsVT/images/make.png"></a>
                    <br />
                    {vtranslate('ZAPIER_DESC',$QUALIFIED_MODULE)}
                    <!--
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/ping/
                    <br />
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/ListModules
                    <br />
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/Pull/Leads
                    <br />
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/PullUpdated/Leads
                    <br />
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/UpdateActionFields/Leads
                    <br />
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/Fields/Leads
                    <br />
                    {vglobal('site_URL')}/modules/ParsVT/ws/API/V2/Sync/Push/Leads
                    <br />
                    firstname:John
                    lastname:Due
                    Search_Field[]:lastname
                    <br />
                    !-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    $('.form-horizontal').off('switchChange.bootstrapSwitch').on('switchChange.bootstrapSwitch', '#apilog', function(event, state){
        if (state) {
            jQuery(this).val('1');
            jQuery(this).prop("checked","true");
        } else {
            jQuery(this).val('0');
            jQuery(this).prop("checked","false");
        }
    });
});
</script>
