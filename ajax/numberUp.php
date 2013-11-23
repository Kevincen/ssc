<?php
define('Copyright', '作者QQ：1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
if ($_SERVER["REQUEST_METHOD"] != "POST") exit;
include_once ROOT_PATH.'Manage/config/global.php';
include_once ROOT_PATH.'class/SumAmount.php';

$mid = $_POST['mid'];
if ($mid == 1)
{
	$num = $_POST['num'];
	if($_POST['type'] == 1 )
		$type = '廣東快樂十分';
	if($_POST['type'] == 2) 
		$type =  '重慶時時彩';
	if($_POST['type'] == 3) 
		$type =  '廣西快樂十分';
	if($_POST['type'] == 6) 
		$type =  '北京赛车PK10';
	if($_POST['type'] == 7) 
		$type =  '六合彩';
	if($_POST['type'] == 8) 
		$type =  '新疆時時彩';
	if($_POST['type'] == 9) 
		$type =  '江苏骰寶(快3)';
	$db=new DB();
	$return = $db->query("SELECT g_id, g_nid, g_jiner, g_win FROM g_zhudan WHERE 
	g_qishu = '{$num}' AND g_win is not null AND g_mumber_type <> 5 AND g_type='{$type}'", 1);
	if ($return)
	{
		for ($i=0; $i<count($return); $i++)
		{
			$a = $return[$i]['g_jiner']+$return[$i]['g_win'];
			$db->query("UPDATE g_user SET g_money_yes = g_money_yes-$a WHERE g_name = '{$return[$i]['g_nid']}' LIMIT 1", 2);
			$db->query("UPDATE g_zhudan SET g_win = null WHERE g_id = '{$return[$i]['g_id']}' LIMIT 1", 2);
		}
		echo 1;
	}
}

?>