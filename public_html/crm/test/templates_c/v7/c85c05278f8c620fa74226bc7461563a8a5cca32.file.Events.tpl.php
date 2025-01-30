<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:46:45
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/dashboards/Events.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1271537427678b9badc76ac9-44777266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c85c05278f8c620fa74226bc7461563a8a5cca32' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/dashboards/Events.tpl',
      1 => 1736401297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1271537427678b9badc76ac9-44777266',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
    'MODULE_NAME' => 0,
    'EMROOZ' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9badcd2a2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9badcd2a2')) {function content_678b9badcd2a2($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['content']->value){?>
<div class="dashboardWidgetHeader">
	<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/WidgetHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="dashboardWidgetContent IranianEvents" style="padding-top:15px;height:196px;">
<?php }?>

    <div style='padding:0 5px; text-align:right'>

     <?php echo $_smarty_tpl->tpl_vars['EMROOZ']->value;?>


    </div>
<?php if ($_smarty_tpl->tpl_vars['content']->value){?>

</div>

<div class="widgeticons dashBoardWidgetFooter">
    <div class="footerIcons pull-right">
        <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/DashboardFooterIcons.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>
</div>
<?php }?>

<script>
jQuery(document).ready(function(){
var parent = $(".dashboardWidgetContent");
var contentContainer = $(".IranianEvents");
contentContainer.mCustomScrollbar('destroy');
app.helper.showVerticalScroll(contentContainer,{ });
contentContainer.height(function (index, height) {
    return (height + 40);
});
vtUtils.enableTooltips();
});
</script><?php }} ?>