<?php

if (!function_exists('send_sms')) {
    /**
     * Send sms to a mobile.
     *
     * @return void
     */
    function send_sms($mobile, $parameters, $templateId = 124223) {
        $send = \Cryptommer\Smsir\Smsir::Send();
        foreach($parameters as $index => $value) {
            $params[] = new \Cryptommer\Smsir\Objects\Parameters($index, $value);
        }
        $send->Verify($mobile, $templateId, $params);
    }
}
