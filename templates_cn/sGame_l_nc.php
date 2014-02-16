<?php
//正码，by kevin
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_game_nc_9`");
if ($ConfigModel['g_nc_game_lock'] != 1 || $ConfigModel['g_game_nc_9'] != 1) exit(href('right.php'));
$types = '正码';
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" ' . $onclick;


//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']);

$gurl = 'sGame_l_nc';
$g = $_GET['g'];
$gametype = "幸运农场";
$sub_type = $types;
$number_type = "nc"
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link href="css/sGame.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="js/sc.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="js/sgame_nc_zhengma.js"></script>
    <script type="text/javascript">
        var s = window.parent.frames.leftFrame.location.href.split('/');
        s = s[s.length - 1];
        if (s !== "left.php")
            window.parent.frames.leftFrame.location.href = "/templates_cn/left.php";
        $(document).ready(function () {
            $('#kuijie').click(function () {
                kuijie();
            })
            $('#yiban').click(function () {
                yiban();
            })
            kuijie();
            set_infos();

            if (typeof common_action_set != undefined) {
                common_action_set(function() {
                    submitforms();
                });
            }
        });
    </script>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<div class="main-content bet-content" dom="layoutright" id="layoutright" style="display: block;">
    <div class="mains_corll">
        <div id="rightLoader" dom="right" style="">
            <div id="sumDT_nc">
            <form id="dp" action="./inc/DataProcessingnc.php?" method="post" target="leftFrame">
            <input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money'] ?>">
            <input type="hidden" name="actions" value="fn1"/>
            <input type="hidden" name="gtypes" value="1" />
            <input type="hidden" name="s_number" value="0"/>
            <input id="touzhu_type" type="hidden" name="touzhu" value="yiban"/>
            <div class="actiionn"></div>
            <div id="hidden_inputs"></div>
                <div class="betAreaBox nc">
                <?php include_once './game_header.php' ?>
                    <div class="common">
                        <div class="klctouzhuArea">
                            <table class="struct_table ballno-tab touzhuArea w100 t1 wqs_top">
                                <colgroup>
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th colspan="12">正码</th>
                                </tr>
                                <tr>
                                    <th>号码</th>
                                    <th class="o">赔率</th>
                                    <th class="tt">金额</th>
                                    <th>号码</th>
                                    <th class="o">赔率</th>
                                    <th class="tt">金额</th>
                                    <th>号码</th>
                                    <th class="o">赔率</th>
                                    <th class="tt">金额</th>
                                    <th>号码</th>
                                    <th class="o">赔率</th>
                                    <th class="tt">金额</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="caption_1"><span class="number num1"></span></td>
                                    <td class="o loads" id="h1" ball_name="01" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num6"></span></td>
                                    <td class="o loads" id="h6" ball_name="06" style="color: rgb(255, 0, 0);" ></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num11"></span></td>
                                    <td class="o loads" id="h11" ball_name="11" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num16"></span></td>
                                    <td class="o loads" id="h16" ball_name="16" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                </tr>
                                <tr>
                                    <td class="caption_1"><span class="number num2"></span></td>
                                    <td class="o loads" id="h2" ball_name="02" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num7"></span></td>
                                    <td class="o loads" id="h7" ball_name="07" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num12"></span></td>
                                    <td class="o loads" id="h12" ball_name="12" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num17"></span></td>
                                    <td class="o loads" id="h17" ball_name="17" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                </tr>
                                <tr>
                                    <td class="caption_1"><span class="number num3"></span></td>
                                    <td class="o loads" id="h3" ball_name="03" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num8"></span></td>
                                    <td class="o loads" id="h8" ball_name="08" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num13"></span></td>
                                    <td class="o loads" id="h13" ball_name="13" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num18"></span></td>
                                    <td class="o loads" id="h18" ball_name="18" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                </tr>
                                <tr>
                                    <td class="caption_1"><span class="number num4"></span></td>
                                    <td class="o loads" id="h4" ball_name="04" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num9"></span></td>
                                    <td class="o loads" id="h9" ball_name="09" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num14"></span></td>
                                    <td class="o loads" id="h14" ball_name="14" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                    <td class="caption_1"><span class="number num19"></span></td>
                                    <td class="o loads" id="h19" ball_name="19" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text" ></td>
                                </tr>
                                <tr>
                                    <td class="caption_1"><span class="number num5"></span></td>
                                    <td class="o loads" id="h5" ball_name="05" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num10"></span></td>
                                    <td class="o loads" id="h10" ball_name="10" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num15"></span></td>
                                    <td class="o loads" id="h15" ball_name="15" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                    <td class="caption_1"><span class="number num20"></span></td>
                                    <td class="o loads" id="h20" ball_name="20" style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input class="amount-input" maxlength="9" type="text"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="klctouzhuArea">
                            <table class="w100 touzhuArea t1 wqs_bottom">
                                <colgroup>
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                    <col class="col_single w8">
                                    <col class="w8">
                                    <col class="w8">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th colspan="9">总和</th>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <td class="fontBlue caption_1">总和大</td>
                                    <td class="o loads" id="h21"  ball_name='总和大' style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input type="text" class="amount-input" maxlength="9" ></td>
                                    <td class="fontBlue caption_1">总和单</td>
                                    <td class="o loads" id="h23"  ball_name='总和单' style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input type="text" class="amount-input" maxlength="9" ></td>
                                    <td class="fontBlue caption_1">总和尾大</td>
                                    <td class="o loads" id="h25"  ball_name='总和尾大' style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input type="text" class="amount-input" maxlength="9"></td>
                                </tr>
                                <tr>
                                    <td class="fontBlue caption_1">总和小</td>
                                    <td class="o loads" id="h22" ball_name='总和小' style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input type="text" class="amount-input" maxlength="9" ></td>
                                    <td class="fontBlue caption_1">总和双</td>
                                    <td class="o loads" id="h24" ball_name='总和双' style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input type="text" class="amount-input" maxlength="9"></td>
                                    <td class="fontBlue caption_1">总和尾小</td>
                                    <td class="o loads" id="h26" ball_name='总和尾小' style="color: rgb(255, 0, 0);"></td>
                                    <td class="amount tt"><input type="text" class="amount-input" maxlength="9"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="elem_type_box">
                        <tbody>
                        <tr>
                            <td width="15%">
                                <div class="elem_selected bulk-amount-times hide" style="display: none;">已经选中<span
                                        id="selectedAmount" class="amount">5</span>注
                                </div>
                            </td>
                            <td width="45%" class="align-c">
                                <div class="elem_amount">
                                    <div id="td_input_money1" style="display:none">
                                        <strong class="t kuaijie">金额</strong>
                                    <span class="kuaijie">
                                        <input type="text" class="elem_amount_input elem_amount_input_quick"
                                               id="AllMoney" name="" maxlength="9" id="" onkeydown="return IsNumeric()">
                                    </span>
                                    </div>
                                    <a class="btn_m elem_btn" id="submit_top" onclick="submitforms()">确 定</a>
                                    <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a></div>
                            </td>
                            <td width="30%" class="align-r"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="ballqueue-module paihang">
                        <table class="t1 w100 longhu-tb dataArea" id="firstball" cat="" play="sumDT_nc">
                            <tbody>
                            <tr>
                                <th class="kon bq-title" <?php echo $onclick?>>总和大小</th>
                                <th class="bq-title" <?php echo $onclick?>>总和单双</th>
                                <th class="bq-title" <?php echo $onclick?>>总和尾数大小</th>
                                <!-- <th class='td-last bq-title' cat='17'>龙虎</th> --></tr>
                            </tbody>
                        </table>
                        <table class="align-c t1 w100 t-td-w4">
                            <tbody>
                            <tr class="ballqueue_result" id="z_cl">
                                <td class="line-gradient"><p>大</p>

                                    <p>大</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>大</p>

                                    <p>大</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>和</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>大</p>

                                    <p>大</p>

                                    <p>大</p>

                                    <p>大</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>大</p>

                                    <p>大</p></td>
                                <td class=""><p>小</p>

                                    <p>小</p></td>
                                <td class="line-gradient"><p>大</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>大</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>大</p></td>
                                <td class=""><p>小</p></td>
                                <td class="line-gradient"><p>大</p></td>
                                <td class=""><p>小</p>

                                    <p>小</p>

                                    <p>小</p></td>
                                <td class="line-gradient"><p>大</p></td>
                                <td class=""><p>和</p></td>
                                <td class="line-gradient"><p>小</p>

                                    <p>小</p>

                                    <p>小</p>

                                    <p>小</p>

                                    <p>小</p>

                                    <p>小</p></td>
                                <td class=""><p>大</p>

                                    <p>大</p>

                                    <p>大</p></td>
                                <td class="line-gradient"><p>小</p>

                                    <p>小</p>

                                    <p>小</p>

                                    <p>小</p>

                                    <p>小</p></td>
                                <td class=""><p>大</p></td>
                                <td class="line-gradient"><p>小</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="empty-d"></div>
                </div>
                <div class="changlongbox">
                    <table style="" class="bet-table changlong-table dataArea w100 t1" id="cl">
                        <tbody>
                        <tr>
                            <th colspan="2">两面长龙排行(待测试)</th>
                        </tr>
                        </tbody>
                        <tbody id="changlong">
                        <tr>
                            <td colspan="2">暂无数据</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <?php include './popup.html'?>
            </div>
        </div>
    </div>

</div>
<div id="player" style="display: none">
</div>
</body>
