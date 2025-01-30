<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:0px;">
    <h4>{vtranslate('AvvalOffice Settings', $QUALIFIED_MODULE)}</h4>
    <hr>
</div>

<div class="col-lg-12" style="margin-top: 10px">
    {assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
    {if $CURRENT_USER_MODEL->get('language') eq 'fa_ir' or  $CURRENT_USER_MODEL->get('language') eq 'fa_af'}
        <p class="alert alert-warning">
            {vtranslate('PARSVT_PBX_NOTICE', $MODULE)}
        </p>
    {/if}

    {if $PBXMANAGER}
        <table class="table table-bordered blockContainer showInlineTable equalSplit">
            <thead>
            <tr class="active">
                <th class="" colspan="4"><img src="layouts/{vglobal('default_layout')}/modules/ParsVT/images/helpinfo.png"> &nbsp;{vtranslate('Service IP(s)', $MODULE)}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="fieldLabel medium" style="width: 30%">
                    <label class="muted pull-right marginRight10px">{vtranslate('Public IP Address',$MODULE)}</label>
                </td>
                <td  class="text-center">
                    <div>{ParsVT_PBXManager_Model::get_public_ip()}</div>
                </td>
            </tr>
            <tr>
                <td class="fieldLabel medium">
                    <label class="muted pull-right marginRight10px">{vtranslate('Server IP Address', $MODULE)}</label>
                </td>
                <td  class="text-center" colspan="3">
                    <div>{ParsVT_PBXManager_Model::get_server_ip()}</div>
                </td>
            </tr>
            <tr>
                <td class="fieldLabel medium">
                    <label class="muted pull-right marginRight10px">{vtranslate('PBXManager Webapp URI', $MODULE)}</label>
                </td>
                <td  class="text-center" colspan="3">
                    <div style="direction: ltr; text-align: center">{ParsVT_PBXManager_Model::get_webapp_url()}</div>
                </td>
            </tr>
            </tbody>
        </table>

            {if $SUCCESS}
                <table class="table table-bordered blockContainer showInlineTable equalSplit">
                    <thead>
                    <tr class="active">
                        <th class="" colspan="4">{vtranslate('Connection status', $MODULE)}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="fieldLabel medium" style="width: 30%">
                            <label class="muted pull-right marginRight10px">{vtranslate('PBXManager', $MODULE)}</label>
                        </td>
                        <td  class="alert alert-{if $PBXMODULE}success{else}danger{/if} text-center">
                            <div>
                                <a href="http://license.aweb.co/download/PBX/PBXManager.zip" target="_blank">
                                    {if $PBXMODULE}
                                        {vtranslate("Update PBXManager Module",$QUALIFIED_MODULE)}
                                    {else}
                                        {vtranslate("Download PBXManager Module & Install or Update on VtigerCRM",$QUALIFIED_MODULE)}
                                    {/if}
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldLabel medium">
                            <label class="muted pull-right marginRight10px">{vtranslate('Message', $MODULE)}</label>
                        </td>
                        <td  class="alert alert-success text-center" colspan="3">
                            <div>
                                {vtranslate({$MESSAGE},$QUALIFIED_MODULE)}
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            {else}
                <table class="table table-bordered blockContainer showInlineTable equalSplit">
                    <thead>
                    <tr class="active">
                        <th class="" colspan="2" style="color:#d9534f">{vtranslate('Connection status', $MODULE)}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="fieldLabel medium" style="width: 30%">
                            <label class="muted pull-right marginRight10px">{vtranslate('PBXManager', $MODULE)}</label>
                        </td>
                        <td  class="alert alert-{if $PBXMODULE}success{else}danger{/if} text-center">
                            <div>
                                <a href="http://license.aweb.co/download/PBX/PBXManager.zip" target="_blank">
                                    {if $PBXMODULE}
                                        {vtranslate("Update PBXManager Module",$QUALIFIED_MODULE)}
                                    {else}
                                        {vtranslate("Download PBXManager Module & Install or Update on VtigerCRM",$QUALIFIED_MODULE)}
                                    {/if}
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldLabel medium" style="width: 30%">
                            <label class="muted pull-right marginRight10px">{vtranslate('Error Message', $MODULE)}</label>
                        </td>
                        <td  class="alert alert-warning text-center">
                            <div>
                                {vtranslate({$MESSAGE},$QUALIFIED_MODULE)}
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            {/if}
        {assign var=MDLS value=$MODULES_LIST}
        {assign var=SELECTED_FIELDS value=array()}
        {assign var=MANDATORY_FIELDS value=array()}

        <form id="AsteriskCTIForm" class="form-horizontal" action='index.php' method='POST'>
            <input type="hidden" name="module" value="ParsVT"/>
            <input type="hidden" name="action" value="SavePBX"/>
            <input type="hidden" name="parent" value="Settings"/>
            <input type="hidden" name="mode" value="AvvalOffice"/>
            <input type="hidden" name="id" value="{$RECORD_ID}">

            <div class="blockData">
                <table class="table table-bordered blockContainer showInlineTable equalSplit">
                    <thead>
                    <tr class="active">
                        <th class="" colspan="4"<img src="layouts/{vglobal('default_layout')}/modules/ParsVT/images/helpinfo.png"> &nbsp;{vtranslate('AvvalOffice Configration', $MODULE)}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach item=FIELD_VALUE key=FIELD_NAME from=$FIELDS}
                        <tr {if $FIELD_NAME eq 'vtigersecretkey' or $FIELD_NAME eq 'webappurl' or $FIELD_NAME eq 'outboundcontext' or $FIELD_NAME eq 'outboundtrunk'} class="hide" {/if}>
                            <td class="fieldLabel control-label" style="width:25%">
                                <label>{vtranslate($FIELD_NAME, $MODULE)}</label></td>
                            <td style="word-wrap:break-word;">
                                {if $FIELD_NAME eq 'vtigersecretkey'}
                                    {if !empty($FIELD_VALUE[1])}
                                        {assign var=VTIGERSECRETKEY value=$FIELD_VALUE[1] }
                                    {else}
                                        {assign var=VTIGERSECRETKEY value=PBXManager_Server_Model::generateVtigerSecretKey() }
                                    {/if}
                                {/if}
                                <input class="inputElement fieldValue"  style="direction: ltr; text-align: left; max-width: 300px" type="{$FIELD_VALUE[0]}" name="{$FIELD_NAME}" data-rule-required="true"   value="{if $FIELD_NAME eq 'outboundcontext' or $FIELD_NAME eq 'outboundtrunk'}from-internal{else if $FIELD_NAME eq 'vtigersecretkey'}{$VTIGERSECRETKEY}{elseif $FIELD_NAME eq 'webappurl'}{vglobal('site_URL')}modules/ParsVT/ws/API/V2/PBX/AvvalOffice/{else}{$FIELD_VALUE[1]}{/if}"/>
                            </td>
                        </tr>
                    {/foreach}

                    <tr>
                        <td class="fieldLabel control-label" style="width:25%">{vtranslate('MODULES LIST',$QUALIFIED_MODULE)}<br/>
                            <span style="font-size: 80%">{vtranslate('Modules List for Search Phone Fields in PBXManager',$QUALIFIED_MODULE)}</span>
                        </td>
                        <td class="row-fluid medium">{vtranslate('LBL_CHOOSE_COLUMNS',$QUALIFIED_MODULE)} {vtranslate('(Max 5) :', $QUALIFIED_MODULE)}<br>
                            <select name="MODULESLIST[]" data-placeholder="{vtranslate('LBL_ADD_MORE_COLUMNS',$MODULE)}" multiple class="inputElement columnsSelect " id="viewColumnsSelect">
                                <optgroup label='{vtranslate('MODULES LIST', $SOURCE_MODULE)}'>
                                    {foreach item=NAME from=$LISTMODULES}
                                        <option value="{$NAME}" data-field-name="{$FIELD_NAME}" {if in_array($NAME, $MDLS)} selected {/if}>{vtranslate($NAME, $NAME)}</option>
                                    {/foreach}
                                </optgroup>
                            </select>
                        </td>
                    </tr>

                    <tr id="popuptime">
                        <td class="fieldLabel control-label" style="width:25%">
                            {vtranslate('Popup Duration (second)',$QUALIFIED_MODULE)}
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="number"  name="popup_time" value="{$POPUPTIME}">
                        </td>
                    </tr>

                    <tr>
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Popup Request Interval (second)',$QUALIFIED_MODULE)}
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="number"  name="popup_interval" value="{$POPUPINTERVAL}">
                        </td>
                    </tr>

                    <tr id="prefix">
                        <td class="fieldLabel control-label" style="width:25%">
                            {vtranslate('Prefix Dial Number',$QUALIFIED_MODULE)}
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="number" name="prefix" value="{$prefix}">
                        </td>
                    </tr>

                    <tr>
                        <td class="fieldLabel control-label"  style="width:25%">
                            {vtranslate('Fix Phone Numbers',$QUALIFIED_MODULE)}
                        </td>
                        <td class="row-fluid medium">
                            <input name="fixnumber" id="fixnumber" data-type="fixnumber" style="opacity: 0;" {if $fixnumber neq 1} value='0' {else} value='1' checked{/if}
                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                   data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                   data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                   data-on-color="primary" data-toggle="toggle"/>
                        </td>
                    </tr>

                    <tr id="citycode">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('City Code',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="number" name="citycode" value="{$citycode}" required>
                        </td>
                    </tr>

                    <tr id="countrycode">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Country Code',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="number" name="countrycode" value="{$countrycode}" required>
                        </td>
                    </tr>

                    <tr>
                        <td class="fieldLabel control-label"  style="width:25%">
                            {vtranslate('PBXManager Widgets on Dashboard',$QUALIFIED_MODULE)}
                        </td>
                        <td class="row-fluid medium">
                            <input name="PBXManagerWidgets"
                                   data-type="PBXManagerWidgets"
                                   style="opacity: 0;" {if $PBXManagerWidgets neq 1} value='0' {else} value='1' checked{/if}
                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                   data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                   data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                   data-on-color="primary" data-toggle="toggle"/>
                        </td>
                    </tr>

                    <tr>
                        <td class="fieldLabel control-label"  style="width:25%">
                            {vtranslate('Call Simulator Widget',$QUALIFIED_MODULE)}
                        </td>
                        <td class="row-fluid medium">
                            <input name="CallSimulator"
                                   data-type="CallSimulator"
                                   style="opacity: 0;" {if $CallSimulator neq 1} value='0' {else} value='1' checked{/if}
                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                   data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                   data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                   data-on-color="primary" data-toggle="toggle"/>
                        </td>
                    </tr>

                    <tr>
                        <td class="fieldLabel control-label"  style="width:25%">
                            {vtranslate('Use WebSocket',$QUALIFIED_MODULE)}
                            <br />
                            <a id="download_socket" href="#" onclick="javascript:AsteriskCTI_Modules_Js.downloadSocketServer('1', true);" style="font-size: 80%"><li class="fa fa-download" aria-hidden="true"></li> {vtranslate('Download SocketServer Software',$QUALIFIED_MODULE)}</a>

                        </td>
                        <td class="row-fluid medium">
                            <input name="socket_active" id="socket_active"
                                   data-type="socket_active"
                                   style="opacity: 0;" {if !$SOCKET_ACTIVE} value='0' {else} value='1' checked{/if}
                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                   data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                   data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                   data-on-color="primary" data-toggle="toggle"/>
                        </td>
                    </tr>

                    <tr id="wshost">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('PBXManager WebSocket Host',$QUALIFIED_MODULE)}
                            <span style="font-size: 80%"><br />
                                {vtranslate('This hostname used in PBXManager for call popup inside CRM',$QUALIFIED_MODULE)}
                                </span>
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="text"  name="wshost" value="{$WSHOST}">
                        </td>
                    </tr>

                    <tr id="wsport">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('PBXManager WebSocket Port',$QUALIFIED_MODULE)}
                            <span style="font-size: 80%"><br />
                                {vtranslate('This port number used in PBXManager  for call popup inside CRM',$QUALIFIED_MODULE)}
                                </span>
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue" style="direction: ltr; text-align: left; max-width: 300px" type="number"  name="wsport" value="{$WSPORT}">
                        </td>
                    </tr>

                    <tr>
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('CDR Event API URL',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left;" type="text"
                                   value="{vglobal('site_URL')}modules/ParsVT/ws/API/V2/PBX/AvvalOffice/CDR/" readonly>
                        </td>
                    </tr>

                    <br/><br/><br/>

                    </tbody>
                </table>
            </div>

            <br>
            <div class="modal-overlay-footer clearfix">
                <div class="row clearfix">
                    <div class="textAlignCenter col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-success saveButton">{vtranslate('LBL_SAVE', $MODULE)}</button>
                    </div>
                </div>
            </div>

        </form><>

    {else}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="contents">
                <div class="alert alert-danger"
                     style="text-align: center; margin: 20px 0;">{vtranslate('PBXManager is not active!',$MODULE)}</div>
            </div>
        </div>
    {/if}
</div>