/**
 * Created by kevin on 14-1-20.
 */

Function.prototype.method = function (name, func) {
    this.prototype[name] = func;
    return this;
};

Function.method('inherits', function (Parent) {
    this.prototype = new Parent();
    return this;
});


if (typeof Object.beget !== 'function') {
    Object.beget = function (o) {
        var F = function () {
        };
        F.prototype = o;
        return new F();
    }
}
Object.method('superior', function (name) {
    var that = this,
        method = that[name];
    return function () {
        return method.apply(that, arguments);
    };
});


var rank_name_array = {
    0: '后台',
    1: '分公司',
    2: '股东',
    3: '总代',
    4: '代理',
    5: '会员'
};
var total_array = new Array(
    '[广东快乐十分]第一球',
    '[广东快乐十分]第二球',
    '[广东快乐十分]第三球',
    '[广东快乐十分]第四球',
    '[广东快乐十分]第五球',
    '[广东快乐十分]第六球',
    '[广东快乐十分]第七球',
    '[广东快乐十分]第八球',
    '[广东快乐十分]1~8 单双',
    '[广东快乐十分]1~8 大小',
    '[广东快乐十分]1~8 尾大尾小',
    '[广东快乐十分]1~8 合数单双',
    '[广东快乐十分]总和单双',
    '[广东快乐十分]总和大小',
    '[广东快乐十分]总和尾大尾小',
    '[广东快乐十分]1~8 中发白',
    '[广东快乐十分]1~8 方位',
    '[广东快乐十分]1~4 龙虎',
    '[广东快乐十分]任选二',
    '[广东快乐十分]选二连组',
    '[广东快乐十分]任选三',
    '[广东快乐十分]选三前组',
    '[广东快乐十分]任选四',
    '[广东快乐十分]任选五',
    '[广东快乐十分]正码',
    '[幸运农场]第一球',
    '[幸运农场]第二球',
    '[幸运农场]第三球',
    '[幸运农场]第四球',
    '[幸运农场]第五球',
    '[幸运农场]第六球',
    '[幸运农场]第七球',
    '[幸运农场]第八球',
    '[幸运农场]1~8 单双',
    '[幸运农场]1~8 大小',
    '[幸运农场]1~8 尾大尾小',
    '[幸运农场]1~8 合数单双',
    '[幸运农场]总和单双',
    '[幸运农场]总和大小',
    '[幸运农场]总和尾大尾小',
    '[幸运农场]1~8 中发白',
    '[幸运农场]1~8 东南西北',
    '[幸运农场]1~4 龙虎',
    '[幸运农场]任选二',
    '[幸运农场]选二连组',
    '[幸运农场]选二连直',
    '[幸运农场]任选三',
    '[幸运农场]任选四',
    '[幸运农场]任选五',
    '[幸运农场]正码',
    '[幸运农场]选三前组',
    '[北京赛车]冠军',
    '[北京赛车]亚军',
    '[北京赛车]第三名',
    '[北京赛车]第四名',
    '[北京赛车]第五名',
    '[北京赛车]第六名',
    '[北京赛车]第七名',
    '[北京赛车]第八名',
    '[北京赛车]第九名',
    '[北京赛车]第十名',
    '[北京赛车]大小',
    '[北京赛车]单双',
    '[北京赛车]龙虎',
    '[北京赛车]冠亚大小',
    '[北京赛车]冠亚单双',
    '[北京赛车]冠亚和',
    '[重庆时时彩]单码',
    '[重庆时时彩]两面',
    '[重庆时时彩]龙虎',
    '[重庆时时彩]和',
    '[重庆时时彩]豹子',
    '[重庆时时彩]顺子',
    '[重庆时时彩]对子',
    '[重庆时时彩]半顺',
    '[重庆时时彩]杂六',
    '[江苏骰宝]大小',
    '[江苏骰宝]三军',
    '[江苏骰宝]围骰',
    '[江苏骰宝]全骰',
    '[江苏骰宝]点数',
    '[江苏骰宝]长牌',
    '[江苏骰宝]短牌'
);

