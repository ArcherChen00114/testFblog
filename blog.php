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
define('SCRIPT','blog');
//get info from sql as array
//first element is query,second element means how many users per page
global $pagesize,$pagenumber;
page("SELECT tg_id FROM user",15);
global $conn;
$result=query("SELECT 
                     tg_id,
                     tg_username,
                     tg_sex,
                     tg_face 
               FROM 
                     user 
               ORDER BY 
                     tg_register_date 
               DESC 
               LIMIT $pagenumber,$pagesize;");
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
<title>blog page</title>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="blog">
<h2>
blog friendlist
</h2>
<?php 
    $html=array(); 
while(!!$rows=fetch_array_list($result))
//rows[0]=username,[1]=sex,[2]=icon;
//fetch_array will read info from sql AGAIN!,need to read the info array
//
{
    $html['id']=$rows['tg_id'];
    $html['username']=htmls($rows['tg_username']);
    $html['sex']=htmls($rows['tg_sex']);
    $html['face']=htmls($rows['tg_face']);
    $html=htmls($html);?> <?php 
// for ($i=10;$i<30;$i++){
// ?>
<dl>
   <dd class='user'> <?php echo $html['username'];?>(<?php echo $html['sex'];?>) </dd>
   <dt> <img src="<?php echo $html['face']; ?>" alt="log1024" /></dt>
   <dd class='message'><a href='javascript:;' name="message" title=<?php echo $html['id']?>>message</a></dd>
   <dd class='friend'><a href='javascript:;' name="friend" title=<?php echo $html['id']?>>add friend</a></dd>
   <dd class='mail'>mail</dd>
   <dd class='gift'><a href='javascript:;' name="gift" title=<?php echo $html['id']?>>gift</a></dd>
</dl>
<?php 
}
free($result);
paging(2);
?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>