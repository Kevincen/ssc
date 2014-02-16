/**
 * Created by kevin on 14-1-22.
 */


var UserView = function (data) {
    this.cid = data.cid==0?4:data.cid;
    this.data = data;
}.
    inherits(FLZSubView).
    method('showCaptionHead',function () {
        var cid = this.cid;
        var down_name = rank_name_array[cid + 1];
        var html = '<th>序号</th> <th>' + down_name + '</th> <th>名称</th> <th>注数</th> <th>下注金额</th>';
        return html;

    }).
    method('showContent', function () {
        var cid = this.cid;
        var data = this.data;
        var html = '';
        var children = data.children;

        for (i = 0; i < children.length; i++) {
            var child = children[i];
            var name = child.my_name;
            var account = child.my_account_id;
            var zhudan = child.zhudan.data;

            var account_html = wrap_elem('a', account, 'onclick="sub_click($(this))" index="' + i + '"');
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
            html += wrap_elem('td', account_html);
            html += wrap_elem('td', name);
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

        if (children.length == 0) {
            html += '<tr ><td colspan="15" class="center">暂无数据</td></tr>';
        }
        html = wrap_elem('tbody', html);
        return html;
    });