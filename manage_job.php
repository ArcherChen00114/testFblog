<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
define('SCRIPT','manage_job');
global $pagesize,$pagenumber,$system;
global $conn;
manage_login();
// add administrtor
if ($_GET['action']=='add'){
    if(!!$rows =fetch_array("SELECT
        tg_uniqid
        FROM
        user
        WHERE
        tg_username='{$_COOKIE['username']}'")){
        //compare unipid for safty
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
}else {
      alertBack('illegal');}
    $clean=array();
    $clean['username']=$_POST['manage'];
    $clean=mysqli_string($clean);
    query("UPDATE
                 user
              SET
                 tg_level=1
            WHERE
                 tg_username='{$clean['username']}'
    ");    
    if (affected_rows()==1){
        mysqli_close($conn);
        location('congraduation, new administrtor added',SCRIPT.'.php');
    }else{
        mysqli_close($conn);
        alertBack('administrtor add failed');
    } 
}
  


if($_GET['action']=='job'&&isset($_GET['id'])){
    if(!!$rows =fetch_array("SELECT
                                    tg_uniqid
                                FROM
                                    user
                                WHERE
                                    tg_username='{$_COOKIE['username']}'")){
        //compare unipid for safty
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
    query("UPDATE
                user
             SET
                tg_level=0
           WHERE
                tg_username='{$_COOKIE['username']}'
             AND
                tg_id='{$_GET['id']}'");
} else {
    alertBack('illegal');
}

if (affected_rows()==1){
    mysqli_close($conn);
    session_destroy();
    location('you retired',SCRIPT.'.php');
}else{
    mysqli_close($conn);
    alertBack('retire failed');
}
}

if(!!$rows=fetch_array("SELECT
                                tg_id,
                                tg_username,
                                tg_email,
                                tg_register_date
                            FROM
                                user
                           WHERE
                                tg_level=1
                        ORDER BY
                                tg_register_date"
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
               WHERE
                    tg_level=1
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
    $html=htmls($html);
    if ($_COOKIE['username']==$html['username']){
        $html['job_html']='<a href="manage_job.php?action=job&id='.$html['id'].'">retire</a>';
    }else {
        $html['job_html']='not authorization';
    }
    ?> <?php 
// for ($i=10;$i<30;$i++){
// ?>
    
   <tr><td><?php echo $html['id']?></td><td><?php echo $html['username'] ?></td><td><?php echo $html['email']?></td><td><?php  echo $html['registerdate']?></td><td><?php echo $html['job_html']?></td></tr>
<?php }?>
   </table>
   <form method="post" action="?action=add">
        <input type="text" name="manage" class="text" /> <input type="submit" value="add administrtor" />
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