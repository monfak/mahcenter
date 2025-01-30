<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:15:49
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVTExtras/Mention.tpl" */ ?>
<?php /*%%SmartyHeaderCode:428227216678b946d58ecf9-24599482%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36105d0b0b86718e3e9b5d5df97b1c63d67134e2' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVTExtras/Mention.tpl',
      1 => 1736401302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '428227216678b946d58ecf9-24599482',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'send_email' => 0,
    'ISEMAILENABLED' => 0,
    'send_sms' => 0,
    'ISSMSENABLED' => 0,
    'ISNOTIFENABLED' => 0,
    'send_notification' => 0,
    'send_telegram' => 0,
    'send_output' => 0,
    'send_outputserver' => 0,
    'send_outputport' => 0,
    'send_outputapikey' => 0,
    'send_outputuser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b946d65106',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b946d65106')) {function content_678b946d65106($_smarty_tpl) {?>﻿
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SettingsHeader.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="settingsIndexPage col-lg-12 col-md-12 col-sm-12" id="ParsVTExtraSettings">
    <div>
        <div>
            <div class="container-fluid">
                <div class="contents">
                    <br>
                </div>
                <div class="container-fluid">
                    <div class="related-tabs">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <fieldset class="vtToolBox">
                                    <legend><?php echo vtranslate('Settings',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</legend>
                                    <ul class="list-unstyled pvtdash" style="line-height:200%">
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Send Email',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['send_email']->value&&$_smarty_tpl->tpl_vars['ISEMAILENABLED']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="SENDEMAIL"/>
                                            <?php echo vtranslate('Send Email',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Send SMS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['send_sms']->value&&$_smarty_tpl->tpl_vars['ISSMSENABLED']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="SENDSMS"/>
                                            <?php echo vtranslate('Send SMS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <?php if ($_smarty_tpl->tpl_vars['ISNOTIFENABLED']->value){?>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Create Notification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['send_notification']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="SENDNOTIFICATION"/>
                                            <?php echo vtranslate('Create Notification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <?php }?>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Send Telegram Notification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['send_telegram']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="SENDTELEGRAM"/>
                                            <?php echo vtranslate('Send Telegram Notification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Send Output Messenger Notification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['send_output']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="SENDOUTPUT"/>
                                            <?php echo vtranslate('Send Output Messenger Notification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                    </ul>
                                </fieldset>
                                <?php if ($_smarty_tpl->tpl_vars['send_output']->value){?>
                                    <br />
                                <fieldset class="vtToolBox">
                                    <legend><?php echo vtranslate('Output Messenger Settings',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</legend>
                                    <ul class="list-unstyled pvtdash" style="line-height:200%;">
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Output Server IP/Address',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="display: flex">
                                            <span style="min-width: 150px;"><?php echo vtranslate('Output Server IP/Address',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</span>
                                            <span class="edit pull-left">
                                            <div class="input-group editElement"  style="display: flex">
                                                <input class="inputElement form-control" type="text" name="send_outputserver" value="<?php echo $_smarty_tpl->tpl_vars['send_outputserver']->value;?>
" placeholder="http://your_output_server">
                                                <div class="input-save-wrap saveoutput" data-target="send_outputserver"><span class="pointerCursorOnHover input-group-addon input-group-addon-save" data-target="send_outputserver"><i class="fa fa-check"  data-target="send_outputserver"></i></span></div>
                                            </div>
                                            </span>
                                        </li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Output Server Port',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="display: flex">
                                            <span style="min-width: 150px;"><?php echo vtranslate('Output Server Port',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</span>
                                            <span class="edit pull-left">
                                            <div class="input-group editElement"  style="display: flex">
                                                <input class="inputElement form-control" type="number" name="send_outputport" value="<?php if ($_smarty_tpl->tpl_vars['send_outputport']->value){?><?php echo $_smarty_tpl->tpl_vars['send_outputport']->value;?>
<?php }else{ ?>14125<?php }?>">
                                                <div class="input-save-wrap saveoutput" data-target="send_outputport"><span class="pointerCursorOnHover input-group-addon input-group-addon-save" data-target="send_outputport"><i class="fa fa-check"  data-target="send_outputport"></i></span></div>
                                            </div>
                                            </span>
                                        </li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Output Server API Key',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="display: flex">
                                            <span style="min-width: 150px;"><?php echo vtranslate('Output Server API Key',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</span>
                                            <span class="edit pull-left">
                                            <div class="input-group editElement"  style="display: flex">
                                                <input class="inputElement form-control" type="text" name="send_outputapikey"  value="<?php echo $_smarty_tpl->tpl_vars['send_outputapikey']->value;?>
">
                                                <div class="input-save-wrap saveoutput" data-target="send_outputapikey"><span class="pointerCursorOnHover input-group-addon input-group-addon-save"  data-target="send_outputapikey"><i class="fa fa-check"  data-target="send_outputapikey"></i></span></div>
                                            </div>
                                            </span>
                                        </li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Sender User Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="display: flex">
                                            <span style="min-width: 150px;"><?php echo vtranslate('Sender User Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</span>
                                            <span class="edit pull-left">
                                            <div class="input-group editElement"  style="display: flex">
                                                <input class="inputElement form-control" type="text" name="send_outputuser"  value="<?php echo $_smarty_tpl->tpl_vars['send_outputuser']->value;?>
">
                                                <div class="input-save-wrap saveoutput" data-target="send_outputuser"><span class="pointerCursorOnHover input-group-addon input-group-addon-save"  data-target="send_outputuser"><i class="fa fa-check"  data-target="send_outputuser"></i></span></div>
                                            </div>
                                            </span>
                                        </li>
                                        <li style="display: flex">
                                            <button class="btn btn-info checkconnection" type="button"><?php echo vtranslate('Check Server Connection',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </li>
                                    </ul>
                                </fieldset>
                                <?php }?>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="vtToolBox">
                                    <legend>
                                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo vtranslate("Vtiger Mention Features",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                    </legend>
                                    <p>
                                        <?php echo vtranslate('LBL_MENTION_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/></p>
                                </fieldset>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>