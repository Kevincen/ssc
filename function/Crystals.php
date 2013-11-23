<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2012-1-1
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'class/SumCrystals.php';
function GetCrystals  ($db, $CentetArr, $result, $p=false, $total=0, $limit=null)
{
	if ($CentetArr['s_type'] == null){
		$t = "";
	} else {
		$t = " AND ".GetTypeString($CentetArr['s_type']);
		$CentetArr['s_types'] = null;
	}
	if ($CentetArr['s_types'] == null){
		$s = "";
	}else {
		$a =$CentetArr['s_types'];
		if ($a == 1){
			$s = " AND g_type='廣東快樂十分' ";
			//$date = " AND g_date > '{$CentetArr['startDate']} 00:00:00' AND g_date < '{$CentetArr['endDate']} 24:00:00' ";
		} else if ($a == 3){
			$s = " AND g_type='廣西快樂十分' ";
			//$date = " AND g_date > '{$CentetArr['startDate']} 00:00:00' AND g_date < '{$CentetArr['endDate']} 24:00:00' ";
		}else if($a==5){
			$s = " AND g_type='幸运农场' ";
		} else if($a==6){
			$s = " AND g_type='北京赛车PK10' ";
		} else if($a==7){
			$s = " AND g_type='六合彩' ";
		}else if($a==8){
			$s = " AND g_type='新疆時時彩' ";
		}else if($a==9){
			$s = " AND g_type='江苏骰寶(快3)' ";
		}else{
			$s = " AND g_type='重慶時時彩' ";
			//$date =" AND ".days($CentetArr['startDate'], $CentetArr['endDate']);
		}
	}
	if ($CentetArr['s_t_N'] == 1){
		//zerc 
		$end = dayMorning($CentetArr['endDate'], 60*60*24);
		$n = " AND g_date > '{$CentetArr['startDate']} 03:00:00' AND g_date < '{$end} 03:00:00' ";
	} else {
		if ($CentetArr['s_number'] == null) exit(back('請選擇查詢期數！'));
		$n = " AND g_qishu = '{$CentetArr['s_number']}'  ";
	}
	//$t = $CentetArr['s_type'] == null ? "" : " AND ".GetTypeString($CentetArr['s_type']); 			//下註類型
	$win = $CentetArr['s_Balance'] == 1 ? "AND g_win is not null " : " AND g_win is null ";	//結算狀態
	
	//$arr = array();
	//如果 == 9 語句更換、于會員名稱查詢注單
	if ($p){
		//$nid = " g_s_nid LIKE '{$result['g_nid']}' AND g_mumber_type = 2 ";
		$nid = " g_s_nid LIKE '{$result['g_nid']}' AND g_mumber_type = 5 ";
	}	else if ($result['g_login_id'] == 9){
		$nid = " g_nid = '{$result['g_name']}' ";
	} else {
		$nid = " g_s_nid LIKE '{$result['g_nid']}%' ";
	}

	$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_distribution_4`, `g_win`, `g_t_id` 
	FROM `g_zhudan` WHERE {$nid} {$s} {$n}  {$t}  {$win} order by g_id desc {$limit} ";
	//echo $sql.'<br/>';exit;
	//print_r($db->query($sql, 1))
	$result = $total == 0 ? $db->query($sql, 1) : $db->query($sql, 3);	
	return $result;
	
}




function GetCrystalsfen  ($db, $CentetArr, $result, $p=false, $total=0, $limit=null)
{
	if ($CentetArr['s_type'] == null){
		$t = "";
	} else {
		$t = " AND ".GetTypeStringfen($CentetArr['s_type']);
		$CentetArr['s_types'] = null;
	}
	if ($CentetArr['s_types'] == null){
		$s = "";
	}else {
		$a =$CentetArr['s_types'];
		if ($a == 1){
			$s = " AND g_type='廣東快樂十分' ";
			//$date = " AND g_date > '{$CentetArr['startDate']} 00:00:00' AND g_date < '{$CentetArr['endDate']} 24:00:00' ";
		} else if ($a == 3){
			$s = " AND g_type='廣西快樂十分' ";
			//$date = " AND g_date > '{$CentetArr['startDate']} 00:00:00' AND g_date < '{$CentetArr['endDate']} 24:00:00' ";
		}else if($a==5){
			$s = " AND g_type='幸运农场' ";
		} else if($a==6){
			$s = " AND g_type='北京赛车PK10' ";
		}else if($a==7){
			$s = " AND g_type='六合彩' ";
		}else if($a==8){
			$s = " AND g_type='新疆時時彩' ";
		}else if($a==9){
			$s = " AND g_type='江苏骰寶(快3)' ";
		}else{
			$s = " AND g_type='重慶時時彩' ";
			//$date =" AND ".days($CentetArr['startDate'], $CentetArr['endDate']);
		}
	}
	if ($CentetArr['s_t_N'] == 1){
		//zerc 
		$end = dayMorning($CentetArr['endDate'], 60*60*24);
		$n = " AND g_date > '{$CentetArr['startDate']} 03:00:00' AND g_date < '{$end} 03:00:00' ";
	} else {
		if ($CentetArr['s_number'] == null) exit(back('請選擇查詢期數！'));
		$n = " AND g_qishu = '{$CentetArr['s_number']}'  ";
	}
	//$t = $CentetArr['s_type'] == null ? "" : " AND ".GetTypeString($CentetArr['s_type']); 			//下註類型
	$win = $CentetArr['s_Balance'] == 1 ? "AND g_win is not null " : " AND g_win is null ";	//結算狀態
	
	//$arr = array();
	//如果 == 9 語句更換、于會員名稱查詢注單
	if ($p){
		//$nid = " g_s_nid LIKE '{$result['g_nid']}' AND g_mumber_type = 2 ";
		$nid = " g_s_nid LIKE '{$result['g_nid']}' AND g_mumber_type = 5 ";
	}	else if ($result['g_login_id'] == 9){
		$nid = " g_nid = '{$result['g_name']}' ";
	} else {
		$nid = " g_s_nid LIKE '{$result['g_nid']}%' ";
	}

	$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_distribution_4`, `g_win`, `g_t_id`,{$CentetArr['s_type']} as typeid 
	FROM `g_zhudan` WHERE {$nid} {$s} {$n}  {$t}  {$win} order by g_id desc {$limit} ";
	//echo $sql.'<br/>';exit;
	//print_r($db->query($sql, 1))
	$result = $total == 0 ? $db->query($sql, 1) : $db->query($sql, 3);	
	return $result;
	
}
/**
 * 下註類型匹配
 * 返回查詢字符串
 * @param String $type
 */
