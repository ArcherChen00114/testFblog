<?php
/*
 * 0.7 make the code producer be avaliable
 * 0.8 will make submit be avaliable ****we are here now not finished yet
 * 2017/7/20
 * 0.9 filter illegal username
 *     deal with password
 * 1.0 make QQ/email confirmation (mysqli_real need be used after 
 *     connected the database)
 *     <Passwordhint and passwordanswer can be same, need to deal with）
 *     connect to MYSQL server
 * 1.1 create MYsql database
 *     add user list
 *     upload data to database 7/24 11:31
 *     will make sure user will not have same username
 *     //may need to make password to md5 to make it safe
 *     /**
 *     Bug list:1.function sha1Uniqid() does not work, in register.fun.php
 *     line127_)——————
 *     2. function checkEmail have problem, we have add a new
 *     $clean['email']= $_post['email] to make it works or 
 *     $clean['eamil'] will be null, but it may be next problem.
 *     /
 */
?>