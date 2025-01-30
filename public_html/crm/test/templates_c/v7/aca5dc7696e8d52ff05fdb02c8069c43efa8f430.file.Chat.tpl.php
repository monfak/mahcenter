<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:14:02
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/AJAXChat/Chat.tpl" */ ?>
<?php /*%%SmartyHeaderCode:520624253678b9402a7fa30-93676828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aca5dc7696e8d52ff05fdb02c8069c43efa8f430' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/AJAXChat/Chat.tpl',
      1 => 1736401301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '520624253678b9402a7fa30-93676828',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'URLCSS' => 0,
    'URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9402ad0cb',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9402ad0cb')) {function content_678b9402ad0cb($_smarty_tpl) {?>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URLCSS']->value;?>
" type="text/css"><div id="AJAXChatBlock"><iframe  name="parsajaxchat" id="parsajaxchat" style="width: 100%;height: 600px;" src="<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
" frameborder="0"></iframe></div>

<?php }} ?>