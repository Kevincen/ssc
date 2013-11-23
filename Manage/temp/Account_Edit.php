<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] != 89)
    if ($Users[0]['g_lock'] == 2) exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])) {
    if ($Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
        exit(back($UserOut)); //帳號已被凍結
}
function  get_default_send_back()
{
    $sql = "select * from g_send_back_default";
    $db = new DB();
    return $db->query($sql, 1);
}

$userModel = new UserModel();
$count = 0; //控制是否显示退水 by wjl

//zerc20120803
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['op']) && $_POST['op'] == 'chksname') {
    echo "getting_wrong";
    if ($userModel->ExistUnion($_POST['pname'])) {
        echo '1';
    } else {
        echo '0';
    }
    exit;
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['actions']) && isset($_GET['cid'])) {

    //新增帳號
    //TODO:这里存的时候按照普通会员存了，要分开来存
    if ($_GET['actions'] == 'add') {
        if (!Matchs::isString($_POST['s_Name'], 4, 9)) exit(back('您輸入的帳號錯誤！'));
        if (!Matchs::isStringChi($_POST['s_F_Name'], 2, 8)) exit(back('您輸入的名稱錯誤！'));
        if (!Matchs::isString($_POST['s_Pwd'], 8, 20)) exit(back('您輸入的密碼錯誤！'));

        if ($_GET['cid'] == 1 && $LoginId == 89) //新增公司帳號
        {
            $userList['id'] = 1;
            $userList['g_nid'] = $Users[0]['g_nid'] . md5(uniqid(time(), true));;
            $userList['g_login_id'] = 56;
            $userList['g_name'] = $_POST['name'];
            $userList['g_password'] = sha1($_POST['s_Pwd']);
            $userList['g_f_name'] = $_POST['s_F_Name'];
            $userList['g_money'] = $_POST['s_money'];
            $userList['g_distribution'] = $_POST['s_next_ky'];
            $userList['g_distribution_limit'] = $_POST['s_next_ky'];
            $userList['g_Immediate_lock'] = 1;
            $userList['g_lock'] = $_POST['lock'];
            $userList['g_ip'] = UserModel::GetIP();
            $userList['g_date'] = date("Y-m-d H:i:s");
            $userList['g_uid'] = md5(uniqid(time(), true));
            if (!isset($_POST['zcgs'])) { //TODO:这是个什么东东？
                $userList['g_zcgs'] = 0;
            } else {
                $userList['g_zcgs'] = $_POST['zcgs'];
            }
            if ($userModel->ExistUnion($userList['g_name'])) {
                alert_href('此用戶已存在', 'Actfor.php?cid=' . $_GET['cid']);
                exit;
            }
            $userList = $userModel->AddUser($userList);

        } else if ($_GET['cid'] == 2 && ($LoginId == 89 || $LoginId == 56)) //新增股東帳號
        {
            $g_nid = $userModel->GetUserModel(null, $_POST['s']);
            if (!$g_nid) exit(back('上級帳號不存在！'));
            if (!Matchs::isNumber($_POST['s_money'])) exit(back('信用額錯誤！'));
            //if (!Matchs::isNumber($_POST['s_next_ky'])) exit(back('占成率錯誤！'));
            if ($_POST['s_next_ky'] > ($g_nid[0]['g_distribution'] - 1)) exit(back('上级分公司最低需占1%'));
            if ($_POST['s_next_ky'] > $g_nid[0]['g_distribution']) exit(back('上级分公司最高占成率' . $g_nid[0]['g_distribution'] . '%'));


            $nid = $g_nid[0]['g_nid'] . UserModel::Like();
            $validMoney = $g_nid[0]['g_money'] - $userModel->SumMoney($nid);


            if ($_POST['s_money'] > $validMoney) exit(back('可用餘額：' . $validMoney));

            $userList['id'] = 2;
            $userList['L_name'] = $g_nid[0]['g_name'];
            $userList['g_nid'] = $g_nid[0]['g_nid'] . md5(uniqid(time(), true));
            $userList['g_login_id'] = 22;
            $userList['g_distribution_limit'] = $g_nid[0]['g_distribution'] - $_POST['s_next_ky'];
            $userList['g_name'] = $_POST['s_Name'];
            $userList['g_password'] = sha1($_POST['s_Pwd']);
            $userList['g_f_name'] = $_POST['s_F_Name'];
            $userList['g_money'] = $_POST['s_money'];
            $userList['g_distribution'] = $_POST['s_next_ky'];
            $userList['g_Immediate_lock'] = $_POST['Immediate_lock']; //補倉是否開啟
            $userList['g_lock'] = $_POST['lock'];
            $userList['g_ip'] = UserModel::GetIP();
            $userList['g_date'] = date("Y-m-d H:i:s");
            $userList['g_uid'] = md5(uniqid(time(), true));
            $userList['g_zcgs'] = $g_nid[0]['g_zcgs'];
            if ($userModel->ExistUnion($userList['g_name'])) {
                alert_href('此用戶已存在', 'Actfor.php?cid=' . $_GET['cid']);
                exit;
            }
            $userList = $userModel->AddUser($userList);

        } else if (($_GET['cid'] == 3 || $_GET['cid'] == 4) && ($LoginId == 89 || $LoginId == 56 || $LoginId == 22 || $LoginId == 78)) //新增總代理帳號
        {

            $g_nid = $userModel->GetUserModel(null, $_POST['s']);
            if (!$g_nid) exit(back('上級帳號不存在！'));
            if (!Matchs::isNumber($_POST['s_money'])) exit(back('信用額錯誤！'));
            if ($_POST['zy'] == 1) {
                $s_Size = (int)$_POST['s_size_ky']; //上級占成
                $s_next_ky = $g_nid[0]['g_distribution'] - $s_Size; //下級占成
            } else {
                $s_Size = (int)$_POST['s_size_ky']; //上級占成
                $s_next_ky = $_POST['s_next_ky']; //下級占成
            }
            if (!Matchs::isNumber($s_next_ky) || !Matchs::isNumber($s_Size)) exit(back('占成錯誤！'));
            if ($s_Size + $s_next_ky > $g_nid[0]['g_distribution']) exit(back('上級最高占成率：' . $g_nid[0]['g_distribution'] . '%'));

            /*
             * 得到當前用戶可用額
             * 計算還是錯誤，待修改
             */
            $nid = $g_nid[0]['g_nid'] . UserModel::Like();
            $validMoney = $g_nid[0]['g_money'] - $userModel->SumMoney($nid);


            if ($_POST['s_money'] > $validMoney) exit(back('可用餘額：' . $validMoney));
            $userList['g_login_id'] = $_GET['cid'] == 3 ? 78 : 48;
            $userList['id'] = 2;
            $userList['L_name'] = $g_nid[0]['g_name'];
            $userList['g_nid'] = $g_nid[0]['g_nid'] . md5(uniqid(time(), true));
            $userList['g_name'] = $_POST['s_Name'];
            $userList['g_password'] = sha1($_POST['s_Pwd']);
            $userList['g_f_name'] = $_POST['s_F_Name'];
            $userList['g_money'] = $_POST['s_money'];
            $userList['g_distribution'] = $s_next_ky;
            $userList['g_distribution_limit'] = $s_Size; //上級成數
            $Immediate_lock = $_POST['Immediate_lock'];
            /*if ($userList['g_login_id'] == 48){
                $Immediate_lock.= $_POST['Immediate_lock_z'];
            }*/
            $userList['g_Immediate_lock'] = $Immediate_lock;
            $userList['g_lock'] = $_POST['lock'];
            $userList['g_ip'] = UserModel::GetIP();
            $userList['g_date'] = date("Y-m-d H:i:s");
            $userList['g_uid'] = md5(uniqid(time(), true));
            $userList['g_zcgs'] = $g_nid[0]['g_zcgs'];
            if ($userModel->ExistUnion($userList['g_name'])) {
                alert_href('此帳號已被使用', 'Actfor.php?cid=' . $_GET['cid']);
                exit;
            }
            $userList = $userModel->AddUser($userList);

        } else if ($cid == 4 ) {

        } else {
            exit(href('quit.php'));
        }
        update_MR($_GET['cid']); //在$userModel->AddUser($userList);当中已经插入了默认的退水信息，因此在这里update一下就好了
        alert_href('新增成功', 'Actfor.php?cid=' . $_GET['cid']);
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET['cid']) || !isset($_GET['aid']) || !isset($_GET['top_name']))
    exit(href('quit.php'));
