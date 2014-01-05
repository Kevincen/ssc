/**
 * Created by 2b
 */
/*****************************
 * 新增快捷和正常投注
 *****************************/
function kuijie(){
    $('#td_input_money').css('display','inline');
    $('#td_input_money1').css('display','inline');
    if(!$('#kuijie').hasClass('on')){
        $('#touzhu_type').val('fast');
        $('#kuijie').addClass('on');
        $('#yiban').removeClass('on');
        var i=0;
        $('.tt').each(function(){
            $(this).prev().attr('align','center')
            $(this).hide();
            //$(this).css('display','none');
        })
        $('.wqs').each(function(){
            $(this).find("colgroup").html('<col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125">');
        })
        //快乐农场正码
        $('.wqs_top').find('colgroup').html('<col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125">');
        $('.wqs_bottom').find('colgroup').html('<col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125">');
        //快乐农场正码结束
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
        //设置投注类型
        $('#touzhu_type').val('normal');
        $('#yiban').addClass('on');
        $('#kuijie').removeClass('on');
        $('.tt').each(function(){
            $(this).show();
        })
        $('.wqs').each(function(){
            $(this).find("colgroup").html('<col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8">');
        })
        //快乐农场正码
        $('.wqs_top').find('colgroup').html('<col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125">');
        $('.wqs_bottom').find('colgroup').html('<col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8">');
        //快乐农场正码结束

    }
    $('.caption_1,.o').unbind('mouseenter').unbind('mouseleave').unbind('click');
    $('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
    $('.o').css({'background-color':'#fff','cursor':''});
    $('#td_input_money').hide();
    $('#td_input_money1').hide();
}
function MyReset(){
    $('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
    $('.o').css({'background-color':'#fff','cursor':''});
    $('.caption_1').attr('title','');
    $('.o').attr('title','');
    $('.inp1').val('');
    $('#AllMoney').val('');
}

function AllMoney(){
    var sel=false;
    $('.tt').each(function(){
        if(  $(this).prev().attr('title')=='选中' ){ //已选中
            $(this).find('input').val( $('#AllMoney').val() );
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


var _lock = false;
var setAction = new Array();
var setTime = new Array();
var setHtml = new Array();
var MinutesRound = new Array();
var SecondsRound = new Array();
var setResult = new Array();
var _href = "ZHENGMA";
var URL = "../ajax/Default.ajax_nc.php";//正码(农场)
//寻找对应赔率
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
    }
    return r;
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
        $("input.amount-input").each(function(){
           $(this).attr('disabled',true);
        });
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
            console.log("刷新时间")
            console.log(data);
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
setAction[7] = function () { //兩面長龍
    //if (_href.indexOf("k2") > -1) return;
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
                row_1Html.push("<tr bgcolor=\"#fff\" height=\"22\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+key+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+data.row_1[key]+" 期</td></tr>");
            }
            var cHtml = '<tr class="t_list_caption"><th colspan="2">兩面長龍排行</th></tr>';
            $("#cl").html(cHtml+row_1Html.join(""));
        }
        for (var k in data.row_2){
            row_2Html.push(data.row_2[k]);
        }
        $("#z_cl").html(row_2Html.join(''));
        $(".z_cl:even").addClass("hhg");
    }, "json");
};
//加载球号
function _Number (number, ballArr) {
    var Clss = null;
    var idArr = ["#a","#b","#c","#d","#e","#f","#g","#h"];
    $("#number").html(number);
    for (var i = 0; i<ballArr.length; i++) {
        Clss = "number num"+ballArr[i];
        $(idArr[i]).removeClass().addClass(Clss);
    }
}
var NumberCache = null;
setAction[8] = function () { //开奖
    var winResult = $("#sy");
    $.post (URL, { typeid : "openNumber"}, function (data) {
        //alert(data);return;
        console.log("开奖");
        console.log(data);
        if (NumberCache == null){
            NumberCache = data.number;
            _Number(data.number, data.ballArr);
            setAction[7]();
            winResult.html(data.winMoney);
            return;
        } else if (NumberCache != null && NumberCache != data.number) {
            if($("#soundbut").attr("value")=="on"){
                $("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
            }getinfotop();
            NumberCache = data.number;
            _Number(data.number, data.ballArr);
            setAction[7]();
            winResult.html(data.winMoney);
            return;
        } else {
            setTimeout(setAction[8], 3000);
        }
    }, "json");
};
function set_odds(odds_array, odd_put_selecter) {
    var id;
    var odd;
    $(odd_put_selecter).each(function(){
        id = $(this).attr('id');
        odd = sodds(id,odds_array);
        $(this).html(odd);
    });
}
function set_infos()
{
    $.post (URL, { typeid : "action", nid : "ZHENGMA" },  function (data) {
        if (data == null){
            console.log("无法获取json数据");
            return;
        }
        console.log("odd等数据")
        console.log(data);
        $("#o").html(data.Phases);
        setTime[0] = data.endTime; //封盤時間
        setTime[1] = data.openTime; //開獎時間
        setTime[2] = data.refreshTime; //刷新時間
        setHtml[0] = $("#endTime");
        setHtml[1] = $("#endTimes");
        setHtml[2] = $("#endTimea");
        if (setTime[0] > 0){
            set_odds(data.odds,'.loads'); //賠率
        }
        setAction[8]();//开奖
        setAction[0]();//封盘时间和封盘期数
        setAction[1]();//开奖时间
        setAction[2]();//刷新时间
    },"json");
}


//底下横栏的写入
function getResult ($this){
    $(".kon").removeClass("kon");
    $($this).addClass("kon");
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
        case "总和大小" : return setResult[7];
        case "总和单双" : return setResult[8];
        case "总和尾数大小" : return setResult[9];
    }
}
/****************提交投注**************/
/*
 @param typename 输入的变量名
 @param val      输入的变量值
 return html_code*/
function gen_input(typename, val)
{
    return '<input type="hidden" name="'+ typename + '" value="'+ val +'"/>'
}


function add_prefix(ball_array)
{
    for (var i=0;i<ball_array.length;i++) {
        if (ball_array[i] <=20 && ball_array[i] >0) {
            ball_array[i] = '正码 ' + ball_array[i];
        } else {
            switch (ball_array[i]) {
                case "21":
                    ball_array[i] = '总和大';
                    break;
                case "22":
                    ball_array[i] = '总和小';
                    break;
                case "23":
                    ball_array[i] = '总和单';
                    break;
                case "24":
                    ball_array[i] = '总和双';
                    break;
                case "25":
                    ball_array[i] = '总和尾大';
                    break;
                case "26":
                    ball_array[i] = '总和尾小';
                    break;

            }
            ball_array[i] = '总和 ' + ball_array[i];
        }
    }
    return ball_array;
}

function submitforms(){
    $.ajax ({type:"post",url:URL,dataType:"text",async:false,data:{typeid:"postodds"},success : function (data) {
        $.post(URL, { typeid : "sessionId"}, function(){});
        if (data) {
            my_alert("抱歉！您的账号已被冻结，请与你的上级联系。");
            return false;
        }

        /*  php 所需数据格式
         $s_type = $_POST['s_type'];//本项目名称 如正码
         $s_ball_arr = $_POST['s_ball'];//下注的具体小项目名称
         $s_money_arr = $_POST['s_money'];//每一注的金钱
         $s_hid_arr = $_POST['s_hid'];//具体的项目标号号如：h1 h2 h3 h4 h5等*/
        var typename;//项目名称 如正码
        var ball_array = new Array();//下注的具体小项目名称
        var money_array = new Array();//每一注的金钱
        var ball_id_array = new Array();//具体的项目标号号如：h1 h2 h3 h4 h5等
        var odd_array = new Array();//小项目的赔率数组，仅仅用于显示
        var add_inputs;
        var ball_selecter = ".o";

        typename = "正码";
//
        add_inputs = gen_input('s_type',typename); //生成隐藏输入值
        //将期数填入
        $('input[name=s_number]').val($('#o').html());

        if ($('#touzhu_type').val() != 'fast') {
            //submitforms();
            $input_elems = $("input.amount-input");
            $input_elems.each(function(){
                var money = $(this).val();
                var odd;
                var ballname;
                var ballnum;
                var $data_src = $(this).parent().prev();
                if (money != '') {
                    ballname = $data_src.attr('ball_name');
                    ballnum = $data_src.attr('id');
                    odd = $data_src.html();
                    add_inputs += gen_input('s_ball[]',ballname) ;
                    add_inputs += gen_input('s_money[]',money);
                    add_inputs += gen_input('s_hid[]',ballnum);
                    ball_array.push(ballname);
                    ball_id_array.push(ballnum);
                    odd_array.push(odd);
                    money_array.push(money);

                }
            });
        } else {
            var money = parseInt($('#AllMoney').val());
            if (isNaN(money) == true) {
                my_alert('您输入类型不正确或没有输入实际金额');
                return false;
            } else {
                var debug_counter = 0;
                $(ball_selecter+"[title='选中']").each(function(){
                    var ballname;
                    var ballnum;
                    var odd;
                    debug_counter++;

                    ballname = $(this).attr('ball_name');
                    ballnum = $(this).attr('id');
                    odd = $(this).html();
                    add_inputs += gen_input('s_ball[]',ballname) ;
                    add_inputs += gen_input('s_money[]',money);
                    add_inputs += gen_input('s_hid[]',ballnum);
                    ball_array.push(ballname);
                    ball_id_array.push(ballnum);
                    money_array.push(money);
                    odd_array.push(odd);
                });
                console.log(debug_counter);
            }
        }
        if (ball_array.length == 0
            || ball_id_array.length == 0
            || money_array.length == 0) {
            my_alert('您未选择号码');
            return false;
        }

        console.log(ball_array);
        console.log(ball_id_array);
        console.log(money_array);
        $('#hidden_inputs').html(add_inputs);

        //显示弹窗菜单
        ball_array = add_prefix(ball_array);
        submit_confirm(ball_array,odd_array,money_array);
        //清空
        MyReset();
        return false;
    }
    });
}