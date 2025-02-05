<?php
require_once "include/utils/utils.php";
if (!class_exists("ParsVTCustomFunctions")) {
    class ParsVTCustomFunctions
    {
        public static $custom_functions = array(
            //Enter your function lists
            array(
                'module' => 'YourCustomModule', // Optional - if leave empty or comment this line, custom function use for all entity modules
                'label' => 'Your Function Label', // function label in workflows
                'path' => 'modules/ParsVT/handlers/ParsVTCustomFunction.php', //enter your function path
                'method' => 'YourCustomFuctionName' // enter your function name
            ),
        );

        public static function getFunctions() {
            return self::$custom_functions;
        }

    }
}
/**
 * @param $entity
 */
if (!function_exists('YourCustomFuctionName')) {
    function YourCustomFuctionName($entity)
    {
        global $adb;
        global $current_user;

    }
}
