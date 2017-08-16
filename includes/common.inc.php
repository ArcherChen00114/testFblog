<?php
/*                          set database login infor
 *                          check php version
 *                          check PWD
 *                          require common function
 *                          connect to server
 *                          use function to calculate time
 *                          show how many messages not read yet
 *                                                  
 */

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
require "includes/title.inc.php";
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
                              tg_state=0
                           AND
                              tg_touser='{$_COOKIE['username']}'
                              ");
if(empty($message['count'])){
    $message_html='<strong class="noread">(0)</strong>';
}else{
    $message_html='<strong class="read">('.$message['count'].')</strong>';
}

   if(!!$rows=fetch_array("SELECT
                                tg_webname,
                                tg_article,
                                tg_blog,
                                tg_photo,
                                tg_skin,
                                tg_banstring,
                                tg_post,
                                tg_re,
                                tg_code,
                                tg_register
                            FROM
                                system
                           WHERE
                                tg_id=1
                           LIMIT 1"
                            )){
       $system=array();
       $system['webname']=$rows['tg_webname'];
       $system['article']=$rows['tg_article'];
       $system['blog']=$rows['tg_blog'];
       $system['photo']=$rows['tg_photo'];
       $system['skin']=$rows['tg_skin'];
       $system['post']=$rows['tg_post'];
       $system['re']=$rows['tg_re'];
       $system['code']=$rows['tg_code'];
       $system['register']=$rows['tg_register'];
       $system['banstring']=$rows['tg_banstring'];
       $system=htmls($system);
       global $system;
       
   }else {
       alertBack('databse system error');
   }


?>