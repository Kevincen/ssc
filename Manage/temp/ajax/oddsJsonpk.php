<?php
define('Copyright', '作者QQ:1834219632');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Manage/ExistUser.php';
	global $Users;
	$db=new DB();
	$mid = $_POST['mid'];
	
	if ($mid == 1)
	{
		//加載3-10名所有賠率
		$h=null;
		for ($i=1; $i<=17; $i++){$h .="h{$i},";}
		$h = mb_substr($h, 0, mb_strlen($h)-1);
		$sql = "SELECT  {$h} FROM g_odds6_default WHERE g_type <> 'Ball_1' AND g_type <> 'Ball_2' AND g_type <> 'Ball_11' AND g_type <> 'Ball_12' AND g_type <> 'Ball_13' AND g_type <> 'Ball_14' ORDER BY g_id ASC  ";
		$result = $db->query($sql, 1);
		$arr = showList($db, $result);
		$arr = json_encode($arr);
		echo <<<JSON
					{
						"oddsList" : $arr
					}
JSON;
	}
	else if ($mid == 2)
	{
		$h=null;
		for ($i=1; $i<=17; $i++){$h .="h{$i},";}
		$h = mb_substr($h, 0, mb_strlen($h)-1);
		$sql = "SELECT  {$h} FROM g_odds6_default WHERE g_type = 'Ball_1' or g_type = 'Ball_2'  or g_type = 'Ball_11'  or g_type = 'Ball_12' ORDER BY g_id ASC  ";
		$result = $db->query($sql, 1);
		$arr = json_encode($result);
		echo <<<JSON
					{
						"oddsList" : $arr
					}
JSON;
	}
	else if ($mid == 3)
	{
		
	}
	else if ($mid == 4)
	{
		$Ball = $_POST['tid'];
		$H = $_POST['hid'];
		$odds = $_POST['oid'];
		$sql = "UPDATE g_odds6_default SET `{$H}` = '{$odds}' WHERE g_type = '{$Ball}' ";
		$db->query($sql, 2);
	}
	else if ($mid == 5)
	{
		$Ball = $_POST['oddsType'];
		$H = $_POST['h'];
		$s_num = $_POST['s_num']; //上調或下調
		$sHo = $_POST['sHo']; //幅度
		if ($s_num ==1){
			$Hvalue = $H.'+'.$sHo;
		} else {
			$Hvalue = $H.'-'.$sHo;
		}
		$where = $Ball ? " WHERE g_type = '{$Ball}' " : "WHERE g_type <> 'Ball_1' AND g_type <> 'Ball_2' AND g_type <> 'Ball_11' AND g_type <> 'Ball_12' AND g_type <> 'Ball_13' AND g_type <> 'Ball_14'  ";
		$sql = "UPDATE g_odds6_default SET `{$H}` = {$Hvalue} {$where} ";
		$db->query($sql, 2);
	}
	else if($mid==7)
	{
		initializeOddspk();
		echo 0;exit;
	}
}

function showList($db, $result)
{
	$a = array(0=>'a',1=>'b',2=>'c',3=>'d',4=>'e',5=>'f',6=>'g',7=>'h');
	$arr = array();
	for ($s=0; $s<17; $s++){
		for ($i=0; $i<count($result); $i++){
			$n=$s+1;
			$arr[$s][$a[$i].'h'.$n] = $result[$i]['h'.($s+1)];
		}
	}
	return $arr;
}
?>

