 <?php
if (!defined('PWD')){
    exit('Access denied');;
}//for safe
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
function page($sql,$size){
    global $pagesize,$pagenumber,$pageabsolute,$page,$num;
    if (isset($_GET['page'])){
        $page=$_GET['page'];
        if(empty($page)||$page<0||!is_numeric($page)){
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
    }else{
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
    global $pagenumber;
    global $num;
    if($type==1){
      echo '<div id="page_num">';
      echo '<ul>';
        for ($i=0;$i<$pagenumber;$i++){
            if ($page==$i){
            echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
            }
            else{
            echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'">'.($i+1).'</a></li>';
            }
        }
      echo '</ul>';
      echo '</div>';
    }elseif($type==2){
        echo '<div id="page_text">';
        echo '<ul>';
        echo '<li>'.$page.'/'.$pageabsolute.'page|</li>';
        echo '<li><strong>'.$num.'</strong>users|</li>';
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
function title($string){
    if (mb_strlen($string,'utf-8')>14){
        $string=mb_substr($string,0,14,'utf-8');
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