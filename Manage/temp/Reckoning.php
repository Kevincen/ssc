<?php
if (!isset($_GET['tid'])) exit;
$tid = $_GET['tid'];
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <title></title>
</head>
<body class="skin_red">
<div id="layout" class="container" style="height: 485px;">
    <div dom="left" class="sidebar" style="display: none;"></div>
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: block;">
        <div id="supervision_nav" class="supervision_nav sv_nav_klc klc"><p class="today_info"><strong>今天输赢：<span
                        id="win" class=" bold">0</span></strong><strong>【<span class="dgreen2 letter_space3 bold"
                                                                               id="timesnow">2014021746</span>】<span
                        class="ggray">期</span> &nbsp;&nbsp;&nbsp;距离封盘：<span class="bluer letter_space2 bold"
                                                                            id="timecloseklc" nc="273">04:33</span>&nbsp;&nbsp;&nbsp;距离开奖：<span
                        class="reder letter_space2" id="timeopenklc" nc="353">05:53</span></strong><strong
                    class="resultnum-str">【<span class="bluer letter_space3 bold" id="timesold">2014021745</span>】<span
                        class="ggray">期</span>&nbsp;&nbsp;&nbsp;开奖号码：<span class="reder resultnum" id="resultnum"><span
                            class="number num4"></span><span class="number num2"></span><span
                            class="number num3"></span><span class="number num14"></span><span
                            class="number num13"></span><span class="number num15"></span><span
                            class="number num7"></span><span class="number num10"></span></span></strong></p>
            <ul>
                <li class="red" onclick="Actfor_load('/Manage/temp/oddsFile.php')" id="sumDT">
                    正码-总和
                </li>
                <li class="red <?php echo $types != '第一球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=1')"
                    id="ball1">第一球
                </li>
                <li class="red <?php echo $types != '第二球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=2')"
                    id="ball2">第二球
                </li>
                <li class="red <?php echo $types != '第三球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=3')"
                    id="ball3">第三球
                </li>
                <li class="red <?php echo $types != '第四球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=4')"
                    id="ball4">第四球
                </li>
                <li class="red <?php echo $types != '第五球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=5')"
                    id="ball5">第五球
                </li>
                <li class="red <?php echo $types != '第六球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=6')"
                    id="ball6">第六球
                </li>
                <li class="red <?php echo $types != '第七球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=7')"
                    id="ball7">第七球
                </li>
                <li class="red <?php echo $types != '第八球'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile.php?cid=8')"
                    id="ball8">第八球
                </li>
                <li class="red <?php echo $types != '连码'?'':'active'?>" onclick="Actfor_load('/Manage/temp/oddsFile_LM.php?cid=10')"
                    id="evenCode">连码
                </li>
                <li class="red active" id="lizhangdan">账单</li>
            </ul>
        </div>
    </div>
    <div dom="main" class="main-content1">
        <div id="supervision" class="supervision klc supervision-klc">
            <div id="zhangdan" style="display: block;">
                <div class="zhangdan_zjs">
                    <table class="bet-table z3-table" style="table-layout:auto">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>项目</th>
                            <th>操作说明</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($tid == 1){?>
                            <tr >
                                <td>1</td>
                                <td>广东快乐十分第1~8球、总和、龙虎投注汇总表</td>
                                <td>封盘后（摇奖前）备份</td>
                                <td><a href="Reckoning_l.php?tid=1&cid=1"  target="_blank">打开</a></td>
                            </tr>
                            <tr >
                                <td>2</td>
                                <td>广东快乐十分連碼（注單明細）</td>
                                <td>封盘后（摇奖前）备份</td>
                                <td><a href="Reckoning_l.php?tid=1&cid=2"  target="_blank">打开</a></td>
                            </tr>
                        <?php } else  if($tid == 3){
                            ?>
                            <tr >
                                <td>1</td>
                                <td>第1~5球、總和、龍虎投注匯總表</td>
                                <td>封盘后（摇奖前）备份</td>
                                <td><a href="Reckoning_l.php?tid=3&cid=1"  target="_blank">打开</a></td>
                            </tr>
                            <tr >
                                <td>2</td>
                                <td>連碼（注單明細）</td>
                                <td>封盘后（摇奖前）备份</td>
                                <td><a href="Reckoning_l.php?tid=3&cid=2"  target="_blank">打开</a></td>
                            </tr>
                        <?php
                        }else if ($tid == 2){?>
                            <tr >
                                <td>1</td>
                                <td>所有投注匯總表</td>
                                <td>封盘后（摇奖前）备份</td>
                                <td><a href="Reckoning_l.php?tid=2&cid=1"  target="_blank">打开</a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <div><font color="red">*账单校对公式：（总投注额-会员赢项目总投注额）-总退水-和局无交收水钱-输赢金额=实际输赢金额</font></div>
                </div>
            </div>
            </div>
    </div>
    <!--main content--></div>
<div style="display:none">


</body>
</html>