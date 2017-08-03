<?php

session_start();
define('PWD',537238);
header('Content-type:text/html charset=utf-8');
//define a variable to decide which css it should choose
define('SCRIPT','member');
//judge if it is a submit
?>
   <div id="member_sidebar">
   <h2>
   guide
   </h2>
   <dl>
     <dt>account manage</dt>
       <dd><a href="member.php">personal information</a></dd>
       <dd><a href="member_modify.php">change information</a></dd>
   </dl>
   <dl>
     <dt>other manage</dt>
       <dd><a href="member_message.php">message</a></dd>
       <dd><a href="">friends</a></dd>
       <dd><a href="">flowers</a></dd>
       <dd><a href="">personal photo</a></dd>
   </dl>
   </div>