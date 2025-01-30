<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$output = [];
$return_var = 0;
$projectDir = "/home/mahcenter/libs";

$command = "cd $projectDir &&git push origin master  2>&1";
exec($command, $output, $return_var);
echo "Commit Output: <pre>" . implode("\n", $output) . "</pre>";
echo "Commit Return Code: $return_var<br>";

?>