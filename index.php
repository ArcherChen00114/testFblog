<?php
/* git hub update finished, need to
*      git add .(to merge), then rebase --continue(rebase)
*      then update it with push -f(force) origin master. at least it work
*      progress 28/81
/* if you want to get the code, uyse git clone git@githubxxxx.com
 * back up in upload_folder, shuold used for upload and everytime
 * every change should recorded in index.php and give some quotes to
 * remind me of somethings i have to do IN UPPER CASE
 * end your work should save in that folder 
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
 *      
 * 
 * 1.4 now we move to 1.4
 * register.php, when you register, the username and the password swith.
 *     next time update wanna try change the commit
 *     change the function fetch_array, add $type to choose array type;
 *     add fetch_array_list,in order to get all data from sql
 
 *     need to add info to sql in order to test new func
 *     blog.php gonna show 10 blog friends every page
 *     // blog.php need test //looks like the css or the type have prom
 *     //may need to add pics in icons to test the result
 *     //1.add pics in folder face/image //add 278pics to face
 *     //2.add enough user in sql
 *     //3.test it
 *     //4.have problem sql error//HAVE NO TG_ID ON HOME PC
 *     //5.test connection between class :selected and css
 *     give error report part//emp.you cant enter blog without login
 *     add function num_rows();
 *     fix the problem that may happen on pagenumber at blog.php
 *     //need test on blog.php,change the url string after page=
 *     //long string, or long number, see if it will at a page
 *     //that should not exist
 *     //HAVE TO　ADD SQL INFO FOR TEST
 *     Add blog page_text, need to test
 *     all of blog.php need to be test tonight
 *     pack up all content of page and paging in function page()
 *     and paging().CHANGES in CSS, but did not show changes this time
 *     also need to test the chnages
 *     buliding member.php for member center
 *     ---------------------7/31 15:11
 *     member.php frame set up
 *     $clean did not get QQ and email
 *     fix problem of checkEmail()
 *     -------8/1 1.00am
 *     should add tg_login_count in sql. SMALLINT 4
 *     add recording in login.php, every time user login in
 *     will send a record of lasttime log in and IP to SQL
 * 1.5 now we move to 1.5
 *     -------8/1 14:15
 *     3 bugs fixed
 *     message.php set up, able to send, tested
 *     make up message box
 *     type1.css does not show affection on member_message.php
 *     please test it later
 *     build a new sql chart 'message'
 *     tg_id mediumint(8),tg_touser varchar(20),tg_fromuser varchar(20)
 *     tg_content varchar(200),tg_date datetime
 *1.6 now we move to 1.6
 *     ----------------8/2 14:58
 *     message-detail.php,and delete message
 *     js file of message_detail does not work, should have
 *     detail.func.php as back up to make those function work
 *     or add onclick on those <dd> to do delete this way may work
 *     add the function to delete a punch of checked message
 *     and add a button to check mutiple message
 *     add tg_state tinyint(1) into message 0 means not readed
 *     ---------------8/3 11:05
 *     able to show how many message not read yet
 *     js file of friend window did not test yet
 *     ---------------8/3 19:48
 *     //problem of js file, cant have function on something
 *     ///need some change on paging() function,that user should change
 *     --------------8/4 14:08
 *     add index to every php at title//not finished yet
 *     message_friend Verification has an another check about affect rows
 *     make gift.php and how to send/delete/calculate gift 
 *     add new user part in newfile(toppage).php
 *     ///login.php didnot alertBack when you enter valid username or password
 *     //generate a new xml for store newusers' information
 *     //get info from xml to show newuser
 *     setXMl() to make an XML to store infomation in XML (in global.func.php)
 *     make getXML() to get data from xmlfile
 *     add article list
 *     -------------8/7 14:06
 *     yahoooooooo monday!
 *     WHAT IS UBB???
 *     font-size of post.php need an image------
 *     because we cant get so many gifs in time, this part of post might be
 *     deleted, the font-choose part
 *     js file was given, but ubbimg lost, ubb bar lost
 *     post.php need test
 *     ///dont know why but it always jump to login.php\
 *     ------------8/10 15:40
 *     3 classes will finished today
 *     parts 50: create aticle.php to show posted article,
 *     and a new css for article,use min-height in css to make the 
 *     length of web could change itself depends on text
 *     made article.php
 *     //still need to deal with images of post.php, and the problem that post.php always ask you
 *     "dont do that in login state"
 *     ------------8/11 14:41
 *     //post.php's bug has fixed, able to post posts now,and could see it on article.php,but
 *     css of article.php looks terrible
 *     // add friends have problems cant works now
 *     add reply part into article.php, can reply a topic and add it into database
 *     going to make those reply show under topic
 *     //article.php's reply function and it's css need to be tested, and have to know if
 *      it will show reply for topic, or will show some others
	have some clue about usgin github mergeing tool, should use a,b,c to choose one of the heads then it will merge it 
	but this way not tested
	try to figure out a way not using force push, it is dangerous
	maybe need an another text to store experience of using gihub
	-------------8/14 15:27
	add article_modify.php
	need to change the css of aritcle.php
	article.php cant make reply be avaliable
	give article page the function to reply host/or anyother users(NOT TESTED)
 *    could use css to make yinyong have a dashed topline to show it is yinyong rather than 
 *    use '---------'
 *    autograph need test
 *    use cookies or database to limit user post time,(cant post 2 articles in 1 min)
 *    8/14 21:01
 *    manage_set have problem of $html['post_html']
 *    manage_set.php set up,able to get info from and set it into default state
 *    every files need to delete <title> and include title.inc.php
 *    8/15 14:44
 *    manage set_code using function available (not tested)
 *    article per page setting ,friends blog number setting available (not tested)
 *    post time limit seting ,reply time limit setting available (not tested) 
 *    set manage_modify page and delete function to manage_member page (not tested)
 *    THIS PART WAS SET UP BY MYSELF ,SHOULD TEST IN FREE TIME AND SHOULD BACK UP BEFORE TEST
*     manage_job.php set up, able to add new administrtor
*     photo.php set up, photo_add_dir.php set up
*     8/16 13:56
*     photo_add_dir.php js file have no reaction, should write in html to make it available,
*     do it in night
*     
 *     
 *     
 *     
 */    
 
?>