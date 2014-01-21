/**
 * 报表js
 *
 * Created by kevin on 14-1-20.
 */


function in_children(key, obj) {
    for (var tmp in obj.children) {
        if (tmp.hasOwnProperty('title') &&
            key == tmp.title) {
            return tmp;
        }
    }
    return null;
}
var Report = Object();
Report.tree = undefined;
Report.top = undefined;

Report.View = function(data) {
    this.data = data;
    this.creatHtml = function(){

    };
};




Report.TotalView = function(data,cid) {
    Report.View.call(this,data);
    this.cid = cid;
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

        var html = '<tr>';



    this.creatHtml = function(){
        if (role === 'zhudan') {
            var caption = createCaption(cid);
            var rows = '';
            for (var i=0;i<total_array.length;i++) {
                var tmp = in_children(total_array[i],this.data.children);
                rows += '<tr>';
                rows += '<td>'+ (i+1) +'</td>';//序号;
                rows += '<td>'+ total_array[i] + '</td>'
                rows += '<td>'+  + '</td>'

                rows +='</tr>';
            }
        }
        if (role === 'uer') {

        }

    }
};
Report.Factory = {
    CreateView:function(data) {
        if (data.property == 'total') {
            return new Report.TotalView(data);
        }
    }
};

var rank_name_array = {
    1:'分公司',
    2:'股东',
    3:'总代理',
    4:'代理',
    5:'会员'
}

function createfront(cid) {
    var ret = '';
    switch (cid) {
        case 4:
            ret += '<td>会员奖金</td><td>会员佣金</td><td>会员盈亏</td>';
            break;
        default:
            var prev_rank = rank_name_array[cid-1];
            var next_rank = rank_name_array[cid+1];
            ret += '<td>'+next_rank+'金额</td>';
            ret += '<td>'+next_rank+'佣金</td>';
            ret += '<td>'+next_rank+'上缴</td>';
    }
    return ret;
}
function createmid(cid) {

}
function createend(cid) {

}

function createCaption(cid) {
    var caption = '<tr>';
    caption +=  '<th>序号</th>\
    <th>玩法</th>\
    <th>注数</th>\
    <th>下注金额</th>';

    caption += createfront(cid);
    caption += createmid(cid);
    caption += createend(cid);

    caption +='</tr>';
}



function set_html(html_code)
{

}


function report_start(json_str)
{
    Report.tree = JSON.parse(json_str);
    console.log('tree');
    console.log(Report.tree);

    //初始化current指针
    Report.current = Report.tree;
    Report.top = Report.current;

    var view = Report.Factory.CreateView(Report.current);

    set_html(view.creatHtml());

}

