<?php
echo '<script language="javeScript">
     window.onload=function(){
 	var ret=document.getElementById("return");
 	var del=document.getElementById("delete");
 	ret.onclick=function(){
 		history.back();
 	}
 	del.onclick = function(){
 		if(confirm("delete this message?")){
 			location.href="?action=delete&id="+this.name;
 		}
 	}
}
    </script>';
?>
