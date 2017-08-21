<?php

/* 

 */
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','photo_detail');
global $conn,$pagesize,$pagenumber,$system;
//comment
if ($_GET['action']=='rephoto'){

    checkCode($_POST['code'], $_SESSION['code']); 
    if(!!$rows =fetch_array("SELECT
                                    tg_uniqid,
                                    tg_username
                                FROM
                                    user
                                WHERE
                                    tg_username='{$_COOKIE['username']}'")){
                                    _uniqid($rows['tg_uniqid'], $_COOKIE['uniqid']);
    } else {
        alertBack('illegal');
    }
    $clean=array();
    $clean['reid']=$_POST['reid'];
    $clean['type']=$_POST['type'];
    $clean['title']=$_POST['title'];
    $clean['content']=$_POST['content'];
    $clean['username']=$_POST['username'];
    $clean=mysqli_string($clean);
    
    query("INSERT INTO
                      photo
                        (tg_sid,
                        tg_username,
                        tg_title,
                        tg_content,
                        tg_date
                    )
                        VALUES('{$clean['sid']}',
                        '{$clean['username']}',
                        '{$clean['title']}',
                        '{$clean['type']}',
                        '{$clean['content']}',
                        NOW()
                    )");
    if (affected_rows()==1){
        query("UPDATE
                    photo
                SET
                    tg_commendcount=tg_commendcount+1
                WHERE
                    tg_id='{$clean['reid']}'");
        mysqli_close($conn);
        //         session_destroy();
        location('congraduation, comment successed','photo_detail.php?id='.$clean['sid']);
    }else{
        mysqli_close($conn);
        //         session_destroy();
        alertBack('comment failed');
    }
}else {
        alertBack('illegal');
    }
    


//limit get info
if (isset($_GET['id'])){
    if (!!$rows=fetch_array("SELECT
                                    tg_id,
                                    tg_name,
                                    tg_sid,
                                    tg_utl,
                                    tg_username,
                                    tg_readcount,
                                    tg_commentcount,
                                    tg_date,
                                    tg_content
                               FROM
                                    photo
                               WHERE
                                    tg_id='{$_GET['id']}'
                               LIMIT 1")){
                               
                               //sid(album),type(empty),COOKIE,isset(admin)
    if(!!$dirs=fetch_array("SELECT
                                    tg_type,
                                    tg_id
                              FROM 
                                    dir
                             WHERE
                                    tg_id='{$rows['tg_sid']}'")){
                            if(!isset($_SESSION['admin'])){
                                if(!empty($dirs['tg_type'])&& $_COOKIE['photo'.$dirs['tg_id']]!=$dirs['tg_name']){
                                    alertBack('illegal');
                                }
                            }else {
                                alertBack('album list error');
                            }                           
    }
    
    
    
    
    
                               query("UPDATE
                                           photo
                                       SET
                                           tg_readcount=tg_readcount+1
                                       WHERE
                                           tg_id='{$_GET['sid']}'");
        $html=array();
        $html['id']=$rows['tg_id'];
        $html['name']=$rows['tg_name'];
        $html['url']=$rows['tg_url'];
        $html['username']=$rows['tg_username'];
        $html['readcount']=$rows['tg_readcount'];
        $html['commentcount']=$rows['tg_commentcount'];
        $html['content']=$rows['tg_content'];
        $html['date']=$rows['tg_date'];
        $html=htmls($html);
        global $id;
        $id=$html['id'].'&';
        
        page("SELECT
                    tg_id
                FROM
                    photo_comment
                WHERE
                    tg_sid='{$html['reid']}'",$system['photo']);
        $result=query("SELECT
                            tg_username,
                            tg_title,
                            tg_content,
                            tg_date
                        FROM
                            photo_comment
                        WHERE
                            tg_sid='{$html['id']}'
                    ORDER BY
                            tg_date ASC
                        LIMIT
                            $pagenumber,$pagesize
            ");
        
        $html['preid']=fetch_array("SELECT
                                          min(tg_id)
                                       AS
                                          id
                                     FROM
                                          photo
                                    WHERE 
                                          tg_sid='{$html['sid']}'
                                      AND
                                          tg_id>'{$html['id']}
                                    LIMIT 1'");

        $html['nextid']=fetch_array("SELECT
                                            max(tg_id)
                                        AS
                                            id
                                        FROM
                                            photo
                                        WHERE
                                            tg_sid='{$html['sid']}'
                                        AND
                                            tg_id<'{$html['id']}
                                        LIMIT 1'");
        
        if (!empty($html['preid']['id'])){
            $html['pre']='<a href="photo_detail.php?id='.$html['preid']['id'].'">previous page</a>';
        } else {
            $html['pre']='<span></span>';
        }
        if (!empty($html['nextid']['id'])){
            $html['next']='<a href="photo_detail.php?id='.$html['nextid']['id'].'">next page</a>';
        } else {
            $html['next']='<span></span>';
        }
        
    }else {
        alertBack('this photo does not exist');
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
<script type="text/javascript" src="js/blog.js"></script>
<script type="text/javascript" src="js/article.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="photo">
<h2>
photo detail
</h2>
<a name="pre"></a>
<dl class="detail">
        <dd class="name"><?php echo $html['name']?></dd>
        <dt><img src="<?php echo $html['url'] ?>"> </img></dt>
        <dd>[<a href="photo_show.php?id=<?php echo $html['sid'] ?>">back to list</a>]</dd>
        <dd>comment(<?php echo $html['commentcount']?>) read(<?php echo $html['readcount']?>) upload:<?php echo $html['username'];?> uploaded at:<?php echo $html['date']?></dd>
        <dd>description:<?php echo $html['content']?></dd>
    </dl>
<?php 
$i=1;
while(!!$rows=fetch_array_list($result)){
    $html['username']=$rows['tg_username'];
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
        $html=htmls($html);
        } else {
                }
?>
<p class="line"></p>
<div class="re">
 <dl>
   <dl>
   <dd class='user'> <?php echo $html['username'];?>(<?php echo $html['sex'];?>)[Host] </dd>
   <dt><?php echo $html['pre']?><img src="<?php echo $html['face']; ?>" alt="<?php echo $html['username'];?>" /><?php echo $html['next']?></dt>
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
     <h3>title:<?php echo $html['retitle']?></h3>
     <div class="detail">
       <?php echo ubb($html['content'])?>
       <?php 
       if ($html['switch']==1){
            echo '<p class="autograph">'.ubb($html['autograph']).'</p>';
        }?>
     </div>
   </div>
</div>
<?php 
$i ++;
}
free($result);
paging(1);?>
<?php if(isset($_COOKIE['username'])){?>
<p class="line"></p>
<a name="ree"></a>
 <form method="post" action='?action='reply'>
     <input type="hidden" name="sid" value="<?php echo $html['id'] ?>" />
     <dl class="rephoto">
        <dt>enter your reply</dt>
            <dd>
            <dd>title:<input type="text" name="title" class="text" value="RE:<?php echo $html['name']?>"/>(*)</dd>
            <dd id="q">image: <a href:"javascript:;">image[1]</a> <a href:"javascript:;">image[2]</a> <a href:"javascript:;">image[3]</a></dd>
            
      <div id="ubb">
              <img src="" title="font size" alt="font size"/>
              <img src="" title="line" alt="line"/>
            
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
            </div>
      </div>
            <textarea name="content" rows="9" ></textarea> 
            </dd>
            <?php if (!empty($system['code'])){?>
            <dd>code:<input type="text" name="code" class="text code"/><img src="image.php" id="passcode"  onclick="javascript:this.src='image.php'"/></dd>
            <?php }?>
  </form>
  <?php }?>
</div>



<?php 
require 'includes/footer.inc.php';
?>
</body>

</html>