<?php /* Smarty version Smarty-3.1.7, created on 2025-01-18 15:45:59
         compiled from "/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Users/Login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:777772308678b9b7f82bd10-69161887%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9239d2ac4a49d0a09c1b5bcb7fdd33f2e327f73' => 
    array (
      0 => '/home/mahcenter/public_html/crm/includes/runtime/../../layouts/v7/modules/Users/Login.tpl',
      1 => 1736402366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '777772308678b9b7f82bd10-69161887',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CompanyDetails' => 0,
    'ERROR' => 0,
    'MESSAGE' => 0,
    'MAIL_STATUS' => 0,
    'JSON_DATA' => 0,
    'BLOCKS_DATA' => 0,
    'ALL_BLOCKS_COUNT' => 0,
    'BLOCK_DATA' => 0,
    'DATA_COUNT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_678b9b7f951de',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_678b9b7f951de')) {function content_678b9b7f951de($_smarty_tpl) {?>


<style>body {background: url(layouts/v7/resources/Images/login-background.jpg);background-position: center;background-size: cover;width: 100%;background-repeat: no-repeat;}hr {margin-top: 15px;background-color: #7C7C7C;height: 2px;border-width: 0;}h3, h4 {margin-top: 0px;}hgroup {text-align:center;margin-top: 4em;}input {font-size: 16px;padding: 10px 10px 10px 0px;-webkit-appearance: none;display: block;color: #636363;width: 100%;border: none;border-radius: 0;border-bottom: 1px solid #757575;}input:focus {outline: none;}label {font-size: 16px;font-weight: normal;position: absolute;pointer-events: none;left: 0px;top: 10px;transition: all 0.2s ease;}input:focus ~ label, input.used ~ label {top: -20px;transform: scale(.75);left: -12px;font-size: 18px;}input:focus ~ .bar:before, input:focus ~ .bar:after {width: 50%;}#page {padding-top: 86px;}.widgetHeight {height: 410px;margin-top: 20px !important;}.loginDiv {max-width: 380px;margin: 0 auto;border-radius: 4px;box-shadow: 0 0 10px gray;background-color: #FFFFFF;}.marketingDiv {color: #303030;}.separatorDiv {background-color: #7C7C7C;width: 2px;height: 460px;margin-left: 20px;}.user-logo {height: 110px;margin: 0 auto;padding-top: 40px;padding-bottom: 20px;}.blockLink {border: 1px solid #303030;padding: 3px 5px;}.group {position: relative;margin: 20px 20px 40px;}.failureMessage {color: red;display: block;text-align: center;padding: 0px 0px 10px;}.successMessage {color: green;display: block;text-align: center;padding: 0px 0px 10px;}.inActiveImgDiv {padding: 5px;text-align: center;margin: 30px 0px;}.app-footer p {margin-top: 0px;}.footer {background-color: #fbfbfb;height:26px;}.bar {position: relative;display: block;width: 100%;}.bar:before, .bar:after {content: '';width: 0;bottom: 1px;position: absolute;height: 1px;background: #35aa47;transition: all 0.2s ease;}.bar:before {left: 50%;}.bar:after {right: 50%;}.button {position: relative;display: inline-block;padding: 9px;margin: .3em 0 1em 0;width: 100%;vertical-align: middle;color: #fff;font-size: 16px;line-height: 20px;-webkit-font-smoothing: antialiased;text-align: center;letter-spacing: 1px;background: transparent;border: 0;cursor: pointer;transition: all 0.15s ease;}.button:focus {outline: 0;}.buttonBlue {background-image: linear-gradient(to bottom, #35aa47 0px, #35aa47 100%)}.ripples {position: absolute;top: 0;left: 0;width: 100%;height: 100%;overflow: hidden;background: transparent;}//Animations@keyframes inputHighlighter {from {background: #4a89dc;}to 	{width: 0;background: transparent;}}@keyframes ripples {0% {opacity: 0;}25% {opacity: 1;}100% {width: 200%;padding-bottom: 200%;opacity: 0;}}</style><?php if (vglobal('current_language')=='fa_ir'){?><link type='text/css' rel='stylesheet' href='modules/ParsVT/resources/styles/fonts/fonts.php?font=IRANSans'><style>@media (max-width:1024px) {.separatorDiv,.marketingDiv{display:none !important;}}* {font-family: 'VtigerFont', Tahoma;}b {font-weight: bold;font-size: 13px;}h4 {font-size: 15px;font-weight: bold;}label {direction: rtl;left: unset;right: 10px;}.marketingDiv * {direction: rtl;font-family: 'VtigerFont', 'OpenSans-Semibold', 'ProximaNova-Semibold', sans-serif;}.group {direction: rtl;}.mCSB_inside li.slide .col-lg-9 div *{direction:rtl;text-align:right}.bx-wrapper .bxslider li {direction: rtl;text-align: right !important;width: 500px !important;}h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {direction: rtl;}div.bx-viewport ul.bxslider li.slide.bx-clone div.col-lg-9 div a{text-align:left;}.app-footer {direction: rtl;}.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {float: right;}.bx-viewport {direction: ltr !important;}</style><?php }?><span class="app-nav"></span><div class="container-fluid loginPageContainer"><div class="col-lg-5 col-md-12 col-sm-12 col-xs-12"><div class="loginDiv widgetHeight"><?php $_smarty_tpl->tpl_vars["CompanyDetails"] = new Smarty_variable(getCompanyDetails(), null, 0);?><a href="<?php if (strpos($_smarty_tpl->tpl_vars['CompanyDetails']->value['website'],"http")===false){?>//<?php }?><?php echo $_smarty_tpl->tpl_vars['CompanyDetails']->value['website'];?>
" target="_blank"><img class="img-responsive user-logo"  title="<?php echo $_smarty_tpl->tpl_vars['CompanyDetails']->value['companyname'];?>
" src="test/logo/<?php echo $_smarty_tpl->tpl_vars['CompanyDetails']->value['logoname'];?>
"></a><div><span class="<?php if (!$_smarty_tpl->tpl_vars['ERROR']->value){?>hide<?php }?> failureMessage" id="validationMessage"><?php echo vtranslate($_smarty_tpl->tpl_vars['MESSAGE']->value,'ParsVT');?>
</span><span class="<?php if (!$_smarty_tpl->tpl_vars['MAIL_STATUS']->value){?>hide<?php }?> successMessage"><?php echo vtranslate($_smarty_tpl->tpl_vars['MESSAGE']->value,'ParsVT');?>
</span></div><div id="loginFormDiv"><form class="form-horizontal" method="POST" action="index.php"><input type="hidden" name="module" value="Users"/><input type="hidden" name="action" value="Login"/><div class="group"><input id="username" type="text" name="username" placeholder="<?php echo vtranslate('Username','ParsVT');?>
"><span class="bar"></span><label><?php echo vtranslate('Username','ParsVT');?>
</label></div><div class="group"><input id="password" type="password" name="password" placeholder="<?php echo vtranslate('Password','ParsVT');?>
"><span class="bar"></span><label><?php echo vtranslate('Password','ParsVT');?>
</label></div><div class="group"><button type="submit" class="button buttonBlue"><?php echo vtranslate('Sign in','ParsVT');?>
</button><br><a class="forgotPasswordLink" style="color: #15c;"><?php echo vtranslate('forgot password?','ParsVT');?>
</a></div></form></div><div id="forgotPasswordDiv" class="hide"><form class="form-horizontal" action="forgotPassword.php" method="POST"><div class="group"><input id="fusername" type="text" name="username" placeholder="<?php echo vtranslate('Username','ParsVT');?>
" ><span class="bar"></span><label><?php echo vtranslate('Username','ParsVT');?>
</label></div><div class="group"><input id="email" type="email" name="emailId" placeholder="<?php echo vtranslate('Email','ParsVT');?>
" ><span class="bar"></span><label><?php echo vtranslate('Email','ParsVT');?>
</label></div><div class="group"><button type="submit" class="button buttonBlue forgot-submit-btn"><?php echo vtranslate('Submit','ParsVT');?>
</button><br><span><?php echo vtranslate('Please enter details and submit','ParsVT');?>
<a class="forgotPasswordLink <?php if (vglobal('current_language')=='fa_ir'){?>pull-left<?php }else{ ?>pull-right<?php }?>" style="color: #15c;"><?php echo vtranslate('Back','ParsVT');?>
</a></span></div></form></div></div></div><div class="col-lg-1 hidden-xs hidden-sm hidden-md"><div class="separatorDiv"></div></div><div class="col-lg-5 hidden-xs hidden-sm hidden-md"><div class="marketingDiv widgetHeight"><?php if ($_smarty_tpl->tpl_vars['JSON_DATA']->value){?><div class="scrollContainer"><?php $_smarty_tpl->tpl_vars['ALL_BLOCKS_COUNT'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['BLOCKS_DATA'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCKS_DATA']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['JSON_DATA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCKS_DATA']->key => $_smarty_tpl->tpl_vars['BLOCKS_DATA']->value){
$_smarty_tpl->tpl_vars['BLOCKS_DATA']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_NAME']->value = $_smarty_tpl->tpl_vars['BLOCKS_DATA']->key;
?><?php if ($_smarty_tpl->tpl_vars['BLOCKS_DATA']->value){?><div><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCKS_DATA']->value[0]['heading'],'ParsVT');?>
</h4><ul class="bxslider"><?php  $_smarty_tpl->tpl_vars['BLOCK_DATA'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_DATA']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['BLOCKS_DATA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_DATA']->key => $_smarty_tpl->tpl_vars['BLOCK_DATA']->value){
$_smarty_tpl->tpl_vars['BLOCK_DATA']->_loop = true;
?><li class="slide"><?php $_smarty_tpl->tpl_vars['ALL_BLOCKS_COUNT'] = new Smarty_variable($_smarty_tpl->tpl_vars['ALL_BLOCKS_COUNT']->value+1, null, 0);?><?php if ($_smarty_tpl->tpl_vars['BLOCK_DATA']->value['image']){?><div class="col-lg-3" style="min-height: 100px;"><img src="<?php echo $_smarty_tpl->tpl_vars['BLOCK_DATA']->value['image'];?>
" style="width: 100%;height: 100%;margin-top: 10px;"/></div><div class="col-lg-9"><?php }else{ ?><div class="col-lg-12"><?php }?><div title="<?php echo $_smarty_tpl->tpl_vars['BLOCK_DATA']->value['summary'];?>
"><h3><b><?php echo $_smarty_tpl->tpl_vars['BLOCK_DATA']->value['displayTitle'];?>
</b></h3><?php echo $_smarty_tpl->tpl_vars['BLOCK_DATA']->value['displaySummary'];?>
<br><br><a href="<?php echo $_smarty_tpl->tpl_vars['BLOCK_DATA']->value['url'];?>
" target="_blank"><u><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_DATA']->value['urlalt'],'ParsVT');?>
</u></a></div><?php if ($_smarty_tpl->tpl_vars['BLOCK_DATA']->value['image']){?></div><?php }else{ ?></div><?php }?></li><?php } ?></ul></div><?php if ($_smarty_tpl->tpl_vars['ALL_BLOCKS_COUNT']->value!=$_smarty_tpl->tpl_vars['DATA_COUNT']->value){?><br><hr><?php }?><?php }?><?php } ?></div><?php }else{ ?><div class="inActiveImgDiv"><div><h4><?php echo vtranslate('Get more out of Vtiger with extensions from','ParsVT');?>
</h4><h4><?php echo vtranslate('VTFarsi Marketplace','ParsVT');?>
</h4></div><a href="http://vtfarsi.ir/%D9%85%D8%A7%DA%98%D9%88%D9%84-%D9%88%DB%8C%D8%AA%D8%A7%DB%8C%DA%AF%D8%B1/" target="_blank" style="margin-right: 25px;"><img src="layouts/v7/modules/ParsVT/images/extensionstore.png" style="width: 85%; height: 100%; margin-top: 25px;"/></a></div><?php }?></div></div></div><script>jQuery(document).ready(function () {var validationMessage = jQuery('#validationMessage');var forgotPasswordDiv = jQuery('#forgotPasswordDiv');var loginFormDiv = jQuery('#loginFormDiv');loginFormDiv.find('#password').focus();loginFormDiv.find('a').click(function () {loginFormDiv.toggleClass('hide');forgotPasswordDiv.toggleClass('hide');validationMessage.addClass('hide');});forgotPasswordDiv.find('a').click(function () {loginFormDiv.toggleClass('hide');forgotPasswordDiv.toggleClass('hide');validationMessage.addClass('hide');});loginFormDiv.find('button').on('click', function () {var username = loginFormDiv.find('#username').val();var password = jQuery('#password').val();var result = true;var errorMessage = '';if (username === '') {errorMessage = '<?php echo vtranslate('Please enter valid username','ParsVT');?>
';result = false;} else if (password === '') {errorMessage = '<?php echo vtranslate('Please enter valid password','ParsVT');?>
';result = false;}if (errorMessage) {validationMessage.removeClass('hide').text(errorMessage);}return result;});forgotPasswordDiv.find('button').on('click', function () {var username = jQuery('#forgotPasswordDiv #fusername').val();var email = jQuery('#email').val();var email1 = email.replace(/^\s+/, '').replace(/\s+$/, '');var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/;var illegalChars = /[\(\)\<\>\,\;\:\\\"\[\]]/;var result = true;var errorMessage = '';if (username === '') {errorMessage = '<?php echo vtranslate('Please enter valid username','ParsVT');?>
';result = false;} else if (!emailFilter.test(email1) || email == '') {errorMessage = '<?php echo vtranslate('Please enter valid email address','ParsVT');?>
';result = false;} else if (email.match(illegalChars)) {errorMessage = '<?php echo vtranslate('The email address contains illegal characters.','ParsVT');?>
';result = false;}if (errorMessage) {validationMessage.removeClass('hide').text(errorMessage);}return result;});jQuery('input').blur(function (e) {var currentElement = jQuery(e.currentTarget);if (currentElement.val()) {currentElement.addClass('used');} else {currentElement.removeClass('used');}});var ripples = jQuery('.ripples');ripples.on('click.Ripples', function (e) {jQuery(e.currentTarget).addClass('is-active');});ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function (e) {jQuery(e.currentTarget).removeClass('is-active');});loginFormDiv.find('#username').focus();var slider = jQuery('.bxslider').bxSlider({auto: true,pause: 4000,nextText: "",prevText: "",autoHover: true});jQuery('.bx-prev, .bx-next, .bx-pager-item').live('click',function(){ slider.startAuto(); });jQuery('.bx-wrapper .bx-viewport').css('background-color', 'transparent');jQuery('.bx-wrapper .bxslider li').css('text-align', 'left');jQuery('.bx-wrapper .bx-pager').css('bottom', '-15px');var params = {theme		: 'dark-thick',setHeight	: '100%',advanced	:	{autoExpandHorizontalScroll:true,setTop: 0}};jQuery('.scrollContainer').mCustomScrollbar(params);});</script></div><?php }} ?>