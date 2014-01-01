/**
 * Created by 2b on 13-12-23.
 * 球号分配表
 */
var Global = new Object();
Global.popup_window = null;

$(document).ready(function(){
    var button_selecter = '#ball_btn';

    $('.pk-ball').click(function(){
        var show = $(this).attr('id');
        var hide = show=='max'?'min':'max';

        $('.'+ show).show();
        $('.' + hide).hide();

        $('.ball-on').removeClass('ball-on');
        $(this).addClass('ball-on');
    });

    $(button_selecter).click(function(){
        var time_selecter = '#dateName';
        var start_date;
        var end_date;
        var type;
        var count;
        var call_back;

        start_date = $(time_selecter).val();
        end_date = $(time_selecter).val();
        $('#start_date_klc').val(start_date);
        $('#end_date_klc').val(end_date);

        type = $('#rusult_md_cs').val();
        count = 0;
        switch (type) {
            case "1":
                call_back = fen_pei_klc_set_data;
                break;
            case "2":
                call_back = fen_pei_ssc_set_data;
                break;
            case "6":
                call_back = fen_pei_pk_set_data;
                break;
            case "5":
                call_back = fen_pei_klc_set_data;
                break;
            case "9":
                call_back = fen_pei_ssc_set_data;
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
        count = $('.pop-border .ball-list .list_row').length;
        switch (type) {
            case "1":
                call_back = fen_pei_klc_set_data;
                break;
            case "2":
                call_back = fen_pei_ssc_set_data;
                break;
            case "6":
                call_back = fen_pei_pk_set_data;
                break;
            case "5":
                call_back = fen_pei_klc_set_data;
                break;
            case "9":
                call_back = fen_pei_ssc_set_data;
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
        count = 0;
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
                call_back = fen_pei_ssc_set_data;
                break;
            case "6":
                call_back = fen_pei_pk_set_data;
                break;
            case "5":
                call_back = fen_pei_klc_set_data;
                break;
            case "9":
                call_back = fen_pei_ssc_set_data;
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
function fen_pei_pk_set_data(data) {
    console.log(data);
    var type_id = data['type'];
    data = data['ret_array'];
    var title_html = '';
    var body_html = '';
    const span_count = 5;
    var extra_class = 'ball-list-ssc';
    title_html = '<table class="dataArea t1 ball-list-ssc"> \
                <thead> \
                <tr class="pk-b min"><th class="ball-1">期数</th><th class="ball-2">日期</th><th>冠军</th><th>亚军</th><th>第三名</th><th>第四名</th><th>第五名</th></tr> \
            <tr class="pk-b max" style="display: hidden"><th class="ball-1">期数</th><th class="ball-2">日期</th><th>第六名</th><th>第七名</th><th>第八名</th><th>第九名</th><th>第十名</th></tr> \
            <tr class="ball-th"> \
                <th class="ball-list-ssc-th-hack "></th> \
                <th></th> \
                <th> \
                <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
            </th> \
                <th> \
                <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
            </th> \
                <th> \
                <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
            </th> \
                <th> \
                <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
            </th> \
                <th> \
                <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
            </th> \
            </tr> \
            </thead> \
            </table>';
    $('#popup_form #pk_toggle').show();

    if (data) {
        for (var i=0; i < data.length; i++) {
            var qishu = data[i]['qishu'];
            var date = data[i]['date'];
            var ball = data[i]['balls'];
            var ball_array = new Array();
            //前五
            body_html += '<ul class="pk1to5 list_row min">';
            body_html += '<li class="ball-1">'+qishu+'</li>';
            body_html += '<li class="ball-2">'+date+'</li>' ;

            ball_array = ball.split(',');

            for (var j=0; j < 5; j++) {

                body_html += '<li>';

                for(var z=0; z <ball_array.length; z++) {

                    if ( z+1 != ball_array[j]) {
                        body_html += '<span></span>';
                    } else {
                        if (type_id == 9) {
                            body_html += '<span class="number num'+ ball_array[j] + '</span>';
                        } else {
                            body_html += '<span class="bc">' + ball_array[j] + '</span>';
                        }
                    }
                }
                body_html +='</li>';
            }
            body_html += '</ul>';

            //后五
            body_html += '<ul class="pk1to5 max" style="display: none">';
            body_html += '<li class="ball-1">'+qishu+'</li>';
            body_html += '<li class="ball-2">'+date+'</li>' ;

            ball_array = ball.split(',');

            for (var j=span_count; j < 10; j++) {

                body_html += '<li>';

                for(var z=0; z <ball_array.length; z++) {

                    if ( z+1 != ball_array[j]) {
                        body_html += '<span></span>';
                    } else {
                        if (type_id == 9) {
                            body_html += '<span class="number num'+ ball_array[j] + '</span>';
                        } else {
                            body_html += '<span class="bc">' + ball_array[j] + '</span>';
                        }
                    }
                }
                body_html +='</li>';
            }
            body_html += '</ul>';
        }
    }

    $('#popup_form .ball-list').addClass(extra_class);
    fen_pei_show_popup(title_html,body_html);
}
function fen_pei_ssc_set_data(data)
{
    console.log(data);
    var type_id = data['type'];
    data = data['ret_array'];
    var title_html = '';
    var body_html = '';
    var span_count = 0;
    var extra_class = '';
    if (type_id == 2) {
        title_html = '<table class="dataArea t1 ball-list-ssc"><thead><tr><th class="ball-1">期数</th><th class="ball-2">日期</th><th>第一球</th><th>第二球</th><th>第三球</th><th>第四球</th><th>第五球</th></tr><tr class="ball-th"><th class="ball-list-ssc-th-hack "></th><th></th><th><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span></th><th><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span></th><th><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span></th><th><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span></th><th><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span></th></tr></thead></table>'
        extra_class = 'ball-list-ssc';
        span_count = 10;
    } else if (type_id == 9) {
        title_html = '<table class="dataArea t1 ball-list-ssc"><thead><tr class="ks-b min"><th class="ball-1">期数</th><th class="ball-2">日期</th><th colspan="3">开出骰子</th></tr><tr class="ball-th"><th class="ball-list-ssc-th-hack "></th><th></th><th><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span></th><th><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span></th><th><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span></th></tr></thead></table>';
        span_count = 6;
        extra_class = 'ball-list-ssc';
        $('#ball_klc').attr('class', 'ks');
    } else if (type_id = 6) {
        title_html = '<table class="dataArea t1 ball-list-ssc"> \
                    <thead> \
                    <tr class="pk-b min"><th class="ball-1">期数</th><th class="ball-2">日期</th><th>冠军</th><th>亚军</th><th>第三名</th><th>第四名</th><th>第五名</th></tr> \
                <tr class="pk-b max"><th class="ball-1">期数</th><th class="ball-2">日期</th><th>第六名</th><th>第七名</th><th>第八名</th><th>第九名</th><th>第十名</th></tr> \
                <tr class="ball-th"> \
                    <th class="ball-list-ssc-th-hack "></th> \
                    <th></th> \
                    <th> \
                    <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
                </th> \
                    <th> \
                    <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
                </th> \
                    <th> \
                    <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
                </th> \
                    <th> \
                    <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
                </th> \
                    <th> \
                    <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span> \
                </th> \
                </tr> \
                </thead> \
                </table>';
        $('#popup_form #pk_toggle').show();
    }

    if (data) {
        for (var i=0; i < data.length; i++) {
            var qishu = data[i]['qishu'].substr(-3);
            var date = data[i]['date'];
            var ball = data[i]['balls'];
            var ball_array = new Array();
            body_html += '<ul class="pk1to5 list_row">';
            body_html += '<li class="ball-1">'+qishu+'</li>';
            body_html += '<li class="ball-2">'+date+'</li>' ;

            ball_array = ball.split(',');

            for (var j=0; j < ball_array.length; j++) {

                body_html += '<li>';

                for(var z=0; z <span_count; z++) {

                    if ( z != ball_array[j]) {
                        body_html += '<span></span>';
                    } else {
                        if (type_id == 9) {
                            body_html += '<span class="number num'+ ball_array[j] + '</span>';
                        } else {
                            body_html += '<span class="bc">' + ball_array[j] + '</span>';
                        }
                    }
                }
                body_html +='</li>';
            }
            body_html += '</ul>';
        }
    }
    $('#popup_form .ball-list').addClass(extra_class);

    fen_pei_show_popup(title_html,body_html);
}

function fen_pei_klc_set_data(data)
{
    /*数据格式：
     * 0.qishu 1.开出的球号："1,2,3" 3.表格中的结果集*/

    console.log(data);
    var type_id = data['type'];
    data = data['ret_array'];
    var title_html ='';
    if (type_id == 1) {
        title_html = ' <li class="ball-1">期数</li> \
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
        $('#ball_klc').attr('class','');
    } else {
        title_html = ' <li class="ball-1">期数</li> \
            <li class="ball-2">开奖号码</li> \
            <li><span class="number num1"></span></li> \
            <li><span class="number num2"></span></li> \
            <li><span class="number num3"></span></li> \
            <li><span class="number num4"></span></li> \
            <li><span class="number num5"></span></li> \
            <li><span class="number num6"></span></li> \
            <li><span class="number num7"></span></li> \
            <li><span class="number num8"></span></li> \
            <li><span class="number num9"></span></li> \
            <li><span class="number num10"></span></li> \
            <li><span class="number num11"></span></li> \
            <li><span class="number num12"></span></li> \
            <li><span class="number num13"></span></li> \
            <li><span class="number num14"></span></li> \
            <li><span class="number num15"></span></li> \
            <li><span class="number num16"></span></li> \
            <li><span class="number num17"></span></li> \
            <li><span class="number num18"></span></li> \
            <li><span class="number num19"></span></li> \
            <li><span class="number num20"></span></li> ';
        $('#ball_klc').attr('class','nc');
    }
    var body_html = '';

    if (data) {
        for (var i=0; i < data.length; i++) {
            var qishu = data[i]['qishu'];
            var ball = data[i]['balls'];
            var result = data[i]['result_array'];
            var class_name = type_id==1?"number num":"snumber snum";

            body_html += '<ul class="list_row">';

            body_html += '<li class="ball-1">' + qishu + "</li>";
            if (type_id == 5) {
                ball = ball.split(',');
                console.log(ball);
                body_html += '<li class="ball-2">';
                for (var z=0;z<ball.length;z++) {
                    body_html += '<span class="'+ class_name + ball[z] + '"></span>';
                }
                body_html += '</li>';
            } else {
                //球号分配表 广东快乐十分19，20球需要标红色
                var ball_array = ball.split(',');
                for (var x=0;x<ball_array.length; i++) {
                    if (ball_array[x] >= 19) {
                        ball_array[x] = '<span class="red">' + ball_array[x] + '</span>';
                    }
                }
                ball = ball_array.join(',');
                body_html += '<li class="ball-2">' + ball + "</li>";
            }

            for (var j=0; j < result.length; j++) {
                if (result[j] == "-1" ) {
                    body_html += '<li><span class="' + class_name + (j+1) + '"></span></li>';
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

