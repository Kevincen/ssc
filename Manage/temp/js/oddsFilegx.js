var url = null, dataList = null, lock=false;
var Urls = "/Manage/temp/ajax/jsongx.php";
var EstateTime = 90;
var EndTime = 90;
var StartTime = 90;
var phasesNumber, EndTimeHtml, RefreshTimeHtml, NumberHtml, CountNumHtml, 
CountNumsHtml, CountLoseHtml, CountWinHtml, TimeArr = new Array();
$(function (){
	url = location.href.split("?")[1].split("=")[1];
	if (url !=10) setList ();
	EstateTime = $("#EstateTime").val();
	NumberHtml = $("#number");
	EndTimeHtml = $("#EndTime");
	RefreshTimeHtml = $("#RefreshTime");
	CountNumHtml = $("#CountNum");
	CountNumsHtml = $("#CountNums");
	CountLoseHtml = $("#CountLose");
	CountWinHtml = $("#CountWin");
	
	loadUserInfo (url);
	setLists();
});

function setList () {
	$.post (Urls, {typeid : 3}, function (data) {
		if (data.num != ""){
			var row_1Html = new Array();
			var setResult = new Array();
			for (var key in data.num){
				row_1Html.push("<tr bgcolor=\"#fff\" height=\"18\"><td  class=\"uo\">"+key+"</td><td class=\"fe\">"+data.num[key]+" 期</td></tr>");
			}
			var cHtml = '<tr class="tr_top"><th colspan="2">兩面長龍排行</th></tr>';
			$("#cl").html(cHtml+row_1Html.join(""));
		}
	}, "json");
};

/**
 * 加載當前登錄用戶即時注單信息
 * @param cid 讀取賠率信息參數
 */
function loadUserInfo (cid){
	$.post(Urls, {typeid : 5, cid : cid}, function(data){
		phasesNumber = data.infoList.phasesNumber;
		NumberHtml.html(phasesNumber);
		$("#win").html(data.dayWin);
		if (data.infoList.endTime>0){
			$("#offTime").html("距封盤：").css("color","#333");
		}
		EndTime = data.infoList.endTime //封盤時間
		StartTime =data.infoList.openTime; //開獎時間
		if (data.infoList.userList != null){
			CountNumHtml.html(Math.round(data.infoList.userList.count[0]));
			CountLoseHtml.html(Math.round(data.infoList.userList.count[1]));
			CountWinHtml.html(Math.round((data.infoList.userList.count[0]-data.infoList.userList.count[8])));
			CountNumsHtml.html(Math.round(data.infoList.userList.count_c[0]));
			if (cid == 10) dataList = data.infoList.userList;
			sumIsNumLose(data.infoList.userList, cid);
		} else {
			initialize ();
		}
		setOdds(data.infoList.oddList);
		if (lock == false){
			endTime ();
			lock = true;
		}
		planning();
	}, "json");
}


/**
 * 賠率
 */
function setOdds (oddsList){
	for (var i in oddsList[0]){
		var _odds = isFloat(oddsList[0][i]);
		$("#"+i).html(_odds);
		var w = i.substr(1);
		$("#w"+w).html(oddsList[0][i]);
	}
}

function isFloat(sInt){
	var p =  /(\.[0-9]+)/;
	if (p.test(sInt)){
		return parseFloat(sInt).toFixed(3);
	}
	return sInt;
}

function sumIsNumLose (infoList, cid){
	if (infoList.list != "" && infoList.list_s !=""){
		for (var key in infoList.list){
			$("#a"+key).html(Math.round(infoList.list[key]));
			$("#d"+key).html(Math.round(infoList.list_s[key]));
		}
	}
	if (infoList.count_c != "" && infoList.count_d != ""){
		for (var key in infoList.count_c){
			var l = parseInt(key)+1;
			//alert(key);
			$("#l"+key).html(Math.round(infoList.count_c[key]));
			$("#f"+l).html(Math.round(infoList.count_d[key]));
		}
	}
}

