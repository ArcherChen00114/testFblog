<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','blog');
//get info from sql as array
if (isset($_GET['page'])){
    $page=$_GET['page'];
    if(empty($page)||$page<0||!is_numeric($page)){
        $page=1;
    }else{
        $page=intval($page);
    }
    //what if the url change to strange thing, make
    //this web hard to make error
    //1.page should not smaller than 0
    //2. it should be number
    //3.it shuold not be empty
    //4.larger than max page
}else {
    $page=1;
}
$num = num_rows(query("SELECT tg_id FROM user"));
$pagesize=10;//set size;
$pagenumber=($page-1)*10;
if ($num==0){
    $pageabsolute=1;
}else{
    $pageabsolute=ceil($page/$pagesize);
}
if ($page>$pageabsolute){
    $page=$pageabsolute;
}
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
<h2>
blog friendlist
</h2>
<?php  while(!!$rows=fetch_array_list($result))
//rows[0]=username,[1]=sex,[2]=icon;
//fetch_array will read info from sql AGAIN!,need to read the info array
//
{?>
// <?php 
// for ($i=10;$i<30;$i++){
// ?>
<dl>
   <dd class='user'> <?php echo $rows[0];?>(<?php echo $rows[1];?>) </dd>
   <dt> <img src="face/<?php echo $rows[2]; ?>.jpg" alt="log1024" /></dt>
   <dd class='message'>message</dd>
   <dd class='friend'>add friend</dd>
   <dd class='mail'>mail</dd>
   <dd class='gift'>gift</dd>
 <?php }?>
 <div id="page_num">
   <ul>
       <?php for ($i=0;$i<$pagenumber;$i++){
       if ($page==$i){
           echo '<li><a href="blog.php?page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
       }
       else{
       echo '<li><a href="blog.php?page='.($i+1).'">'.($i+1).'</a></li>';
        }
}?>
   </ul>
 </div>
</dl>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>