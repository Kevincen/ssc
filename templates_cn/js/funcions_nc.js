//投注post_odds
var _lock = false;
var setAction = new Array();
var setTime = new Array(); 
var setHtml = new Array();
var MinutesRound = new Array();
var SecondsRound = new Array();
var setResult = new Array();
var URL = "../ajax/Default.ajax_nc.php";
var _href = location.href.split("?g=")[1];


function action(set_lm, unset_lm){
	if (_href == "g9") return;
	$.post (URL, { typeid : "action", nid : _href },  function (data) {
		//alert(data);return;
		if (data == null){
			//location.href='./right.php';
            unset_lm();
			return;
		}
		$("#o").html(data.Phases);
		setTime[0] = data.endTime; //封盤時間
		setTime[1] = data.openTime; //開獎時間
		setTime[2] = data.refreshTime; //刷新時間
		setHtml[0] = $("#endTime");
		setHtml[1] = $("#endTimes");
		setHtml[2] = $("#endTimea");
		if (setTime[0] > 0){
			setAction[3](true, data.odds); //賠率
			display(true,true);
            if (set_lm != undefined) {
                set_lm();
            }
        }else {
            if (unset_lm != undefined) {
                unset_lm();
            }
        }
		setAction[8]();
		setAction[0]();
		setAction[1]();
		setAction[2]();
		serOpTirem();
	}, "json");
}

function serOpTirem (){
	var opNumber = $("#n").html();
	var nowNumer = $("#o").html();
	if (opNumber != ""){
		var sum = parseInt(nowNumer) -  parseInt(opNumber);
		if (sum == 2) setAction[8]();
		return;
	} else {
		setTimeout(serOpTirem, 2000);
	}
}

setAction[0] = function() { //封盤時間和開盤期數
if(getCookie("soundbut")==null){
	SetCookie("soundbut","on");
	}
if(getCookie("soundbut")=="on"){
		$("#soundbut").attr("value","on");
		$("#soundbut").attr("src","images/soundon.png");
		}else{
			$("#soundbut").attr("value","off");
		$("#soundbut").attr("src","images/soundoff.png");
			}
	if (setTime[0]<10&&setTime[0]>0){
	if($("#soundbut").attr("value")=="on"){
	$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/d.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");		
	}	
}
	if (setTime[0] <1){
		setAction[3](false, null);
		display(false,false);
		setHtml[0].html("00:00");
		return;
	} else {
		MinutesRound[0] = Math.floor(setTime[0] / 60);
	    SecondsRound[0] = Math.round(setTime[0] - (60 * MinutesRound[0]));
	    var Minutes = MinutesRound[0].toString().length <= 1 ? "0"+MinutesRound[0] : MinutesRound[0];
	    var Seconds = SecondsRound[0].toString().length <= 1 ? "0"+SecondsRound[0] : SecondsRound[0];
	    setHtml[0].html(Minutes + ":" + Seconds);
	    setTime[0]--;
	    setTimeout(setAction[0], 1000);
	}
};

setAction[1] = function (){ //開獎時間
	if (setTime[1] < 1){ 
		setHtml[1].html("00:00");
		setTime[2] = 5;
		setAction[8]();
        //开奖时间结束也就是要开下一期的时候：要刷新左侧的注单
        window.parent.leftFrame.$('#new_orders').html('');
        window.parent.leftFrame.$('#used_money').html('0');
		_lock = true;
		return;
	} else {
		MinutesRound[1] = Math.floor(setTime[1] / 60);
	    SecondsRound[1] = Math.round(setTime[1] - (60 * MinutesRound[1]));
	    var Minutes = MinutesRound[1].toString().length <= 1 ? "0"+MinutesRound[1] : MinutesRound[1];
	    var Seconds = SecondsRound[1].toString().length <= 1 ? "0"+SecondsRound[1] : SecondsRound[1];
	    setHtml[1].html(Minutes + ":" + Seconds);
	    setTime[1]--;
	    setTimeout(setAction[1], 1000);
	}
};

setAction[2] = function () { //刷新時間
	setHtml[2].html(setTime[2]);
	if (setTime[2] < 1){
		$.post (URL, {typeid : "action", nid : _href}, function (data) {
			if (data == null){
           //     location.href='./right.php';
                return;
            }
			setTime[0] = data.endTime;
			setTime[1] = data.openTime;
			setTime[2] = data.refreshTime;
			setAction[3](true, data.odds);
			if (_lock == true) {
				$("#o").html(data.Phases);
				setAction[0]();
				setAction[1]();
				_lock=false;
			}
		}, "json");
	}
	setTime[2]--;
	setTimeout(setAction[2], 1000);
};

