/**
 * 
 */
window.onload=function(){
	code();
	var ubb=document.getElementById('ubb');
	var ubbimg=ubb.getElementsByTagName('img');
	var fm=document.getElementsByTagName('form')[0];
	var font=document.getElementById('font');
	var color=document.getElementsByTagId('color');
	var html=document.getElementsByTagName('html');
	
	var q=document.getElementById('q');
	var qa=q.getElementsByTagName('a');
	
	 fm.onsubmit=function(){
	
	
	 if(fm.title.value.length<2||fm.title.value.length>40){
		 alert('title should longer then 2 and shorter than 40');
		 fm.title.value="";
		 fm.title.focus();//move the pointer to that place
		 return false;
     }
	 if(fm.content.value.length<10){
		 alert('content should not shorter than 10');
		 fm.content.value="";
		 fm.content.focus();//move the pointer to that place
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
	
	
	qa[0].onclick=function(){
		window.open('q.php?num/1/1','q','width=400px,height=400px,scrollbar=1')
	}
	qa[1].onclick=function(){
		window.open('q.php?num/1/1','q','width=400px,height=400px,scrollbar=1')
	}
	qa[2].onclick=function(){
		window.open('q.php?num/1/1','q','width=400px,height=400px,scrollbar=1')
	}
	
	html.onmouseup=function(){
		font.style.display='none';
		color.style.display='none';
	};
	ubbimg[0].onclick=function(){
		font.style.display='block';
	};
	ubbimg[2].onclick=function(){
		content('[b][/b]');
	};
	function content(string){
		{
		fm.content.value +=string;
		}
		fm.t.onclick=function(){
			showcolor(this.value);
		}
	}
    
	ubbimg[3].onclick=function(){
		content('[i][/i]');
	};
	ubbimg[4].onclick=function(){
		content('[u][/u]');
	};
	ubbimg[5].onclick=function(){
		content('[s][/s]');
	};	
	
	ubbimg[7].onclick=function(){
		color.style.displau='block';
		fm.t.focus();
	}
	ubbimg[8].onclick=function(){
		var url=prompt('enter url','http://');
		if (url){
			if (/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/.test(url)){
			content('[url]'+url+'[/url]');
		}
		else{
			alert('url not legal');}
	}
};	
	
	ubbimg[9].onclick=function(){
		var email=prompt('enter email','@');
		if (email){
			if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(email)){
			content('[email]'+url+'[/email]');
		}
		else{
			alert('email not legal');}
	}
	};	
	
	ubbimg[10].onclick=function(){
		var img=prompt('enter img','');
		if (img){
		content('[img]'+img+'[/img]');
		}
	}
	
	ubbimg[11].onclick=function(){
		var flash=prompt('enter flash','http://');
		if (flash){
			if (/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+/.test(url)){
			content('[flash]'+url+'[/flash]');
		}
		else{
			alert('flash not legal');}
	}	
    };
    ubbimg[18].onclick=function(){
    	fm.content.rows+=2;
    };
    
    ubbimg[19].onclick=function(){
    	fm.content.rows-=2;
    };
}   

    function font(size){
    	document.getElementsByTagName('form')[0].content.value +='[size='+size+'][/size]';
    };
    function showcolor(value){
    document.getElementsByTagName('form')[0].content.value +='[color='+value+'][/color]';
    };
