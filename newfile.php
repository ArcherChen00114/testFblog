<?php 
define('PWD',537238);
define('SCRIPT','forlist');//use define to choose the title css this php
//will use
require 'includes/common.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<?php require 'includes/title.inc.php';?>
<style type="text/css" media="all">
</style>
<!-- 其他文档头元素 -->
<title>Test First Blog</title>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="list">
 <h2>list</h2>
</div>
<div id="user">
 <h2>new user</h2>
</div>
<div id="pics">
 <h2>new pics</h2>
</div>

<?php 
require'includes/footer.inc.php';

$endtime=runtime();

?>
</body>
</html>