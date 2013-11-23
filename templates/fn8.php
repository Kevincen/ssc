<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user, $UserOut, $stratGamenc, $endGamenc;
if ($_SERVER["REQUEST_METHOD"] != "GET") exit("GetError");
if ($user[0]['g_look'] == 2 || $user[0]['g_out'] != 1)
	exit(back($UserOut));
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'01:55:01';
global $stratGamenc, $endGamenc;
if ( ($dateTime < $stratGamenc && $dateTime > $a) || $dateTime > $endGamenc){
	back('開盤時間為：'.$stratGamenc.'--'.$endGamenc);exit;
}
if (!Matchs::isNumber($_GET['v'],11,11)||!Matchs::isString($_GET['n'], 2, 3)||!Matchs::isStringChi($_GET['t']))
	exit(back('Error'));

$n = $_GET['n']; //號碼
$v = $_GET['v']; //期數
$t = $_GET['t']; //遊戲玩法

$t = gameTypeFormatnc($t);
$odds = GetOddsnc ($t, $n); //獲取賠率
$ConfigModel= configModel("`g_max_money`,`g_mix_money`, `g_odds_ratio_nc_b1`,`g_odds_ratio_nc_b2`,`g_odds_ratio_nc_b3`,`g_odds_ratio_nc_b4`,`g_odds_ratio_nc_b5`,`g_odds_ratio_nc_c1`,`g_odds_ratio_nc_c2`,`g_odds_ratio_nc_c3`,`g_odds_ratio_nc_c4`,`g_odds_ratio_nc_c5`");
if ($t=='總和、家禽野兽' ||$t=='家禽野兽' || $t=='總和' ){
	$odds = setoddsnc($n, $odds, $ConfigModel, $user, 1);
} else {
	$odds = setoddsnc($n, $odds, $ConfigModel, $user, 0);
}

$n = trim(strtr($n, "h"," "));
$n = GetBallByStringnc ($t, $n);

$result = GetUserXianErnc ($t, $n, $user[0]['g_name']);
$max = GetUser_s_nc ($result, $user,$t,$n);
$max1 = $max['DanZhu_XianEr']; //單注限額
$max2 = $max['DanHao_XianE']; //單號限額
$max3 = $max['DanHao_YiXia']; //單號已下
$max4 = $max['DanQi_XianEr']; //單期限額
$max5 = $max['DanQi_YiXia']; //單期已下
$gMoney = $max['KeYongEr']; //可用額
$_n = base64_encode($n);
$_v = base64_encode($v);
$_t = base64_encode($t);
$guid = sha1(uniqid(time(),TRUE));
$_SESSION['guid_code'] = $guid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGetnc.js"></script>
<style type="text/css">
body {background-color:#FFEFE2}
</style>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<form id="dp" action="" method="post">
	<input type="hidden" name="number_1" value="<?php echo $v?>" />
	<input type="hidden" name="number_2" value="<?php echo $_n?>" />
	<input type="hidden" name="actions" value="fn" />
	<input type="hidden" name="gtypes" value="1" />
    <input type="hidden" name="types" value="<?php echo $_t?>" />
    <input type="hidden" name="hid" value="<?php echo $_GET['n']?>" />
	                <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="230">
                    <tr>
                        <td class="t_list_caption" colspan="2"><span id="tys"><?php echo $t?></span> - 下註</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">會員帳戶</td>
                        <td class="t_td_text" width="137">&nbsp;<?php echo $user[0]['g_name']?>（<?php echo $user[0]['g_panlu']?>盤）</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1">可用金額</td>
                        <td class="t_td_text">&nbsp;<?php echo is_Number($gMoney)?></td>
                    </tr>
                    <tr>
                    	<td class="t_td_text" colspan="2" align="center">
                        	<span style="color:#009933; font-weight:bold"><?php echo $v?>期</span><br />
                        	<?php
                        	if($t == '總和、龍虎') {
                        		echo $nn = '<span style="color:#0000FF"><span>'.$n.'</span></span>@';
                        	} else {
                        		echo $nn = '<span style="color:#0000FF">'.$t.'『<span>'.$n.'</span> 』</span>@';
                        	}
                        	?>
                            <span style="color:red; font-weight:bold" id="odds"><?php echo $odds?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">下註金額</td>
                        <td class="t_td_text" width="137">&nbsp;<input type="text" class="inp1" name="money" id="money" onkeyup="only(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" maxlength="9" /></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">可贏金額</td>
                        <td class="t_td_text" width="137" id="countOdds">&nbsp;0</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">最高派彩</td>
                        <td class="t_td_text" width="137" id="pc"><?php echo $ConfigModel['g_max_money']?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">最低額度</td>
                        <td class="t_td_text" width="137" id="mix"><?php echo $ConfigModel['g_mix_money']?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">單注限額</td>
                        <td class="t_td_text" width="137" id="max1"><?php echo $max1?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">單號限額</td>
                        <td class="t_td_text" width="137" id="max2"><?php echo $max2?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">單號已下</td>
                        <td class="t_td_text" width="137" id="max3"><?php echo $max3?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">單期限額</td>
                        <td class="t_td_text" width="137" id="max4"><?php echo $max4?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">單期已下</td>
                        <td class="t_td_text" width="137" id="max5"><?php echo $max5?></td>
                    </tr>
                    <tr>
                    	<td class="t_td_but" colspan="2" align="center">
                        	<input type="button" value="取消" onclick="location.href='left.php'" class="inputq" />&nbsp;&nbsp;
                            <input type="submit" value="下註" id="submitv" class="inputq" />
                        </td>
                    </tr>
                </table>
                </form>
</body>
</html>
