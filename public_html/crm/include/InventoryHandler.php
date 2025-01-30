<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

function handleInventoryProductRel($entity){
	require_once("include/utils/InventoryUtils.php");
/**PVTPATCHER-93B6D8F221F9A825DB65306D39468240-START-ws**/
/** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:30:38 **/
global $inventoryEntity, $transferRecordsOwnership;
	if ($transferRecordsOwnership) return false;
	$inventoryEntity = $entity;
/**PVTPATCHER-93B6D8F221F9A825DB65306D39468240-FINISH**/
	updateInventoryProductRel($entity);
}

?>