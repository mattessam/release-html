<?php
// connect to database
$db_hostname = 'localhost';
$db_database = 'a200429031';
$db_username = 'a200429031';
$db_password = 'paparoach1';
$db_status = 'not initialised';
$str_result = '';
$str_options = 'Option list creation failed';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
$db_status = "connected";

?>