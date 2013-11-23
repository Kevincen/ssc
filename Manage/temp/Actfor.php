<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $Users, $LoginId;
$ConfigModel = configModel("`g_son_member_lock`");
$left_html = '';
//TODO:要获得所有上级
$tmprank = UserModel::GetNextRank(1,89,$Users);
$userModel = new UserModel();
$all_count = $userModel->Get_all_count(3,$Users[0]['g_nid'],$Users[0]['g_login_id']);//TODO:这个获取的是所有人，需要根据当前获取
$son_count = $db->query("SELECT g_id, g_s_name, g_s_f_name,g_s_date, g_lock, g_out FROM
	g_relation_user WHERE g_s_nid = '{$Users[0]['g_nid']}' AND {$sName} g_s_login_id = '{$Users[0]['g_login_id']}'
	ORDER BY g_s_date DESC", 3);//获取子账号个数

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
} else {
    //默认先显示会员
    $cid = 5;
}
$stock_count = 0;
$main_agent_count = 0;
$agent_count = 0;
$memenber_count = 0;
$loginid = $Users[0]['g_login_id'];
if ($loginid == $userModel->cop_id) {
    $stock_count = $all_count[1];
    $main_agent_count = $all_count[2];
    $agent_count = $all_count[3];
    $memenber_count = $all_count[4];
} else if ($loginid == $userModel->stock_id) {
    $main_agent_count = $all_count[1];
    $agent_count = $all_count[2];
    $memenber_count = $all_count[3];
} else if ($loginid == $userModel->maina_id) {
    $agent_count = $all_count[1];
    $memenber_count = $all_count[2];
} else if ($loginid == $userModel->agent_id) {
    $memenber_count = $all_count[1];
} else {
    exit(alert("当前用户登录id错误,请联系管理员"));
}
$left_html =
    '<div dom="left" class="sidebar" style="display: block;">
        <div id="account_nav">
            <div class="box account_nav"><h3 class="blue-title"><span>账号管理</span><em>数量</em></h3>
                <ul id="nav" class="left_nav">';
$left_html .= '<li level="0"  onclick="Actfor_load(\'AccountSon_List.php\')">管理员<em id="accounts0">'. $son_count.'</em></li>';

if ($LoginId == 89 ) {
    $left_html .= '<li level="1"  onclick="Actfor_load(\'Actfor.php?cid=1\')">分公司<em id="accounts0">'. $all_count[0].'</em></li>';
}
if ($LoginId == 89 || $LoginId == 56) {
    $left_html .= ' <li level="2" onclick="Actfor_load(\'Actfor.php?cid=2\')">股东<em id="accounts2">'. $stock_count.'</em></li> ';
}
if ($LoginId == 89 || $LoginId == 56 || $LoginId == 22) {
    $left_html .= ' <li level="3"  onclick="Actfor_load(\'Actfor.php?cid=3\')">总代理<em id="accounts3">'. $main_agent_count.'</em></li> ';
}
if ($LoginId == 89 || $LoginId == 56 || $LoginId == 22 || $LoginId == 78) {
    $left_html .= '<li level="4" class="" onclick="Actfor_load(\'Actfor.php?cid=4\')">代理<em id="accounts4">'. $agent_count.'</em></li>';
}
$left_html .= '<li level="5"  onclick="Actfor_load(\'Actfor.php?cid=5\')">会员<em id="accounts5">'. $memenber_count.'</em></li>';
//TODO:子账号 没有么？
if (!isset($Users[0]['g_lock_6'])) {
}
//TODO:在线人数？
$left_html .= '  </ul>
            <div class="accounts">在线会员数：<span id="num0">0</span><br>最高在线会员数：<span id="num1">0</span><br>在线经销商：<span
                    id="num2">1</span><br>最高在线经销商：<span id="num3">1</span><br></div>
        </div>
    </div>
