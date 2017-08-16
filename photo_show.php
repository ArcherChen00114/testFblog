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
define('SCRIPT','photo_show');
//limit get info
if (isset($_GET['id'])){
    if (!!$rows=fetch_array("SELECT
                                    tg_id
                               FROM
                                    dir
                               WHERE
                                    tg_id='{$_GET['id']}'
                               LIMIT 1")){
        $html=array();
        $html['id']=$rows['tg_id'];
        $html=htmls($html);
    }else {
        alertBack('this album does not exist');
    }
}else {
    alertBack('illegal');
}
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
picture show
</h2>
<img src="thumb.php?filename=<?php echo $filename?>&percent=<?php echo $percent?>"></img>
<p><a href="photo_add_img.php?id=<?php echo $html['id']?>">upload picture</a></p>


<?php 
paging(2);
?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>