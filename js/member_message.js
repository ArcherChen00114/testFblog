/**
 * 
 */
window.onload=function(){
	var all=document.getElementByid('all');
	var fm=document.getElementsByTagName('from')[0];
	all.onclick=function(){
		for (var i=0,i<fm.elements.length,i++){
			if(fm.elemens[i].name='checkall')
				fm.elements[i].checked=fm.checkall.checked;
		}
	}
	fm.onsubmit=function(){
		if(confirm('Are you sure you want to DELETE THOSE message?')){
			return true;
		}
		return false;
	}
}