<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class SMSNotifier_SMSDOTIRNew_Provider implements SMSNotifier_ISMSProvider_Model
{
    private $userName;
    private $password;
    private $parameters = array();

    const SERVICE_URI = 'https://api.sms.ir/v1/send';
    private static $REQUIRED_PARAMETERS = array('from' , 'ApiKey');

    /**
     * Function to get provider name
     * @return <String> provider name
     */
    public function getName()
    {
        return 'SMSDOTIRNew';
    }

    /**
     * Function to get required parameters other than (userName, password)
     * @return <array> required parameters list
     */
    public function getRequiredParams()
    {
        return self::$REQUIRED_PARAMETERS;
    }

    /**
     * Function to get service URL to use for a given type
     * @param <String> $type like SEND, PING, QUERY
     */
    public function getServiceURL($type = false)
    {
        return self::SERVICE_URI;
    }

    /**
     * Function to set authentication parameters
     * @param <String> $userName
     * @param <String> $password
     */
    public function setAuthParameters($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * Function to set non-auth parameter.
     * @param <String> $key
     * @param <String> $value
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Function to get parameter value
     * @param <String> $key
     * @param <String> $defaultValue
     * @return <String> value/$default value
     */
    public function getParameter($key, $defaultValue = false)
    {
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        }
        return $defaultValue;
    }

    /**
     * Function to prepare parameters
     * @return <Array> parameters
     */
    protected function prepareParameters()
    {
        $params = array('user' => $this->userName, 'pwd' => $this->password);
        foreach (self::$REQUIRED_PARAMETERS as $key) {
            $params[$key] = $this->getParameter($key);
        }
        return $params;
    }

    /**
     * Function to check json string
     * @return <Boolean>
     */
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Function to handle SMS Send operation
     * @param <String> $message
     * @param <Mixed> $toNumbers One or Array of numbers
     */
    public function send($message, $toNumbers)
    {
        if (!is_array($toNumbers)) {
            $toNumbers = array($toNumbers);
        }
        $params = $this->prepareParameters();
        $ApiKey = $params['ApiKey'];

        $Param = array(
            "username" => $params['user'],
            "mobile"   => implode(',' , $toNumbers),
            "line"     => $params['from'],
            "text"     => urlencode($message),
        );


        $responses = $this->SendREST($Param , $ApiKey);
        $error = false;
        $results = array();
        for ($x = 0; $x < count($toNumbers); $x++) {
            if ($responses['status'] != 1) {
                $result['error'] = true;
                $result['to'] = $toNumbers[$x];
                $result['status'] = 'Failed';
                $result['ErrorCode'] = $responses['status'];
                $result['statusmessage'] = 'ErrorCode: ' . $responses['message']; // Complete error message
            } else {
                $result['id'] = $responses['messageId'];
                $result['to'] = $toNumbers[$x];
                $result['status'] = 'Processing';
                $result['statusmessage'] = 'Processing';
            }
            $results[] = $result;
        }
        return $results;
    }

    /**
     * Function to get query for status using messgae id
     * @param <Number> $messageId
     */
    public function query($messageId)
    {
        $error = false;
        $result = array();
        $result['statusmessage'] = "Delivery Web Service Not working on 100SMS.IR";
        $result['id'] = $messageId;
        $result['status'] = 'Processing';
        $result['needlookup'] = 0;
        return $result;
    }


    /**
     * Function to send rest request
     * @param <Text> result
     */
    public function SendREST($parameters , $api_key)
    {
        $URL  = self::getServiceURL();
        //die($URL.'?username='.$parameters['username'].'&password='.$api_key.'&mobile='.$parameters['mobile'].'&line='.$parameters['line'].'&text='.$parameters['text'] );
        $curl = curl_init();
        curl_setopt_array($curl , array(
            CURLOPT_URL => $URL.'?username='.$parameters['username'].'&password='.$api_key.'&mobile='.$parameters['mobile'].'&line='.$parameters['line'].'&text='.$parameters['text'] ,
            CURLOPT_RETURNTRANSFER => true ,
            CURLOPT_ENCODING => '' ,
            CURLOPT_MAXREDIRS => 10 ,
            CURLOPT_TIMEOUT => 0 ,
            CURLOPT_FOLLOWLOCATION => true ,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1 ,
            CURLOPT_CUSTOMREQUEST => 'GET' ,
            CURLOPT_HTTPHEADER => array(
                'Accept: text/plain' ,
                'X-API-KEY: '.$api_key
            ) ,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return  json_decode($response, true);
    }
}