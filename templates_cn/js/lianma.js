/**
 * Created by 2b on 13-12-15.
 */
Array.prototype.indexOf = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
    }
    return -1;
};
Array.prototype.remove = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};

function set_action(url)
{
    var number = $("#o").html()
    $("#lm").attr('action',url + "?v=" + number).submit();
}



function set_ball_list(ball_array, list_selecter, amount_selecter)
{
    var ball_str = ball_array.join("&nbsp");
    $(list_selecter).html(ball_str).parent().show();
    $(amount_selecter).html(ball_array.length);
}

/*取消可点击事件*/
function unset_clickable(ball_selecter_str, list_selcter, amount_selcter)
{

    var $ball_selecter = $(ball_selecter_str);
    var $checkbox_selecter = $(ball_selecter_str).next();
    var select_sign = 'onBg';
    var mouse_over_sign = 'bcd';


    $ball_selecter.click(function(){
    });
    $checkbox_selecter.click(function(){
    });
}


var ball_list = new Array();
function set_clickable(ball_selecter_str, list_selecter, amount_selecter)
{
    var $ball_selecter = $(ball_selecter_str);
    var $checkbox_selecter = $(ball_selecter_str).next();
    var select_sign = 'onBg';
    var mouse_over_sign = 'bcd';


    $ball_selecter.click(function(){
        var ball_id;
        if ($(this).hasClass(select_sign)) {
            $(this).removeClass(select_sign);
            ball_id = $(this).next().removeClass(select_sign).find('input').attr('checked',false).attr('number');
            ball_list.remove(ball_id);
        } else {
            $(this).addClass(select_sign);
            ball_id = $(this).next().addClass(select_sign).find('input').attr('checked',true).attr('number');
            ball_list.push(ball_id);
        }
        set_ball_list(ball_list, list_selecter,amount_selecter);
    }).mouseenter(function(){
        $(this).addClass(mouse_over_sign);
        $(this).next().addClass(mouse_over_sign);
    }).mouseleave(function(){
        $(this).removeClass(mouse_over_sign);
        $(this).next().removeClass(mouse_over_sign);
    });
    $checkbox_selecter.click(function(){
        var ball_id;
        if ($(this).hasClass(select_sign)) {
            $(this).prev().removeClass(select_sign);
            ball_id = $(this).removeClass(select_sign).find('input').attr('checked',false).attr('number');
            ball_list.remove(ball_id);
        } else {
            $(this).prev().addClass(select_sign);
            ball_id = $(this).addClass(select_sign).find('input').attr('checked',true).attr('number');
            ball_list.push(ball_id);
        }
        set_ball_list(ball_list, list_selecter, amount_selecter);
    }).mouseenter(function(){
        $(this).addClass(mouse_over_sign);
        $(this).prev().addClass(mouse_over_sign);
    }).mouseleave(function(){
        $(this).removeClass(mouse_over_sign);
        $(this).prev().removeClass(mouse_over_sign);
    });
}