var View = function () {

}.
    method('show',function () {
        var html = '<table class="bet-table z3-table"> ';

        html += '<thead><tr>';
        html += this.showCaption();
        html += '</tr></thead>'


        html += this.showContent();

        html += '</table>';
        return html;
    }).
    method('showCaption',function () {
        var html = '';
        html += this.showCaptionHead();
        html += this.showCaptionBody();
        return html;
    }).
    method('showContent',function () {
        console.log("SHOWCONTENT");
        return '';

    }).
    method('showCaptionHead',function () {

        console.log("SHOWCaphead");
        return '';
    }).
    method('showCaptionBody', function () {

        console.log("SHOWCapbody");
        return '';
    });

var FLZView = function () {
}.
    inherits(View).
    method('showContent', function () {
        console.log("SHOWFLZCapbody");
        return '';
    });


var FLZTotalView = function (cid, data) {
    this.cid = cid;
    this.data = data;
}.
    inherits(FLZView).
    method('showCaptionHead',function () {
        var html = '<th>序号</th> <th>玩法</th> <th>注数</th> <th>下注金额</th>';
        if (this.data.property == 'detail') {
            html = '<th>序号</th> <th>球号</th> <th>注数</th> <th>下注金额</th>'
        }
        return html;

    }).
    method('showCaptionBody',function () {
        var cid = this.cid;
        console.log('cid=' + cid);
        var html = '';
        var prev_rank = rank_name_array[cid - 1];
        var next_rank = rank_name_array[cid + 1];
        var current_rank = rank_name_array[cid];
        switch (cid) {
            case 4:
                html += '<th>会员奖金</th><th>会员佣金</th><th>会员盈亏</th>';
                break;
            default:
                html += '<th>会员盈亏</th>';
                html += '<th>占成上缴</th>';
                html += '<th class="sh1">' + next_rank + '金额</th>';
                html += '<th class="sh1">' + next_rank + '佣金</th>';
                html += '<th class="hc" id="sh1">' + next_rank + '上缴</th>';

        }
        html += wrap_elem('th', '占成%');
        html += '<th>本级占成</th>';
        html += '<th class="sh2">' + current_rank + '奖金</th>';
        html += '<th class="sh2">佣金</th>';
        html += '<th>佣金差</th>';
        html += wrap_elem('th', current_rank + '盈亏', 'class="hc" id="sh2"');

        html += '<th>上级占成</th>';
        html += '<th class="sh3">' + prev_rank + '金额</th>';
        html += '<th class="sh3">' + prev_rank + '佣金</th>';
        html += '<th class="hc" id="sh3">' + prev_rank + '上缴</th>';
        return html;
    }).
    method('showContent', function () {
        var cid = this.cid;
        var data = this.data;
        var html = '';

        if (data.children.length == 0) {
            html = '<tr class=""><td colspan="15" class="center">暂无数据</td></tr>';
        } else {
            for (i = 0; i < total_array.length; i++) {
                var title = total_array[i];

                var child_index = in_array(data.children, 'title', total_array[i]);

                if (child_index !== -1) {
                    var child = data.children[child_index];
                    var zhudan = child.zhudan.data;
                    title = wrap_elem('a', child.title, 'onclick="sub_click($(this))" index="' + child_index + '"');
                    var zhue = parseInt(zhudan.zhue)
                        , zhushu = parseInt(zhudan.zhushu)
                        , down_jiangjin = parseInt(zhudan[cid + 1].jiangjin)
                        , down_yongjin = 0
                        , down_yingkui = parseInt(zhudan[cid + 1].yingkui)
                        , huiyuan_yingkui = parseInt(zhudan[5].yingkui)
                        , zhanchengshangjiao = 0
                        , down_jine = 0
                        , down_shangjiao = 0

                        , my_dis = parseInt(zhudan[cid].dis)
                        , my_dis_money = parseInt(zhudan[cid].dis_money)
                        , my_jiangjin = parseInt(zhudan[cid].jiangjin)
                        , my_yongjin = parseInt(zhudan[cid].yongjin)
                        , my_yongjincha = parseInt(zhudan[cid].yongjincha)
                        , my_yingkui = parseInt(zhudan[cid].yingkui)

                        , up_zhancheng = parseInt(zhudan[cid].up_dis_money)
                        , up_jine = parseInt(zhudan[cid].up_jine)
                        , up_yongjin = parseInt(parseInt(zhudan[cid].up_yongjin))
                        , shangjiaoshangji = parseInt(zhudan[cid].up_all);
                    if (cid == 4) {
                        down_yongjin = parseInt(zhudan[cid + 1].yongjin)
                    } else {
                        down_yongjin = 0;
                    }
                    /*                  var zhue = (zhudan.zhue)
                     , zhushu = (zhudan.zhushu)
                     , down_jiangjin = (zhudan[cid + 1].jiangjin)
                     , down_yongjin = 0
                     , down_yingkui = (zhudan[cid + 1].yingkui)
                     , huiyuan_yingkui = (zhudan[5].yingkui)
                     , zhanchengshangjiao = 0
                     , down_jine = 0
                     , down_shangjiao = 0

                     , my_dis = (zhudan[cid].dis)
                     , my_dis_money = (zhudan[cid].dis_money)
                     , my_jiangjin = (zhudan[cid].jiangjin)
                     , my_yongjin = (zhudan[cid].yongjin)
                     , my_yongjincha = (zhudan[cid].yongjincha)
                     , my_yingkui = (zhudan[cid].yingkui)

                     , up_zhancheng = (zhudan[cid].up_dis_money)
                     , up_jine = (zhudan[cid].up_jine)
                     , up_yongjin = ((zhudan[cid].up_yongjin))
                     , shangjiaoshangji = (zhudan[cid].up_all);
                     if (cid == 4) {
                     down_yongjin = (zhudan[cid + 1].yongjin)
                     } else {
                     down_yongjin = 0;
                     }*/

                } else {
                    zhue = 0;
                    zhushu = 0;
                    down_jiangjin = 0;
                    down_yongjin = 0;
                    down_yingkui = 0;
                    huiyuan_yingkui = 0;
                    zhanchengshangjiao = 0;
                    down_jine = 0;
                    down_shangjiao = 0;

                    my_dis = 0;
                    my_dis_money = 0;
                    my_jiangjin = 0;
                    my_yongjin = 0;
                    my_yongjincha = 0;
                    my_yingkui = 0;

                    up_zhancheng = 0;
                    up_jine = 0;
                    up_yongjin = 0;
                    shangjiaoshangji = 0;
                }
                html += '<tr>';

                html += wrap_elem('td', i + 1);
                html += wrap_elem('td', title);
                html += wrap_elem('td', xng(zhushu));
                html += wrap_elem('td', xng(zhue));

                if (cid == 4) {
                    html += wrap_elem('td', xng(down_jiangjin));
                    html += wrap_elem('td', xng(down_yongjin));
                    html += wrap_elem('td', xng(down_yingkui));
                } else {
                    html += wrap_elem('td', xng(huiyuan_yingkui));//盈亏
                    html += wrap_elem('td', xng(zhanchengshangjiao));//占城上缴
                    html += wrap_elem('td', xng(down_jine), 'class="sh1"');//下级金额
                    html += wrap_elem('td', xng(down_yongjin), 'class="sh1"');//下级佣金
                    html += wrap_elem('td', xng(down_shangjiao), 'class="col1"');//下级上缴
                }
                html += wrap_elem('td', xng(my_dis));//占城%
                html += wrap_elem('td', xng(my_dis_money));//本级占城
                html += wrap_elem('td', xng(my_jiangjin), 'class="sh2"');//本级奖金
                html += wrap_elem('td', xng(my_yongjin), 'class="sh2"');//本级佣金
                html += wrap_elem('td', xng(my_yongjincha));//佣金差
                html += wrap_elem('td', xng(my_yingkui), 'class="col1"');//本级盈亏

                html += wrap_elem('td', xng(up_zhancheng));//上级占城
                html += wrap_elem('td', xng(up_jine), 'class="sh3"');//金额
                html += wrap_elem('td', xng(up_yongjin), 'class="sh3"');//佣金
                html += wrap_elem('td', xng(shangjiaoshangji), 'class="col1"');//上缴上级

                html += '</tr>';
            }
        }


        html = wrap_elem('tbody',html);
        return html;
    }).
    method('showTemplate',function(){

    }).
    method('showRows',function(){

    });


