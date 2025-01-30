<?php
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
include "modules/Emails/mail.php";
echo "This is an example crontab for send test email...".PHP_EOL;
global $HELPDESK_SUPPORT_NAME, $HELPDESK_SUPPORT_EMAIL_ID;
$outgoingserver =  new Settings_Vtiger_OutgoingServer_Model;
$mail_status = send_mail("Users",$HELPDESK_SUPPORT_EMAIL_ID, $HELPDESK_SUPPORT_NAME,$HELPDESK_SUPPORT_EMAIL_ID,$outgoingserver->getSubject(),$outgoingserver->getBody(),"","","","","",true);
if($mail_status != 1 ) {
    echo "Error occurred while sending mail".PHP_EOL;
} 
