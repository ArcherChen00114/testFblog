<?php 
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','post');
//judge if it is a site
global $conn;
//have to login before post
if (!isset($_COOKIE['username'])){
    alertBack('please login');
}
    
if($_GET['action']=='post'){
    checkCode($_POST['code'], $_SESSION['code']);
    if(!!$rows =fetch_array("SELECT
                                    tg_uniqid
                               FROM
                                    user
                              WHERE
                                    tg_username='{$_COOKIE['username']}'")){
        //compare unipid for safty
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
    $clean=array();
    $clean['username']=$_COOKIE['username'];
    $clean['type']=$_POST['type'];
    $clean['title']=checkPostTitle($_POST['title'],2,40);
    $clean['content']=checkPostContent($_POST['content'],2);
    $clean=mysqli_string($clean);
    print_r($clean);
    query("INSERT INTO
                      article(
                              tg_username,
                              tg_title,
                              tg_type,
                              tg_content,
                              tg_date)
                        VALUES
                              (
                               '{$clean['username']}',
                               '{$clean['title']}',
                               '{$clean['type']}',
                               '{$clean['content']}',
                               NOW()
                              )");
    if (affected_rows()==1){
        $clean['id']=_insertID();
        mysqli_close($conn);
        session_destroy();
        location('congraduation, your post successed','article.php?id='.$clean['id']);
    }else{
        mysqli_close($conn);
        session_destroy();
        alertBack('your post failed');
         }
    }
}   
//could save in mysql, for confirmation of cookies
//MUST do this after submit, or uniqid will change
//make that uniqid id saved in session and 
// save it in $uniqid and give it to form's value
//or it will change and never equal, 
//if that value not equal then
// the form cant submit
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/post.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>
<!-- 鍏朵粬鏂囨。澶村厓绱� -->
<title>POST</title>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id='post'>
    <h2>
    POST
    </h2>
    <form method="post" action="post.php?action=post" name="post">
        <dl>
            <dt>请认真输出以下信息</dt>
            <dd>
              class:
              <?php foreach(range(1,12) as $num){
                  if ($num==1){
                  echo '<label for="type'.$num.'"> <input type="radio" id="type'.$num.'" name="type" value="'.$num.'"checked="checked" />';
                  }
                  else{
                  echo '<label for="type'.$num.'"> <input type="radio" id="type'.$num.'" name="type" value="'.$num.'" />';
                  }
                  echo '<img src="images/icon'.$num.'.gif" alt="class"/></label>';
                   if ($num==6){
                       echo '<br />   ';
                   }
                  }?>
            </dd>
            <dd>title:<input type="text" name="title" class="text"/>(*)</dd>
            <dd id="q">image: <a href:"javascript:;">image[1]</a> <a href:"javascript:;">image[2]</a> <a href:"javascript:;">image[3]</a></dd>
            <dd>
            <div id="ubb">
              <img src="" title="font size" alt="font size"/>
              <img src="" title="line" alt="line"/>
<!--   its too many of them and i have no pics, abort it till it
 is still practice     -->
            <div id="font">
               <strong onclick="font(10)">10px</strong>
               <strong onclick="font(12)">12px</strong>
               <strong onclick="font(14)">14px</strong>
               <strong onclick="font(16)">16px</strong>
               <strong onclick="font(18)">18px</strong>
               <strong onclick="font(20)">20px</strong>
               <strong onclick="font(22)">22px</strong>
               <strong onclick="font(24)">24px</strong>
            </div>
            <div id="color">
               <strong title="black" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="red" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="blue" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="green" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="orange" style="background:#000" onclick=“showcolor('#000')"></strong>
               <em><input type="text" name="t" value="#" /></em>
 
 
 <!--               that's too much color choose panel but i may not do it -->
            </div>
      </div>
<!--             we could pack those thing over that line
in ubb.inc.php-->
            <textarea name="content" rows="9" ></textarea> 
            </dd>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <dd><input type="submit" class="submit" value="post"/></dd>

        </dl>
    
    </form>

</div>


<?php 
require 'includes/footer.inc.php';
?>
</body>
</html>