var FLZSubView = function (cid, data) {
    this.cid = cid;
    this.data = data;
}.inherits(FLZTotalView)
    .method('showContent', function () {
        var html = '';
        var data = this.data;
        var cid = this.cid;
        for (i = 0; i < data.children.length; i++) {
            var child = data.children[i];
            var zhudan = child.zhudan.data;
            title = wrap_elem('a', child.title, 'onclick="sub_click($(this))" index="' + i + '"');

            var zhue = parseInt(zhudan.zhue)
                , zhushu = parseInt(zhudan.zhushu)
                , down_jiangjin = parseInt(zhudan[cid + 1].jiangjin)
                , down_yingkui = parseInt(zhudan[cid + 1].yingkui)
                , huiyuan_yingkui = parseInt(zhudan[5].yingkui)
                , down_yongjin = parseInt(zhudan[cid+1].up_yongjin)
                , zhanchengshangjiao = parseInt(zhudan[cid+1].up_dis_money)
                , down_jine = parseInt(zhudan[cid+1].up_jine)
                , down_shangjiao = parseInt(zhudan[cid+1].up_all)

                , my_dis = parseInt(zhudan[cid].dis)
                , my_dis_money = parseInt(zhudan[cid].dis_money)
                , my_jiangjin = parseInt(zhudan[cid].jiangjin)
                , my_yongjin = parseInt(zhudan[cid].yongjin)
                , my_yongjincha = parseInt(zhudan[cid].yongjincha)
                , my_yingkui = parseInt(zhudan[cid].yingkui)

                , up_zhancheng = parseInt(zhudan[cid].up_dis_money)
                , up_jine = parseInt(zhudan[cid].up_jine)
                , up_yongjin = parseInt(parseInt(zhudan[cid].up_yongjin))
                , shangjiaoshangji = parseInt(zhudan[cid].up_all);

            if (cid == 4) {
                down_yongjin = parseInt(zhudan[cid + 1].yongjin)
            } else {//非代理
                down_yongjin = parseInt(zhudan[cid + 1].up_yongjin);
            }
            html += '<tr>';

            html += wrap_elem('td', i + 1);
            html += wrap_elem('td', title);
            html += wrap_elem('td', xng(zhushu));
            html += wrap_elem('td', xng(zhue));

            if (cid == 4) {
                html += wrap_elem('td', xng(down_jiangjin));
                html += wrap_elem('td', xng(down_yongjin));
                html += wrap_elem('td', xng(down_yingkui));
            } else {
                html += wrap_elem('td', xng(huiyuan_yingkui));//盈亏
                html += wrap_elem('td', xng(zhanchengshangjiao));//占城上缴
                html += wrap_elem('td', xng(down_jine), 'class="sh1"');//下级金额
                html += wrap_elem('td', xng(down_yongjin), 'class="sh1"');//下级佣金
                html += wrap_elem('td', xng(down_shangjiao), 'class="col1"');//下级上缴
            }
            html += wrap_elem('td', xng(my_dis));//占城%
            html += wrap_elem('td', xng(my_dis_money));//本级占城
            html += wrap_elem('td', xng(my_jiangjin), 'class="sh2"');//本级奖金
            html += wrap_elem('td', xng(my_yongjin), 'class="sh2"');//本级佣金
            html += wrap_elem('td', xng(my_yongjincha));//佣金差
            html += wrap_elem('td', xng(my_yingkui), 'class="col1"');//本级盈亏

            html += wrap_elem('td', xng(up_zhancheng));//上级占城
            html += wrap_elem('td', xng(up_jine), 'class="sh3"');//金额
            html += wrap_elem('td', xng(up_yongjin), 'class="sh3"');//佣金
            html += wrap_elem('td', xng(shangjiaoshangji), 'class="col1"');//上缴上级

            html += '</tr>';
        }

        html = wrap_elem('tbody',html);
        return html;
    });

