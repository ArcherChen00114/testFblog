<?php 
if (!defined('PWD')){
    exit('Access denied');;
}
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
        echo '<li><a href="infocenter.php">'.$_COOKIE['username'].'\'infocenter</li>';
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
    <li>manage</li>
    <li>style</li>
    <?php
    if (isset($_COOKIE['username'])){
        echo '<li><a href="logout.php">exit</a></li>';
    }
    ?>
  </ul>
</h1>
</div>