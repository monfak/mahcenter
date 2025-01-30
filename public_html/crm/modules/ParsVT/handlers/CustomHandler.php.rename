<?php
require_once 'data/VTEntityDelta.php';
include_once "include/Webservices/Utils.php";
class ParsVTCustomHandler extends VTEventHandler {

    function handleEvent($eventName, $data) {
        global $adb;
        if (gettype($data) == 'object' && get_class($data) == 'VTEntityData') {
            $moduleName = $data->getModuleName();
            $entityData = $data->getData();
            $record = $data->getId();
            $isNew = $data->isNew();
        } else if (gettype($data) == 'object' &&  $data instanceof Vtiger_Record_Model){
            $moduleName = $data->getModule()->name;
            $entityData = $data->getData();
            $record = $data->getId();
        } else if (gettype($data) == 'array'){
            $entityData = $data;
        }
        if ($eventName == 'vtiger.entity.beforesave') {
            if ($moduleName == 'Modulename') {

            }
//            if ($moduleName == 'Quotes') {
//                $info = ParsVT_Inventory_Helper::getInventoryInfoByRequest($record);
//                echo '<pre>';
//                print_r($info);
//                die;
//            }
        }
        if ($eventName == 'vtiger.entity.beforesave.modifiable') {
            if ($moduleName == 'Modulename') {

            }
        }
        if ($eventName == 'vtiger.entity.beforesave.final') {
            if ($moduleName == 'Modulename') {

            }
        }
        if ($eventName == 'vtiger.entity.aftersave') {
            if ($moduleName == 'Modulename') {

            }
        }
        if ($eventName == 'vtiger.entity.aftersave.final') {
            if ($moduleName == 'Modulename') {

            }
//            if ($moduleName == 'Quotes') {
//                $info = ParsVT_Inventory_Helper::getInventoryInfoByID($record);
//                echo '<pre>';
//                print_r($info);
//                die;
//            }
        }
        if($eventName === 'vtiger.batchevent.save'){
            if ($moduleName == 'Modulename') {

            }
        }
        if ($eventName == 'vtiger.entity.beforedelete') {
            if ($moduleName == 'Modulename') {

            }
        }
        if ($eventName == 'vtiger.entity.afterdelete') {
            if ($moduleName == 'Modulename') {

            }
        }
        if($eventName === 'vtiger.batchevent.delete'){
            if ($moduleName == 'Modulename') {

            }
        }
        if($eventName === 'vtiger.entity.afterrestore'){

        }

        if($eventName === 'vtiger.lead.convertlead'){
            if ($moduleName == 'Leads') {
                //$convertedEntityIdsInfo = $data->entityIds;
                //$transferRelatedRecordsTo = $data->transferRelatedRecordsTo;

            }
        }
        if($eventName === 'vtiger.picklist.afterrename'){
            //$data['newvalue']
            //$data['oldvalue']

        }
        if($eventName === 'vtiger.picklist.afterdelete'){
            //$data['replacevalue']
            //$data['valuetodelete']
        }

        //Extra ParsVT Handlers
        if($eventName === 'vtiger.after.portal.enabled'){

        }
        if($eventName === 'vtiger.after.first.user.login'){

        }
        if($eventName === 'vtiger.users.after.login'){

        }
        if($eventName === 'vtiger.users.logout'){

        }
        if($eventName === 'vtiger.users.after.changepassword'){

        }
        if($eventName === 'vtiger.users.after.changeaccesskey'){

        }
        if($eventName === 'vtiger.webform.after.save'){

        }
        if($eventName === 'vtiger.entity.beforerelate'){

        }
        if($eventName === 'vtiger.entity.afterrelate'){

        }
        if($eventName === 'vtiger.module.enabled'){

        }
        if($eventName === 'vtiger.module.disabled'){

        }
        if($eventName === 'vtiger.module.postinstall'){

        }
        if($eventName === 'vtiger.module.preuninstall'){

        }
        if($eventName === 'vtiger.module.preupdate'){

        }
        if($eventName === 'vtiger.module.postupdate'){

        }
        if($eventName === 'vtiger.entity.tagadd'){

        }
        if($eventName === 'vtiger.entity.record.delete'){

        }
        if($eventName === 'vtiger.filter.beforesave'){

        }
        if($eventName === 'vtiger.filter.aftersave'){

        }
        if($eventName === 'vtiger.filter.beforedelete'){

        }
        if($eventName === 'vtiger.filter.afterdelete'){

        }
        if($eventName === 'vtiger.entity.list.delete'){

        }
        if($eventName === 'vtiger.emailtemplates.beforesave'){

        }
        if($eventName === 'vtiger.emailtemplates.aftersave'){

        }
        if($eventName === 'vtiger.entity.detail.view'){

        }
        if($eventName === 'vtiger.entity.edit.view'){

        }
        if($eventName === 'vtiger.entity.list.view'){

        }
    }
}

