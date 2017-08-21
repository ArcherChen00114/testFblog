<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','article');
$skinurl=$_SERVER["HTTP_REFERER"];
if(!empty($skinurl)||!isset($_GET['id'])){
    alertBack('illegal');
} else {
setcookie('skin',$_GET['id']);
location(null, $skinurl);
}
?>