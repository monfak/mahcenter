<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:49:18
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/ModalHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:690338940678b9c463ecff7-50606746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8648078fe9987bd1fdda3b4d503a7d858f5b4d44' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/ModalHeader.tpl',
      1 => 1736402366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '690338940678b9c463ecff7-50606746',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TITLE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9c463f0ae',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9c463f0ae')) {function content_678b9c463f0ae($_smarty_tpl) {?>
<div class="modal-header"><div class="clearfix"><div class="pull-right " ><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div><h4 class="pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['TITLE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></div></div>    <?php }} ?>