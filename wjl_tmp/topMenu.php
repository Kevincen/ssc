<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;

$news = null;
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_rank_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
    $news = strip_tags($text[0][0]);
}
$name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
//url地址
//账号管理
//TODO:原网站代理的信用余额是根据不同彩票不同的，咱们的没有
$account_url = "Actfor.php";
//现场监督默认地址
$xcjd_url = "oddsFile.php";
//收付统计
$bill_url = 'Reckoning.php';
//报表
$digram_url = "Report_Center.php";
//开奖结果
$result_url = "Lottery_Result.php";
//系统设定
$setting_url = "AutoLet.php";
//个人咨询
$grzx_url = "CreditInfo.php";
//游戏规则
$gamerule_url = "";
//密码变更
$password_url = "UpdatePwd.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>顶部盗版代码</title>
    <link rel="stylesheet" href="./steal.css"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/sc.js"></script>
    <script type="text/javascript">
        var targetphp = new Array();
        var target = "mainFrame";
        //重庆时时彩
        targetphp[2] = "oddsFilecq.php";
        //广东快乐十分
        targetphp[1] = "oddsFile.php";
        //北京赛车
        targetphp[6] = "oddsFilepk.php";
        //幸运农场
        targetphp[5] = "oddsFilenc.php";
        //江苏shaibao
        targetphp[9] = "oddsFilejsk3.php";
        var bill_url = <?php echo $bill_url?>;
        var xtsd_url = <?php echo $setting_url?>;
        var result_url = <?php echo $result_url?>;
        var grzx_url = <?php $grzx_url?>;
        <?php
        //TODO:current_col
        ?>
        //@param id html标签id
        function selectType(p_type){
            var current_col_id = ;
            var url = targetphp[p_type];
            if(current_col == "ZHGL") {
                $('#XCJD').attr('href',url);
                $('#SFTJ').attr('href',bill_url + "?tid=" + p_type);
                $('#KJGL').attr('href',result_url + "?tid=" + p_type);
                $('#XTSD').attr('href',xtsd_url + "?tid=" + p_type);
                $('#GRZX').attr('href',grzx_url + "?tid=" + p_type);
            }
        }
        $(document).ready(function() {
            selectType(1);
        })
    </script>
</head>
<body id="bodyModule">
<div class="header" id="header">
    <div class="logo">
        <img width="120" src="/page/WebLogo_163.jpg">
    </div>
    <!--用户信息 开关盘-->
    <div class="header-op">
        <div class="top-op" id="select_sys">
            <p class="left"></p>
            <span><a href="javascript:void(0)" class="switch switch-on" id="klc_sys" onclick="selectType(1)">
                    广东快乐十分<b></b></a>
            </span>
            <span><a href="javascript:void(0)" class="switch" id="ssc_sys" onclick="selectType(2)">重庆时时彩<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="pk10_sys" onclick="selectType(6)">北京赛车<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="nc_sys" onclick="selectType(5)">幸运农场<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="ks_sys" onclick="selectType(9)">江苏骰宝<b></b></a></span>
            <span class="split gray">|</span>
        <?php
        //TODO:ONLINE COUNT
        if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])) {
        ?>
            <span class="blue bold">在线：<span class="yel2" id="online_num">1</span></span>
        <?php } else if (isset($Users[0]['g_lock_1']) && $Users[0]['g_lock_1'] == 1) { ?>
            <span class="blue bold">在线：<span class="yel2" id="online_num">1</span></span>
        <?php } ?>
            <div class="right gray"><?php echo $Users[0]['g_Lnid'][0] . '：' . $name ?>
                <span class="user_logo"></span>账号：<span id="member_id"><?php echo $name ?></span>,<span id="role">
                    <?php echo $Users[0]['g_Lnid'][0] . '：' . $name ?>
                </span>
                <a href="klc/logout" id="logout" class="logout-link">退出</a>
            </div>
        </div>
        <div class="marquee">
            <p class="left"></p>

            <p class="marqueeBox">
                <marquee id="marqueeBox" scrollamount="2" onmouseout="this.start()" onmouseover="this.stop()" >
                    <?php echo $news?>
                </marquee>
            </p>
					<span class="kefu_announce">
                        <?php //TODO:更多不对?>
                    <a href="News.aspx" class="more more_announcement">更多</a>&nbsp;
					|
                        <?php //TODO:线路选择？?>
					<a id="lineSelect" href="javascript:void(0)"><img src="/webssc/images/lineSelect.png" width="77"
                                                                      height="18" border="0" alt="Live Help"></a>&nbsp;
										</span>
            <span id="marqueeRefresh" class="hidden">17</span>
        </div>
    </div>
    <!--用户信息 开关盘 end-->

    <div class="main-nav">
        <ul>
            <li id="ZHGL" style="display: list-item;" class=""><a nav="account_nav" href="<?php echo $account_url?>" target="mainFrame">账号管理</a>
            </li>
            <li id="XCJD" style="display: none;"><a nav="supervision" href="javascript:void(0)" target="mainFrame">现场监督</a></li>
            <li id="SFTJ" style="display: list-item;" class=""><a nav="supervision" href="<?php echo $xcjd_url ?>" target="mainFrame">现场监督</a>
            </li>
            <li id="SFTJ" style="display: list-item;" class=""><a nav="tongji" href="<?php echo $bill_url ?>" target="mainFrame">收付统计</a></li>
            <li id="CPJL" style="display: none;"><a nav="operationRecord" href="javascript:void(0)" target="mainFrame">操盘记录</a></li>
            <li id="BACX" style="display: list-item;" class="on"><a nav="reportForm" href="<?php echo $digram_url?>" target="mainFrame">报表</a>
            </li>

            <li id="QSGL" style="display: none;"><a nav="timeManage" href="javascript:void(0)" target="mainFrame">期数管理</a></li>
            <li id="KJGL" style="display: list-item;" class=""><a nav="result" href="<?php echo $result_url ?>" target="mainFrame">开奖结果</a></li>
            <li id="XTSD" style="display: list-item;" class=""><a nav="seting" href="<?php echo $setting_url ?>" target="mainFrame">系统设定</a></li>
            <!--<li   show='ZDGL'> <a nav="statusmanage" href="javascript:void(0)">注单管理</a> </li>-->
            <li style="display: list-item;" class=""><a nav="infop" href="<?php echo $grzx_url ?>" target="mainFrame">个人资讯</a></li>
            <?php //TODO 这个页面需要添加?>
            <li style="display: list-item;" class=""><a nav="rule" href="<?php echo $gamerule_url?>" title="" target="mainFrame">游戏规则</a></li>
            <li style="display: list-item;" class=""><a nav="changePassword" href="<?php echo $password_url?>" title="" target="mainFrame">密码变更</a>
            </li>
        </ul>
    </div>

</div>
</body>
</html>