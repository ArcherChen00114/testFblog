<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','manage');
//judge if it is a submit
manage_login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>

</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="member">
<?php require 'includes/manage.inc.php'?>
   <div id="member_main">
   <h2>
   administriter manage center
   </h2>
   <dl>
   <dd>SERVER NAME:<?php echo $_SERVER['SERVER_NAME']?></dd>
   <dd>SERVER VERSION:<?php echo $_ENV['OS']?></dd>
   <dd>SERVER IP:<?php echo $_SERVER['SERVER_ADDR']?></dd>
   <dd>LOCAL IP:<?php echo $_SERVER['SERVER_ADDR']?></dd>
   <dd>SERVER PORT:<?php echo $_SERVER['SERVER_PORT']?></dd>
   <dd>LOCAL PORT:<?php echo $_SERVER['REMOTE_PORT']?></dd>
   <dd>ADMIN EMAIL:<?php echo $_SERVER['SERVER_ADMIN']?></dd>
   </dl>
   </div>
</div>

<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>