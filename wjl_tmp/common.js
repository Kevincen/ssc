/**
 * Created by koovincen on 13-11-1.
 * copy from manage/topMenu.php
 */

var Global = new Object();
Global.qiyong = 1;
Global.tingya = 2;
Global.tingyong = 3;
Global.credit_array = new Array();
Global.credit_array[1] = 'klsf';
Global.credit_array[2] = 'cqssc';
Global.credit_array[6] = 'bjsc';
Global.credit_array[5] = 'xync';
Global.credit_array[9] = 'jssb';


/*
 @param url 目标地址
 @param str 要载入的html标签选择器
 */
function common_load(url, str) {
    $.get(url, function (data) {
        alert(data);
        $(str).html(data);
    })
}

function Actfor_load(url) {
    //common_load(url, "#rightLoader");
    window.location=url;
}
/*
 * @describe ajax动态更改禁用启用
 * @param type 目的状态
 * @param uid 更改用户名
 * @param utype 当前状态
 * @param callback 成功的回调函数
 */
function changeAjax(type, uid, utype, callback) {
    $.ajax({
        type: "POST",
        data: {type: type, uid: uid, utype: utype},
        url: "setZT.php",
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            if (XMLHttpRequest.readyState == 4) {
                if (XMLHttpRequest.status == 500) {
                    changeAjax(type, uid, utype);
                    return false;
                }
            }
        },
        success: callback
    });
}
/*
 *禁用，停用，启用转换
 * @param name 进行更改的用户名
 */
function act_change_use(name, thisobj) {
    var op_str = thisobj.innerHTML;
    var stat_selecter = 'tr[account=' + name + '] '+ 'td[name=cur_status]';
    var is_use_selecter = 'tr[account=' + name + '] ' + 'a[name=is_used]';
    var is_frozen_selecter = 'tr[account=' + name + '] ' + 'a[name=is_frozen]';
    var target_status = thisobj.getAttribute('target_status');
    var current_status = $(stat_selecter).attr('ct');
    var callback = function (data) {
        var $isused = $(is_use_selecter);
        var $isfrozen = $(is_frozen_selecter);
        var $current = $(stat_selecter);
        if (data == '啟用') {
            $current.text('启用');
            $isused.text('禁用');
            $isused.attr('target_status', Global.tingyong);
            $isfrozen.text('停押');
            $isfrozen.attr('target_status', Global.tingya);
        } else if (data == '凍結') {
            $current.text('停押');
            $isused.text('启用');
            $isused.attr('target_status', Global.qiyong);
            $isfrozen.text('停用');
            $isfrozen.attr('target_status', Global.tingyong);
        } else if (data == '停用') {
            $current.text('<font color="red">停用</font>');
            $isused.text('启用');
            $isused.attr('target_status', Global.qiyong);
            $isfrozen.val('停押');
            $isfrozen.attr('target_status', Global.tingya);
        }
    };
    $.dialog({
        title: '用户提示',
        content: '确定' + op_str + name,
        ok: function () {
            //TODO:need test
            changeAjax(target_status, name, 2, callback);
        },
        cancel: function () {
            return true
        }
    });
}

function show_Rank() {
    
}

function set_sub_water(water, selector) {
    if ($(selector).length > 0) {
        $(selector).value = water;
    }
}

function set_water(water) {
    for (var i=0; i< 166; i++) {
        set_sub_water(water['a'], "a"+i);
        set_sub_water(water['b'], "b"+i);
        set_sub_water(water['c'], "c"+i);
    }
}

function water_setting(value)
{
    var default_water  = new Array();
    default_water['a']= 0.73;
    default_water['b'] = 1.73;
    default_water['c'] = 2.73;
    if (value == 0) {
    } else if (value == 100) {
        for (var i in default_water) {
            default_water[i] *= 0;
        }
    } else {
        for (var i in default_water) {
            default_water[i] -= value;
        }
    }
    set_water(default_water);
}
function set_credit_show(tid)
{
    var selector_string = Global.credit_array[tid];
    $selector = $("#" + selector_string);
    if ($selector.length < 0) {
        alert("错误的选择,请联系管理员");
    }
    $('.showtable').addClass('hidetable').removeClass('showtable');

    $selector.addClass('showtable').removeClass('hidetable');
}
function form_type_change(value) {
    var select_str;
    $(".show").addClass('hidden').removeClass('show').attr("name","");
    switch (value) {
        case '0':
            select_str = "#default";
            break;
        case '1':
            select_str = "#klsf";
            break;
        case '2':
            select_str = "#cqssc";
            break;
        case '5':
            select_str = "#bjsc";
            break;
        case '6':
            select_str = "#xync";
            break;
        case '9':
            select_str = "#jssb";
            break;
    }
    $(select_str).addClass('show').removeClass("hidden").attr("name","s_number");

}
/*
* 快乐十分树球转换
* */
function klsf_num_to_ball(value)
{
    var html_code = '<span class="number num'+ value +'"></span>'
    return html_code;
}

function set_ball_in_form(ball_list, typeid)
{
    var func;
    var html_code = '<tr>';

    if (typeid == 1) {
        func = klsf_num_to_ball;
    }

    for (var key in ball_list) {
        html_code += '<td>' + func(ball_list[key]) + '</td>'
    }
    html_code += '</tr>';
}
//在期数选择的时候将底部的球号写入顶部
function set_ball_in_top(val)
{
    console.log(val);
    var $tops = $('.qiuhao').siblings(".qiuhao");
    console.log($tops);
    if (val != undefined) {
        var $selected = $('#'+val);
        var $balls = $selected.children();
        console.log($balls);
        for (var key in $tops) {
            $tops[key].innerHTML = $balls[key].outerHTML;
        }
    }
    //如果没有数据则什么都不做
}
