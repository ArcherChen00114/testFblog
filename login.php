<?php

session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','login');
login_state();
if ($_GET['action']=='login'){
    global $conn;
    checkCode($_POST['code'], $_SESSION['code']);
    $clean=array ();
    $clean['userName']=checkUsername($_POST['username'],2,20);
    $clean['passWord']=checkPassword($_POST['password'],6);
    $clean['time']=check_time($_POST['time']);
    print_r($clean);//saved all info in array clean.
    if(!!$rows = fetch_array("SELECT tg_username,tg_uniqid FROM user WHERE tg_username='{$clean['userName']}' AND tg_password='{$clean['passWord']}'AND tg_active='' LIMIT 1 ")){
    echo 'log in';
    echo $rows[tg_username];
    echo $rows[tg_uniqid];
    mysqli_close($conn);
    session_destroy();
    cookies($rows[tg_username], $rows[tg_uniqid],$clean['time']);
    location(null, 'newfile.php');
    }else {
    mysqli_close($conn);
    session_destroy();
    location('wrong username or password or unactivted', 'login.php');
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>
<!--   -->
<title>login page</title>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="login">
  <h2>login</h2>
    <form method="post" action="login.php?action=login" name="login">
        <dl>
            <dt>登录信息</dt>
            <dd>username:<input type="text" name="username" class="text"/></dd>
            <dd>password:<input type="password" name="password" class="text"/></dd>
            <dd>staytime:<input type="radio" name="time" value="0" checked="checked"/>dontsave<input type="radio" name="time" value="1" checked="checked"/>one day<input type="radio" name="time" value="2" checked="checked"/>one week</dd>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <dd><input type="submit" class="button location" value="register" id="location"/></dd>
            <dd><input type="submit" class="button" value="login"/></dd>
            
            </dl>
        </form>
  </div>
<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>