/**
 * Created by 2b on 13-12-23.
 * 球号分配表
 */
var Global = new Object();
Global.popup_window = null;

$(document).ready(function(){
    var button_selecter = '#ball_btn';

    $(button_selecter).click(function(){
        var time_selecter = '#dateName';
        var start_date;
        var end_date;
        var type;
        var count;
        var call_back;

        start_date = $(time_selecter).val();
        end_date = $(time_selecter).val();
        $('start_date_klc').val(start_date);
        $('end_date_klc').val(end_date);

        type = $('#rusult_md_cs').val();
        count = 0;
        switch (type) {
            case "1":
                call_back = fen_pei_klc_set_data;
                break;
            case "2":
                break;
            case "6":
                break;
            case "5":
                break;
            case "9":
                break;
        }
        fen_pei_get_data(start_date,end_date,type,count,call_back);
    })
    $("#get_more_klc").click(function(){
        var start_selecter = '#start_date_klc';
        var end_selcter = '#end_date_klc';
        var start_date;
        var end_date;
        var type;
        var count;
        var call_back;

        start_date = $(start_selecter).val();
        end_date = $(end_selcter).val();

        type = $('#rusult_md_cs').val();
        count = $('.pop-border .ball-title .list_row').length;
        switch (type) {
            case "1":
                call_back = fen_pei_klc_set_data;
                break;
            case "2":
                break;
            case "6":
                break;
            case "5":
                break;
            case "9":
                break;
        }
        fen_pei_get_data(start_date,end_date,type,count,call_back);
    })

    $("#s_ball_klc").click(function(){
        var start_selecter = '#start_date_klc';
        var end_selcter = '#end_date_klc';
        var start_date;
        var end_date;
        var type;
        var count;
        var call_back;

        start_date = $(start_selecter).val();
        end_date = $(end_selcter).val();

        type = $('#rusult_md_cs').val();
        count = $('.pop-border .ball-title .list_row').length;
        if (Global.popup_window == null) {
            alert('bug： get more called while popwindow not activated');
            return;
        } else {
            $('.pop-border .ball-list').html('');
        }
        switch (type) {
            case "1":
                call_back = fen_pei_klc_set_data;
                break;
            case "2":
                break;
            case "6":
                break;
            case "5":
                break;
            case "9":
                break;
        }
        fen_pei_get_data(start_date,end_date,type,count,call_back);
    })
});

function fen_pei_get_data(start_date, end_date, type, count, call_back)
{
    var url = "/templates_cn/result.php";
    $.post(url,{start_date:start_date, end_date:end_date,type:type,count:count}
        ,call_back,'json');
}

function fen_pei_klc_set_data(data)
{
    /*数据格式：
    * 0.qishu 1.开出的球号："1,2,3" 3.表格中的结果集*/

    var title_html = ' <li class="ball-1">期数</li> \
        <li class="ball-2">开奖号码</li> \
    <li>01</li> \
    <li>02</li> \
    <li>03</li> \
    <li>04</li> \
    <li>05</li> \
    <li>06</li> \
    <li>07</li> \
    <li>08</li> \
    <li>09</li> \
    <li>10</li> \
    <li>11</li> \
    <li>12</li> \
    <li>13</li> \
    <li>14</li> \
    <li>15</li> \
    <li>16</li> \
    <li>17</li> \
    <li>18</li> \
    <li>19</li> \
    <li>20</li> ';
    var body_html = '';

    if (data) {
        for (var i=0; i < data.length; i++) {
            var qishu = data[i]['qishu'];
            var ball = data[i]['balls'];
            var result = data[i]['result_array'];

            body_html += '<ul class="list_row">';

            body_html += '<li class="ball-1">' + qishu + "</li>";
            body_html += '<li class="ball-2">' + ball + "</li>";

            for (var j=0; j < result.length; j++) {
                if (result[j] == "-1" ) {
                    body_html += '<li><span class="number num' + (j+1) + '"></span></li>';
                } else {
                    body_html += "<li>"+ result[j] + "</li>";
                }
            }


            body_html += '</ul>';
        }
    }
    fen_pei_show_popup(title_html,body_html);

}

function fen_pei_show_popup(title_html, body_html)
{

    if (Global.popup_window == null) {
        $('.pop-border .ball-title').html(title_html);
        $('.pop-border .ball-list').html(body_html);
        Global.popup_window = art.dialog({
                title:'球号分配表',
                content:document.getElementById('popup_form'),
                drag:true,
                width:'1010px',
                ok:function(){
                    $('.pop-border .ball-title').html('');
                    $('.pop-border .ball-list').html('');
                    Global.popup_window.close();
                    Global.popup_window = null;
                    return true;
                }
            });
    } else {
        $('.pop-border .ball-list').append(body_html);
        Global.popup_window.content = document.getElementById('popup_form');
    }
}

