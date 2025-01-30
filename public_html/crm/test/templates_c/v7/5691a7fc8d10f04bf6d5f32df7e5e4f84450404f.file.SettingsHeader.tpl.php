<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:14:18
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVTExtras/SettingsHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1068900199678b9412dc82c9-37278288%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5691a7fc8d10f04bf6d5f32df7e5e4f84450404f' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVTExtras/SettingsHeader.tpl',
      1 => 1736401302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1068900199678b9412dc82c9-37278288',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RELEASE_NOTIF' => 0,
    'MODULE' => 0,
    'MODULE_MODEL' => 0,
    'SettingLink' => 0,
    'MENTION' => 0,
    'LTV' => 0,
    'EXPORTTOEXCEL' => 0,
    'ARIANATTS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9412df27f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9412df27f')) {function content_678b9412df27f($_smarty_tpl) {?>
<script type="text/javascript">
    $(function () {
        $("#Pars<?php echo $_GET['view'];?>
").addClass("active");
        var activetab = $(location).attr('href').split("#");
        if ("1" in activetab) {
            $("#allLanguages").removeClass("active");
            $("#allLanguagesMenu").removeClass("active");
            $("#MiscGereral").removeClass("active");
            $("#MiscGereralMenu").removeClass("active");
            $("#DataBaseGereral").removeClass("active");
            $("#DataBaseGereralMenu").removeClass("active");
            $("#" + activetab[1]).addClass("active");
            $("#" + activetab[1] + "Menu").addClass("active");
        }
        <?php if ($_GET['mode']=='backup'){?>
        $("#DataBaseGereral").removeClass("active");
        $("#DataBaseGereralMenu").removeClass("active");
        $("#DataBaseBackup").addClass("active");
        $("#DataBaseBackupMenu").addClass("active");
        <?php }?>
    });
</script>
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
</style>


<div class="row">
    <div class=" col-md-9">
        <?php if ($_smarty_tpl->tpl_vars['RELEASE_NOTIF']->value){?>
            <div class="col-lg-12 col-md-12 col-sm-12 blink_me text-center">
                <a href='index.php?parent=Settings&module=ParsVT&view=Upgrade'>
                            <span class="btn btn-info">
                               <?php echo $_smarty_tpl->tpl_vars['RELEASE_NOTIF']->value;?>

                            </span>
                </a>
            </div>
        <?php }?>
    </div>
    <div class=" col-md-2">
        <div class="btn-group listViewActionsContainer" role="group" aria-label="..." style="float:left">
            <div class="btn-group pull-right" role="group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <?php  $_smarty_tpl->tpl_vars['SettingLink'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SettingLink']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSettingLinks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SettingLink']->key => $_smarty_tpl->tpl_vars['SettingLink']->value){
$_smarty_tpl->tpl_vars['SettingLink']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['SettingLink']->value['linklabel']=='Module Settings'){?><?php continue 1?><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['SettingLink']->value['linklabel']=='Uninstall Module'){?>
                            <li class="divider"></li>
                        <?php }?>
                        <li><a href="javascript:void(0);"
                               onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['SettingLink']->value['linkurl'];?>
"'><?php echo vtranslate($_smarty_tpl->tpl_vars['SettingLink']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class=" col-md-1"></div>
</div>


<div class="" style="margin-top:0px;">
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li id="ParsSettings"><a
                    href="index.php?module=ParsVTExtras&view=Settings&parent=Settings"><?php echo vtranslate('ParsVT Extras Settings',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
        </li>
        <?php if ($_smarty_tpl->tpl_vars['MENTION']->value||$_REQUEST['view']=='Mention'){?>
            <li id="ParsMention"><a
                        href="index.php?module=ParsVTExtras&view=Mention&parent=Settings"><?php echo vtranslate('Mention Users',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
            </li>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['LTV']->value||$_REQUEST['view']=='LTVEdit'||$_REQUEST['view']=='LTVSettings'){?>
            <li id="<?php if ($_REQUEST['view']=='LTVEdit'){?>ParsLTVEdit<?php }else{ ?>ParsLTVSettings<?php }?>"><a
                        href="index.php?module=ParsVTExtras&view=LTVSettings&parent=Settings"><?php echo vtranslate('LifeTime value Calculator',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
            </li>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['EXPORTTOEXCEL']->value||$_REQUEST['view']=='Excel'){?>
            <li id="ParsExcel"><a
                        href="index.php?module=ParsVTExtras&view=Excel&parent=Settings"><?php echo vtranslate('Export To Excel',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
            </li>
        <?php }?>
        <li id="ParsRelatedFields"><a
                    href="index.php?module=ParsVTExtras&view=RelatedFields&parent=Settings"><?php echo vtranslate('Related Field Generator',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
        </li>
        <?php if ($_smarty_tpl->tpl_vars['ARIANATTS']->value||$_REQUEST['view']=='TTS'){?>
            <li id="ParsTTS"><a
                        href="index.php?module=ParsVTExtras&view=TTS&parent=Settings"><?php echo vtranslate('Ariana TTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
            </li>
        <?php }?>
        <li id="ParsUpgrade"><a target="_blank"
                    href="index.php?module=ParsVTExtras&view=Upgrade&parent=Settings"><?php echo vtranslate('Vtiger Updater',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
        </li>
    </ul>
</div>
<script type="text/javascript">
    var ParsVTErrors = {
        UNKNOWNERR: "<?php echo vtranslate('Unknown Error!',$_smarty_tpl->tpl_vars['MODULE']->value);?>
",
        OPFAILED: "<?php echo vtranslate('Operation Failed : Error !',$_smarty_tpl->tpl_vars['MODULE']->value);?>
",
        NO: "<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
",
        YES: "<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
",
    };
    jQuery(document).ready(function () {
        Vtiger_Index_Js.getInstance().registerEvents();
    });
</script>
<?php }} ?>