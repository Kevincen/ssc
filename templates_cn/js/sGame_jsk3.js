/*****************************
 * 新增快捷和正常投注
 *****************************/
function kuijie(){
    $('#td_input_money').css('display','inline');
    $('#td_input_money1').css('display','inline');
    if(!$('#kuijie').hasClass('on')){
        $('#kuijie').addClass('on');
        $('#yiban').removeClass('on');
        var i=0;
        $('.loads').each(function(){
            $(this).prev().attr('align','center')
            $(this).hide();
            //$(this).css('display','none');
        })
        $('.wqs').each(function(){
            switch ($(this).attr('id')) {
                case 'sanjun':
                    $(this).find("colgroup").html('<col class="col_single w10"><col class="w17"><col class="col_single w10"><col class="w17"><col class="col_single w10"><col class="w17"><col class="col_single w10"><col class="w17">');
                    break;
                case 'weishai':
                    $(this).find("colgroup").html('<col class="col_single w14"><col class="w20"><col class="col_single w14"><col class="w20"><col class="col_single w14"><col class="w20">');
                    break;
                case 'dianshu':
                    $(this).find("colgroup").html('<col class="col_single w10"><col class="w17"><col class="col_single w10"><col class="w17"><col class="col_single w10"><col class="w17"><col class="col_single w10"><col class="w17">');
                    break;
                case 'changpai':
                case 'duanpai':
                    $(this).find("colgroup").html('<col class="col_single w14"><col class="w20"><col class="col_single w14"><col class="w20"><col class="col_single w14"><col class="w20">');
                    break;
            }

        })
        /*添加效果*/
        $('.caption_1,.o').bind({'mouseenter':function(){
            if( $(this).attr('title')!='选中' ){ //未选中
                if($(this).hasClass('o') && $(this).prev().hasClass('caption_1')){
                    $(this).css({'background-color':'#ffd094','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#ffd094','cursor':'pointer'});
                }
                if(($(this).hasClass('caption_1')||$(this).attr('class').indexOf('No_')>=0) && $(this).next().hasClass('o')){
                    $(this).next().css({'background-color':'#ffd094','cursor':'pointer'});
                    $(this).css({'background-color':'#ffd094','cursor':'pointer'});
                }
            }

        },'mouseleave':function(){
            if( $(this).attr('title')!='选中' ){ //未选中
                if($(this).hasClass('o') && $(this).prev().hasClass('caption_1')){
                    $(this).css({'background-color':'#fff','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});
                }
                if($(this).hasClass('caption_1') && $(this).next().hasClass('o')){
                    $(this).next().css({'background-color':'#fff','cursor':'pointer'});
                    $(this).css({'background-color':'#FDF8F2','cursor':'pointer'});
                }
            }
        },'click':function(){
            if($(this).hasClass('o') && $(this).prev().hasClass('caption_1')){
                if( $(this).attr('title')=='选中' ){ //已选中 取消选中
                    $(this).css({'background-color':'#fff','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});
                    $(this).attr('title','');
                    $(this).prev().attr('title','');
                }else{												//选中
                    $(this).css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).attr('title','选中');
                    $(this).prev().attr('title','选中');
                }
            }
            if($(this).hasClass('caption_1') && $(this).next().hasClass('o')){
                if( $(this).attr('title')=='选中' ){ //已选中 取消选中
                    $(this).next().css({'background-color':'#fff','cursor':'pointer'});
                    $(this).css({'background-color':'#FDF8F2','cursor':'pointer'});
                    $(this).attr('title','');
                    $(this).next().attr('title','');
                }else{												//选中
                    $(this).next().css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).attr('title','选中');
                    $(this).next().attr('title','选中');
                }
            }
        }})
    }

}
function yiban(){
    if(!$('#yiban').hasClass('on')){
        $('#yiban').addClass('on');
        $('#kuijie').removeClass('on');
        $('.o').each(function(){
            $(this).width( 45 );
            $(this).next().show();
        })
        $('.wqs').each(function(){
            switch ($(this).attr('id')) {
                case 'sanjun':
                    $(this).find("colgroup").html(' <col class="col_single w5"> <col class="w8"> <col class="w9"> <col class="col_single w5"> <col class="w8"> <col class="w9"> <col class="col_single w5"> <col class="w8"> <col class="w9"> <col class="col_single w5"> <col class="w8"> <col class="w9"> ');
                    break;
                case 'weishai':
                    $(this).find("colgroup").html(' <col class="col_single w13"> <col class="w8"> <col class="w125"> <col class="col_single w13"> <col class="w8"> <col class="w125"> <col class="col_single w13"> <col class="w8"> <col class="w125"> ');
                    break;
                case 'dianshu':
                    $(this).find("colgroup").html(' <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> ');
                    break;
                case 'changpai':
                case 'duanpai':
                    $(this).find("colgroup").html(' <col class="col_single w13"> <col class="w8"> <col class="w125"> <col class="col_single w13"> <col class="w8"> <col class="w125"> <col class="col_single w13"> <col class="w8"> <col class="w125"> ');
                    break;
            }
        })

    }
    $('.caption_1,.o').unbind('mouseenter').unbind('mouseleave').unbind('click');
    $('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
    $('.o').css({'background-color':'#fff','cursor':''});
    $('#td_input_money').hide();
}
function MyReset(){
    $('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
    $('.o').css({'background-color':'#fff','cursor':''});
    $('.caption_1').attr('title','');
    $('.o').attr('title','');
    $('.inp1').val('');
    $('#AllMoney').val('');
    $('#AllMoney1').val('');
}

function AllMoney(){
    var sel=false;
    var money = $('#AllMoney').val() != ''? $('#AllMoney').val():$('#AllMoney1').val();
    $('.loads').each(function(){
        if(  $(this).prev().attr('title')=='选中' ){ //已选中
            $(this).find('input').val(money);
            sel=true;
        }
    })
    return sel;
}
function iSubmit(){
    if($('#kuijie').hasClass('on')){
        var sel = AllMoney();
        if(sel==false){
            my_alert('您未选择号码！');
            return false;
        }
    }
    return true;
}

/**************************************/
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
				link = "<span class=\"bgh\">"+odds+"</span>";
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
                //开奖时间结束也就是要开下一期的时候：要刷新左侧的注单
                window.parent.leftFrame.$('#rushBtn').click();
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
			var cHtml = '<tr class="t_list_caption"><th colspan="6">近期开奖结果</th></tr>';
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
    if(iSubmit()==false)return false;
	var ss="", a = false, c= true, count = countmoney =0, names=[], value, s, z, o, n, m;
	var input = $("input.inp1");
	var mixmoney = parseInt($("#mix").val());
    var ball_array = new Array();
    var odd_array = new Array();
    var money_array = new Array();
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
			 
			o = $("#"+s[1]+"").text();
			n = z+"["+m+"] @ "+o+" x ￥"+value;
            if (m == "全骰" || z == '点数') {
                ball_array.push(m);
            } else {
                ball_array.push(z+ ' (' + m+')');
            }
            odd_array.push('<span style="color:red">'+o+'</span>');
            money_array.push(value);
			names.push(n+"\n");
		}
	});
    if (count == 0){ my_alert("您输入类型不正确或没有输入实际金额");return false;}
    if (c == false){ my_alert("最低下注金额："+mixmoney+"￥");return false;}
/*	var confrims = "共 ￥"+countmoney+" / "+count+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
	confrims +=names.join('');
	if (confirm(confrims)){*/
		input.val(""); 
		var number = $("#o").html(); 
		var s_type = '<input type="hidden" name="s_cq" value="'+ss+'"><input type="hidden" name="s_number" value="'+number+'">';
		$(".actiionn").html(s_type);
//		return a;
/*	}*/
    MyReset();
    submit_confirm(ball_array,odd_array,money_array);
	return false;
}

function nameformatcq(str){
	switch(str){ 
		case "Ball_1" : return "三军";
		case "Ball_2" : return "围骰";
		case "Ball_3" : return "点数";
		case "Ball_4" : return "长牌";
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
			return $('#'+str).prev().text();
        case 'd':
			var div1 = $('#'+str).prev().find('span')[0];
			var div2 = $('#'+str).prev().find('span')[1];
			return $(div1).attr('class').replace('number num','')+$(div2).attr('class').replace('number num','');
		case 'e':
            var div1 = $('#'+str).prev().find('span')[0];
            var div2 = $('#'+str).prev().find('span')[1];
            return $(div1).attr('class').replace('number num','')+$(div2).attr('class').replace('number num','');
	}
}