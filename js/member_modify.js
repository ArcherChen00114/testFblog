/**
 * 
 */
 
 window.onload=function(){
 	code();
 	var fm=document.getELementsByTagName('form')[0];
    fm.onsubmit=function(){
     if(fm.password.value!=''){
     if(fm.password.value.length<6 !=fm.ensurepassword.value){
	 alert('password should longer than 6 and equal to ensurepassword');
	 fm.password.value="";
	 fm.password.focus();//move the pointer to that place
	 return false;
       }
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
 };