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
global $conn;
if ($_COOKIE['username']){
    alertBack('illegal');
}
if($_GET['action']='addimg'){
    if (!!$rows=fetch_array("SELECT
                                    tg_id
                                FROM
                                    user
                                WHERE
                                    tg_id='{$_GET['id']}'
                                LIMIT 1")){
    uniqid($rows['tg_uniqid'],$_COOKIE['uniqid']);
    $clean=array();
    $clean['name']=checkDirName($_POST['name']);
    $clean['url']=checkURL($_POST['url']);
    $clean['content']=$_POST['content'];
    $clean['sid']=$_POST['sid'];
    $clean=mysqli_string($clean);
    
    query("INSERT INTO
                        photo(
                                tg_name,
                                tg_url,
                                tg_content,
                                tg_sid,
                                tg_date,
                                tg_username
                                )
                 VALUES(
                        '{$clean['name']}',
                        '{$clean['url']}',
                        '{$clean['content']}',
                        '{$clean['sid']}',
                        NOW(),
                        '{$_COOKIE['username']}'
                        )
                ");
    if (affected_rows()==1){
        mysqli_close($conn);
        session_destroy();
        location('you retired',SCRIPT.'.php');
    }else{
        mysqli_close($conn);
        location('pic added', 'photo_show.php?'.$clean['sid'].'');
    
    }
    }else {
        alertBack('illegal');
    }
}


if (isset($_GET['id'])){
    if (!!$rows=fetch_array("SELECT
                                    tg_id,
                                    tg_dir
                                FROM
                                    dir
                                WHERE
                                    tg_id='{$_GET['id']}'
                             LIMIT 1")){
        $html=array();
        $html['id']=$rows['tg_id'];
        $html['dir']=$rows['tg_dir'];
        $html=htmls($html);
    }else {
        alertBack('this album does not exist');
    }
}else {
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
<form method="post" action="?action=addimg" name="up">
<input type="hidden" name="side" value="<?php echo $html['id']?>" />
<dl>
    <dd>picture name:<input type="text" name="name" class="text" /></dd>
    <dd>picture url:<input type="text" id="url" readonly="readonly" name="url" class="text" /><a href="javascript:;" title="<?php echo $html['dir']?>" id="up">upload</a></dd>
    <dd>picture description:<textarea name="content"></textarea></dd>
    <dd><input type="submit" value="add album" /></dd>
</dl>
</form>
</div>
<?php 

paging(2);
?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>