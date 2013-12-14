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



function set_ball_list(ball_array)
{
    var ball_str = ball_array.join("&nbsp");
    $("#selectedlist").html(ball_str).parent().show();
    $("#selectedAmount").html(ball_array.length);
}


function set_clickable(ball_selecter_str)
{
    var $ball_selecter = $(ball_selecter_str);
    var $checkbox_selecter = $(ball_selecter_str).next();
    var select_sign = 'onBg';
    var mouse_over_sign = 'bcd';
    var ball_list = new Array();


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
        set_ball_list(ball_list);
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
            ball_id = $(this).prev().attr('number');
            ball_list.push(ball_id);
        }
        set_ball_list(ball_list);
    }).mouseenter(function(){
        $(this).addClass(mouse_over_sign);
        $(this).prev().addClass(mouse_over_sign);
    }).mouseleave(function(){
        $(this).removeClass(mouse_over_sign);
        $(this).prev().removeClass(mouse_over_sign);
    });
}

function submit_form()
{

}