function GetTypeStringfen ($type)
{
	switch ($type)
	{
		case 1 : $a= "`g_mingxi_1` = '第一球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 2 : $a= "`g_mingxi_1` = '第二球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大'  and `g_mingxi_2` != '小' and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 3 : $a= "`g_mingxi_1` = '第三球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 4 : $a= "`g_mingxi_1` = '第四球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 5 : $a= "`g_mingxi_1` = '第五球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 6 : $a= "`g_mingxi_1` = '第六球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 7 : $a= "`g_mingxi_1` = '第七球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 8 : $a= "`g_mingxi_1` = '第八球'  AND g_type='廣東快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '東' and `g_mingxi_2` != '南' and `g_mingxi_2` != '西' and `g_mingxi_2` != '北')";break;
		case 9 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='廣東快樂十分' ";break;
		case 10 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='廣東快樂十分' ";break;
		case 11 : $a= "(`g_mingxi_2` = '尾數大' or `g_mingxi_2` = '尾數小') AND g_type='廣東快樂十分' ";break;
		case 12 : $a= "(`g_mingxi_2` = '合數單' or `g_mingxi_2` = '合數雙') AND g_type='廣東快樂十分' ";break;
		case 13 : $a= "(`g_mingxi_2` = '東' or `g_mingxi_2` = '南' or `g_mingxi_2` = '西' or `g_mingxi_2` = '北') AND g_type='廣東快樂十分' ";break;
		case 14 : $a= "(`g_mingxi_2` = '中' or `g_mingxi_2` = '發' or `g_mingxi_2`= '白') AND g_type='廣東快樂十分' ";break;
		case 15 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='廣東快樂十分' ";break;
		case 16 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='廣東快樂十分' ";break;
		case 17 : $a= "(`g_mingxi_2` = '總和尾大' or `g_mingxi_2` = '總和尾小') AND g_type='廣東快樂十分' ";break;
		case 18 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎') AND g_type='廣東快樂十分' ";break;
		case 19 : $a= "`g_mingxi_1` = '任選二' AND g_type='廣東快樂十分' ";break;
		case 20 : $a= "`g_mingxi_1` = '選二連直' AND g_type='廣東快樂十分' ";break;
		case 21 : $a= "`g_mingxi_1` = '選二連組' AND g_type='廣東快樂十分' ";break;
		case 22 : $a= "`g_mingxi_1` = '任選三' AND g_type='廣東快樂十分' ";break;
		case 23 : $a= "`g_mingxi_1` = '選三前直' AND g_type='廣東快樂十分' ";break;
		case 24 : $a= "`g_mingxi_1` = '選三前組' AND g_type='廣東快樂十分' ";break;
		case 25 : $a= "`g_mingxi_1` = '任選四' AND g_type='廣東快樂十分' ";break;
		case 26 : $a= "`g_mingxi_1` = '任選五' AND g_type='廣東快樂十分' ";break;
		case 27 : $a= "`g_mingxi_1` = '第一球'  AND g_type='重慶時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 28 : $a= "`g_mingxi_1` = '第二球'  AND g_type='重慶時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 29 : $a= "`g_mingxi_1` = '第三球'  AND g_type='重慶時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 30 : $a= "`g_mingxi_1` = '第四球'  AND g_type='重慶時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 31 : $a= "`g_mingxi_1` = '第五球'  AND g_type='重慶時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 32 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='重慶時時彩' ";break;
		case 33 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='重慶時時彩' ";break;
		case 34 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='重慶時時彩' ";break;
		case 35 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='重慶時時彩' ";break;
		case 36 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎' or `g_mingxi_2` = '和') AND g_type='重慶時時彩' ";break;
		case 37 : $a= "`g_mingxi_1` = '前三' AND g_type='重慶時時彩' ";break;
		case 38 : $a= "`g_mingxi_1` = '中三' AND g_type='重慶時時彩' ";break;
		case 39 : $a= "`g_mingxi_1` = '后三' AND g_type='重慶時時彩' ";break;
		
		case 40 : $a= "`g_mingxi_1` = '第一球'  AND g_type='廣西快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '神' and `g_mingxi_2` != '奇' and `g_mingxi_2` != '快' and `g_mingxi_2` != '乐' and `g_mingxi_2` != '红' and `g_mingxi_2` != '蓝' and `g_mingxi_2` != '绿' )";break;
		case 41 : $a= "`g_mingxi_1` = '第二球'  AND g_type='廣西快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '神' and `g_mingxi_2` != '奇' and `g_mingxi_2` != '快' and `g_mingxi_2` != '乐' and `g_mingxi_2` != '红' and `g_mingxi_2` != '蓝' and `g_mingxi_2` != '绿' )";break;
		case 42 : $a= "`g_mingxi_1` = '第三球'  AND g_type='廣西快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '神' and `g_mingxi_2` != '奇' and `g_mingxi_2` != '快' and `g_mingxi_2` != '乐' and `g_mingxi_2` != '红' and `g_mingxi_2` != '蓝' and `g_mingxi_2` != '绿' )";break;
		case 43 : $a= "`g_mingxi_1` = '第四球'  AND g_type='廣西快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '神' and `g_mingxi_2` != '奇' and `g_mingxi_2` != '快' and `g_mingxi_2` != '乐' and `g_mingxi_2` != '红' and `g_mingxi_2` != '蓝' and `g_mingxi_2` != '绿' )";break;
		case 44 : $a= "`g_mingxi_1` = '特码'  AND g_type='廣西快樂十分' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '神' and `g_mingxi_2` != '奇' and `g_mingxi_2` != '快' and `g_mingxi_2` != '乐' and `g_mingxi_2` != '红' and `g_mingxi_2` != '蓝' and `g_mingxi_2` != '绿' )";break;
		case 45 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='廣西快樂十分' ";break;
		case 46 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='廣西快樂十分' ";break;
		case 47 : $a= "(`g_mingxi_2` = '尾數大' or `g_mingxi_2` = '尾數小') AND g_type='廣西快樂十分' ";break;
		case 48 : $a= "(`g_mingxi_2` = '合數單' or `g_mingxi_2` = '合數雙') AND g_type='廣西快樂十分' ";break;
		case 49 : $a= "(`g_mingxi_2` = '神' or `g_mingxi_2` = '奇' or `g_mingxi_2` = '快' or `g_mingxi_2` = '乐') AND g_type='廣西快樂十分' ";break;
		case 50 : $a= "(`g_mingxi_2` = '红' or `g_mingxi_2` = '蓝' or `g_mingxi_2`= '绿') AND g_type='廣西快樂十分' ";break;
		case 51 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='廣西快樂十分' ";break;
		case 52 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='廣西快樂十分' ";break;
		case 53 : $a= "(`g_mingxi_2` = '總和尾大' or `g_mingxi_2` = '總和尾小') AND g_type='廣西快樂十分' ";break;
		case 54 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎') AND g_type='廣西快樂十分' ";break;
		case 55 : $a= "`g_mingxi_1` = '一中一' AND g_type='廣西快樂十分' ";break;
		case 56 : $a= "`g_mingxi_1` = '二中二' AND g_type='廣西快樂十分' ";break;
		case 57 : $a= "`g_mingxi_1` = '三中二' AND g_type='廣西快樂十分' ";break;
		case 58 : $a= "`g_mingxi_1` = '三中三' AND g_type='廣西快樂十分' ";break;
		case 59 : $a= "`g_mingxi_1` = '四中三' AND g_type='廣西快樂十分' ";break;
		case 60 : $a= "`g_mingxi_1` = '五中三' AND g_type='廣西快樂十分' ";break;
		
			case 61 : $a= "`g_mingxi_1` = '冠军'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 62 : $a= "`g_mingxi_1` = '亚军'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大'  and `g_mingxi_2` != '小' and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 63 : $a= "`g_mingxi_1` = '第三名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 64 : $a= "`g_mingxi_1` = '第四名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 65 : $a= "`g_mingxi_1` = '第五名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎')";break;
		case 66 : $a= "`g_mingxi_1` = '第六名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 67 : $a= "`g_mingxi_1` = '第七名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 68 : $a= "`g_mingxi_1` = '第八名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 69 : $a= "`g_mingxi_1` = '第九名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 70 : $a= "`g_mingxi_1` = '第十名'  AND g_type='北京赛车PK10' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '龍' and `g_mingxi_2` != '虎' )";break;
		case 71 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='北京赛车PK10' ";break;
		case 72 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='北京赛车PK10' ";break;
		case 73 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎') AND g_type='北京赛车PK10' ";break;
		
		case 74 : $a= "`g_mingxi_1` = '冠、亞軍和' AND g_type='北京赛车PK10' ";break;
		case 75 : $a= "(`g_mingxi_2` = '冠亞和大' or `g_mingxi_2` = '冠亞和小') AND g_type='北京赛车PK10' ";break;
		case 76 : $a= "(`g_mingxi_2` = '冠亞和單' or `g_mingxi_2` = '冠亞和雙') AND g_type='北京赛车PK10' ";break;
		
		case 77 :  $a= "`g_mingxi_1` = '特碼' AND g_type='六合彩' ";break;
		case 78 :  $a= "`g_mingxi_1` = '正碼一' AND g_type='六合彩' ";break;
		case 79 :  $a= "`g_mingxi_1` = '正碼二' AND g_type='六合彩' ";break;
		case 80 :  $a= "`g_mingxi_1` = '正碼三' AND g_type='六合彩' ";break;
		case 81 :  $a= "`g_mingxi_1` = '正碼四' AND g_type='六合彩' ";break;
		case 82 :  $a= "`g_mingxi_1` = '正碼五' AND g_type='六合彩' ";break;
		case 83 :  $a= "`g_mingxi_1` = '正碼六' AND g_type='六合彩' ";break;
		case 84 :  $a= "`g_mingxi_1` = '正碼' AND g_type='六合彩' ";break;
		case 85 :  $a= "`g_mingxi_1` = '半波' AND g_type='六合彩' ";break;
		case 86 :  $a= "`g_mingxi_1` = '五行' AND g_type='六合彩' ";break;
		case 87 :  $a= "`g_mingxi_1` = '特碼生肖' AND g_type='六合彩' ";break;
		case 88 :  $a= "`g_mingxi_1` = '一肖' AND g_type='六合彩' ";break;
		case 89 :  $a= "`g_mingxi_1` = '特尾' AND g_type='六合彩' ";break;
		case 90 :  $a= "`g_mingxi_1` = '尾數' AND g_type='六合彩' ";break;
		case 91 :  $a= "`g_mingxi_1` = '特碼頭' AND g_type='六合彩' ";break;
		
		case 774 : $a= "`g_mingxi_1` = '第一球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 775 : $a= "`g_mingxi_1` = '第二球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大'  and `g_mingxi_2` != '小' and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 776 : $a= "`g_mingxi_1` = '第三球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 777 : $a= "`g_mingxi_1` = '第四球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 778 : $a= "`g_mingxi_1` = '第五球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 779 : $a= "`g_mingxi_1` = '第六球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 780 : $a= "`g_mingxi_1` = '第七球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 781 : $a= "`g_mingxi_1` = '第八球'  AND g_type='幸运农场' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙' and `g_mingxi_2` != '梅' and `g_mingxi_2` != '兰' and `g_mingxi_2` != '菊' and `g_mingxi_2` != '竹' and `g_mingxi_2` != '中' and `g_mingxi_2` != '發' and `g_mingxi_2` != '白' and `g_mingxi_2` != '尾數大'  and `g_mingxi_2` != '尾數小'  and `g_mingxi_2` != '合數單'  and `g_mingxi_2` != '合數雙'  )";break;
		case 782 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='幸运农场' ";break;
		case 783 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='幸运农场' ";break;
		case 784 : $a= "(`g_mingxi_2` = '尾數大' or `g_mingxi_2` = '尾數小') AND g_type='幸运农场' ";break;
		case 785 : $a= "(`g_mingxi_2` = '合數單' or `g_mingxi_2` = '合數雙') AND g_type='幸运农场' ";break;
		case 786 : $a= "(`g_mingxi_2` = '梅' or `g_mingxi_2` = '兰' or `g_mingxi_2` = '菊' or `g_mingxi_2` = '竹') AND g_type='幸运农场' ";break;
		case 787 : $a= "(`g_mingxi_2` = '中' or `g_mingxi_2` = '發' or `g_mingxi_2`= '白') AND g_type='幸运农场' ";break;
		case 788 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='幸运农场' ";break;
		case 789 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='幸运农场' ";break;
		case 790 : $a= "(`g_mingxi_2` = '總和尾大' or `g_mingxi_2` = '總和尾小') AND g_type='幸运农场' ";break;
		case 791 : $a= "(`g_mingxi_2` = '家禽' or `g_mingxi_2` = '野兽') AND g_type='幸运农场' ";break;
		case 792 : $a= "`g_mingxi_1` = '蔬菜单选' AND g_type='幸运农场' ";break;
		case 793 : $a= "`g_mingxi_1` = '动物单选' AND g_type='幸运农场' ";break;
		case 794 : $a= "`g_mingxi_1` = '幸运二' AND g_type='幸运农场' ";break;
		case 795 : $a= "`g_mingxi_1` = '连连中' AND g_type='幸运农场' ";break;
		case 796 : $a= "`g_mingxi_1` = '背靠背' AND g_type='幸运农场' ";break;
		case 797 : $a= "`g_mingxi_1` = '幸运三' AND g_type='幸运农场' ";break;
		case 798 : $a= "`g_mingxi_1` = '幸运四' AND g_type='幸运农场' ";break;
		case 799 : $a= "`g_mingxi_1` = '幸运五' AND g_type='幸运农场' ";break;
		
		
		case 827 : $a= "`g_mingxi_1` = '第一球'  AND g_type='新疆時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 828 : $a= "`g_mingxi_1` = '第二球'  AND g_type='新疆時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 829 : $a= "`g_mingxi_1` = '第三球'  AND g_type='新疆時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 830 : $a= "`g_mingxi_1` = '第四球'  AND g_type='新疆時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 831 : $a= "`g_mingxi_1` = '第五球'  AND g_type='新疆時時彩' AND (`g_mingxi_2` != '大' and `g_mingxi_2` != '小'  and  `g_mingxi_2` != '單'  and `g_mingxi_2` != '雙')";break;
		case 832 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='新疆時時彩' ";break;
		case 833 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='新疆時時彩' ";break;
		case 834 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='新疆時時彩' ";break;
		case 835 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='新疆時時彩' ";break;
		case 836 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎' or `g_mingxi_2` = '和') AND g_type='新疆時時彩' ";break;
		case 837 : $a= "`g_mingxi_1` = '前三' AND g_type='新疆時時彩' ";break;
		case 838 : $a= "`g_mingxi_1` = '中三' AND g_type='新疆時時彩' ";break;
		case 839 : $a= "`g_mingxi_1` = '后三' AND g_type='新疆時時彩' ";break;
		
		case 901 : $a= "`g_mingxi_1` = '三軍' AND g_type='江苏骰寶(快3)' ";break;
		case 902 : $a= "`g_mingxi_1` = '圍骰、全骰' AND g_type='江苏骰寶(快3)' ";break;
		case 903 : $a= "`g_mingxi_1` = '點數' AND g_type='江苏骰寶(快3)' ";break;
		case 904 : $a= "`g_mingxi_1` = '長牌' AND g_type='江苏骰寶(快3)' ";break;
		case 905 : $a= "`g_mingxi_1` = '短牌' AND g_type='江苏骰寶(快3)' ";break; 
	}
	return $a;
}



