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
define('SCRIPT','photo');
global $system;
global $pagesize,$pagenumber,$conn;

if($_GET['action']=='delete'&&isset($_GET['id'])){
    if (!!$rows=fetch_array("SELECT
            tg_uniqid
        FROM
            user
        WHERE
            tg_username='{$_COOKIE['username']}'
        LIMIT 1")){
        uniqid($rows['tg_uniqid'],$_COOKIE['uniqid']);
        if (!!$rows=fetch_array("SELECT
                                        tg_dir
                                    FROM
                                        dir
                                    WHERE
                                        tg_id='{$_GET['id']}'
                                    LIMIT 1")){
                                    $html=array();
                                    $html['dir']=$rows['tg_dir'];
                                    $html=htmls($html);
                                   
                                    if (file_exists($html['dir'])){
                                        if(rmdir($html['dir'])){
                                            if (removeDir($html['dir'])){
                                         query("DELETE FROM
                                                            photo
                                                         WHERE
                                                tg_sid='{$_GET['id']}'");
                                         query("DELETE FROM
                                                            dir
                                                    WHERE
                                                            tg_id='{$_GET['id']}'");
                                            mysqli_close($conn);
                                            location('album deleted');
                                        } else {
                                            mysqli_close($conn);
                                            alertBack('album not deleted');
                                        }
                                    }
                                  }
                                }else {alertBack('this direction does not exist');}
                                    
                                    
    }  else {alertBack('illegal');}
        } 

        page("SELECT tg_id FROM dir ",$system['photo']);
if (isset($_GET['delete'])){
    if(isset($_SESSION['admin']) && isset($_COOKIE['username'])){
    query("DELETE
                               FROM
                                    dir
                               WHERE
                                    tg_id='{$_GET['id']}'
                               LIMIT 1
        ");
    }
}
$result=query("SELECT
                        tg_id,
                        tg_name,
                        tg_type,
                        tg_face
                    FROM
                        dir
                ORDER BY
                        tg_date
                    DESC
                        LIMIT
    $pagenumber,$pagesize;");
//limit get info
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
photo list
</h2>
    <?php 
        $html=array(); 
    while(!!$rows=fetch_array_list($result))
    {
        $html['id']=$rows['tg_id'];
        $html['name']=htmls($rows['tg_name']);
        $html['type']=htmls($rows['tg_type']);
        $html['face']=$rows['tg_face'];
        if(empty($html['type'])){
            $html['type_html']='(public)';
        }else{
            $html['type_html']='(private)';
        }
        $html=htmls($html);
        if (empty($html['face'])){
            $html['face_html']='';
        }else {
            $html['face_html']='<img src="'.$html['face'].'" alt="'.$html['tg_name'].'"/>';
        }
        
        $html['photo']=fetch_array("SELECT 
                                COUNT(*)
                            AS
                                count 
                          FROM    
                                photo
                         WHERE
                                tg_sid='{$html['id']}'
                                        ");
        ?> 
<dl>
    <dt><img><a href="photo_show.php?id=<?php echo $html['id']?>"><?php echo $html['face_html']?></a></img></dt>
    <dd><a href="photo_show.php?id=<?php echo $html['id']?>"><?php echo $html['name']?><?php echo $html['type_html']?><?php echo "[".$html['photo']['count']."]"?></a></dd>
            <?php if(isset($_SESSION['admin']) && isset($_COOKIE['username'])){
            ?>
                <dd>[<a href="photo_modify_dir.php?id=<?php echo $html['id']?>">modify</a>] [<a href="photo.php?action=delete&id=<?php echo $html['id']?>">delete</a>]</dd>
            <?php }?>
    </dl>
            <?php if(isset($_SESSION['admin']) && isset($_COOKIE['username'])){
            ?>
            <p><a href="photo_add_dir.php">add new photo direction</a></p>
            <?php }?>
<dl>
    <?php }?>

   <dd class='user'> <?php echo $html['username'];?>(<?php echo $html['sex'];?>) </dd>
   <dt> <img src="<?php echo $html['face']; ?>" alt="log1024" /></dt>
   <dd class='message'><a href='javascript:;' name="message" title=<?php echo $html['id']?>>message</a></dd>
   <dd class='friend'><a href='javascript:;' name="friend" title=<?php echo $html['id']?>>add friend</a></dd>
   <dd class='mail'>mail</dd>
   <dd class='gift'><a href='javascript:;' name="gift" title=<?php echo $html['id']?>>gift</a></dd>
</dl>
<?php 

paging(2);
?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>