var FLZDetailView = function (cid, data) {
    this.cid = cid;
    this.data = data;//todo:继承此类，在继承类的此处进行数据筛选，增加参数，type
}.
    inherits(FLZTotalView).
    method('showCaption',function () {
        var html = '<th>日期</th> <th>注数</th> <th>金额</th> <th>盈亏</th>';
        return html;
    }).
    method('showContent', function () {
        var html = '';
        var data = this.data;
        var cid = this.cid;
        for (i = 0; i < data.children.length; i++) {
            var child = data.children[i];
            var zhudan = child.zhudan.data;
            title = wrap_elem('a', child.title, 'onclick="sub_click($(this))" index="' + i + '"');

            html += '<tr>';

            //html += wrap_elem('td',i+1);
            html += wrap_elem('td', title);
            html += wrap_elem('td', zhudan.zhushu);
            html += wrap_elem('td', zhudan.zhue);
            html += wrap_elem('td', zhudan[cid].yingkui);

            html += '</tr>';
        }

        html = wrap_elem('tbody',html);
        return html;
    });

var DateView = function (cid, data,type) {
    this.cid = cid;
    this.data = data;
    if (type !== undefined) {
        this.type = type;
    } else {
        this.type = null;
    }
}.inherits(View).
    method('showCaption',function () {
        var cid = this.cid;
        var html = '<th>注单编号</th><th>下注时间</th> <th>期数</th> <th>玩法</th> <th>盘口</th> <th>金额</th> <th>退水</th> <th>结果</th>';
        var zhudan = this.data.children[0].data;

        if (zhudan.is_zhishu == 1) {
            html += wrap_elem('th', rank_name_array[cid]);
        } else {
            for (i = 4; i >= cid; i--) {
                html += wrap_elem('th', rank_name_array[i]);
            }
        }
        if (cid == 1) {//fengongsi yao xianshi zongdai
            html += wrap_elem('th', rank_name_array[0]);
        }

        html += '<th><span class="reder">您的结果</span></th><th>注单状况</th><th>补货</th>';
        return html;
    }).
    method('showContent', function () {
        var cid = this.cid;
        var data = this.data;
        var html = '';

        var children = data.children;
        var sum_jine = 0;
        var sum_my_yingkui = 0;
        var sum_my_tuishui = 0;
        var sum_jieguo = 0;
        var colospan = 0;

        for (i = 0; i < children.length; i++) {
            var child = children[i];
            console.log(child);
            var row = '';
            zhudan = child.data;

            //分类
            if (this.type != null) {
                if (child.type.indexOf(this.type) < 0) {
                    continue;
                }
            }
            colospan = 0;

            if (child.type.indexOf('广东快乐十分') >= 0) {
                zhudan.qishu = zhudan.qishu.substr(-2);
            } else if (child.type.indexOf('重庆时时彩') >= 0) {
                zhudan.qishu = zhudan.qishu.substr(-3);
            } else if (child.type.indexOf('北京赛车') >= 0) {
                zhudan.qishu = zhudan.qishu;
            } else if (child.type.indexOf('幸运农场') >= 0) {
                zhudan.qishu = zhudan.qishu.substr(-2);
            } else if (child.type.indexOf('江苏骰宝') >= 0) {
                zhudan.qishu = zhudan.qishu.substr(-2);
            }

            sum_jine += zhudan.zhue;
            sum_jieguo += zhudan[5].yingkui;
            sum_my_yingkui += zhudan[cid].yingkui;
            sum_my_tuishui += zhudan[cid].tuishui;


/*            row += wrap_elem('td', zhudan.username);*/
            row += wrap_elem('td', wrap_elem('span', zhudan.id, 'class="greener"'));
            row += wrap_elem('td', zhudan.time);
            row += wrap_elem('td', zhudan.qishu);
            row += wrap_elem('td', wrap_elem('span', zhudan.type, 'class="bluer"') + ' @ ' + wrap_elem('span', zhudan.odds, 'class="reder"'));
            row += wrap_elem('td', zhudan.panlu);
            row += wrap_elem('td', zhudan.zhue);
            row += wrap_elem('td', zhudan[5].tuishui_per + '%');
            row += wrap_elem('td', wrap_elem('span',
                zhudan[5].yingkui.toFixed(2),
                'class="win ' + get_color(zhudan[5].yingkui) + '"'));

            var total_dis = 100;
            if (zhudan.is_zhishu == 1) {

                var dis = zhudan[cid].dis;
                var tuishui = zhudan[cid].tuishui_per;
                row += wrap_elem('td', dis + '%</br>' + tuishui + '%');
                total_dis -= dis;
                colospan++;
            } else {
                for (var j = 4; j >= cid; j--) {
                    var dis = zhudan[j].dis;
                    var tuishui = zhudan[j].tuishui_per;
                    total_dis -= dis;
                    row += wrap_elem('td', dis + '%</br>' + tuishui + '%');
                    colospan++;
                }
            }
            if (cid == 1) {//fengongsi yao xianshi zongdai
                row += wrap_elem('td', total_dis + '%</br>' + '0%');
                colospan++;
            }
            row += wrap_elem('td', wrap_elem('span', zhudan[cid].yingkui.toFixed(2), 'class="' + get_color(zhudan[cid].yingkui) + ' win"')
                + '</br>' + wrap_elem('span', (-zhudan[cid].tuishui.toFixed(2)), 'class="win reder"'));
            row += wrap_elem('td', '正常');
            row += wrap_elem('td', 'x');

            html += wrap_elem('tr', row);
        }

        if (html ==  '') {
            html = '<tr class=""><td colspan="30" class="center">暂无数据</td></tr>';
            html = wrap_elem('tbody',html);
        } else {
            html = wrap_elem('tbody',html);
            //总计合计
            var footer= '<tr bg="0">\
                <td colspan="5"><span class="bluer">小计</span></td>\
                <td>' + sum_jine + '</td>\
                <td></td>\
                <td><span class="win">' + sum_jieguo.toFixed(2) + '</span></td>\
                <td colspan="'+colospan+'"></td><td><span class="' + get_color(sum_my_yingkui) + ' win">' + sum_my_yingkui.toFixed(2) + '</span>' +
                '<br><span class="reder win">' + (-sum_my_tuishui).toFixed(2) + '</span></td>\
                    <td></td><td></td>\
                </tr>';

            footer += '<tr bg="0">\
                <td colspan="5"><span class="bluer">总计</span></td>\
                <td>' + sum_jine + '</td>\
                <td></td>\
                <td><span class="win">' + sum_jieguo.toFixed(2) + '</span></td>\
                <td colspan="'+colospan+'"></td><td><span class="' + get_color(sum_my_yingkui) + ' win">' + sum_my_yingkui.toFixed(2) + '</span>' +
                '<br><span class="reder win">' + (-sum_my_tuishui).toFixed(2) + '</span></td>\
                    <td></td><td></td>\
                </tr>'

            html += wrap_elem('tfoot',footer);
        }


        return html;

    });

function get_color(value) {
    var color;
    if (parseInt(value) <= 0) {
        color = 'reder';
    } else {
        color = '';
    }
    return color;
}

function xng(value) {
    return value === undefined ? 0 : value;
}


function wrap_elem(elem_name, text, attr) {
    if (attr === undefined) {
        attr = '';
    }
    return '<' + elem_name + ' ' + attr + '>' + text + '</' + elem_name + '>';
}

function in_array($arr, key, value) {
    for (var i = 0; i < $arr.length; i++) {
        if ($arr[i][key] == value)return i;
    }
    return -1;
}

