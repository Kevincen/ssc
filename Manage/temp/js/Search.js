
function GoSearch (str, $this){
	var url = location.href.split("?")[1].split("=")[1];
	var href = "/Manage/temp/Actfor.php?cid="+url;
	
	if (str == "Estate") {
		href += "&Estate="+$this.value;
	} else {
		//var FindType = $("#FindType").val();
        var FindType = 'g_name';//当前默认为按账号查询，如果要按照名称查询则该值改为g_f_name
		var searchName = $("#se_con").val();
		if (searchName == "") {
			alert("请输入查询条件！");
			return;
		} else {
			href +="&searchName="+searchName+"&FindType="+FindType;
		}
	}
	location.href = href;
}

function closeUser(name, $this, lid){
	if (confirm("確定將 "+name+" 用戶踢出系統嗎？")){
		$.post("/Manage/temp/ajax/json.php", {typeid : 10, sUid : name, lid : lid}, function(data){
			if (data == 1){
				$this.src ="/Manage/temp/images/USER_0.gif";
				$this.classNmae="";
				$this.title="";
				$this.onclick=""
			}
		});
	}
}
