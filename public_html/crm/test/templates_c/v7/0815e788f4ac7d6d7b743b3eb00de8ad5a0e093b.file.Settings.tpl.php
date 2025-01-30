<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:14:18
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVTExtras/Settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:523066454678b9412d34429-27005477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0815e788f4ac7d6d7b743b3eb00de8ad5a0e093b' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVTExtras/Settings.tpl',
      1 => 1736401302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '523066454678b9412d34429-27005477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MENTION' => 0,
    'AUTOCREATECOMMENT' => 0,
    'LTV' => 0,
    'EXPORTTOEXCEL' => 0,
    'KEYBOARDJUNKIE' => 0,
    'TABULATION' => 0,
    'SHOWRELATIONS' => 0,
    'ARIANATTS' => 0,
    'UNINSTALLER' => 0,
    'SENDCAMPAIGNSMS' => 0,
    'WEBFORM' => 0,
    'FUNNELEXTENDED' => 0,
    'Gold' => 0,
    'Currency' => 0,
    'CRYPTOCURRENCIES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9412dbe98',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9412dbe98')) {function content_678b9412dbe98($_smarty_tpl) {?>﻿
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
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Mention Users',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['MENTION']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="MENTIONS"/>
                                            <?php echo vtranslate('Mention Users',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Auto Create Comment from Activities',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['AUTOCREATECOMMENT']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="AUTOCREATECOMMENT"/>
                                            <?php echo vtranslate('Vtiger Comments from Activities',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('LifeTime value Calculator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['LTV']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="LTV"/>
                                            <?php echo vtranslate('LifeTime value Calculator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Export To Excel',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['EXPORTTOEXCEL']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="EXPORTXLS"/>
                                            <?php echo vtranslate('Export To Excel',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Keyboard Junkie',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['KEYBOARDJUNKIE']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="KEYBOARDJUNKIE"/>
                                            <?php echo vtranslate('Keyboard Junkie',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Tabulation allows administrator to personalize record layout of any module by switching blocks into tabs',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;"   <?php if ($_smarty_tpl->tpl_vars['TABULATION']->value){?>value='1'  checked<?php }else{ ?>value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="TABULATION" />
                                            <a href="index.php?module=LayoutEditor&parent=Settings&view=Index" target="_blank"><?php echo vtranslate('Tabulation',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Modules Relationship',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;"   <?php if ($_smarty_tpl->tpl_vars['SHOWRELATIONS']->value){?>value='1'  checked<?php }else{ ?>value='0'<?php }?> disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"/>
                                            <a href="index.php?module=LayoutEditor&parent=Settings&view=Index" target="_blank"><?php echo vtranslate('Modules Relationship',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            title="<?php echo vtranslate('Related Field Generator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" value='1'  checked disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"/>
                                            <a href="index.php?parent=Settings&module=<?php echo $_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value;?>
&view=RelatedFields"><?php echo vtranslate('Related Field Generator',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            title="<?php echo vtranslate('Ariana TTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['ARIANATTS']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"  data-type="ARIANATTS"/>
                                                   <?php echo vtranslate('Ariana TTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                        </li>
                                        <li data-toggle="tooltip"
                                            title="<?php echo vtranslate('Module Uninstaller',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['UNINSTALLER']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"  data-type="UNINSTALLER"/>
                                            <a href="index.php?module=ModuleManager&parent=Settings&view=List" target="_blank"><?php echo vtranslate('Module Uninstaller',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            title="<?php echo vtranslate('Enable SMS Campaign',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['SENDCAMPAIGNSMS']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"  data-type="SENDCAMPAIGNSMS"/>
                                            <a href="index.php?parent=Settings&module=Workflows&view=List&sourceModule=Campaigns" target="_blank"><?php echo vtranslate('Enable SMS Campaign',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            title="<?php echo vtranslate('Allow Setup Webforms for all entity modules',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['WEBFORM']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"  data-type="WEBFORMS"/>
                                            <a href="index.php?module=ModuleManager&parent=Settings&view=List" target="_blank"><?php echo vtranslate('Allow Setup Webforms for all entity modules',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Funnel Extended',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['FUNNELEXTENDED']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="FUNNELEXTENDED"/>
                                            <?php echo vtranslate('Funnel Extended Widget',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Crypto Currencies',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Gold Price',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['Gold']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="Gold"/>
                                            <?php echo vtranslate('Gold Price Widget',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip" title="<?php echo vtranslate('Currencies Price',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['Currency']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle" data-type="Currency"/>
                                            <?php echo vtranslate('Currencies Price Widget',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['CRYPTOCURRENCIES']->value){?> value='1'  checked<?php }else{ ?> value='0'<?php }?>
                                               class='cursorPointer bootstrap-switch' type="checkbox"
                                               data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                               data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                               data-on-color="primary" data-toggle="toggle" data-type="CRYPTOCURRENCIES"/>
                                        <?php echo vtranslate('Crypto Currencies Widget',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li>
                                        <li data-toggle="tooltip"
                                            title="<?php echo vtranslate('Vtiger Updater',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
                                            <input style="opacity: 0;" value='1'  checked disabled readonly
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"/>
                                            <a href="index.php?parent=Settings&module=<?php echo $_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value;?>
&view=Upgrade"><?php echo vtranslate('Vtiger Updater',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                        </li>
                                    </ul>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="vtToolBox">
                                    <legend>
                                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?php echo vtranslate("Features",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                    </legend>
                                    <p style="margin:0;">
                                        <?php echo vtranslate('Mention Users',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/>
                                        <?php echo vtranslate('Enable Export To Excel in Filters',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/>
                                        <?php echo vtranslate('Funnel Extended On Dashboard',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/>
                                        <?php echo vtranslate('Keyboard shortcuts',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                    </p>
                                    <p   style="margin:0; padding:0 20px; font-style: italic">
                                        <strong><?php echo vtranslate('In List view:',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong> <br />
                                        <?php echo vtranslate('Page Up/Page Down to page through the listing',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <?php echo vtranslate('Ctrl+A to add a new item to the list',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <strong><?php echo vtranslate('In Detail view:',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong> <br />
                                        <?php echo vtranslate('Ctrl+E to edit',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <?php echo vtranslate('Ctrl+D to duplicate',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <?php echo vtranslate('Page up/Page down to navigate through the related items',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <?php echo vtranslate('Right/Left to move to the next or previous entry',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <strong><?php echo vtranslate('In Edit view:',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong> <br />
                                        <?php echo vtranslate('Ctrl+S to save',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <strong><?php echo vtranslate('Everywhere:',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong> <br />
                                        <?php echo vtranslate('Ctrl+K to go to the list view',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <br />
                                        <?php echo vtranslate('Escape to go back to the previous screen',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                    </p>
                                    <p   style="margin:0;">
                                    <?php echo vtranslate('Relationships link two different modules and relate records between them.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/>
                                        <?php echo vtranslate('Create Related Field',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/>
                                        <?php echo vtranslate('Advanced Module Uninstaller',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br />
                                        <?php echo vtranslate('Update Vtiger And Fix Bugs',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br/>
                                    </p>
                                </fieldset>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>