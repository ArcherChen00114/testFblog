<?php


if (!defined('PWD')){
    exit('Access denied');
}//act like a passward, if has no pwd,it cant
//require other inc.php
if (PHP_VERSION <'4.1.0'){
    exit('PHP NEED UPDATE');
}
//connect to mysql server(localhost/pdm)
define('DB_USER','root');
define('DB_PWD','123456');
define('DB_HOST','localhost');
define('DB_NAME','testFblog');
//create database connection
require 'mysql.func.php';
require "includes/global.func.php";
connect();
set_names();
$starttime = runtime();


?>