function initialize (){
	CountNumsHtml.html("0");
	CountNumHtml.html("0");
	CountLoseHtml.html("0");
	CountWinHtml.html("0");
	for (var i=1; i<=35; i++){
		$("#a"+i).html("-");
		$("#d"+i).html("-");
		$("#l"+i).html("0");
		$("#f"+i).html("0");
	}
}

function setLists(){
	if (url !=9 && url !=10){
		if (phasesNumber == undefined){
			setTimeout(setLists, 500);
		} else {
			$.post(Urls, {typeid : 7}, function(data){
				var opNumber = parseInt(data);
				var sum = parseInt(phasesNumber) - opNumber;
				if (sum == 2){
					setTimeout(setLists, 3000);
				} else {
					setList();
					return;
				}
			}, "text");
		}
	}
}

/**
 * 倒計時
 */
function endTime () {
	if (EstateTime < 1 && StartTime > 1) {
		lock = false;
		EstateTime = $("#EstateTime").val();
		loadUserInfo(url);
		return;
	}
	if (EndTime <1) {
		//封盤時間結束 切換開獎時間
		$("td.odds").css("background", "#eee");
		$("#offTime").html("距開獎：").css("color","red");
	}
	if (StartTime <1){
		//開獎時間結束
		lock = false;
		$.post(Urls, {typeid : 9}, function(){});
		$("td.odds").css("background", "#fff");
		$("#offTime").html("距封盤：").css("color","#333");
		loadUserInfo(url);
		setLists();
		return;
	}
	StartTime--; EstateTime--; EndTime--;
	var span = setTime (StartTime);
	EndTimeHtml.html(span[0] + ":" + span[1]);
	RefreshTimeHtml.html(EstateTime);
	setTimeout(endTime, 1000);
}

/**
 * 時間戳轉換
 */
function setTime (times){
	var MinutesRound = Math.floor(times / 60);
	var SecondsRound = Math.round(times - (60 * MinutesRound));
	var Minutes = MinutesRound.toString().length <= 1 ? "0"+MinutesRound : MinutesRound;
	var Seconds = SecondsRound.toString().length <= 1 ? "0"+SecondsRound : SecondsRound;
	TimeArr[0] = Minutes;
	TimeArr[1] = Seconds;
	return TimeArr;
}

/***
 * 單筆補倉函數
 * @param obj 對象
 * @param Int 表示 1打開單補窗口，否則 打開快補窗口
 */
function GoPos($this, sInt){
	if (EndTime > 1) {
		if ($this != null) {
			var _this = $($this);
			var offsetTop = _this.offset().top;
			var offsetLeft = _this.offset().left;
		}
		if (sInt == 1) {
		 	var s = _this.attr("id").substr(1);
		 	var h = $("#h"+s).html();
		 	var n = $("#n"+s).html();
		 	var a = $("#a"+s).html();
		 	var b = $("#b"+s).html();
		 	if (a != "-" && a > 0) {
			 	b == "" ? $("#money_s").html(a) : $("#money_s").html(b);
			 	$("#type_s").html(n);
			 	$("#odds_s").html(h);
			 	$("#oddsPop").fadeIn(200).css({top : offsetTop + 10, left : offsetLeft -70});
		 	}
		} else if (sInt == 2) {
			 $("#sOddsPop").fadeIn(300).css({top : offsetTop + -330, left : offsetLeft -200, "display" : "block"});
		} else {
			if (dataList != null) {
				var list = new Array();
				for (var i=0; i<dataList.length; i++){
					list.push('<tr class="text" align="right">');
					list.push('<td align="center">'+dataList[i].g_id+'#</td>');
					list.push('<td align="center">'+dataList[i].g_mingxi_1+' @ '+dataList[i].g_odds+'</td>');
					list.push('<td class="rights">'+dataList[i].g_jiner+'</td>');
					var ts = ((100-dataList[i].g_tueishui)/100) * dataList[i].g_jiner;
					var win = (dataList[i].g_jiner*dataList[i].g_odds - dataList[i].g_jiner)+ts;
					list.push('<td class="rights">'+win.toFixed(1)+'</td>');
					list.push('<td align="center">成功補出</td>');
					list.push('</tr>');
				}
				list.push('<tr class="texts" align="center">');
				list.push('<td colspan="5"><input type="button" class="inputa" onclick="closePop(3)" value="關閉" /></td>');
				list.push('</tr>');
				$("#vList").html(list.join(''));
				$("#kOddsPop").fadeIn(200).css("display" , "block");
			}
		}
	}
}

