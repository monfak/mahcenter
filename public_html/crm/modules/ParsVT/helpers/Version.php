<?php
/* * *******************************************************************************
 * The content of this file is subject to the ParsVT Module license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTfarsi.ir are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
class ParsVT_Version_Helper {

    public static $version = '7.2.1';
    public static $patch = '14030728';
    public static $ic = '5.6';

    public static function getVersion()
    {
        return self::$version;
    }
    
    public static function getPatch()
    {
        return self::$patch;
    }
    
    public static function getIC()
    {
        return self::$ic;
    }
}