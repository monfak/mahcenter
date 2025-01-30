<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************/
require_once("include/events/SqlResultIterator.inc");
class VTExpressionsManager{
	function __construct($adb){
		$this->adb = $adb;
	}

	/** Caching logic **/
	private static $cache = array();
	static function addToCache($key, $value) {
		 self::$cache[$key] = $value;
	}
	static function fromCache($key) {
		if(isset(self::$cache[$key])) return self::$cache[$key];
		return false;
	}
	static function clearCache() {
		self::$cache = array();
	}
	/** END **/

	function fields($moduleName){
		global $current_user;
		$result = vtws_describe($moduleName, $current_user);
		$fields = $result['fields'];
		$arr = array();
		foreach($fields as $field){
			$arr[$field['name']] = $field['label'];
		}
		return $arr;
	}

	function expressionFunctions() {
		return array('concat' => 'concat(a,b)', 'time_diffdays(a,b)' => 'time_diffdays(a,b)', 'time_diffdays(a)' => 'time_diffdays(a)', 'time_diff(a,b)' => 'time_diff(a,b)','time_diff(a)' => 'time_diff(a)',
			'add_days' => 'add_days(datefield, noofdays)', 'sub_days' => 'sub_days(datefield, noofdays)', 'add_time(timefield, minutes)' => 'add_time(timefield, minutes)', 'sub_time(timefield, minutes)' => 'sub_time(timefield, minutes)',
/**PVTPATCHER-B6C72CA8B5452C478436E50AB290E295-START-vtexpressionevaluater**/
/** Don't remove the Start and Finish Markup! Modified: 2025-01-13 15:37:07 **/
'translate(string,module)'=>'translate(string,module)','convert_date_to_user_format(date)'=>'convert_date_to_user_format(date)','jalali_dateformat'=>'jalali_dateformat(date,format)','gregorian_dateformat'=>'gregorian_dateformat(date,format)','str_replace'=>'str_replace(find,replace,string)','number_format'=>'number_format(number,decimals,decimalpoint,separator)','number_to_words'=>'number_to_words(number)','persian_number_to_word'=>'persian_number_to_word(number)','persian_number_to_word_full'=>'persian_number_to_word_full(number)','getgroupname(id)'=>'getgroupname(id)','getusername(id)'=>'getusername(id)','get_owner(id)'=>'get_owner(id)','getuserfullname(id)'=>'getuserfullname(id)','getrecordlabel(id)'=>'getrecordlabel(id)','getuserfullnamebyids(ids)'=>'getuserfullnamebyids(ids)','striphtmltags(content)'=>'striphtmltags(content)','cityname(id)'=>'cityname(id)','makerandompassword'=>'makerandompassword()','makerandomnumber'=>'makerandomnumber(length)','url_shortener'=>'url_shortener(url,onetime,full,rewrite)','get_document_by_id'=>'get_document_by_id(crmid)','get_document_by_path'=>'get_document_by_path(filepath)','pdfmaker_link'=>'pdfmaker_link(id,templateid,language)',
/**PVTPATCHER-B6C72CA8B5452C478436E50AB290E295-FINISH**/
			'today' => "get_date('today')", 'tomorrow' => "get_date('tomorrow')",  'yesterday' => "get_date('yesterday')", 'power(base,exponential)' => "power(base,exponential)");
	}
}

?>