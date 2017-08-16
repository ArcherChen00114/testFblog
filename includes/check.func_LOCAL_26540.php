<?php
if (!defined('PWD')){
    exit('Access denied');;
}//for safe
if (!function_exists(alertBack)){
    exit('alertBack() does not exist');
}
/**
 *  
 * @param String $username
 * @param number $minnum
 * @param number $maxnum
 * @return string
 */


function checkUsername($username,$minnum=2,$maxnum=20){
    //get the spaces out of the $username
    global $system;
    $username=trim($username);
    if (mb_strlen($username,'utf-8')>$maxnum || mb_strlen($username,'utf-8')<$minnum){
    alertBack('usernames length should be '.$minnum.' to '.$maxnum);
    }
    //limit speacial chars
    $charPattern='/[\'\"\ \ \/\\<>]/';
    if (preg_match($charPattern,$username)){
        alertBack('illegal name');
    }
    //limit special names;
    $mg=explode("|",$system['banstring']);
    //absolute match
    if (in_array($username, $mg)){
        alertBack('name not allowed');
    }
    return $username;
}

/**
 * @access public
 * @param string $password
 * @param string $ensurepassword
 * @param number $minnum
 * @return string
 */
function checkPassword($password,$ensurepassword,$minnum=6){
    //make should password is long enough
    if(strlen($password)<$minnum){
        alertBack('password should longer than '.$minnum);
    }
    if ($password!=$ensurepassword){
        alertBack('password should equal to ensureance password');
    }
    return sha1($password);
}
function checkModifyPassword($password,$minnum=6){
    if(!empty($password)){
    if(strlen($password)<$minnum){
        alertBack('password should longer than '.$minnum);
    } else{
        return null;
    }
    return sha1($password);
   }
}

/**
 * @accesspublic
 * @param string $hint
 * @param int $minnum
 * @param int $maxnum
 * @return string
 */
function checkPasswordhint ($hint,$minnum,$maxnum){
    $hint=trim($hint);
    if (mb_strlen($hint)<$minnum || mb_strlen>$maxnum){
        alertBack('hint should not shorter than '.$minnum.'  longer then'
            .$maxnum);
    }
//     return mysqli_real_escape_string($link, $string_to_escape)
    //use mysqli after connected  the mysql
    return $hint;
}
/**
 * 
 * @param unknown $hint
 * @param unknown $answer
 * @param unknown $minnum
 * @param unknown $maxnum
 */
function checkAnswer($hint,$answer,$minnum,$maxnum){
    $answer=trim($answer);
    if (mb_strlen($answer)<$minnum || mb_strlen($answer)>$maxnum){
        alertBack('answer should not shorter than '.$minnum.'or longer then'
            .$maxnum);
        if (($hint)==($answer)){
            alertBack('answer should not equal to hint');
        }
    }
//     return mysqli_real_escape_string($link, $string_to_escape)
    //use that return after connect mysql
    return $answer;
}
/**
 * 
 * @param string $email
 */
function checkEmail($email,$minnum=7,$maxnum=20){//'/^[\w\-\.]+@[\w\-\.]+(.com)$/
    //^$ go to check the whole thing,\w means any number chars
    if (empty($email)){
        return null;
    }else{
    if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)$/', $email)){
        alertBack('illegal email');
    }
    if (mb_strlen($email)<$minnum || mb_strlen($email)>$maxnum){
        alertBack('email should not shorter than '.$minnum.'or longer then'
            .$maxnum);
    }
    return $email;
  }
}
/**
 * @access public
 * @param  int $QQ
 * return int $QQ
 */
function checkQQ($QQ){
    if(empty($QQ)){
        return null;
    }else {
        if(!preg_match('/^[1-9]{1}[0-9]{4,9}$/',$QQ)){
            //use {1} means the limit only work for the first char
    alertBack('please enter correct QQ.');
    }
        return $QQ;
    }
}
/**
 *
 * @param unknown $testuniqid
 * @param unknown $uniqid
 */
function checkUniqid($testuniqid,$uniqid){
    if((strlen($testuniqid)!=40)||($testuniqid!=$uniqid)){
        alertBack('uniqid error');
    }
    //     return mysqli_real_escape_string($testuniqid, $string_to_escape)
    return $testuniqid;
}
/**
 * have problem,need to deal with
 */
function sha1Uniqid(){
    return sha1(uniqid(rand(),true));
}

function checkContent($string){
if (mb_strlen($string)<10 || mb_strlen($string)>200){
        alertBack('message should not short than 10 or longer than 200');
    }
    return $string;
}
function checkPostTitle($string,$min,$max){
    if (mb_strlen($string)<$min || mb_strlen($string)>$max){
        alertBack('title should not short than '.$min.' or longer than '.$max.'');
    }
    return $string;    
}
function checkPostContent($string,$num){
    if (!mb_strlen($string)>$num){
        alertBack('content should not short than '.$num.'!');
    }
    return $string;    
}
function checkAutograph($string,$num){
    if (!mb_strlen($string)>$num){
        alertBack('content should not longer than '.$num.'!');
    }
    return $string;
}

function checkDirName($string,$min,$max){
    if (mb_strlen($string,'utf-8')<$min||mb_strlen($string,'utf-8')>$max){
        alertBack('album name should not shorter than '.$min.' or longer than '.$max.'');
    }
}
function checkDirPassword($string,$num){
    if (strlen($string)<$num){
        alertBack('password should not shorter than'.$num.'');
    }
    return sha1($string);
}
?>