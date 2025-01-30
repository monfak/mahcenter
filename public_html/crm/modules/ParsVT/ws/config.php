<?php
/*Last Changed on 2025-01-16 10:22:05 by admin*/
#log web service calls 
$log_api_request = false;
#for check Token Expire Time in Webservice
$expirationTimeout = 3605; // (in seconds)
#get free api from here https://ocr.space/OCRAPI
$ocr_apikey = '01c15b00ab88957';
#caller id lookup source modules
$cid_lookup_modules = array (
   'Contacts',
   'Accounts',
   'Leads',
);
#allow anonymous download on GetFile method in rest2
$allow_anonymous_download = false;
?>