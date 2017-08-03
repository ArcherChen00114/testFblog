/**
 * 
 */
 
 window.onload=function(){

 	var ret=document.getElementsById('return')[0];
 	var del=document.getElementsById('delete')[0];
 	ret.onclick=function(){
 		history.back();
 	}
 	del.onclick = function(){
 		if(confirm('delete this message?')){
 			location.href='?action=delete&id='+this.name;
 		}
 	}
}