function GetTypeString ($type)
{
	switch ($type)
	{
		case 1 : $a= "`g_mingxi_1` = '第一球'  AND g_type='廣東快樂十分' ";break;
		case 2 : $a= "`g_mingxi_1` = '第二球'  AND g_type='廣東快樂十分' ";break;
		case 3 : $a= "`g_mingxi_1` = '第三球'  AND g_type='廣東快樂十分' ";break;
		case 4 : $a= "`g_mingxi_1` = '第四球'  AND g_type='廣東快樂十分' ";break;
		case 5 : $a= "`g_mingxi_1` = '第五球'  AND g_type='廣東快樂十分' ";break;
		case 6 : $a= "`g_mingxi_1` = '第六球'  AND g_type='廣東快樂十分' ";break;
		case 7 : $a= "`g_mingxi_1` = '第七球'  AND g_type='廣東快樂十分' ";break;
		case 8 : $a= "`g_mingxi_1` = '第八球'  AND g_type='廣東快樂十分' ";break;
		case 9 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='廣東快樂十分' ";break;
		case 10 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='廣東快樂十分' ";break;
		case 11 : $a= "(`g_mingxi_2` = '尾數大' or `g_mingxi_2` = '尾數小') AND g_type='廣東快樂十分' ";break;
		case 12 : $a= "(`g_mingxi_2` = '合數單' or `g_mingxi_2` = '合數雙') AND g_type='廣東快樂十分' ";break;
		case 13 : $a= "(`g_mingxi_2` = '東' or `g_mingxi_2` = '南' or `g_mingxi_2` = '西' or `g_mingxi_2` = '北') AND g_type='廣東快樂十分' ";break;
		case 14 : $a= "(`g_mingxi_2` = '中' or `g_mingxi_2` = '發' or `g_mingxi_2`= '白') AND g_type='廣東快樂十分' ";break;
		case 15 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='廣東快樂十分' ";break;
		case 16 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='廣東快樂十分' ";break;
		case 17 : $a= "(`g_mingxi_2` = '總和尾大' or `g_mingxi_2` = '總和尾小') AND g_type='廣東快樂十分' ";break;
		case 18 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎') AND g_type='廣東快樂十分' ";break;
		case 19 : $a= "`g_mingxi_1` = '任選二' AND g_type='廣東快樂十分' ";break;
		case 20 : $a= "`g_mingxi_1` = '選二連直' AND g_type='廣東快樂十分' ";break;
		case 21 : $a= "`g_mingxi_1` = '選二連組' AND g_type='廣東快樂十分' ";break;
		case 22 : $a= "`g_mingxi_1` = '任選三' AND g_type='廣東快樂十分' ";break;
		case 23 : $a= "`g_mingxi_1` = '選三前直' AND g_type='廣東快樂十分' ";break;
		case 24 : $a= "`g_mingxi_1` = '選三前組' AND g_type='廣東快樂十分' ";break;
		case 25 : $a= "`g_mingxi_1` = '任選四' AND g_type='廣東快樂十分' ";break;
		case 26 : $a= "`g_mingxi_1` = '任選五' AND g_type='廣東快樂十分' ";break;
		case 27 : $a= "`g_mingxi_1` = '第一球'  AND g_type='重慶時時彩' ";break;
		case 28 : $a= "`g_mingxi_1` = '第二球'  AND g_type='重慶時時彩' ";break;
		case 29 : $a= "`g_mingxi_1` = '第三球'  AND g_type='重慶時時彩' ";break;
		case 30 : $a= "`g_mingxi_1` = '第四球'  AND g_type='重慶時時彩' ";break;
		case 31 : $a= "`g_mingxi_1` = '第五球'  AND g_type='重慶時時彩' ";break;
		case 32 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='重慶時時彩' ";break;
		case 33 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='重慶時時彩' ";break;
		case 34 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='重慶時時彩' ";break;
		case 35 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='重慶時時彩' ";break;
		case 36 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎' or `g_mingxi_2` = '和') AND g_type='重慶時時彩' ";break;
		case 37 : $a= "`g_mingxi_1` = '前三' AND g_type='重慶時時彩' ";break;
		case 38 : $a= "`g_mingxi_1` = '中三' AND g_type='重慶時時彩' ";break;
		case 39 : $a= "`g_mingxi_1` = '后三' AND g_type='重慶時時彩' ";break;
		
		case 40 : $a= "`g_mingxi_1` = '第一球'  AND g_type='廣西快樂十分' ";break;
		case 41 : $a= "`g_mingxi_1` = '第二球'  AND g_type='廣西快樂十分' ";break;
		case 42 : $a= "`g_mingxi_1` = '第三球'  AND g_type='廣西快樂十分' ";break;
		case 43 : $a= "`g_mingxi_1` = '第四球'  AND g_type='廣西快樂十分' ";break;
		case 44 : $a= "`g_mingxi_1` = '特码'  AND g_type='廣西快樂十分' ";break;
		case 45 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='廣西快樂十分' ";break;
		case 46 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='廣西快樂十分' ";break;
		case 47 : $a= "(`g_mingxi_2` = '尾數大' or `g_mingxi_2` = '尾數小') AND g_type='廣西快樂十分' ";break;
		case 48 : $a= "(`g_mingxi_2` = '合數單' or `g_mingxi_2` = '合數雙') AND g_type='廣西快樂十分' ";break;
		case 49 : $a= "(`g_mingxi_2` = '神' or `g_mingxi_2` = '奇' or `g_mingxi_2` = '快' or `g_mingxi_2` = '乐') AND g_type='廣西快樂十分' ";break;
		case 50 : $a= "(`g_mingxi_2` = '红' or `g_mingxi_2` = '蓝' or `g_mingxi_2`= '绿') AND g_type='廣西快樂十分' ";break;
		case 51 : $a= "(`g_mingxi_2` = '總和大' or `g_mingxi_2` = '總和小') AND g_type='廣西快樂十分' ";break;
		case 52 : $a= "(`g_mingxi_2` = '總和單' or `g_mingxi_2` = '總和雙') AND g_type='廣西快樂十分' ";break;
		case 53 : $a= "(`g_mingxi_2` = '總和尾大' or `g_mingxi_2` = '總和尾小') AND g_type='廣西快樂十分' ";break;
		case 54 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎') AND g_type='廣西快樂十分' ";break;
		case 55 : $a= "`g_mingxi_1` = '一中一' AND g_type='廣西快樂十分' ";break;
		case 56 : $a= "`g_mingxi_1` = '二中二' AND g_type='廣西快樂十分' ";break;
		case 57 : $a= "`g_mingxi_1` = '三中二' AND g_type='廣西快樂十分' ";break;
		case 58 : $a= "`g_mingxi_1` = '三中三' AND g_type='廣西快樂十分' ";break;
		case 59 : $a= "`g_mingxi_1` = '四中三' AND g_type='廣西快樂十分' ";break;
		case 60 : $a= "`g_mingxi_1` = '五中三' AND g_type='廣西快樂十分' ";break;
		
		case 61 : $a= "`g_mingxi_1` = '冠军'  AND g_type='北京赛车PK10' ";break;
		case 62 : $a= "`g_mingxi_1` = '亚军'  AND g_type='北京赛车PK10' ";break;
		case 63 : $a= "`g_mingxi_1` = '第三名'  AND g_type='北京赛车PK10' ";break;
		case 64 : $a= "`g_mingxi_1` = '第四名'  AND g_type='北京赛车PK10' ";break;
		case 65 : $a= "`g_mingxi_1` = '第五名'  AND g_type='北京赛车PK10' ";break;
		case 66 : $a= "`g_mingxi_1` = '第六名'  AND g_type='北京赛车PK10' ";break;
		case 67 : $a= "`g_mingxi_1` = '第七名'  AND g_type='北京赛车PK10' ";break;
		case 68 : $a= "`g_mingxi_1` = '第八名'  AND g_type='北京赛车PK10' ";break;
		case 69 : $a= "`g_mingxi_1` = '第九名'  AND g_type='北京赛车PK10' ";break;
		case 70 : $a= "`g_mingxi_1` = '第十名'  AND g_type='北京赛车PK10' ";break;
		case 71 : $a= "(`g_mingxi_2` = '大' or `g_mingxi_2` = '小') AND g_type='北京赛车PK10' ";break;
		case 72 : $a= "(`g_mingxi_2` = '單' or `g_mingxi_2` = '雙') AND g_type='北京赛车PK10' ";break;
		case 73 : $a= "(`g_mingxi_2` = '龍' or `g_mingxi_2` = '虎') AND g_type='北京赛车PK10' ";break;
		case 74 : $a= "`g_mingxi_1` = '冠、亞軍和' AND g_type='北京赛车PK10' ";break;
		case 75 : $a= "(`g_mingxi_2` = '冠亞和大' or `g_mingxi_2` = '冠亞和小') AND g_type='北京赛车PK10' ";break;
		case 76 : $a= "(`g_mingxi_2` = '冠亞和單' or `g_mingxi_2` = '冠亞和雙') AND g_type='北京赛车PK10' ";break; 
		
		case 77 : $a= "`g_mingxi_1` = '特碼'  AND g_type='六合彩' ";break;
		case 78 : $a= "`g_mingxi_1` = '正碼一'  AND g_type='六合彩' ";break;
		case 79 : $a= "`g_mingxi_1` = '正碼二'  AND g_type='六合彩' ";break;
		case 80 : $a= "`g_mingxi_1` = '正碼三'  AND g_type='六合彩' ";break;
		case 81 : $a= "`g_mingxi_1` = '正碼四'  AND g_type='六合彩' ";break;
		case 82 : $a= "`g_mingxi_1` = '正碼五'  AND g_type='六合彩' ";break;
		case 83 : $a= "`g_mingxi_1` = '正碼六'  AND g_type='六合彩' ";break;
		case 84 : $a= "`g_mingxi_1` = '正碼'  AND g_type='六合彩' ";break;
		case 85 : $a= "`g_mingxi_1` = '半波'  AND g_type='六合彩' ";break;
		case 86 : $a= "`g_mingxi_1` = '五行'  AND g_type='六合彩' ";break;
		case 87 : $a= "`g_mingxi_1` = '特碼生肖'  AND g_type='六合彩' ";break;
		case 88 : $a= "`g_mingxi_1` = '一肖'  AND g_type='六合彩' ";break;
		case 89 : $a= "`g_mingxi_1` = '特尾'  AND g_type='六合彩' ";break;
		case 90 : $a= "`g_mingxi_1` = '尾數'  AND g_type='六合彩' ";break;
		case 91 : $a= "`g_mingxi_1` = '特碼頭'  AND g_type='六合彩' ";break;
	}
	return $a;
}
/**
 * 得到下級所有帳號
 * $p=true 查询会员表，返回代理的所有會員
 * @param unknown_type $db
 * @param unknown_type $name
 * @param unknown_type $prarm
 */
