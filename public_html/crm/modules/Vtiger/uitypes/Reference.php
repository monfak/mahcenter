<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_Reference_UIType extends Vtiger_Base_UIType {

	/**
	 * Function to get the Template name for the current UI Type object
	 * @return <String> - Template Name
	 */
	public function getTemplateName() {
		return 'uitypes/Reference.tpl';
	}

	/**
	 * Function to get the Display Value, for the current field type with given DB Insert Value
	 * @param <Object> $value
	 * @return <Object>
	 */
	public function getReferenceModule($value) {
		$fieldModel = $this->get('field');
		$referenceModuleList = $fieldModel->getReferenceList();
		$referenceEntityType = getSalesEntityType($value);
		if(in_array($referenceEntityType, $referenceModuleList)) {
			return Vtiger_Module_Model::getInstance($referenceEntityType);
		} elseif (in_array('Users', $referenceModuleList)) {
			return Vtiger_Module_Model::getInstance('Users');
		}
		return null;
	}

	/**
	 * Function to get the display value in detail view
	 * @param <Integer> crmid of record
	 * @return <String>
	 */
	public function getDisplayValue($value, $record=false, $recordInstance=false) {
		$referenceModule = $this->getReferenceModule($value);
/**PVTPATCHER-9814CF85464B21A423E2E53F677A8313-START-advcf**/
/** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:30:23 **/
$fieldModel = $this->get('field');
              if (strpos(strtolower($fieldModel->getName()), 'rf_pcf_mrf') !== false && $referenceModule && !empty($value)) {
                  $unformattedArgs = func_get_args();
                  if (isset($unformattedArgs[1]) && !empty($unformattedArgs[1])) {
                      if (method_exists('ParsVT_MultiReference_Helper', 'getDisplayValue')) {
                          return ParsVT_MultiReference_Helper::getDisplayValue($unformattedArgs[1], $fieldModel->getId());
                      }
                  }
              }
/**PVTPATCHER-9814CF85464B21A423E2E53F677A8313-FINISH**/
		if($referenceModule && !empty($value)) {
			$referenceModuleName = $referenceModule->get('name');
			if($referenceModuleName == 'Users') {
				$db = PearDatabase::getInstance();
				$nameResult = $db->pquery('SELECT first_name, last_name FROM vtiger_users WHERE id = ?', array($value));
				if($db->num_rows($nameResult)) {
					return $db->query_result($nameResult, 0, 'first_name').' '.$db->query_result($nameResult, 0, 'last_name');
				}
			} else {
				$fieldModel = $this->get('field');
				$entityNames = getEntityName($referenceModuleName, array($value));
				$linkValue = "<a href='index.php?module=$referenceModuleName&view=".$referenceModule->getDetailViewName()."&record=$value'
							title='".vtranslate($referenceModuleName, $referenceModuleName).":". $entityNames[$value] ."' "
							. "data-original-title='".vtranslate($referenceModuleName, $referenceModuleName)."'>$entityNames[$value]</a>";
				return $linkValue;
			}
		}
		return '';
	}

	/**
	 * Function to get the display value in edit view
	 * @param reference record id
	 * @return link
	 */
	public function getEditViewDisplayValue($value) {
		$referenceModule = $this->getReferenceModule($value);
		if($referenceModule) {
			$referenceModuleName = $referenceModule->get('name');
			$entityNames = getEntityName($referenceModuleName, array($value));
			return $entityNames[$value];
		}
		return '';
	}

	public function getListSearchTemplateName() {
		$fieldModel = $this->get('field');
		if($fieldModel->get('uitype') == '52' || $fieldModel->get('uitype') == '77'){
			return 'uitypes/OwnerFieldSearchView.tpl';
		}
		return parent::getListSearchTemplateName();
	}

}