<?php

$operations = array(
    'get_record_label' => array('get_record_label', 'modules/ParsVT/handlers/CustomAPIs.php', 'vtws_get_record_label', 'GET'), //modules/ParsVT/ws/API/V2/vtiger/extended/get_record_label?record=12x1900
   // 'custom_method_name' => array('custom_method_name', 'modules/ParsVT/handlers/CustomAPIs.php', 'vtws_custom_method_function', 'GET'), //GET or POST
);
$operations_parameters = array(
    'get_record_label' => array(
        array('record', 'string', 1),
    ),
    /*
    'custom_method_name' => array(
        array('param1', 'string', 1),
        array('param2', 'encoded', 2),
        array('param3', 'boolean', 3),
    ),
    */
);