var total_length = 0;
function set_clickable_nc()
{
    var select_sign = 'onBg';
    var mouse_over_sign = 'bcd';
    var ball_list = new Array();

    /*第一个表格开始*/
    var $ball_selecter = $('.lianma_zh .ballno-t-t');
    var $checkbox_selecter = $('.lianma_zh .ballno-t-t').next();


    $ball_selecter.click(function(){
        var ball_id;
        if ($(this).hasClass(select_sign)) {
            $(this).removeClass(select_sign);
            ball_id = $(this).next().removeClass(select_sign).find('input').attr('checked',false).attr('value');
            ball_list.remove(ball_id);
            total_length--;
        } else {
            $(this).addClass(select_sign);
            ball_id = $(this).next().addClass(select_sign).find('input').attr('checked',true).attr('value');
            ball_list.push(ball_id);
            total_length++;
        }
        var ball_str = ball_list.join("&nbsp");
        $('#selectedlist_m1').html(ball_str).parent().show();
        $('#selectedAmount2').html(total_length);
    }).mouseenter(function(){
            $(this).addClass(mouse_over_sign);
            $(this).next().addClass(mouse_over_sign);
        }).mouseleave(function(){
            $(this).removeClass(mouse_over_sign);
            $(this).next().removeClass(mouse_over_sign);
        });
    $checkbox_selecter.click(function(){
        var ball_id;
        if ($(this).hasClass(select_sign)) {
            $(this).prev().removeClass(select_sign);
            ball_id = $(this).removeClass(select_sign).find('input').attr('checked',false).attr('value');
            ball_list.remove(ball_id);
            total_length--;
        } else {
            $(this).prev().addClass(select_sign);
            ball_id = $(this).addClass(select_sign).find('input').attr('checked',true).attr('value');
            ball_id = $(this).prev().attr('number');
            ball_list.push(ball_id);
            total_length++;
        }
        var ball_str = ball_list.join("&nbsp");
        $('#selectedlist_m1').html(ball_str).parent().show();
        $('#selectedAmount2').html(total_length);
    }).mouseenter(function(){
            $(this).addClass(mouse_over_sign);
            $(this).prev().addClass(mouse_over_sign);
        }).mouseleave(function(){
            $(this).removeClass(mouse_over_sign);
            $(this).prev().removeClass(mouse_over_sign);
        });
    /*第一个表格结束*/

    /*第二个表格开始*/
    $ball_selecter = $('.lianma_h .ballno-t-t');
    $checkbox_selecter = $('.lianma_h .ballno-t-t').next();

    var ball_list2 = new Array();


    $ball_selecter.click(function(){
        var ball_id;
        if ($(this).hasClass(select_sign)) {
            $(this).removeClass(select_sign);
            ball_id = $(this).next().removeClass(select_sign).find('input').attr('checked',false).attr('value');
            ball_list2.remove(ball_id);
            total_length--;
        } else {
            $(this).addClass(select_sign);
            ball_id = $(this).next().addClass(select_sign).find('input').attr('checked',true).attr('value');
            ball_list2.push(ball_id);
            total_length++;
        }
        var ball_str = ball_list2.join("&nbsp");
        $('#selectedlist_m2').html(ball_str).parent().show();
        $('#selectedAmount2').html(total_length);
    }).mouseenter(function(){
            $(this).addClass(mouse_over_sign);
            $(this).next().addClass(mouse_over_sign);
        }).mouseleave(function(){
            $(this).removeClass(mouse_over_sign);
            $(this).next().removeClass(mouse_over_sign);
        });
    $checkbox_selecter.click(function(){
        var ball_id;
        if ($(this).hasClass(select_sign)) {
            $(this).prev().removeClass(select_sign);
            ball_id = $(this).removeClass(select_sign).find('input').attr('checked',false).attr('value');
            ball_list2.remove(ball_id);
            total_length--;
        } else {
            $(this).prev().addClass(select_sign);
            ball_id = $(this).addClass(select_sign).find('input').attr('checked',true).attr('value');
            ball_id = $(this).prev().attr('number');
            ball_list2.push(ball_id);
            total_length++;
        }
        var ball_str = ball_list2.join("&nbsp");
        $('#selectedlist_m2').html(ball_str).parent().show();
        $('#selectedAmount2').html(total_length);
    }).mouseenter(function(){
            $(this).addClass(mouse_over_sign);
            $(this).prev().addClass(mouse_over_sign);
        }).mouseleave(function(){
            $(this).removeClass(mouse_over_sign);
            $(this).prev().removeClass(mouse_over_sign);
        });
}

function my_reset()
{
    $('td.kon').removeClass('kon');
    $('td.onBg').removeClass('onBg');
    $("input[type=checkbox]").attr('checked',false);
    //清空数组
    ball_list.length = 0;
    $("#selectedlist").parent().hide();

    /* 农场连码*/
    total_length = 0;
    $('#selectedlist_m1').parent().hide();
    $('#selectedlist_m2').parent().hide();
}

function submit_form()
{

}
