<?php /* Smarty version Smarty-3.1.7, created on 2025-01-19 13:22:54
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/Picklist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:678110951678ccb767a9ad7-69526163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '58c723a147f9118f1da4aa910e7b6079b847d2aa' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/Picklist.tpl',
      1 => 1736402423,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '678110951678ccb767a9ad7-69526163',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'FIELD_INFO' => 0,
    'FIELD_NAME' => 0,
    'OCCUPY_COMPLETE_WIDTH' => 0,
    'SPECIAL_VALIDATOR' => 0,
    'counter' => 0,
    'MODULE' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_COLORS' => 0,
    'CLASS_NAME' => 0,
    'PICKLIST_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678ccb7687672',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678ccb7687672')) {function content_678ccb7687672($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/mahcenter/public_html/crm/libraries/Smarty/libs/plugins/modifier.replace.php';
?>

<?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php if (isset($_smarty_tpl->tpl_vars['FIELD_INFO']->value['editablepicklistvalues'])&&!empty($_smarty_tpl->tpl_vars['FIELD_INFO']->value['editablepicklistvalues'])){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['editablepicklistvalues'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'], null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['PICKLIST_COLORS'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistColors'], null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName(), null, 0);?><?php if (strstr($_smarty_tpl->tpl_vars['FIELD_NAME']->value,'cf_pcf_rbf')&&strpos($_smarty_tpl->tpl_vars['FIELD_NAME']->value,'cf_pcf_rbf')=='0'){?><?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable(1, null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()){?><input data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="radio" class="inputElement select2 <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value){?> row <?php }?>" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator="<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
"<?php }?> data-selected-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"]==true){?> data-rule-required="true"<?php }?> <?php if (count($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"])){?> data-specific-rules="<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator']);?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
<?php echo $_smarty_tpl->tpl_vars['counter']->value;?>
" value="" /><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
<?php echo $_smarty_tpl->tpl_vars['counter']->value;?>
">&nbsp;<?php echo vtranslate('LBL_BLANK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><br><?php }?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable($_smarty_tpl->tpl_vars['counter']->value+1, null, 0);?><?php ob_start();?><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value,' ','_');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable("picklistColor_".($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName())."_".$_tmp1, null, 0);?><input data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="radio" class="inputElement select2 <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value){?> row <?php }?>" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator="<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
"<?php }?> data-selected-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"]==true){?> data-rule-required="true"<?php }?> <?php if (count($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"])){?> data-specific-rules="<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator']);?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
<?php echo $_smarty_tpl->tpl_vars['counter']->value;?>
" value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?> checked="checked" <?php }?>><label for="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
<?php echo $_smarty_tpl->tpl_vars['counter']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value]){?>class="<?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
"<?php }?>>&nbsp;<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</label><br><?php } ?><style>input[type=radio] {border: 1px solid #b9b9b9 !important;}</style><?php }else{ ?><select data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="picklist" class="inputElement select2 <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value){?> row <?php }?>" type="picklist" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?> data-selected-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
'<?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"]==true){?> data-rule-required="true" <?php }?><?php if (!empty($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])&&is_array(empty($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator']))){?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()){?><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php ob_start();?><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value,' ','_');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable("picklistColor_".($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName())."_".$_tmp2, null, 0);?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" <?php if (isset($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value])&&$_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value]){?>class="<?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
"<?php }?> <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }?><?php if ($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value){?><style type="text/css"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php ob_start();?><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value,' ','_');?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable(($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName())."_".$_tmp3, null, 0);?>.picklistColor_<?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
 {<?php if (isset($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value])){?>background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value];?>
 !important;<?php if ($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value]=='#ffffff'){?>color: #000000 !important;<?php }?><?php }?>}.picklistColor_<?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
.select2-highlighted {white: #ffffff !important;background-color: #337ab7 !important;}<?php } ?></style><?php }?>
<?php }} ?>