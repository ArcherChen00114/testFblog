<?php
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','active');
//judge if it is a submit
//activition
if (!$_GET['active']){
    exit('illegal');
}
if (isset($_GET['action'])&&isset($_GET['active'])&& $_GET['action']=='ok'){
   if(fetch_array("SELECT
                         tg_active 
                         FROM user 
                         WHERE tg_active='{$_GET['active']}'
                         LIMIT 1")){
       query("UPDATE user SET tg_active=NULL WHERE tg_active='{$_GET['active']}' LIMIT 1");
       if (affected_rows()==1){
           mysqli_close($conn);
           location('congraduation, your activition successed','login.php');
       }else{
           mysqli_close($conn);
           location('sorry, your activition failed','register.php');
       
       }
   }else{
       alertBack('illegal');
   }; 
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/register.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>
<!-- 其他文档头元素 -->
<title>active page</title>
</head>
<body>


<?php 
require 'includes/header.inc.php';
?>
<div id="active">
  <h2>user activation</h2>
  <p> this page used to imited active email, click this url to active
      your account</p>
  <p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
</div>
<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>