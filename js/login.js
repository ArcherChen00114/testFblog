/**
 * 
 */
 

  window.onload=function(){
    code();
    //login confirmition
 	var fm=document.getElementsByTagName('form')[0];
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
     if (fm.code.value.length!=4){
     	alert('code should be 4');
     	fm.code.value="";
     	fm.code.focus();
     	return false;
     }
     return true;
    }
   
}