</div>';
$s_name = null;
$Estate = null;
if (isset($_GET['searchName']) && isset($_GET['FindType'])) {
    if (!Matchs::isString($_GET['searchName'])) exit(back('查询条件错误！'));
    $FindType = $_GET['FindType'];
    $searchName = $_GET['searchName'];
    $s_name = " AND `{$FindType}` = '{$searchName}' ";
} else if (isset($_GET['Estate'])) {
    $lock = $cid == 5 ? "g_look" : "g_lock";
    $Estate = $_GET['Estate'];
    $s_name = $Estate == 0 ? "" : " AND `{$lock}` = '{$Estate}' ";
}
$Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
$pageNum = 15;
$db = new DB();
if ($LoginId == 48 || $cid == 5) {
    if ($s_name == null)
        $s_name = "";
    $total = $db->query("SELECT `g_name` FROM `g_user` WHERE  g_nid LIKE '{$Rank[3]}' {$s_name} ", 3);
    $page = new Page($total, $pageNum);
    if (isset($_GET['name'])) {
        $result = $userModel->GetUserName_LikeNo($Rank[3], true, $s_name, $page->limit, $_GET['name'], $_GET['level']);
        $page = new Page(count($result), $pageNum);
        if (isset($_GET['level'])) {
            $result = $userModel->GetUserName_Like($Rank[3], true, $s_name, $page->limit, $_GET['name'], $_GET['level']);
        } else
            $result = $userModel->GetUserName_Like($Rank[3], true, $s_name, $page->limit, $_GET['name']);
    } else
        $result = $userModel->GetUserName_Like($Rank[3], true, $s_name, $page->limit);

} else {
    if ($s_name == null)
        $s_name = "";
    $total = $db->query("SELECT `g_name` FROM `g_rank` WHERE  g_nid LIKE '{$Rank[3]}' {$s_name} ", 3);
    $page = new Page($total, $pageNum);
    if (isset($_GET['name'])) {
        $result = $userModel->GetUserName_LikeNo($Rank[3], false, $s_name, $page->limit, $_GET['name'], $_GET['level']);

        $page = new Page(count($result), $pageNum);
        if (isset($_GET['level'])) {
            $result = $userModel->GetUserName_Like($Rank[3], false, $s_name, $page->limit, $_GET['name'], $_GET['level']);
        } else
            $result = $userModel->GetUserName_Like($Rank[3], false, $s_name, $page->limit, $_GET['name']);
    } else
        $result = $userModel->GetUserName_Like($Rank[3], false, $s_name, $page->limit);


}