$aid = $_GET['aid'];
$cid = $_GET['cid']; //根據cid判斷當前用戶需要新增什麽級別的帳號
$top_name = $_GET['top_name'];

if ($aid == 'add') //新增面板顯示
{
    $select = null;
    $Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
    $input = '確認新增';
    $Title = $Users[0]['g_Lnid'][0];

    if ($cid != 1) {
        $select = getSelect($Rank, $userModel);
    } else {
        $nid = $Users[0]['g_nid'];
        //if($userModel->GetUserName_Like($nid)) alert_href('系統檢測到已有公司帳號！', 'Actfor.php?cid='.$_GET['cid']);
    }
    $result = get_default_send_back();
    if (!$result) {
        $count = 0;
    } else {
        $count = 1;
    }
} else {
    exit(href('quit.php'));
}

function getSelect($Rank, $userModel)
{
    $select = null;
    if ($Rank[0] == "总公司")
        $Rank[0] = "分公司";
    $option1 = '<tr><td class="bj">上級' . $Rank[0] . '</td><td class="left_p5"><select name="s" id="s" onchange="FirstRankMoney()">';
    $option2 = '</select>&nbsp;&nbsp;<span id="FirstRankMoney"></span></td></tr>';
    $result = $userModel->GetUserName_Like($Rank[2]);
    if ($result == null) {
        $select = '<option value="0">暫無帳號</option>';
    } else {
        for ($i = 0; $i < count($result); $i++) {
            $select .= '<option value="' . $result[$i]['g_name'] . '">' . $result[$i]['g_name'] . '</option>';
        }
    }
    return $option1 . $select . $option2;
}

