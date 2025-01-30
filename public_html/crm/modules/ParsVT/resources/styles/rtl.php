<?php
error_reporting(0);
chdir(dirname(__FILE__) . "/../../../../");
if (file_exists("vendor/autoload.php")) {
    include_once "config.php";
    require_once "vendor/autoload.php";
}

include_once "include/utils/VtlibUtils.php";
include_once "includes/Loader.php";
include_once "vtlib/Vtiger/Module.php";
include_once "includes/runtime/EntryPoint.php";
require_once "vtigerversion.php";
error_reporting(0);
$rtl_languages = ["fa_ir", "fa_af", "ar_ae", "ar_sa", "ar_dz", "ar_eg", "ar_ma", "ar_om", "he_il", "ur_pk", "ku_iq", "ps"];
Vtiger_Session::init();
global $site_URL, $vtiger_current_version;
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: text/css; charset=utf-8");
header("Content-disposition: inline; filename=rtl.css");
$rtl = "/* RTL Style is Not required or authorized to run in your account */\n\n";
global $current_user;
if (!$current_user) {
    $current_user = new Users();
    if (isset($_SESSION["authenticated_user_id"])) {
        $current_user->retrieveCurrentUserInfoFromFile($_SESSION["authenticated_user_id"], "Users");
    } else {
        die("/* RTL Style is Not required or authorized to run in your account */\n\n");
    }
}
//$moduleName = "ParsVT";
//$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
//$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
//if (!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
//    echo "//" . vtranslate("LBL_NOT_ACCESSIBLE");
//    exit();
//}
if (!in_array($current_user->language, $rtl_languages)) {
    $rtl = "/* RTL Style is Not required or authorized to run in your account */\n";
    if (file_exists("modules/ParsVT/resources/styles/ltr.css")) {
        $rtl .= '@import "ltr.css?ver=' . $vtiger_current_version . '" screen, projection, print;';
    }
    if (isset($current_user->parsvt_darkmode) && $current_user->parsvt_darkmode == 1) {
        $rtl .= 'html {filter: invert(1) hue-rotate(180deg);}' . "\n";
    }
    echo $rtl;
    exit();
}
if (isset($current_user->parsvt_font)) {
    $fontname = $current_user->parsvt_font;
} else {
    $fontname = "IRANSans";
}
//$oBrowser = new ParsVT_Browser_Helper();
//$csscomment = "/* Generated on " . date("Y/m/d H:i") . " for VtigerCRM v" . $vtiger_current_version . " on " . $_SERVER["HTTP_HOST"] . " */\n";
$csscomment = "/*+**********************************************************************************
 * The contents of this file are subject to the ParsVT CRM Commercial License
 * (\"License\"); You may not use this file except in compliance with the License
 * The Initial Developer of the Code is ParsVT.
 * All Rights Reserved. Copyright (C) ParsVT.com.
 ************************************************************************************/\n";
//if ($oBrowser->Detect()->isDetected()) {
//    $csscomment .= "/* Browser: " . $oBrowser->getBrowser() . " - Version: " . $oBrowser->getVersion() . " */\n";
//    $browserversion = $oBrowser->getVersion();
//    $browserversion = explode(".", $browserversion);
//    $asafariversion = substr($browserversion[0], 0);
//} else {
//    $csscomment .= "Unknown Browser";
//    $browserversion = "";
//}
echo $csscomment;
$app = "MARKETING";
if (!isset($_SERVER["HTTP_REFERER"])) {
    $_SERVER["HTTP_REFERER"] = $site_URL;
}
$vtigerversion = substr($vtiger_current_version, 0, 1);
$cssversion = md5($vtigerversion);
$uri = parse_url($_SERVER["HTTP_REFERER"]);
if (!empty($uri["query"])) {
    parse_str($uri["query"], $output);
    if (isset($output["app"])) {
        $app = $output["app"];
    }
}
$domain2 = str_replace("www.", "", strtolower($uri["host"]));
if (isset($_SERVER["SERVER_NAME"])) {
    $domain = strtolower($_SERVER["SERVER_NAME"]);
} elseif (isset($_SERVER["HTTP_HOST"])) {
    $domain = explode(":", strtolower($_SERVER["HTTP_HOST"]));
    $domain = $domain[0];
}
//patch 13980121
$domain = str_replace("www.", "", $domain);
if ($domain == $domain2) {
    $rtl = '@import "fonts/fonts.php?ver=' . $vtiger_current_version . "&font=" . $fontname . '" screen, projection, print;' . "\n";
    if (file_exists("modules/ParsVT/resources/styles/css/" . $fontname . ".css")) {
        $rtl .= '@import "css/' . $fontname . ".css?ver=" . $vtiger_current_version . '" screen, projection, print;' . "\n";
    }
    $rtl .= '@import "css/' . $cssversion . ".css?ver=" . $vtiger_current_version . '" screen, projection, print;' . "\n";
    $rtl .= '@import "custom' . ($vtigerversion != 8 ? "" : $vtigerversion) . ".css?ver=" . $vtiger_current_version . '" screen, projection, print;' . "\n";
    //if ($vtigerversion == 8) {
        $linkcolor = "EF5E29";
        switch (strtolower($app)) {
            case "marketing":
                $linkcolor = "EF5E29";
                break;
            case "sales":
                $linkcolor = "3CB878";
                break;
            case "support":
                $linkcolor = "6297C3";
                break;
            case "project":
                $linkcolor = "8E44AD";
                break;
            case "inventory":
                $linkcolor = "F1C40F";
                break;
            default:
                $linkcolor = "EF5E29";
        }
        $rtl .= ':root {--primary-link-color: #' . $linkcolor . ';}' . "\n";
        //$rtl .= '@import "appcolor.php?ver=' . $vtiger_current_version . '&app=' . $app . '" screen, projection, print;'."\n";
    //}
    if (isset($current_user->parsvt_darkmode) && $current_user->parsvt_darkmode == 1) {
        $rtl .= 'html {filter: invert(1) hue-rotate(180deg);}' . "\n";
    }
} else {
    $rtl = "// Error (400): Missing css file";
}
echo $rtl;
?>
