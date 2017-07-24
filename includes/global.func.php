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
/**
 * code() for produce random access code
 * @param number $width
 * @param number $height
 * @param number $randomcode code number
 */
function code($width=75,$height=25,$randomcode=4){
    
    session_start();//make the code random
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
    if(!$code1==$code2){
        alertBack('you did not enter right code');
    }
}
?>