/***
 * 快速補倉函數 1-20號碼
 * @param Int 表示 1單補函數，否則快補函數
 */
function GoPost (sInt){
	if (sInt == 1){
		if (confirm("確定碼？")){
			GoPos(null, 3);
		}
	} else {
		var s_type = $("#s_type").html();
		var s_num = $("#type_s").html();
		var s_odds = $("#odds_s").html();
		var s_money = $("#s_money").val();
		var s_max = $("#money_s").html();
		if (s_money == "" || !/^[0-9]*$/.test(s_money) || parseInt(s_money)>parseInt(s_max)){
			alert("輸入補倉金額錯誤！");
			return;
		}
		if (parseInt(s_money)<10){
			alert("補倉金額最小為："+10);
			return;
		}
		if (confirm("確定碼？")){
			PostForm({
				s_number : NumberHtml.html(),
				s_type : s_type,
				s_num : s_num,
				s_odds : s_odds,
				s_money : s_money
			});
		}
	}
}

var dataList = null;
function PostForm(args){
	//alert(args.s_number+args.s_type+args.s_num+args.s_odds+args.s_money+args.s_count+args.s_id);
	$.post(Urls, {
			typeid : 6, 
			s_number : args.s_number, 
			 s_type : args.s_type, 
			 s_num : args.s_num, 
			 s_odds : args.s_odds, 
			 s_money : args.s_money,
			 s_count : args.s_count,
			 s_id : args.s_id
		 }, function(data){
		 	//alert(data);return;
		if (data.error == ""){
			dataList = data.ResultList;
			loadUserInfo (url);
			if (args.s_int == 1){
				$("#s_table").css("display", "none");
				alert("成功補出");
			} else {
				GoPos(null, 3);
			}
		}else {
			alert(data.error);
		}
		closePop(1);
	}, "json");
}

/***
 * 關閉Pop窗口
 */
function closePop(sInt){
	if (sInt == 1){
		$("#oddsPop").fadeOut(300);
	} else if (sInt == 2) {
		$("#sOddsPop").fadeOut(300);
	} else {
		$("#kOddsPop").fadeOut(300);
	}
	$("#s_money").val("");
}

/***
 * 評價虧損 計算
 */
function planning(){ 
	var Param = parseInt($("#Param").val()); //平均值
	for (var i=1; i<36; i++){
		var d = parseInt($("#d"+i).html()); //虧盈
		var h = $("#h"+i).html(); //賠率
		var b = $("#b"+i);  //輸出 
		if (d!=null && d < Param && Param < 0){ 
			var s = (d - Param) / h - 1;
			b.html(s.toFixed(0).substr(1)); 
		} else {
			b.html("");
		}
	}
}

