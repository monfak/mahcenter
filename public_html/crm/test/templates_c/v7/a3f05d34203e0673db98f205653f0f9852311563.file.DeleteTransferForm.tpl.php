<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 17:01:25
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Settings/Roles/DeleteTransferForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:552683320678bad2d62ee51-78884681%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3f05d34203e0673db98f205653f0f9852311563' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Settings/Roles/DeleteTransferForm.tpl',
      1 => 1736399757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '552683320678bad2d62ee51-78884681',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'RECORD_MODEL' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678bad2d66419',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678bad2d66419')) {function content_678bad2d66419($_smarty_tpl) {?>



<div class="modal-dialog modelContainer"><?php ob_start();?><?php echo vtranslate('LBL_DELETE_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" - ")).($_tmp2), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-content"><form class="form-horizontal" id="roleDeleteForm" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="Delete" /><input type="hidden" name="record" id="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId();?>
" /><div name='massEditContent'><div class="modal-body"><div class="col-sm-5"><div class="control-label fieldLabel pull-right "><?php echo vtranslate('LBL_TRANSFER_TO_OTHER_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></div></div><div class="input-group fieldValue col-xs-6"><input id="transfer_record" name="transfer_record" type="hidden" value="" class="sourceField" data-rule-required="true"><input id="transfer_record_display" data-rule-required='true' name="transfer_record_display" type="text" class="inputElement" value=""><a href="#" id="clearRole" class="clearReferenceSelection hide cursorPointer" name="clearToEmailField"> X </a><span class="input-group-addon cursorPointer relatedPopup" data-field="transfer_record" data-action="popup" data-url="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getPopupWindowUrl();?>
&type=Transfer"><i class="fa fa-search"></i></span></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>



<?php }} ?>