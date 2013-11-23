var url = null, dataList = null, lock=false;
var Urls = "/Manage/temp/ajax/json.php";
var EstateTime = 90;
var EndTime = 90;
var StartTime = 90;
var phasesNumber/*当前期数*/, EndTimeHtml, RefreshTimeHtml, NumberHtml, CountNumHtml, 
CountNumsHtml, CountLoseHtml, CountWinHtml, TimeArr = new Array();
$(document).ready(function (){
			
	//url = location.href.split("?")[1].split("=")[1];
    url = location.href;
    url = url.split("?")[1];
    if (url != undefined) {
        url = url.split("=")[1];
    }
    alert(url);
	if (url !=10) setList ();
	EstateTime = $("#EstateTime").val();
	NumberHtml = $("#number");
	EndTimeHtml = $("#EndTime");//结束时间 offtime为封盘时间
	RefreshTimeHtml = $("#RefreshTime");
	CountNumHtml = $("#CountNum");
	CountNumsHtml = $("#CountNums");
	CountLoseHtml = $("#CountLose");
	CountWinHtml = $("#CountWin");
	loadUserInfo (url);//加载所有用户数据
	setLists();//期数获取，不知道具体是干啥的
	_loadInfo();//开奖号码加载
});

/**
 * 開出號碼須加載
 */
function _loadInfo(){
	$.post(Urls, {typeid : "kaijiang"}, function(data){
		_Number (data.number, data.ballArr); //開獎號碼
	}, "json");
}
function _Number (number, ballArr) {
	var Clss = null;
	var idArr = ["#q_a","#q_b","#q_c","#q_d","#q_e","#q_f","#q_g","#q_h"];
	$("#q_number").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "number num"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
	}
}
function setList () {
	$.post (Urls, {typeid : 3}, function (data) {
        console.log(data);
		if (data.num != ""){
			var row_1Html = new Array();
			var setResult = new Array();
			for (var key in data.num){
				//row_1Html.push("<tr bgcolor=\"#fff\" height=\"18\"><td  class=\"uo\">"+key+"</td><td class=\"fe\">"+data.num[key]+" 期</td></tr>");
                row_1Html.push( '<tr> <td class="grey blue" style="border-right:none;width:38%;">'+key+'</td> <td class="grey blue" style="border-left:none;width:32%;">??</td> <td class="bg-pink bg-pink2" style="width:30%;">'+data.num[key]+'</td> </tr>')
			}
            console.log(row_1Html);
			//var cHtml = '<tr class="tr_top"><th colspan="2">兩面長龍排行</th></tr>';
			//$("#changlong").html(cHtml+row_1Html.join(""));
			$("#changlong").html(row_1Html.join(""));
		}
	}, "json");
};

/**
 * 加載當前登錄用戶即時注單信息
 * @param cid 讀取賠率信息參數
 */
function loadUserInfo (cid){
	$.post(Urls, {typeid : 5, cid : cid}, function(data){
		/*data解释:
		 * ==>endTime//关闭时间
		 * ==>openTime//开盘时间
		 * ==>phasesNumber//最新期数
		 * ==>userList 用户盈亏,注单等
		 * 		--count 用户投注额
		 * 		--count_c//下注金额
		 * 		--count_d//seems to for debug
		 * 		--list countList 总投注额
		 * 		--list_s //盈亏
		 * 		--list_x
		 * */
        console.log(data);
		phasesNumber = data.infoList.phasesNumber;
		NumberHtml.html(phasesNumber);
		$("#win").html(data.dayWin);//填入今天输赢
		if (data.infoList.endTime>0){//如果封盘时间大于0
			$("#offTime").css("color","#333");
		}
		EndTime = data.infoList.endTime //封盤時間
		StartTime =data.infoList.openTime; //開獎時間
		if (data.infoList.userList != null){//如果用户注单不为空	
			//what the fuck are these
			CountNumHtml.html(Math.round(data.infoList.userList.count[0]));
			CountLoseHtml.html(Math.round(data.infoList.userList.count[1]));
			CountWinHtml.html(Math.round((data.infoList.userList.count[0]-data.infoList.userList.count[8])));
			CountNumsHtml.html(Math.round(data.infoList.userList.count_c[0]));
			if (cid == 10) dataList = data.infoList.userList;
			sumIsNumLose(data.infoList.userList, cid);//拿来填写注单
		} else {
			initialize ();//初始化，没有数据显示'-'之类的
		}
		setOdds(data.infoList.oddList);//赔率都是在这里设置的。
        if (cid != undefined) {
            setOddsByOrder(data.infoList.oddList);//按亏损排行 by wjl
        }
		if (lock == false){
			endTime ();
			lock = true;
		}
		planning();
        set_sorted_list(data.infoList);
	}, "json");
}
/*
* 按亏损排行填写
* 基本思路：对json数据进行排行，然后依次填写1到20
* */
function setOddsByOrder(dataList)
{
}


