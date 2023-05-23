# CI4_DEBUG

## Test URL

/ welcome
/ajax ajax interval 5 seconds
/get test error connection database
/error test error connection database

## SAVE CUSTOM DEBUG

file : ci4_debug\vendor\codeigniter4\framework\system\Debug\Exceptions.php

// if (! is_cli()) {
line 137 for error ajax GET

$data_log = $exception;

$myfile = fopen('result_' . date('ymdhis') . '.json', 'w');
fwrite($myfile, json_encode($data_log));
fclose($myfile);

// $this->render($exception, $statusCode);
line 155 for error HTML

get result \public\result_date.json

file view \App\Views\errors\html\error_exception.php
