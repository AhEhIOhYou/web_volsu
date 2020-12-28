<?php

function my_log($string){
    $log_file_name = $_SERVER['DOCUMENT_ROOT']."/log.txt";
    $now = date("Y-m-d H:i:s");
    file_put_contents($log_file_name, $now." ".$string."\r\n", FILE_APPEND);
}

?>