<?php 
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','gift');
if (!isset($_COOKIE['username'])){
    alertClose('you have to log in');
}
//send gift
if($_GET['action']=='send'){
if (!empty($system['code'])){
    checkCode($_POST['code'], $_SESSION['code']);
    }
    
    //if code right?
    if(!!$rows=fetch_array("SELECT 
                                  tg_uniqid 
                            FROM  
                                  user 
                            WHERE  
                                  tg_username='{$_COOKIE['username']}' 
                            LIMIT 1"))
    {uniqid($rows['tg_uniqid'],$_COOKIE['uniqid']);
    //check uniqid
    include 'includes/check.func.php';
    $clean=array();
    $clean['touser']=$_POST['touser'];
    $clean['fromuser']=$_COOKIE['username'];
    $clean['gift']=$_COOKIE['gift'];//get gift number
    $clean['content']=checkContent($_POST['content']);
    $clean=mysqli_string($clean);
    //get data and make it clean
    query("INSERT INTO gift(
                            tg_touser,
                            tg_fromuser,
                            tg_gift,
                            tg_content,
                            tg_date
                       ) 
                 VALUES(
                        '{$clean['touser']}',
                        '{$clean['fromuser']}',
                        '{$clean['gift']}',
                        '{$clean['content']}',
                        NOW()
                       )
    ");
    if (affected_rows()==1){
        mysqli_close($conn);
//         session_destroy();
        alertClose('gift sent');
    }else{
        mysqli_close($conn);
//         session_destroy();
        alertBack('gift sent failed');}
    }else{
        alertBack('uniqid error');
    }
}

if (isset($_GET['id'])){
    if(!!$rows=fetch_array("SELECT tg_username FROM user WHERE tg_id='{$_GET['id']}' LIMIT 1")){
        $html=array();
        $html['touser']=$rows['tg_username'];
        $html=htmls($html);
    }else{
    alertClose('this user does not exist');
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
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="message">
  <h3>write message</h3>
  <form method="post" action="?action=send">
  <input type="hidden" name="touser" value="<?php echo $html['touser']?>" /> 
  <dl>
    <dd>
       <input type="text" readonly="readonly" value="TO:<?php echo $html['touser']?>" class="text"/>
       <select name="gift">
       <?php 
         foreach(range(1,100) as $num){
             echo '<option value="'.$num.'">x'.$num.'</option>';
         }
       ?>
       </select>
    </dd>
    <dd><textarea name="content" rows="" cols=""> you are amazing! A gift for you!</textarea></dd>
    
            <?php if (!empty($system['code'])){?>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <?php }?><dd><input type="submit" class="submit" value="send message"/></dd> 
  </dl>
  </form>
</div>

<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>