setAction[3] = function(lock, odds) { //賠率
	var Oclass = $(".o");
	var nunId = encodeURI($("#o").html());
	var tysId = encodeURI($("#tys").html());
	if (!lock) {Oclass.html("-");display(false,false);return}
	if (setTime[0] > 0){
		display(true,true);
		Oclass.each( function () {
			var $thisId = encodeURI($(this).attr("id"));
			var $odds = sodds($thisId, odds); //賠率對應
			var clas = "s"+$thisId.replace("h","");
			if (_href == "LIANMA"){
				//if ($thisId == "h2" || $thisId == "h5" )
				//	$(this).html("<span id=\""+clas+"\" class=\"bgs\">-</span>");
			//	else
					$(this).html("<span id=\""+clas+"\" class=\"bgs\">"+$odds+"</span>");
			}
			else 
				$(this).html("<span class=\"bgh\">"+$odds+"</span>");
		});
	}
};

setAction[4] = function(lock) { //輸入框
	var id = $("td.tt");
	id.each(function () {
		if ($(this).attr("id") != "") {
			if (lock)
				$(this).html("<input name=\""+$(this).attr("id")+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>");
			else
				$(this).html("封盤");
		}
	});
};

setAction[5] = function(lock) { //單選框
	var rid = $("#ts"), rArr = [];
	if (lock){
		for (var i=1; i<=8; i++) {
			//if (i == 2 || i == 5 ){
			//	rArr.push('<td height="20"></td>');
			//}else{
				rArr.push('<td height="20"><input type="radio" onclick="cRadio(this)" name="gg" value="t'+i+'" /></td>');
		//	}
		}
		rid.html(rArr.join(''));
	} else {
		rid.html("");
	}
};

setAction[6] = function () { //出球率與無出期數
    function set_red(number) {
        if (number >= 4) {
            number = '<span class="red fontweight">'+ number +'</span>';
        }
        return number;
    }
	if (_href.indexOf("g") > -1){
		var gid = _href.replace("g","");
		$.post (URL, {typeid : "sumball", gid : gid}, function (data) {
			//alert(data);return;
			var th1 = '<th>冷热</th>';
			var th2 = '<th>遗漏</th>';
			var row_1Html = new Array();
			var row_2Html = new Array();
			for (var i in data.row_1) {
				row_1Html.push("<td>"+set_red(data.row_1[i])+"</td>");
				row_2Html.push("<td>"+set_red(data.row_2[i])+"</td>");
			}
			$("#su").html(th1+row_1Html.join(''));
			$("#se").html(th2+row_2Html.join(''));
		}, "json");
	}
};

setAction[7] = function () { //兩面長龍
	//if (_href.indexOf("k2") > -1) return;
    //for debug
    if (typeof(Simplized) == undefined ) {
        alert('Simplized undefined');
    }
	$.post (URL, {typeid : "sumball_s", href : _href}, function (data) {
		//alert(data);return;
		var row_1Html = new Array();
		var row_2Html = new Array();
		var sHtml = null;
		setResult[0] = data.row_2; //號碼
		setResult[1] = data.row_3; //大小
		setResult[2] = data.row_4; //單雙
		setResult[3] = data.row_5; //尾數大小
		setResult[4] = data.row_6; //合數單雙
		setResult[5] = data.row_7; //方位
		setResult[6] = data.row_8; //中發白
		setResult[7] = data.row_9; //總和大小
		setResult[8] = data.row_10; //總和單雙
		setResult[9] = data.row_11; //總和尾數大小
		setResult[10] = data.row_12; //龍虎
		if (data.row_1 != ""){
			for (var key in data.row_1){
				row_1Html.push("<tr bgcolor=\"#fff\" height=\"22\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+Simplized(key)+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+data.row_1[key]+" 期</td></tr>");
			}
			var cHtml = '<tr class="t_list_caption"><th colspan="2">两面长龙排行</th></tr>';
			$("#cl").html(cHtml+row_1Html.join(""));
		}
		for (var k in data.row_2){
			row_2Html.push(data.row_2[k]);
		}
		$("#z_cl").html(row_2Html.join(''));
		$(".z_cl:even").addClass("hhg");
	}, "json");
};

var NumberCache = null;
setAction[8] = function () { //开奖
	var winResult = $("#sy");
		$.post (URL, { typeid : "openNumber"}, function (data) {
			//alert(data);return;
			if (NumberCache == null){
				NumberCache = data.number;
				_Number(data.number, data.ballArr);
				setAction[6]();
				setAction[7]();
				winResult.html(data.winMoney);
				return;
			} else if (NumberCache != null && NumberCache != data.number) {
				if($("#soundbut").attr("value")=="on"){
				$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
				}getinfotop();
                kaijiang_sound();
				NumberCache = data.number;
				_Number(data.number, data.ballArr);
				setAction[6]();
				setAction[7]();
				winResult.html(data.winMoney);
				return;
			} else {
				setTimeout(setAction[8], 3000);
			}
		}, "json");
};

function _Number (number, ballArr) {
	var Clss = null;
	var idArr = ["#a","#b","#c","#d","#e","#f","#g","#h"];
	$("#number").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "number num"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
	}
}

//顯示輸入框和單選框
function display (inputLock, radioLock)
{
	setAction[4](inputLock);
	setAction[5](radioLock);
}
//------------------------------------------------------end

function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function changes ($t, n) {
	var result = "";
	var $n = n.replace("t","");
	if ($t == "總和、家禽野兽" || $t == "家禽野兽"  || $t=="總和"){
		switch ($n) {
			case "1": result = '總和大'; break;
			case "2": result = '總和單'; break;
			case "3": result = '總和小'; break;
			case "4": result = '總和雙'; break;
			case "5": result = '總和尾大'; break;
			case "6": result = '家禽'; break;
			case "7": result = '總和尾小'; break;
			case "8": result = '野兽'; break;
			default : result = $n;
		}
	}

	if ($t == "第一球" || $t == "第二球" || $t == "第三球" || $t == "第四球" || $t == "第五球" || $t == "第六球" || $t == "第七球" || $t == "第八球"){
		if ($n.length <=1) {
			result = '0'+$n;
		}
		else {
			switch ($n) {
				case "21": result = '大'; break;
				case "22": result = '小'; break;
				case "23": result = '單'; break;
				case "24": result = '雙'; break;
				case "25": result = '尾大'; break;
				case "26": result = '尾小'; break;
				case "27": result = '合數單'; break;
				case "28": result = '合數雙'; break;
				case "29": result = '梅'; break;
				case "30": result = '兰'; break;
				case "31": result = '菊'; break;
				case "32": result = '竹'; break;
				case "33": result = '中'; break;
				case "34": result = '發'; break;
				case "35": result = '白'; break;
                case "36": result = '龙'; break;
                case "37": result = '虎'; break;
				default : result = $n;
			}
		}
	}
	return result;
}

function stringByInt (str)
{
	if (str == "第1球" || str == "第2球" || str == "第3球" || str == "第4球" || str == "第5球" || str == "第6球" || str == "第7球" || str == "第8球")
		return setResult[0];
	switch (str){
		case "大小" : return setResult[1];
		case "单双" : return setResult[2];
		case "尾数大小" : return setResult[3];
		case "合数单双" : return setResult[4];
		case "东南西北" : return setResult[5];
		case "中发白" : return setResult[6];
		case "总和大小" : return setResult[7];
		case "总和单双" : return setResult[8];
		case "总和尾数大小" : return setResult[9];
		case "龙虎" : return setResult[10];
	}
}

function sodds (id, odds)
{
	var r = null;
	switch (id)
	{
		case "h1" : r = odds[0].h1; break;
		case "h2" : r = odds[0].h2; break;
		case "h3" : r = odds[0].h3; break;
		case "h4" : r = odds[0].h4; break;
		case "h5" : r = odds[0].h5; break;
		case "h6" : r = odds[0].h6; break;
		case "h7" : r = odds[0].h7; break;
		case "h8" : r = odds[0].h8; break;
		case "h9" : r = odds[0].h9; break;
		case "h10" : r = odds[0].h10; break;
		case "h11" : r = odds[0].h11; break;
		case "h12" : r = odds[0].h12; break;
		case "h13" : r = odds[0].h13; break;
		case "h14" : r = odds[0].h14; break;
		case "h15" : r = odds[0].h15; break;
		case "h16" : r = odds[0].h16; break;
		case "h17" : r = odds[0].h17; break;
		case "h18" : r = odds[0].h18; break;
		case "h19" : r = odds[0].h19; break;
		case "h20" : r = odds[0].h20; break;
		case "h21" : r = odds[0].h21; break;
		case "h22" : r = odds[0].h22; break;
		case "h23" : r = odds[0].h23; break;
		case "h24" : r = odds[0].h24; break;
		case "h25" : r = odds[0].h25; break;
		case "h26" : r = odds[0].h26; break;
		case "h27" : r = odds[0].h27; break;
		case "h28" : r = odds[0].h28; break;
		case "h29" : r = odds[0].h29; break;
		case "h30" : r = odds[0].h30; break;
		case "h31" : r = odds[0].h31; break;
		case "h32" : r = odds[0].h32; break;
		case "h33" : r = odds[0].h33; break;
		case "h34" : r = odds[0].h34; break;
		case "h35" : r = odds[0].h35; break;
        case "h36" : r = odds[0].h36; break;
        case "h37" : r = odds[0].h37; break;
	}
	return r;
}

function postodds (data)  //投注 by 2b
{
	$.post(URL, { typeid : "sessionId"}, function(){});
	if (data) {
		alert("抱歉！您的帳號已被凍結，請與您的上線聯繫。"); 
		return false;
	}
	var tt = $("input.inp1");
	var mix = $("#mix").val()
	var cou = 0, m=[], tArr=[], sid=[], c=true;
	tt.each(function () {
		if ($(this).val() != "") {
			//判斷下注最小金額
			if (parseInt($(this).val()) < parseInt($("#mix").val())) {
				c = false;
			}
			cou++;
			tArr.push($(this).val());
			sid.push($(this).attr("name"));
			m.push(parseInt($(this).val()));
		}
	});
	if (!c) {alert("最低下註金額："+mix+"￥");return false;}
	if (cou <= 0) {
		alert("請填寫下註金額!!!");
		return false;
	} else {
		var tys = $("#tys").html();
		var uArr=[], result="", s=0, s_number=[], h=[];
		var odds = 0;
        var ball_array = new Array();
        var odd_array = new Array();
        var money_array = new Array();
		for (var i = 0; i < tArr.length; i++) {
			odds = $("#h"+sid[i].replace("t","")).text();
			h = "h"+sid[i].replace("t","");
			result = changes(tys,sid[i]);
			s += m[i];
			if (tys == "總和、家禽野兽" || tys == "家禽野兽"  || tys=="總和"){
				uArr.push(result+" @ "+odds+" x ￥"+m[i]+"\n");
                ball_array.push(result);
			} else {
				uArr.push("  "+tys+"["+result+"] @ "+odds+" x ￥"+m[i]+"\n");
                ball_array.push(tys+ ' ' + result);
			}
            odd_array.push(odds);
            money_array.push(m[i]);
			s_number.push( '<input type="hidden" name="s_hid[]" value="'+h+'"><input type="hidden" name="s_ball[]" value="'+result+'"><input type="hidden" name="s_odds[]" value="'+odds+'"><input type="hidden" name="s_money[]" value="'+m[i]+'">');
		}
/*		var p = "共 ￥"+s+" / "+cou+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
			   p+=uArr.join('');
		if (confirm(p)) {*/
			var oid = $("#o").html(); 
			var s_type = '<input type="hidden" name="s_type" value="'+tys+'"><input type="hidden" name="s_number" value="'+oid+'">';
			s_number.push(s_type);
			$(".actiionn").html(s_number.join(''));
			 
			$(".inp1").val("");
            submit_confirm(ball_array,odd_array,money_array);
            MyReset();
/*			return true;
		}
		return false;*/
	}
}

//function getTwoColorBallLuckyNo(luckyNo,len1,len2)
//{
//	var t = luckyNo;
//	var a = new Array();
//	var p = 0;
//	while(p<t.length){
//		var s = t.substring(p,p+2);
//		a.push(s);
//		p=p+2;
//	}
//	
//	var obj = {};
//	if(a.length==len1){
//		obj.blue=a[len2];  
//		obj.red=a.slice(0,len2);  
//	}else{
//		return null;	
//	}
//
//	return obj;
//}




