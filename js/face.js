/**
 * 
 */
 window.onload=function(){
 	var faceimg=document.getElementById('faceimg');
 	faceimg.onclick=function(){
 		window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
 	}
 };
//wait until the web is ready
 var fm=document.getELementsByTagName('form')[0];
 alert(fm);
 fm.onsubmit=function(){
	 //try not do everything on server
     //
     if(fm.username.value.length<2||fm.username.value.length>20){
	 alert('user name should longer then 2 and shorter than 20');
	 
     }
 }