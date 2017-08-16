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
define('SCRIPT','photo_add_dir');
manage_login();
global $conn;
if ($_GET['action'=='modify']){
    if(!!$rows =fetch_array("SELECT
                                    tg_uniqid,
                                    tg_username
                                FROM
                                    user
                                WHERE
                                    tg_username='{$_COOKIE['username']}'
                               LIMIT 1")){
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
      $clean=array();
      $clean['id']=$_POST['id'];
      $clean['name']=checkDirName($_POST['name'], 2, 20);
      $clean['type']=$_POST['type'];
      if(!empty($clean['type'])){
          $clean['password']=checkDirPassword($_POST['password'], 6);
      }
      $clean['face']=$_POST['face'];
      $clean['content']=$_POST['content'];
      $clean=mysqli_string($clean);
      if (empty($clean['type'])){
       query("UPDATE 
                    dir
                SET
                    tg_name='{$clean['name']}',
                    tg_type='{$clean['type']}',
                    tg_password=NULL,
                    tg_face='{$clean['face']}',
                    tg_content='{$clean['content']}'
            WHERE
                    tg_id='{$clean['id']}'
            LIMIT   1");     
      } elseif ($_POST['password']==null) {
          query("UPDATE
                      dir
                  SET
                      tg_name='{$clean['name']}',
                      tg_type='{$clean['type']}',
                      tg_face='{$clean['face']}',
                      tg_content='{$clean['content']}'
                  WHERE
                        tg_id='{$clean['id']}'
                LIMIT   1");
      } else {
          query("UPDATE
                          dir
                    SET
                          tg_name='{$clean['name']}',
                          tg_type='{$clean['type']}',
                          tg_password='{$clean['password']}',
                          tg_face='{$clean['face']}',
                          tg_content='{$clean['content']}'
                  WHERE
                          tg_id='{$clean['id']}'
                  LIMIT   1");
      }
      if (affected_rows()==1){
          mysqli_close($conn);
          //         session_destroy();
          location('direction modified','photo.php');
      }else{
          mysqli_close($conn);
          //         session_destroy();
          alertBack('direction modify failed');}
      }
      
    
} else {
    alertBack('illegal');
}

if (isset($_GET['id'])){
    if (!!$rows=fetch_array("SELECT
                                    tg_id,
                                    tg_name,
                                    tg_type,
                                    tg_face
                                FROM
                                    dir
                                WHERE
                                    tg_id='{$_GET['id']}'
                                LIMIT 1
                                ")){
        $html=array();
        $html['id']=$rows['tg_id'];
        $html['name']=htmls($rows['tg_name']);
        $html['type']=htmls($rows['tg_type']);
        $html['face']=$rows['tg_face'];
        $html=htmls($html);
        
    }else {
        alertBack('this album does not exist');
    }
} else {
    alertBack('illegal');
}
//limit get info
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/photo_add_dir.js" ></script>
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
modify album
</h2>
<form method="post" action="?action=modify">
<dl>
    <dd>album name:<input type="text" name="name" class="text" value="<?php echo $html['name']?>" /></dd>
    <dd>album type:<input type="radio" name="type" value="0" <?php if ($html['type']==0) echo 'checked="checked"'?> id="public" /><label for="public">public</label><input type="radio" name="type" value="1"<?php if ($html['type']==1) echo 'checked="checked"'?> id="private" /><label for="private">private</label></dd>
    <dd id="pass" <?php if($html['type']==1) echo 'style="display:block"'?>>album password:<input type="password" name="password" class="text" /></dd>
    <dd>album face:<input type="text" value="<?php echo $html['face'] ?>" name="face" class="text" />(an url)</dd>
    <dd>album description:<textarea name="content"><?php echo $html['content']?></textarea></dd>
    <dd><input type="submit" value="modify album" /></dd>
</dl>
<input type="hidden" value="<?php echo $html['id'] ?>" name="id" />
</from>
</div>
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