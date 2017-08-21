/**
 * 
 */
window.onload=function(){
	var up=document.getElementById('up');
	up.onclick=function(){
		centerWindow('upimg.php?dir='+this.title,'up','100','400');
	}
	var fm=document.getElementsByTagName('form')[0];
	
     if(fm.url.value==''){
     	alert('url should not be null');
     	fm.url.focus();
     	return false;
     }
     fm.onsubmit=function(){
	 if(fm.name.value.length<2||fm.name.value.length>40){
		 alert('picture name should longer then 2 and shorter than 40');
		 fm.title.focus();//move the pointer to that place
		 return false;
     }
     return ture;
	}
}
 function centerWindow(url,name,height,width){
 	var left=(screen.width-width)/2;
 	var top=(screen.height-height)/2;
    window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left); 	
 }