/**
save for use in future
* may not work, dont know why, all alert()does not work
 * 
 */
 window.onload=function(){
 	var faceimg=document.getElementById('faceimg');
 	if (faceimg!=null){
 	var code = document.getElementById('code');
 	faceimg.onclick=function(){
 		window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
 	}
 	code.onclick=function(){
 		window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
 	}
  }
 };
//wait until the web is ready
 var fm=document.getELementsByTagName('form')[0];
 if (fm!=undefined) {
 fm.onsubmit=function(){
	 //try not do everything on server
     //used for make sure username in right length in js
     if(fm.username.value.length<2||fm.username.value.length>20){
	 alert('user name should longer then 2 and shorter than 20');
	 fm.username.value="";
	 fm.username.focus();//move the pointer to that place
	 return false;
     }
     if (/[<>\'\"\\ ]/.test(fm.username.value)){
     alert('user name illegal');
     fm.username.value="";
	 fm.username.focus();//move the pointer to that place
	 return false;
     }
     if(fm.password.value.length<6 !=fm.ensurepassword.value){
	 alert('password should longer than 6 and equal to ensurepassword');
	 fm.password.value="";
	 fm.password.focus();//move the pointer to that place
	 return false;
     }
     if(fm.passwordhint.value.length<6||fm.passwordhint.value.length>20){
	 alert('passwordhint should longer than 6 and shorter than 20');
	 fm.passwordhint.value="";
	 fm.passwordhint.focus();//move the pointer to that place
	 return false;
     }
     if(fm.passwordanswer.value.length<6||fm.passwordanswer.value.length>20){
	 alert('passwordanswer should longer than 6 and shorter than 20');
	 fm.passwordanswer.value="";
	 fm.passwordanswer.focus();//move the pointer to that place
	 return false;
     }
     if(fm.passwordhint.value=fm.passwordanswer.value){
	 alert('passwordhint should not equal to answer');
	 fm.passwordanswer.value="";
	 fm.passwordanswer.focus();//move the pointer to that place
	 return false;
     }
     if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
     alert('email format error');
	 fm.email.value="";
	 fm.email.focus();//move the pointer to that place
	 return false;	
     }
     if (!/^[1-9]{1}[0-9]{4,9}$/.test(fm.qq.value)){
     alert('qq format error');
	 fm.QQ.value="";
	 fm.QQ.focus();//move the pointer to that place
	 return false;	
     }
     if (fm.code.value.length!=4){
     	alert('code should be 4');
     	fm.code.value="";
     	fm.code.focus();
     	return false;
     }
     return true;
 }
 }
