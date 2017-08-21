 <?php
if (!defined('PWD')){
    exit('Access denied');;
}//for safe

function removeDir($dirname){
    if(!is_dir($dirname)){
        return false;
    }
    $handle=@opendir($dirname);
    while(($file=@readdir($dirname))!==flase){
        if($file!='.'&&$file!='..'){
            $dir=$dirname.'/'.$file;
            is_dir($dir)?removeDir($dir):@unlink($dir);
        }
    }
    closedir($handle);
    return rmdir($dirname);
}

function manage_login(){
    if((!isset($_COOKIE['username']))||(!isset($_SESSION['admin']))){
        alertBack('illegal');
    }
}

function timed($NowTime,$PreTime,$second){
if ($NowTime()-$PreTime<$second){
        alertBack('please dont post too many articles in short time');
    }
}
/*
 * runtime used to get program running time
* @access public
* return float(double)
*/
function runtime(){
    $mtime=explode(' ',microtime());
    return $mtime[1]+$mtime[0];
}
/**
 * for register code resurence
 */
function alertBack($string){
    echo "<script type='text/javascript'>alert('$string');history.back();</script>";
        exit;
}

function alertClose($string){
    echo "<script type='text/javascript'>alert('$string');window.close();</script>";
        exit;
}

function location($string,$url){
    if (!empty($string)){
    echo "<script type='text/javascript'>alert('$string');location.href='$url';</script>";
    exit;
    }
    else {
        header('Location:'.$url);
    }
}
/**
 * code() for produce random access code
 * @param number $width
 * @param number $height
 * @param number $randomcode code number
 */
function code($width=75,$height=25,$randomcode=4){
    session_start();//make the code random
    ob_clean();
    header("content-type: image/png");
    for ($i=0;$i<$randomcode;$i++){
        $nmsg.= dechex(mt_rand(0,15));
    }//create random code
    $_SESSION['code']=$nmsg;
    $img=imagecreatetruecolor($width, $height);//create png
    $red=imagecolorallocate($img, 0xFF, 0x00, 0x00);//color
    $white=imagecolorallocate($img, 255, 255, 255);//color
    imagefill($img, 0, 0, $white);//background fill

    //random color for string
    for ($i=0;$i<$randomcode;$i++){
        $_rnd_color1=imagecolorallocate($img,mt_rand(0,200),mt_rand(0,150),mt_rand(0,200));
        imagestring( $img , 10 , ($i)*$width/$randomcode+(mt_rand(1,10)) , mt_rand(1, $height/2) , $_SESSION['code'][$i] , $_rnd_color1 );
    }
    // imagestring ( $img , 10 , 20 , 5 , $_SESSION['code'] , $_rnd_color1 );//print
    $black=imagecolorallocate($img, 0, 0, 0);
    $green=imagecolorallocate($img, 0, 255, 0);
    for($i=0;$i<50;$i++) {
        imagesetpixel($img, rand(0, 100) , rand(0, 100) , $black);
        imagesetpixel($img, rand(0, 100) , rand(0, 100) , $green);
    }//make some point
    for ($i=0;$i<6;$i++){//random color for line
        $_rnd_color2=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($img, mt_rand(0,75), mt_rand(0,75), mt_rand(0,75), mt_rand(0,75), $_rnd_color2);
        imageline($img, mt_rand(0,75), mt_rand(0,75), mt_rand(0,75), mt_rand(0,75), $_rnd_color2);
    }

    imagepng($img);//better make the png before output this image
    imagedestroy($img);//and destroy it after output it
}

function checkCode($code1,$code2){
    if ($code1!==$code2){
        alertBack('code wrong');
    }
}
function login_state(){
    if (isset($_COOKIE['username'])){
    alertBack('login state cant do that');
    }
}
/*
 * compare uniqid 
 * if not same alertback
 */
function _uniqid($mysqli_uniqid,$_COOKIES_uniqid){
    if ($mysqli_uniqid!=$_COOKIES_uniqid){
        alertBack('uniqid error');
    }
}

function thumb($filename,$percent){
    header('Content-type:image/png');
    $n=explode('.','face/001.jpg');
    //define a variable to decide which css it should choose
    
    list($width,$height)=getimagesize($filename);
    $new_width=$width*$percent;
    $new_height=$height*$percent;
    $new_image=imagecreatetruecolor($new_width, $new_height);
    switch($n[1]){
        case'jpg':$image=imagecreatefromjpeg($filename);
        break;
        case'png':$image=imagecreatefrompng($filename);
        break;
        case'gif':$image=imagecreatefromgif($filename);
        break;
    }
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagepng($new_image);
    imagedestroy($image);
    imagedestroy($new_image);
}

function _setXml($xmlfile,$clean){
    $fp=@fopen($xmlfile, 'w');
    if (!$fp){
        exit ('error, file does not exist');
    }
    flock ($fp,LOCK_EX);
    $string="<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="<vip>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="\t<id>{$clean['id']}</id>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="\t<username>{$clean['userName']}</username>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="\t<sex>{$clean['sex']}</sex>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="\t<face>{$clean['icon']}</face>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="\t<email>{$clean['email']}</email>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="\t<QQ>{$clean['QQ']}</QQ>\r\n";
    fwrite($fp,$string,strlen($string));
    $string="</vip>\r\n";
    fwrite($fp,$string,strlen($string));
    flock($fp,LOCK_UN);
    fclose($fp);
}