/**
 * 赔率是在这里设置的。
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
//盈亏都是在这里设置的
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
				console.log("期数setLists"+data);
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
		$("#offTime").html("距离开奖：").css("color","red");
	}
	if (StartTime <1){
		//開獎時間結束
		lock = false;
		$.post(Urls, {typeid : 9}, function(){});
		$("td.odds").css("background", "#fff");
		$("#offTime").html("距离封盘：").css("color","#333");
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
					list.push('<td class="rights">'+win.toFixed(3)+'</td>');
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
	//return;
	var Param = parseInt($("#Param").val()); //平均值
	
	for (var i=1; i<36; i++){
		var d = parseInt($("#d"+i).html()); //虧盈
		var h = $("#h"+i).html(); //賠率
		var b = $("#b"+i);  //輸出

		if (d!=null && d < Param && Param < 0){
			//alert(Param * h - Param);
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



function my_sort(arr, cmp)
{
    var len = arr.length;
    for (var i = 0; i < len; i++) {
        for (var j = i+1; j < len; j++) {
            var greater = cmp(arr[i], arr[j]);
            if (greater >= 0) {
                var tmp = arr[i];
                arr[i] = arr[j];
                arr[j] = tmp;
            }
        }
    }
}

function my_cmp(a, b) {
    return b['value'] - a['value'];
}

function sub_and_sort(list, tmp_array)
{
    var i = 1;
    for (var key in list) {
        if (key <= 20) {
            if (i < key) {
                for (; i < key; i++) {
                    var fuck = new Array();
                    fuck['value']= 0;
                    fuck['key'] = i;
                    tmp_array.push(fuck);
                }
            }

            var tmp = new Array();
            tmp['value']= list[key];
            tmp['key'] = key;
            tmp_array.push(tmp);

        }
        i++;
    }
    my_sort(tmp_array, my_cmp);
    return tmp_array;
}

function convert_num(val)
{
    return isNaN(val)?0:val;
}


/*
 * 填写排序后的两个div
 * @param data json返回回来的赔率，注单等信息
 * @return null
 * */
function set_sorted_list(data) {
    var infoList = data.userList;
    var oddList = data.oddList;
    var sorted = new Array();
    //排序：可以单独对list进行排序，再使用键名一起写入
    //先进行裁剪，因为我们只需要对1-20球进行排序

    console.log(infoList);
    //infoList.list.length = 20;
    //获取前20位数字，然后排序
    sorted = sub_and_sort(infoList.list_s,sorted);
    console.log("排序后的注额数组");
    console.log(sorted);
    var counter = 1;
    var current_ball = '00';
    console.log("key record start");
    for (var i=0; i<20; i++) {
        var key = sorted[i]['key'];
        console.log(key);
        console.log(isFloat(oddList[0]['h'+key]));
        console.log(oddList[0]['h'+key]);
        if (parseInt(key) < 10) {
            current_ball = "0" + key;
        } else {
            current_ball = key;
        }
        console.log(current_ball);
        $("#nsorted" + counter).html(current_ball);
        $("#hsorted" + counter).html(isFloat(oddList[0]['h'+key]));
        $("#asorted" + counter).html(convert_num(Math.round(infoList.list[key])));
        $("#dsorted" + counter).html(convert_num(Math.round(infoList.list_s[key])));

        $("#nsort_extra" + counter).html(current_ball);
        $("#hsort_extra" + counter).html(isFloat(oddList[0]['h'+key]));
        $("#asort_extra" + counter).html(convert_num(Math.round(infoList.list[key])));
        $("#dsort_extra" + counter).html(convert_num(Math.round(infoList.list_s[key])));
        counter++;
    }
    console.log("key record end");

}
/*todo:需要进行测试*/
/*控制排序div的隐藏和现实*/
function sorted_toggle(value) {
    var $not_sortedtable = $('#not_sorted');
    var $sorted_table = $('#sorted');
    var $sorted_extra_table = $('#sorted_extra');
    var $zhongfabai = $('#zhongfabai');
    if (value == 1) {
        $not_sortedtable.show();
        $sorted_extra_table.show();
        $sorted_table.hide();
        $not_sortedtable.css('width','33.1%');
        $sorted_extra_table.css('width','33.1%');
        $zhongfabai.css('width','33.1%');
    } else if (value == 2) {
        $not_sortedtable.hide();
        $sorted_extra_table.hide();
        $sorted_table.show();
        $not_sortedtable.css('width','49.8%');
        $zhongfabai.css('width','49.8%');
    }
}


