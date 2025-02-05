<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:0px;">
    <h4>{vtranslate('Simotel Settings', $QUALIFIED_MODULE)}</h4>
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
            <input type="hidden" name="mode" value="Simotel"/>
            <input type="hidden" name="id" value="{$RECORD_ID}">
            <div class="blockData">
                <table class="table table-bordered blockContainer showInlineTable equalSplit">
                    <thead>
                    <tr class="active">
                        <th class="" colspan="4"><a href="http://vtfarsi.ir/vtigercrm-simotel-pbx-integration-manual/" target="_blank"><img src="layouts/{vglobal('default_layout')}/modules/ParsVT/images/helpinfo.png"> &nbsp;{vtranslate('Simotel Settings', $MODULE)}</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach item=FIELD_VALUE key=FIELD_NAME from=$FIELDS}
                        <tr {if $FIELD_NAME eq 'vtigersecretkey' or $FIELD_NAME eq 'webappurl'}class="hide" {/if} id="tr_{$FIELD_NAME}">
                            <td class="fieldLabel control-label" style="width:25%">
                                <label>{vtranslate($FIELD_NAME, $MODULE)}</label></td>
                            <td style="word-wrap:break-word;">
                                {if $FIELD_NAME eq 'simotel_api' }
                                    <select style="max-width: 300px" name="{$FIELD_NAME}"  id="{$FIELD_NAME}" class="select2 inputElement fieldValue" data-placeholder={vtranslate('LBL_SELECT_OPTIONS',$QUALIFIED_MODULE)}>
                                        {$SIMOTEL_API}
                                    </select>

                                {else}
                                <input class="inputElement fieldValue"  style="direction: ltr; text-align: left; max-width: 300px" type="{$FIELD_VALUE[0]}" name="{$FIELD_NAME}" data-rule-required="true"  value="{if $FIELD_NAME eq 'vtigersecretkey'}{if !empty($FIELD_VALUE[1])}{$FIELD_VALUE[1]}{else}{PBXManager_Server_Model::generateVtigerSecretKey()}{/if}{elseif $FIELD_NAME eq 'webappurl'}{vglobal('site_URL')}modules/ParsVT/ws/API/V2/PBX/Simotel/{else}{$FIELD_VALUE[1]}{/if}"/>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}
                    <tr>
                        <td class="fieldLabel control-label"
                            style="width:25%">
                            {vtranslate('MODULES LIST',$QUALIFIED_MODULE)} <br/>
                            <span style="font-size: 80%">
                                {vtranslate('Modules List for Search Phone Fields in PBXManager',$QUALIFIED_MODULE)}
                                </span>
                        </td>
                        <td class="row-fluid medium">
                            {vtranslate('LBL_CHOOSE_COLUMNS',$QUALIFIED_MODULE)} {vtranslate('(Max 5) :', $QUALIFIED_MODULE)}
                            <br>
                            <select name="MODULESLIST[]"
                                    data-placeholder="{vtranslate('LBL_ADD_MORE_COLUMNS',$MODULE)}" multiple
                                    class="inputElement columnsSelect" id="viewColumnsSelect">
                                <optgroup label='{vtranslate('MODULES LIST', $SOURCE_MODULE)}'>
                                    {foreach item=NAME from=$LISTMODULES}
                                        <option value="{$NAME}"   data-field-name="{$FIELD_NAME}" {if in_array($NAME, $MDLS)} selected {/if}>{vtranslate($NAME, $NAME)}
                                        </option>
                                    {/foreach}
                                </optgroup>
                            </select>
                        </td>
                    </tr>
                    <tr id="popuptime">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Popup Duration (second)',$QUALIFIED_MODULE)}
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
                        <td class="fieldLabel control-label" style="width:25%">{vtranslate('Prefix Dial Number',$QUALIFIED_MODULE)}</td>
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
                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left; max-width: 300px" type="number"
                                   name="citycode" value="{$citycode}" required>
                        </td>
                    </tr>
                    <tr id="countrycode">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Country Code',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left; max-width: 300px" type="number"
                                   name="countrycode" value="{$countrycode}" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldLabel control-label"  style="width:25%">
                            {vtranslate('ParsVoipCTI Settings',$QUALIFIED_MODULE)}<br>
                            <a href="https://license.aweb.co/download/PBX/ParsVoIPCTI.exe" target="_blank" style="font-size: 80%">{vtranslate('Download ParsVoIPCTI Software',$QUALIFIED_MODULE)}</a>

                        </td>
                        <td class="row-fluid medium">
                            <input name="parsvoip" id="parsvoip" data-type="parsvoip" style="opacity: 0;" {if $parsvoip neq 1} value='0' {else} value='1' checked{/if}
                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                   data-on-text="{vtranslate('LBL_SHOW', 'Users')}"
                                   data-off-text="{vtranslate('LBL_HIDDEN', 'Users')}"
                                   data-on-color="primary" data-toggle="toggle"/>
                        </td>
                    </tr>
                    <tr class="amisettings">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Asterisk IP',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input type="hidden" name="ami_record" value="{$ami_id}">
                            <input class="inputElement fieldValue required" id="ami_server" style="direction: ltr; text-align: left; max-width: 300px" type="text" data-fieldtype="text" data-fieldname="ami_server" data-name="ami_server" name="ami_server" value="{$ami_server}" data-rule-required="true" data-validation-engine="validate[required]" aria-required="true">
                        </td>
                    </tr>
                    <tr class="amisettings">
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('AMI Port',$QUALIFIED_MODULE)}
                            <br>
                            <span style="font-size: 80%">{vtranslate('Asterisk AMI Port',$QUALIFIED_MODULE)}</span>
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue required" id="ami_port" style="direction: ltr; text-align: left; max-width: 300px" type="number" data-fieldtype="number" data-fieldname="ami_port" data-name="ami_port" name="ami_port" value="{$ami_port}"  data-rule-required="true" data-validation-engine="validate[required]" aria-required="true">
                        </td>
                    </tr>
                    <tr class="amisettings">
                        <td class="fieldLabel control-label" style="width:25%">
                            {vtranslate('AMI Username',$QUALIFIED_MODULE)}
                            <br>
                            <span style="font-size: 80%">{vtranslate('Enter Asterisk AMI Username',$QUALIFIED_MODULE)}</span>
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue required" id="ami_username" style="max-width: 300px; direction: ltr; text-align: left;" type="text" data-fieldtype="text" data-fieldname="ami_username" data-name="ami_username" name="ami_username" value="{$ami_username}" data-rule-required="true" data-validation-engine="validate[required]" aria-required="true">
                        </td>
                    </tr>
                    <tr class="amisettings">
                        <td class="fieldLabel control-label" style="width:25%">
                            {vtranslate('AMI Secret',$QUALIFIED_MODULE)}
                            <br>
                            <span style="font-size: 80%">{vtranslate('Enter Asterisk AMI Secret',$QUALIFIED_MODULE)}</span>
                        </td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue required" id="ami_password" style="direction: ltr; text-align: left; max-width: 300px" type="password" data-fieldtype="password" data-fieldname="ami_password" data-name="ami_password" name="ami_password" value="{$ami_password}" data-rule-required="true" data-validation-engine="validate[required]" aria-required="true">
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
                            style="width:25%">{vtranslate('Simotel Event API URL',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left;" type="text"
                                   value="{vglobal('site_URL')}modules/ParsVT/ws/API/V2/PBX/Simotel/" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Simotel Event API Username',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left;" type="text"
                                   value="{$CURRENT_USER_MODEL->get('user_name')}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldLabel control-label"
                            style="width:25%">{vtranslate('Simotel Event API password',$QUALIFIED_MODULE)}</td>
                        <td class="row-fluid medium">
                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left;" type="text"
                                   value="{$CURRENT_USER_MODEL->get('accesskey')}" readonly>
                        </td>
                    </tr>
                    <tr data-toggle="tooltip" title="از این متد می توانید جهت بررسی این که شماره مورد جستجو قبلا با چه شخصی صحبت کرده است یا به چه شخصی ارجاع شده است استفاده نمایید. از این قابلیت میتوانید در یکپارچه سازی با سیستم تلفنی ویپ استفاده نماییدپارامتر searchby پس از عبارت SearchPBX میتواند چهار مقدار owner ، lastcall ، ownerlastcall و lastcallowner را دریافت کند. پارامتر owner برای جستجو شماره داخلی متصل به crm کاربری است که شماره تلفن مورد جستجو به آن ارجاع شده است و در حقیقت شماره داخلی کاربری که مالک رکورد است را باز می گرداند. پارامتر lastcall شماره داخلی کاربری که آخرین بار با شماره مورد جستجو تماس تلفنی داشته است را از طریق ماژول مرکز تماس ویپ خوانده و باز می گرداند. پارامتر fixnumber پس از searchby آورده می شود مقدار 0 یا 1 قبول می کند. از این پارامتر برای اصلاح شماره تلفن ها استفاده می شود و در صورتی که مقدار 1 بگیرد شماره تلفن های ورودی را براساس پارامتر citycode برای کد شهر مه در مثال با 21 آورده شده و پارامتر countrycode برای کد کشور که در مثال بالا با 98 آورده شده اصلاح خواهد کرد. اهمیت این موضوع آنجا پررنگ می شود که وقتی در آدرس را در مرکز تلفن استریسک تنظیم می کنید و شخصی تماس میگیرید اگر شماره او به صورت 09138086200 و یا 91007879 ثبت شده باشد بسته به مرکز مخابراتی ممکن است به پیش شماره های +98، 98، بدون صفر یا با کدشهر مثلا +983191007879 یا 9138086200 در استریسک وارد شود و عملا جستجوی این شماره در سیستم اطلاعاتی را بازنخواهد گرداند. این متد شماره را به فرمت صحیح در ویتایگر اصلاح خواهد کرد">
                        <td class="fieldLabel control-label"
                            style="width:25%" >
                            {vtranslate('Simotel Exten API URL',$QUALIFIED_MODULE)}  <img  src="layouts/{vglobal('default_layout')}/modules/ParsVT/images/helpinfo.png">
                        </td>
                        <td class="row-fluid medium">

                            <input class="inputElement fieldValue"
                                   style="direction: ltr; text-align: left;" type="text"
                                   value="{vglobal('site_URL')}modules/ParsVT/ws/API/V2/PBX/Simotel/SearchPBX/owner/1/21/98/" readonly>
                        </td>
                    </tr>
                    <tr >
                        <td class="fieldLabel control-label" style="width:25%"><br /><br /></td>
                        <td class="row-fluid medium"><br /><br /></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-overlay-footer clearfix">
                <div class="row clearfix">
                    <div class="textAlignCenter col-lg-12 col-md-12 col-sm-12">
                        <button type="submit"
                                class="btn btn-success saveButton">{vtranslate('LBL_SAVE', $MODULE)}</button>&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </form>
    {else}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="contents">
                <div class="alert alert-danger"
                     style="text-align: center; margin: 20px 0;">{vtranslate('PBXManager is not active!',$MODULE)}</div>
            </div>
        </div>
    {/if}
</div>
<script>
    $(function() {
        displayAPI();
        $('#simotel_api').on('change', function() {
            displayAPI();
        });
        function displayAPI(){
            if ($('#simotel_api').val() == 'v3' || $('#simotel_api').val() == 'v4') {
                $('#tr_x-apikey').show();
            } else {
                $('#tr_x-apikey').hide();
            }
        }
    });
</script>