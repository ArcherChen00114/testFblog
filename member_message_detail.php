<?php

session_start();
define('PWD',537238);
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
define('SCRIPT','member_message_detail');
global $conn;
if (!isset($_COOKIE['username'])){
    alertBack('please login');
}

//delete moduel
if ($_GET['action']=='delete'&&isset($_GET['id'])){
    if(!!$rows=fetch_array("SELECT
        tg_id
        FROM
        message
        WHERE
        tg_id='{$_GET['id']}'
        LIMIT 1")){    
        
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
                          tg_id='{$_GET['id']}' 
                      LIMIT 
                           1");
        echo "delete success";
        if (affected_rows()==1){
            mysqli_close($conn);
            location('message deleted','member_message.php');
        }else{
            mysqli_close($conn);
            alertBack('delete failed');
        }
    }else{
        alertBack('illegal');
    }
    } else {
    alertBack('this message does not exist');
  }
}
//ID moduel
if (isset($_GET['id'])){
    $rows=fetch_array("SELECT
        tg_fromuser,
        tg_state,
        tg_content,
        tg_date
        FROM
        message
        WHERE
        tg_id='{$_GET['id']}'
        LIMIT 1");
    if($rows){
        if(empty($rows['state'])){
            query("UPDATE 
                         message
                      SET 
                         tg_state=1 
                    WHERE 
                         tg_id='{$_GET['id']}'
                    LIMIT 1");
        if (!affected_rows()==1){

        }
        }
        $html=array();
        $html['id']=$rows['tg_id'];
        $html['fromuser']=htmls($rows['tg_fromuser']);
        $html['content']=htmls($rows['tg_content']);
        $html['date']=htmls($rows['tg_date']);
        $html=htmls($html);
    }else{
        alertBack('this message does not exist');
    }
}
else{
    alertBack('illegal');
}


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
<script type="text/javascripte" src="js/member_message_detail.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="member">
<?php require 'includes/member.inc.php'?>
<div id="member_main">
   <h2>
   message detail center
   </h2>
   <dl>
     <dd>sender:<?php echo $html['fromuser']?></dd>
     <dd>content:<strong><?php echo $html['content']?></strong></dd>
     <dd>sendtime:<?php echo $html['date'] ?></dd>
     <dd class="button"><input type="button" value="return list" id="return"/></dd>
     <dd class="button"><input type="button" value="delete" name="<?php echo $html['id']?>" id="delete"/></dd>
   </dl>
   </div>
</div>
   
<?php 
require 'includes/footer.inc.php';
?>
</body>
</html>