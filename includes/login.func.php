<?php

if (!defined('PWD')){
    exit('Access denied');;
}//for safe
if (!function_exists(alertBack)){
    exit('alertBack() does not exist');
}

function checkUsername($username,$minnum=2,$maxnum=20){
    //get the spaces out of the $username
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
    $mg=array();
    //absolute match
    if (in_array($username, $mg)){
        alertBack('name not allowed');
    }
    return $username;
}
function checkPassword($password,$minnum=6){
    //make should password is long enough
    if(strlen($password)<$minnum){
        alertBack('password should longer than '.$minnum);
    }
    return sha1($password);
}
function check_time($string){
    $time=array('0','1','2','3');
    if (!in_array($string,$time)){
        alertBack('saved in wrong way');
    }
    return $string;
}
function cookies($username,$uniqid,$time){//login cookies
    setcookie('username','$username');
    setcookie('uniqid','$uniqid');
    switch($time){
        case 0:
            setcookie('username','$username');
            setcookie('uniqid','$uniqid');
        case 1:  //for a day
            setcookie('username','$username',time()+86400);
            setcookie('uniqid','$uniqid',time()+86400);
            break;
        case 2:  //for a week
            setcookie('username','$username',time()+(86400*7));
            setcookie('uniqid','$uniqid',time()+(86400*7));
            break;
        case 3://for a month
            setcookie('username','$username',time()+(86400*30));
            setcookie('uniqid','$uniqid',time()+(86400*30));
            break;
            
    }
    
}
?>