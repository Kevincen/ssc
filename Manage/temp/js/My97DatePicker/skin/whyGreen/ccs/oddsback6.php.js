var _id = null;
$(function(){
	$.post("numjson.php", {mid : 1}, function(data){
		if (data != null){
			var a=new Array();
			for (var i in data.rows){
				a.push('<option value="'+data.rows[i]+'">'+data.rows[i]+'</option>');
			}
			$("#numbers").html('<option value="0" selected="selected">-----請選擇-----</option>'+a.join(''));
			$("#startNumber").html('<option value="0" selected="selected">----開始期數----</option>'+a.join(''));
			$("#endNumber").html('<option value="0" selected="selected">----結束期數----</option>'+a.join(''));
		}
	}, "json");
});
function FromSubmit($this, sInt, sInt2,sInt3){
	var href;
	var r = $("#rs").attr("checked") ? 1 : 0;
	if (sInt == 1){
		href = "CrystalInfo.php?type="+sInt3+"&uid="+$this.value+"&tid="+sInt2+"&rid="+r;
	} else {
		var Find = $("#"+$this);
		var searchName = $("#searchName");
		if (searchName.val() == ""){
			alert("請輸入查詢內容！");
			return;
		} else {
			href = "CrystalInfo.php?type="+sInt3+"&Find="+Find.val()+"&searchName="+searchName.val()+"&rid="+r;
		}
	}
	location.href = href;
}

function delCrystal($this, id){
	_id = id;
	var _this = $($this);
	var oddsPop = $("#oddsPops");
	var offsetTop = "20%";
	var offsetLeft = "40%";
	$("#typeids").html("單號&nbsp;"+id+"#");
	$("#oddsPops").fadeIn(100).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function GoDel(){
	if (confirm("單號 "+_id+"# 確定刪除嗎？")){
		var ros = $("#ros").attr("checked");
		var sid = 0;
		if (ros == true){
			sid =1;
		} 
		location.href = "/function/DelCry.php?delid="+_id+"&sid="+sid;
	}
}

	function closesPop(){
		$("#oddsPops").fadeOut(100);
		$("#ros").attr("checked","");
	}

	function delAll(){
		if (confirm("確定刪除嗎？")){
			var startNumber = $("#startNumber").val();
			var endNumber = $("#endNumber").val();
			location.href = "/function/DelCry.php?startNumber="+startNumber+"&endNumber="+endNumber;
		}
	}