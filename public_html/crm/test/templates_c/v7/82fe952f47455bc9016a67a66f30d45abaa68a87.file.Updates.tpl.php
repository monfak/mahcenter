<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:16:16
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/dashboards/Updates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1854877330678b9488c77395-29303370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82fe952f47455bc9016a67a66f30d45abaa68a87' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/ParsVT/dashboards/Updates.tpl',
      1 => 1736401297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1854877330678b9488c77395-29303370',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'UPDATES' => 0,
    'k' => 0,
    'WIDGET' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9488ce0d8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9488ce0d8')) {function content_678b9488ce0d8($_smarty_tpl) {?>
<style>
    .btn-outline-success {
        color: #28a745;
        background-color: transparent;
        background-image: none;
        border-color: #28a745;
    }
    .btn-outline-success:hover {
         color: #ffffff;
         background-color: #28a745;
         border-color: #28a745;
     }
</style>
<div class="dashboardWidgetHeader">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/WidgetHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="dashboardWidgetContent">
    <div class="parsvt_updates" style="padding-top:5px;height:180px;">
        <?php if (ParsVT_Module_Model::php7_count($_smarty_tpl->tpl_vars['UPDATES']->value)>0){?>
            <div>
                <div class='row'>
                    <table class='table updatetable'>
                        <thead class="text-center">
                        <tr class="text-center">
                            <th class="text-center">
                                <?php echo vtranslate('Module Name','ParsVT');?>

                            </th>
                            <th class="text-center">
                                <?php echo vtranslate('Release Date',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                            </th>
                            <th class="text-center">
                                <?php echo vtranslate('Version',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                            </th>
                            <th class="text-center">
                                <?php echo vtranslate('Detail & Update',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                            </th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php  $_smarty_tpl->tpl_vars['MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['UPDATES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODEL']->key => $_smarty_tpl->tpl_vars['MODEL']->value){
$_smarty_tpl->tpl_vars['MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['MODEL']->key;
?>
                            <tr class="text-center">
                                <td>
                                    <?php echo vtranslate($_smarty_tpl->tpl_vars['UPDATES']->value[$_smarty_tpl->tpl_vars['k']->value]['module'],$_smarty_tpl->tpl_vars['UPDATES']->value[$_smarty_tpl->tpl_vars['k']->value]['module']);?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['UPDATES']->value[$_smarty_tpl->tpl_vars['k']->value]['patch'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['UPDATES']->value[$_smarty_tpl->tpl_vars['k']->value]['version'];?>

                                </td>
                                <td>
                                    <a class="btn btn-outline-success" href="index.php?parent=Settings&module=<?php echo $_smarty_tpl->tpl_vars['UPDATES']->value[$_smarty_tpl->tpl_vars['k']->value]['module'];?>
&view=Upgrade" target="_blank">
                                        <?php echo vtranslate('LBL_UPGRADE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }else{ ?>
            <span class="noDataMsg">
		<?php echo vtranslate('No updates available',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span> <?php }?>
    </div>
</div>
<div class="widgeticons dashBoardWidgetFooter">
    <div class="footerIcons pull-right">
        <?php if (!$_smarty_tpl->tpl_vars['WIDGET']->value->isDefault()){?>
            <a name="dclose" class="widget" data-url="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getDeleteUrl();?>
">
                <i class="fa fa-remove" hspace="2" border="0" align="absmiddle" title="<?php echo vtranslate('LBL_REMOVE');?>
" alt="<?php echo vtranslate('LBL_REMOVE');?>
"></i>
            </a>
        <?php }?>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        var parent = $(".dashboardWidgetContent");
        var contentContainer = $(".parsvt_updates");
        contentContainer.mCustomScrollbar('destroy');
        app.helper.showVerticalScroll(contentContainer, {});
        contentContainer.height(function(index, height) {
            return (height + 40);
        });
        vtUtils.enableTooltips();
    });
</script><?php }} ?>