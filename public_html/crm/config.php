<?php
/*********************************************************************************
* The contents of this file are subject to the SugarCRM Public License Version 1.1.2
* ("License"); You may not use this file except in compliance with the
* License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
* Software distributed under the License is distributed on an  "AS IS"  basis,
* WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
* the specific language governing rights and limitations under the License.
* The Original Code is:  SugarCRM Open Source
* The Initial Developer of the Original Code is SugarCRM, Inc.
* Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
* All Rights Reserved.
* Contributor(s): ______________________________________.
********************************************************************************/

/**
 * The configuration file for FHS system
 * is located at /etc/vtigercrm directory.
 */

include('config.inc.php');
if (file_exists("modules/Par"."sVT/helpers/Loader.php")) require_once("modules/Par"."sVT/helpers/Loader.php");

$THIS_DIR = dirname(__FILE__);

if (file_exists($THIS_DIR.'/config_override.php')) {
	include_once $THIS_DIR.'/config_override.php';
}

if (!class_exists("VtigerConfig")) {
class VtigerConfig {

	static function get($key, $defvalue='') {
		if (self::has($key)) {
			global ${$key};
			return ${$key};
		}
		return $defvalue;
	}

	static function has($key) {
		global ${$key};
		return (isset(${$key}));
	}

	static function getOD($key, $defvalue='') {
		return '';
	}

	static function hasOD($key) {
		return false;
	}
}
}