/**
 * 
 */
window.onload=function(){
	code();
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
     if (fm.code.value.length!=4){
     	alert('code should be 4');
     	fm.code.value="";
     	fm.code.focus();
     	return false;
     }  
     
     if(fm.conent.value.length<10||fm.conent.value.length>200){
	 alert('content should not shorter than 10 or longer than 200')
	 fm.password.value="";
	 fm.password.focus();//move the pointer to that place
	 return false;
     }
     return true;
   }
}