<?php 
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/register.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','register');
//judge if it is a submit
if ($_GET['action']=='register'){
//     for safety you need to make sure the code is right
//     if(!$_POST['code']==$_SESSION['code']){
//         alertBack('you did not enter right code');
//     }make it a function in  global function in order to 
//// use that function at any site.
    checkCode($_POST['code'], $_SESSION['code']);
    //use uniqid() to protect the web system
    // protect a unique string. sha1(uniqid(rand(),true))
    $clean=array ();//to create a new array save info
        $clean['uniqid']=checkUniqid($_POST['uniqid'],$_SESSION['uniqid']);
        $clean['active']=sha1Uniqid();
        //active code for new user to active
        'your username is:'.$clean['userName']=checkUsername($_POST['username'],2,20);
        'your password is:'.$clean['passWord']=checkPassword($_POST['password'], $_POST['ensurepassword']);
        'your passwordhint is:'.$clean['passWordHint']=checkPasswordhint($_POST['passwordhint'],4,20);
        'your passwordanswer is:'.$clean['passWordAnswer']=checkAnswer($clean['passWordHint'],$_POST['passwordanswer'], 4, 20);
        'your sex is:'.$clean['sex']=$_POST['sex'];
        'icon:'.$clean['icon']=$_POST['face'];
        'your email is:'.$clean['email']=checkEmail($_POST['email'],6,40);
        $clean['email']=$_POST['email'];//might be proble
        'your QQ is:'.$clean['QQ']=checkQQ($_POST['QQ']);
        $query=mysqli_query($conn, "SELECT tg_username FROM tg_user WHERE tg_username='{$clean['userName']}'");
        if (mysqli_fetch_array($query,MYSQL_ASSOC)){
            alertBack('this username has registed');
        }
        //add new user
        $sql=mysqli_query($conn, "INSERT INTO user(
                                         tg_uniqid,
                                         tg_active,            
                                         tg_username,
                                         tg_password,
                                         tg_answer,
                                         tg_hint,
                                         tg_qq,
                                         tg_email,
                                         tg_sex,
                                         tg_face,
                                         tg_register_date,
                                         tg_last_logtime,
                                         tg_last_ip
                                         ) 
                                   VALUES(
                                         '{$clean['uniqid']}',
                                         '{$clean['active']}',
                                         '{$clean['userName']}',
                                         '{$clean['passWord']}',
                                         '{$clean['passWordAnswer']}',
                                         '{$clean['passWordHint']}',
                                         '{$clean['QQ']}',
                                         '{$clean['email']}',
                                         '{$clean['sex']}',
                                         '{$clean['icon']}',
                                         NOW(),
                                         NOW(),
                                         '{$_SERVER["REMOTE_ADDR"]}'
                                          )" );
        mysqli_close($conn);
        // then jump to toppage
        locationToppage('congralation', 'newfile.php');

}  
$_SESSION['uniqid']=$uniqid=sha1Uniqid();
//could save in mysql, for confirmation of cookies
//MUST do this after submit, or uniqid will change
//make that uniqid id saved in session and 
// save it in $uniqid and give it to form's value
//or it will change and never equal, 
//if that value not equal then
// the form cant submit
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<?php require 'includes/title.inc.php';?>
<script type="text/javascript" src="js/face.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<style type="text/css" media="all">
</style>
<!-- 其他文档头元素 -->
<title>register page</title>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id='register'>
    <h2>
    register
    </h2>
    <form method="post" action="register.php?action=register" name="register">
        <input type='hidden'  name='uniqid' value="<?php echo $uniqid ?>"/>
        <dl>
            <dt>请认真填写以下内容</dt>
            <dd>username:<input type="text" name="username" class="text"/>(*)</dd>
            <dd>password:<input type="password" name="password" class="text"/>(*)</dd>
            <dd>ensure your password:<input type="password" name="ensurepassword" class="text"/>(*)</dd>
            <dd>password hint:<input type="text" name="passwordhint" class="text"/>(*)</dd>
            <dd>password answer:<input type="text" name="passwordanswer" class="text"/>(*)</dd>
            <dd>sex:<input type="radio" name="sex" value="male"/>male<input type="radio" name="sex" value="female"/>female</dd>
            
            
            <dd class="face">faceicon:
            <input type="hidden" name="face" value="face/01.jpg" id="face">
            <img src="/face/01.jpg" alt="choose your icon" id="faceimg"/></dd>
            
            
            
            <dd>email:<input type="text" name="email" class="text"/>(*)</dd>
            <dd>QQ:<input type="text" name="QQ" class="text"/></dd>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <dd><input type="submit" class="submit" value="register"/></dd>
            <dd>the (*) means it have to entered content</dd>
        </dl>
    
    </form>

</div>


<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>