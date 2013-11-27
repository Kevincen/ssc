var setResultcq = new Array();
var _hiden, _endtime, _opentime, _refreshtime, _openNumber, _lock=false;		
(function(){ 
	$(function(){
		$("#dp").attr("action","./inc/DataProcessinglhc.php?idt="+encodeURI($("#tys").html()));
		_hiden = $("#hiden").val();
		_hiden = _hiden.replace("g","");
		loadGameInfo(false);
		loadDayInfo();
		setOpnumberTirem();
		if(_hiden==17 || _hiden==18){
			lianma();
		}
	});
	
	function loadGameInfo(bool){
		var number = $("#number");
		var sy = $("#sy");
		$.post("/ajax/lhcJson.php", { typeid : 1, mid : _hiden}, function(data){
			_Number (data.number, data.ballArr);
			openNumberCount(data, bool);
			sy.html(data.winMoney);
		}, "json");
	}
	
	function loadDayInfo(){  
		$.post("/ajax/lhcJson.php", { typeid : 2, mid : _hiden}, function(data){
			openNumber(data.Phases);
			opentimes(data.openTime);
			endtimes(data.endTime);
			refreshTimes(data.refreshTime);
			loadodds(data.oddslist, data.endTime, data.Phases);
			loadinput(data.endTime, _hiden);
		}, "json");
	}
	
	function loadinput(endtime, id){
		 
		var loads = $(".loads");
		var count=lock1=lock2=lock3=lock4=lock5=0, s, n="封盤";
		loads.each(function(){
			if (endtime < 1){
				$(this).html(n);
			} else { 
				s=$(this).attr('id').replace('N','M');
				n = "<input name=\""+s+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>";
				$(this).html(n);
			}
		});
	}
	
	function loadodds(oddslist, endtime, number){
		var a = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t"];
		var odds, link, urls;
		if (oddslist == null || oddslist == "" || endtime <1) {
			$(".o").html("-");
			return false;
		}
		for (var n=0; n<oddslist.length; n++){
			for (var i in oddslist[n]){
				odds = oddslist[n][i];
				urls = "fnlhc.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i;
				link = "<a href=\"#this\" onclick='return false'  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
				$("#"+a[n]+i).html(link);
			}
		}
	}
	
	function bc(str){
		switch (str){
			case "a" : return "Ball_"+_hiden; 
		}
	}
	
	function openNumber(numberId){
		$("#o").html(numberId);
	}
	
	function opentimes(opentime){
		var openTime = $("#endTimes");
		_opentime = opentime;
		if (_opentime >1)
			openTime.html(settime(_opentime));
		var interval = setInterval(function(){
			if (_opentime <= 1) {
				clearInterval(interval);
				_lock = true;
				_refreshtime = 5;
				openTime.html("00:00");
				return false;
			}
			_opentime--;
			openTime.html(settime(_opentime));
		}, 1000);
	}
	
	function endtimes(endtime){
if(getCookie("soundbut")=="on" || getCookie("soundbut")==null || getCookie("soundbut")==""){
		SetCookie("soundbut","on");
		$("#soundbut").attr("value","on");
		$("#soundbut").attr("src","images/soundon.png");
		}else{
			$("#soundbut").attr("value","off");
		$("#soundbut").attr("src","images/soundoff.png");
			}
		var endTime = $("#endTime");
		_endtime = endtime;
		if (_endtime >1)
			endTime.html(settime(_endtime));
		var interval = setInterval(function(){
											if (_endtime<10&&_endtime>0){
												if($("#soundbut").attr("value")=="on"){
				$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/d.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");		}
						}	
			if (_endtime <= 1) {
				clearInterval(interval);
				endTime.html("00:00");
				loadodds(null, endtime, null);
				loadinput(-1, _hiden);
				return false;
			}
			_endtime--;
			endTime.html(settime(_endtime));
		}, 1000);
	}
	
	function refreshTimes(refreshtime){
		_refreshtime = refreshtime;
		var refreshTime = $("#endTimea");
		refreshTime.html(_refreshtime);
		var interval = setInterval(function(){
			if (_refreshtime <= 1) {
				refreshTime.html("加載中...");
				clearInterval(interval);
				$.post("/ajax/lhcJson.php", {typeid : 2, mid : _hiden}, function(data){
					if (_lock == true){
						endtimes(data.endTime);
						opentimes(data.openTime);
						loadinput(data.endTime, _hiden);
						 openNumber(data.Phases);
						 setOpnumberTirem();
						_lock = false;
					}
					 _endtime =data.endTime;
					 _opentime =data.openTime;
					 _refreshtime =data.refreshTime;
					 loadodds(data.oddslist, _endtime, data.Phases);
					 refreshTimes(_refreshtime);
				}, "json");
				return false;
			}
			_refreshtime--;
			refreshTime.html(_refreshtime);
		}, 1000);
	}
	
	function setOpnumberTirem(){
		var opnumber = $("#number").html();
		var nownumer = $("#o").html();
		if (opnumber != ""){
			var _nownumber = parseInt(nownumer);
			var sum = _nownumber -  parseInt(opnumber);
			if (sum == 2 || sum == 882) {
				var interval = setInterval(function(){
					$.post("/ajax/lhcJson.php", {typeid : 3}, function(data){
						var a = _nownumber - parseInt(data);
						if (a == 1 || a == 881){
							clearInterval(interval);
							loadGameInfo(true);
							return false;
						}
					}, "text");
				}, 2000);
			}
		} else {
			setTimeout(setOpnumberTirem, 1000);
		}
	}
	
	function _Number (number, ballArr) {
		var Clss = null;
		var idArr = ["#a","#b","#c","#d","#e","#f","#g"];
		$("#number").html(number);
		var r = red.split(',');
		var g = green.split(',');
		var b = blue.split(',');
		for (var i = 0; i<ballArr.length; i++) {
			var n = ballArr[i];
			if(n.length==1)n='0'+n;
			var Class='';
			if(in_array(n,r)){
				Class='ball_red_normal';
			}else if(in_array(n,g)){
				Class='ball_green_normal';
			}else{
				Class='ball_blue_normal';
			}
			$(idArr[i]).removeClass().addClass(Class);
			$(idArr[i]).css({
				'width':'44', 
				'height':'33',
				'font-weight':'bold'
			});
			$(idArr[i]).html( n );
		}
	}
	
	function openNumberCount(row, bool){
		 
		var rowHtml2 = new Array();
		var rowHtml3 = new Array(); 
		for (var k in row.row2){
			rowHtml2.push(row.row2[k]);
		}
		$("#z_cl").html(rowHtml2.join(''));
		$(".z_cl:even").addClass("hhg");
		if (row.row8 != ""){
			for (var key in row.row8){
				rowHtml3.push("<tr bgcolor=\"#fff\" height=\"22\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+key+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+row.row8[key]+" 期</td></tr>");
			}
			var cHtml = '<tr class="t_list_caption"><th colspan="2">兩面長龍排行</th></tr>';
			$("#cl").html(cHtml+rowHtml3.join(""));
		}
		if (bool == true) {
			if($("#soundbut").attr("value")=="on"){
			$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
		}
		}
		setResultcq[0] = row.row2;
		setResultcq[1] = row.row3;
		setResultcq[2] = row.row4;
		setResultcq[3] = row.row5;
		setResultcq[4] = row.row6;
		setResultcq[5] = row.row7;
	}

	function settime(time){
		var MinutesRound = Math.floor(time / 60);
		var SecondsRound = Math.round(time - (60 * MinutesRound));
		var Minutes = MinutesRound.toString().length <= 1 ? "0"+MinutesRound : MinutesRound;
		var Seconds = SecondsRound.toString().length <= 1 ? "0"+SecondsRound : SecondsRound;
		var strtime = Minutes + ":" + Seconds;
		return strtime;
	}
})();

function getResult($this){
	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");
	$(".nv_ab").removeClass("nv_ab");
	$($this).parent().addClass("nv_ab");
	var rowHtml = new Array();
	var data = stringByInt ($($this).html());
	for (var k in data){
		rowHtml.push(data[k]);
	}
	$("#z_cl").html(rowHtml.join(''));
	$(".z_cl:even").addClass("hhg");
}

function stringByInt (str){
	if (str == "特碼" || str == "正碼一" || str == "正碼二" || str == "正碼三" || str == "正碼四" || str == "正碼五" || str == "正碼六" || str=='正碼總和' || str=="半波" || str=='五行')
		return setResultcq[0];
	switch (str){
		case "大小" : return setResultcq[1];
		case "單雙" : return setResultcq[2];
		case "合單合雙" : return setResultcq[3];
		case "尾大尾小" : return setResultcq[4];
		case "波段" : return setResultcq[5];
		case "正碼總和大小" : return setResultcq[1];
		case "正碼總和單雙" : return setResultcq[2];
		case "特碼生肖" : return setResultcq[0];
		case "一肖" : return setResultcq[0];
		case "特尾" : return setResultcq[0];
		case "特碼頭" : return setResultcq[0];
	}
}

function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function submitforms(){
	var ss="", a = false, c= true, count = countmoney =0, names=[], value, s, z, o, n, m;
	var input = $("input.inp1");
	var mixmoney = parseInt($("#mix").val());
	$.ajax({type : "POST",data : {typeid : "sessionId"},url : "../ajax/Default.ajax.php",dataType : "text",async : false,success:function(data){a = data == 1 ? true : false;}});
	input.each(function(){
		value = $(this).val();
		if (value != ""){
			value = parseInt(value);
			if (value < mixmoney) {c=false;return;}
			count++;
			countmoney += value;
			s = $(this).attr("name").split("M");  
			z = nameformatcq(s[0]);  
			m= $("."+s[1]).html(); 
			ss += s+","+value+","+z+","+m+"|";
			o = $("#"+s[1]+" a").html(); 
			n = z+"["+m+"] @ "+o+" x ￥"+value;
			names.push(n+"\n");
		}
	});
	if (c == false){ alert("最低下註金額："+mixmoney+"￥");return false;}
	if (count == 0){alert("請填寫下註金額!!!");return false;}
	var confrims = "共 ￥"+countmoney+" / "+count+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
	confrims +=names.join('');
	if (confirm(confrims)){
		input.val(""); 
		var number = $("#o").html(); 
		var s_type = '<input type="hidden" name="s_cq" value="'+ss+'"><input type="hidden" name="s_number" value="'+number+'">';
		$(".actiionn").html(s_type);
		return a;
	}
	return false;
}

function nameformatcq(str){
	switch(str){
		case "Ball_7" : return "特碼";
		case "Ball_8" : return "正碼";
		case "Ball_9" : return "半波";
		case "Ball_10" : return "五行";
		case "Ball_11" : return "特碼生肖";
		case "Ball_12" : return "一肖";
		case "Ball_13" : return "特尾";
		case "Ball_14" : return "尾數";
		case "Ball_15" : return "特碼頭";
		case "Ball_16" : return "總和";
		case "Ball_17" : return "連碼";
		case "Ball_18" : return "合肖";
		case "Ball_1" : return "正碼一";
		case "Ball_2" : return "正碼二";
		case "Ball_3" : return "正碼三";
		case "Ball_4" : return "正碼四";
		case "Ball_5" : return "正碼五";
		case "Ball_6" : return "正碼六"; 
	}
}
/*連碼*/
function lianma(){
	$('input[name=gg]').bind('click',function(){
		cRadio(this);										  
	})	 
	$("#sub").click(function () {
		if(_hiden==17){ //連碼
			var value = "", count = 0;
			$("#lm").attr("action","fnlhc_l.php?v="+$("#o").html());
			$("input[name=gg]").each(function () {
				if ($(this).attr("checked")) {value = $(this).val();}
			});
			$(":checkbox").each(function () {
				if ($(this).attr("checked")) {count++;}
			});
			if (value == "") {alert("請選擇類型!!!"); return false;}
			switch (value) {
				case "t1" : if (count < 3) {alert("三中三、至少勾選3個號碼!!!");return false};break;
				case "t2" : if (count < 3) {alert("三中二、至少勾選3個號碼!!!");return false};break;
				case "t3" : if (count < 2) {alert("二中二、至少勾選2個號碼!!!");return false};break;
				case "t4" : if (count < 5) {alert("五不中、至少勾選5個號碼!!!");return false};break;
				case "t5" : if (count < 2) {alert("二中特、至少勾選2個號碼!!!");return false};break; 
			}
		}else{ //合肖
			var value = "", count = 0;
			$("#lm").attr("action","fnlhc_x.php?v="+$("#o").html());
			$("input[name=gg]").each(function () {
				if ($(this).attr("checked")) {value = $(this).val();}
			});
			$(":checkbox").each(function () {
				if ($(this).attr("checked")) {count++;}
			});
			if (value == "") {alert("請選擇類型!!!"); return false;}
			switch (value) {
				case "t1" : if (count < 1) {alert("一肖中、至少勾選1個號碼!!!");return false};break;
				case "t2" : if (count < 1) {alert("一肖不中、至少勾選1個號碼!!!");return false};break;
				case "t3" : if (count < 2) {alert("二肖中、至少勾選2個號碼!!!");return false};break;
				case "t4" : if (count < 2) {alert("二肖不中、至少勾選2個號碼!!!");return false};break;
				case "t5" : if (count < 3) {alert("三肖中、至少勾選3個號碼!!!");return false};break; 
				case "t6" : if (count < 3) {alert("三肖不中、至少勾選3個號碼!!!");return false};break; 
				case "t7" : if (count < 4) {alert("四肖中、至少勾選4個號碼!!!");return false};break; 
				case "t8" : if (count < 4) {alert("四肖不中、至少勾選4個號碼!!!");return false};break; 
				case "t9" : if (count < 5) {alert("五肖中、至少勾選5個號碼!!!");return false};break; 
				case "t10" : if (count < 5) {alert("五肖不中、至少勾選5個號碼!!!");return false};break; 
				case "t11" : if (count < 6) {alert("六肖中、至少勾選6個號碼!!!");return false};break; 
				case "t12" : if (count < 6) {alert("六肖不中、至少勾選6個號碼!!!");return false};break; 
				case "t13" : if (count < 7) {alert("七肖中、至少勾選7個號碼!!!");return false};break; 
				case "t14" : if (count < 7) {alert("七肖不中、至少勾選7個號碼!!!");return false};break; 
				case "t15" : if (count < 8) {alert("八肖中、至少勾選8個號碼!!!");return false};break; 
				case "t16" : if (count < 8) {alert("八肖不中、至少勾選8個號碼!!!");return false};break; 
				case "t17" : if (count < 9) {alert("九肖中、至少勾選9個號碼!!!");return false};break; 
				case "t18" : if (count < 9) {alert("九肖不中、至少勾選9個號碼!!!");return false};break; 
				case "t19" : if (count < 10) {alert("十肖中、至少勾選10個號碼!!!");return false};break; 
				case "t20" : if (count < 10) {alert("十肖不中、至少勾選10個號碼!!!");return false};break; 
				case "t21" : if (count < 11) {alert("十一肖中、至少勾選11個號碼!!!");return false};break; 
				case "t22" : if (count < 11) {alert("十一肖不中、至少勾選11個號碼!!!");return false};break; 
			}	
		} 
	}); 
	$("#rn").click(function () {
		rm ();
	});
	$(":checkbox").click(function () {
		$(":radio").each(function () {
			if ($(this).attr("checked")) {
				check($(this).val());
			}
		});
	});
}
function cRadio ($this) 
{
	var box = $(":checkbox");
	box.css("display","inline");
	box.attr("checked","");
	box.attr("disabled","");
	$(".v").css("background","#fff");
	$(".qw").attr("disabled","").css("color","#006600");
}
function rm (){
	var box = $(":checkbox");
	box.css("display","inline");
	box.attr("checked","");
	box.attr("disabled","");
	$(".v").css("background","#fff");
}

function check(value) {
	var c = 0;
	var che = $(":checkbox")
	che.each(function () {
		if ($(this).attr("checked")) {
			c++;
			$("."+$(this).attr("id")).css("background","yellow");
		} else {
			$("."+$(this).attr("id")).css("background","#fff");
		}
	}); 
	if(_hiden==17){
		if (value == "t1" || value == "t2" || value == "t3" || value == "t4" || value == "t5" ) {
			if (c >=8) {atts (che,"disabled");} else {atts (che,"");}
		} 
	}
	 
}
function atts (che,value) {
	che.each(function () {
		if (!$(this).attr("checked")) {
			$(this).attr("disabled",value);
		}
	});
}