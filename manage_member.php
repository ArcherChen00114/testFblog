<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
define('SCRIPT','manage_member');
global $pagesize,$pagenumber,$system;
global $conn;
manage_login();
if($_GET['action']=='del'){
    query("DELETE 
        
             FROM
                 user
            WHERE
                 tg_id={$_GET['id']}");
                 }
if(!!$rows=fetch_array("SELECT
                                tg_id,
                                tg_username,
                                tg_email,
                                tg_register_date
                            FROM
                                user"
))
{
    
}

page("SELECT tg_id FROM user",15);
$result=query("SELECT
                    tg_username,
                    tg_email,
                    tg_register_date
                FROM
                    user
            ORDER BY
                    tg_register_date
                DESC
                    LIMIT $pagenumber,$pagesize;");

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
<script type="text/javescript" src="js/member_message.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="member">
<?php require 'includes/manage.inc.php'?>
   <div id="member_main">
   <h2>
   user manage center
   </h2>
   <form method="post" action="?action=delete">
   <table cellspacing="1">

   <tr><th>ID</th><th>username</th><th>email</th><th>regdate</th><th>action</th></tr>
    <?php 
    $html=array(); 
    while(!!$rows=fetch_array_list($result))

    {
    $html['id']=$rows['tg_id'];
    $html['username']=htmls($rows['tg_username']);
    $html['email']=htmls($rows['tg_email']);
    $html['registerdate']=htmls($rows['tg_register_date']);
    $html=htmls($html);?> <?php 
// for ($i=10;$i<30;$i++){
// ?>
    
   <tr><td><?php echo $html['id']?></td><td><?php echo $html['username'] ?></td><td><?php echo $html['email']?></td><td><?php  echo $html['registerdate']?></td><td>[<a href="?action=del&id=<?php echo $html['id']?>">delete</a>] [<a href="manage_modify?action=modify&id=<?php echo $html['id']?>.php">modify</a>]</td></tr>
<?php }?>
   </table>
   </form>
<?php 
    free($result);
    paging(2);
?>
   </div>
</div>


<?php 
require 'includes/footer.inc.php';
?>
</body>
</html>