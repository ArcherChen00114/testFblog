<?php

/* define passcode of web
 *   require include files
 *     reply model{
 *                  checkcode
 *                  get uniqid and username,if username is same--1
 *                  get info to $clean array
 *                  insert data into sql database
 *                  if data affected count+  +--2
 *                  --2 else alertback
 *                  --1 else alertback
 *                  }
 *    floor reply model{
 *                      check id
 *                              check if it is a reply(reid=0)
 *                              not a reply then can read it and readcount++
 *                      get article info into $html
 *                          then check user
 *                      if he has replied or posted, give him right to change his article(modify button)
 *                          show modified time
 *                          show reply button
 *                      get host userinfo (existed then move to next part)
 *                          page
 *                      }
 *     <from>
 *     show right floor number, if it is page1 floor1,it is host
 *     and 2nd 3rd have different name
 *     then every floor have reply and yinyong button(in login state)
 * then textarea for user



 */
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','article');
global $conn;
//get info from sql as array
//first element is query,second element means how many users per page
if ($_GET['action']=='reply'){
    if (!empty($system['code'])){
    checkCode($_POST['code'], $_SESSION['code']);
    }
    if(!!$rows =fetch_array("SELECT
                    tg_uniqid,
                    tg_username
                FROM
                    user
                WHERE
                    tg_username='{$_COOKIE['username']}'")){
        //compare unipid for safty
        global $system;
    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
    timed(time(),$_COOKIE['article_time'],$system['re']);
    $clean=array();
    $clean['reid']=$_POST['reid'];
    $clean['type']=$_POST['type'];
    $clean['title']=$_POST['title'];
    $clean['content']=$_POST['content'];
    $clean['username']=$_POST['username'];
    $clean=mysqli_string($clean);
    query("INSERT INTO
                      article(tg_reid,
                              tg_username,
                              tg_title,
                              tg_type,
                              tg_content,
                              tg_date
                              )
                        VALUES('{$clean['reid']}',
                               '{$clean['username']}',
                               '{$clean['title']}',
                               '{$clean['type']}',
                               '{$clean['content']}',
                               NOW()
                               )");
    if (affected_rows()==1){
        setcookie('article_time',time());
        query("UPDATE
                     article
                  SET
                     tg_commendcount=tg_commendcount+1
                WHERE
                     tg_reid=0
                  AND
                     tg_id='{$clean['reid']}'");
        $clean['id']=_insertID();
        mysqli_close($conn);
//         session_destroy();
        location('congraduation, your reply successed','article.php?id='.$clean['reid']);
    }
    else{
        mysqli_close($conn);
//         session_destroy();
        alertBack('your reply failed');
        }
    }else {
        alertBack('illegal');
    }
}
$rows=array();
//confirm this id existed
if (isset($_GET['id'])){
    if(!!$rows=fetch_array("SELECT
                                   tg_id,
                                   tg_username,
                                   tg_title,
                                   tg_type,
                                   tg_content,
                                   tg_readcount,
                                   tg_commentcount,
                                   tg_last_modifydate,
                                   tg_date
                               FROM
                                   article
                              WHERE
                                   tg_reid=0
                                AND
                                   tg_id='{$_GET['id']}'")){
                                   //make sure this article's id exist, and it is not an reply of a topic
                                 
       query("UPDATE
                    article
                 SET
                    tg_readcount=tg_readcount+1
               WHERE
                    tg_id='{$_GET['id']}'");
       //them readcount ++
       $html=array();
       $html['reid']=$rows['tg_id'];
       $html['username_subject']=$rows['tg_username'];
       $html['title']=$rows['tg_title'];
       $html['type']=$rows['tg_type'];
       $html['content']=$rows['tg_content'];
       $html['readcount']=$rows['tg_readcount'];
       $html['commendcount']=$rows['tg_commendcount'];
       $html['date']=$rows['tg_date'];
       $html['lastmodifydate']=$rows['tg_last_modifydate'];
       $html=htmls($html);
       //put all data into
       //global
       global $id;
       $id='id='.$html['reid'].'&';
       //make change topic available
       if ($html['username_subject'] == $_COOKIE['username']){
           $html['subject_modify']='[<a herf="article_modify.php?id'.$html['reid'].'"change topic]';
           //if this is host, then make thi article able to change for this user
       }
       
       //read last modify data
       if ($html['lastmodifydate']!='0000-00-00 00:00:00'){
           $html['lastmodifydatestring']='this post has modified by'.$html['username_subject'].'at'.$html['lastmodifydate'].'';
           //if html lastmodifydate is changed, then show when did it changed
       }
       //reply for host
       if($_COOKIE['username']){
           $html['re']='<span><a href="#ree" name="re" title="reply for host'.$html['username_subject'].'"</span>';
           //show that reply button after every floor 
       }
       
       //this part used for get hostuser info
       if(!!$rows=fetch_array("SELECT
                                        tg_id,
                                        tg_face,
                                        tg_sex,
                                        tg_email,
                                        tg_qq
                                    FROM
                                        user           
                                   WHERE
                                        tg_username='{$html['username_subject']}'")){
        $html['id']=$rows['tg_id'];
        $html['sex']=$rows['tg_sex'];
        $html['face']=$rows['tg_face'];
        $html['email']=$rows['tg_email'];
        $html['qq']=$rows['tg_qq'];
        $html=htmls($html);
                                        
        global $pagesize,$pagenumber,$page;
        page("SELECT
                    tg_id 
                FROM 
                    article
               WHERE
                    tg_reid='{$html['reid']}'",10);
        $result=query("SELECT
                             tg_username,
                             tg_type,
                             tg_title,
                             tg_content,
                             tg_date
                         FROM
                             article
                        WHERE
                             tg_reid='{$html['reid']}'
                     ORDER BY
                             tg_date ASC
                        LIMIT
                             $pagenumber,$pagesize
            ");
                       
        
       }  else {
           
       }
       
    }else {
        alertBack('this post does not exist');
    }
}else {
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
<title>article page</title>
<script type="text/javascript" src="js/article.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="article">
<h2>
article page
</h2>

<?php if($page==1){
//make the host looks different?>
<div id="subject">
<dl>
   <dl>
   <dd class='user'> <?php echo $html['username_subject'];?>(<?php echo $html['sex'];?>) </dd>
   <dt> <img src="<?php echo $html['face']; ?>" alt="<?php echo $html['username'];?>" /></dt>
   <dd class='message'><a href='javascript:;' name="message" title=<?php echo $html['id']?>>message</a></dd>
   <dd class='friend'><a href='javascript:;' name="friend" title=<?php echo $html['id']?>>add friend</a></dd>
   <dd class='mail'>mail:<a href="mailto:<?php echo $html['email']?>"><?php echo $html['email']?></a></dd>
   <dd class='gift'><a href='javascript:;' name="gift" title=<?php echo $html['id']?>>gift</a></dd>
   <dd class='email'><a href="mailto:email:<?php echo $html['email'];?>"></a></dd>
   <dd class='qq'>qq:<?php echo $html['qq'];?></dd>
   </dl>
</dl>
<div class="content">
     <div class="user">
<!--      this span shows the 'floor' number -->
       <span><?php echo $html['subject_modify']?> #<?php echo ($i+(($page-1)*$pagesize));?></span><?php echo $html['username_subject']?> |posted at <?php echo $html['date']?>
     </div>
     <h3><?php echo $html['title']?><img scr="images/icon<?php echo $html['type']?>.gif" alt="icon"></img></h3>
     <div class="detail">
     <?php echo $html['content']?>
     </div>
     <div class="read">
     <p><?php echo $html['lastmodifydatestring']?></p>
     readcount:<?php echo $html['readcount']?>
     commendcount:<?php echo $html['commendcount']?>
     </div>
   </div>
</div>
<?php }?>
<p class="line"></p>
<?php
   $i=2;
while(!!$rows=fetch_array_list($result)){
    $html['username']=$rows['tg_username'];
    $html['type']=$rows['tg_type'];
    $html['retitle']=$rows['tg_title'];
    $html['content']=$rows['tg_content'];
    $html['date']=$rows['tg_date'];
    $html=htmls($html);
    
    
    if(!!$rows=fetch_array("SELECT
                                tg_id,
                                tg_face,
                                tg_sex,
                                tg_email,
                                tg_qq
                                tg_switch,
                                tg_autograph
                            FROM
                                user        
                            WHERE
                                tg_username='{$html['username']}'")){
        $html['id']=$rows['tg_id'];
        $html['sex']=$rows['tg_sex'];
        $html['face']=$rows['tg_face'];
        $html['email']=$rows['tg_email'];
        $html['qq']=$rows['tg_qq'];
        $html['switch']=$rows['tg_switch'];
        $html['autograph']=$rows['tg_autograph'];
        $html=htmls($html);}

        if($page==1&&$i==2){
            if($html['username']==$html['username_subject']){
                $html['username_html'].='[Host]';
            }else {
                $html['username_html'].='[sofa]';                
            }
        } else {
                $html['username_html'];
            }
            
        if ($_COOKIE['username']){
        $html['re']='<span>[<a href="#ree" name="re" title="reply for '.($i+(($page-1)*$pagesize)).''.$html['username'].'" >reply</a>]</span>';
        $html['re']='<span>[<a href="#ree" name="yinyong" title="reply for '.($i+(($page-1)*$pagesize)).''.$html['username'].'" >yinyong</a>]</span>';
        }
        //show autograph
        
        
    ?>
<div class="re">
<dl>
   <dl>
   <dd class='user'> <?php echo $html['username'];?>(<?php echo $html['sex'];?>)[Host] </dd>
   <dt> <img src="<?php echo $html['face']; ?>" alt="<?php echo $html['username'];?>" /></dt>
   <dd class='message'><a href='javascript:;' name="message" title=<?php echo $html['id']?>>message</a></dd>
   <dd class='friend'><a href='javascript:;' name="friend" title=<?php echo $html['id']?>>add friend</a></dd>
   <dd class='mail'>mail:<a href="mailto:<?php echo $html['email']?>"><?php echo $html['email']?></a></dd>
   <dd class='gift'><a href='javascript:;' name="gift" title=<?php echo $html['id']?>>gift</a></dd>
   <dd class='email'><a href="mailto:email:<?php echo $html['email'];?>"></a></dd>
   <dd class='qq'>qq:<?php echo $html['qq'];?></dd>
   </dl>
</dl>
<div class="content">
     <div class="user">
       <span>#num</span><?php echo $html['username']?> |posted at <?php echo $html['date']?>
     </div>
     <h3>title:<?php echo $html['retitle']?><img scr="images/icon<?php echo $html['type']?>.gif" alt="icon" /><?php echo $html['re'] ?></h3>
     <div class="detail">
       <?php echo ubb($html['content'])?>
       <?php 
       if ($html['switch']==1){
            echo '<p class="autograph">'.ubb($html['autograph']).'</p>';
        }?>
     </div>
   </div>
</div>
<p class="line"></p>
<?php }?>
<?php if(isset($_COOKIE['username'])){?>
<a name="ree"></a>
 <form method="post" action='?action='reply'>
     <input type="hidden" name="reid" value="<?php echo $html['reid'] ?>"></input>
     <input type="hidden" name="type" value="<?php echo $html['reid'] ?>"></input>
     <dl>
        <dt>enter your reply</dt>
            <dd>
            <dd>title:<input type="text" name="title" class="text" value="RE:<?php echo $html['title']?>"/>(*)</dd>
            <dd id="q">image: <a href:"javascript:;">image[1]</a> <a href:"javascript:;">image[2]</a> <a href:"javascript:;">image[3]</a></dd>
            <dd>
            <div id="ubb">
              <img src="" title="font size" alt="font size"/>
              <img src="" title="line" alt="line"/>
<!--   its too many of them and i have no pics, abort it till it
       is still practice     -->
            <div id="font">
               <strong onclick="font(10)">10px</strong>
               <strong onclick="font(12)">12px</strong>
               <strong onclick="font(14)">14px</strong>
               <strong onclick="font(16)">16px</strong>
               <strong onclick="font(18)">18px</strong>
               <strong onclick="font(20)">20px</strong>
               <strong onclick="font(22)">22px</strong>
               <strong onclick="font(24)">24px</strong>
            </div>
            <div id="color">
               <strong title="black" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="red" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="blue" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="green" style="background:#000" onclick=“showcolor('#000')"></strong>
               <strong title="orange" style="background:#000" onclick=“showcolor('#000')"></strong>
               <em><input type="text" name="t" value="#" /></em>
 
 
 <!--               that's too much color choose panel but i may not do it -->
            </div>
      </div>
<!--             we could pack those thing over that line
in ubb.inc.php-->
            <textarea name="content" rows="9" ></textarea> 
            </dd>
            <?php if (!empty($system['code'])){?>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <?php }?>
            <dd><input type="submit" class="submit" value="post"/></dd>
            </dd>
     </dl>
 </form>
 <?php 
    $i ++;
    }
        free($result);
        paging(2);?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>