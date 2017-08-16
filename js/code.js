/**
 * 
 */
function code(){
	var code=document.getElementById('passcode');
	code.onclick=function(){
	this.src='image.php?tm='+Math.random();
	}
}