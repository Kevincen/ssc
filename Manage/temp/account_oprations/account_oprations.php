<?php
/**
 * Created by PhpStorm.
 * User: 2b
 * Date: 14-1-11
 * Time: 下午12:37
 */
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'Class/User_formater.php';
include_once ROOT_PATH . 'Class/Lang.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    exit();
} else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $cid = $_GET['cid'];
    $top_cid = $_GET['top_cid'];
    $action = $_GET['action'];
    $top_account_id = $_GET['top_account_id'];

    if ($action == 'update') {
        $my_account_id = $_GET['my_account_id'];
        $op_str = '修改';
    } else if ($action == 'add') {
        $my_account_id = '';
        $op_str = '新增';
    } else {
        echo 'wrong action';
        exit;
    }

    $this_module = new User_info($my_account_id,$cid,$top_account_id);
    $top_module =  new User_info($top_account_id,$top_cid);
    $this_module->get_from_db();
    $top_module->get_from_db();
}
$lang = new utf8_lang();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/Manage/temp/js/common.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var win_height = window.innerHeight;
            $("#layout").css('height',win_height+'px');

        });
    </script>
    <script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height:358px;">


<div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
<div id="member" class="member">
<div class="title">
    <span id="account_name"><?php echo $op_str?><?php echo $this_module->rank_name ?><?php echo $this_module->my_account_id ?>
            </span>上级<span id="superior"><?php echo $top_module->rank_name.':'.$top_module->my_account_id ?></span>
    <a href="../Actfor.php?cid=<?php echo $cid ?>" id="reback" level="1" class="mag-btn1">返回</a></div>
<form method="post" action="?action=update&cid=<?php echo $cid ?>&uid=<?php echo $uid ?>">
<table class="clear-table base-info">
    <caption>
        <div>基本资料</div>
    </caption>
    <tbody>
    <tr>
        <th>名称</th>
        <td><input autocomplete="off" name="s_F_Name" type="text" vname="name"
                   vmessage="由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"
                   value="<?php echo $this_module->my_name ?>"></td>
        <th>账号</th>
        <td><input autocomplete="off" name="name" type="text" vname="account" readonly
                   vmessage="账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线！" value="<?php echo $this_module->my_account_id ?>" class="">
        </td>
        <th>密码</th>
        <td><input autocomplete="off" name="s_Pwd" type="password" vname="password"
                   vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
        <th>确认密码</th>
        <td class="error-info"><input autocomplete="off" name="repassword" type="password"
                                      vname="repassword" vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
    </tr>
    <?php
    if ($this_module->cid == '5') {
        include_once "./account_edit_interface_memenber.php";
    } else {
        include_once "./account_edit_interface_user.php";
    }
    ?>
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
    <?php
    if ($cid != 5) {
       $P = $this_module->panlu;
    } else {
       $P = 'ABC';
    }
    ?>
    <tr>
        <th>单码项（1~8单码、1~5单码、冠亚，3~10单码...）</th>
        <td><span class="playColor bBlue">&nbsp;</span>
            <input name="general00" vname="general_bBlue_ordermin" autocomplete="off" maxlength="9" type="text"
                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
        <td><input name="general00" vname="general_bBlue_ordermax" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general00" vname="general_bBlue_itemmax" autocomplete="off" maxlength="9" type="text"
                   value="50000"></td>
        <td>
            <div class="spaning">
                <input name="general00" value="0.6" vname="general_bBlue_A" type="text"
                       minvalue="0" maxvalue="100"
                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>

                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="1.6" vname="general_bBlue_B" type="text"
                                        minvalue="0" maxvalue="100"
                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="2.6" vname="general_bBlue_C" type="text"
                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="bBlue" type="button" onclick="change_input_by_color($(this))">修改</button>
        </td>
    </tr>
    <tr>
        <th>两面项（1~8两面，1~10两面、龙虎、三军…）</th>
        <td><span class="playColor bZise">&nbsp;</span>
            <input name="general00" vname="general_bZise_ordermin" autocomplete="off" maxlength="9" type="text"
                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
        <td><input name="general00" vname="general_bZise_ordermax" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general00" vname="general_bZise_itemmax" autocomplete="off" maxlength="9" type="text"
                   value="50000"></td>
        <td>
            <div class="spaning"><input name="general00" value="0.6" vname="general_bZise_A" type="text"
                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                <a href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="1.6" vname="general_bZise_B" type="text"
                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                <a href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="2.6" vname="general_bZise_C" type="text"
                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="bZise" type="button" onclick="change_input_by_color($(this))">修改</button>
        </td>
    </tr>
    <tr>
        <th>连码项（任选二、任选三、围骰、长牌…）</th>
        <td><span class="playColor bGreen">&nbsp;</span>
            <input name="general00" vname="general_bGreen_ordermin" autocomplete="off" maxlength="9" type="text"
                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
        <td><input name="general00" vname="general_bGreen_ordermax" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general00" vname="general_bGreen_itemmax" autocomplete="off" maxlength="9" type="text"
                   value="50000"></td>
        <td>
            <div class="spaning"><input name="general00" value="0.6" vname="general_bGreen_A" type="text"
                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="1.6" vname="general_bGreen_B" type="text"
                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="2.6" vname="general_bGreen_C" type="text"
                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="bGreen" type="button" onclick="change_input_by_color($(this))">修改</button>
        </td>
    </tr>
    <tr>
        <th>杂项（方位、豹子、冠亚和、点数…）</th>
        <td><span class="playColor bRed">&nbsp;</span>
            <input name="general00" vname="general_bRed_ordermin" autocomplete="off" maxlength="9" type="text"
                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
        <td><input name="general00" vname="general_bRed_ordermax" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general00" vname="general_bRed_itemmax" autocomplete="off" maxlength="9" type="text"
                   value="50000"></td>
        <td>
            <div class="spaning"><input name="general00" value="0.6" vname="general_bRed_A" type="text"
                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="1.6" vname="general_bRed_B" type="text"
                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="2.6" vname="general_bRed_C" type="text"
                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="bRed" type="button" onclick="change_input_by_color($(this))">修改</button>
        </td>
    </tr>
    </tbody>
</table>
<table class="games_info" id="games_info"><!-- 广东快乐十分 -->
    <?php
    $color_array = $this_module->color_array;
    $type_name = '广东快乐十分';
    $sub_array = $this_module->klc_array;
    include './account_inter_face.php'
    ?>
    <?php
    $type_name = '重庆时时彩';
    $sub_array = $this_module->ssc_array;
    include './account_inter_face.php'
    ?>
    <?php
    $type_name = '北京赛车';
    $sub_array = $this_module->pk10_array;
    include './account_inter_face.php'
    ?>
    <?php
    $type_name = '幸运农场';
    $sub_array = $this_module->nc_array;
    include './account_inter_face.php'
    ?>
    <?php
    $type_name = '江苏骰宝';
    $sub_array = $this_module->jstb_array;
    include './account_inter_face.php'
    ?>
    <!-- 重庆时时彩 -->
</table>
<div class="btn-line"><input type="submit" class="yellow-btn" id="submit"  value="确定" />
    <input
        type="reset" class="white-btn" id="reset" /></div>
</form>
</div>
</div>
</div>
</body>
</html>

