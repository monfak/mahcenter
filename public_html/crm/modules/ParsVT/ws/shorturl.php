<?php

global $site_URL;
require_once("../../../config.php");
require_once(__DIR__."/../V2/PBX/config.php");
$request = array();
$keys = array('m', 'v', 'r', 'p');
$unwanted_fields = array('module', 'view', 'action', 'record', '__vtrftk', 'PHPSESSID');
foreach ($_REQUEST as $key => $value) {
    if (in_array($key, $keys)) {
        switch ($key) {
            case "m":
                $request['module'] = $_REQUEST['m'];
                break;
            case "v":
                $request['view'] = $_REQUEST['v'];
                break;
            case "r":
                $request['record'] = $_REQUEST['r'];
                break;
            case "p":
                $request['phone'] = $_REQUEST['p'];
                break;
        }
        unset($_REQUEST[$key]);
    } elseif (in_array($key, $unwanted_fields)) {
        unset($_REQUEST[$key]);
    } else {
        $request[$key] = $value;
    }
}
$my_site = explode('modules/', $site_URL);
if (isset($request['url'])) {
    $url = (filter_var($request['url'], FILTER_VALIDATE_URL) ? $request['url'] : $my_site[0] . 'index.php');
} else {
    $url = (!empty($request) ? $my_site[0] . "index.php?" . http_build_query($request) : $my_site[0] . "index.php");
}
header("Location: " . $url);
exit;