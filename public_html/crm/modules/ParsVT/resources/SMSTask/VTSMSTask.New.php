<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

require_once('modules/com_vtiger_workflow/VTEntityCache.inc');
require_once('modules/com_vtiger_workflow/VTWorkflowUtils.php');
require_once('modules/com_vtiger_workflow/VTSimpleTemplate.inc');

require_once('modules/SMSNotifier/SMSNotifier.php');

class VTSMSTask extends VTTask {
	public $executeImmediately = true; 
	
	public function getFieldNames(){
		return array('content', 'sms_recepient');
	}
	
	public function doTask($entity){
		if(SMSNotifier::checkServer()) {
			global $adb, $current_user,$log;
			$util = new VTWorkflowUtils();
			$admin = $util->adminUser();
			$ws_id = $entity->getId();
			$entityCache = new VTEntityCache($admin);

			$et = new VTSimpleTemplate($this->sms_recepient);
			$recepient = $et->render($entityCache, $ws_id);
			$recepients = explode(',',$recepient);
			$relatedIds = $this->getRelatedIdsFromTemplate($this->sms_recepient, $entityCache, $ws_id);
			$relatedIds = explode(',', $relatedIds);
			$relatedIdsArray = array();
			foreach ($relatedIds as $entityId) {
				if (!empty($entityId)) {
					list($moduleId, $recordId) = vtws_getIdComponents($entityId);
					if (!empty($recordId)) {
						$relatedIdsArray[] = $recordId;
					}
				}
			}

			$ct = new VTSimpleTemplate($this->content);
			$content = $ct->render($entityCache, $ws_id);
			$relatedCRMid = substr($ws_id, stripos($ws_id, 'x')+1);
			$relatedIdsArray[] = $relatedCRMid;
			$relatedModule = $entity->getModuleName();
			/** Pickup only non-empty numbers */
			$tonumbers = array();
			foreach($recepients as $tonumber) {
				if(!empty($tonumber)) $tonumbers[] = $tonumber;
			}

            $workflowModel = Settings_Workflows_Record_Model::getInstance($this->workflowId);
            $check = method_exists('ParsVT_SMSQueue_Helper', 'checkSMSSchduler') ? ParsVT_SMSQueue_Helper::checkSMSSchduler() : false;
            if ($check && $workflowModel && $workflowModel->get('execution_condition') == 6 ) {
                $params = array(
                    'workflow_id' => $this->workflowId,
                    'task_id' => $this->id,
                    'modulename' => $workflowModel->get('module_name'),
                    'message' => $content,
                    'user_id' => $current_user->id,
                    'numbers' => json_encode($tonumbers),
                    'records' => json_encode($relatedIdsArray),
                    'workflow' => json_encode(array(
                        'id' => $this->workflowId,
                        'name' => $workflowModel->get('name'),
                        'executionCondition' => $workflowModel->get('execution_condition'),
                        'filtersavedinnew' => $workflowModel->get('filtersavedinnew'),
                        'schtypeid' => $workflowModel->get('schtypeid'),
                        'schtime' => $workflowModel->get('schtime'),
                        'schdayofmonth' => $workflowModel->get('schdayofmonth'),
                        'schdayofweek' => $workflowModel->get('schdayofweek'),
                        'schmonth' => $workflowModel->get('schmonth'),
                        'schannualdates' => $workflowModel->get('schannualdates'),
                        //'nexttrigger_time' => $workflowModel->get('nexttrigger_time'),
                        'workflowStatus' => $workflowModel->get('status'),
                    )),
                );
                $where = '';
                $params2 = array();
                foreach ($params as $key => $value) {
                    $params2[] = $value;
                    if ($key == 'workflow' || $key == 'message') continue;
                    $where .= $key. " = '". $value ."' AND ";
                }
                $query = 'SELECT id, date FROM parsvt_sms_workflowtask_queue WHERE '.$where.' deleted <> 1 limit 1';
                $result = $adb->pquery($query, array());
                if ($adb->num_rows($result) > 0) {
                    $row = $adb->fetchByAssoc($result);
                    $current_id = $row['id'];
                    $datetime = $row['date'];
                    $timestamp = strtotime($datetime);
                    $diffsec = false;
                    switch ($workflowModel->get('schtypeid')) {
                        case '1': //hourly
                            $diffsec = 3600;
                            break;
                        case '2': //daily
                            $diffsec = 84600;
                            break;
                        case '3':
                            $diffsec = 84600 * 7;
                            break;
                        case '3':
                            $diffsec = 84600 * 7;
                            break;
                        case '4':
                        case '5':
                        case '6':
                        case '7':
                            $diffsec = 84600;
                            break;
                    }
                    if (isset($diffsec) && $diffsec > 0) {
                        if ((time()  - $timestamp) < $diffsec){
                            return false;
                        }
                    }
                }
                $params2[] = 0;
                $params2[] = date("Y-m-d H:i:s");
                $query = "INSERT INTO  parsvt_sms_workflowtask_queue (workflowid, taskid, modulename, message, user_id, numbers, records, workflow, deleted, date) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $adb->pquery($query , $params2);
            } else {
                $this->smsNotifierId = SMSNotifier::sendsms($content, $tonumbers, $current_user->id, $relatedIdsArray);
            }
			$util->revertUser();
		}
		
	}

	public function getRelatedIdsFromTemplate($template, $entityCache, $entityId) {
		$this->template = $template;
		$this->cache = $entityCache;
		$this->parent = $this->cache->forId($entityId);
		return preg_replace_callback('/\\$(\w+|\((\w+) : \(([_\w]+)\) (\w+)\))/', array($this,"matchHandler"), $this->template);
	}

    public function matchHandler($match)
    {
        preg_match('/\((\w+) : \(([_\w]+)\) (\w+)\)/', $match[1], $matches);
        // If parent is empty then we can't do any thing here
        if (!empty($this->parent)) {
            if (self::php7_count($matches) != 0) {
                list($full, $referenceField, $referenceModule, $fieldname) = $matches;
                $referenceId = $this->parent->get($referenceField);
                if ($referenceModule === "Users" || $referenceId == null) {
                    $result = "";
                } else {
                    $result = $referenceId;
                }
            }
        }
        return $result;
    }


    public static function php7_count($value)
    {
        // PHP 8.x does not like count(null) or count(string)
        return is_null($value) || !is_array($value) ? 0 : count($value);
    }

}
?>