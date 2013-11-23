<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'function/opNumberList.php';

$head_number = 0; //顶部球号数量
if (!isset($_GET['date'])) {
    $date = date('Y-m-d');
} else {
    $date = $_GET['date'];
}
//$date_qshu = preg_replace('/-/i', '', $date);
if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2 || $_GET['tid'] == 2) {
    //加載重慶
    $numberList = numberList(2, $date);
    $GameType = 2;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3 || $_GET['tid'] == 3) {
    //加載广西
    $numberList = numberList(3, $date);
    $GameType = 3;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 5 || $_GET['tid'] == 5) {
    //加載农场
    $numberList = numberList(5, $date);
    $GameType = 5;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6 || $_GET['tid'] == 6) {
    //加載PK10
    $numberList = numberList(6, $date);
    $GameType = 6;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 7 || $_GET['tid'] == 7) {
    //六合彩
    $numberList = numberList(7, $date);
    $GameType = 7;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 8 || $_GET['tid'] == 8) {
    //新疆時時彩
    $numberList = numberList(8, $date);
    $GameType = 8;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 9 || $_GET['tid'] == 9) {
    //江苏骰寶(快3)
    $numberList = numberList(9, $date);
    $GameType = 9;
} else {
    $numberList = numberList(1, $date);
    $GameType = 1;
}
//$page = $numberList['page'];
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');


            set_ball_in_top($('#timesSelect').attr('value'));
        });
    </script>
    <title></title>
</head>
<body>
<div style="display:none">
    <script language="javascript" type="text/javascript"
            src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<div id="layout" class="container" style="height: 539px;">
<div dom="left" class="sidebar" style="display: none;"></div>
<div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
<!--bet content-->
<div dom="main_nav" class="main-content1" style="display: none;"></div>
<div dom="main" class="main-content1">
<?php
$noresult_html = '';
switch ($GameType) {
    case 1:
        echo
        ' <div id="result_klc" class="result klc" tmp="result_klc"> ';
        break;
    case 2:
        echo
        ' <div id="result_ssc" class="result klc" tmp="result_ssc"> ';
        break;
    case 6:
        echo
        ' <div id="result_pk10" class="result pk10" tmp="result_pk10"> ';
        break;
    case 5:
        echo
        ' <div id="result_nc" class="result nc" tmp="result_nc"> ';
        break;
    case 9:
        echo
        ' <div id="result_ks" class="result ks" tmp="result_ks"> ';
        break;
}?>
<script type="text/javascript">
    function Lottery_Load(typeid)
    {
        var url = "Lottery_Result.php?tid=" + typeid;
        Actfor_load(url);
    }
</script>
<h3 class="lh2"
    style="color:#063863;margin-bottom: 4px;"><b
        class="reder"></b>开奖结果管理</h3><select id="topSelect_klc" class="topSelect"
                                             onchange=" Lottery_Load(this.value)">
    <option value="1" <?php if ($GameType == 1) echo 'selected="selected"' ?> >广东快乐十分</option>
    <option value="2" <?php if ($GameType == 2) echo 'selected="selected"' ?>>重庆时时彩</option>
    <option value="6" <?php if ($GameType == 6) echo 'selected="selected"' ?>>北京赛车(PK10)</option>
    <option value="5" <?php if ($GameType == 5) echo 'selected="selected"' ?>>幸运农场</option>
    <option value="9" <?php if ($GameType == 9) echo 'selected="selected"' ?>>江苏骰宝</option>
