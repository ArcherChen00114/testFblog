<?php /*
 *   define PWD for file
 *   define SCRIPT
 *     require include file
 *     header to make sure charset is utf-8
 *       isset username (make sure login state)
 *       make sure action is add(then check code){check code
 *                                                          get data from database to $rows
 *                                                                                         compare uniqid to make keep data safe        
 *       include function file
 *         make $clean array to get data from cookies and post(and make all data  suitable to data base)
 *          check if this user have sent this request before
 *           then send this request to sql database
 *            check if this request is send to this user himself
 *             yes then back
 *             no then pass
 *              check if data base affected and give answer
 *       <html
 *       <form =post, action =add
 *         echo TO:touser and make it readonly
 *         set default sentence
 *         include passcode check
 *         submit button
 *       /form>
 *       /html>
 *       
 *     
 */     
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','friend');
if (!isset($_COOKIE['username'])){
    alertClose('you have to log in');
}
//add friend
if($_GET['action']=='add'){
    checkCode($_POST['code'], $_SESSION['code']);
}
    if(!!$rows=fetch_array("SELECT 
                                  tg_username 
                              FROM 
                                  user 
                             WHERE 
                                  tg_id='{$_GET['id']}' 
                             LIMIT 1")){
        uniqid($rows['tg_uniqid'],$_COOKIE['uniqid']);
    }    
    include 'includes/check.func.php';
    $clean=array();
    $clean['touser']=$_POST['touser'];
    $clean['fromuser']=$_COOKIE['username'];
    $clean['content']=checkContent($_POST['content']);
    $clean=mysqli_string($clean);
    if (!!$rows=fetch_array("SELECT 
                                   tg_id 
                               FROM
                                   friend
                              WHERE
                                   (tg_touser='{$clean['touser']}
                                AND
                                   tg_touser='{$clean['fromuser']}')
                                 OR
                                   (tg_touser='{$clean['frommuser']}
                                AND
                                   tg_fromuser='{$clean['touser']}'
                              LIMIT 1")){
                                   alertBack('你们已经是好友了，或者是未验证的好友。');
    }else{
        query("INSERT INTO
                          friend(
                                 tg_touser,
                                 tg_fromuser,
                                 tg_content,
                                 tg_date,
                                 )
                          VALUES(
                                 '{$clean['touser']}',
                                 '{$clean['fromuser']}',
                                 '{$clean['content']}',
                                 NOW()
                                 )");
        alertBack('添加成功');
    }

    if (affected_rows()==1){
        mysqli_close($conn);
        session_destroy();
        alertClose('好友添加成功');
    }else{
        mysqli_close($conn);
        session_destroy();
        alertClose('好友添加失败');}
if (isset($_GET['id'])){
    if(!!$rows=fetch_array("SELECT 
                                  tg_username 
                              FROM 
                                  user 
                             WHERE 
                                  tg_id='{$_GET['id']}' 
                             LIMIT 1")){
        $html=array();
        $html['touser']=$rows['tg_username'];
        if ($html['touser']==$html['touser']){
            alertClose('you cant make friend with yourself');
        };
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
<title>add friend</title>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="message">
  <h3>add friend</h3>
  <form method="post" action="friend.php?action=add">
  <input type="hidden" name="touser" value="<?php echo $html['touser']?>" /> 
  <dl>
    <dd><input type="text" readonly="readonly" value="TO:<?php echo $html['touser']?>" class="text"/></dd>
    <dd><textarea name="content" rows="" cols="">I'd like to make friend with you</textarea></dd>
    <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
    <dd><input type="submit" class="submit" value="add friend"/></dd> 
  </dl>
  </form>
</div>

<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>