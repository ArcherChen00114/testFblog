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
global $conn;
//define a variable to decide which css it should choose
define('SCRIPT','photo_show');
//delete a photo
if ($_GET['action']=='delete'&& isset($_GET['id'])){
    // cause it is delete should make sure you want to do that
    if (!!$rows=fetch_array("SELECT
                                    tg_uniqid
                                FROM
                                    user
                                WHERE
                                    tg_username='{$_COOKIE['username']}'
                                LIMIT 1")){
                     uniqid($rows['tg_uniqid'],$_COOKIE['uniqid']);
                     
                     if (!!$rows=fetch_array("SELECT
                                                     tg_username,
                                                     tg_url,
                                                     tg_id,
                                                     tg_sid
                                                 FROM
                                                     photo
                                                 WHERE
                                                     tg_id='{$_GET['id']}'
                                                 LIMIT 1")){     
                                 $html=array();
                                 $html['username']=$rows['tg_username'];
                                 $html['id']=$rows['tg_id'];
                                 $html['url']=$rows['tg_url'];
                                 $html['sid']=$rows['tg_sid'];
                                 $html=htmls($html);
                         if ($rows['username']==$_COOKIE['username']||isset($_SESSION['admin'])){
                             query("DELETE FROM 
                                                photo
                                          WHERE
                                                tg_id='{$_GET['id']}'
                                          LIMIT 1
                                 ") ;
                             if (affected_rows()==1){
                                 if (file_exists($html['url'])){
                                  unlink($html['url']);
                                 }else {
                                  alertBack('this photo does not exist');
                                }
                                 mysqli_close($conn);
                                location('delete success', 'photo_show.php?id='.$html['sid'].'');
                             }
                                else{
                                 mysqli_close($conn);
                                 //         session_destroy();
                                 alertBack('delete failed');
                             }
                             
                             
                         } else {
                             alertBack('illegal');
                         }                            
                     }else {
                         alertBack('this photo does not exist');
                     }
                     
                     
                     
                     
                     
    } else {    //uniqid incorrect then alert illegal
    alertBack('illegal');}
    
}

//limit get info
if (isset($_GET['id'])){
    if (!!$rows=fetch_array("SELECT
                                    tg_id,
                                    tg_name,
                                    tg_type
                               FROM
                                    dir
                               WHERE
                                    tg_id='{$_GET['id']}'
                               LIMIT 1")){
        $html=array();
        $html['dirid']=$rows['tg_id'];
        $html['dirname']=$rows['tg_name'];
        $html['dirtype']=$rows['tg_type'];
        $html=htmls($html);
        //password model
        if ($_POST['password']){
            if (!!$rows=fetch_array("SELECT
                                            tg_id
                                     FROM
                                            dir
                                    WHERE
                                            tg_password='".sha1($_POST['password'])."'
                                    LIMIT 1")){
                                 setcookie('photo'.$html['dirid'],$html['dirname']);   
                                 location(null,'photo_show.php?id='.$html['dirid'].'');
            }else {
                alertBack('album password not correct');
            }
        }
        
        
        
        
        
    }else {
        alertBack('this album does not exist');
    }
}else {
    alertBack('illegal');
}
global $pagesize,$pagenumber,$system,$id;
$id=$html['id'].'&';
page("SELECT tg_id FROM photo WHERE tg_sid='{$html['dirid']}'",$system['photo']);

$result=query("SELECT
                    tg_id,
                    tg_username,
                    tg_name,
                    tg_readcount,
                    tg_commentcount,
                    tg_url
                FROM
                    photo
                WHERE
                    tg_sid='{$html['dirid']}'
            ORDER BY
                    tg_date DESC
                LIMIT $pagenumber,$pagesize;");

$filename='face/001.jpg';
$percent=0.3;
    
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
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="photo">
<h2>
<?php echo $html['dirname']?>
</h2>

<?php 
if(empty($html['dirtype'])||$_COOKIE['photo'.$html['dirid']]==$html['dirname']||isset($_SESSION['admin'])){

$html=array();
while(!!$rows=fetch_array_list($result))
{
    $html['id']=$rows['tg_id'];
    $html['username']=$rows['tg_username'];
    $html['name']=$rows['tg_name'];
    $html['readcount']=$rows['tg_readcount'];
    $html['commentcount']=$rows['tg_commentcount'];
    $html['url']=$rows['tg_url'];
    $html=htmls($html);?>
<dl>
    <dt><a href="photo_detail.php?id=<?php echo $html['id']?>"><img src="thumb.php?filename=<?php echo $html['url']?>&percent=<?php echo $percent?>"></img></a></dt>
    <dd><a href="photo_detail.php?id=<?php echo $html['id']?>"><?php echo $html['id']?></a></dd>
    <dd>read(<strong><?php echo $html['readcount']?></strong>) comment(<strong><?php echo $html['commentcount'] ?></strong>) uploader:<?php echo $html['username']?></dd>
    <?php if ($html['username']==$_COOKIE['username']||isset($_SESSION['admin'])){?>
    <dd>[<a href="photo+show.php?action=delete&id=<?php echo $html['id']?>">delete</a>]</dd>
    <?php }?>
</dl>
<?php }
paging(2);
?>
<p><a href="photo_add_img.php?id=<?php echo $html['dirid']?>">upload picture</a></p>


<?php 
}else {
    echo'<form method="post" action="photo_show.php?id='.$html['dirid'].'">';
    echo'<p>enter password:<input type="text" name="password" /><input type="submit" value="confirm" /></p>';
    echo '</form>';
}?>
</div>


<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>