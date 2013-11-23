<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
include_once ROOT_PATH.'templates/offGamelhc.php';
if ($user[0]['g_look'] == 2) exit(back($UserOut));
if ($_SERVER["REQUEST_METHOD"] != "POST") {exit;}
$guid = sha1(uniqid(time(),TRUE));
$_SESSION['guid_code'] = $guid;
if ($user[0]['g_out'] != 1) exit(back($UserOut));
$s_type =  $_POST['gg'];
$s_number = $_GET['v'];
$s_ball_arr = $_POST['t'];
sort($s_ball_arr);
$g_ball="Ball_18";
$n = 'h'.trim(strtr($s_type, "t"," "));
$odds = GetOddslhc($g_ball, $n);//獲取賠率
$ConfigModel= configModel("`g_max_money`, `g_mix_money`");
$odds = setoddslhc($n, $odds, $user, 0, $g_ball); 
switch ($s_type)
{
	case "t1" : $stringList['type'] = '一肖中'; 		$stringList['count'] = 1; break;
	case "t2" : $stringList['type'] = '一肖不中'; 	$stringList['count'] = 1; break;
	case "t3" : $stringList['type'] = '二肖中'; 	$stringList['count'] = 2; break;
	case "t4" : $stringList['type'] = '二肖不中'; 		$stringList['count'] = 2; break;
	case "t5" : $stringList['type'] = '三肖中'; 	$stringList['count'] = 3; break; 
	case "t6" : $stringList['type'] = '三肖不中'; 	$stringList['count'] = 3; break; 
	case "t7" : $stringList['type'] = '四肖中'; 		$stringList['count'] = 4; break;
	case "t8" : $stringList['type'] = '四肖不中'; 	$stringList['count'] = 4; break;
	case "t9" : $stringList['type'] = '五肖中'; 	$stringList['count'] = 5; break;
	case "t10" : $stringList['type'] = '五肖不中'; 		$stringList['count'] = 5; break;
	case "t11" : $stringList['type'] = '六肖中'; 	$stringList['count'] = 6; break; 
	case "t12" : $stringList['type'] = '六肖不中'; 	$stringList['count'] = 6; break; 
	case "t13" : $stringList['type'] = '七肖中'; 		$stringList['count'] = 7; break;
	case "t14" : $stringList['type'] = '七肖不中'; 	$stringList['count'] = 7; break;
	case "t15" : $stringList['type'] = '八肖中'; 	$stringList['count'] = 8; break;
	case "t16" : $stringList['type'] = '八肖不中'; 		$stringList['count'] = 8; break;
	case "t17" : $stringList['type'] = '九肖中'; 	$stringList['count'] = 9; break; 
	case "t18" : $stringList['type'] = '九肖不中'; 	$stringList['count'] = 9; break; 
	case "t19" : $stringList['type'] = '十肖中'; 		$stringList['count'] = 10; break;
	case "t20" : $stringList['type'] = '十肖不中'; 	$stringList['count'] = 10; break;
	case "t21" : $stringList['type'] = '十一肖中'; 	$stringList['count'] = 11; break;
	case "t22" : $stringList['type'] = '十一肖不中'; 		$stringList['count'] = 11; break; 
	default:exit('is t1 or t5 Error');
}
//復式計算、返回值、【總組數】、【總個數】
$results = subArr ($s_ball_arr, $stringList['count']);
$result = GetUserXianErlhc ($g_ball, $n, $user[0]['g_name']);
$max = GetUser_s_lhc ($result, $user,$stringList['type'],null);
$max1 = $max['DanZhu_XianEr']; //單注限額
$max2 = $max['DanHao_XianE']; //單號限額
$max3 = $max['DanHao_YiXia']; //單號已下
$max4 = $max['DanQi_XianEr']; //單期限額
$max5 = $max['DanQi_YiXia']; //單期已下
$gMoney = $max['KeYongEr']; //可用額

 
$str = join('、', $s_ball_arr); //號碼
$nor = $gMoney / $results[0]; //總金額/總組數=單筆下注金額
if (strpos($nor, '.'))
{
	$a = explode('.', $nor);
	$nor =$a[0];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
$(function () { 
	$("#dp").attr("action","./inc/DataProcessinglhc.php?t="+encodeURI($("#tys").html()));
	$("#submitv").click(function () {
		var money =  $("#money");
		var money_a = parseInt(money.val());
		var mix = parseInt($("#mix").html());
		var max1 = parseInt($("#max1").html());
		var max2 = parseInt($("#max2").html());
		var max3 = parseInt($("#max3").html());
		var max4 = parseInt($("#max4").html());
		var max5 = parseInt($("#max5").html());
		
		if (money.val() == "") {
			alert("請填寫下註金額!!!");
			money.focus();
			return false;
		}

		if (money_a < mix) {
			alert("最低下註金額："+mix+"￥");
			money.focus();
			return false;
		}

		if (money_a > max1) {
			alert("單注限額："+max1+"￥");
			money.focus();
			return false;
		}
		
		if (_href == "fn1") {
			if (parseInt($("#countOdds").html()) > max1) {
				alert("單注限額："+max1+"￥");
				money.focus();
				return false;
			}
		}
		
		if ((money_a+max5) > max2) {
			alert("單號限額："+max2+"￥");
			money.focus();
			return false;
		}
		
		if ((money_a+max5) > max4) {
			alert("單期限額："+max4+"￥");
			money.focus();
			return false;
		}
		
		if (!confirm("確定下註嗎？"))
		{
			return false;
		}
	});
});

function only ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
		$("#countOdds").html(0);
	} else {
		var odds = $("#odds").html();
		var pc = $("#pc").html();
		var m = (parseInt(n.val()) * odds - parseInt(n.val())) > pc ? pc : (n.val() * odds - parseInt(n.val())).toFixed(3);
		$("#countOdds").html(m);
	}
}

