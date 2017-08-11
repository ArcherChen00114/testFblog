<?php 
define('PWD',537238);
define('SCRIPT','forlist');//use define to choose the title css this php
//will use
require 'includes/common.inc.php';
$html=htmls(_getXML('new.xml'));
//get post list
global $pagesize,$pagenumber;
page("SELECT tg_id FROM article",10);
global $conn;
$result=query("SELECT
                        tg_id,
                        tg_type,     
                        tg_title,
                        tg_commentcount,
                        tg_readcount
                    FROM
                        article
                   WHERE
                        tg_reid=0
                ORDER BY
                        tg_date
                    DESC
                   LIMIT 
                        $pagenumber,$pagesize;");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<?php require 'includes/title.inc.php';?>
<style type="text/css" media="all">
</style>
<!-- 其他文档头元素 -->
<title>Test First Blog</title>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php 
require 'includes/header.inc.php';
?>
<div id="list">
 <h2>list</h2>
 <a href="post.php" class="post">post</a>
 <ul class="article">
 <?php
       $htmllist=array();
       while(!!$rows=fetch_array_list($result)){
          $htmllist['id']=$rows['tg_id'];
          $htmllist['type']=$rows['tg_type'];
          $htmllist['title']=$rows['tg_title'];
          $htmllist['readcount']=$rows['tg_readcount'];
          $htmllist['commentcount']=$rows['tg_commentcount'];
          echo '<li class="icon'.$htmllist['type'].'"><em>read(<strong>'.$htmllist['readcount'].'</strong>)</em><em>comment(<strong>'.$htmllist['commentcount'].'</strong>)</em><a href="article.php?id='.$htmllist['id'].'">'.title($htmllist['title'],20).'...'.'</a></li>';            
       }
       ?>
     </ul>
     <?php paging(2);?>
</div>
<div id="user">
 <h2>new user</h2>
 <dl>
   <dd class='user'> <?php echo $html['username'];?>(<?php echo $html['sex'];?>) </dd>
   <dt> <img src="<?php echo $html['face']; ?>" alt="<?php echo $html['username'];?>" /></dt>
   <dd class='message'><a href='javascript:;' name="message" title=<?php echo $html['id']?>>message</a></dd>
   <dd class='friend'><a href='javascript:;' name="friend" title=<?php echo $html['id']?>>add friend</a></dd>
   <dd class='mail'>mail<a href="mailto:<?php echo $html['email']?>"><?php echo $html['email']?></a></dd>
   <dd class='gift'><a href='javascript:;' name="gift" title=<?php echo $html['id']?>>gift</a></dd>
   <dd class='email'><a href="mailto:email:<?php echo $html['email'];?>"></a></dd>
   <dd class='QQ'>QQ:<?php echo $html['QQ'];?></dd>
   </dl>
</div>
<div id="pics">
 <h2>new pics</h2>
</div>

<?php 
require'includes/footer.inc.php';

$endtime=runtime();

?>
</body>
</html>