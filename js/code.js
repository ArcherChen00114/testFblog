/**
 * 
 */
function code(){
	var code=document.getElementById('passcode');
	if (passcode!=null){
	code.onclick=function(){
	this.src='image.php?tm='+Math.random();
	}
  }
}