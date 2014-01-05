/**
 * Created by kevin on 13-11-30.
 * 前台正码使用js
 * @alias jquery.js
 * @alias artdialog.js
 */

/*****************************
 * 新增快捷和正常投注
 *****************************/
function kuijie(){
    $('#td_input_money').show();
    $('#td_input_money1').show();
    if($('#kuijie').attr('class')!='intype_hover'){
        $('#kuijie').attr('class','intype_hover');
        $('#yiban').attr('class','intype_normal');
        $('#touzhu_type').attr('value', 'fast');//区分快捷投注和一般投注，用在submitform函数里面
        var i=0;
        $('.je').each(function(){
            $(this).hide();
        });
        $('.tt').each(function(){
            //var w = $(this).prev().width();
            //w+=$(this).width()/2;
            //$(this).prev().attr('align','center');
            //$(this).prev().css('width', 132 );
            //$(this).prev().prev().css('width', $(this).prev().prev().width()+$(this).width()/2 );
            $(this).hide();
            //$(this).css('display','none');
        });

        //处理表格
        $('table.wqs').each(function(){
            if($(this).find("colgroup").size() > 0)
            {
                var td_num = $(this).find("tr").eq(2).find("td:visible").length;

                $(this).find("colgroup").html("");
                //计算宽度
                var td_width = 99/td_num;
                var colgroup_str = '';
                for (var i=0;i<td_num;i++)
                {
                    colgroup_str += '<col style="width:'+td_width+'%">';
                }
                $(this).find("colgroup").html(colgroup_str);
            }
        })

        $('.wqs').find('.t_list_caption').find('td').each(function(){
            if( $(this).attr('colspan')>=3 ){
                var n = $(this).attr('colspan')-$(this).attr('colspan')/3
                $(this).attr('colspan',n);
            }
        })
        /*添加效果*/
        $('.caption_1,.o').bind({'mouseenter':function(){
            if( $(this).attr('title')!='选中' ){ //未选中
                if($(this).attr('class')=='o' && $(this).prev().attr('class')=='caption_1'){
                    $(this).css({'background-color':'#ffd094','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#ffd094','cursor':'pointer'});
                }
                if($(this).attr('class')=='caption_1' && $(this).next().attr('class')=='o'){
                    $(this).next().css({'background-color':'#ffd094','cursor':'pointer'});
                    $(this).css({'background-color':'#ffd094','cursor':'pointer'});
                }
            }

        },'mouseleave':function(){
            if( $(this).attr('title')!='选中' ){ //未选中
                if($(this).attr('class')=='o' && $(this).prev().attr('class')=='caption_1'){
                    $(this).css({'background-color':'#fff','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});
                }
                if($(this).attr('class')=='caption_1' && $(this).next().attr('class')=='o'){
                    $(this).next().css({'background-color':'#fff','cursor':'pointer'});
                    $(this).css({'background-color':'#FDF8F2','cursor':'pointer'});
                }
            }
        },'click':function(){
            if($(this).attr('class')=='o' && $(this).prev().attr('class')=='caption_1'){
                if( $(this).attr('title')=='选中' ){ //已选中 取消选中
                    $(this).css({'background-color':'#fff','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});
                    $(this).attr('title','');
                    $(this).prev().attr('title','');
                    $(this).parent().attr('selected','false');//设置父节点也就是tr为选中状态
                }else{												//选中
                    $(this).css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).attr('title','选中');
                    $(this).prev().attr('title','选中');
                    $(this).parent().attr('selected','true');
                }
            }
            if($(this).attr('class')=='caption_1' && $(this).next().attr('class')=='o'){
                if( $(this).attr('title')=='选中' ){ //已选中 取消选中
                    $(this).next().css({'background-color':'#fff','cursor':'pointer'});
                    $(this).css({'background-color':'#FDF8F2','cursor':'pointer'});
                    $(this).attr('title','');
                    $(this).next().attr('title','');
                    $(this).parent().attr('selected','false');//设置父节点也就是tr为选中状态
                }else{												//选中
                    $(this).next().css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).css({'background-color':'#ffc214','cursor':'pointer'});
                    $(this).attr('title','选中');
                    $(this).next().attr('title','选中');
                    $(this).parent().attr('selected','true');//设置父节点也就是tr为选中状态
                }
            }
        }})
    }

}
function yiban(){
    if($('#yiban').attr('class')!='intype_hover'){
        $('#yiban').attr('class','intype_hover');
        $('#kuijie').attr('class','intype_normal');
        $('#touzhu_type').attr('value', 'ordinary');//区分快捷投注和一般投注，用在submitform函数里面

        $('.je').each(function(){
            $(this).show();
        })
        $('.o').each(function(){
            //$(this).width( 45 );
            $(this).next().show();
        })

        //处理表格
        $('table.wqs').each(function(){
            if($(this).find("colgroup").size() > 0)
            {
                var td_num = $(this).find("tr").eq(2).find("td:visible").length;

                $(this).find("colgroup").html("");
                //计算宽度
                var td_width = 99/td_num;
                var colgroup_str = '';
                for (var i=0;i<td_num;i++)
                {
                    colgroup_str += '<col style="width:'+td_width+'%">';
                }
                $(this).find("colgroup").html(colgroup_str);
            }
        })

        $('.wqs').find('.t_list_caption').find('td').each(function(){
            if( $(this).attr('colspan')>=2 ){
                var n = $(this).attr('colspan')+$(this).attr('colspan')/2
                $(this).attr('colspan',n);
            }
        })
    }
    //去除点击事件
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
/*快捷与一般投注结束*/

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
            if (ball_array[i] < 10) {
                ball_array[i] = '0'+ball_array[i];
            }
            ball_array[i] = '正码 ' + ball_array[i];
        } else {
            ball_array[i] = '总和 ' + ball_array[i];
        }
    }
    return ball_array;
}

