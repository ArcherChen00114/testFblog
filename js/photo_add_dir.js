/**
 * 
 */
 window.onlad=function(){
 	var fm=document.getElementsByTagName('form')[0];
 	var pass=document.getElementById('pass');
 	fm[1].onclick=function(){
 		pass.style.display='none';
 	};
 	fm[2].onclick=function(){
 		pass.style.display='block';
 	};
 	
	
	
 	
 	fm.onsubmit=function(){
 		 if(fm.username.value.length<2||fm.username.value.length>20){
			 alert('album name should longer then 2 and shorter than 20');
			 fm.username.value="";
			 fm.username.focus();//move the pointer to that place
			 return false;
			 }
			 if(fm[2].checked){
				if(fm.password.value.length<6){
					 alert('album password should not shorter than 6');
					 fm.username.value="";
					 fm.username.focus();//move the pointer to that place
					 return false;
					 }	 	
			 }
			 return true;
 		};
 }