function ResultNid ($db, $name, $prarm=FALSE, $p=FALSE)
{
	$db = new DB();
	if ($p){
		$sql = "SELECT `g_nid`,`g_login_id`, `g_name`, `g_f_name`, `g_distribution`, `g_panlu` FROM `g_user` WHERE g_nid = '{$name}'";
		$result = $db->query($sql, 1);
	} else {
		if ($prarm) {
			$sql = "(SELECT `g_nid` , `g_login_id` , `g_name` , `g_f_name` , `g_distribution_limit` AS g_distribution, `g_distribution` AS g_distribution1 FROM `g_rank` WHERE g_nid LIKE '{$name}') UNION ";
			$sql .= "(SELECT `g_nid` , `g_login_id` , `g_name` , `g_f_name` , `g_distribution`  g_distribution,4 FROM `g_user` WHERE `g_mumber_type` = 2 AND g_nid LIKE '{$name}')";
		} else {
			$sql = "SELECT `g_nid`,`g_login_id`, `g_name`, `g_f_name`, `g_distribution_limit` as g_distribution, `g_distribution` AS g_distribution1 FROM `g_rank` WHERE g_name = '{$name}' LIMIT 1";
		}
		$result = $db->query($sql, 1);
	}
	return $result;
}

/**
 * 查詢直屬會員
 * Enter description here ...
 * @param unknown_type $db
 * @param unknown_type $nid
 */
