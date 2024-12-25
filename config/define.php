<?php
       ini_set('display_errors', 0);
       session_start();
       ini_set('max_execution_time', 0);
       set_time_limit(0);
       ini_set('memory_limit', -1);
       date_default_timezone_set('Asia/karachi');
       header('Cache-Control: public, max-age=3600');
       header('Vary: Accept-Encoding');
       header('Strict-Transport-Security: max-age=31536000');
       header('Access-Control-Allow-Origin: *');
       header("Access-Control-Allow-Headers: *");
       header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
       header('X-Response-Time: 0.5s');
       $BASE_URL = 'http://bgchecker_userpanel.test';
       // $BASE_URL = 'https://adminpanel.inmedsolution.com';
       $API_URL = $BASE_URL . '/api/';
       defined('BASE_URL') ? NULL : define('BASE_URL', $BASE_URL);
       defined('API_URL') ? NULL : define('API_URL', $API_URL);
