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
//短信提醒
$message = fetch_array("SELECT 
                                          COUNT(tg_id) 
                                        AS 
                                          count 
                                      FROM 
                                          message 
                                     WHERE 
                                          tg_state=0");
if(empty($message['count'])){
    $message_html='<strong class="noread">(0)</strong>';
}else{
    $message_html='<strong class="read">('.$message['count'].')</strong>';
}

?>