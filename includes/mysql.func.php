<?php
if (!defined('PWD')){
    exit('Access denied');
}
// define('DB_USER','root');
// define('DB_PWD','123456');
// define('DB_HOST','localhost');
// define('DB_NAME','testFblog');
function connect(){
    global $conn;
$conn=mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('connect failed');
}
connect();
// var_dump($conn);
//we will save it for test if we have error.
function set_names(){
    global $conn;
    mysqli_query($conn, 'SET NAMES UTF8');
}
// mysqli_query($conn, "INSERT INTO user(tg_username) VALUES('qwe537238')")
// or die ('error'.mysqli_error($conn));
// $sql="select tg_username as query FROM user WHERE tg_username ='log1024'";
function query($sql){
    global $conn;
    global $query;
    if(!$query=mysqli_query($conn, $sql)){
        exit("sql error".mysqli_error($conn));
    }
    return $query;
}
/*
 * this used for get one row of data from sql
 */
function fetch_array($sql){
    return mysqli_fetch_array(query($sql),3);
}
/*
 * this used for get all info of sql
 */
function fetch_array_list($result){
    return mysqli_fetch_array($result);
}
function is_user_repeat($sql,$info){
    if(fetch_array($sql)){
        alertBack($info);
    }
}
function num_rows($sql){
    return mysqli_num_rows($sql);
}
function free($result){
    mysqli_free_result($result);
}
function affected_rows(){
    global $conn;
    return mysqli_affected_rows($conn);
}

?>