/*****************************
* 新增快捷和正常投注
*****************************/
function kuijie(){
	$('#td_input_money').show();
	if($('#kuijie').attr('class')!='intype_hover'){
		$('#kuijie').attr('class','intype_hover');
		$('#yiban').attr('class','intype_normal'); 
		$('.loads').each(function(){
			var w = $(this).width();
			w+=$(this).prev().width();
			$(this).prev().css('width', w );
			$(this).prev().attr('align','center')
			$(this).hide(); 
		})
		$('#tr_header').find('td').each(function(){ 
				var n = $(this).attr('colspan')-1;	
				$(this).attr('colspan',n); 			
		})
		/*添加效果*/ 
		$('.o').bind({'mouseenter':function(){
			if( $(this).attr('title')!='选中' ){ //未选中 
				$(this).css({'background-color':'#ffd094','cursor':'pointer'});	  
			} 
		},'mouseleave':function(){
			if( $(this).attr('title')!='选中' ){ //未选中 
				$(this).css({'background-color':'#fff','cursor':'pointer'}); 
			}
		},'click':function(){ 
			if( $(this).attr('title')=='选中' ){//已选中 取消选中
				$(this).css({'background-color':'#fff','cursor':'pointer'}); 
				$(this).attr('title','');
			}else{												//选中
				$(this).css({'background-color':'#ffc214','cursor':'pointer'});	   
				$(this).attr('title','选中');
			}
			 
		}})
	}
}
function yiban(){
	if($('#yiban').attr('class')!='intype_hover'){
		$('#yiban').attr('class','intype_hover');
		$('#kuijie').attr('class','intype_normal'); 
		$('.o').each(function(){ 
			$(this).width( 45 );
			$(this).next().show(); 
		})
		$('#tr_header').find('td').each(function(){ 
			var n = $(this).attr('colspan')+1; 	
			$(this).attr('colspan',n); 		
		})
		 
	}	
	$('.o').unbind('mouseenter').unbind('mouseleave').unbind('click'); 
	$('.o').css({'background-color':'#fff','cursor':''});
	$('#td_input_money').hide();
}
function MyReset(){ 
	$('.o').css({'background-color':'#fff','cursor':''});
	 
	$('.o').attr('title','');
	$('.inp1').val('');
	$('#AllMoney').val('');
}

function AllMoney(){ 
	var sel=false;
	$('.loads').each(function(){
		if(  $(this).prev().attr('title')=='选中' ){ //已选中 
			$(this).find('input').val( $('#AllMoney').val() );
			sel=true;
		}
	}) 
	return sel;
}
function iSubmit(){
	if($('#kuijie').attr('class')=='intype_hover'){	
		var sel = AllMoney();
		if(sel==false){
			alert('您未选择号码！');
			return false;
		}
	}
	return true;
}

/**************************************/


var _url = "../ajax/oddsJsonsznc.php";
var _endtime, _opentime, _refreshtime, _openNumber, _lock=false;
var setResults = new Array();

$(function (){
	$("#dp").attr("action","./inc/DataProcessingsznc.php?t="+encodeURI($("#tys").html()));
	loadInfo(false);
	loadTime();
	setOpnumberTirem();
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
	
	$('#kuijie').bind('click',function(){
		kuijie();							   
	})
	$('#yiban').bind('click',function(){
		yiban();							   
	})
});

/**
 * 開出號碼須加載
 */
