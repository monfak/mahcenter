<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
	
include_once 'include/InventoryPDFController.php';

class Vtiger_QuotePDFController extends Vtiger_InventoryPDFController{
	function buildHeaderModelTitle() {
		$singularModuleNameKey = 'SINGLE_'.$this->moduleName;
		$translatedSingularModuleLabel = getTranslatedString($singularModuleNameKey, $this->moduleName);
		if($translatedSingularModuleLabel == $singularModuleNameKey) {
			$translatedSingularModuleLabel = getTranslatedString($this->moduleName, $this->moduleName);
		}
		return sprintf("%s: %s", $translatedSingularModuleLabel, $this->focusColumnValue('quote_no'));
	}

	function getWatermarkContent() {
		return $this->focusColumnValue('quotestatus');
	}

	function buildHeaderModelColumnRight() {
		$issueDateLabel = getTranslatedString('Issued Date', $this->moduleName);
		$validDateLabel = getTranslatedString('Valid Date', $this->moduleName);
		$billingAddressLabel = getTranslatedString('Billing Address', $this->moduleName);
		$shippingAddressLabel = getTranslatedString('Shipping Address', $this->moduleName);

		$modelColumn2 = array(
				'dates' => array(
/**PVTPATCHER-16C4516B8E1307D05BC5BC18DB3503A9-START-pdf**/
/** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:30:17 **/
$issueDateLabel  => $this->formatDate((!empty($this->focusColumnValue('duedate')) ?  date("Y-m-d", strtotime($this->focusColumnValue('duedate'))) : date("Y-m-d"))),
/** REPLACED-16C4516B8E1307D05BC5BC18DB3503A9// $issueDateLabel  => $this->formatDate(date("Y-m-d")),**/
/**PVTPATCHER-16C4516B8E1307D05BC5BC18DB3503A9-FINISH**/
					$validDateLabel => $this->formatDate($this->focusColumnValue('validtill')),
				),
				$billingAddressLabel  => $this->buildHeaderBillingAddress(),
				$shippingAddressLabel => $this->buildHeaderShippingAddress()
			);
		return $modelColumn2;
	}
}

?>