function GetRankMember ($db, $nid)
{
	$sql = "SELECT `g_nid`,`g_login_id`, `g_name`, `g_f_name`, `g_distribution` FROM `g_user` WHERE `g_mumber_type` = 2 AND `g_nid` = '{$nid}'";
	$result = $db->query($sql, 1);
	return $result;
}

function SumCrystalsfen ($CentetArr)
{

$cry = new SumCrystals();
	if ($CentetArr['cryList'] != null && Copyright)
	{
		$count = array();
		for ($__i=0; $__i<13; $__i++) 
			$count[0][$__i] =0;
		for ($i=0; $i<count($CentetArr['cryList']); $i++)
		{
			for ($_i=0; $_i<13; $_i++) {
				$count[1][$_i] =0;
				$count[2][$_i] =0;
			}
			$CentetArr['userList']['s_rank_1'] = $CentetArr['cryList'][$i]['s_rank'];
			//$s_rank = $CentetArr['cryList'][$i]['s_rank'];
			$zcpj=0;
			for ($n=0; $n<count($CentetArr['cryList'][$i]['cry']); $n++)
			{
				$lid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid'])-32);
                $xid = mb_substr($CentetArr['cryList'][$i]['cry'][$n]['g_s_nid'], 0, mb_strlen($CentetArr['cryList'][$i]['cry'][$n]['g_s_nid'])-32);
				if ($CentetArr['cryList'][$i]['cry'][$n]['g_mingxi_1_str'] != null && Copyright){ //連碼
					$count[2][0] = $CentetArr['cryList'][$i]['cry'][$n]['g_mingxi_1_str']*$CentetArr['cryList'][$i]['cry'][$n]['g_jiner'];
				}
				else {
					$count[2][0] = $CentetArr['cryList'][$i]['cry'][$n]['g_jiner'];
				}
				//會員總筆數
				$count[1][0] = $n+1;  
				//退水
				$count[2][1] = sumTuiSui($CentetArr['cryList'][$i]['cry'][$n], $CentetArr['cryList'][$i]['g_login_id']) * $count[2][0];
				//佔成 
				$count[2][2] = $CentetArr['cryList'][$i]['g_distribution'] / 100;
				//會員退水
				$count[2][8] = ((100 -$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui']) /100)*$count[2][0]; 
				//會員輸贏单笔 已经减去水钱
				$count[2][9] = $CentetArr['cryList'][$i]['cry'][$n]['g_win'] != 0 ? $CentetArr['cryList'][$i]['cry'][$n]['g_win'] - $count[2][8] : 0; 


				$count[2][7] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1']) /100*$count[2][0]; //代理退水
				$count[2][6] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_2']) /100*$count[2][0]; //總理退水
				$count[2][5] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_3']) /100*$count[2][0]; //股理退水
				$count[2][10] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_4']) /100*$count[2][0]; //公司退水
				$count[2][11] =  (100-100) /100*$count[2][0]; //总公司退水
				//會員總下注金額
				$count[1][1] += $count[2][0];
				//會員輸贏
				$count[1][2] += $count[2][9];
				
				switch ($CentetArr['cryList'][$i]['g_login_id'])
				{
				case 89 :  //公司報表
						if ($count[2][9] != 0){
							if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1'] == 0 && Copyright)
								$count[2][7] = $count[2][8];
							$count[2][4] = (100 -$CentetArr['cryList'][$i]['cry'][$n]['g_distribution'])/100;
							$al= ($count[2][7]-$count[2][8])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']/100);
							$x = ($count[2][9]+$count[2][8])*$count[2][4]+$al; //代理應收下綫
							
							$dl = ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1'])/100;
							$c = ($count[2][9]+$count[2][7])* $dl; //實占結果
							
							$dzs = (100 -($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']))/100;
							$dzs2= ($count[2][6]-$count[2][7])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']/100);//賺水
							$cc = $x - ($c - $dzs2); //總代理應付

							if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_2'] == 0)
								$count[2][6] = $count[2][8];
							$_x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$_cc = $cry->SumZDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd2 = $cry->SumGD($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd3 = ($_x - $_cc) - $gd2;
							$count[1][5] += $gd3; //總代理輸贏									
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數							
							if ($count[2][9] != 0 && Copyright){
								$sz = ($count[2][9]+$count[2][10])*($count[1][4]/100); //實占結果
								$count[1][7] += $sz;
								if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_3'] == 0){
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10]; 
								}
								$zwin = $sz - $zs;
								$x = $count[2][9]+$count[2][8];
								$count[1][3] += $x - $zwin;  //應收下綫
								}else{
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10]-$count[2][5])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10]-$count[2][5]; 
								}
								$zwin = $sz - $zs;
								$count[1][3] += $gd3 - $zwin; //應付上級
								}
							}
							
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_4']; //實占成數
							$zcpj += $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_4']; //實占成數
						
						}
						break;
					case 56 :  //分公司報表
							$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']/100;
							
						if ($CentetArr['cryList'][$i]['cry'][$n]['g_mumber_type'] == 2 && $lid == $xid) 
						{
							if ($count[2][9] != 0 && Copyright){
								$x = $count[2][9]+$count[2][8]; //應收下綫
								$count[1][3] += $x;
							}
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$zcpj += $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][8]*($count[1][4]/100); //實占退水
								$sz = ($count[2][9]+$count[2][8])*($count[1][4]/100); //實占結果
								$count[1][7] += $sz;
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10]  -$count[2][8])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10] -$count[2][8]; 
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin; //賺水后結果
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $x - $zwin; //應付上級
							}
						} 
						else 
						{
							if ($count[2][9] != 0){
								if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1'] == 0 && Copyright)
								$count[2][7] = $count[2][8];
							$count[2][4] = (100 -$CentetArr['cryList'][$i]['cry'][$n]['g_distribution'])/100;
							$al= ($count[2][7]-$count[2][8])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']/100);
							$x = ($count[2][9]+$count[2][8])*$count[2][4]+$al; //代理應收下綫
							
							$dl = ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1'])/100;
							$c = ($count[2][9]+$count[2][7])* $dl; //實占結果
							
							$dzs = (100 -($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']))/100;
							$dzs2= ($count[2][6]-$count[2][7])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']/100);//賺水
							$cc = $x - ($c - $dzs2); //總代理應付

							if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_2'] == 0)
								$count[2][6] = $count[2][8];
							$_x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$_cc = $cry->SumZDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd2 = $cry->SumGD($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd3 = ($_x - $_cc) - $gd2;
							$count[1][3] += $gd3; //應收下綫
							}
							
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$zcpj += $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][10]*($count[1][4]/100); //實占退水
								$sz = ($count[2][9]+$count[2][10])*($count[1][4]/100); //實占結果
								$count[1][7] += $sz;
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10]-$count[2][5])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10]-$count[2][5]; 
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin; //賺水后結果
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $gd3 - $zwin; //應付上級
							}
							}
						break;
					
					case 22 :  //股東報表
						$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']/100;
						
						if ($CentetArr['cryList'][$i]['cry'][$n]['g_mumber_type'] == 2 && $lid == $xid) 
						{
							if ($count[2][9] != 0 && Copyright){
								$x = $count[2][9]+$count[2][8]; //應收下綫
								$count[1][3] += $x;
								
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0){
								$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][8])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0 && Copyright){
									$zs = ($count[2][5]-$count[2][8])*(1-$count[2][2]);
								}else {
									$zs = $count[2][5] - $count[2][8];
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin;
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']))/100; //佔成 / 100 反取
								$count[1][10] += $count[2][0] * $count[2][4]; //貢獻上級
								$count[1][11] += $x - $zwin;
							}
						} 
						else 
						{
							if ($count[2][9] != 0){
								if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1'] == 0)
									$count[2][7] = $count[2][8];
								$x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
								$c = $cry->SumZDL($CentetArr['cryList'][$i]['cry'][$n], $count);
								$cc = $x - $c;
								$count[1][3] +=$cc; //應收下綫
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][6]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][6])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0){
									$zs= ($count[2][5]-$count[2][6])*(1-$count[2][2]);
								}else {
									$zs= $count[2][5]-$count[2][6]; 
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin; //賺水后結果
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $cc - $zwin; //應付上級
							}
						}
						break;
					case 78 : //總代理報表
						$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']/100;
						if ($CentetArr['cryList'][$i]['cry'][$n]['g_mumber_type'] == 2 && $lid == $xid) 
						{
							if ($count[2][9] != 0 && Copyright){
								$x = $count[2][9] + $count[2][8]; //應收下綫
								$count[1][3] += $x;
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0){
								$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][8])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0){
									$zs = ($count[2][6]-$count[2][8])*(1-$count[2][2]); //賺取水錢
								}else {
									$zs = $count[2][6] - $count[2][8]; //賺取水錢
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs;
								$count[1][9] += $zwin; //賺水后結果
								$count[2][5] = 1 - $count[2][2]; //佔成 / 100 反取
								$count[1][10] += $count[2][0] * $count[2][5]; //貢獻上級
								$count[1][11] += $x - $zwin;
							}
						} 
						else 
						{
							if ($count[2][9] != 0){
								$x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
								$count[1][3] +=$x; //應收代理
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][7]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][7])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0 && Copyright){
									$zs = ($count[2][6]-$count[2][7])*(1-$count[2][2]); //賺取水錢
								}else {
									$zs = $count[2][6] - $count[2][7];
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs;
								$count[1][9] += $zwin;
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $x - $zwin; //應付上級
							}
						}
						break;
					case 48 : //代理報表
						$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution']/100;
						if ($count[2][9] != 0){
							$x = $count[2][9] + $count[2][8]; //應收下綫
							$count[1][3] += $x;
						}
						$count[1][4] = 100*$count[2][2]; //實占成數
						$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
						$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
						if ($count[2][9] != 0){
							$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
							$sz = ($count[2][9]+$count[2][8])*$count[2][2]; //實占結果
							$count[1][7] += $sz;
							if ($count[2][2]>0){
								$zs = ($count[2][7]-$count[2][8])*(1-$count[2][2]); //賺取水錢
							}else {
								$zs = $count[2][7] - $count[2][8]; //賺取水錢
							}
							$zwin = $sz - $zs;
							$count[1][8] += $zs;
							$count[1][9] += $zwin; //賺水后結果
							$count[2][5] = 1 - $count[2][2]; //佔成 / 100 反取
							$count[1][10] += $count[2][0] * $count[2][5]; //貢獻上級
							$count[1][11] += $x - $zwin;
						}
						break;
				}
			}
			
			$CentetArr['cryList'][$i]['s_count'] = $count[1][0]; //會員總筆數 
			$CentetArr['cryList'][$i]['s_countMoney'] = $count[1][1]; //會員下注總金額
			$CentetArr['cryList'][$i]['s_memberWin'] = $count[1][2]; //下綫輸贏
			$CentetArr['cryList'][$i]['s_memberJieGuo'] = $count[1][3]; //應收下綫
			
			if($CentetArr['cryList'][$i]['g_login_id']==89||$CentetArr['cryList'][$i]['g_login_id']==56){
			$CentetArr['cryList'][$i]['s_distribution'] = round($zcpj/$count[1][0],3); //占成
			}
			else
			$CentetArr['cryList'][$i]['s_distribution'] = $count[1][4]; //占成
			$CentetArr['cryList'][$i]['s_ShiZhanZhiEr'] = $count[1][12]; //實占註額
			$CentetArr['cryList'][$i]['s_shizhanWin'] = $count[1][5]; //實占輸贏
			$CentetArr['cryList'][$i]['s_shizhanTuiShui'] = $count[1][6];	//實占退水
			$CentetArr['cryList'][$i]['s_shizhanTuiShuiWin'] = $count[1][7];	//實占結果
			$CentetArr['cryList'][$i]['s_WinSui'] = $count[1][8];	//賺取水錢
			$CentetArr['cryList'][$i]['s_WinSuiJieGuo'] = $count[1][9]; //賺取水錢結果
			$CentetArr['cryList'][$i]['s_memberWin_S'] = $count[1][10]; //貢獻上級
			$CentetArr['cryList'][$i]['s_memberWin_Y'] = $count[1][11]; //應付上級
			for ($k=0; $k<13; $k++) {
				$count[0][$k] += $count[1][$k];
			}
		}
		$CentetArr['userList']['count_info'] = 0;
		if (isset($CentetArr['userInfo']))
		{
			for ($i=0; $i<count($CentetArr['userInfo']); $i++){
				$CentetArr['userList']['count_info'] += $CentetArr['userInfo'][$i]['g_win'];
			}
		}
		$CentetArr['userList']['count_s'] = $count[0];
	}
	return $CentetArr;
}
/**
 * 
 * 計算報表
 * @param array $CentetArr
 */