function loadInfo(bool){
	var win = $("#sy");
	var number = $("#number"); //開獎期數
	$.post(_url, {tid : 1}, function(data){
		_Number (data.number, data.ballArr); //開獎號碼
		smlen(data);//雙面長龍
		win.html(data.winMoney); //今天輸贏
	}, "json");
	if (bool == true) {
		if($("#soundbut").attr("value")=="on"){
		$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
		}getinfotop();
	}
}
function _Number (number, ballArr) {
	var Clss = null;
	var idArr = ["#a","#b","#c","#d","#e","#f","#g","#h"];
	$("#number").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "nc"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
	}
}
function smlen(data) { //兩面長龍
	if (data.num_arr != ""){
		var row_1Html = new Array();
		for (var key in data.num_arr){
			row_1Html.push("<tr bgcolor=\"#fff\" height=\"22\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+key+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+data.num_arr[key]+" 期</td></tr>");
		}
		var cHtml = '<tr class="t_list_caption"><th colspan="2">兩面長龍排行</th></tr>';
		$("#cl").html(cHtml+row_1Html.join(""));
	}
	setResults[0] = data.row_1; //總和大小
	setResults[1] = data.row_2; //總和單雙
	setResults[2] = data.row_3; //總和尾數大小
	setResults[3] = data.row_4; //龍虎
	setResults[4] = data.row_5; //總和大小
	setResults[5] = data.row_6; //總和單雙
	setResults[6] = data.row_7; //總和尾數大小
	setResults[7] = data.row_8; //龍虎
	var row_2Html = new Array();
	for (var k in data.row_1){
			row_2Html.push(data.row_1[k]);
		}
		$("#z_cl").html(row_2Html.join(''));
		$(".z_cl:even").addClass("hhg");
}

function loadTime(){
	 _openNumber = $("#o");
	$.post(_url, {tid : 2}, function(data){
		_openNumber.html(data.Phases);
		endtimes(data.endTime);
		opentimes(data.openTime);
		refreshTimes(data.refreshTime);
		loadodds(data.oddsList, data.endTime, data.Phases);
		loadinput(data.endTime);
	}, "json");
}

/**
 * 封盤時間
 */
function endtimes(endtime){
	var endTime = $("#endTime"); //封盤時間
	_endtime = endtime;
	if (_endtime >1)
		endTime.html(settime(_endtime));
	var interval = setInterval(function(){
										
									
					if (_endtime<10&&_endtime>0){
						if($("#soundbut").attr("value")=="on"){
				$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/d.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");		
						}
						}	
						
						
		if (_endtime <= 1) { //封盤時間結束
			clearInterval(interval);
			endTime.html("00:00");
			loadodds(null, endtime, null);		//關閉賠率
			loadinput(-1); 				//關閉輸入框
			return false;
		}
		_endtime--;
		endTime.html(settime(_endtime));
	}, 1000);
}

/**
 * 開獎時間
 */
function opentimes(opentime){
	var openTime = $("#endTimes"); //開獎時間
	_opentime = opentime;
	if (_opentime >1)
		openTime.html(settime(_opentime));
	var interval = setInterval(function(){
		if (_opentime <= 1) { //開獎時間結束
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

/**
 * 90秒刷新
 */
function refreshTimes(refreshtime){
	_refreshtime = refreshtime;
	var refreshTime = $("#endTimea"); //刷新時間
	refreshTime.html(_refreshtime);
	var interval = setInterval(function(){
		if (_refreshtime <= 1) { //刷新時間結束
			clearInterval(interval);
			$.post(_url, {tid : 2}, function(data){
				if (_lock == true){
					endtimes(data.endTime);
					opentimes(data.openTime);
					loadinput(data.endTime);
					 _openNumber.html(data.Phases);
					 setOpnumberTirem();//加載開獎號碼
					_lock = false;
				}
				 _endtime =data.endTime;
				 _opentime =data.openTime;
				 _refreshtime =data.refreshTime;
				 loadodds(data.oddsList, _endtime, data.Phases);
				 refreshTimes(_refreshtime);
			}, "json");
			return false;
		}
		_refreshtime--;
		refreshTime.html(_refreshtime);
	}, 1000);
}

/**
 * 加載賠率
 */
function loadodds(oddslist, endtime, number){

	var a = ["a","b","c","d","e","f","g","h"];
	var odds, link, urls;
	if (oddslist == null || oddslist == "" || endtime <1) {
		$(".o").html("-");
		return false;
	}
	for (var n=0; n<oddslist.length; n++){
		for (var i in oddslist[n]){
			odds = oddslist[n][i];
			urls = "fn8.php?v="+number+"&n="+i+"&t=t"+(n+1);
			link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
			$("#"+a[n]+i).html(link);
			$("#"+i).html(link);
		}
	}
}

/**
 * 加載輸入框
 */
function loadinput(endtime){
	var loads = $(".loads");
	var count=0, lock1=lock2=lock3=lock4=1, lock5=5, s, n="封盤";
	loads.each(function(){
		count++;
		if (count>=1 && count <= 160){
			s = "t"+lock1+"_h"+lock2;
			lock1++;
			if (lock1 == 9) {lock1 =1;lock2++;}
		} 
		if (endtime >1)
			n = "<input name=\""+s+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
		$(this).html(n);
	});
}

function settime(time){
	var MinutesRound = Math.floor(time / 60);
	var SecondsRound = Math.round(time - (60 * MinutesRound));
	var Minutes = MinutesRound.toString().length <= 1 ? "0"+MinutesRound : MinutesRound;
	var Seconds = SecondsRound.toString().length <= 1 ? "0"+SecondsRound : SecondsRound;
	var strtime = Minutes + ":" + Seconds;
	return strtime;
}

function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function setOpnumberTirem(){
	var opnumber = $("#number").html();
	var nownumer = $("#o").html();
	if (opnumber != ""){
		var _nownumber = parseInt(nownumer);
		var sum = _nownumber -  parseInt(opnumber);
		if (sum == 2) {
			var interval = setInterval(function(){
				$.post(_url, {tid : 3}, function(data){
					if (_nownumber - parseInt(data) == 1){
						clearInterval(interval);
						loadInfo(true);
						return false;
					}
				}, "text");
			}, 3000);
		}
	} else {
		setTimeout(setOpnumberTirem, 1000);
	}
}


function submitforms(){
	if( iSubmit()==false ) return false;
	$.post("../ajax/Default.ajax.php", { typeid : "sessionId"}, function(){});
	var mixmoney = parseInt($("#mix").val()); //最低下注金額
	var input = $("input.inp1");
	var c = true, s, n;
	var count = 0;
	var countmoney = 0;
	var upmoney = 0;
	var names = new Array();
	var sArray = "";
	input.each(function(){
		var value = $(this).val();
		if (value != ""){
			value = parseInt(value);
			if (value < mixmoney) c=false;
			count++;
			countmoney += value;
			s = nameformat($(this).attr("name").split("_"));
			s[2] = $("#"+s[2]+" a").html();
			if (s[0] == "總和、龍虎")
				n = s[1]+" @ "+s[2]+" x ￥"+value;
			else 
				n = s[0]+"["+s[1]+"] @ "+s[2]+" x ￥"+value;
			names.push(n+"\n");
			sArray += s+","+value+"|";
		}
	});
	if (count == 0){alert("請填寫下註金額!!!");return false;}
	if (c == false){ alert("最低下註金額："+mixmoney+"￥");return false;}
	var confrims = "共 ￥"+countmoney+" / "+count+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
	confrims +=names.join('');
	if (confirm(confrims)){
		MyReset();
		var number = $("#o").html();
		var s_type = '<input type="hidden" name="sm_arr" value="'+sArray+'"><input type="hidden" name="s_number" value="'+number+'">';
		$(".actiionn").html(s_type);
		return setTimeout(function(){return true}, 3000);
	}
	return false;
}

function nameformat(array){
	var arr = new Array(), h;
	switch (array[0]){
		case "t1" : h="a"; arr[0] = "第一球"; break;
		case "t2" : h="b"; arr[0] = "第二球"; break;
		case "t3" : h="c"; arr[0] = "第三球"; break;
		case "t4" : h="d"; arr[0] = "第四球"; break;
		case "t5" : h="e"; arr[0] = "第五球"; break;
		case "t6" : h="f"; arr[0] = "第六球"; break;
		case "t7" : h="g"; arr[0] = "第七球"; break;
		case "t8" : h="h"; arr[0] = "第八球"; break;
		case "k1" : arr[0] = "總和、龍虎"; break;
	}
	switch (array[1]) {
		case "h1": arr[1] = '01'; arr[2]=h+"h1"; break;
		case "h2": arr[1] = '02'; arr[2]=h+"h2"; break;
		case "h3": arr[1] ='03'; arr[2]=h+"h5"; break;
		case "h4": arr[1] ='04'; arr[2]=h+"h6"; break;
		case "h5": arr[1] ='05'; arr[2]=h+"h3"; break;
		case "h6": arr[1] = '06'; arr[2]=h+"h4"; break;
		case "h7": arr[1] = '07'; arr[2]=h+"h7"; break;
		case "h8": arr[1] = '08'; arr[2]=h+"h8"; break;
		case "h9": arr[1] = '09'; arr[2]=h+"h9"; break;
		case "h10": arr[1] = '10'; arr[2]=h+"h10"; break;
		case "h11": arr[1] = '11'; arr[2]=h+"h11"; break;
		case "h12": arr[1] = '12'; arr[2]=h+"h12"; break;
		case "h13": arr[1] = '13'; arr[2]=h+"h13"; break;
		case "h14": arr[1] = '14';arr[2]=h+"h14"; break;
		case "h15": arr[1] = '15'; arr[2]=h+"h15"; break;
		case "h16": arr[1] = '16';arr[2]=h+"h16"; break;
		case "h17": arr[1] = '17'; arr[2]=h+"h17"; break;
		case "h18": arr[1] = '18'; arr[2]=h+"h18"; break;
		case "h19": arr[1] = '19'; arr[2]=h+"h19"; break;
		case "h20": arr[1] = '20'; arr[2]=h+"h20"; break;
	}
	return arr;
}

function getResult ($this){
	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");
	var rowHtml = new Array();
	var data = stringByInt ($($this).html());
	for (var k in data){
		rowHtml.push(data[k]);
	}
	$("#z_cl").html(rowHtml.join(''));
	$(".z_cl:even").addClass("hhg");
}

function stringByInt (str){
	switch (str){
		case "第1球" : return setResults[0];
		case "第2球" : return setResults[1];
		case "第3球" : return setResults[2];
		case "第4球" : return setResults[3];
		case "第5球" : return setResults[4];
		case "第6球" : return setResults[5];
		case "第7球" : return setResults[6];
		case "第8球" : return setResults[7];
	}
}






