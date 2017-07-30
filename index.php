<?php
/*
 * 0.7 make the code producer be avaliable
 * 0.8 will make submit be avaliable ****we are here now not finished yet
 * 2017/7/20
 * 0.9 filter illegal username
 *     deal with password
 * 1.0 make QQ/email confirmation (mysqli_real need be used after 
 *     connected the database)
 *     <Passwordhint and passwordanswer can be same, need to deal with锛�
 *     connect to MYSQL server
 * 1.1 create MYsql database
 *     add user list
 *     able to upload user information, make it able to use
 *     check username, no same username will be used .
 *     same to email;
 *     /**
 *     Bug list:1.function sha1Uniqid() does not work, in register.fun.php
 *     line127_)
 *     2.function checkemail works but cant give the value of email to
 *     $clean['email']
 *     --------used $clean['email]=$_POST['email'] to make it in use
 *     but may have new problem
 * 1.2.1 pack sql function up
 *       //i do want to know why it does work till i retype the whole
 *       // query
 *       fix the problem of checkCode() does not work
 *       fix the problem of cant send info to sql
 *       fix the problem that cant restrict the reuse of user name and 
 *       email;
 *       add active page(need to fix it later, it does not work, only
 *       a page)
 *       i skiped the JS part, may have time to deal with it later.
 *       add login page
 *     /
 *     have to open js file with JSeclipse or some function does not work
 *     better to see class 18 again, should deal with it
 *     
 * 1.3   
 * time to add more pic ,and fix 01.jpg's size, it cant use to fix the 
 * screen sheet
 * new folder'images' for images(not icon)
 * something need to be test:
 * 1.js file of register
 * 2.login page//finished
 * 3.logout page
 * 4.infocenter page
 * 5.login_state function to prevent user register or login in login state
 *      fixed register.js
 *      try add cookies
 *      //but login.js need to add something, class70
 *      login.php set up //finished
 *      logout.php set up//finished
 *      login_state and function to clean cookies//finished
 *      //JS file need time to be ready, have to restart js process
 *      // try supervisor to deal with this question
 *      // git hub update finished, need to 
 *      git add .(to merge), then rebase --continue(rebase)
 *      then update it with push -f(force) origin master. at least it work
 * 
 * 
 * 1.4 now we move to 1.4
 * register.php, when you register, the username and the password swith.
 *     next time update wanna try change the commit
 *     change the function fetch_array, add $type to choose array type;
 *     add fetch_array_list,in order to get all data from sql
 
 *     need to add info to sql in order to test new func
 *     blog.php gonna show 10 blog friends every page
 *     // blog.php need test
 *     //1.add pics in folder face/image
 *     //2.add enough user in sql
 *     //3.test it
 *     //4.have problem sql error//HAVE NO TG_ID ON HOME PC
 *     //5.test connection between class :selected and css
 *     give error report part//emp.you cant enter blog without login
 *     add function num_rows();
 *     fix the problem that may happen on pagenumber at blog.php
 *     //need test on blog.php,change the url string after page=
 *     //to long string, or long number, see if it will at a page
 *     //that should not exist
 *     //HAVE TO　ADD SQL INFO FOR TEST
 *     
 */    //end at 7/29
 
?>