function ubb($string){
    $string=nl2br($string);
    $string=preg_replace('/\[size=(.*)\](.*)\[\size\]/U','<span style="font-szie:=\1px">\2</span>', $string);
    $string=preg_replace('/\[b\](.*)\[\b\]/U','<strong>\1</strong>', $string);
    $string=preg_replace('/\[i\](.*)\[\i\]/U','<em>\1</em>', $string);
    $string=preg_replace('/\[u\](.*)\[\u\]/U','<span style="text-decoration:underline>\1</span>', $string);
    $string=preg_replace('/\[s\](.*)\[\s\]/U','<span style="text-decoration:line-through>\1</span>', $string);
    $string=preg_replace('/\[color=(.*)\](.*)\[\/color\]/U','<span style="color:\1">\2</span>', $string);
    $string=preg_replace('/\[url\](.*)\[\url\]/U','<a href="\1" target="_blanl">\1</a>', $string);
    $string=preg_replace('/\[email\](.*)\[\email\]/U','<a href="mailto:\1" target="_blank">\1</a>', $string);
    $string=preg_replace('/\[ima\](.*)\[\img\]/U','<img src="\1" alt="image" />', $string);
    $string=preg_replace('/\[flash\](.*)\[\flash\]/U','<embed style="width:480px;height:400px;" src="\1" />', $string);
    return $string;
}

function _getXML($xmlfile){
    $html=array();
    if(file_exists($xmlfile)){
        $xml=file_get_contents($xmlfile);
        preg_match_all('/<vip>(.*)<\/vip>/s',$xml,$dom);
        foreach($dom[1] as $value){
            preg_match_all('/<id>(.*)<\/id>/s',$value,$id);
            preg_match_all('/<username>(.*)<\/username>/s',$value,$username);
            preg_match_all('/<sex>(.*)<\/sex>/s',$value,$sex);
            preg_match_all('/<face>(.*)<\/face>/s',$value,$face);
            preg_match_all('/<email>(.*)<\/email>/s',$value,$email);
            preg_match_all('/<QQ>(.*)<\/QQ>/s',$value,$QQ);
            $html['id']=$id[1][0];
            $html['username']=$username[1][0];
            $html['sex']=$sex[1][0];
            $html['face']=$face[1][0];
            $html['email']=$email[1][0];
            $html['QQ']=$QQ[1][0];
        }
    } else {
        alertBack('this file does not exist');
    }
    return $html;
}

function page($sql,$size){
    global $pagesize,$pagenumber,$pageabsolute,$page,$num;
    if (isset($_GET['page'])){
        $page=$_GET['page'];
        if(empty($page)||$page<=0||!is_numeric($page)){
            $page=1;
        }else{
            $page=intval($page);
        }
        //what if the url change to strange thing, make
        //this web hard to make error
        //1.page should not smaller than 0
        //2. it should be number
        //3.it shuold not be empty
        //4.larger than max page
    }else {
        $page=1;
    }
    $num = num_rows(query($sql));
    $pagesize=$size;//set size by input value;
    $pagenumber=($page-1)*10;
    if ($num==0){
        $pageabsolute=1;
    }elseif($pagesize!=0){
        $pageabsolute=ceil($page/$pagesize);
    }
    if ($page>$pageabsolute){
        $page=$pageabsolute;
    }
}
/*
 * make paging to function,show the page number to switch between pages
 * 
 */
function paging($type){
    global $page;
    global $pageabsolute;
    global $pagenumber,$id;
    global $num;
    if($type==1){
      echo '<div id="page_num">';
      echo '<ul>';
        for ($i=0;$i<$pagenumber;$i++){
            if ($page==$i){
            echo '<li><a href="'.SCRIPT.'.php?'.$id.'page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
            }
            else{
            echo '<li><a href="'.SCRIPT.'.php?'.$id.'page='.($i+1).'">'.($i+1).'</a></li>';
            }
        }
      echo '</ul>';
      echo '</div>';
    }elseif($type==2){
        echo '<div id="page_text">';
        echo '<ul>';
        echo '<li>'.$page.'/'.$pageabsolute.'page|</li>';
        echo '<li><strong>'.$num.'</strong>data|</li>';
    if ($page==1){
        echo '<li>toppage|</li>';
        echo '<li>uppage|</li>';
    }else{
        echo '<li><a href="'.SCRIPT.'.php">toppage</a>|</li>';
        echo '<li><a href="'.SCRIPT.'.php?page='.($page-1).'">uppage</a>|</li>';
    }
    if($page==$pageabsolute){
        echo '<li>pagedown|</li>';
        echo '<li>lastpage|</li>';
    } else {
        echo '<li><a href="'.SCRIPT.'.php?page='.($page+1).'">pagedown|</a></li>';
        echo '<li><a href="'.SCRIPT.'.php?page='.$pageabsolute.'">lastpage|</a></li>';
    } 
  echo '</ul>';
echo '</div>';
    } else {
        paging(2);
    }
}
function unsetcookies(){
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    session_destroy();
    location(null,'newfile.php');
}
/*
 * get a length of string
 */
function title($string,$num){
    if (mb_strlen($string,'utf-8')>$num){
        $string=mb_substr($string,0,$num,'utf-8');
    }
    return $string;
}
/*
 * html() to make string show HTML.
 * 
 */
function htmls($string){
    if (is_array($string)){
        foreach($string as $key => $value){
            $string[key]=htmls($value);//use itself to get htmlSCs
        }
    }else{
        htmlspecialchars($string);
    }
    return $string;
}

function mysqli_string($string){
    global $conn;
    if (is_array($string)){
        foreach($string as $key => $value){
            $string[key]=mysqli_string($value);//use itself to get htmlSCs
        }
    }else{
        mysqli_real_escape_string($conn,$string);
    }
    return $string;
}

function _session_destory(){
    if (session_start()){
        session_destroy();}
}
?>