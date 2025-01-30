<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:50:32
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/StringDetailView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1542713588678b9c90e75c98-52419776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64a02425771fd93516458fac623715bb58924ca5' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/StringDetailView.tpl',
      1 => 1736402366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1542713588678b9c90e75c98-52419776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'MODULE' => 0,
    'PICKLIST_COLOR' => 0,
    'RECORD' => 0,
    'FIELDVAL' => 0,
    'PICKLIST_DISPLAY_VALUE' => 0,
    'MULTI_RAW_PICKLIST_VALUES' => 0,
    'MULTI_PICKLIST_VALUE' => 0,
    'MULTI_PICKLIST_INDEX' => 0,
    'MULTI_PICKLIST_VALUES' => 0,
    'DISPLAY_VALUE' => 0,
    'LISTVIEW_ENTRY_VALUE' => 0,
    'REFERENCE_RECORD_MODULENAME' => 0,
    'ENTRY_RAWVALUE' => 0,
    'CURRENT_USER_MODEL' => 0,
    'BASE_CURRENCY_SYMBOL' => 0,
    'CURRENCY_INFO' => 0,
    'SYMBOL_PLACEMENT' => 0,
    'CURRENCY_SYMBOL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9c9106ffc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9c9106ffc')) {function content_678b9c9106ffc($_smarty_tpl) {?>


<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='picklist'&&$_smarty_tpl->tpl_vars['MODULE']->value!='Users'){?>
    <?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorByValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?>  
    <span <?php if (!empty($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value)){?> class="picklist-color" style="background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
; line-height:15px; color: <?php echo Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value);?>
;" <?php }?>>
        

<?php $_smarty_tpl->tpl_vars['FIELDVAL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if (method_exists('ParsVT_Module_Model','FixRTL')&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='string'){?><?php echo ParsVT_Module_Model::FixRTL($_smarty_tpl->tpl_vars['FIELDVAL']->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['FIELDVAL']->value;?>
<?php }?>


    </span>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multipicklist'&&$_smarty_tpl->tpl_vars['MODULE']->value!='Users'){?>
    <?php $_smarty_tpl->tpl_vars['PICKLIST_DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES'] = new Smarty_variable(explode('|##|',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['PICKLIST_DISPLAY_VALUE']->value), null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value = $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->key;
?>
        <?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorByValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(),trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value)), null, 0);?>
        <span class="picklist-color" <?php if (!empty($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value)){?> style="background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
; color: <?php echo Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value);?>
;" <?php }?>> <?php echo trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value]);?>
 </span>
        <?php if ($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value+1]!=''){?>,<?php }?>
    <?php } ?> 


<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='date'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='datetime'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='14'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="fa fa-calendar icon cf_color_field pull-left" aria-hidden="true"></i>
        <span class="text"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='percentage'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <div class="percentage_wrapper">
            <span class="percentage_value" style="width: <?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
%;"></span>
            <span class="text"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
        </div>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='url'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="fa fa-external-link icon cf_color_field pull-left" aria-hidden="true"></i>
        <span class="text"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='email'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="fa fa-envelope-o icon cf_color_field pull-left" aria-hidden="true"></i>
        <span class="text"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='4'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="vicon-<?php echo mb_strtolower($_smarty_tpl->tpl_vars['MODULE']->value, 'UTF-8');?>
 icon cf_color_field pull-left" aria-hidden="true" style="font-size: 14px"></i>
        <span class="text"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='117'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="fa fa-money icon cf_color_field pull-left" aria-hidden="true"></i>
        <span class="text"><?php echo vtranslate($_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value,"Settings:Currency");?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='777'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="fa fa-map-o icon cf_color_field pull-left" aria-hidden="true"></i>
        <a class="text" href="https://maps.google.com?q=<?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</a>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='85'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <i class="fa fa-skype icon cf_color_field pull-left" aria-hidden="true"></i>
        <a class="text" href="skype:<?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
?call"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</a>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='52'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='53'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='77'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php echo ParsVT_Utils_Helper::displayOwnerField($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value);?>

<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'){?>
        <?php $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')!=''){?>
        <?php $_smarty_tpl->tpl_vars['REFERENCE_RECORD_MODULENAME'] = new Smarty_variable(array(), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['URL_REGEX'] = new Smarty_variable(preg_match("/module=([0-9A-Za-z]*)/",$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value,$_smarty_tpl->tpl_vars['REFERENCE_RECORD_MODULENAME']->value), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['REFERENCE_RECORD_MODULENAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['REFERENCE_RECORD_MODULENAME']->value[1], null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['REFERENCE_RECORD_MODULENAME']->value!=''){?>
            <i class="vicon-<?php echo mb_strtolower($_smarty_tpl->tpl_vars['REFERENCE_RECORD_MODULENAME']->value, 'UTF-8');?>
 icon cf_color_field pull-left" aria-hidden="true"></i>&nbsp;
        <?php }?>
        <span class="text"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value;?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='56'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='156'){?>
    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['ENTRY_RAWVALUE'] = new Smarty_variable($_tmp1, null, 0);?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['ENTRY_RAWVALUE']->value==1||$_smarty_tpl->tpl_vars['ENTRY_RAWVALUE']->value=="on"){?>
        <span class="boolean-true"><i class="fa fa-check-circle pull-left" aria-hidden="true"></i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
    <?php }else{ ?>
        <span class="boolean-false"><i class="fa fa-times-circle pull-left" aria-hidden="true"></i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value;?>
</span>
    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label')=='Currency'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label')=='Language'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='26'){?>
    <?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php echo vtranslate($_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>

<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='currency'){?>


    <?php $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL'] = new Smarty_variable(Users_Record_Model::getCurrentUserModel(), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['SYMBOL_PLACEMENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement'), null, 0);?>
    <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='72')&&($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName()=='unit_price')){?>
        <?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BASE_CURRENCY_SYMBOL']->value, null, 0);?>
    <?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='71'){?>
        <?php $_smarty_tpl->tpl_vars['CURRENCY_INFO'] = new Smarty_variable(getCurrencySymbolandCRate($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_id')), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['symbol'], null, 0);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['SYMBOL_PLACEMENT']->value=='$1.0'){?>
        <?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>
&nbsp;<span class="currencyValue"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
</span>
    <?php }else{ ?>
        <span class="currencyValue"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
</span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>

    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')=='signature'){?>
	<?php echo decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value));?>

<?php }else{ ?>
    

<?php $_smarty_tpl->tpl_vars['FIELDVAL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php if (method_exists('ParsVT_Module_Model','FixRTL')&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='string'){?><?php echo ParsVT_Module_Model::FixRTL($_smarty_tpl->tpl_vars['FIELDVAL']->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['FIELDVAL']->value;?>
<?php }?>


<?php }?>
<?php }} ?>