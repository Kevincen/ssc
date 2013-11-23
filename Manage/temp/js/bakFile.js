var _sType, _files;

function locationFile(strInt, files){
	_sType = strInt;
	_files = files;
	var oddsPop = $("#oddsPops");
	var offsetTop = "20%";
	var offsetLeft = "46%";
	$("#oddsPops").slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function isUserCode($this){
	var psCode = $("#psCode").val();
	var showPas = $("#showPas");
	$this.disabled = "disabled";
	showPas.html("正在驗證安全碼...").css("color","red");
	$.post("/Manage/temp/ajax/json.php", {typeid : "codeid", mid : psCode}, function(data){
		if (data == "1") {
			closesPop();
			locationHref(_sType, _files);
		}
		 else {
		 	showPas.html("安全嗎錯誤！");
		 	setTimeout(function(){
		 		closesPop();
		 	}, 3000);
		 }
	}, "text");
	
}

function locationHref(sint, str){
	switch (sint){
		case "1" : 
			if (confirm("警告：還原數據庫前請先備份現有的數據。\n  確定嗎？")){
				location.href = "BakInfo.php?bid=1&fileid="+str;
			} break;
		case "2" : 
			location.href = "BakInfo.php?bid=2&fileid="+str;
			break;
		case "3" : 
			if (confirm("警告：此操作不可逆，刪除之前請確保已有備份。\n  確定嗎？")){
				location.href = "BakInfo.php?bid=3&fileid="+str;
			} break;
	}
}


function closesPop(){
	$("#oddsPops").slideToggle(200);
	$("#isSubmit").attr("disabled","");
	$("#showPas").html('&nbsp;請輸入安全碼：<input class="textc" id="psCode" type="password" />').css("color","");
}
	
function dataBakPost(){
		var bak = document.getElementById("bak");
		bak.disabled = "disabled";
		if (confirm("警告：不建議訪問量大時候進行備份。\n確定立刻備份數據庫嗎？")){
			bak.value="寫入中...";
			return true;
		} else {
			bak.disabled = "";
			return false;
		}
	}