function GoPinn ($this){
	$("#a_s_type").html($this.value);
	var sList = $("#sList");
	if (dataList != null){
		//alert(dataList.list_z.z104);
		switch ($this.id){
			case "101" :_arrAy(dataList.list_z.z101,dataList.list_n.n101, dataList.list_t.t101,dataList.list_p.p101,dataList.list_o.o101,dataList.list_id.i101);break;
			case "102" :_arrAy(dataList.list_z.z102,dataList.list_n.n102, dataList.list_t.t102,dataList.list_p.p102,dataList.list_o.o102,dataList.list_id.i102);break;
			case "103" :_arrAy(dataList.list_z.z103,dataList.list_n.n103, dataList.list_t.t103,dataList.list_p.p103,dataList.list_o.o103,dataList.list_id.i103);break;
			case "104" :_arrAy(dataList.list_z.z104,dataList.list_n.n104, dataList.list_t.t104,dataList.list_p.p104,dataList.list_o.o104,dataList.list_id.i104);break;
			case "105" :_arrAy(dataList.list_z.z105,dataList.list_n.n105, dataList.list_t.t105,dataList.list_p.p105,dataList.list_o.o105,dataList.list_id.i105);break;
			case "106" :_arrAy(dataList.list_z.z106,dataList.list_n.n106, dataList.list_t.t106,dataList.list_p.p106,dataList.list_o.o106,dataList.list_id.i106);break;
		}
	}
}

var _arrAy = function(dataLists,dataListn,dataListt,dataListp,dataListo,dataListi){
	var list = new Array();
	if (dataLists != undefined){
		for (var i=0; i<dataLists.length; i++){
			list.push("<tr align=\"center\">");
			list.push("<td>"+ (i+1)+"</td>");
			list.push("<td>"+dataLists[i]+"</td>");
			list.push("<td class=\"mid\">"+Math.round(dataListn[i])+"</td>");
			list.push("<td class=\"odds\">"+dataListo[i]+"&nbsp;組</td>");
			list.push("<td width=\"70\"><input type=\"text\" id=\"r"+(i+1)+"\" class=\"texta ca\" /></td>");
			list.push("<td>"+Math.round(dataListt[i])+"</td>");
			list.push("<td style=\"color:red\">"+Math.round(dataListp[i])+"</td>");
			list.push("<td width=\"50\"><input onclick=\"GoSums('"+dataLists[i]+"','"+(i+1)+"','"+dataListo[i]+"','"+dataListn[i]+"','"+dataListi[i]+"')\"  type=\"button\" value=\"補貨\" /></td>");
			list.push("</tr>");
		}
	}
	$("#sList").html(list.join(''));
	$("#s_table").css("display", "");
}

function GoSum(){
	var kb = $("#kb").val();
	var mid = parseInt($(".mid").html());
	if(/^[0-9]*$/.test(kb) && kb < mid){
		var mids = $(".ca");
		kb = parseInt(kb);
		mids.val(mid-kb);
	}
}

/**
 * @param num 號碼組合
 * @param sInt Input ID值
 * @param cInt 總組數
 */
function GoSums(num, sInt, cInt, m, id){
	var s_type = $("#a_s_type").html();
	var s_val = $("#r"+sInt);
	var ms = Math.floor((parseInt(m) / parseInt(cInt)));
	if (s_val.val() == ""){return}
	if (ms <=0){return}
	if (parseInt(s_val.val()) <10){alert("補貨最低限額：10");return;}
	if (!/^[0-9]*$/.test(s_val.val()) || parseInt(s_val.val()) == 0){s_val.val("");return}
	if (parseInt(s_val.val()) > ms){alert("單組補貨限額："+ms);s_val.val(ms);return}
	if (confirm("確定碼？")){
		PostForm({
				s_number : NumberHtml.html(),
				s_type : s_type,
				s_num : num,
				s_odds : "LM",
				s_money : s_val.val(),
				s_count : cInt,
				s_int : 1,
				s_id : id
			});
		/*GoPos(null, 3);*/
	}
}

function Gost(){
	var param;
	$(".ca").each(function(){
		if($(this).val() == "" || /^[1-9]*[0-9]$/.test($(this).val()) == false){
			param = false;
			return;
		}else {
			param = true;
		}
	});
	if (param){
		if (confirm("確定碼？")){
			GoPos(null, 3);
		}
	}
}


