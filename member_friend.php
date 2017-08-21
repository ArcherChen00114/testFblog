<?php
/*
 * define PWD
 * require common
 * define SCRIPT
 * page set
 * check COOKIE if not then ask for login
 *   check action and id
 *               =check for friends Verification
 *                      yes then get data from database
 *                          then renew state=1 means Verification passed
 *                      no alertback
 *               =delete and ids
 *                      store data checked friend's id into array $clean
 *                    if this username and uniqid exist(login state)
 *                      then delete selected friends
 *                    no then alert back
 *   <html
 *       make array to store data
 *       make all data show html(not affected by input html sentence)
 *        make sure friend name not show the user itself
 *        then show the state correct
 *       pagging
 *   /html>
 *   require footer include file
 *                       
 * 
 */
session_start();
define('PWD',537238);
global $conn;
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
define('SCRIPT','member_friend');
global $pagesize,$pagenumber;
page("SELECT 
            tg_id 
        FROM 
            friend
       WHERE
            tg_touser='{$_COOKIE['touser']}'",5);
if (!isset($_COOKIE['username'])){
    alertBack('please login');
}
//check new friends
if ($_GET['action']=='check'&&isset($_GET['id'])){
    if(!!$rows =fetch_array("SELECT
        tg_uniqid
        FROM
        user
        WHERE
        tg_username='{$_COOKIE['username']}'
        LIMIT 1
        ")){
        //change state in friend
        query("UPDATE
                     friend
                  SET
                     tg_state=1
                WHERE
                     tg_id='{$_COOKIE['id']}'");
        if (affected_rows()==1){
            mysqli_close($conn);
            location('friends Verification success','member_friend.php');
        }else{
            mysqli_close($conn);
            alertBack('friend Verification failed');
        }
        
    }else {
        alertBack('illegal');
    }
    
}

//delete friends
if ($_GET['action']=='delete' && isset($_POST['ids'])){
    $clean=array();
    $clean['ids']=mysqli_string(implode(',',$_POST['ids']));
 //ensurence, compare uniqid
 if(!!$rows =fetch_array("SELECT
                                   tg_uniqid 
                             FROM 
                                   user 
                             WHERE 
                                  tg_username='{$_COOKIE['username']}'
                             LIMIT 1
                                   "))
    {
        _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
        query("DELETE FROM
                          friend
                     WHERE
                          tg_id 
                        IN
                          ({$clean['ids']})"
                              );
        if (affected_rows()){
            mysqli_close($conn);
            location('friends deleted','member_friend.php');
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
                    tg_touser,
                    tg_fromuser,
                    tg_content,
                    tg_date,
                    tg_state
                FROM
                    friend
               WHERE
                    tg_touser='{$_COOKIE['touser']}'
                  OR
                    tg_fromuser='{$_COOKIE['username']}'
            ORDER BY
                    tg_date
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
   friend manage center
   </h2>
   <form method="post" action="?action=delete">
   <table cellspacing="1">
   <tr><th>friend</th><th>request</th><th>time</th><th>state</th><th>action</th></tr>
<?php  
    $html=array();
    while(!!$rows=fetch_array_list($result))
{
    $html['id']=$rows['tg_id'];
    $html['touser']=$rows['tg_touser'];
    $html['fromuser']=$rows['tg_fromuser'];
    $html['content']=$rows['tg_content'];
    $html['state']=$rows['tg_state'];
    $html['date']=$rows['tg_date'];
    $html=htmls($html);
    if ($html['touser']==$_COOKIE['username']){
        $html['friend']=$html['fromuser'];
        if(empty($html['state'])){
            $html['state_html']='<a href="?action=check&id='.$html['id'].'" style="color:red";>你未验证</a>';
        }else{$html['state_html']='<span style="color:green;">pass</span>';
        }
    }elseif ($html['fromuser']==$_COOKIE['username']){
        $html['friend']=$html['touser'];
        if(empty($html['state'])){
            $html['state_html']='<span style="color:blue;">对方未验证</span>';
        }
        else
        {$html['state_html']='<span style="color:green;">pass</span>';
      }
    }
    ?>
   <tr><td><?php echo $html['friend']?></td><td title="<?php echo $html['content']?>"><?php echo title($html['content'],14).'...'?></td><td><?php echo $html['date']?></td><td><?php echo $html['state_html']?></td><td><input name="ids[]" value='<?php echo $html['id']?>' type="checkbox"/></td></tr>
   
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