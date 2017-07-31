<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','blog');
//get info from sql as array
//first element is query,second element means how many users per page
global $pagesize,$pagenumber;
page("SELECT tg_id FROM user",15);
global $conn;
$result=query("SELECT tg_username,tg_sex,tg_face FROM user ORDER BY tg_register_date DESC LIMIT $pagenumber,$pagesize;");
//limit get info
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>
<!--   -->
<title>blog page</title>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="blog">
<?php 
while(!!$rows=fetch_array($result)){
    $html=array();
    $html['username']=htmls($rows['tg_username']);
    $html['sex']=htmls($rows['tg_sex']);
    $html['face']=htmls($rows['tg_face']);
    $html['email']=htmls($rows['tg_email']);
    $html['QQ']=htmls($rows['tg_qq']);
    $html['register_date']=htmls($rows['tg_register_date']);
    $html=htmls($html);
}?>
<h2>
blog friendlist
</h2>
<?php  while(!!$rows=fetch_array_list($result))
//rows[0]=username,[1]=sex,[2]=icon;
//fetch_array will read info from sql AGAIN!,need to read the info array
//
{?> <?php 
// for ($i=10;$i<30;$i++){
// ?>
<dl>
   <dd class='user'> <?php echo $html['username'];?>(<?php echo $html['sex'];?>) </dd>
   <dt> <img src="<?php echo $html['face']; ?>" alt="log1024" /></dt>
   <dd class='message'>message</dd>
   <dd class='friend'>add friend</dd>
   <dd class='mail'>mail</dd>
   <dd class='gift'>gift</dd>
 <?php }?>
</dl>
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