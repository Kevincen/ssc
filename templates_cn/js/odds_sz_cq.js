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
			$(this).prev().css('width', w);
			$(this).prev().attr('align','center');
			$(this).prev().prev().css('white-space','nowrap');
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

var _url = "../ajax/cqoddsJsonsz.php";
var _endtime, _opentime, _refreshtime, _openNumber, _lock=false;
var setResultcq = new Array();
$(function (){
	$("#dp").attr("action","./inc/DataProcessingcqsz.php?t="+encodeURI($("#tys").html()));
	loadInfo(false);
	loadTime();
	setOpnumberTirem();
	
	if(getCookie("soundbut")=="on" || getCookie("soundbut")==null || getCookie("soundbut")==""){
		SetCookie("soundbut","on");
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
		openNumberCount(data, bool);//雙面長龍
		win.html(data.winMoney); //今天輸贏
	}, "json");
	if (bool == true) {
		if($("#soundbut").attr("value")=="on"){
		$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
		}
	}
}
function _Number (number, ballArr) {
	var Clss = null;
	var idArr = ["#a","#b","#c","#d","#e","#f","#g","#h"];
	$("#number").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "No_cq"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
	}
}
function openNumberCount(row, bool){
		var rowHtml1 = new Array();
		var rowHtml2 = new Array();
		var rowHtml3 = new Array();
		for (var i in row.row1){
			rowHtml1.push("<td>"+row.row1[i]+"</td>");
		}
		$("#su").html(rowHtml1.join(''));
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
		setResultcq[0] = row.row1;
		setResultcq[1] = row.row2;
		setResultcq[2] = row.row3;
		setResultcq[3] = row.row4;
		setResultcq[4] = row.row5;
		setResultcq[5] = row.row6;
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

	
	var a = ["a","b","c","d","e","f","g","h","i"];
		var odds, link, urls;
		if (oddslist == null || oddslist == "" || endtime <1) {
			$(".o").html("-");
			return false;
		}
		for (var n=0; n<oddslist.length; n++){
			for (var i in oddslist[n]){
				odds = oddslist[n][i];
				urls = "fnszcq.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i;
				link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
				//alert(a[n]+i);
				//$("#"+a[n]+i).html(link);
				$("#"+a[n]+i).html(link);
				$("#"+i).html(link);
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
			case "f" : return "Ball_6";
			case "g" : return "Ball_7";
			case "h" : return "Ball_8";
			case "i" : return "Ball_9";
		}
	}
/**
 * 加載輸入框
 */
function loadinput(endtime){

	var loads = $(".loads");
	var count=0, lock1=lock2=lock3=1,lock4=1, lock5=1, s, n="封盤";
	loads.each(function(){
		 var s = $(this).attr('id');
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
	var c = true, s, ss,n;
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
			ss=$(this).attr("name").split("m");
	
			ss2 = nameformat2(ss);
			sArray += ss2+","+value+"|";
			 
			s = nameformat(ss);
			 
			s[2] = $("#"+s[2]+" a").html();

			if (s[0] == "總和、龍虎")
				n = s[1]+" @ "+s[2]+" x ￥"+value;
			else 
				n = s[0]+"["+s[1]+"] @ "+s[2]+" x ￥"+value;
			names.push(n+"\n");
			
		}
	});
	if (count == 0){alert("請填寫下註金額!!!");return false;}
	if (c == false){ alert("最低下註金額："+mixmoney+"￥");return false;}
	var confrims = "共 ￥"+countmoney+" / "+count+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
	confrims +=names.join('');
	if (confirm(confrims)){
		input.val("");
		MyReset(); 
		var number = $("#o").html();
		var s_type = '<input type="hidden" name="s_cq" value="'+sArray+'"><input type="hidden" name="s_number" value="'+number+'">';
		$(".actiionn").html(s_type);
		return setTimeout(function(){return true}, 3000);
	}
	return false;
}

