<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $Users;
$lock_6 = false;
if (isset($Users[0]['g_lock_6'])) {
    $lock_6 = true;
    if ($Users[0]['g_lock_6'] != 1)
        exit(back('您的權限不足！'));
}
$userModel = new UserModel();
$all_count = $userModel->Get_all_count(3); //获取所有阶层的个数
$son_count = $db->query("SELECT g_id, g_s_name, g_s_f_name,g_s_date, g_lock, g_out FROM
	g_relation_user WHERE g_s_nid = '{$Users[0]['g_nid']}' AND {$sName} g_s_login_id = '{$Users[0]['g_login_id']}'
	ORDER BY g_s_date DESC", 3);
//获取子账号个数

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
} else {
    //默认先显示会员
    $cid = 5;
}
$left_html =
    '<div dom="left" class="sidebar" style="display: block;">
        <div id="account_nav">
            <div class="box account_nav"><h3 class="blue-title"><span>账号管理</span><em>数量</em></h3>
                <ul id="nav" class="left_nav">';
$left_html .= '<li level="0" class="on" onclick="Actfor_load(\'AccountSon_List.php\')">管理员<em id="accounts0">' . $son_count . '</em></li>';

if ($LoginId == 89 || $LoginId == 56) {
    $left_html .= '<li level="1"  onclick="Actfor_load(\'Actfor.php?cid=1\')">分公司<em id="accounts0">' . $all_count[1] . '</em></li>';
}
if ($LoginId == 89 || $LoginId == 56) {
    $left_html .= ' <li level="2" onclick="Actfor_load(\'Actfor.php?cid=2\')">股东<em id="accounts2">' . $all_count[2] . '</em></li> ';
}
if ($LoginId == 89 || $LoginId == 56 || $LoginId == 22) {
    $left_html .= ' <li level="3"  onclick="Actfor_load(\'Actfor.php?cid=3\')">总代理<em id="accounts3">' . $all_count[3] . '</em></li> ';
}
if ($LoginId == 89 || $LoginId == 56 || $LoginId == 22 || $LoginId == 78) {
    $left_html .= '<li level="4" class="" onclick="Actfor_load(\'Actfor.php?cid=4\')">代理<em id="accounts4">' . $all_count[4] . '</em></li>';
}
$left_html .= '<li level="5"  onclick="Actfor_load(\'Actfor.php?cid=5\')">会员<em id="accounts5">' . $all_count[5] . '</em></li>';
$left_html .= '  </ul>
            <div class="accounts">在线会员数：<span id="num0">0</span><br>最高在线会员数：<span id="num1">0</span><br>在线经销商：<span
                    id="num2">1</span><br>最高在线经销商：<span id="num3">1</span><br></div>
        </div>
    </div>
</div>';

$db = new DB();
if (isset($_GET['del'])) {
    if ($db->query("SELECT g_id FROM g_relation_user LIMIT 1", 0)) {
        $db->query("DELETE FROM g_relation_user WHERE g_id = {$_GET['del']} LIMIT 1", 2);
        exit(alert_href('刪除成功', 'AccountSon_List.php'));
    } else {
        exit(alert_href('用戶不存在！', 'AccountSon_List.php'));
    }
} else {
    $sName = $lock_6 ? " g_s_name <> '{$Users[0]['g_s_name']}' AND g_sh_id = '{$Users[0]['g_sh_id']}' AND " : null;
    $result = $db->query("SELECT g_id, g_s_name, g_s_f_name,g_s_date, g_lock, g_out FROM
	g_relation_user WHERE g_s_nid = '{$Users[0]['g_nid']}' AND {$sName} g_s_login_id = '{$Users[0]['g_login_id']}' 
	ORDER BY g_s_date DESC", 1);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>

    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/Search.js"></script>
    <script type="text/javascript" src="/wjl_tmp/artDialog/jquery.artDialog.min.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/artDialog/skins/chrome.css"/>
    <title></title>
    <script type="text/javascript">
        <!--
        function deluser(id) {
            if (confirm("確定刪除嗎？")) {
                location.href = location.href + "?del=" + id;
            }
        }


        function locationFile(strInt) {
            _sType = strInt;
            var oddsPop = $("#oddsPops" + _sType);
            var offsetTop = event.y;
            var offsetLeft = event.x - 135;
            oddsPop.slideDown(200).css({top: offsetTop, left: offsetLeft, "display": ""});
        }

        function diplaydiv(strInt) {
            _sType = strInt;
            var oddsPop = $("#oddsPops" + _sType);
            oddsPop.slideDown(200).css({"display": "none"});
        }


        function changeAjax(type, uid, utype, utNum) {
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
                success: function (data) {
                    //	if(data==1){
                    //	alert("金额还原成功!");
                    //	}else{
                    //	alert("金额还原失败!");
                    //}
                    var utb = $("#ut" + utNum);
                    utb.val(data);
                    _sType = utNum;
                    var oddsPop = $("#oddsPops" + _sType);
                    oddsPop.slideDown(200).css({"display": "none"});
                }
            });
        }
        $(document).ready(function () {

            var win_height = window.innerHeight;
            $("#layout").css('height',win_height+'px');
            $("#add").click(function(){
                $('#rightLoader').hide();
                $('#new_add').show();
            })
        });
        -->
    </script>
