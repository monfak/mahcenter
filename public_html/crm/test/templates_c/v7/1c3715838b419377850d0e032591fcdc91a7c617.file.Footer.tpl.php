<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:13:58
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/Footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1535642132678b93fecd6a74-49722145%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c3715838b419377850d0e032591fcdc91a7c617' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/Footer.tpl',
      1 => 1736402366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1535642132678b93fecd6a74-49722145',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VTIGER_VERSION' => 0,
    'LANGUAGE_STRINGS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b93fece47b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b93fece47b')) {function content_678b93fece47b($_smarty_tpl) {?>

<footer class="app-footer">
	<p>
		

<?php echo vtranslate('Powered by vtiger CRM','ParsVT');?>


 - <?php echo $_smarty_tpl->tpl_vars['VTIGER_VERSION']->value;?>
&nbsp;&nbsp;© 2004 - <?php echo date('Y');?>
&nbsp;&nbsp;
		

<a href="//www.vtiger.com" target="_blank"><?php echo vtranslate('Vtiger','ParsVT');?>
</a>&nbsp;&nbsp;|&nbsp;
		<a href="//www.parsvt.com" target="_blank"><?php echo vtranslate('ParsVT CRM','ParsVT');?>
</a>&nbsp;&nbsp;|&nbsp;


		<a href="https://www.vtiger.com/privacy-policy" target="_blank">

<?php echo vtranslate('Privacy Policy','ParsVT');?>


</a>
	</p>
</footer>
</div>
<div id='overlayPage'>
	<!-- arrow is added to point arrow to the clicked element (Ex:- TaskManagement), 
	any one can use this by adding "show" class to it -->
	<div class='arrow'></div>
	<div class='data'>
	</div>
</div>
<div id='helpPageOverlay'></div>
<div id="js_strings" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['LANGUAGE_STRINGS']->value);?>
</div>
<div class="modal myModal fade"></div>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('JSResources.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>

</html><?php }} ?>