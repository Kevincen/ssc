if (top.location == self.location) top.location.href = "/";
document.onkeydown = function(){ 
	if ( event.keyCode==116) { 
		event.keyCode = 0; 
		event.cancelBubble = true; 
		return false; 
	}
}

 function SetCookie(name,value) 
{  
    var Days = 30;  
    var exp = new Date();    
   exp.setTime(exp.getTime() + Days*24*60*60*1000);  
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();  
 }  


function getCookie(name) 
 {  
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));  
    if(arr != null) return unescape(arr[2]); return null;  
 }  




function getwin()
	{
		var URL = "../ajax/Default.ajax.php";
		var winResult = $("#sy");
		$.ajax({
			type : "POST",
			url : URL ,
			data : {typeid : "getwin"},
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						getwin();
						return false;
					}
				}
			},
			success:function(data){
				winResult.html(data);
			}
		});
	}
setInterval(getwin, 5000);

function in_array($key,$arr){
	for(var i=0;i<$arr.length;i++){
		if($arr[i]==$key)return true;
	}	
}

function IsNumeric(){
	if( (event.keyCode>=96 && event.keyCode<=105) || (event.keyCode>=48 && event.keyCode<=57) || (event.keyCode==46) || (event.keyCode>=37 && event.keyCode<=40)  || event.keyCode==8){
		return true;	
	}
	 
	if(event.keyCode==110){
		return true;	
	}	
	 
	return false;	
}