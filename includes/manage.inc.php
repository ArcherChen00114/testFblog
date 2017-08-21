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
   manage center
   </h2>
   <dl>
     <dt>system manage</dt>
       <dd><a href="manage.php">behind toppage</a></dd>
       <dd><a href="manage_set.php">system setting</a></dd>
   </dl>
   <dl>
     <dt>user manage</dt>
       <dd><a href="manage_member.php">user list</a></dd>
       <dd><a href="manage_job.php">job setting</a></dd>
   </dl>
   </div>