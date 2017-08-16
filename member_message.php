<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
define('SCRIPT','member_message');
global $pagesize,$pagenumber;
page("SELECT 
            tg_id 
        FROM 
            message
       WHERE
            tg_touser='{$_COOKIE['touser']}'",5);
if (!isset($_COOKIE['username'])){
    alertBack('please login');
}
if ($_GET['action']=='delete' && isset($_POST['ids'])){
    $clean=array();
    $clean['ids']=mysqli_string(implode(',',$_POST['ids']));
 //ensurence, compare uniqid
 if(!!$rows =fetch_array("SELECT
                                   tg_uniqid 
                             FROM 
                                   user 
                             WHERE 
                                  tg_username='{$_COOKIE['username']}'"))
    {
        _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
        query("DELETE FROM
                          message
                     WHERE
                          tg_id 
                        IN
                          ({$clean['ids']})");
        if (affected_rows()){
            mysqli_close($conn);
            location('message deleted','member_message.php');
        }else{
            mysqli_close($conn);
            alertBack('delete failed');
        }
    } else {
        alertBack('illegal');
    }
}
$result=query("SELECT
                    tg_id,
                    tg_fromuser,
                    tg_content,
                    tg_date,
                    tg_state
                FROM
                    message
               WHERE
                    tg_touser='{$_COOKIE['touser']}'
            ORDER BY
                    tg_date
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
<?php require 'includes/member.inc.php'?>
   <div id="member_main">
   <h2>
   message manage center
   </h2>
   <form method="post" action="?action=delete">
   <table cellspacing="1">
   <tr><th>sender</th><th>content</th><th>time</th><th>state</th><th>action</th></tr>
<?php
    $html=array();
    while(!!$rows=fetch_array_list($result))
//rows[0]=username,[1]=sex,[2]=icon;
//fetch_array will read info from sql AGAIN!,need to read the info array
//
{
    $html['id']=$rows['tg_id'];
    if (empty($rows['tg_state'])){
        $html['state']='未读';
        $html['content']='<strong>'.title($html['content'],14).'</strong>';
    }else{
        $html['state']='已读';
        $html['content']=title($html['content'],14);
    }
    $html['fromuser']=$rows['tg_fromuser'];
    $html['content']=$rows['tg_content'];
    $html['date']=$rows['tg_date'];
    $html=htmls($html);
    ?>
   <tr><td><?php echo $html['fromuser']?></td><td><a href="member_message_detail.php?id=<?php echo $html['id']?>" title="<?php echo $html['content']?>"><?php echo title($html['content'],14).'...'?></a></td><td><?php echo $html['date']?></td><td><?php echo $html['state']?></td><td><input name="ids[]" value='<?php echo $html['id']?>' type="checkbox"/></td></tr>
   
   <?php 
}
free($result);
?> 
   <tr><td colspan="5"><label for="all">choose all<input type="checkbox" name="checkall" id="all"/></label><input type="submit" value="delete checked"/></td></tr>
   </table>
   </form>
   </div>
</div>
<?php 
paging(2);?>


<?php 
require 'includes/footer.inc.php';
?>
</body>
</html>