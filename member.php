<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','member');
//judge if it is a submit
if (isset($_COOKIE['username'])){
    $rows=fetch_array("SELECT 
                             tg_username,
                             tg_sex,
                             tg_face,
                             tg_email,
                             tg_qq,
                             tg_level,
                             tg_register_date
                      FROM 
                             user 
                      WHERE 
                             tg_username='{$_COOKIE['username']}'");
if($rows){
    $html=array();
    $html['username']=htmls($rows['tg_username']);
    $html['sex']=htmls($rows['tg_sex']);
    $html['face']=htmls($rows['tg_face']);
    $html['email']=htmls($rows['tg_email']);
    $html['QQ']=htmls($rows['tg_qq']);
    $html['register_date']=htmls($rows['tg_register_date']);
    $html=htmls($html);
    
    switch($rows['tg_level']){
        case 0:
        $html['level']="normal account";
        break;
        case1:
        $html['level']='administer';
        break;
        default:
        $html['level']='error';
    }
}else{
    alertBack('this account does not exist');
     }
}
else {
    alertBack('illeagal login');
}
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
<?php require 'includes/member.inc.php'?>
   <div id="member_main">
   <h2>
   account manage center
   </h2>
   <dl>
   <dd>username:<?php echo $html['username']?></dd>
   <dd>sex:<?php echo $html['sex']?></dd>
   <dd>icon:<?php echo $html['face']?></dd>
   <dd>email:<?php echo $html['email']?></dd>
   <dd>Q  Q:<?php echo $html['QQ']?></dd>
   <dd>register time:<?php echo $html['register_date']?></dd>
   <dd>level:<?php echo $html['level']?></dd>
   </dl>
   </div>
</div>

<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>