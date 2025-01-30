<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Commercial License
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Code is vtiger.
 * All Rights Reserved. Copyright (C) vtiger.
 ************************************************************************************/
class ParsVT_V2_Public_Network extends ParsVT_Api_Operation
{


    protected function any(ParsVT_Api_Request $request, $user)
    {

        $operation = $request->getType();
        $operation = strtolower($operation);
        if (!$user) $user = VTWS_PreserveGlobal::getGlobal('current_user');
        switch ($operation) {
            case "whatsmyip":
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                  $IP = $_SERVER['HTTP_CLIENT_IP'];
                } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                  $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                  $IP = $_SERVER['REMOTE_ADDR'];
                }
                return $IP;
                break;
            default:
                return "Nothing to do on this action";
                break;
        }
    }

    public function get(ParsVT_Api_Request $request, $user)
    {
        return $this->any($request, $user);
    }

    public function post(ParsVT_Api_Request $request, $user)
    {
        return $this->any($request, $user);
    }
}