function SumCrystals ($CentetArr)
{
	$cry = new SumCrystals();
	if ($CentetArr['cryList'] != null && Copyright)
	{
		$count = array();
		for ($__i=0; $__i<13; $__i++) 
			$count[0][$__i] =0;
		for ($i=0; $i<count($CentetArr['cryList']); $i++)
		{
			for ($_i=0; $_i<13; $_i++) {
				$count[1][$_i] =0;
				$count[2][$_i] =0;
			}
			$CentetArr['userList']['s_rank_1'] = $CentetArr['cryList'][$i]['s_rank'];
			//$s_rank = $CentetArr['cryList'][$i]['s_rank'];
			for ($n=0; $n<count($CentetArr['cryList'][$i]['cry']); $n++)
			{
				$lid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid'])-32);
                $xid = mb_substr($CentetArr['cryList'][$i]['cry'][$n]['g_s_nid'], 0, mb_strlen($CentetArr['cryList'][$i]['cry'][$n]['g_s_nid'])-32);
				if ($CentetArr['cryList'][$i]['cry'][$n]['g_mingxi_1_str'] != null && Copyright){ //連碼
					$count[2][0] = $CentetArr['cryList'][$i]['cry'][$n]['g_mingxi_1_str']*$CentetArr['cryList'][$i]['cry'][$n]['g_jiner'];
				}
				else {
					$count[2][0] = $CentetArr['cryList'][$i]['cry'][$n]['g_jiner'];
				}
				//會員總筆數
				$count[1][0] = $n+1;  
				//退水
				$count[2][1] = sumTuiSui($CentetArr['cryList'][$i]['cry'][$n], $CentetArr['cryList'][$i]['g_login_id']) * $count[2][0];
				//佔成 
				$count[2][2] = $CentetArr['cryList'][$i]['g_distribution'] / 100;
				//會員退水
				$count[2][8] = ((100 -$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui']) /100)*$count[2][0]; 
				//會員輸贏单笔 已经减去水钱
				$count[2][9] = $CentetArr['cryList'][$i]['cry'][$n]['g_win'] != 0 ? $CentetArr['cryList'][$i]['cry'][$n]['g_win'] - $count[2][8] : 0; 

				$count[2][7] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1']) /100*$count[2][0]; //代理退水
				$count[2][6] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_2']) /100*$count[2][0]; //總理退水
				$count[2][5] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_3']) /100*$count[2][0]; //股东退水
				$count[2][10] =  (100-$CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_4']) /100*$count[2][0]; //分公司退水
				$count[2][11] =  (100-100) /100*$count[2][0]; //总公司退水
				
				//會員總下注金額
				$count[1][1] += $count[2][0];
				//會員輸贏
				$count[1][2] += $count[2][9];
				switch ($CentetArr['cryList'][$i]['g_login_id'])
				{
				case 56 :  //公司報表
						if ($count[2][9] != 0){
							if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1'] == 0 && Copyright)
								$count[2][7] = $count[2][8];
							$count[2][4] = (100 -$CentetArr['cryList'][$i]['cry'][$n]['g_distribution'])/100;
							$al= ($count[2][7]-$count[2][8])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']/100);
							$x = ($count[2][9]+$count[2][8])*$count[2][4]+$al; //代理應收下綫
							
							$dl = ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1'])/100;
							$c = ($count[2][9]+$count[2][7])* $dl; //實占結果
							
							$dzs = (100 -($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']))/100;
							$dzs2= ($count[2][6]-$count[2][7])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']/100);//賺水
							$cc = $x - ($c - $dzs2); //總代理應付

							if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_2'] == 0)
								$count[2][6] = $count[2][8];
							$_x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$_cc = $cry->SumZDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd2 = $cry->SumGD($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd3 = ($_x - $_cc) - $gd2;
							$count[1][5] += $gd3; //總代理輸贏									
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數							
							if ($count[2][9] != 0 && Copyright){
								$sz = ($count[2][9]+$count[2][10])*($count[1][4]/100); //實占結果
								$count[1][7] += $sz;
								if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_3'] == 0){
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10]; 
								}
								$zwin = $sz - $zs;
								$x = $count[2][9]+$count[2][8];
								$count[1][3] += $x - $zwin;  //應收下綫
								}else{
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10]-$count[2][5])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10]-$count[2][5]; 
								}
								$zwin = $sz - $zs;
								$count[1][3] += $gd3 - $zwin; //應付上級
								}
							}
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_4']; //實占成數
							$zcpj += $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_4']; //實占成數
						}
						break;
					case 22 :  //分公司報表
							$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']/100;
							
						if ($CentetArr['cryList'][$i]['cry'][$n]['g_mumber_type'] == 2 && $lid == $xid) 
						{
							if ($count[2][9] != 0 && Copyright){
								$x = $count[2][9]+$count[2][8]; //應收下綫
								$count[1][3] += $x;
							}
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$zcpj += $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][8])*$count[2][2];//實占結果
								$count[1][7] += $sz;
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10]  - $count[2][8] )*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10] - $count[2][8] ; 
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin; //賺水后結果
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $x - $zwin; //應付上級
							}
						} 
						else 
						{
							if ($count[2][9] != 0){
								if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1'] == 0 && Copyright)
								$count[2][7] = $count[2][8];
							$count[2][4] = (100 -$CentetArr['cryList'][$i]['cry'][$n]['g_distribution'])/100;
							$al= ($count[2][7]-$count[2][8])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']/100);
							$x = ($count[2][9]+$count[2][8])*$count[2][4]+$al; //代理應收下綫
							
							$dl = ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1'])/100;
							$c = ($count[2][9]+$count[2][7])* $dl; //實占結果
							
							$dzs = (100 -($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']))/100;
							$dzs2= ($count[2][6]-$count[2][7])*($CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']/100);//賺水
							$cc = $x - ($c - $dzs2); //總代理應付

							if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_2'] == 0)
								$count[2][6] = $count[2][8];
							$_x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$_cc = $cry->SumZDL($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd2 = $cry->SumGD($CentetArr['cryList'][$i]['cry'][$n], $count);
							$gd3 = ($_x - $_cc) - $gd2;
							$count[1][3] += $gd3; //應收下綫
							}
							
							$count[1][4] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$zcpj += $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][10]*($count[1][4]/100); //實占退水
								$sz = ($count[2][9]+$count[2][10])*($count[1][4]/100); //實占結果
								$count[1][7] += $sz;
								if (($count[1][4]/100)>0){
									$zs= ($count[2][10]-$count[2][5])*(1-($count[1][4]/100));
								}else {
									$zs= $count[2][10]-$count[2][5]; 
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin; //賺水后結果
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_3']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $gd3 - $zwin; //應付上級
							}
							}
						break;
					
					case 78 :  //股東報表
						$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']/100;
						
						if ($CentetArr['cryList'][$i]['cry'][$n]['g_mumber_type'] == 2 && $lid == $xid) 
						{
							if ($count[2][9] != 0 && Copyright){
								$x = $count[2][9]+$count[2][8]; //應收下綫
								$count[1][3] += $x;
								
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0){
								$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][8])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0 && Copyright){
									$zs = ($count[2][5]-$count[2][8])*(1-$count[2][2]);
								}else {
									$zs = $count[2][5] - $count[2][8];
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin;
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']))/100; //佔成 / 100 反取
								$count[1][10] += $count[2][0] * $count[2][4]; //貢獻上級
								$count[1][11] += $x - $zwin;
							}
						} 
						else 
						{
							if ($count[2][9] != 0){
								if ($CentetArr['cryList'][$i]['cry'][$n]['g_tueishui_1'] == 0)
									$count[2][7] = $count[2][8];
								$x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
								$c = $cry->SumZDL($CentetArr['cryList'][$i]['cry'][$n], $count);
								$cc = $x - $c;
								$count[1][3] +=$cc; //應收下綫
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][6]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][6])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0){
									$zs= ($count[2][5]-$count[2][6])*(1-$count[2][2]);
								}else {
									$zs= $count[2][5]-$count[2][6]; 
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs; //賺取水錢
								$count[1][9] += $zwin; //賺水后結果
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_2']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $cc - $zwin; //應付上級
							}
						}
						break;
					case 48 : //總代理報表
						$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']/100;
						if ($CentetArr['cryList'][$i]['cry'][$n]['g_mumber_type'] == 2 && $lid == $xid) 
						{
							if ($count[2][9] != 0 && Copyright){
								$x = $count[2][9] + $count[2][8]; //應收下綫
								$count[1][3] += $x;
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0){
								$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][8])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0){
									$zs = ($count[2][6]-$count[2][8])*(1-$count[2][2]); //賺取水錢
								}else {
									$zs = $count[2][6] - $count[2][8]; //賺取水錢
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs;
								$count[1][9] += $zwin; //賺水后結果
								$count[2][5] = 1 - $count[2][2]; //佔成 / 100 反取
								$count[1][10] += $count[2][0] * $count[2][5]; //貢獻上級
								$count[1][11] += $x - $zwin;
							}
						} 
						else 
						{
							if ($count[2][9] != 0){
								$x = $cry->SumDL($CentetArr['cryList'][$i]['cry'][$n], $count);
								$count[1][3] +=$x; //應收代理
							}
							$count[1][4] = 100*$count[2][2]; //實占成數
							$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
							$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
							if ($count[2][9] != 0 && Copyright){
								$count[1][6] += $count[2][7]*$count[2][2]; //實占退水
								$sz = ($count[2][9]+$count[2][7])*$count[2][2]; //實占結果
								$count[1][7] += $sz;
								if ($count[2][2]>0 && Copyright){
									$zs = ($count[2][6]-$count[2][7])*(1-$count[2][2]); //賺取水錢
								}else {
									$zs = $count[2][6] - $count[2][7];
								}
								$zwin = $sz - $zs;
								$count[1][8] += $zs;
								$count[1][9] += $zwin;
								$count[2][4] = (100 - ($CentetArr['cryList'][$i]['cry'][$n]['g_distribution']+$CentetArr['cryList'][$i]['cry'][$n]['g_distribution_1']))/100; //佔成反取
								$count[1][10] += $count[2][0]*$count[2][4]; //貢獻上級
								$count[1][11] += $x - $zwin; //應付上級
							}
						}
						break;
					case 9 : //代理報表
						$count[2][2] = $CentetArr['cryList'][$i]['cry'][$n]['g_distribution']/100;
						if ($count[2][9] != 0){
							$x = $count[2][9] + $count[2][8]; //應收下綫
							$count[1][3] += $x;
						}
						$count[1][4] = 100*$count[2][2]; //實占成數
						$count[1][12] += $count[2][0]*$count[2][2]; //實占註額
						$count[1][5] += $count[2][9]*$count[2][2]; //實占輸贏
						if ($count[2][9] != 0){
							$count[1][6] += $count[2][8]*$count[2][2]; //實占退水
							$sz = ($count[2][9]+$count[2][8])*$count[2][2]; //實占結果
							$count[1][7] += $sz;
							if ($count[2][2]>0){
								$zs = ($count[2][7]-$count[2][8])*(1-$count[2][2]); //賺取水錢
							}else {
								$zs = $count[2][7] - $count[2][8]; //賺取水錢
							}
							$zwin = $sz - $zs;
							$count[1][8] += $zs;
							$count[1][9] += $zwin; //賺水后結果
							$count[2][5] = 1 - $count[2][2]; //佔成 / 100 反取
							$count[1][10] += $count[2][0] * $count[2][5]; //貢獻上級
							$count[1][11] += $x - $zwin;
						}
						break;
				}
			}
			
			$CentetArr['cryList'][$i]['s_count'] = $count[1][0]; //會員總筆數 
			$CentetArr['cryList'][$i]['s_countMoney'] = $count[1][1]; //會員下注總金額
			$CentetArr['cryList'][$i]['s_memberWin'] = $count[1][2]; //下綫輸贏
			$CentetArr['cryList'][$i]['s_memberJieGuo'] = $count[1][3]; //應收下綫
			if($CentetArr['cryList'][$i]['g_login_id']==56||$CentetArr['cryList'][$i]['g_login_id']==22)
			$CentetArr['cryList'][$i]['s_distribution'] = round($zcpj/$count[1][0],3); //占成
			else
			$CentetArr['cryList'][$i]['s_distribution'] = $count[1][4]; //占成
			$CentetArr['cryList'][$i]['s_ShiZhanZhiEr'] = $count[1][12]; //實占註額
			$CentetArr['cryList'][$i]['s_shizhanWin'] = $count[1][5]; //實占輸贏
			$CentetArr['cryList'][$i]['s_shizhanTuiShui'] = $count[1][6];	//實占退水
			$CentetArr['cryList'][$i]['s_shizhanTuiShuiWin'] = $count[1][7];	//實占結果
			$CentetArr['cryList'][$i]['s_WinSui'] = $count[1][8];	//賺取水錢
			$CentetArr['cryList'][$i]['s_WinSuiJieGuo'] = $count[1][9]; //賺取水錢結果
			$CentetArr['cryList'][$i]['s_memberWin_S'] = $count[1][10]; //貢獻上級
			$CentetArr['cryList'][$i]['s_memberWin_Y'] = $count[1][11]; //應付上級
			for ($k=0; $k<13; $k++) {
				$count[0][$k] += $count[1][$k];
			}
		}
		$CentetArr['userList']['count_info'] = 0;
		if (isset($CentetArr['userInfo']))
		{
			for ($i=0; $i<count($CentetArr['userInfo']); $i++){
				$CentetArr['userList']['count_info'] += $CentetArr['userInfo'][$i]['g_win'];
			}
		}
		$CentetArr['userList']['count_s'] = $count[0];
	}
	return $CentetArr;
}

?>