/*正码投注提交
@param go_on:如果go_on为true 则不执行流程，直接提交
* */
function submit_odds(type_name,ball_selecter, go_on)
{
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

//
    if (go_on === true) {
        return true;
    }
    typename = type_name;
    add_inputs = gen_input('s_type',typename); //生成隐藏输入值
    //将期数填入
    $('input[name=s_number]').val($('#o').html());

    if ($('#touzhu_type').val() != 'fast') {
        //submitforms();
        $input_elems = $("input.inp1");
        $input_elems.each(function(){
           var money = $(this).val();
           var odd;
            var ballname;
            var ballnum;
           var $data_src = $(this).parent().prev();
           if (money != '') {
               ballname = $data_src.attr('ball_name');
               ballnum = $data_src.attr('id');
               odd = $data_src.text();
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
                odd = $(this).text();
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
/*两面盘提交*/
function shuangmian_submit_odds(ball_selecter)
{
    var current_qishu;
    var add_inputs;
    var ball_str ='';///第一球，8，100￥|第二球，8，20￥|
    if ($('#touzhu_type').val() != 'fast') {
        submitforms();
    } else {
        var money = parseInt($('#AllMoney').val());
        if (isNaN(money) == true) {
            my_alert('您输入类型不正确或没有输入实际金额');
            return false;
        } else {
            $(ball_selecter+"[title='选中']").each(function() {
                var ballname;
                var ballnum;
                var typename;

                ballname = $(this).attr('ball_name');
                ballnum = $(this).attr('id');
                typename = $(this).attr('typename');
                ball_str += ballnum + "," + money + "|";
            });
            add_inputs = gen_input('sm_arr',ball_str);
        }
    }
    $('#hidden_inputs').html(add_inputs);
    $.post("../ajax/Default.ajax.php", { typeid : "sessionId"}, function(){});
    return true;

}
function getResult ($this)
{
    $(".nv_a").addClass("nv").removeClass("nv_a");
    $($this).removeClass("nv").addClass("nv_a");
    $(".nv_ab").removeClass("nv_ab");
    $($this).parent().addClass("nv_ab");
    var rowHtml = new Array();
    var data = stringByInt ($($this).html());
    //alert(data);
    for (var k in data)
    {
        rowHtml.push(data[k]);
    }
    $("#z_cl").html(rowHtml.join(''));
    $(".z_cl:even").addClass("hhg");
}
