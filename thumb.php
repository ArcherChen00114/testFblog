<?php
session_start();
define('PWD',537238);
require 'includes/common.inc.php';
include 'includes/login.func.php';
define('SCRIPT','thumb');
thumb($_GET['filename'], $_GET['percent']);
?>
