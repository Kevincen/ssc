<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
include_once ROOT_PATH . 'function/opNumberList.php';
if (isset($_GET['id'])) {
    $typeid = $_GET['id'];
} else {
    if ((isset($_SESSION['cq']) && $_SESSION['cq'] == true))
        $typeid = 2;
    else if ((isset($_SESSION['gx']) && $_SESSION['gx'] == true))
        $typeid = 3;
    else if ((isset($_SESSION['nc']) && $_SESSION['nc'] == true))
        $typeid = 5;
    else if ((isset($_SESSION['pk']) && $_SESSION['pk'] == true))
        $typeid = 6;
    else if ((isset($_SESSION['lhc']) && $_SESSION['lhc'] == true))
        $typeid = 7;
    else if ((isset($_SESSION['xj']) && $_SESSION['xj'] == true))
        $typeid = 8;
    else if ((isset($_SESSION['jsk3']) && $_SESSION['jsk3'] == true))
        $typeid = 9;
    else
        $typeid = 1;
}
if (!isset($_GET['date'])) {
    $date = date('Y-m-d');
} else {
    $date = $_GET['date'];
}

$numberList = numberList($typeid, $date);
//$page = $numberList['page'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?= $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript">
        <!--
        function selects($this) {
            location.href = "result.php?id=" + $this.value;
        }
        //-->
        $(document).ready(function() {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');
        });
    </script>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
</head>
<body class="skin_brown">
<div class="mains_corll wjl_container" id="layout">
    <div id="rightLoader" dom="right" style="">
        <?php
        switch ($typeid) {
            case 1:
                echo
                ' <div id="result_klc" class="page struct_table_center result klc" tmp="result_klc"> ';
                break;
            case 2:
                echo
                ' <div id="result_ssc" class="page struct_table_center result klc" tmp="result_ssc"> ';
                break;
            case 6:
                echo
                ' <div id="result_pk10" class="page struct_table_center result pk10" tmp="result_pk10"> ';
                break;
            case 5:
                echo
                ' <div id="result_nc" class="page struct_table_center result nc" tmp="result_nc"> ';
                break;
            case 9:
                echo
                ' <div id="result_ks" class="page struct_table_center result ks" tmp="result_ks"> ';
                break;
        }?>
            <div style="height:4px;visibility:hidden;font-size:0"></div>
            <script type="text/javascript">
                function Result_Load(typeid)
                {
                    window.location = "Result.php?id=" + typeid;
                }
            </script>
            <div class="title"><span class="sub_title_color">开奖日期：</span>
                <input type="text" value="<?php echo $date?>" id="dateName" onfocus="WdatePicker({
                    el:'dateName',
                    onpicked:function(){window.location = 'result.php?id=<?php echo $typeid ?>&date='+this.value}
                    });">&nbsp;&nbsp;
                <select id="rusult_md_cs" onchange="Result_Load(this.value)">
                    <option value="1" <?php if ($typeid == 1) echo 'selected="selected"' ?> >广东快乐十分</option>
                    <option value="2" <?php if ($typeid == 2) echo 'selected="selected"' ?>>重庆时时彩</option>
                    <option value="6" <?php if ($typeid == 6) echo 'selected="selected"' ?>>北京赛车(PK10)</option>
                    <option value="5" <?php if ($typeid == 5) echo 'selected="selected"' ?>>幸运农场</option>
                    <option value="9" <?php if ($typeid == 9) echo 'selected="selected"' ?>>江苏骰宝</option>
                </select>&nbsp;&nbsp;<a href="javascript:void(0)" class="btn_m elem_btn" id="ball_btn">球号分配表</a></div>
            <table class="dataArea t1">
                <thead>
                    <?php
                    $noresult_html = '';
                    switch ($typeid) {
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
                <tbody id="result_tb">
                <?php
                if (!$numberList) {
                    echo $noresult_html;
                } else if ($typeid == 1) {
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
                } else if ($typeid == 2) {
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
                } else if ($typeid == 6) {
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
                } else if ($typeid == 5) {
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
                } else if ($typeid == 9) {
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
</div>
</body>
</html>