</head>
<body>
<div id="layout" class="container" style=" height:284px">

    <?php echo $left_html ?>
    <div id="rightLoader" class="main-content bet-content">

        <div id='memberList' class='page'>
            <div class='title'><span name='account_name'>管理员</span><span class='hidden'
                                                                                            id='superior'>&nbsp;&nbsp;上级<select
                        id='superior_se'>
                        <option value=''>全部</option>
                    </select>
    </span><select id='status' onchange="GoSearch('Estate',this)">
                    <option value='0'
                        <?php if ($Estate == null || $Estate == 0) { ?>
                            selected="selected"
                        <? } ?>
                        >全部
                    </option>
                    <option value='3'
                        <?php if ($Estate == 3) { ?>
                            selected="selected"
                        <? } ?>
                        >停用
                    </option>
                    <option value='2'
                        <?php if ($Estate == 2) { ?>
                            selected="selected"
                        <? } ?>
                        >停押
                    </option>
                    <option value='1'
                        <?php if ($Estate == 1) { ?>
                            selected="selected"
                        <? } ?>
                        >启用
                    </option>
                    <!--<option value='3'>禁止登录</option>-->
                </select>

                <input maxlength='16' type='text' value='' id='se_con'><a href='javascript:void(0)' id='search'
                                                                          onclick="GoSearch('search_name','')"
                                                                          class='mag-btn1'>查询</a>
                <!--<?php if ($cid == 5) { ?>
            onclick="show_Rank()"
        <?php } else { ?>
            href='/Manage/temp/Account_Edit.php?aid=add&cid=<?php echo $cid ?>&sid=1'
        <?php } ?>-->
                <a id='add' class='mag-btn1 mag-btn2' href="AccountSon_Add.php">新增</a>
                <a href="javascript:void(0)" id="del" class="mag-btn1 mag-btn2" style="display: inline-block;">删除</a>
                <a href='javascript:void(0)'
                   id='del'
                   class='mag-btn1 mag-btn2'
                   style='display: none;'>删除</a><a
                    href='javascript:void(0)' id='list_back' style='display:none' class='mag-btn1 mag-btn2'>返回</a></div>
            <ul class='pager' pager='true'>
                <li class='first' id='first'></li>
                <li class='previous' id='previous'></li>
                <li class='other'>第<input id='current_page' type='text' value='1'>页</li>
                <li class='other t-pager'>共<span id='total_page'>1</span>页</li>
                <li class='next' id='next'></li>
                <li class='last' id='last'></li>
            </ul>
            <table class="clear-table mag-list" id="memeber_tb">
                <thead>
                <tr>
                    <th><input type="checkbox" id="all_sel"></th>
                    <th>在线</th>
                    <th>管理员名称</th>
                    <th>管理员账号</th>
                    <th>新增日期</th>
                    <th>最后上线时间</th>
                    <th>权限</th>
                    <th>状态</th>
                    <th>功能</th>
                </tr>
                </thead>
                <tbody id="accounts_tb">
                <?php if ($result) {
                    for ($i = 0; $i < count($result); $i++) {
                        ?>
                        <tr id="852" account="ad888" class="">
                            <td></td>
                            <td id="852_isonline"
                                <?php
                                if ($result[$i]['g_out'] == 1) {
                                    echo 'class="offline"';
                                } else {
                                    echo 'class="online"';
                                }
                                ?>
                                title="最后一次登录IP：*"></td>
                            <td class="t-l"><span class="bluer bold"><?php echo $result[$i]['g_s_name'] ?></span></td>
                            <td><?php echo $result[$i]['g_s_f_name'] ?></td>
                            <td><?php echo $result[$i]['g_s_date'] ?></td>
                            <td><?php echo $result[$i]['g_s_date'] ?></td>
                            <td>管理员</td>
                            <td name="cur_status" ct="1" delst="1">
                                <?php if ($result[$i]['g_lock'] == 1) echo '启用';
                                if ($result[$i]['g_lock'] == 2) echo '停押';
                                if ($result[$i]['g_lock'] == 3) echo '停用';?>
                            </td>
                            <td class="op">
                                <a status="0" href="javascript:void(0)">停用</a>/
                                <a status="2" href="javascript:void(0)">停押</a>/
                                <a href="AccountSon_Up.php?uid=<?php echo $result[$i]['g_id']?>" edit="852">修改</a>/
                                <a account_name="ad888" log="852" href="LoginLog.php?uid=<?php echo$result[$i]['g_s_name']?>&cid=0">日志</a>/
                                <a account_name="ad888" record="852" href="LoginLog.php?uid=<?php echo$result[$i]['g_s_name']?>&cid=0">记录</a>
                            </td>
                        </tr>
                    <?php
                    }
                    // for end
                }//if end
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>