function nameformat(array){
	var arr = new Array(), h='';
	switch (array[0]){
		case "Ball_1" : h="a"; arr[0] = "第一球"; break;
		case "Ball_2" : h="b"; arr[0] = "第二球"; break;
		case "Ball_3" : h="c"; arr[0] = "第三球"; break;
		case "Ball_4" : h="d"; arr[0] = "第四球"; break;
		case "Ball_5" : h="e"; arr[0] = "第五球"; break;
		case "Ball_6" : 
			arr[0] = "總和、龍虎"; 
			 
			switch (array[1].substr(1)) {
				case 'h1':arr[1] = '總和大'; arr[2]=array[1]; break;
				case 'h2':arr[1] = '總和小'; arr[2]=array[1]; break;
				case 'h3':arr[1] = '總和單'; arr[2]=array[1]; break;
				case 'h4':arr[1] = '總和雙'; arr[2]=array[1]; break;
				case 'h5':arr[1] = '龍'; arr[2]=array[1]; break;
				case 'h6':arr[1] = '虎'; arr[2]=array[1]; break;
				case 'h7':arr[1] = '和'; arr[2]=array[1]; break;
			}
			break;
		case "Ball_7" : 
			arr[0] = "前三";  
			switch (array[1].substr(1)) {
				case 'h1':arr[1] = '豹子'; arr[2]=array[1]; break;
				case 'h2':arr[1] = '順子'; arr[2]=array[1]; break;
				case 'h3':arr[1] = '對子'; arr[2]=array[1]; break;
				case 'h4':arr[1] = '半順'; arr[2]=array[1]; break;
				case 'h5':arr[1] = '雜六'; arr[2]=array[1]; break; 
			} 
			break;
		case "Ball_8" : 
			arr[0] = "中三"; 
			switch (array[1].substr(1)) {
				case 'h1':arr[1] = '豹子'; arr[2]=array[1]; break;
				case 'h2':arr[1] = '順子'; arr[2]=array[1]; break;
				case 'h3':arr[1] = '對子'; arr[2]=array[1]; break;
				case 'h4':arr[1] = '半順'; arr[2]=array[1]; break;
				case 'h5':arr[1] = '雜六'; arr[2]=array[1]; break; 
			}  
			break;
		case "Ball_9" : 
			arr[0] = "后三"; 
			switch (array[1].substr(1)) {
				case 'h1':arr[1] = '豹子'; arr[2]=array[1]; break;
				case 'h2':arr[1] = '順子'; arr[2]=array[1]; break;
				case 'h3':arr[1] = '對子'; arr[2]=array[1]; break;
				case 'h4':arr[1] = '半順'; arr[2]=array[1]; break;
				case 'h5':arr[1] = '雜六'; arr[2]=array[1]; break; 
			}  
			break;
	}
	if(h!=''){
		switch (array[1].substr(1)) {
			case "h1": arr[1] = '0'; arr[2]=h+"h1"; break;
			case "h2": arr[1] = '01'; arr[2]=h+"h3"; break;
			case "h3": arr[1] = '02'; arr[2]=h+"h5"; break;
			case "h4": arr[1] = '03'; arr[2]=h+"h6"; break;
			case "h5": arr[1] = '04'; arr[2]=h+"h2"; break;
			case "h6": arr[1] = '05'; arr[2]=h+"h4"; break;
			case "h7": arr[1] = '06'; arr[2]=h+"h7"; break;
			case "h8": arr[1] = '07'; arr[2]=h+"h8"; break;
			case "h9": arr[1] = '08'; arr[2]=h+"h9"; break;
			case "h10": arr[1] = '09'; arr[2]=h+"h10"; break;
			
			case "h11": arr[1] = '大'; arr[2]=h+"h11"; break;
			case "h12": arr[1] = '小'; arr[2]=h+"h12"; break;
			case "h13": arr[1] = '單'; arr[2]=h+"h13"; break;
			case "h14": arr[1] = '雙'; arr[2]=h+"h14"; break;
		}
	} 
	return arr;
}


function nameformat2(array){
	var arr = new Array(), h;
	switch (array[0]){
		case "Ball_1" : h="a"; arr[0] = "Ball_1"; break;
		case "Ball_2" : h="b"; arr[0] = "Ball_2"; break;
		case "Ball_3" : h="c"; arr[0] = "Ball_3"; break;
		case "Ball_4" : h="d"; arr[0] = "Ball_4"; break;
		case "Ball_5" : h="e"; arr[0] = "Ball_5"; break;
		case "Ball_6" : h="f"; arr[0] = "Ball_6"; break;
		case "Ball_7" : h="h"; arr[0] = "Ball_7"; break;
		case "Ball_8" : h="i"; arr[0] = "Ball_8"; break;
		case "Ball_9" : h="g"; arr[0] = "Ball_9"; break;
	
	}
 	 arr[1]=array[1]; 
	return arr;
}



function getResult ($this){
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
	switch (str){
		case "第1球" : return setResultcq[1];
		case "第2球" : return setResultcq[2];
		case "第3球" : return setResultcq[3];
		case "第4球" : return setResultcq[4];
		case "第5球" : return setResultcq[5];
	}
}






