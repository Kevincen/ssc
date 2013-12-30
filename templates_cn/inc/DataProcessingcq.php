<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
include_once ROOT_PATH.'class/AutoLet.php';
global $user, $UserOut, $stratGamecq, $endGamecq;
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'01:55:00';
if ( ($dateTime < $stratGamecq && $dateTime > $a) || $dateTime > $endGamecq)
{
	//back('開盤時間為：'.$stratGamecq.'--'.$endGamecq);exit;
}

$ConfigModel =configModel("`g_web_lock`, `g_cq_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");

if ($ConfigModel['g_cq_game_lock'] !=1 || $ConfigModel['g_web_lock'] !=1)
	exit(alert_href('抱歉！盤口未開放。', '../left.php'));
	
if ($user[0]['g_look'] == 2) 
	exit(back($UserOut));

if ($_SERVER["REQUEST_METHOD"] != "POST") 
	exit("PostError");

$action = $_POST['actions'];
if (!isset($_SESSION['guid_code']))
	exit(alert_href('系統繁忙中，請稍後5秒后在進行下注。', '../left.php'));

unset($_SESSION['guid_code']);
	
$gtypes = '重慶時時彩';
$ListArr = array();
$odds = 0; 					//賠率
$countBiShu = 0; 			//總筆數
$countZhuEr = 0; 			//總注額
$countKeYinEr = 0; 		//可贏額
$gMoney = 0;				//剩餘可用金額
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
	isNumbercq($s_cq[$i][0], $s_number);
	$countZhuEr += $s_cq[$i][2];
	$countBiShu ++;
}

$max = null;
for ($i=0; $i<count($s_cq); $i++)
{
	$c =t($s_cq[$i]);
	$result = GetUserXianErcq($c, $user[0]['g_name']);
	$ccd=isBallType($s_cq[$i][0],$s_cq[$i][1]);
	$max = GetUser_s($result, $user, $ccd[0],$ccd[1], true);
	for ($k=0; $k<count($s_cq); $k++)
	{
	isUserMoney($s_cq[$k][2], $max,$countZhuEr);
	}
}

for ($i=0; $i<count($s_cq); $i++)
{
	$a = mb_substr($s_cq[$i][1], 1, mb_strlen($s_cq[$i][1]));
	$odds = GetOddscq($s_cq[$i][0], $a);
	if ($s_cq[$i][0] == 'Ball_1' || $s_cq[$i][0] == 'Ball_2' || $s_cq[$i][0] == 'Ball_3' || $s_cq[$i][0] == 'Ball_4' || $s_cq[$i][0] == 'Ball_5')
	{
		if ($a != 'h11' &&$a != 'h12' &&$a != 'h13' &&$a != 'h14' && Copyright)
			$odds = setoddscq($a, $odds, $ConfigModel, $user, 0,$s_cq[$i][0]);
		else 
			$odds = setoddscq($a, $odds, $ConfigModel, $user, 1);
	}
	else if ($s_cq[$i][0] == 'Ball_6')
	{
		$odds = setoddscq($a, $odds, $ConfigModel, $user, 1,$s_cq[$i][0]);
	}
	else if ($s_cq[$i][0] == 'Ball_7' || $s_cq[$i][0] == 'Ball_8' || $s_cq[$i][0] == 'Ball_9')
	{
		$odds = setoddscq($a, $odds, $ConfigModel, $user, 2,$s_cq[$i][0]);
	}
	$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];
	$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];
	$ListArr[$i]['g_nid'] = $user[0]['g_name'];
	$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');
	$ListArr[$i]['g_type'] = $gtypes;
	$ListArr[$i]['g_qishu'] = $s_number;
	$s = isBallType($s_cq[$i][0], $s_cq[$i][1]);
	$ListArr[$i]['g_mingxi_1'] = $s[0];
	$ListArr[$i]['g_mingxi_1_str'] = null;
	$ListArr[$i]['g_mingxi_2'] = $s[1];
	$ListArr[$i]['g_mingxi_2_str'] = null;
	$ListArr[$i]['g_odds'] = $odds;
	$ListArr[$i]['g_jiner'] = $s_cq[$i][2];
	$c =t($s_cq[$i]);
	$result = GetUserXianErcq($c, $user[0]['g_name']);
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
	$DtnArray = SumRankDistribution ($user, $s_cq[$i][2], null, $c, 1);
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
<body class="bd <?php echo $_COOKIE['g_skin']; ?>">
<?php include ROOT_PATH. 'templates_cn/show_user.php' ?>
</body>
</html>