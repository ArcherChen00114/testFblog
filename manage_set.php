<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','manage_set');
//judge if it is a submit
manage_login();
if ($_GET['action']=='set'){
    if(!!$rows =fetch_array("SELECT
                                    tg_uniqid
                                FROM
                                    user
                                WHERE
                                    tg_username='{$_COOKIE['username']}'")){
        _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
        $clean=array();
        $clean['webname']=$_POST['webname'];
        $clean['article']=$_POST['article'];
        $clean['blog']=$_POST['blog'];
        $clean['photo']=$_POST['photo'];
        $clean['skin']=$_POST['skin'];
        $clean['banstring']=$_POST['banstring'];
        $clean['post']=$_POST['post'];
        $clean['code']=$_POST['code'];
        $clean['re']=$_POST['re'];
        $clean['register']=$_POST['register'];
        $clean=mysqli_string($clean);
        
        query("UPDATE
                    system
                 SET 
                    tg_webname='{$clean['webname']}',
                    tg_article='{$clean['article']}',
                    tg_blog='{$clean['blog']}',
                    tg_photo='{$clean['photo']}',
                    tg_skin='{$clean['skin']}',
                    tg_banstring='{$clean['banstring']}',
                    tg_post='{$clean['post']}',
                    tg_code='{$clean['code']}',
                    tg_register='{$clean['register']}'
               WHERE
                    tg_id=1
               LIMIT
                    1"); 
        if (affected_rows()==1){
            mysqli_close($conn);
            //         session_destroy();
            location('congraduation, your modify successed','manage_set.php');
        }else{
            mysqli_close($conn);
            location('sorry, nothing modified','manage_set.php');
        }
    }else{
        alertBack('error');
    }
}

   if(!!$rows=fetch_array("SELECT
                                tg_webname,
                                tg_article,
                                tg_blog,
                                tg_photo,
                                tg_skin,
                                tg_banstring,
                                tg_post,
                                tg_re,
                                tg_code,
                                tg_register
                                
                            FROM
                                system
                           WHERE
                                tg_id=1
                           LIMIT 1"
                            ))
   {//this part used to get and set deault state of every section
       
                                $html=array();
                                $html['webname']=$rows['tg_webname'];
                                $html['article']=$rows['tg_article'];
                                $html['blog']=$rows['tg_blog'];
                                $html['photo']=$rows['tg_photo'];
                                $html['skin']=$rows['tg_skin'];
                                $html['banstring']=$rows['tg_banstring'];
                                $html['post']=$rows['tg_post'];
                                $html['re']=$rows['tg_re'];
                                $html['code']=$rows['tg_code'];
                                $html['register']=$rows['tg_register'];
                                $html=htmls($html);
                                
                                if($html['article']==10){
                                    $html['article_html']='<select name="article"><option value="10" selected="selected">10 articles every page</option><option value="15">15 articles every page</option></select>';
                                }elseif($html['article']==15) {
                                    $html['article_html']='<select name="article"><option value="10">10 articles every page</option><option value="15" selected="selected">15 articles every page</option></select>';
                                }
                                
                                if($html['blog']==10){
                                    $html['blog_html']='<select name="blog"><option value="10" selected="selected">10 blogs every page</option><option value="15">15 blogs every page</option></select>';
                                }elseif($html['blog']==15) {
                                    $html['blog_html']='<select name="blog"><option value="10">10 blogs every page</option><option value="15" selected="selected">15 blogs every page</option></select>';
                                }
                                
                                if($html['photo']==8){
                                    $html['photo_html']='<select name="photo"><option value="8" selected="selected">8 photoes every page</option><option value="12">12 photoes every page</option></select>';
                                }elseif($html['photo']==12) {
                                    $html['photo_html']='<select name="photo"><option value="8">8 photoes every page</option><option value="12" selected="selected">12 photoes every page</option></select>';
                                }
                                
                                if($html['skin']==1){
                                    $html['skin_html']='<select name="skin"><option value="1" selected="selected">skin1</option><option value="2">skin2</option><option value="3">skin3</option></select>';
                                }elseif($html['skin']==2) {
                                    $html['skin_html']='<select name="skin"><option value="1">skin1</option><option value="2" selected="selected">skin2</option><option value="3">skin3</option></select>';
                                }elseif($html['skin']==3) {
                                    $html['skin_html']='<select name="skin"><option value="1">skin1</option><option value="2">skin2</option><option value="3" selected="selected">skin3</option></select>';
                                }
                                
                                if($html['post']==30){ 
                                    $html['post_html']='<input type="radio" name="post" value="30" checked="checked" /> 30seconds <input type="radio" name="post" value="60" /> 60seconds <input type="radio" name="post" value="90" /> 90seconds';
                                }elseif($html['post']==60){
                                    $html['post_html']='<input type="radio" name="post" value="30" /> 30seconds <input type="radio" name="post" value="60" checked="checked"/> 60seconds <input type="radio" name="post" value="90" /> 90seconds';
                                }elseif($html['post']==90){
                                    $html['post_html']='<input type="radio" name="post" value="30" /> 30seconds <input type="radio" name="post" value="60" /> 60seconds <input type="radio" name="post" value="90" checked="checked"/> 90seconds';
                                }                                
                                
                                if($html['re']==15){
                                    $html['re_html']='<input type="radio" name="re" value="15" checked="checked" /> 15seconds <input type="radio" name="re" value="30" /> 30seconds <input type="radio" name="re" value="45" /> 45seconds';
                                }
                                elseif($html['re']==30){
                                    $html['re_html']='<input type="radio" name="re" value="15" /> 15seconds <input type="radio" name="re" value="30" checked="checked"/> 30seconds <input type="radio" name="re" value="45" /> 45seconds';
                                }
                                elseif($html['re']==45){
                                    $html['re_html']='<input type="radio" name="re" value="15" /> 15seconds <input type="radio" name="re" value="30" /> 30seconds <input type="radio" name="re" value="45" checked="checked"/> 45seconds';
                                }
                                
                                if($html['code']==1){
                                    $html['code_html']='<input type="radio" name="code" value="1" checked="checked" /> open <input type="radio" name="code" value="0" /> close';
                                }else{
                                    $html['code_html']='<input type="radio" name="code" value="1" /> open <input type="radio" name="code" value="0" checked="checked" /> close';
                                    
                                }
                                
                                if($html['register']==1){
                                    $html['register_html']='<input type="radio" name="register" value="1" checked="checked" /> open <input type="radio" name="register" value="0" /> close';
                                }else{
                                    $html['register_html']='<input type="radio" name="register" value="1" /> open <input type="radio" name="register" value="0" checked="checked" /> close';
                                
                                }
                                
                                
                                
                                    
                       }else{
                           alertBack('error');
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
<?php require 'includes/manage.inc.php'?>
   <div id="member_main">
   <h2>
   administriter manage center
   </h2>
   <form method="post" action="?action=set">
   <dl>
   <dd>WEB NAME:<input type="text" name="webname" class="text" value="<?php echo $html['webname']?>" /></dd>
   <dd>ARTICLES PER PAGE:<?php echo $html['article_html']?></dd>
   <dd>BLOGS PER PAGE:<?php echo $html['blog_html']?></dd>
   <dd>PICS PER PAGE:<?php echo $html['photo_html']?></dd>
   <dd>DEFAULT SKIN:<?php echo $html['skin_html']?></dd>
   <dd>BANSTRING:<input type="text" name="banstring" class="text" value="<?php echo $html['banstring']?>" />(please use "|" to divide words)</dd>
   <dd>POST TIMELIMIT:<?php echo $html['post_html']?></dd>
   <dd>REPLY TIMELIMIT:<?php echo $html['re_html']?></dd>
   <dd>CODE USING:<?php echo $html['code_html']?></dd>
   <dd>REGISTER ALLOWED:<?php echo $html['register_html']?></dd>
   <dd><input type="submit" value="change system setting" class="submit"/></dd>
   </dl>
   </form>
   </div>
</div>

<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>