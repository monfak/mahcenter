<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:13:58
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/Development.tpl" */ ?>
<?php /*%%SmartyHeaderCode:787056844678b93feb5d3c7-65149271%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38e3935784c60ec3248e3409ea33b0e21b03b638' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/Development.tpl',
      1 => 1736401297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '787056844678b93feb5d3c7-65149271',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'HANDLERS' => 0,
    'VTExpressionEvaluater' => 0,
    'FULLMODULE' => 0,
    'ADVCF' => 0,
    'FEATUREMESSAGE' => 0,
    'ADVCF2' => 0,
    'TOOLTIPS' => 0,
    'RESTAPI' => 0,
    'SQLREPORT' => 0,
    'SQLREPORT2' => 0,
    'CustomLinks' => 0,
    'CustomLinks2' => 0,
    'DDU' => 0,
    'DDU2' => 0,
    'MODULE_MODEL' => 0,
    'FileManager' => 0,
    'DBManager' => 0,
    'MODULELINKCREATER' => 0,
    'WEBHOOK' => 0,
    'DEBUGMODE' => 0,
    'DEBUGMODE2' => 0,
    'MODULE' => 0,
    'TOOL' => 0,
    'ALERT' => 0,
    'DATA' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b93fec4e9f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b93fec4e9f')) {function content_678b93fec4e9f($_smarty_tpl) {?>﻿
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SettingsHeader.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
    .modal-content {
        direction: rtl !important;
    }

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
    ul.moreinfo  {
        list-style-image: url('<?php echo vglobal('site_URL');?>
layouts/v7/skins/images/Circle.png');
    }
    ul.moreinfo li  {
        padding: 3px 0;
    }
</style>
<div class="settingsIndexPage col-lg-12 col-md-12 col-sm-12" id="MiscGereral">
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
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Custom Handlers Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('CustomHandlers');">
                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['HANDLERS']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="HANDLERS"/>
                                            <?php echo vtranslate('Register Custom Handlers',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Expressions Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('Expressions');">
                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['VTExpressionEvaluater']->value==0){?> value='0' <?php }else{ ?> value='1' checked<?php }?> <?php echo $_smarty_tpl->tpl_vars['FULLMODULE']->value;?>

                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="VTExpressionEvaluater"/>
                                            <?php echo vtranslate('Extra Vtiger Expressions',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <?php if ($_smarty_tpl->tpl_vars['ADVCF']->value){?>
                                            <li>
                                                <div class="cursorPointer"
                                                     style="display: inline-block; vertical-align: middle;">
                                                    <a href="index.php?parent=Settings&module=LayoutEditor" target="_blank">
                                                        <img class="alignMiddle" data-toggle="tooltip"
                                                         title="<?php if ($_smarty_tpl->tpl_vars['FULLMODULE']->value){?><?php echo $_smarty_tpl->tpl_vars['FEATUREMESSAGE']->value;?>
<?php }else{ ?><?php echo vtranslate('Selecting field and table names in advanced custom fields',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?>"
                                                         src="layouts/vlayout/skins/images/circle_question_mark.png">
                                                    </a>
                                                </div>
                                                <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['ADVCF2']->value){?> value='1' checked <?php }else{ ?> value='0'<?php }?> <?php echo $_smarty_tpl->tpl_vars['FULLMODULE']->value;?>

                                                       class='cursorPointer bootstrap-switch' type="checkbox"
                                                       data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-on-color="primary" data-toggle="toggle" data-type="ADVCF"/>
                                                <?php echo vtranslate("Selecting field and table names in advanced custom fields",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                            </li>
                                        <?php }?>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <a href="index.php?parent=Settings&module=LayoutEditor" target="_blank"><img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php if ($_smarty_tpl->tpl_vars['FULLMODULE']->value){?><?php echo $_smarty_tpl->tpl_vars['FEATUREMESSAGE']->value;?>
<?php }else{ ?><?php echo vtranslate('Field tooltip manager in module layouts & fields',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?>"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"></a>
                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['TOOLTIPS']->value){?> value='1' checked <?php }else{ ?> value='0'<?php }?> <?php echo $_smarty_tpl->tpl_vars['FULLMODULE']->value;?>

                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="TOOLTIPS"/>
                                            <?php echo vtranslate("Field tooltip manager in module layouts & fields",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php if ($_smarty_tpl->tpl_vars['FULLMODULE']->value){?><?php echo $_smarty_tpl->tpl_vars['FEATUREMESSAGE']->value;?>
<?php }else{ ?><?php echo vtranslate('ParsVT Restful API',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?>"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showHelp('<?php echo vtranslate('ParsVT Restful API',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','<?php if ($_smarty_tpl->tpl_vars['RESTAPI']->value){?>index.php?module=ParsVT&view=RestAPI&parent=Settings<?php }else{ ?>https://parsvt.com/rest-api-v2-guide/<?php }?>');">
                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['RESTAPI']->value==0){?> value='0' <?php }else{ ?> value='1' checked<?php }?> <?php echo $_smarty_tpl->tpl_vars['FULLMODULE']->value;?>

                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="RESTAPI"/>
                                            <?php echo vtranslate('ParsVT Restful API',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <?php if ($_smarty_tpl->tpl_vars['SQLREPORT']->value){?>
                                            <li>
                                                <div class="cursorPointer"
                                                     style="display: inline-block; vertical-align: middle;">
                                                    <img class="alignMiddle" data-toggle="tooltip"
                                                         title="<?php echo vtranslate('SQL Reports Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                         src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                         onclick="ParsVTMisc.showMarkDown('SQLReports');">
                                                </div>
                                                <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['SQLREPORT2']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                       class='cursorPointer bootstrap-switch' type="checkbox"
                                                       data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-on-color="primary" data-toggle="toggle" data-type="SQLREPORT"/>
                                                <?php echo vtranslate('SQL Reports Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                            </li>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['CustomLinks']->value){?>
                                            <li>
                                                <div class="cursorPointer"
                                                     style="display: inline-block; vertical-align: middle;">
                                                    <img class="alignMiddle" data-toggle="tooltip"
                                                         title="<?php echo vtranslate('ParsVT Custom Links Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                         src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                         onclick="ParsVTMisc.showMarkDown('CustomLinks');">
                                                </div>
                                                <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['CustomLinks2']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                       class='cursorPointer bootstrap-switch' type="checkbox"
                                                       data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-on-color="primary" data-toggle="toggle" data-type="CustomLinks"/>
                                                <?php echo vtranslate('ParsVT Custom Links Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                            </li>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['DDU']->value){?>
                                            <li>
                                                <div class="cursorPointer"
                                                     style="display: inline-block; vertical-align: middle;">
                                                    <img class="alignMiddle" data-toggle="tooltip"
                                                         title="<?php echo vtranslate('Direct Database Update Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                         src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                         onclick="ParsVTMisc.showMarkDown('DDU');">
                                                </div>
                                                <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['DDU2']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                       class='cursorPointer bootstrap-switch' type="checkbox"
                                                       data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                       data-on-color="primary" data-toggle="toggle" data-type="DDU"/>
                                                <?php echo vtranslate('Direct Database Update Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                            </li>
                                        <?php }?>
                                    </ul>
                                    <dl class="pvtdash">
                                        <?php if (!$_smarty_tpl->tpl_vars['SQLREPORT']->value){?>
                                        <dt>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('SQL Reports Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('SQLReports');">
                                            </div>
                                            <button class="btn btn-info" type="button" onclick="ParsVTMisc.showSQLReports();"><?php echo vtranslate('Install SQL Reports Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('SQL Reports allows a user to create completely custom reports using native SQL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <?php }?>
                                        <?php if (!$_smarty_tpl->tpl_vars['CustomLinks']->value){?>
                                        <dt>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('ParsVT Custom Links Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('CustomLinks');">
                                            </div>
                                            <button class="btn btn-info" type="button" onclick="ParsVTMisc.showCustomLinks();"><?php echo vtranslate('Install ParsVT Custom Links Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('ParsVT Custom Links allows you to add new custom Vtiger links without direct database modification',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <?php }?>
                                        <?php if (!$_smarty_tpl->tpl_vars['DDU']->value){?>
                                        <dt>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('ParsVT Custom Links Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('DDU');">
                                            </div>
                                            <button class="btn btn-info" type="button" onclick="ParsVTMisc.showDDU();"><?php echo vtranslate('Install Direct Database Update Module',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('ParsVT Direct Database Update allows you to update your desired queries directly or through the workflow without the need to write code on the Vtiger core side or extensions.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['RESTAPI']->value!=0){?>
                                        <dt>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Custom APIs Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('CustomAPIs');">
                                            </div>
                                            <button class="btn btn-info"
                                                    type="button" <?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCAPIsUrl();?>
><?php echo vtranslate('Register Custom WebService APIs',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('Register your custom APIs to use at webservice',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <?php }?>
                                        <dt>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Custom Functions Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('CustomFunctions');">
                                            </div>
                                            <button class="btn btn-info"
                                                    type="button" <?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCFUrl();?>
><?php echo vtranslate('Register Custom Functions',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('Register your custom functions to invoke at workflow',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <dt>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Custom Cron Tasks Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('CronTasks');">
                                            </div>
                                            <button class="btn btn-info"
                                                    type="button" <?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCCUrl();?>
><?php echo vtranslate('Register Custom Cron Tasks',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('This is useful to execute scheduled tasks or perform background operations.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <dt>
                                            <button class="btn btn-info" onclick="ParsVTMisc.showHelp('<?php echo vtranslate('LBL_MAIL_SERVER_SMTP',"Settings:Vtiger");?>
','modules/ParsVT/resources/Mailserver/outgoingserver.php');" type="button" ><?php echo vtranslate('LBL_MAIL_SERVER_SMTP',"Settings:Vtiger");?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('LBL_MAIL_SERVER_DESCRIPTION','Settings:Vtiger');?>

                                        </dd>
                                        <?php if ($_smarty_tpl->tpl_vars['FileManager']->value){?>
                                        <dt>
                                            <button class="btn btn-info" onclick="ParsVTMisc.showTools('<?php echo vtranslate('File Manager',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','<?php echo $_smarty_tpl->tpl_vars['FileManager']->value;?>
');" type="button" ><?php echo vtranslate('File Manager',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('Browser and manage your files efficiently and easily with filemanager',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['DBManager']->value){?>
                                        <dt>
                                            <button class="btn btn-info" onclick="ParsVTMisc.showTools('<?php echo vtranslate('Database Manager',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','<?php echo $_smarty_tpl->tpl_vars['DBManager']->value;?>
');" type="button" ><?php echo vtranslate('Database Manager',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                        </dt>
                                        <dd>
                                            <?php echo vtranslate('DB Manager is a tool for managing content in databases',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </dd>
                                        <?php }?>
                                    </dl>
                                    <ul class="list-unstyled pvtdash" style="line-height:200%">
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Console Tool Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('ConsoleTool');">
                                            </div>
                                            <input style="opacity: 0;" value='1' checked disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"/>
                                            <?php echo vtranslate('Console Tool',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('ModuleLinkCreator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showHelp('<?php echo vtranslate('ModuleLinkCreator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','https://www.aparat.com/video/video/embed/videohash/E8tig/vt/frame');">

                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['MODULELINKCREATER']->value){?>value='1'  checked<?php }else{ ?>value='0'<?php }?> disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"/>
                                            <a href="<?php if ($_smarty_tpl->tpl_vars['MODULELINKCREATER']->value){?>index.php?module=ModuleLinkCreator&view=List<?php }else{ ?>https://vtfarsi.ir/product/%D9%85%D8%A7%DA%98%D9%88%D9%84-%D8%B3%D8%A7%D8%B2-%D9%88%DB%8C%D8%AA%D8%A7%DB%8C%DA%AF%D8%B1/<?php }?>" target="_blank"><?php echo vtranslate('ModuleLinkCreator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('WebHook',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showHelp('<?php echo vtranslate('WebHook',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','<?php if ($_smarty_tpl->tpl_vars['WEBHOOK']->value){?>index.php?module=WebHook&parent=Settings&view=Development<?php }else{ ?>https://vtfarsi.ir/product/vtiger-webhook/<?php }?>');">
                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['WEBHOOK']->value){?>value='1'  checked<?php }else{ ?>value='0'<?php }?> disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"/>
                                            <a href="<?php if ($_smarty_tpl->tpl_vars['WEBHOOK']->value){?>index.php?module=WebHook&parent=Settings&view=Settings<?php }else{ ?>https://vtfarsi.ir/product/vtiger-webhook/<?php }?>" target="_blank"><?php echo vtranslate('WebHook',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Language Editor',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showHelp('<?php echo vtranslate('Language Editor',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','https://www.aparat.com/video/video/embed/videohash/GtCea/vt/frame');">
                                            </div>
                                            <input style="opacity: 0;" value='1' checked disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"/>
                                            <a href="index.php?module=ParsVT&view=LanguageEditor&parent=Settings" target="_blank"><?php echo vtranslate('Language Editor',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Debugging Techniques Manual',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('Debug');">
                                            </div>
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['DEBUGMODE']->value||$_smarty_tpl->tpl_vars['DEBUGMODE2']->value){?>value='1'  checked<?php }else{ ?>value='0'<?php }?> <?php if ($_smarty_tpl->tpl_vars['DEBUGMODE2']->value){?>disabled readonly<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"  data-toggle="toggle" data-type="DEBUG"/>
                                            <?php echo vtranslate('Debugging techniques and tools',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Other Development Guidance',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('Other');">
                                            </div>
                                            <input style="opacity: 0;" value='1' checked disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"/>
                                            <?php echo vtranslate('Other Development Guidance',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <li>
                                            <div class="cursorPointer"
                                                 style="display: inline-block; vertical-align: middle;">
                                                <img class="alignMiddle" data-toggle="tooltip"
                                                     title="<?php echo vtranslate('Connection Instructions To Other Databases',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                     src="layouts/vlayout/skins/images/circle_question_mark.png"
                                                     onclick="ParsVTMisc.showMarkDown('Databases');">
                                            </div>
                                            <input style="opacity: 0;" value='1' checked disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary"/>
                                            <?php echo vtranslate('Connection Instructions To Other Databases',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                    </ul>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="vtToolBox">
                                    <legend>
                                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo vtranslate("More Information",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                    </legend>
                                    <ul style="padding: 0 20px;" class="moreinfo">
                                        <li>&nbsp;&nbsp;<a target="_blank" href="index.php?module=ParsVT&view=MoreInfo&parent=Settings"><?php echo vtranslate('VTFarsi Marketplace',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="https://marketplace.vtiger.com/"><?php echo vtranslate('LBL_EXTENSION_STORE',"Settings:ModuleManager");?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="http://forum.vtfarsi.ir/"><?php echo vtranslate('Ask the Community',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="http://vtfarsi.ir/crm-wiki/"><?php echo vtranslate('Read our Docs',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="http://vtfarsi.ir/vtiger-crm-book/"><?php echo vtranslate('Read our Book',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="https://community.vtiger.com/help/vtigercrm/developers/index.html"><?php echo vtranslate('Vtiger Developer Guide',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="https://help.vtiger.com/"><?php echo vtranslate('Vtiger Wiki',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="https://wiki.vtiger.com/vtiger6/"><?php echo vtranslate('Vtiger 6 Wiki',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="https://discussions.vtiger.com/"><?php echo vtranslate('Vtiger forum',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="http://my.vtfarsi.ir/submitticket.php"><?php echo vtranslate('Open Ticket',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a href="tel:03191007878"><?php echo vtranslate('Phone Support',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="http://vtfarsi.ir/"><?php echo vtranslate('Live Support',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li>&nbsp;&nbsp;<a target="_blank" href="index.php?parent=Settings&amp;module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&amp;view=Upgrade"><?php echo vtranslate('Check for Update',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                    </ul>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['DEBUGMODE']->value||$_smarty_tpl->tpl_vars['DEBUGMODE2']->value){?>
                    <div class="row form-group">
                        <div  class="col-md-12" id="ParsVTToolsSettingsMainPanel">
                            <fieldset class="vtToolBox">
                                <legend>
                                    <i class="<?php echo $_smarty_tpl->tpl_vars['TOOL']->value->getIcon();?>
"></i>&nbsp;&nbsp; <?php echo vtranslate($_smarty_tpl->tpl_vars['TOOL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                </legend>
                                <?php if (isset($_smarty_tpl->tpl_vars['ALERT']->value)){?>
                                    <div class="tool-alert"><?php echo $_smarty_tpl->tpl_vars['ALERT']->value;?>
</div>
                                <?php }?>
                                <div class="tool-panel">
                                    <?php echo $_smarty_tpl->tpl_vars['TOOL']->value->showPanel($_smarty_tpl->tpl_vars['DATA']->value);?>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>