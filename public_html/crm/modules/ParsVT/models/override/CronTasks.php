<?php
$custom_crons =  array(
    array(
            'name' => 'Sample Crontab',
            'description' => 'Recommended frequency for Scheduling is 15 min',
            'handler_file' => 'Sample.php',  //must be inside modules/ParsVT/crontabs/
            'frequency' => 900,
            'module' => 'ParsVT',
        ) ,
    array(
            'name' => 'Example Crontab',
            'description' => 'Recommended frequency for Scheduling is 24 hours',
            'handler_file' => 'your_custom_path/Example.php',
            'frequency' => 84600,
        ) ,
)
;