</select>
<?php ?>
<table class="bet-table z3-table td-cd" id="tableform">
    <thead>
    <tr>
        <th>开奖日期</th>
        <th>期数</th>
        <?php if ($GameType == 1 || $GameType == 5) { //快乐十分+幸运农场
            $head_number = 8
            ?>
            <th>第一球</th>
            <th>第二球</th>
            <th>第三球</th>
            <th>第四球</th>
            <th>第五球</th>
            <th>第六球</th>
            <th>第七球</th>
            <th>第八球</th>
        <?php
        } elseif ($GameType == 2) { //时时彩
            $head_number = 5
            ?>
            <th>第一球</th>
            <th>第二球</th>
            <th>第三球</th>
            <th>第四球</th>
            <th>第五球</th>
        <?php
        } elseif ($GameType == 6) { //北京赛车
            $head_number = 10
            ?>
            <th>冠军</th>
            <th>亚军</th>
            <th>第三名</th>
            <th>第四名</th>
            <th>第五名</th>
            <th>第六名</th>
            <th>第七名</th>
            <th>第八名</th>
            <th>第九名</th>
            <th>第十名</th>
        <?php
        } elseif ($GameType == 9) {
            $head_number = 3
            ?>
            <th colspan="3">开出筛子</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td id=""><input id="dateSelect_klc" type="text" value="<?php echo $date ?>"
                         onfocus="WdatePicker({
                             el:'dateSelect_klc',
                             onpicked:function(){Actfor_load('Lottery_Result.php?tid=<?php echo $GameType ?>&date='+this.value)}
                             });"></td>
        <!--                         onPropertyChange="Actfor_load('Lottery_Result.php?tid=<?php /*echo $GameType */?>&date='+this.value)"-->
        <td><select id="timesSelect" onchange="set_ball_in_top(this.value)" >
                <!--               这里只会把当天的写在这里。 -->
                <?php
                for ($i = 0; $i < count($numberList) - 1; $i++) {
                    ?>
                    <option
                        <?php if ($i == 0) {
                            echo 'selected="selected"';
                        }?>
                        value="<?php echo $numberList[$i][1] ?>"><?php echo $numberList[$i][1] ?></option>
                <?php } ?>
            </select></td>
        <?php
        if (!$numberList) { //顶部球号
            echo '<td colspan="' . $head_number . '">暂无数据</td>';
        } else {
            for ($i = 0; $i < $head_number; $i++) {
                echo '<td class="qiuhao"></td>';
            }
            //for end
        } //ifelse end
        ?>
    </tr>
    </tbody>
