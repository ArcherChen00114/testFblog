<?php 
if (!defined('PWD')){
    exit('Access denied');;
}
session_start();
global $message_html;
?>
<div id="header">
<h1>
<a href="newfile.php">
Blog of a pathfinder
</a>
  <ul>
    <li><a href='newfile.php'>toppage</a></li>
    <?php 
    if (isset($_COOKIE['username'])){
        echo '<li><a href="member.php">'.$_COOKIE['username'].'s\'infocenter</a>'.$message_html.'</li>';
        echo "\n";}
        else {
        echo '<li><a href="register.php">register</a></li>';
        echo "\n";
        echo "\t\t";//to make code beautiful
        echo '<li><a href="login.php">login</a></li>';
        echo "\n";
        }    
    ?>
    <li><a href="blog.php">blog</a></li>
    <li><a href="photo.php">photo</a></li>
    <li>style</li>
    <?php
    if (isset($_COOKIE['username']) && isset($_SESSION['admin'])){
        echo'<li><a href="manage.php">manage </a></li>';
    }
    if (isset($_COOKIE['username'])){
        echo '<li><a href="logout.php">exit</a></li>';
    }
    ?>
  </ul>
</h1>
</div>