function get_upper($user_nid) {
    $ret = array();
    $v = mb_substr($user_nid, 0, mb_strlen($user_nid, 'utf-8') - 32);
    $userModel = new UserModel();
    $tmp = $userModel->GetUserName_Like($v);
    $ret['name'] = $tmp[0]['g_name'];
    $ret['nid'] = $tmp[0]['g_nid'];
    $ret['dis'] = $tmp[0]['g_distribution'];
    return $ret;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/wjl_tmp/artDialog/jquery.artDialog.min.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript" src="./js/Search.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/artDialog/skins/chrome.css"/>
    <script>
        $(document).ready(function () {
            var currentid = <?php echo $cid?>;
            var select_str = "li[level='" + currentid + "']";
            $(select_str).addClass('on');
            var win_height = window.innerHeight;
            $("#layout").css('height',win_height+'px');
            $("#add").click(function(){
                var current_cid = <?php echo $cid?>;
                var current_top_id
                    = <?php
                    $loginid = $Users[0]['g_login_id'];
                    if ($loginid == $userModel->cop_id) {
                        echo 1;
                    } else if ($loginid == $userModel->stock_id) {
                        echo 2;
                    } else if ($loginid == $userModel->maina_id) {
                        echo 3;
                    } else if ($loginid == $userModel->agent_id) {
                        echo 4;
                    } else {
                        exit(alert("当前用户登录id错误,请联系管理员"));
                    }
                    ?>;
                var current_name = '<?php echo $Users[0]['g_name']; ?>';
                if (current_cid == current_top_id + 1) {
                    select_upper(current_name,current_cid, 1);
                } else {
                    $('#rightLoader').hide();
                    $('#new_add').show();
                }
            })
        });
    </script>
</head>
<body>
<div id="layout" class="container" style=" height:284px">

<?php echo $left_html ?>
<div id="rightLoader" class="main-content bet-content">

<div id='memberList' class='page'>
<div class='title'><span name='account_name'><?php echo $Rank[1] ?></span><span class='hidden'
                                                            id='superior'>&nbsp;&nbsp;上级<select
            id='superior_se'>
            <option value=''>全部</option>
        </select>
    </span><select id='status' onchange="GoSearch('Estate',this)">
        <option value='0'
                <?php if ($Estate == null || $Estate == 0){?>
                    selected="selected"
                <?}?>
            >全部</option>
        <option value='3'
            <?php if ($Estate == 3){?>
                selected="selected"
            <?}?>
            >停用</option>
        <option value='2'
            <?php if ($Estate == 2){?>
                selected="selected"
            <?}?>
            >停押</option>
        <option value='1'
            <?php if ($Estate == 1){?>
                selected="selected"
            <?}?>
            >启用</option>
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
    <a id='add' class='mag-btn1 mag-btn2'>新增</a>
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
<?php if (($LoginId == 89 || $LoginId == 56) && $cid == 1) { ?>
    <table class='clear-table mag-list' id='memeber_tb'>
    <thead>
    <tr>
        <th><input type='checkbox' id='all_sel'></th>
        <th>在线</th>
        <th>名称</th>
        <th>账号</th>
        <th>信用额度</th>
        <th>信用余额</th>
        <th>盘口</th>
        <th name='level_name' ln='2'>股东</th>
        <th name='level_name' ln='3'>总代理</th>
        <th name='level_name' ln='4'>代理</th>
        <th name='level_name' ln='5'>会员</th>
        <th name='fgs' class='hidden'>总账</th>
        <th name='fgs' class='hidden'>补货</th>
        <th name='fgs' class='hidden'>占余归</th>
        <th>新增日期</th>
        <th>状态</th>
        <th>功能</th>
    </tr>
    </thead>
    <tbody id='accounts_tb'>
    <?php if (!$result) { ?>
        <tr>
            <td colspan="14">暂无账号</td>
        </tr>
    <?php } else { ?>
        <?php for ($i = 0; $i < count($result); $i++) {
            $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'], 'utf-8') - 32);
            $a = $userModel->GetUserName_Like($value);
            $n = $a[0]['g_name'];
            $p = 100 - $result[$i]['g_distribution'];
            $like = UserModel::Like();
            $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=2&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a></td><td class="nones">&nbsp;&nbsp;<a href="information.php?uid=' . $result[$i]['g_name'] . '"><img src="../images/soundon.png" width="20px" height="20px" border="0" title="发送消息"/></a></td></tr></table>' : $result[$i]['g_name'];
            ?>
            <tr id='' account='<?php echo $result[$i]['g_name']; ?>' class=''>
                <td>
                    <?php
                    if ($result[$i]['g_out'] == 1) {
                        if ($LoginId == 89)
                            echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Manage/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                        else
                            echo '<img src="/wjl_tmp/online.gif" />';
                    } else {
                        echo '<img src="/wjl_tmp/offline.gif" />';
                    }
                    ?>
                </td>
                <td id='753_isonline'
                    class='offline' title='最后一次登录IP：*'></td>
                <td class='t-l'><a href='javascript:void(0)' lower='753'
                                   class='bold'><?php echo $linkName ?></a>[<?php echo $result[$i]['g_f_name']; ?>
                    ]
                </td>
                <td><?php echo $linkName ?></td>
                <td><?php echo is_Number($result[$i]['g_money'], 0) ?></td>
                <td><?php echo is_Number($result[$i]['g_money_yes']); //信用余额 ?></td>
                <?php
                //TODO:盘口？
                ?>
                <td><?php echo $result[$i]['g_panlu'] //盘口 ?></td>
                <td><?php //股东
                    if ($stockholder['name'] == null) {
                        echo '-';
                    } else {
                        echo $stockholder['name'] . '<br/>' . $stockholder['dis'] . '%';
                    }
                    ?></td>

                <td><?php //总代理
                    echo $result[$i]['g_distribution'];
                    ?></td>
                <!--代理数目-->
                <td><?php echo '<a href="Actfor.php?cid=4&name=' . $result[$i]['g_name'] . '&level=1" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . $like) . '</a>'; ?></td>
                <!--会员数目-->
                <td><?php echo '<a href="Actfor.php?cid=5&name=' . $result[$i]['g_name'] . '&level=4" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . '%', true) . '</a>'; ?></td>
                <td>
                    <?php
                    echo str_replace(' ', '<br/>', $result[$i]['g_date']);
                    ?></td>
                <td name='cur_status' ct='<?php echo $result[$i]['g_lock'] ?>' delst='0'>
                    <?php if ($result[$i]['g_lock'] == 1) echo '启用';
                    if ($result[$i]['g_lock'] == 2) echo '停押';
                    if ($result[$i]['g_lock'] == 3) echo '停用';?></td>
                <td class='op'>
                    <a class="f-pop" target_status='<?php echo $result[$i]['g_lock'] == 3 ? 1 : 3 ?>'
                       href='javascript:void(0)' name="is_used"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 3 ? '启用' : '停用'; ?>
                    </a>/
                    <a class="f-pop" target_status="<?php echo $result[$i]['g_lock'] == 2 ? 3 : 2 ?>"
                       href='javascript:void(0)' name="is_frozen"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 2 ? '停用' : '停押'; ?>
                    </a> /
                    <a href="account_edit_wjl.php?cid=<?php echo $cid ?>&uid=<?php echo $result[$i]['g_name'] ?>"
                       edit='753'>修改</a>/
                    <a account_name='aaa11' log='753'
                       href="LoginLog.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">日志</a>/
                    <a account_name='aaa11' record='753'
                       href="Amend_Log.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">记录</a>
                </td>
            </tr>
        <?php } //for end?>
    <?php } //if (result) else end?>

    </tbody>
        </table>
<?php } else if ($cid == 2) { //股东开始?>
    <table class='clear-table mag-list' id='memeber_tb'>
    <thead>
    <tr>
        <th><input type='checkbox' id='all_sel'></th>
        <th>在线</th>
        <th>名称</th>
        <th>账号</th>
        <th>信用额度</th>
        <th>信用余额</th>
        <th>盘口</th>
        <th name='level_name' ln='2'>股东</th>
        <th name='level_name' ln='3'>总代理</th>
        <th name='level_name' ln='4'>代理</th>
        <th name='level_name' ln='5'>会员</th>
        <th name='fgs' class='hidden'>总账</th>
        <th name='fgs' class='hidden'>补货</th>
        <th name='fgs' class='hidden'>占余归</th>
        <th>新增日期</th>
        <th>状态</th>
        <th>功能</th>
    </tr>
    </thead>
    <tbody id='accounts_tb'>
    <?php if (!$result) { ?>
        <tr>
            <td colspan="14">暂无账号</td>
        </tr>
    <?php } else { ?>
        <?php for ($i = 0; $i < count($result); $i++) {
            $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'], 'utf-8') - 32);
            $a = $userModel->GetUserName_Like($value);
            $l = $a[0]['g_name'];
            $p = $a[0]['g_distribution'] - $result[$i]['g_distribution'];
            $like = UserModel::Like();
            $linkName = $LoginId == 89 ?
                '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=3&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a></td><td class="nones">&nbsp;&nbsp;<a href="information.php?uid=' . $result[$i]['g_name'] . '"><img src="../images/soundon.png" width="20px" height="20px" border="0" title="发送消息"/></a></td></tr></table>'
                : '<a href="Actfor.php?cid=3&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a>';
            ?>
            <tr id='' account='<?php echo $result[$i]['g_name']; ?>' class=''>
                <td>
                    <?php
                    if ($result[$i]['g_out'] == 1) {
                        if ($LoginId == 89)
                            echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Manage/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                        else
                            echo '<img src="/wjl_tmp/online.gif" />';
                    } else {
                        echo '<img src="/wjl_tmp/offline.gif" />';
                    }
                    ?>
                </td>
                <td id='753_isonline'
                    class='offline' title='最后一次登录IP：*'></td>
                <td class='t-l'><a href='javascript:void(0)' lower='753'
                                   class='bold'><?php echo $result[$i]['g_f_name'] ?></a>[<?php echo $l; ?>
                    ]
                </td>
                <td><?php echo $linkName ?></td>
                <td><?php echo is_Number($result[$i]['g_money'], 0) ?></td>
                <td><?php echo is_Number($result[$i]['g_money_yes']); //信用余额 ?></td>
                <?php
                //TODO:盘口？
                ?>
                <td><?php echo $result[$i]['g_panlu'] //盘口 ?></td>
                <td><?php //股东
                    echo $result[$i]['g_distribution'];
                    ?>%</td>

                <td><?php echo '<a href="Actfor.php?cid=3&name=' . $result[$i]['g_name'] . '&level=1" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . $like) . '</a>'; ?></td>
                <!--代理数目-->
                <td><?php echo '<a href="Actfor.php?cid=4&name=' . $result[$i]['g_name'] . '&level=1" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . $like.$like) . '</a>'; ?></td>
                <!--会员数目-->
                <td><?php echo '<a href="Actfor.php?cid=5&name=' . $result[$i]['g_name'] . '&level=4" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . '%', true) . '</a>'; ?></td>
                <td>
                    <?php
                    echo str_replace(' ', '<br/>', $result[$i]['g_date']);
                    ?></td>
                <td name='cur_status' ct='<?php echo $result[$i]['g_lock'] ?>' delst='0'>
                    <?php if ($result[$i]['g_lock'] == 1) echo '启用';
                    if ($result[$i]['g_lock'] == 2) echo '停押';
                    if ($result[$i]['g_lock'] == 3) echo '停用';?></td>
                <td class='op'>
                    <a class="f-pop" target_status='<?php echo $result[$i]['g_lock'] == 3 ? 1 : 3 ?>'
                       href='javascript:void(0)' name="is_used"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 3 ? '启用' : '停用'; ?>
                    </a>/
                    <a class="f-pop" target_status="<?php echo $result[$i]['g_lock'] == 2 ? 3 : 2 ?>"
                       href='javascript:void(0)' name="is_frozen"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 2 ? '停用' : '停押'; ?>
                    </a> /
                    <a href="account_edit_wjl.php?cid=<?php echo $cid ?>&uid=<?php echo $result[$i]['g_name'] ?>"
                       edit='753'>修改</a>/
                    <a account_name='aaa11' log='753'
                       href="LoginLog.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">日志</a>/
                    <a account_name='aaa11' record='753'
                       href="Amend_Log.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">记录</a>
                </td>
            </tr>
        <?php } //for end?>
    <?php } //if (result) else end?>

    </tbody>
        </table>
<?php
} else if ($cid == 3) { //总代理开始
    ?>
    <table class='clear-table mag-list' id='memeber_tb'>
    <thead>
    <tr>
        <th><input type='checkbox' id='all_sel'></th>
        <th>在线</th>
        <th>名称</th>
        <th>账号</th>
        <th>信用额度</th>
        <th>信用余额</th>
        <th>盘口</th>
        <th name='level_name' ln='2'>股东</th>
        <th name='level_name' ln='3'>总代理</th>
        <th name='level_name' ln='4'>代理</th>
        <th name='level_name' ln='5'>会员</th>
        <th name='fgs' class='hidden'>总账</th>
        <th name='fgs' class='hidden'>补货</th>
        <th name='fgs' class='hidden'>占余归</th>
        <th>新增日期</th>
        <th>状态</th>
        <th>功能</th>
    </tr>
    </thead>
    <tbody id='accounts_tb'>
    <?php if (!$result) { ?>
        <tr>
            <td colspan="14">暂无账号</td>
        </tr>
    <?php } else { ?>
        <?php for ($i = 0; $i < count($result); $i++) {
            $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'], 'utf-8') - 32);
            $a = $userModel->GetUserName_Like($value);
            $stockholder['name'] = $a[0]['g_name']; //股東

            $value = mb_substr($a[0]['g_nid'], 0, mb_strlen($a[0]['g_nid'], 'utf-8') - 32);
            $h = $userModel->GetUserName_Like($value); //公司
            $o = $h[0]['g_name'];

            //股東占成計算
            if ($result[$i]['g_distribution_limit'] == 0) { //表示股東不占成
                $p = 0; //$a[0]['g_distribution_limit'];
                $stockholder['dis'] = $h[0]['g_distribution'] - $result[$i]['g_distribution'];
            } else {
                $p = $result[$i]['g_distribution_limit'];
                $stockholder['dis'] = $h[0]['g_distribution'] - ($result[$i]['g_distribution'] + $result[$i]['g_distribution_limit']);
            }
            $like = UserModel::Like();
            $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=4&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a></td><td class="nones">&nbsp;&nbsp;<a href="information.php?uid=' . $result[$i]['g_name'] . '"><img src="../images/soundon.png" width="20px" height="20px" border="0" title="发送消息"/></a></td></tr></table>' : '<a href="Actfor.php?cid=4&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a>';
            ?>
            <tr id='' account='<?php echo $result[$i]['g_name']; ?>' class=''>
                <td>
                    <?php
                    if ($result[$i]['g_out'] == 1) {
                        if ($LoginId == 89)
                            echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Manage/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                        else
                            echo '<img src="/wjl_tmp/online.gif" />';
                    } else {
                        echo '<img src="/wjl_tmp/offline.gif" />';
                    }
                    ?>
                </td>
                <td id='753_isonline'
                    class='offline' title='最后一次登录IP：*'></td>
                <td class='t-l'><a href='javascript:void(0)' lower='753'
                                   class='bold'><?php echo $result[$i]['g_f_name'] ?></a>[<?php echo $stockholder['name'] ?>
                    ]
                </td>
                <td><?php echo $linkName ?></td>
                <td><?php echo is_Number($result[$i]['g_money'], 0) ?></td>
                <td><?php echo is_Number($result[$i]['g_money_yes']); //信用余额 ?></td>
                <?php
                //TODO:盘口？
                ?>
                <td><?php echo $result[$i]['g_panlu'] //盘口 ?></td>
                <td><?php //股东
                    if ($stockholder['name'] == null) {
                        echo '-';
                    } else {
                        echo $stockholder['name'] . '<br/>' . $stockholder['dis'] . '%';
                    }
                    ?></td>

                <td><?php //总代理
                    echo $result[$i]['g_distribution'];
                    ?>%</td>
                <!--代理数目-->
                <td><?php echo '<a href="Actfor.php?cid=4&name=' . $result[$i]['g_name'] . '&level=1" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . $like) . '</a>'; ?></td>
                <!--会员数目-->
                <td><?php echo '<a href="Actfor.php?cid=5&name=' . $result[$i]['g_name'] . '&level=4" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . '%', true) . '</a>'; ?></td>
                <td>
                    <?php
                    echo str_replace(' ', '<br/>', $result[$i]['g_date']);
                    ?></td>
                <td name='cur_status' ct='<?php echo $result[$i]['g_lock'] ?>' delst='0'>
                    <?php if ($result[$i]['g_lock'] == 1) echo '启用';
                    if ($result[$i]['g_lock'] == 2) echo '停押';
                    if ($result[$i]['g_lock'] == 3) echo '停用';?></td>
                <td class='op'>
                    <a class="f-pop" target_status='<?php echo $result[$i]['g_lock'] == 3 ? 1 : 3 ?>'
                       href='javascript:void(0)' name="is_used"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 3 ? '启用' : '停用'; ?>
                    </a>/
                    <a class="f-pop" target_status="<?php echo $result[$i]['g_lock'] == 2 ? 3 : 2 ?>"
                       href='javascript:void(0)' name="is_frozen"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 2 ? '停用' : '停押'; ?>
                    </a> /
                    <a href="account_edit_wjl.php?cid=<?php echo $cid ?>&uid=<?php echo $result[$i]['g_name'] ?>"
                       edit='753'>修改</a>/
                    <a account_name='aaa11' log='753'
                       href="LoginLog.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">日志</a>/
                    <a account_name='aaa11' record='753'
                       href="Amend_Log.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">记录</a>
                </td>
            </tr>
        <?php } //for end?>
    <?php } //if (result) else end?>

    </tbody>
        </table>
<?php } else if ($cid == 4) { //代理开始 ?>
    <table class='clear-table mag-list' id='memeber_tb'>
    <thead>
    <tr>
        <th><input type='checkbox' id='all_sel'></th>
        <th>在线</th>
        <th>名称</th>
        <th>账号</th>
        <th>信用额度</th>
        <th>信用余额</th>
        <th>盘口</th>
        <th name='level_name' ln='2'>股东</th>
        <th name='level_name' ln='3'>总代理</th>
        <th name='level_name' ln='4'>代理</th>
        <th name='level_name' ln='5'>会员</th>
        <th name='fgs' class='hidden'>总账</th>
        <th name='fgs' class='hidden'>补货</th>
        <th name='fgs' class='hidden'>占余归</th>
        <th>新增日期</th>
        <th>状态</th>
        <th>功能</th>
    </tr>
    </thead>
    <tbody id='accounts_tb'>
    <?php if (!$result) { ?>
        <tr>
            <td colspan="14">暂无账号</td>
        </tr>
    <?php } else { ?>
        <?php for ($i = 0; $i < count($result); $i++) {
            $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'], 'utf-8') - 32);
            $a = $userModel->GetUserName_Like($value);
            $main_agent['name'] = $a[0]['g_name']; //總代

            $value = mb_substr($a[0]['g_nid'], 0, mb_strlen($a[0]['g_nid'], 'utf-8') - 32);
            $h = $userModel->GetUserName_Like($value);
            $stockholder['name'] = $h[0]['g_name']; //股東

            $main_agent['dis'] = $a[0]['g_distribution'] - $result[$i]['g_distribution'];
            $stockholder['dis'] = 100 - ($result[$i]['g_distribution'] + ($a[0]['g_distribution'] - $result[$i]['g_distribution']));
            $like = UserModel::Like();
            $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=5&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a></td><td class="nones">&nbsp;&nbsp;<a href="information.php?uid=' . $result[$i]['g_name'] . '"><img src="../images/soundon.png" width="20px" height="20px" border="0" title="发送消息"/></a></td></tr></table>' : '<a href="Actfor.php?cid=5&name=' . $result[$i]['g_name'] . '" target="mainFrame">' . $result[$i]['g_name'] . '</a>';

            ?>
            <tr id='' account='<?php echo $result[$i]['g_name']; ?>' class=''>
                <td>
                </td>
                <td id='753_isonline'
                    <?php if ($result[$i]['g_out'] == 1) { ?>
                        class='online'
                    <?php } else { ?>
                        class='offline'
                    <? } ?>
                    title='最后一次登录IP：*'></td>
                <td class='t-l'><a href='javascript:void(0)' lower='753'
                                   class='bold'><?php echo $result[$i]['g_f_name'] ?></a>[<?php echo $main_agent['name']; ?>
                    ]
                </td>
                <td><?php echo $linkName ?></td>
                <td><?php echo is_Number($result[$i]['g_money'], 0) ?></td>
                <td><?php echo is_Number($result[$i]['g_money_yes']); //信用余额 ?></td>
                <?php
                //TODO:代理没有盘口？
                ?>
                <td><?php echo $result[$i]['g_panlu'] //盘口 ?></td>
                <td><?php //股东
                    if ($stockholder['name'] == null) {
                        echo '-';
                    } else {
                        echo $stockholder['name'] . '<br/>' . $stockholder['dis'] . '%';
                    }
                    ?></td>

                <td><?php //总代理
                    if ($main_agent['name'] == null) {
                        echo '-';
                    } else {
                        echo $main_agent['name'] . '<br/>' . $main_agent['dis'] . '%';
                    }
                    ?></td>
                <td><?php echo $result[$i]['g_distribution'] ?>%</td>
                <!--会员数目-->
                <td><?php echo '<a href="Actfor.php?cid=5&name=' . $result[$i]['g_name'] . '&level=4" target="mainFrame">' . $userModel->SumCount($result[$i]['g_nid'] . '%', true) . '</a>'; ?></td>
                <td>
                    <?php
                    echo str_replace(' ', '<br/>', $result[$i]['g_date']);
                    ?></td>
                <td name='cur_status' ct='<?php echo $result[$i]['g_lock'] ?>' delst='0'>
                    <?php if ($result[$i]['g_lock'] == 1) echo '启用';
                    if ($result[$i]['g_lock'] == 2) echo '停押';
                    if ($result[$i]['g_lock'] == 3) echo '停用';?></td>
                <td class='op'>
                    <a class="f-pop" target_status='<?php echo $result[$i]['g_lock'] == 3 ? 1 : 3 ?>'
                       href='javascript:void(0)' name="is_used"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 3 ? '启用' : '停用'; ?>
                    </a>/
                    <a class="f-pop" target_status="<?php echo $result[$i]['g_lock'] == 2 ? 3 : 2 ?>"
                       href='javascript:void(0)' name="is_frozen"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_lock'] == 2 ? '停用' : '停押'; ?>
                    </a> /
                    <a href="account_edit_wjl.php?cid=<?php echo $cid ?>&uid=<?php echo $result[$i]['g_name'] ?>"
                       edit='753'>修改</a>/
                    <a account_name='aaa11' log='753'
                       href="LoginLog.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">日志</a>/
                    <a account_name='aaa11' record='753'
                       href="Amend_Log.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">记录</a>
                </td>
            </tr>
        <?php } //for end?>
    <?php } //if (result) else end?>

    </tbody>
        </table>
<?php } else if ($cid == 5) { ?>
    <table class='clear-table mag-list' id='memeber_tb'>
    <thead>
    <tr>
        <th><input type='checkbox' id='all_sel'></th>
        <th>在线</th>
        <th>名称</th>
        <th>账号</th>
        <th>信用额度</th>
        <th>信用余额</th>
        <th>盘口</th>
        <th name='level_name' ln='2'>股东</th>
        <th name='level_name' ln='3'>总代理</th>
        <th name='level_name' ln='4'>代理</th>
        <th name='fgs' class='hidden'>总账</th>
        <th name='fgs' class='hidden'>补货</th>
        <th name='fgs' class='hidden'>占余归</th>
        <th>新增日期</th>
        <th>状态</th>
        <th>功能</th>
    </tr>
    </thead>
    <tbody id='accounts_tb'>
    <?php if (!$result) { ?>
        <tr>
            <td colspan="14">暂无账号</td>
        </tr>
    <?php } else { ?>
        <?php for ($i = 0; $i < count($result); $i++) {

            if ($result[$i]['g_mumber_type'] == 2) {
                $agent = array(null); //代理
                $main_agent = array(null); //总代理
                $stockholder = array(null); //股东
                $comp = array(null); //分公司
                $_a = '--';
                $topname = '';
                $user_nid = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid']) - 32);
                $_nid = $userModel->GetUserName_Like($user_nid);
                $_nid = $_nid[0];
                if ($_nid['g_login_id'] == 78) { //總代直屬
                    $mumberType = '<font class="red">直屬總代理</font>';
                    //$_a = $_nid['g_name'].'（'.$result[$i]['g_distribution'].'%）';
                    //$v = mb_substr($user_nid, 0, mb_strlen($user_nid,'utf-8')-32);
                    //$c = $userModel->GetUserName_Like($v);
                    //$_a = $c[0]['g_name'].'（'.($_nid['g_distribution_limit']).'%）';
                    //$v = mb_substr($c[0]['g_nid'], 0, mb_strlen($c[0]['g_nid'],'utf-8')-32);
                    //alert($v);
                    //$d = $userModel->GetUserName_Like($v);
                    $main_agent['name'] = $_nid['g_name'];
                    $main_agent['dis'] = $result[$i]['g_distribution'];
                    $topname = $main_agent['name'];
                } else if ($_nid['g_login_id'] == 22) { //股東直屬
                    $mumberType = '<font class="red">直屬股東</font>';
                    $stockholder['name'] = $_nid['g_name'];
                    $stockholder['dis'] = $result[$i]['g_distribution'];
                    $v = mb_substr($user_nid, 0, mb_strlen($user_nid, 'utf-8') - 32);
                    echo $v;
                    $d = $userModel->GetUserName_Like($v);
                    $topname = $stockholder['name'];
                } else if ($_nid['g_login_id'] == 56) { //分公司直屬
                    $mumberType = '<font class="red">直屬分公司</font>';
                    $comp['name'] = $_nid['g_name'];
                    $comp['dis'] = $result[$i]['g_distribution'];
                    $v = mb_substr($user_nid, 0, mb_strlen($user_nid, 'utf-8') - 32);
                    $d = $userModel->GetUserName_Like($v);
                    $topname = $comp['name'];
                }

            } else {
                $value = $result[$i]['g_nid'];
                $mumberType = '普通會員';
                $agent = get_upper($value); //代理
                $main_agent = get_upper($agent['nid']); //总代理
                $stockholder = get_upper($main_agent['nid']); //股东
                $topname = $agent['name'];
            }
            var_dump($_nid['g_login_id']);

            $linkName = $LoginId == 89 ? '<a href="information.php?uid=' . $result[$i]['g_name'] . '&mid=1">' . $result[$i]['g_name'] . '</a>' : $result[$i]['g_name'];
            ?>
            <tr id='' account='<?php echo $result[$i]['g_name']; ?>' class=''>
                <td>
                </td>
                <td id='753_isonline'
                    <?php if ($result[$i]['g_out'] == 1) { ?>
                        class='online'
                    <?php } else { ?>
                        class='offline'
                    <? } ?>
                    title='最后一次登录IP：*'></td>
                <td class='t-l'><a href='javascript:void(0)' lower='753'
                                   class='bold'><?php echo $result[$i]['g_f_name'] ?></a>[<?php echo $topname; ?>
                    ]
                </td>
                <td><?php echo $linkName ?></td>
                <td><?php echo is_Number($result[$i]['g_money'], 0) ?></td>
                <td><?php echo is_Number($result[$i]['g_money_yes']); //信用余额 ?></td>
                <?php
                //TODO:盘口？
                ?>
                <td><?php echo $result[$i]['g_panlu'] //盘口 ?></td>
                <td><?php
                    if ($stockholder['name'] == null) {
                        echo '-';
                    } else {
                        echo $stockholder['name'] . '<br/>' . $stockholder['dis'] . '%';
                    }
                    ?></td>
                <td><?php
                    if ($main_agent['name'] == null) {
                        echo '-';
                    } else {
                        echo $main_agent['name'] . '<br/>' . $main_agent['dis'] . '%';
                    }
                    ?></td>
                <td><?php
                    if ($agent['name'] == null) {
                        echo '-';
                    } else {
                        echo $agent['name'] . '<br/>' . $agent['dis'] . '%';
                    }
                    ?></td>
                <td>
                    <?php
                    echo str_replace(' ', '<br/>', $result[$i]['g_date']);
                    ?></td>
                <td name='cur_status' ct='<?php echo $result[$i]['g_look'] ?>' delst='0'>
                    <?php if ($result[$i]['g_look'] == 1) echo '启用';
                    if ($result[$i]['g_look'] == 2) echo '停押';
                    if ($result[$i]['g_look'] == 3) echo '停用';?></td>
                <td class='op'>
                    <a class="f-pop" target_status='<?php echo $result[$i]['g_look'] == 3 ? 1 : 3 ?>'
                       href='javascript:void(0)' name="is_used"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_look'] == 3 ? '启用' : '停用'; ?>
                    </a>/
                    <a class="f-pop" target_status="<?php echo $result[$i]['g_look'] == 2 ? 3 : 2 ?>"
                       href='javascript:void(0)' name="is_frozen"
                       onclick="act_change_use('<?php echo $result[$i]['g_name']; ?>',this);">
                        <?php echo $result[$i]['g_look'] == 2 ? '停用' : '停押'; ?>
                    </a> /
                    <a href="account_edit_wjl.php?cid=<?php echo $cid ?>&uid=<?php echo $result[$i]['g_name'] ?>"
                       edit='753'>修改</a>/
                    <a account_name='aaa11' log='753'
                       href="LoginLog.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">日志</a>/
                    <a account_name='aaa11' record='753'
                       href="Amend_Log.php?uid=<?php echo $result[$i]['g_name'] ?>&cid=<?php echo $cid?>">记录</a>
                </td>
            </tr>
        <?php } //for end?>
    <?php } //if(result) else end?>
    </tbody>
        </table>
<?php } //if cid end?>
</div>
<?php
    $loginid = $Users[0]['g_login_id'];
    $all_account = $userModel->Get_all_count(1,$Users[0]['g_nid'],$Users[0]['g_login_id']);
    $end_index = $cid;
    $id_name_array = array();
    if ($loginid == $userModel->cop_id) {
        $id_name_array = array(
            '分公司',
            '股东',
            '总代理',
            '代理');
    } else if ($loginid == $userModel->stock_id) {
        $id_name_array = array(
            '股东',
            '总代理',
            '代理');
    } else if ($loginid == $userModel->maina_id) {
        $id_name_array = array(
            '总代理',
            '代理');
    } else if ($loginid == $userModel->agent_id) {
    } else {
    }

?>

</div>
<div id="new_add" dom="right" class="main-content bet-content" style="display: none;">
    <div id="superior" class="page superior">
        <div class="title">新增<span id="account_name">会员</span></div>
        <table class="clear-table">
            <caption>
                <div>选择上级</div>
                <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
            </caption>
            <tbody>
            <script type="text/javascript">/*获得上级，跳转到新增页面.并将上级参数传入
                 */
                function select_upper(val, cid, sid)
                {
                    if (val != 0) {
                        var href = "/Manage/temp/Account_Edit.php?aid=add&cid="+ cid +"&sid=" + sid + "&top_name="+val;
                        location.href = href;
                    }
                }</script>
            <tr>
                <th>选择上级<span id="superior_name"></span></th>
                <td>
                    <select id="superior_new" onchange="select_upper(this.value,<?php echo $end_index?>, 1)" >
                        <option value="0">选择上级</option>
                        <?php for ($i=0; $i<count($id_name_array); $i++) { ?>
                            <optgroup label="<?php echo $id_name_array[$i] ?>">
                                <?php for($j=0;$j <count($all_account[$i]); $j++) { ?>
                                    <option value="<?php echo $all_account[$i][$j]['g_name']; ?>">
                                        <?php echo $all_account[$i][$j]['g_name']; ?>
                                    </option>
                                <?php } //for j end ?>
                            </optgroup>
                        <?php } //for i end?>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</body>
</html>
