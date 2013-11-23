var setResultcq = new Array();
var _hiden, _endtime, _opentime, _refreshtime, _openNumber, _lock=false;		
(function(){ 
	$(function(){
		$("#dp").attr("action","./inc/DataProcessingjsk3.php?idt="+encodeURI($("#tys").html()));
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
		$.post("/ajax/jsk3Json.php", { typeid : 1, mid : _hiden}, function(data){
			_Number (data.number, data.ballArr);
			openNumberCount(data, bool);
			sy.html(data.winMoney);
		}, "json");
	}
	
	function loadDayInfo(){  
		$.post("/ajax/jsk3Json.php", { typeid : 2, mid : _hiden}, function(data){
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
		var a = ["a","b","c","d","e"];
		var odds, link, urls;
		if (oddslist == null || oddslist == "" || endtime <1) {
			$(".o").html("-");
			return false;
		}
		for (var n=0; n<oddslist.length; n++){
			for (var i in oddslist[n]){
				odds = oddslist[n][i];
				urls = "fnjsk3.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i;
				link = "<a href=\""+urls+"\"   target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
				$("#"+a[n]+i).html(link);
			}
		}
	}
	
	function bc(str){
		switch (str){
			case "a" : return "Ball_1"; 
			case "b" : return "Ball_2"; 
			case "c" : return "Ball_3"; 
			case "d" : return "Ball_4"; 
			case "e" : return "Ball_5"; 
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
				$.post("/ajax/jsk3Json.php", {typeid : 2, mid : _hiden}, function(data){
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
					$.post("/ajax/jsk3Json.php", {typeid : 3}, function(data){
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
		
		var idArr = ["#a","#b","#c"];
		$("#number").html(number);
		 
		for (var i = 0; i<ballArr.length; i++) {
			var n = ballArr[i];  
			var Class='NO_JS_'+n; 
			$(idArr[i]).removeClass().addClass(Class);
			 
		}
	}
	
	function openNumberCount(row, bool){ 
		 
		var rowHtml3 = new Array();   
		if (row.row1 != ""){
			for (var key in row.row1){
				rowHtml3.push(row.row1[key]);
			}
			var cHtml = '<tr class="t_list_caption"><th colspan="6">近期開獎結果</th></tr>';
			$("#cl").html(cHtml+rowHtml3.join(""));
		}
		if (bool == true) {
			if($("#soundbut").attr("value")=="on"){
				$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
			}
		}
		 
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
			m=  nameformatcq1(s[1]); 
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
		case "Ball_1" : return "三軍";
		case "Ball_2" : return "圍骰、全骰";
		case "Ball_3" : return "點數";
		case "Ball_4" : return "長牌";
		case "Ball_5" : return "短牌"; 
	}
}
function nameformatcq1(str){
	var Arr = str.split('h');
	var ch = Arr[0];
	var xh = Arr[1];
	switch(ch){
		case 'a':
			if(xh==7) return "大";
			if(xh==8) return "小";
			return xh;
		case 'b':
			if(xh==7) return "全骰";	
			return xh;
		case 'c':
			return $('.'+str).html();
		case 'd':
			var div1 = $('.'+str).find('div')[0];
			var div2 = $('.'+str).find('div')[1];
			return $(div1).attr('class').replace('NO_JS_','')+'+'+$(div2).attr('class').replace('NO_JS_','');
		case 'e':
			var div1 = $('.'+str).find('div')[0];
			var div2 = $('.'+str).find('div')[1];
			return $(div1).attr('class').replace('NO_JS_','')+'+'+$(div2).attr('class').replace('NO_JS_','');
	}
}