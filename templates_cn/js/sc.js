document.onkeydown = function()
{ 
	if ( event.keyCode==116) { 
		event.keyCode = 0; 
		event.cancelBubble = true; 
		return false; 
	}
}
//写入cookie
function SetCookie(name,value) 
{  
    var Days = 30;  
    var exp = new Date();    
   	exp.setTime(exp.getTime() + Days*24*60*60*1000);  
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();  
}

//获取cookie
function getCookie(name) 
{  
	var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));  
	if(arr != null) return unescape(arr[2]); return null;  
}  

//获取投注结果
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
//定时获取投注结果
setInterval(getwin, 5000);


function in_array($key,$arr)
{
	for(var i=0;i<$arr.length;i++){
		if($arr[i]==$key)return true;
	}	
}

function IsNumeric()
{
	if( (event.keyCode>=96 && event.keyCode<=105) || (event.keyCode>=48 && event.keyCode<=57) || (event.keyCode==46) || (event.keyCode>=37 && event.keyCode<=40)  || event.keyCode==8)
	{
		return true;	
	}
	 
	if(event.keyCode==110){
		return true;	
	}	
	 
	return false;	
}

//by 2b 投注提示框体流程
function submit_confirm(ball_array,odd_array,money_array)
{
    var html_code;
    var total_money = 0;
    for (var i=0;i<ball_array.length;i++) {
        html_code += '<tr>';
        html_code += '<td>'+ball_array[i]+'</td>';
        html_code += '<td>'+ odd_array[i]+'</td>';
        html_code += '<td>' +money_array[i] + '</td>';
        html_code += '</tr>';
        total_money += money_array[i];
    }
    $('#orderList').html(html_code);
    $('#groupNum').html(ball_array.length);
    $('#totalAmount').html(total_money);

    var maindialog = art.dialog({
        title:'下注明细（请确认注单）',
        content:document.getElementById('popup_form'),
        drag:true,
        width:'410px',
        ok:function(){
            //提交表单
            $.post("../ajax/Default.ajax.php", { typeid : "sessionId"}, function(){});
            $('#dp').submit();
            $('#lm').submit();
            this.close();
        },
        cancel:function(){
            var is_close = false;
            art.dialog({
                title:'用户提示',
                content:'是否确定取消注单',
                drag:true,
                width:'410px',
                ok:function(){
                    maindialog.close();
                    return true;
                },
                cancel:function() {
                    return true;
                }
            });
            //阻止表单提交
            return is_close;
        }
    });
}
//一般提示信息窗体
function my_alert(message,ok_func) {
    art.dialog({
        title:'用户提示',
        content:message,
        drag:true,
        width:'410px',
        ok:function(){
        }
    });
}