function onlys ($this) {
	var r = /^\+?[1-9][0-9]*$/;
	var gCount = $("#gCount").html(); //獲取總組數
	var n = $($this) //獲取單注金額
	var maxMoney = $("#maxMoney").html(); //獲取單注最大金額
	var countOdds = $("#countOdds"); //顯示下註總計
	var pc = $("#pc").html();
	if (!r.test(n.val())) {
		n.val("");
		countOdds.html(0);
	} else {
		if (parseInt(n.val()) > parseInt(maxMoney)) {
			n.val(maxMoney);
			countOdds.html(parseInt(maxMoney) * parseInt(gCount));
			if ((parseInt(maxMoney) * parseInt(gCount)) > pc) {countOdds.html(pc)}
		} else {
			countOdds.html(parseInt(n.val()) * parseInt(gCount));
			if ((parseInt(n.val()) * parseInt(gCount)) > pc) {countOdds.html(pc)}
		}
	}
	
}
</script>
<style type="text/css">
body {background-color:#FFEFE2}
</style>
</head>
<body>
<form id="dp" action="" method="post">
<input type="hidden" name="actions" value="fn2" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" name="g_ball" value="<?=$g_ball?>" />
<input type="hidden" name="s_type" value="<?php echo base64_encode($s_type)?>" />
<input type="hidden" name="s_number" value="<?php echo base64_encode($s_number)?>" />
<input type="hidden" name="s_ball" value="<?php echo base64_encode($str)?>" />
	                <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="230">
                    <tr>
                        <td class="t_list_caption" colspan="2"><span><?php echo $stringList['type']?></span> - 下註</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">會員帳戶</td>
                        <td class="t_td_text" width="137"><?php echo $user[0]['g_name']?>（<?php echo $user[0]['g_panlu']?>盤）</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1">可用金額</td>
                        <td class="t_td_text"><?php echo is_Number($gMoney)?></td>
                    </tr>
                    <tr>
                    	<td class="t_td_text" colspan="2" align="center" style="background:#FFFFF0">
                        	<span style="color:#009933; font-weight:bold"><?php echo $s_number?>期</span><br />
                            <span style="color:#0000FF"><?php echo $stringList['type']?></span>@ 
                            <span style="color:red; font-weight:bold;font-size:14px" id="odds"><?php echo $odds?></span><br />
                            <span style="color:#0000FF;font-weight:bold;line-height:25px">下註號碼明細</span><br />
                            <span style="color:#0099FF;font-size:14px"><?php echo $str?></span><br /><br />
                            <span>您共選擇了<span style="color:red"><?php echo $results[2]?></span> 個號碼</span><br />
                            <span>“復式”共分為<span style="color:red" id="gCount"><?php echo $results[0]?></span> 組</span><br />
                            <span>每組最高可下註金額 <span style="color:red" id="maxMoney"><?php echo $nor?></span> 元</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">每註金額</td>
                        <td class="t_td_text" width="137"><input type="text" class="inp1" name="s_money" id="money" onkeyup="onlys(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" maxlength="9" /></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">下註總計</td>
                        <td class="t_td_text" width="137" id="countOdds">0</td>
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
                        	<input type="button" value="取消" class="inputq" onclick="location.href='left.php'" />
                            <input type="submit" value="下註" class="inputq" id="submitv" />
                        </td>
                    </tr>
                </table>
                </form>
</body>
</html>