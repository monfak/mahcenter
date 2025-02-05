<!--/* +********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ******************************************************************************* */-->

<!DOCTYPE html>
<html>
    <head>
        {**PVTPATCHER-8B2BA9E3DB68F85F6AC43821A788DA94-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{if vglobal('default_language') eq 'fa_ir'}
         <link type="text/css" rel="stylesheet" href="modules/ParsVT/resources/styles/fonts/fonts.php?font=IRANSans" media="screen" />
        {/if}
        <style type="text/css">
{** REPLACED-8B2BA9E3DB68F85F6AC43821A788DA94// <style type="text/css">**}
{**PVTPATCHER-8B2BA9E3DB68F85F6AC43821A788DA94-FINISH**}
            body{
                font-family: Tahoma, "Trebuchet MS","Lucida Grande",Verdana !important;
                //background: #F5FAEE !important;/*#f1f6e8;*/
                color : #555 !important;
                font-size: 85% !important;
                height: 98% !important;
            }
            hr{
                border: 0;
                height: 1px;
                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
            }
            #container{
                min-width:280px;
                width:50%;
                margin-top:2%;
            }
            #btn{
                color: white;
                border-radius: 4px;
                text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
                background: rgb(28, 184, 65);
                border-style: none;
                width: 86px;
                height: 27px;
                font-size: 12px;
            }
            #password,#confirmPassword{
                height:20px;
                width:140px;

            }
            .control-label{
                font-size: 12px;
            }
            #content{
                padding:8px 20px;
                border:1px solid #ddd;
                background:#fff;
                border-radius:5px;
            }
            #footer{
                float:right;
            }
            #footer p{
                text-align:right;
                margin-right:20px;
            }
            .button-container a{
                text-decoration: none;
            }
            .button-container{
                float: right;
            }
            .button-container .btn{
                margin-left: 15px;
                min-width: 100px;
                font-weight: bold;
            }
            .logo{
                padding: 15px 0 ;
            }
            .line{

            }
        {**PVTPATCHER-6E7907C66CC3BB561EEDB1CF2A4402B2-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
{if vglobal('default_language') eq 'fa_ir'}
            #content, #btn {
               direction: rtl;
               font-family: 'VtigerFont', Tahoma;
            }
            {/if}
            </style>
{** REPLACED-6E7907C66CC3BB561EEDB1CF2A4402B2// </style>**}
{**PVTPATCHER-6E7907C66CC3BB561EEDB1CF2A4402B2-FINISH**}
        <script language='JavaScript'>
            function checkPassword() {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirmPassword').value;
                if (password == '' && confirmPassword == '') {
                    {**PVTPATCHER-B8992C9C1242A6E88E93C53C44F0E232-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
alert('{vtranslate('Please enter new Password', 'ParsVT')}');
{** REPLACED-B8992C9C1242A6E88E93C53C44F0E232// alert('Please enter new Password');**}
{**PVTPATCHER-B8992C9C1242A6E88E93C53C44F0E232-FINISH**}
                    return false;
                } else if (password != confirmPassword) {
                    {**PVTPATCHER-CC5580946358679AFF6F1494D6498A80-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
alert('{vtranslate('Password and Confirm Password should be same', 'ParsVT')}');
{** REPLACED-CC5580946358679AFF6F1494D6498A80// alert('Password and Confirm Password should be same');**}
{**PVTPATCHER-CC5580946358679AFF6F1494D6498A80-FINISH**}
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <div id="container">
            <div class="logo" style = "padding-left:50%">
                <img  src="{$LOGOURL}" alt="{$TITLE}" style="height: 4em;width: 12em;"><br><br><br>
            </div>
            <div style = "padding-left:50%;width:100%">
                {if $LINK_EXPIRED neq 'true'}
                    <div id="content">
                        <span><h2 style = "font-size:16px">{vtranslate('LBL_CHANGE_PASSWORD',$MODULE)}</h2></span>
                        <hr class="line">
                        <div id="changePasswordBlock" align='left'>
                            <form name="changePassword" id="changePassword" action="{$TRACKURL}" method="post" accept-charset="utf-8">
                                <input type="hidden" name="username" value="{$USERNAME}">
                                <input type="hidden" name="shorturl_id" value="{$SHORTURL_ID}">
                                <input type="hidden" name="secret_hash" value="{$SECRET_HASH}">
                                <table align='center'>
                                    <tr>
                                        <td style="text-align:right"><label class="control-label" for="password">{vtranslate('LBL_NEW_PASSWORD',$MODULE)}</label></td>
                                        <td><input type="password" id="password" name="password"></td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <td style="text-align:right"><label class="control-label" for="confirmPassword">{vtranslate('LBL_CONFIRM_PASSWORD',$MODULE)}</label></td>
                                        <td><input type="password" id="confirmPassword" name="confirmPassword"></td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <td></td>
                                        <td style="text-align:right"><input type="submit" id="btn" {**PVTPATCHER-AFB52953A4C9165B9BE8B6C0AC9CCD04-START-theme730**}
{** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:26 **}
value="{vtranslate('Submit', 'ParsVT')}"
{** REPLACED-AFB52953A4C9165B9BE8B6C0AC9CCD04// value="Submit"**}
{**PVTPATCHER-AFB52953A4C9165B9BE8B6C0AC9CCD04-FINISH**} onclick="return checkPassword();"/></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div id="footer">
                            <p></p>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                {else}
                    <div id="content">
                        {vtranslate('LBL_PASSWORD_LINK_EXPIRED_OR_INVALID_PASSWORD', $MODULE)}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>
</body>
</html>
