<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user, $UserOut, $stratGamejsk3, $endGamejsk3;
if ($user[0]['g_look'] == 2 || $user[0]['g_out'] != 1) 
	exit(back($UserOut));
	
if ($_SERVER["REQUEST_METHOD"] != "GET") 
	exit("GetError");
	
$_SESSION['guid_code'] = sha1(uniqid(time(),true));
$dateTime = date('Y-m-d H:i:s');
if ( $dateTime < $stratGamejsk3 || $dateTime > $endGamejsk3)
{
	back('開盤時間為：'.$stratGamejsk3.'--'.$endGamejsk3);exit;
}
 

if (!Matchs::isNumber($_GET['numberid'],10,11)||!Matchs::isString($_GET['hid'], 3, 4)||!isset($_GET['tid'])) 
	exit(back('Error'));
 
$number = $_GET['numberid'];
$s_cq[0][0] = $_GET['tid'];
$s_cq[0][1] = $_GET['hid'];
$a = mb_substr($s_cq[0][1], 1, mb_strlen($s_cq[0][1]));
$odds = GetOddsjsk3($s_cq[0][0], $a);
$ConfigModel =configModel("`g_max_money`,`g_mix_money`");
 
$odds = setoddsjsk3($a, $odds,  $user, 0, $s_cq[0][0]);
 

 
$result = GetUserXianErjsk3($s_cq[0][0], $a,$user[0]['g_name']);


$s = _jsk3BallType($s_cq[0][0],$a);
 
 
$max = GetUser_s_jsk3($result, $user, $s[0],$s[1] ,true);
$max1 = $max['DanZhu_XianEr'];
$max2 = $max['DanHao_XianE'];
$max3 = $max['DanHao_YiXia'];
$max4 = $max['DanQi_XianEr'];
$max5 = $max['DanQi_YiXia'];
$gMoney = $max['KeYongEr'];
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGames_xj.js"></script>
<style type="text/css">
body {background-color:#FFEFE2}
</style>
</head>
<body>
<form id="dp" action="inc/DataProcessingxj.php" method="post" onsubmit = "return submitformscq()">
	<input type="hidden" name="gtypes" value="2" />
	<input type="hidden" name="s_number" value="<?php echo $number?>" />
	                <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="230">
                    <tr>
                        <td class="t_list_caption" colspan="2"><span id="tys"><?php echo $s[0]?></span> - 下註</td>
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
                        	<span style="color:#009933; font-weight:bold"><?php echo $number?>期</span><br />
                        	<?php
                        	if($s[0] == '總和、龍虎和') {
                        		echo $nn = '<span style="color:#0000FF"><span>'.$s[1].'</span></span> @'; 
                        	} else {
                        		echo $nn = '<span style="color:#0000FF">'.$s[0].'『 <span>'.$s[1].'</span> 』</span>@';
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
                            <input type="hidden" name="s_cq" class="actiionn" value="<?php echo$s_cq[0][0].','.$s_cq[0][1]?>" />
                        </td>
                    </tr>
                </table>
                </form>
</body>
</html>