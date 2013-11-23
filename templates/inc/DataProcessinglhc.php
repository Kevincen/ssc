<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
include_once ROOT_PATH.'class/AutoLet.php';
global $user, $UserOut;
$rows=$db->query("select g_id from g_kaipan_lhc where g_feng_date>'".date("Y-m-d H:i:s")."' And g_lock=2",3); 
if ( $rows<1 )
{
	back('已经封盘');exit;
}  
$ConfigModel =configModel("`g_web_lock`, `g_lhc_game_lock`,`g_mix_money`"); 
if ($ConfigModel['g_lhc_game_lock'] !=1 || $ConfigModel['g_web_lock'] !=1)
	exit(alert_href('抱歉！盤口未開放。', '../left.php'));
	
if ($user[0]['g_look'] == 2) 
	exit(back($UserOut));

if ($_SERVER["REQUEST_METHOD"] != "POST") 
	exit("PostError");

$action = $_POST['actions'];
if (!isset($_SESSION['guid_code']))
	exit(alert_href('系統繁忙中，請稍後5秒后在進行下注。', '../left.php'));

unset($_SESSION['guid_code']); 
$gtypes = '六合彩';
$ListArr = array();
$odds = 0; 					//賠率
$countBiShu = 0; 			//總筆數
$countZhuEr = 0; 			//總注額
$countKeYinEr = 0; 		//可贏額
$gMoney = 0;				//剩餘可用金額
$action = $_POST['actions']; //提交類型
if($action=="fn2") //連碼下注或者合肖
{
	$s_type = base64_decode($_POST['s_type']);
	$s_number = base64_decode($_POST['s_number']);
	$s_ball = base64_decode($_POST['s_ball']);
	$s_ball_arr = explode('、', $s_ball);
	$s_money = $_POST['s_money'];
	$g_ball=$_POST['g_ball'];
	if (!Matchs::isNumber($s_money) || $s_money < $ConfigModel['g_mix_money'])
		exit(alert_href('抱歉！您的下注金額錯誤。', '../left.php'));
	 
	$is_Number = isNumberlhc($g_ball,  $s_number);//是否封盤 
	$hi = 'h'.trim(strtr($s_type, "t"," ")); 
	if($g_ball=="Ball_17"){
		switch ($s_type)
		{
			case "t1" : $stringList['type'] = '三中三'; 		$stringList['count'] = 3; break;
			case "t2" : $stringList['type'] = '三中二'; 	$stringList['count'] = 3; break;
			case "t3" : $stringList['type'] = '二中二'; 	$stringList['count'] = 2; break;
			case "t4" : $stringList['type'] = '五不中'; 		$stringList['count'] = 5; break;
			case "t5" : $stringList['type'] = '二中特'; 	$stringList['count'] = 2; break; 
			default:exit('is t1 or t5 Error');
		} 
	}else if($g_ball=="Ball_18"){
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
			default:exit('is t1 or t22 Error');
		}	
	}else{
		exit("error ball");
	}
	$results = subArr ($s_ball_arr, $stringList['count']); //復式計算、返回值、【總組數】、【總個數】、【號碼個數】
	$number_1 = $s_number; //期數
	$countBiShu = 1; //總筆數
	$countZhuEr = $results[0] * $s_money; //總下注金額
	$odds = GetOddslhc($g_ball, $hi);//獲取賠率
	$odds = setoddslhc($hi, $odds, $user, 0, $g_ball);
	
	$result = GetUserXianErlhc($g_ball, $hi, $user[0]['g_name']); 				//當前用戶退水列表
	
	$max = GetUser_s_lhc($result, $user, $stringList['type'],false);//當前用戶、單注限額、單號限額、單號已下、 單期限額、單期已下
	 
	isUserMoney ($countZhuEr, $max,$countZhuEr); 																	//驗證下注金額是否大於可用金額
	$gMoney = $max['KeYongEr'] - $countZhuEr; 													//可用金額
	$ListArr[0]['g_s_nid'] = $user[0]['g_nid'];											//外鍵
	$ListArr[0]['g_mumber_type'] = $user[0]['g_mumber_type'];		//會員類型
	$ListArr[0]['g_nid'] = $user[0]['g_name'];															//帳號
	$ListArr[0]['g_date'] = date('Y-m-d H:i:s');															//下注時間
	$ListArr[0]['g_type'] = $gtypes;																			//彩票類型
	$ListArr[0]['g_qishu'] = $s_number;																	//下注期數
	$ListArr[0]['g_mingxi_1'] = $stringList['type'];  													//明細1 例如：		第一球
	$ListArr[0]['g_mingxi_1_str'] = $results[0];														//字符串明細_1 	標明連碼、共多少組
	$ListArr[0]['g_mingxi_2'] = $s_ball;																	//明細2 				下注號碼
	$ListArr[0]['g_mingxi_2_str'] = null;																	//字符串明細_2 	標明連碼	
	$ListArr[0]['g_odds'] = $odds;																			//賠率
	$ListArr[0]['g_jiner'] = $s_money;		
															//下注金額
	$DtnArray = SumRankDistribution($user, $s_money, $g_ball, $hi, 7);
	
	$g_pan=$user[0]['g_panlu'];
	if($g_pan=="A"){
	$ListArr[0]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
	}
	if($g_pan=="B"){
	$ListArr[0]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
	}
	if($g_pan=="C"){
	$ListArr[0]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
	}
	//$ListArr[0]['g_tueishui'] = $result[0]['g_panlu']; 		//會員退水
	$ListArr[0]['g_tueishui_1'] = $DtnArray['tueishui_1']; 		//代理退水
	$ListArr[0]['g_tueishui_2'] = $DtnArray['tueishui_2']; 	//總代理退水
	$ListArr[0]['g_tueishui_3'] = $DtnArray['tueishui_3']; 	//股東退水
	$ListArr[0]['g_tueishui_4'] = $DtnArray['tueishui_4']; 	//公司退水
	$ListArr[0]['g_distribution'] = $DtnArray['distribution_1']; 			//代理占成
	$ListArr[0]['g_distribution_1'] = $DtnArray['distribution_2'];	 	//總代理占成
	$ListArr[0]['g_distribution_2'] = $DtnArray['distribution_3']; 		//股東占成
	$ListArr[0]['g_distribution_3'] = $DtnArray['distribution_4']; 		//公司占成
	$ListArr[0]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
	$tuiShui = sumTuiSui ($ListArr[0]);
	$_tuiShui = $countZhuEr * $tuiShui;
	if($kyTS){
		$ListArr[0]['KeYing'] = $countZhuEr * $ListArr[0]['g_odds'] - $countZhuEr + $_tuiShui; 		//可贏額
	}else{
		$ListArr[0]['KeYing'] = $countZhuEr * $ListArr[0]['g_odds'] - $countZhuEr;
	}
	$ListArr[0]['id'] = postForms ($ListArr[0]);
	if ($ListArr[0]['id'] == null) exit(alert_href("抱歉！{$ListArr[0]['g_mingxi_1']}『{$ListArr[0]['g_mingxi_2']}』下註失敗，請與上級管理聯繫！", '../left.php'));
	upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
}
else
{
	$s_number = $_POST['s_number'];
	$s_cq = explode('|', $_POST['s_cq'], -1);
	
	for ($i=0; $i<count($s_cq); $i++)
	{
		$s_cq[$i] = explode(',', $s_cq[$i]);
	}
	
	for ($i=0; $i<count($s_cq); $i++)
	{
		if (!Matchs::isNumber($s_cq[$i][2]))
			exit(alert_href('抱歉！您的下注金額錯誤。', '../left.php'));
		isNumberlhc($s_cq[$i][0], $s_number);
		$countZhuEr += $s_cq[$i][2];
		$countBiShu ++;
	}
	
	$max = null;
	for ($i=0; $i<count($s_cq); $i++)
	{  
		$g_ball=$s_cq[$i][0];
		$h= 'h'.end(explode("h",$s_cq[$i][1]));
		$result = GetUserXianErlhc($g_ball, $h, $user[0]['g_name']); 
		 
		$max = GetUser_s_lhc($result, $user, $s_cq[$i][3],$s_cq[$i][4], true);
		 
		isUserMoney($s_cq[$i][2], $max,$countZhuEr); 
	}
	
	
	for ($i=0; $i<count($s_cq); $i++)
	{
		$a = mb_substr($s_cq[$i][1], 1, mb_strlen($s_cq[$i][1]));
		$odds = GetOddslhc($s_cq[$i][0], $a);
		$odds = setoddslhc($a, $odds,$user, 0,$s_cq[$i][0]);
		 
		$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];
		$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];
		$ListArr[$i]['g_nid'] = $user[0]['g_name'];
		$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');
		$ListArr[$i]['g_type'] = $gtypes;
		$ListArr[$i]['g_qishu'] = $s_number;
		$s = array($s_cq[$i][3],$s_cq[$i][4]);
		$ListArr[$i]['g_mingxi_1'] = $s[0];
		$ListArr[$i]['g_mingxi_1_str'] = null;
		$ListArr[$i]['g_mingxi_2'] = $s[1];
		$ListArr[$i]['g_mingxi_2_str'] = null;
		$ListArr[$i]['g_odds'] = $odds;
		$ListArr[$i]['g_jiner'] = $s_cq[$i][2];
		$g_ball=$s_cq[$i][0];
		$h= 'h'.end(explode("h",$s_cq[$i][1]));
		$result = GetUserXianErlhc($g_ball, $h, $user[0]['g_name']); 
		
		$g_pan=$user[0]['g_panlu'];
		if($g_pan=="A"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
		}
		if($g_pan=="B"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
		}
		if($g_pan=="C"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
		}
		//$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu'];
		$DtnArray = SumRankDistribution ($user, $s_cq[$i][2], $g_ball, $h, 7);
		$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1'];
		$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2'];
		$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3'];
		$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4'];
		$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1'];
		$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];
		$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3'];
		$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4'];
		$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
		$gMoney = $max['KeYongEr'] - $countZhuEr;
		$ListArr[$i]['KeYongEr'] = $gMoney;
		$tuiShui = sumTuiSui ($ListArr[$i]);
		$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
		if($kyTS){
			$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui;
		}else{
			$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'];		
		}
		$ListArr[$i]['id'] = postForms ($ListArr[$i]);
		if ($ListArr[$i]['id'] == null)
					exit(alert_href("抱歉！{$ListArr[$i]['g_mingxi_1']}『{$ListArr[$i]['g_mingxi_2']}』下註失敗", '../left.php'));
	}
	upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
} 
new AutoLet($s_number, $ListArr, 2); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/left.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {background-color:#FFEFE2}
</style>
</head>
<body>
<form id="dp" action="" method="post">
	                <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="230">
                    <tr>
                        <td class="t_list_caption" colspan="2">下註結果反饋</td>
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
                    	<td class="t_td_but" colspan="2" align="center">
                        	<input type="button" value="打印" onclick="window.print()" class="inputq" />
                            <input type="button" value="返回" onclick="location.href='../left.php'" class="inputq"  />
                        </td>
                    </tr>
                    <tr>
                    	<td class="t_td_text" colspan="2">
                        	<span class="captions"><?php echo $s_number?>期</span>
                        	 <?php 
                        	 	echo '<table border="0" cellpadding="0" cellspacing="1" width="100%" bgcolor="#FFFFF7">';
	                        	 for ($i=0; $i<count($ListArr); $i++)
	                        	 {
	                        	 	$nn = $ListArr[$i]['g_mingxi_1'] == '總和、龍虎和' ? $ListArr[$i]['g_mingxi_2'] : $ListArr[$i]['g_mingxi_1'].'『'.$ListArr[$i]['g_mingxi_2'].'』';
		                        	 echo '<tr><td>&nbsp;註單號：'.$ListArr[$i]['id'].'#</td></tr>
		                        			  <tr><td align="center"><font color="blue">'.$nn.'</font> @ <span style="font-weight:bold; color:red">'.$ListArr[$i]['g_odds'].'</span></td></tr>
		                        			  <tr><td>&nbsp;下註額：'.$ListArr[$i]['g_jiner'].'</td></tr>
		                        			  <tr><td class="f_bt">&nbsp;可贏額：'.$ListArr[$i]['KeYing'].'</td></tr>';
	                        	  }
	                        	  echo '</table>';
                        	 ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">下註筆數</td>
                        <td class="t_td_text" width="137" id="max4">&nbsp;<?php echo $countBiShu?>筆</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">總計註額</td>
                        <td class="t_td_text" width="137" id="max5">&nbsp;￥<?php echo $countZhuEr?></td>
                    </tr>
                </table>
                </form>
</body>
</html>