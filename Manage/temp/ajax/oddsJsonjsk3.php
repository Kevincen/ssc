<?php
define('Copyright', '作者QQ:1834219632');
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Manage/ExistUser.php';
	global $Users;
	$db=new DB();
	$mid = $_REQUEST['mid']; 
	if ($mid == 1)
	{
		//加載1-5號所有賠率
		$h=null;
		for ($i=1; $i<=17; $i++){$h .="h{$i},";}
		$h = mb_substr($h, 0, mb_strlen($h)-1);
		$sql = "SELECT  {$h} FROM g_odds9_default   ORDER BY g_id ASC  ";
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
		$sql = "UPDATE g_odds9_default SET `{$H}` = '{$odds}' WHERE g_type = '{$Ball}' ";
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
		$where = $Ball ? " WHERE g_type = '{$Ball}' " : "WHERE g_type <> 'Ball_6' AND g_type <> 'Ball_7' AND g_type <> 'Ball_8' AND g_type <> 'Ball_9' ";
		$sql = "UPDATE g_odds9_default SET `{$H}` = {$Hvalue} {$where} ";
		$db->query($sql, 2);
	}
	else if($mid==6)
	{
		$Ball = $_POST['oddsType']; 
		$s_num = $_POST['s_num']; //上調或下調
		$sHo = $_POST['sHo']; //幅度
		if ($s_num ==1){
			$sHo = '+'.$sHo;
		} else {
			$sHo = '-'.$sHo;
		}
		$where = $Ball ? " WHERE g_type = '{$Ball}' " : "  ";
		$h="";
		for($i=1;$i<=17;$i++){
			$h.=" `h{$i}`=`h{$i}`".$sHo.",";
		}
		$h=substr($h,0,strlen($h)-1);
		$sql = "UPDATE g_odds9_default SET $h {$where} ";
		$db->query($sql, 2);
	}
	else if($mid==7)
	{
		initializeOddsjsk3();
		echo 0;exit;
	}
}

function showList($db, $result)
{
	$a = array(0=>'a',1=>'b',2=>'c',3=>'d',4=>'e',5=>'f',6=>'g',7=>'h');
	$arr = array();
	for ($s=0; $s<35; $s++){
		for ($i=0; $i<count($result); $i++){
			$n=$s+1;
			$arr[$s][$a[$i].'h'.$n] = $result[$i]['h'.($s+1)];
		}
	}
	return $arr;
}
?>

