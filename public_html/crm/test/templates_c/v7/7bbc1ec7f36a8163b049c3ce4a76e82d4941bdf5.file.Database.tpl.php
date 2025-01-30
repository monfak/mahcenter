<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:16:00
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/Database.tpl" */ ?>
<?php /*%%SmartyHeaderCode:409518031678b9478589648-35707788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bbc1ec7f36a8163b049c3ce4a76e82d4941bdf5' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/Database.tpl',
      1 => 1736401297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '409518031678b9478589648-35707788',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'WHITELABEL' => 0,
    'COUNTTABLES' => 0,
    'MODULE' => 0,
    'COUNTNATABLES' => 0,
    'COUNTOPTABLES' => 0,
    'DBUSERPERMISSIONS' => 0,
    'OLDCRM' => 0,
    'CRMVERSION' => 0,
    'DEMO_MODE' => 0,
    'ENGINE' => 0,
    'UPDATEABLETABLES' => 0,
    'counter' => 0,
    'DATABASE_INFO' => 0,
    'last' => 0,
    'UPDATEABLETABLES2' => 0,
    'DBSTATUS' => 0,
    'OPTABLES' => 0,
    'TIME_MESSAGE' => 0,
    'MAX_EXECUTION_TIME' => 0,
    'BACKUP_OPTIONS' => 0,
    'BACKUP_STATUS' => 0,
    'BACKUP_FREQUENCY' => 0,
    'BACKUP_TIME' => 0,
    'foo' => 0,
    'FILELIST' => 0,
    'ID' => 0,
    'S_FILE' => 0,
    'TOOL' => 0,
    'ALERT' => 0,
    'DATA' => 0,
    'list_max_entries_per_page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b947873926',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b947873926')) {function content_678b947873926($_smarty_tpl) {?>﻿
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SettingsHeader.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<br/>
<?php $_smarty_tpl->tpl_vars['list_max_entries_per_page'] = new Smarty_variable(vglobal('list_max_entries_per_page'), null, 0);?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <ul class="nav nav-pills nav-stacked massEditTabs" style="margin-bottom: 0;border-bottom: 0;">
                <li id="DataBaseGereralMenu" class="active"><a href="#DataBaseGereral" data-toggle="tab"><strong><?php echo vtranslate('Database Statistics',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <li id="DataBaseNeedAttentionMenu"><a href="#DataBaseNeedAttention" data-toggle="tab"><strong><?php echo vtranslate('Need Attention Tables',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <li id="DataBaseBackupMenu"><a href="#DataBaseBackup" data-toggle="tab"><strong><?php echo vtranslate('Backup/Restore',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <li id="DataBaseOptimizeMenu"><a href="#DataBaseOptimize" data-toggle="tab"><strong><?php echo vtranslate('Optimize Database',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <?php if (!$_smarty_tpl->tpl_vars['WHITELABEL']->value){?>
                <li id="DataTransformationMenu"><a href="#DataTransformation" data-toggle="tab"><strong><?php echo vtranslate('Data Transformation',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <?php }?>
                <li id="MiscDatabseMenu"><a href="#MiscDatabse" data-toggle="tab"><strong><?php echo vtranslate('Database information',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <li id="ListofTablesMenu"><a href="#ListofTables" data-toggle="tab"><strong><?php echo vtranslate('List of Tables',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <li id="MySQLTunerMenu"><a href="#MySQLTuner" data-toggle="tab"><strong><?php echo vtranslate('MySQL Tuner',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>
                <li id="IndexingToolMenu"><a href="#IndexingTool" data-toggle="tab"><strong><?php echo vtranslate('Field Indexing Tool',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a>
                </li>

            </ul>
        </div>
        <div class="col-lg-9">
            <div class="tab-content layoutContent padding20 themeTableColor overflowVisible">
                <div class="tab-pane settingsIndexPage active" id="DataBaseGereral">
                    <div class="row-fluid">


                        <div class="row">
               <span class="col-lg-4 col-md-4 col-sm-4 settingsSummary">
                  <a class="normalattention" href="#DataBaseBackup" data-toggle="tab">
                     <h2 class="summaryCount"><?php echo $_smarty_tpl->tpl_vars['COUNTTABLES']->value;?>
</h2>
                     <p class="summaryText" style="margin-top:20px;"><?php echo vtranslate('Total Tables',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
                  </a>
               </span>
                            <span class="col-lg-4 col-md-4 col-sm-4 settingsSummary">
                  <a <?php if ($_smarty_tpl->tpl_vars['COUNTNATABLES']->value>0){?>class="needattention" <?php }else{ ?>class="okattention"<?php }?>
                     href="#DataBaseNeedAttention" data-toggle="tab">
                     <h2 class="summaryCount <?php if ($_smarty_tpl->tpl_vars['COUNTNATABLES']->value>0){?>blink_me<?php }?>"><?php echo $_smarty_tpl->tpl_vars['COUNTNATABLES']->value;?>
</h2>
                     <p class="summaryText <?php if ($_smarty_tpl->tpl_vars['COUNTNATABLES']->value>0){?>blink_me<?php }?>"
                        style="margin-top:20px;"><?php echo vtranslate('Need Attention Tables',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
                  </a>
               </span>
                            <span class="col-lg-4 col-md-4 col-sm-4 settingsSummary">
                  <a <?php if ($_smarty_tpl->tpl_vars['COUNTOPTABLES']->value>0){?>class="needoptimize" <?php }else{ ?>class="okattention"<?php }?>
                     href="#DataBaseOptimize" data-toggle="tab">
                     <h2 class="summaryCount <?php if ($_smarty_tpl->tpl_vars['COUNTOPTABLES']->value>0){?>blink_me<?php }?>"><?php echo $_smarty_tpl->tpl_vars['COUNTOPTABLES']->value;?>
</h2>
                     <p class="summaryText <?php if ($_smarty_tpl->tpl_vars['COUNTOPTABLES']->value>0){?>blink_me<?php }?>"
                        style="margin-top:20px;"><?php echo vtranslate('Need Optimize Tables',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
                  </a>
               </span>
                        </div>
                        <hr>
                        <br>


                    </div>
                </div>
                <div class="tab-pane" id="MiscDatabse"></div>
                <?php if (!$_smarty_tpl->tpl_vars['WHITELABEL']->value){?>
                <div class="tab-pane" id="DataTransformation">
                    <div class="row-fluid">

                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                    <img src="data:image/png;base64,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" width="75%">

                                </div>
                                <div class="col-lg-9 col-sm-9">

                                    <?php echo vtranslate('If you are using orginal version of VtigerCRM, You can skip this section.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br />
                                    <?php echo vtranslate('if you are using other solar canendar you must transform old database data !',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>


                                </div>
                            </div>

                        <div class="row"><br /></div>

                        <table class="table table-hover">
                            <tr>
                                <td style="border-right: none"><?php echo vtranslate('Status',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</td>
                                <td style="border-right: none" colspan="3"><?php echo vtranslate($_smarty_tpl->tpl_vars['DBUSERPERMISSIONS']->value['Status'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td>
                            </tr>
                            <tr>
                                <td style="border-right: none"><?php echo vtranslate('Old CRM System',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</td>
                                <td style="border-right: none" colspan="3"><?php echo $_smarty_tpl->tpl_vars['OLDCRM']->value;?>
</td>
                            </tr>
                            <tr>
                                <td style="border-right: none"><?php echo vtranslate('CRM Version',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</td>
                                <td style="border-right: none" colspan="3"><?php echo $_smarty_tpl->tpl_vars['CRMVERSION']->value[0];?>
  <i><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['CRMVERSION']->value[1];?>
"><?php echo vtranslate('Download Core Files',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></i> </td>
                            </tr>
                            <tr>
                                <td style="border-right: none;min-width: 200px;"><?php echo vtranslate('MySQL user privileges',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</td>
                                <td style="border-right: none" colspan="3"><?php if ($_smarty_tpl->tpl_vars['DEMO_MODE']->value){?>******<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DBUSERPERMISSIONS']->value['Privileges'];?>
<?php }?></td>
                            </tr>
                        </table>

                        <div class="row">

                            <?php if ($_smarty_tpl->tpl_vars['DBUSERPERMISSIONS']->value['Success']){?>
                                <button class="btn btn-primary transformdb">
                                    <?php echo vtranslate('Transform Database',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                </button>
                            <?php }?>
                        </div>

                    </div>
                </div>
                <?php }?>
                <div class="tab-pane" id="DataBaseNeedAttention">
                    <div class="row-fluid">
                        <?php if ($_smarty_tpl->tpl_vars['COUNTNATABLES']->value>0){?>
                            <div class="row">
                                <?php echo vtranslate('The following tables must convert for better reliability and scalability, review the following guidelines and tips before converting.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                <br/><br/>
                                <div class="alert alert-warning blink_me">
                                    <strong><?php echo vtranslate('Tip',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/>
                                    <?php echo vtranslate('Before you click on convert botton, make sure you have backed up you database!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['ENGINE']->value=='No'){?>
                                    <div class="alert alert-danger blink_me">
                                        <strong><?php echo vtranslate('Warning',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/>
                                        <a href="https://wiki.vtiger.com/index.php/System_Requirements"
                                           target="_blank"><?php echo vtranslate('Database server does not support innodb storage engine!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                                    </div>
                                <?php }?>

                            </div>
                            <table class="table table-hover table-condensed  confTable">
                                <thead>
                                <tr>
                                    <th style="border-right: none"><?php echo vtranslate('Table Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                                    <th style="border-right: none"><?php echo vtranslate('Table Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable(0, null, 0);?>
                                <tr class="listViewEntries">
                                    <?php $_smarty_tpl->tpl_vars['last'] = new Smarty_variable(end($_smarty_tpl->tpl_vars['UPDATEABLETABLES']->value), null, 0);?>

                                    <?php  $_smarty_tpl->tpl_vars['DATABASE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DATABASE_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['UPDATEABLETABLES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DATABASE_INFO']->key => $_smarty_tpl->tpl_vars['DATABASE_INFO']->value){
$_smarty_tpl->tpl_vars['DATABASE_INFO']->_loop = true;
?>

                                    <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable($_smarty_tpl->tpl_vars['counter']->value+1, null, 0);?>
                                    <td class="listViewEntrie medium"><?php echo $_smarty_tpl->tpl_vars['DATABASE_INFO']->value;?>
</td>
                                    <?php if ($_smarty_tpl->tpl_vars['last']->value==$_smarty_tpl->tpl_vars['DATABASE_INFO']->value&&$_smarty_tpl->tpl_vars['counter']->value=='1'){?>
                                    <td class="listViewEntrie medium"></td>
                                </tr>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['counter']->value=='2'){?>
                                <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable(0, null, 0);?>
                                </tr>
                                <tr class="listViewEntries">
                                    <?php }?>


                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
                            <h4><?php echo vtranslate('Your database schema is up-to-date!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['COUNTNATABLES']->value>0){?>
                            <input type='hidden' name='updatabletables' value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['UPDATEABLETABLES2']->value);?>
'>
                            <button class="btn btn-primary fixError">
                                <?php echo vtranslate('Convert Database',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                            </button>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['DBSTATUS']->value[0]!="3c763d"){?>
                            <button class="btn btn-primary convertdb">
                                <?php echo vtranslate('Change Databse Collation',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                            </button>
                        <?php }?>


                    </div>
                </div>
                <div class="tab-pane" id="DataBaseOptimize">
                    <div class="row-fluid">
                        <div class="row-fluid">
                            <div class="row">
                                <div class="alert alert-warning blink_me">
                                    <strong><?php echo vtranslate('Tip',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/>
                                    <?php echo vtranslate('Before you click on optimize botton, make sure you have backed up you database!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                </div>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['COUNTOPTABLES']->value>0){?>
                                <table class="table table-hover table-condensed  confTable">
                                    <thead>
                                    <tr>
                                        <th style="border-right: none"><?php echo vtranslate('Table Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                                        <th style="border-right: none"><?php echo vtranslate('Table Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable(0, null, 0);?>
                                    <tr class="listViewEntries">
                                        <?php $_smarty_tpl->tpl_vars['last'] = new Smarty_variable(end($_smarty_tpl->tpl_vars['OPTABLES']->value), null, 0);?>

                                        <?php  $_smarty_tpl->tpl_vars['DATABASE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DATABASE_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['OPTABLES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DATABASE_INFO']->key => $_smarty_tpl->tpl_vars['DATABASE_INFO']->value){
$_smarty_tpl->tpl_vars['DATABASE_INFO']->_loop = true;
?>

                                        <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable($_smarty_tpl->tpl_vars['counter']->value+1, null, 0);?>
                                        <td class="listViewEntrie medium"><?php echo $_smarty_tpl->tpl_vars['DATABASE_INFO']->value;?>
</td>
                                        <?php if ($_smarty_tpl->tpl_vars['last']->value==$_smarty_tpl->tpl_vars['DATABASE_INFO']->value&&$_smarty_tpl->tpl_vars['counter']->value=='1'){?>
                                        <td class="listViewEntrie medium"></td>
                                    </tr>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['counter']->value=='2'){?>
                                    <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable(0, null, 0);?>
                                    </tr>
                                    <tr class="listViewEntries">
                                        <?php }?>


                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php }else{ ?>
                                <h4><?php echo vtranslate('Your tables are optimized!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['COUNTOPTABLES']->value>0){?>
                                <input type='hidden' name='optimizetables' value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['OPTABLES']->value);?>
'>
                                <button class="btn btn-primary optimizetables">
                                    <?php echo vtranslate('Optimize',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                </button>
                            <?php }?>
                            <button class="btn btn-primary optimizealltables">
                                <?php echo vtranslate('Optimize Database Tables',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                            </button>


                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="DataBaseBackup">
                    <div class="row-fluid">
                        <?php if ($_smarty_tpl->tpl_vars['TIME_MESSAGE']->value){?>
                            <div class="alert alert-danger blink_me">
                                <strong><?php echo vtranslate('Warning!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/>
                                <?php echo vtranslate('Database section need more time to execute functionality than the default execution time (%s seconds) available in Server. and due to short of execution time scripting not completed their process execution and hitting timing out.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,$_smarty_tpl->tpl_vars['MAX_EXECUTION_TIME']->value);?>

                                <br/>
                                <a href="http://vtfarsi.ir/maximum-execution-vtiger/"
                                   target="_blank"><?php echo vtranslate('Please increase the value in Server and try again!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
                            </div>
                        <?php }?>
                        <div class="alert alert-info">
                            <strong><?php echo vtranslate('Tip',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/><?php echo vtranslate('Documents attached to the system are NOT included in database backups. Backup of source code files and all attachements (files in Storage folder) should be created manually.',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                        </div>


                        <div class="clearfix"></div>
                        <hr>
                        <br/>
                        <div class="block">
                            <div>
                                <h4 class="textOverflowEllipsis maxWidth50 blink_me">
                                    <img class="cursorPointer alignMiddle blockToggle blink_me hide" src="layouts/v7/skins/images/Square.png" data-mode="hide" data-id="16">
                                    <img class="cursorPointer alignMiddle blockToggle " src="layouts/v7/skins/images/Circle.png" data-mode="show" data-id="16">&nbsp;<?php echo vtranslate('Automatic Backup Settings',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                              <?php if ($_smarty_tpl->tpl_vars['BACKUP_OPTIONS']->value['backup_last']!=null){?>
                                                                  <small><?php echo vtranslate('Last run',$_smarty_tpl->tpl_vars['MODULE']->value);?>
: <?php echo Vtiger_DateTime_UIType::getDisplayValue($_smarty_tpl->tpl_vars['BACKUP_OPTIONS']->value['backup_last']);?>
</small>
                                                              <?php }?>
                                </h4>
                            </div>
                            <hr>
                            <div class="blockData">
                                <div id="dbblockdata">
                                    <div class="row form-group">
                                        <div class="col-lg-4"><?php echo vtranslate('Automatic Backup',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div>
                                        <div class="col-lg-8">
                                            <input name="backup_status" style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['BACKUP_STATUS']->value!=1){?> value='0' <?php }else{ ?> value='1' checked<?php }?>
                                                   class='cursorPointer bootstrap-switch' type="checkbox"
                                                   data-on-text="<?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-off-text="<?php echo vtranslate('Inactive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                                                   data-on-color="primary" data-toggle="toggle"/>
                                            <a href="index.php?module=CronTasks&parent=Settings&view=List"
                                               target="_blank">
                                                <small><?php echo vtranslate('Go to Automation Settings',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</small>
                                            </a>
                                        </div>
                                        <div class="col-lg-4"> &nbsp;</div>
                                        <div class="col-lg-8"> &nbsp;</div>
                                        <div class="col-lg-4"><?php echo vtranslate('Backup Frequency',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div>
                                        <div class="col-lg-8">
                                            <select class="select2" name="backup_frequency" style="min-width:250px;">
                                                <?php echo ParsVT_Module_Model::ParsFormSelectCreate($_smarty_tpl->tpl_vars['BACKUP_FREQUENCY']->value,$_smarty_tpl->tpl_vars['BACKUP_OPTIONS']->value['backup_frequency']);?>

                                            </select>
                                        </div>
                                        <div class="col-lg-4"> &nbsp;</div>
                                        <div class="col-lg-8"> &nbsp;</div>
                                        <div class="col-lg-4"><?php echo vtranslate('Backup Time',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div>
                                        <div class="col-lg-8">
                                            <select class="select2 task-fields" name="backup_start">
                                                <?php echo ParsVT_Module_Model::ParsFormSelectCreate($_smarty_tpl->tpl_vars['BACKUP_TIME']->value,$_smarty_tpl->tpl_vars['BACKUP_OPTIONS']->value['backup_start']);?>


                                            </select>
                                        </div>
                                        <div class="col-lg-4"> &nbsp;</div>
                                        <div class="col-lg-8"> &nbsp;</div>
                                        <div class="col-lg-4"><?php echo vtranslate('Delete Old Backups',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div>
                                        <div class="col-lg-6">
                                            <select class="select2 task-fields" name="backup_keep" style="min-width:250px;">
                                                <option value='0' <?php if ($_smarty_tpl->tpl_vars['BACKUP_OPTIONS']->value['backup_keep']==0){?>selected<?php }?>><?php echo vtranslate('Never',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option>
                                                <?php $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int)ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 365+1 - (1) : 1-(365)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0){
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++){
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
                                                    <option value='<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
' <?php if ($_smarty_tpl->tpl_vars['BACKUP_OPTIONS']->value['backup_keep']==$_smarty_tpl->tpl_vars['foo']->value){?>selected<?php }?>><?php echo vtranslate('Older than %s days',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,$_smarty_tpl->tpl_vars['foo']->value);?>
</option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <button class="btn btn-primary SaveBackupSettings">
                                                <?php echo vtranslate('Save',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                        </div>
                    </div>


                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-condensed table-hover backupTable text-center" id="datatable">
                        <thead>
                        <tr class="active text-center confTable2">
                            <th class="text-center"><?php echo vtranslate('#',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                            <th class="text-center"><?php echo vtranslate('Backup Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                            <th class="text-center"><?php echo vtranslate('Creation Date',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                            <th class="text-center"><?php echo vtranslate('Size',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $_smarty_tpl->tpl_vars['S_FILE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['S_FILE']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FILELIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['S_FILE']->key => $_smarty_tpl->tpl_vars['S_FILE']->value){
$_smarty_tpl->tpl_vars['S_FILE']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['S_FILE']->key;
?>
                            <tr class="confTable2" data-recordurl="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
">
                                <td style="max-width: 30px; width: 30px;"><label for="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"><input type="radio"
                                                                                                    name="rbSelect"
                                                                                                    value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
                                                                                                    class="radio-group"></label>
                                </td>
                                <td>&nbsp;&nbsp;<label for="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
</label></td>
                                <td><label for="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['S_FILE']->value[0];?>
</label></td>
                                <td><label for="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['S_FILE']->value[1];?>
</label></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <table class="table table-condensed table-hover backupTable text-center">
                        <tbody>

                        <tr class="text-center">
                            <td class="text-center" colspan="1" style="vertical-align: middle;">
                                <button class="btn btn-success btn-backup">
                                    <strong><?php echo vtranslate('Create Database Backup',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                                </button>

                            </td>
                            <td class="listViewEntrie medium text-center" colspan="3"
                                style="vertical-align: middle;">

                                <?php echo vtranslate('Admin Password',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                                <input type="password" class="inputElement" name="pass" id="adminpassword"
                                       style="max-width: 150px;">
                                <input type="hidden" name="module" value="ParsVT">
                                <input type="hidden" name="action" value="DBOperation">
                                <input type="hidden" name="parent" value="Settings">
                                <input type="hidden" name="mode" value="get_file">

                                <button class="btn btn-primary"
                                        id="downloadbackup"><?php echo vtranslate('Download Backup',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                <button class="btn btn-warning"
                                        id="btn_restore"><?php echo vtranslate('Restore Backup',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                                <button class="btn btn-danger"
                                        id="btn_delete"><?php echo vtranslate('Delete Backup',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
                            </td>
                        </tr>


                        </tbody>
                    </table>

                </div>
                <div class="tab-pane" id="ListofTables"></div>
                <div class="tab-pane" id="MySQLTuner">
                    <div class="row-fluid">
                        <div class="alert alert-warning">
                            <strong><?php echo vtranslate('Tip',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/><?php echo vtranslate("MySQLTuner is a read only script. It won't write to any configuration files, change the status of any daemons, or call your mother to wish her a happy birthday. It will give you an overview of your server's performance and make some basic recommendations for improvements that you can make after it completes",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <br/>
                        <h4><?php echo vtranslate('ParsVT MySQL Tuner',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4>
                        <br/>
                        <button class="btn btn-primary" onclick="Database_Js.showHelp('<?php echo vtranslate('MySQL Tuner',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
','modules/ParsVT/resources/MySQLTuner/mysqltuner.php');">
                            <?php echo vtranslate('MySQL Tuner',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                        </button>
                        <br/>
                        <br/>
                        <h4><?php echo vtranslate('CLI MySQL Tuner',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4>
                        <br/>
                        <div class="alert alert-info">
                            <strong><?php echo vtranslate('Requirements',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/>
                            <p style="direction: ltr; text-align: left">Perl 5.6 or later (with perl-doc package) <br />Unix/Linux based operating system (tested on Linux, BSD variants, and Solaris variants) <br /> Unrestricted read access to the MySQL server (OS root access recommended for MySQL < 5.1)</span>
                        </div>
                        <div><?php echo vtranslate('Please copy & run the following command in your server',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div>
                        <textarea style="direction: ltr; text-align: left; height: 100px; width: 100%;" readonly> cd <?php echo str_replace("\\","/",vglobal('root_directory'));?>
modules/ParsVT/resources/MySQLTuner/ && chmod +x tuner.sh && sh tuner.sh</textarea>

                    </div>
                </div>
                <div class="tab-pane" id="IndexingTool">
                    <div class="row-fluid">
                        <div class="alert alert-warning blink_me">
                            <strong><?php echo vtranslate('Tip',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong><br/>
                            <?php echo vtranslate('Before you click on Index Now botton, make sure you have backed up you database!',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable({
            "sDom": "<'row'<'col-xs-6'T><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
            "sPaginationType": "full_numbers",
            "language": {
                "decimal": "",
                "emptyTable": "<?php echo vtranslate('No data available in table',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "info": "<?php echo vtranslate('Showing _START_ to _END_ of _TOTAL_ entries',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "infoEmpty": "<?php echo vtranslate('Showing 0 to 0 of 0 entries',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "infoFiltered": "<?php echo vtranslate('(filtered from _MAX_ total entries)',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "<?php echo vtranslate('Show _MENU_ entries',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "loadingRecords": "<?php echo vtranslate('Loading...',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "processing": "<?php echo vtranslate('Processing...',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "search": "<?php echo vtranslate('Search:',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "zeroRecords": "<?php echo vtranslate('No matching records found',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                "paginate": {
                    "first": "<?php echo vtranslate('First',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                    "last": "<?php echo vtranslate('Last',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                    "next": "<?php echo vtranslate('Next',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                    "previous": "<?php echo vtranslate('Previous',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                },
                "aria": {
                    "sortAscending": "<?php echo vtranslate(': activate to sort column ascending',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
",
                    "sortDescending": "<?php echo vtranslate(': activate to sort column descending',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"
                }
            },
            "pageLength": <?php if ($_smarty_tpl->tpl_vars['list_max_entries_per_page']->value!=''&&$_smarty_tpl->tpl_vars['list_max_entries_per_page']->value!='0'){?><?php echo $_smarty_tpl->tpl_vars['list_max_entries_per_page']->value;?>
<?php }else{ ?>20<?php }?>
        });
    });
</script>

<br /><br /><br /><br /><br />
<?php }} ?>