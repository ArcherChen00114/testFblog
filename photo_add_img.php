<?php

/* define passcode of web
 *   require include files
 *   require function files
 *    define SCRIPT
 *      page setting
 *      <html>
     *      require header
     *      input $html
     *      echo $html with <a>
     *      free resource
     *      pagging
 *      </html>
 */
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','photo_add_img');
if ($_COOKIE['username']){
    alertBack('illegal');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/photo_add_img.js" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>
<!--   -->
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="photo">
<h2>
upload picture
</h2>
<form method="post" action="?action=addimg">
<dl>
    <dd>picture name:<input type="text" name="name" class="text" /></dd>
    <dd>picture url:<input type="text" readonly="readonly" name="url" class="text" /><a href="javascript:;" id="up">upload</a></dd>
    <dd>picture description:<textarea name="content"></textarea></dd>
    <dd><input type="submit" value="add album" /></dd>
</dl>
</from>
</div>
<?php 

free($result);
paging(2);
?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>