</table>
<table class="bet-table z3-table" id="klsf_form">
    <thead>
    <?php
    $noresult_html = '';
    switch ($GameType) {
        case 1:
            echo
            '<tr>
                <th>期数</th>
                <th>开奖时间</th>
                <th colspan="8">开奖号码</th>
                <th colspan="4">总和</th>
                <th colspan="4">1~4龙虎????</th>
            </tr>';
            $noresult_html = '<td colspan="18">暂无数据!</td>';
            break;
        case 2:
            echo
            '<tr class=""><th>期数</th><th>开奖时间</th><th colspan="5">开奖号码</th><th colspan="3">总和</th><th>龙虎</th><th>前三</th><th>中三</th><th>后三</th></tr>';
            $noresult_html = '<td colspan="14">暂无数据！</td>';
            break;
        case 6:
            echo
            '<tr class=""><th>期数</th><th>开奖时间</th><th colspan="10">开奖号码</th><th colspan="3">冠亚和</th><th>冠军</th><th>亚军</th><th>第三名</th><th>第四名</th><th>第五名</th></tr>';
            $noresult_html = '<td colspan="20">暂无数据！</td>';
            break;
        case 5:
            echo
            '<tr class=""><th>期数</th><th>开奖时间</th><th colspan="8">开奖号码</th><th colspan="4">总和</th><th colspan="4">1~4龙虎??-家禽野兽-</th></tr>';
            $noresult_html = '<td colspan="18">暂无数据！</td>';
            break;
        case 9:
            echo
            '<tr class=""><th>期数</th><th>开奖时间</th><th colspan="3">开出骰子</th><th colspan="2">总和</th></tr>';
            $noresult_html = '<td colspan="15">暂无数据！</td>';
            break;
    }?>

    </thead>
    <tbody>
    <?php
    if (!$numberList) {
        echo $noresult_html;
    } else if ($GameType == 1) {
        for ($i = 0; $i < count($numberList) - 1; $i++) {
            ?>
            <tr>
                <td><?php echo $numberList[$i][1] ?></td>
                <td><?php echo $numberList[$i][2] ?></td>
                <!--    <td colspan="8" id="2013111984"><span class="number num7"></span><span
                            class="number num4"></span><span class="number num8"></span><span
                            class="number num1"></span><span class="number num3"></span><span
                            class="number num20"></span><span class="number num11"></span><span
                            class="number num12"></span></td>-->
                <td colspan="8" id="<?php echo $numberList[$i][1] ?>"><?php echo $numberList[$i][3] ?></td>
                <td class="bold"><?php echo $numberList[$i][4] ?></td>
                <td class="bold"><?php echo $numberList[$i][5] ?></td>
                <td class="bold"><span class="reder "><?php echo $numberList[$i][6] ?></span></td>
                <td class="bold"><span class="reder "><?php echo $numberList[$i][7] ?> </span></td>
                <td class="bold"><?php echo $numberList[$i][8] ?></td>
                <td class="bold">虎</td>
                <td class="bold">虎</td>
                <td class="bold">虎</td>
            </tr>
        <?php
        } //for end
    } else if ($GameType == 2) {
        for ($i = 0; $i < count($numberList) - 1; $i++) {
            ?>
            <tr class="">
                <td><?php echo $numberList[$i][1] ?></td>
                <td><?php echo $numberList[$i][2] ?></td>
                <td colspan="5" id="<?php echo $numberList[$i][1] ?>">
                    <?php echo $numberList[$i][3] ?>
                </td>
                <td class="bold"><?php echo $numberList[$i][4] ?></td>
                <td class="bold"><?php echo $numberList[$i][5] ?></td>
                <td class="bold"><?php echo $numberList[$i][6] ?></td>
                <td class="bold"><?php echo $numberList[$i][7] ?></td>
                <td class="bold"><?php echo $numberList[$i][8] ?></td>
                <td class="bold"><?php echo $numberList[$i][9] ?></td>
                <td class="bold"><?php echo $numberList[$i][10] ?></td>
            </tr>
        <?php
        }
    } else if ($GameType == 6) {
        for ($i = 0; $i < count($numberList) - 1; $i++) {
            ?>
            <tr class="">
                <!--                类似395481这样的期数需要特殊处理啊,在用期数取数据库的时候-->
                <td><?php echo $numberList[$i][1] ?></td>
                <td><?php echo $numberList[$i][2] ?></td>
                <td colspan="10" id="<?php echo $numberList[$i][1] ?>">
                    <?php echo $numberList[$i][3] ?>
                </td>
                <td class="bold"><?php echo $numberList[$i][4] ?></td>
                <td class="bold"><?php echo $numberList[$i][5] ?></td>
                <td class="bold"><?php echo $numberList[$i][6] ?></td>
                <td class="bold"><?php echo $numberList[$i][7] ?></td>
                <td class="bold"><?php echo $numberList[$i][8] ?></td>
                <td class="bold"><?php echo $numberList[$i][9] ?></td>
                <td class="bold"><?php echo $numberList[$i][10] ?></td>
                <td class="bold"><?php echo $numberList[$i][11] ?></td>
            </tr>
        <?php
        }
    } else if ($GameType == 5) {
        for ($i = 0; $i < count($numberList) - 1; $i++) {
            ?>
            <tr class="">
                <td><?php echo $numberList[$i][1] ?></td>
                <td><?php echo $numberList[$i][2] ?></td>
                <td colspan="8" id="<?php echo $numberList[$i][1] ?>">
                    <?php echo $numberList[$i][3] ?>
                </td>
                <td class="bold"><?php echo $numberList[$i][4] ?></td>
                <td class="bold"><span class="reder "><?php echo $numberList[$i][5] ?></span></td>
                <td class="bold"><span class="reder "><?php echo $numberList[$i][6] ?></span></td>
                <td class="bold"><span class="reder "><?php echo $numberList[$i][7] ?> </span></td>
                <td class="bold"><?php echo $numberList[$i][8] ?></td>
                <td class="bold"><span class="reder ">龙?? </span></td>
                <td class="bold">虎??</td>
                <td class="bold">虎??</td>
            </tr>
        <?php
        }
    } else if ($GameType == 9) {
        for ($i = 0; $i < count($numberList) - 1; $i++) {
            ?>
            <tr class="">
                <td><?php echo $numberList[$i][1] ?></td>
                <td><?php echo $numberList[$i][2] ?></td>
                <td colspan="3" id="<?php echo $numberList[$i][1] ?>">
                    <?php echo $numberList[$i][3] ?>
                </td>
                <td class="bold"><?php echo $numberList[$i][4] ?></td>
                <td class="bold"><span class="reder "><?php echo $numberList[$i][5] ?></span></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>
</div>
</div>
<!--main content--></div>
</body>
</html>