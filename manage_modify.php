<?php
/*
 * 
 * 
 * add autograph and its switch into from 8/14 16:18
 * 
 */
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','member_modify');
//judge if it is a submit
if($_GET['action']=='modify'){    
    if (!empty($system['code'])){
    checkCode($_POST['code'], $_SESSION['code']);
    }
    
    if(!!$rows =fetch_array("SELECT
                                   tg_uniqid 
                             FROM 
                                   user 
                             WHERE 
                                  tg_username='{$_COOKIE['username']}'")){
    //compare unipid for safty
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
    $clean=array ();
    $clean['switch']=$_POST['switch'];
    $clean['autograph']=checkAutograph($_POST['autograph'],200);
    $clean['passWord']=checkModifyPassword($_POST['password'],6);
    $clean['sex']=$_POST['sex'];
    $clean['icon']=$_POST['icon'];
    $clean['email']=checkEmail($_POST['email'],6,40);
    $clean['QQ']=checkQQ($_POST['QQ']);
    }
    print_r($clean);
    //change info 
    if (empty($clean['password'])){

        query("UPDATE user SET
                                tg_sex='{$clean['sex']}',
                                tg_face='{$clean['icon']}',
                                tg_email='{$clean['email']}',
                                tg_qq='{$clean['QQ']}',
                                tg_switch='{$clean['switch']}',
                                tg_autograph='{$clean['autograph']}'
                           WHERE
                                tg_username='{$_COOKIE['username']}'"
        );
    }else {
        query(          "UPDATE 
                                user 
                            SET 
                              tg_switch='{$clean['switch']}',
                              tg_autograph='{$clean['autograph']}',
                              tg_password='{$clean['password']}',
                              tg_sex='{$clean['sex']}',
                              tg_face='{$clean['face']}',
                              tg_email='{$clean['email']}',
                              tg_qq='{$clean['QQ']}',
                              tg_switch='{$clean['switch']}',
                              tg_autograph='{$clean['autograpgh']}'
                         WHERE
                              tg_username='{$_COOKIE['username']}'"
                              );
    }
    if (affected_rows()==1){
        mysqli_close($conn);
//         session_destroy();
        location('congraduation, your modify successed','member.php');
    }else{
        mysqli_close($conn);
        location('sorry, nothing modified','member_modify.php');
    }
    
}
if (isset($_COOKIE['username'])){
    $rows=fetch_array("SELECT 
                                tg_switch,
                                tg_autograph,
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
    $html['switch']=htmls($rows['tg_switch']);
    $html['autograph']=htmls($rows['tg_autograph']);
    $html=htmls($html);
    //choose your icon
    $html['face_html']='<select name="icon">';
    foreach (range(1,9) as $num){
       $html['face_html'].='<option value="face/00'.$num.'.jpg">face/00'.$num.'.jpg</option>';
    }
    foreach (range(10,99) as $num){
        $html['face_html'].='<option value="face/0'.$num.'.jpg">face/0'.$num.'.jpg</option>';
    }
    $html['face_html'].='</select>';
    //switch of autograph
    if ($html['switch']==1){
       $html['switch_html']='<input type="radio" value="1" name="switch" checked="checked" />open <input type="radio" name="switch" value="0" />close</dd>';
    }  elseif ($html['switch']==0){
        $html['switch_html']='<input type="radio" value="1" name="switch" />open <input type="radio" name="switch" value="0" checked="checked" />close</dd>';
        
    }
    
    //choose your sex
    if ($html['sex']==m){
        $html['sex_html']='<input type="radio" name="sex" value="male" checked="checked" /> male <input type="radio" name="sex" value="female"/> female';
    }elseif ($html['sex']==f) {
        $html['sex_html']='<input type="radio" name="sex" value="male" /> male <input type="radio" name="sex" value="female" checked="checked" /> female';
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

<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/code.js"></script>
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
   <form method="post" action="member_modify.php?action=modify">
   <dl>
   <dd>username:<?php echo $html['username']?></dd>
   <dd>password:<input type="password" class="text" name="password">(empty means not change)</input></dd>
   <dd>sex:<?php echo $html['sex_html']?></dd>
   <dd>icon:<?php echo $html['face_html']?></dd>
   <dd>email:<input type="email" name="email" class="text" value="<?php echo $html['email']?>"/></dd>
   <dd>Q  Q:<input type="qq" name="QQ" class="text" value="<?php echo $html['qq']?>"/></dd>
   <dd>autograph:<?php echo $html['switch_html']?><p><textarea name="autograph"><?php echo $html['autograph']?></textarea></p>
   
            <?php if (!empty($system['code'])){?>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <?php }?>
            <dd><input type="submit" class="submit" value="changeinfo"/></dd>
   </dl>
   </form>
   </div>
</div>

<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>