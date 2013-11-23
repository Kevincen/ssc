var _url = "/Manage/temp/ajax/oddsJsongx.php";
var val = 1;
$(function(){
		loadOdds();
});

/**
 * 加載賠率
 */
function loadOdds(){
	var s_odds = $("#s_odds").val();
	var a = new Array('a', 'b');
	$.post(_url, {mid : s_odds}, function(data){
		for (var i in data.oddsList){
			for (var h in data.oddsList[i]){
				var __odds = isFloat(data.oddsList[i][h]);
				if (s_odds == 1){
					$("#"+h).html(__odds);
				} else {
					$("#"+a[i]+h).html(__odds);
				}
			}
		}
	}, "json");
}

/**
 * 設置賠率
 */
function setodds(str, tid, $this){
	var oddsHtml = $("#"+str);
	var odds = parseFloat(oddsHtml.html());
	var Ho = $("#Ho").val();
	var h = str.substr(1);
	var value = $this.name;
	if (Ho == "" || !/^[0-9]+\.?[0-9]*$/.test(Ho)){$("#Ho").val("0.001");return}
	Ho = parseFloat(Ho);
	if (value == "1"){
		odds = (odds + Ho);
	} 
	else {
		if (odds < Ho){return}
		odds = (odds - Ho);
	}
	$.post(_url, {mid : 4, tid : tid, hid : h, oid : odds}, function(data){
		oddsHtml.html(isFloat(odds));
	},"text");
}

function isFloat(sInt){
	var p =  /(\.[0-9]+)/;
	if (p.test(sInt)){
		return parseFloat(sInt).toFixed(3);
	}
	return sInt;
}

function upOddaAll($this){
	if (confirm("確認更變賠率碼？")){
		var oddsType = $("#oddsType").val();
		var s_num = $("#s_num").val();
		var h = $("#h").val();
		var Ho = $("#Ho").val();
		if (Ho == "" || !/^[0-9]+\.?[0-9]*$/.test(Ho)){$("#Ho").val("0.01");return}
		$.post(_url, {mid : 5, oddsType : oddsType, h : h, s_num : s_num, sHo : Ho}, function(data){
			loadOdds();
		}, "text");
	}
}