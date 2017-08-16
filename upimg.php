<?php 
/*
 *   define PWD for file
 *   define SCRIPT
 *     require include file
 *     <html
 *       require JS to make window popup
 *       <?php require title include file ?>
 *       make a loop to show  pictures
 *     /html>
 */
define('PWD',537238);
define('SCRIPT','upimg');//use define to choose the title css this php
//will use
require 'includes/common.inc.php';

if(!$_COOKIE['username']){
    alertBack('illegal');
}

if ($_GET['action']='up'){
    if(!!$rows =fetch_array("SELECT
                                    tg_uniqid,
                                    tg_username
                                FROM
                                    user
                                WHERE
                                    tg_username='{$_COOKIE['username']}'")){
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
    //upload pics
    $files=array('image/jpeg','image/pjpeg','imgae/png','image/x-png','image/gif');
    if (is_array($files)){
        if(!in_array($_FILES['userfile']['type'], $files)){
        alertBack('only jpg,gif,png could upload');
        }
    }

    if ($_FILES['userfile']['error']>0){
        switch ($_FILES['uderfile']['error']){
            case 1:alertBack('upload file is too big');
            break;
            case 2:alertBack('upload file is too big');
            break;
            case 3:alertBack('part file was uploaded');
            break;
            case 4:alertBack('not file uploaded');
            break;
        }
        exit;
    }//define error
        if ($_FILES['userfile']['size']>1000000){
        alertBack('file could not excess max size 1M');
        }
        $name=$_POST['dir'].'/'.time().'.'.$n[1];
        $n=explode('.', $_FILES['userfile']['name']);
        
        if (is_uploaded_file($_FILES['username']['tmp_name'])){
            if (!@move_uploaded_file($_FILES['username']['tmp_name'], $name)){
                alertBack('move failed');
            }else {
//                 alertClose('upload success');
            echo "<secipt>alert('upload success');window.opener.document.getElementById('url').value='$name';window.close</script>";
            exit();
            }
        }else{
            alertBack('tmp file does not exist');
        }
        
    }
    
} else {
 alertBack('illegal');   
}
if (!isset($_GET['dir'])){
    alertBack('illegal');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/opener.js"></script>
<style type="text/css" media="all">
</style>
<!-- 其他文档头元素 -->
</head>
<body>

<div id="upimg" style="padding:20px;">
    <form enctype="multipart/form-data" action="upimg.php?action=up" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="hidden" name="dir" value="<?php echo $html['dir']?>" />
        choose picture:<input type="file" name="userfile" />
        <input type="submit" name="send" value="upload" />
    </form>
</div>




</body>
</html>