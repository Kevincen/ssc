/**
 * Created by 2b on 13-12-20.
 */

Array.prototype.indexOf = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
    }
    return -1;
};
function show_mingxi($elem)
{
    var result_str = $elem.attr('results');
    var user_str = $elem.attr('users');
    var game_type = $elem.attr('game_type');
    var odds = $elem.attr('odds');
    var money = $elem.attr('money');
    var title_str = $elem.html();
    var user_array = Array();
    var result_array = Array();
    var number_html = '';
    if (user_str == '') {
        my_alert('无法读取用户投注细节');
        return;
    }

    user_array = user_str.split('|');

    result_array = result_str.split('|');

    var money_each = money / user_array.length;

    for (var i=0; i< user_array.length; i++) {
        if (result_array.indexOf(user_array[i]) != -1 ) {
            number_html += '<div class="huise">';
        } else {
            number_html += '<div>';
        }
        number_html += '<em>'+ game_type +'</em><br>'+user_array[i]+'<br>('+odds+')<br><span>'+ money_each +'</span>';
        number_html += '</div>';
    }



    var num_selecter = '.pop_loader .comb';
    var money_selecter = '.pop_loader .money';
    var title_selecter = '.pop_loader .L';
    var detail_selecter = '.pop_loader .play-detail';

    $(num_selecter).html(user_array.length);
    $(money_selecter).html(money);
    $(title_selecter).html(title_str);
    $(detail_selecter).html(number_html);


    art.dialog({
        title:'玩法明细',
        content:document.getElementById('popup_form'),
        drag:true,
        width:'659',
        ok:function(){
        }
    });

}

