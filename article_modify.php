<?php 
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/check.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','article_modify');
//judge if it is a site
global $conn;
//have to login before post
if (!isset($_COOKIE['username'])){
    alertBack('please login');
}
//modify
if($_GET['action']=='post'){
    if($_GET['action']=='post'){
        if(!!$rows =fetch_array("SELECT
            tg_uniqid
            FROM
            user
            WHERE
            tg_username='{$_COOKIE['username']}'")){
            //compare unipid for safty
        _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
        //modify start
        $clean=array();
        $clean['id']=$_POST['id'];
        $clean['type']=$_POST['type'];
        $clean['title']=checkPostTitle($_POST['title'],2,40);
        $clean['content']=checkPostContent($_POST['content'],2);
        $clean=mysqli_string($clean);
        query("UPDATE
                     article
                  SET
                     tg_type='{$clean['type']}',
                     tg_title='{$clean['title']}',
                     tg_content='{$clean['content']}',
                     tg_last_modifydate=NOW()
                WHERE
                     tg_id='{$clean['id']}'
                     ");
        if (affected_rows()==1){
            mysqli_close($conn);
//             session_destroy();
            location('congraduation, your change successed','article.php?id='.$clean['id']);
        }else{
            mysqli_close($conn);
//             session_destroy();
            alertBack('your change failed');
        }
        } else {
            alertBack('illegal');
        }
    }
    
    
    
}
//get info
if (isset($_GET['id'])){
    if(!!$rows=fetch_array("SELECT
                                    tg_username,
                                    tg_title,
                                    tg_type,
                                    tg_content
                            FROM
                                    article
                            WHERE
                                    tg_reid=0
                            AND
                                    tg_id='{$_GET['id']}'")){
                    $html=array();
                    $html['id']=$_GET['id'];
                    $html['username']=$rows['tg_username'];
                    $html['title']=$rows['tg_title'];
                    $html['type']=$rows['tg_type'];
                    $html['content']=$rows['tg_content'];
                    $html=htmls($html);
                    
             if(!$_COOKIE['usernmae']==$html['username']){
                 alertBack('you have no right to change this topic');
             }
                                    
    }else {
        alertBack('this data does not exist');
    }
}    else {
    alertBack('illegal');
    }



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
<title>Change Topic</title>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id='post'>
    <h2>
    POST
    </h2>
    <form method="post" action="?action=modify" name="post">
        <input type="hidden" value="<?php echo $html['id']?>" name="id" />
        <dl>
            <dt>请认真修改以下信息</dt>
            <dd>
              class:
              <?php foreach(range(1,12) as $num){
                  if ($num==$html['type']){
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
            <dd>title:<input type="text" name="title" value="<?php echo $html['title']?>" class="text"/>(*)</dd>
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
            <textarea name="content" rows="9" ><?php echo $html['content']?></textarea> 
            </dd>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <dd><input type="submit" class="submit" value="change"/></dd>

        </dl>
    
    </form>

</div>


<?php 
require 'includes/footer.inc.php';
?>
</body>
</html>