//插入项目退水等信息
function update_MR($cid)
{
    echo "enter update_MR";
    global $_POST;
    $uModel = new UserModel();
    $name = $_POST['s_Name'];
    if ($cid == 5) {
        $usersModel = $uModel->GetMemberModel($name);
    } else {
        $usersModel = $uModel->GetUserModel(null, $name);
    }
    if ($usersModel) {
        $Lname = mb_substr($usersModel[0]['g_nid'], 0, mb_strlen($usersModel[0]['g_nid']) - 32);
        $Lname = $uModel->GetUserName_Like($Lname); //返回查询出来的用户信息
        $db = new DB();
        if ($usersModel[0]['g_login_id'] == 56) { //如果被操作用户为分公司，则将类赋给$Lname，否则宣告权限不足
            $Lname = $usersModel;
        } else {
            if ($Lname[0]['g_lock'] != 1) {
                exit(back('更變權限不足！'));
            }
        }
        $sList = array(0 => 0, 1 => 0, 2 => 0);
        $LdetList = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id`
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' ORDER BY g_id DESC", 0); //获取退水表
        for ($i = 0; $i < count($LdetList); $i++) {
            if (!isset($_POST['a' . ($i)])) {
                continue;
            }
            $aList = 100 - $_POST['a' . ($i)]; //A盘退水
            $bList = 100 - $_POST['b' . ($i)]; //B盘退水
            $cList = 100 - $_POST['c' . ($i)]; //C盘退水
            $dList = $_POST['d' . ($i)]; //单注
            $eList = $_POST['e' . ($i)]; //单期

            if (!Matchs::isFloating($aList) || !Matchs::isFloating($bList) || !Matchs::isFloating($cList) || !Matchs::isFloating($dList) || !Matchs::isFloating($eList))
                exit(back('輸入的數值錯誤！' . $i));
            if ($usersModel[0]['g_login_id'] != 56) {
                if ($aList < $LdetList[$i][3] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][3] . '---' . (100)));
                if ($bList < $LdetList[$i][4] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][4] . '---' . (100)));
                if ($cList < $LdetList[$i][5] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][5] . '---' . (100)));
                if ($dList > $LdetList[$i][6] || $dList < 0) exit(back($LdetList[$i][2] . ' 最高單註限額設置為：' . $LdetList[$i][6] . '---' . (0)));
                if ($eList > $LdetList[$i][7] || $eList < 0) exit(back($LdetList[$i][2] . ' 最高單期限額設置為：' . $LdetList[$i][7] . '---' . (0)));
            }
            if ($aList > $LdetList[$i][3]) {
                //取A盘
                $LdetList[$i][3] = $aList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'a', $aList);
            }
            if ($bList > $LdetList[$i][4]) {
                //取B盘
                $LdetList[$i][4] = $bList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'b', $bList);
            }
            if ($cList > $LdetList[$i][5]) {
                //取C盘
                $LdetList[$i][5] = $cList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'c', $cList);
            }

            //修改退水
            $sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList[$i][2]}' AND g_game_id = '{$LdetList[$i][8]}' LIMIT 1";
            $db->query($sql, 2);
        }
        //print_r($LdetList);
        //exit;
        //exit(alert_href('更變成功', 'Actfor.php?cid='.$_GET['cid']));
    } else {
        exit(alert_href('用戶不存在', 'Actfor.php?cid=' . $_GET['cid']));
    }
}

//todo:占成还有问题
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');
        });
    </script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/Manage/temp/js/common.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height: 323px">


<div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
<div id="member" class="member">
<div class="title"><span id="account_name">新增<?php echo $Rank[1] == "总公司" ? "分公司" : $Rank[1]; ?>
            </span>上级<span id="superior"><?php echo $top_name ?></span><a href="Actfor.php?cid=<?php echo $cid ?>"
                                                                          id="reback" level="1"
                                                                          class="mag-btn1">返回</a></div>
<?php
if ($cid == 5) {
$sid = 2;
$top_rank_name = $userModel->Get_rank_from_name($top_name);

    if ($top_rank_name == "代理") {
        $sid = 1;
    }
?>

<form method="post" action="Account_Member.php?cid=<?php echo $cid ?>&actions=add&sid=<?php echo $sid?>">
<?php } else { ?>
<form method="post" action="?cid=<?php echo $cid ?>&actions=add">
<?php } ?>
<input type="hidden" name='s' value="<?php echo $top_name ?>"/>
<table class="clear-table base-info">
    <caption>
        <div>基本资料</div>
    </caption>
    <tbody>
    <tr>
        <th>名称</th>
        <td><input autocomplete="off" name="s_F_Name" type="text" vname="name"
                   vmessage="由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"
                   value=""></td>
        <th>账号</th>
        <td><input autocomplete="off" name="s_Name" type="text" vname="account"
                   vmessage="账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线！" value="" class="">
        </td>
        <th>密码</th>
        <td><input autocomplete="off" name="s_Pwd" type="password" vname="password"
                   vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
        <th>确认密码</th>
        <td class="error-info"><input autocomplete="off" name="repassword" type="password"
                                      vname="repassword" vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
    </tr>
    <tr>
        <th>总信用额度</th>
        <td><input autocomplete="off" type="text" name="s_money" maxlength="9" vname="credit"
                   vmessage="10000~47000" title="10000~47000" value="0"></td>
        <th>所属盘口</th>
        <td><select name="s_pan">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
        </select>？？盘</td>
        <th>状态</th>
        <td><select name="lock">
                <option value="3"
                    >停用
                </option>
                <option value="2"
                    >停押
                </option>
                <option value="1"
                        selected="selected"
                    >启用
                </option>
            </select></td>
        <th>对此<?php echo $Rank[1] ?>的实际占成数(%)</th><?php //TODO:占成需要理清一下?>
        <td>
            <div class="share_up_div">
                <select name="s_size_ky" type="text" maxlength="3" vname="share_up" value="0">
                    <option value="0">0</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="35">35</option>
                    <option value="40">40</option>
                    <option value="45">45</option>
                    <option value="50">50</option>
                    <option value="55">55</option>
                    <option value="60">60</option>
                    <option value="65">65</option>
                    <option value="70">70</option>
                    <option value="75">75</option>
                    <option value="80">80</option>
                    <option value="85">85</option>
                    <option value="90">90</option>
                </select>
            </div>
        </td>
    </tr>
    <tr>

        <th>倍数投注</th>
        <td><label for="beishu_set1"><input id="beishu_set1" value="true" name="beishu_set"
                                            type="radio">允许</label><label
                for="beishu_set2"><input id="beishu_set2" value="false" name="beishu_set" type="radio"
                                         checked="">不允许</label></td>
        <th><span class="set_water_t">退水设定</span></th>
        <td id="set_water_td"><select name="set_water" onchange="water_setting(this.value)">
                <option selected="" value="0">水全退到底</option>
                <option value="100">赚取所有退水</option>
                <option value="0.05">赚取0.05%退水</option>
                <option value="0.1">赚取0.1%退水</option>
                <option value="0.15">赚取0.15%退水</option>
                <option value="0.2">赚取0.2%退水</option>
                <option value="0.25">赚取0.25%退水</option>
                <option value="0.3">赚取0.3%退水</option>
            </select></td>
        <th></th>
        <td></td>
        <th></th>
        <td></td>
    </tr>
    <tr id="set_water_tr" style="display: none;">
        <th><span class="set_water_t" style="display: none;">退水设定</span></th>
        <td id="set_water_td"></td>
        <th></th>
        <td></td>
        <th></th>
        <td></td>
        <th></th>
        <td></td>
    </tr>
    </tbody>
</table>
<table class="general_info games_info" id="general_info"><!-- 快速设置-->
    <tbody id="general ">
    <tr>
        <td class="game-flag" colspan="8">
            <div>大项快速设置（注意：设置高于上级最高限制时按最高可调）??</div>
            <p class="reder game-tip">*占成、退水修改后，第二天新开期才能生效。下级会员当日没下注注单，修改占成、退水即时生效！</p></td>
    </tr>
    <tr class="games_head">
        <td width="400px">调整项目</td>
        <td>单注最低</td>
        <td>单注最高</td>
        <td>单项最高</td>
        <td>A盘(%)</td>
        <td>B盘(%)</td>
        <td>C盘(%)</td>
        <td>操作</td>
    </tr>
    <tr>
        <th>单码项（1~8单码、1~5单码、冠亚，3~10单码...）</th>
        <td><span class="playColor bBlue">&nbsp;</span><input name="general00" vname="generalordermin00"
                                                              autocomplete="off" maxlength="9" type="text"
                                                              style="margin-top:4px;_margin-top:2px;_"
                                                              value="2"></td>
        <td><input name="general00" vname="generalordermax00" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general00" vname="generalitem00" autocomplete="off" maxlength="9" type="text"
                   value="50000"></td>
        <td>
            <div class="spaning"><input name="general00" value="0.6" vname="generaldiscountA00" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="1.6" vname="generaldiscountB00" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="2.6" vname="generaldiscountC00" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g00" type="button">修改</button>
        </td>
    </tr>
    <tr>
        <th>两面项（1~8两面，1~10两面、龙虎、三军…）</th>
        <td><span class="playColor bZise">&nbsp;</span><input name="general08" vname="generalordermin08"
                                                              autocomplete="off" maxlength="9" type="text"
                                                              style="margin-top:4px;_margin-top:2px;_"
                                                              value="2"></td>
        <td><input name="general08" vname="generalordermax08" autocomplete="off" maxlength="9" type="text"
                   value="100000"></td>
        <td><input name="general08" vname="generalitem08" autocomplete="off" maxlength="9" type="text"
                   value="200000"></td>
        <td>
            <div class="spaning"><input name="general08" value="0.6" vname="generaldiscountA08" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general08" value="1.6" vname="generaldiscountB08" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general08" value="2.6" vname="generaldiscountC08" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g01" type="button">修改</button>
        </td>
    </tr>
    <tr>
        <th>连码项（任选二、任选三、围骰、长牌…）</th>
        <td><span class="playColor bGreen">&nbsp;</span><input name="general18" vname="generalordermin18"
                                                               autocomplete="off" maxlength="9" type="text"
                                                               style="margin-top:4px;_margin-top:2px;_"
                                                               value="2"></td>
        <td><input name="general18" vname="generalordermax18" autocomplete="off" maxlength="9" type="text"
                   value="2000"></td>
        <td><input name="general18" vname="generalitem18" autocomplete="off" maxlength="9" type="text"
                   value="5000"></td>
        <td>
            <div class="spaning"><input name="general18" value="0.6" vname="generaldiscountA18" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general18" value="1.6" vname="generaldiscountB18" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general18" value="2.6" vname="generaldiscountC18" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g02" type="button">修改</button>
        </td>
    </tr>
    <tr>
        <th>杂项（方位、豹子、冠亚和、点数…）</th>
        <td><span class="playColor bRed">&nbsp;</span><input name="general15" vname="generalordermin15"
                                                             autocomplete="off" maxlength="9" type="text"
                                                             style="margin-top:4px;_margin-top:2px;_" value="2">
        </td>
        <td><input name="general15" vname="generalordermax15" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general15" vname="generalitem15" autocomplete="off" maxlength="9" type="text"
                   value="60000"></td>
        <td>
            <div class="spaning"><input name="general15" value="0.6" vname="generaldiscountA15" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general15" value="1.6" vname="generaldiscountB15" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general15" value="2.6" vname="generaldiscountC15" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g03" type="button">修改</button>
        </td>
    </tr>
    </tbody>
</table>
<table class="games_info" id="games_info"><!-- 广东快乐十分 -->
<tbody id="klc">
<tr>
    <td class="game-flag" colspan="15">
        <div>广东快乐十分</div>
    </td>
</tr>
<tr class="games_head">
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
    <td class="games_sp"></td>
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
</tr>
<?php for ($i = 8; $i < 26; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>
        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="klc00" vname="klcordermin00" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="klcordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="klcitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="klcdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="klcdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="klcdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php $i++; ?>
        <?php
        $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
        $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
        $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
        ?>
        <th><span class="playColor bGreen">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="klc18" vname="klcordermin18" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="klcordermax18" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td><input name="e<?php echo $i ?>" vname="klcitem18" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="klcdiscountA18" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="klcdiscountB18" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="klcdiscountC18" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
    </tr>
<?php } ?>
</tbody>
<!-- 重庆时时彩 -->
<tbody id="ssc">
<tr>
    <td class="game-flag" colspan="15">
        <div>重庆时时彩</div>
    </td>
</tr>
<tr class="games_head">
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
    <td class="games_sp"></td>
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
</tr>
<?php for ($i = 31; $i < 39; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>
        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="ssc00" vname="sscordermin00" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="sscordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="sscitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="sscdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="sscdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="sscdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >= 39) {
        } else {
            ?>
            <?php
            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
            ?>
            <th><span class="playColor bRed">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
            <td><input name="ssc05" vname="sscordermin05" autocomplete="off" maxlength="9" type="text" value="0">
            </td>
            <td><input name="d<?php echo $i ?>" vname="sscordermax05" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
            </td>
            <td><input name="e<?php echo $i ?>" vname="sscitem05" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
            </td>
            <td>
                <div class="spaning"><input name="a<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                            vname="sscdiscountA05" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="b<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                            vname="sscdiscountB05" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="c<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                            vname="sscdiscountC05" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
        <?php } //if else end?>
    </tr>

<?php } //for end?>

</tbody>
<!-- 北京赛车 -->
<tbody id="pk10">
<tr>
    <td class="game-flag" colspan="15">
        <div>北京赛车</div>
    </td>
</tr>
<tr class="games_head">
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
    <td class="games_sp"></td>
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
</tr>
<?php for ($i = 60; $i < 68; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>

        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="pk1000" vname="pk10ordermin00" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="pk10ordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="pk10item00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="pk10discountA00" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="pk10discountB00" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="pk10discountC00" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php $i++; ?>
        <?php
        $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
        $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
        $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
        ?>
        <th><span class="playColor bZise">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="pk1013" vname="pk10ordermin13" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="pk10ordermax13" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="pk10item13" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="pk10discountA13" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="pk10discountB13" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="pk10discountC13" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
    </tr>
<?php }//北京赛车for end ?>

</tbody>
<!--幸运农场-->
<tbody id="nc">
<tr>
    <td class="game-flag" colspan="15">
        <div>幸运农场</div>
    </td>
</tr>
<tr class="games_head">
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
    <td class="games_sp"></td>
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
</tr>
<?php for ($i = 123; $i < 136; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>

        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="nc00" vname="ncordermin00" autocomplete="off" maxlength="9" type="text" value="2"></td>
        <td><input name="d<?php echo $i ?>" vname="ncordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td><input name="e<?php echo $i ?>" vname="ncitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="ncdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="ncdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="ncdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <!-- <td class="games_sp"></td><th>动物单选</th><td><input name="nc19" vname="ncordermin19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncordermax19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncitem19" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountA19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountB19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountC19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td> -->
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >= 136) {
        } else {

            ?>
            <?php
            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
            ?>
            <th><span class="playColor bGreen">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
            <td><input name="nc20" vname="ncordermin20" autocomplete="off" maxlength="9" type="text" value="2"></td>
            <td><input name="d<?php echo $i ?>" vname="ncordermax20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
            </td>
            <td><input name="e<?php echo $i ?>" vname="ncitem20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
            <td>
                <div class="spaning"><input name="a<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                            vname="ncdiscountA20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="b<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                            vname="ncdiscountB20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="c<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                            vname="ncdiscountC20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
        <?php }//if else end?>
    </tr>
<?php } //for end?>

<!--   <tr><th>果蔬单选</th><td><input name="nc18" vname="ncordermin18" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc18" vname="ncordermax18" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc18" vname="ncitem18" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc18" value="0.0" vname="ncdiscountA18" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc18" value="0.0" vname="ncdiscountB18" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc18" value="0.0" vname="ncdiscountC18" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td></tr> -->
</tbody>
<tbody id="ks">
<tr>
    <td colspan="15" class="game-flag">
        <div>江苏骰宝</div>
    </td>
</tr>

<tr class="games_head">
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
    <td class="games_sp"></td>
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
</tr>
<?php for ($i = 162; $i < 166; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>
        <th><span class="playColor bZise">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="nc00" vname="ncordermin00" autocomplete="off" maxlength="9" type="text" value="2"></td>
        <td><input name="d<?php echo $i ?>" vname="ncordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td><input name="e<?php echo $i ?>" vname="ncitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="ncdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="ncdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="ncdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <!-- <td class="games_sp"></td><th>动物单选</th><td><input name="nc19" vname="ncordermin19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncordermax19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncitem19" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountA19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountB19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountC19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td> -->
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >= 166) {
        } else {

            ?>
            <?php
            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
            ?>
            <th><span class="playColor bGreen">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
            <td><input name="1" vname="ncordermin20" autocomplete="off" maxlength="9" type="text" value="2"></td>
            <td><input name="d<?php echo $i ?>" vname="ncordermax20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
            </td>
            <td><input name="e<?php echo $i ?>" vname="ncitem20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
            <td>
                <div class="spaning"><input name="a<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                            vname="ncdiscountA20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="b<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                            vname="ncdiscountB20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="c<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                            vname="ncdiscountC20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
        <?php }//if else end?>
    </tr>
<?php } ?>
</tbody>
</table>
<div class="btn-line"><input type="submit" class="yellow-btn" id="submit" value="确定"/>
    <input
        type="reset" class="white-btn" id="reset"/></div>
</form>
</div>
</div>
</div>
</body>
</html>