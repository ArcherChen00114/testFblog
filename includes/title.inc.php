<?php
if (!defined('PWD')){
    exit('Access denied');;
}
session_start();
if (!defined('SCRIPT')){
    exit('scripte ERROR');
}
global $system;
?>

<title><?php echo $system['webname']?></title>
<link href="type/type<?php echo $system['skin']?>/type1.css" rel="stylesheet" type="text/css"/>
<link href="type/type<?php echo $system['skin']?>/<?php echo SCRIPT?>.css" rel="stylesheet" type="text/css"/>
