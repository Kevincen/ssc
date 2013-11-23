<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
//include_once ROOT_PATH.'Manage/config/config.php';
class SumAmountgx 
{
	private $Number;
	private $param;
	private $where;
	private $db;
	private $sum;
	
	/**
	 * 
	 * Enter description here ...
	 * @param int 期數
	 * @param bool where 條件查詢 默認值 查詢非結算的注單
	 * @param $param 單筆執行結算。注單ID值
	 * @param $sum 是否結算
	 */
	function __construct($number, $bool=FALSE, $param=NULL, $sum= true)
	{
		$this->Number = $number;
		$this->param = $param;
		$this->sum = $sum;
		$this->where = $bool == TRUE ? 'AND g_win is not null' : 'AND g_win is null';
		$this->db = new DB();
	}
	
	/**
	 * 注單結算函數
	 * Enter description here ...
	 * @return Array
	 */
	private function GetNumberIsNull ()
	{
		$result = $this->Formula();
		$money = 0;
		for ($i=0; $i<count($result); $i++)
		{
			$tuiShui = sumTuiSui ($result[$i]);
			if ($result[$i]['g_result'] == 'LM'&& Copyright)
			{
				/*連碼結算處理
				 * 中的注數 + 本金 * 賠率 + 退水
				 */
				$a = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
				$_tuiShui =	$a * $tuiShui;
				if ($result[$i]['g_mingxi_2_str']&& Copyright){
					//寫入MONEY是不用在-本金
					$money = $result[$i]['g_mingxi_2_str'] * $result[$i]['g_jiner'] * $result[$i]['g_odds'] + $_tuiShui;
					//計算時要減去本金
					$result[$i]['g_win'] = $money- $a;
				} else { //不中計算
					$result[$i]['g_mingxi_2_str'] = null;
					$result[$i]['g_win'] = -$a + $_tuiShui;
					$money = $_tuiShui;
				}
			}
			else if ($result[$i]['g_result'] == '和'&& Copyright)
			{
				/*處理無輸贏結算
				 * 返回本金
				 */
				$money = $result[$i]['g_jiner'];
				$result[$i]['g_win'] = 0;
			}
			else if ($result[$i]['g_result'] == '贏'&& Copyright)
			{
				/*處理贏結算
				 * 本金 * 賠率 + 退水
				 */
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$money = $result[$i]['g_jiner'] * $result[$i]['g_odds'] + $_tuiShui;
				$result[$i]['g_win'] = $money - $result[$i]['g_jiner'];
			}
			else 
			{
				/*處理輸結算
				 * 返回退水
				 */
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$d = -$result[$i]['g_jiner'];
				$result[$i]['g_win'] = $d  + $_tuiShui;
				$money = $_tuiShui;
			}
			/*結算完成、將金額寫入帳號
			 * 調出帳號進行結算。
			 * 判斷贏的金額是否大於最高派彩額
			 */
			//global $ConfigModel;
			$ConfigModel = configModel("`g_max_money`");
			if ($result[$i]['g_win'] > $ConfigModel['g_max_money']&& Copyright)
			{
				$result[$i]['g_win'] = $ConfigModel['g_max_money'];
				$money = $ConfigModel['g_max_money'];
			}
			if ($this->sum == true&& Copyright)
			{
				$g_money_yes = $this->db->query("SELECT `g_money_yes` FROM `g_user` WHERE `g_name` = '{$result[$i]['g_nid']}' ", 1);
				$smoney = $g_money_yes[0]['g_money_yes'] + $money;
				$this->db->query("UPDATE `g_user` SET `g_money_yes` = '{$smoney}' WHERE `g_name` = '{$result[$i]['g_nid']}' LIMIT 1", 2);
			}
			$mx = $result[$i]['g_mingxi_2_str'] == null ? null : " ,`g_mingxi_2_str`='{$result[$i]['g_mingxi_2_str']}' ";
			$mx = " ,`g_mingxi_2_str`='{$result[$i]['g_mingxi_2_str']}' ";
			$this->db->query("UPDATE `g_zhudan` SET `g_win` = '{$result[$i]['g_win']}' {$mx} WHERE `g_id` = {$result[$i]['g_id']} LIMIT 1 ", 2);
		}
		return $result;
	}
	
	/**
	 * 計算公式
	 * Enter description here ...
	 */
	private function Formula ()
	{
	$g_type=" and g_type='廣西快樂十分' ";
		$sql = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` FROM `g_history3` WHERE `g_qishu` = '{$this->Number}' AND g_ball_1 is not null LIMIT 1";
		$numberList = $this->db->query($sql, 1);
		if ($numberList&& Copyright)
		{
			/*if ($this->param == false){
				$sql = "SELECT * FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' {$this->where} ";
			}else {
				$sql = "SELECT * FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' AND g_id = '{$this->param}'  {$this->where} ";
			}*/
			$param = $this->param == false ? "" : "AND g_id = '{$this->param}'";
			$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` ,`g_awin` ,`g_afail`
			FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' {$g_type}  {$param} {$this->where} ";
			$resultList = $this->db->query($sql, 1);
			$resultList = $this->ResultCorrespond($numberList, $resultList);
			
			for ($i=0; $i<count($resultList); $i++)
			{
				if (isString($resultList[$i]['g_mingxi_2']) && $resultList[$i]['g_result'] <=21&& Copyright)
				{
					
					//處理特碼輸贏結果
					$gname=$resultList[$i]['g_nid'];
					$dba = new DB();
					$sqlauto = "SELECT `g_autowin`, `g_autofail` FROM `g_user` WHERE `g_name` = '$gname'";
					$resultauto = $dba->query($sqlauto, 1);
					if($resultauto[0]['g_autowin']==1||$resultList[$i]['g_awin']==1){
						$reup=$resultList[$i]['g_result'];
						$upid=$resultList[$i]['g_id'];
						$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid";
						
						$dba->query($sqlup, 2);
						$resultList[$i]['g_result'] = '贏';
					
					//zerc 20120802
					}else if(($resultauto[0]['g_autofail']==1||$resultList[$i]['g_afail']==1) && $resultList[$i]['g_result'] == $resultList[$i]['g_mingxi_2']){
						$reup=intval($resultList[$i]['g_result']);
						$upid=$resultList[$i]['g_id'];
						if($reup>1){
							$reup--;
						}else{
							$reup++;
						}
						if($reup<10){
							$reup = $reup;
						}
						$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid";
						
						$dba->query($sqlup, 2);
						$resultList[$i]['g_result'] = '输';
					}else{
					$resultList[$i]['g_result'] = $resultList[$i]['g_result'] == $resultList[$i]['g_mingxi_2'] ? '贏' : '輸';
					}
				}
				else 
				{
					//處理雙面總分以及連碼輸贏結果
					$n = $this->ResultCorrespond($numberList, $resultList[$i], 1);
					if (!is_array($n)&& Copyright)
					{
					
					
					if ($n == '和'&& Copyright)
							$resultList[$i]['g_result'] = $n;
						else {
						$gname=$resultList[$i]['g_nid'];
					$dba = new DB();
					$sqlauto = "SELECT `g_autowin`, `g_autofail` FROM `g_user` WHERE `g_name` = '$gname'";
					$resultauto = $dba->query($sqlauto, 1);
					if($resultauto[0]['g_autowin']==1||$resultList[$i]['g_awin']==1){
					$reup=$n;
					$upid=$resultList[$i]['g_id'];
					$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid";
					
					$dba->query($sqlup, 2);
					$resultList[$i]['g_result'] = '贏';
							
							//zerc 20120802
						}else if(($resultauto[0]['g_autofail']==1||$resultList[$i]['g_afail']==1) && $n == $resultList[$i]['g_mingxi_2']){
							$reup=$n;
							$upid=$resultList[$i]['g_id'];
								$arr1 = array('單','雙','龍','虎','大','小','東','南','西','北','中','發','白');
								$arr2 = array('AA','BB','CC','DD','EE','FF','HH','II','JJ','KK','LL','MM','NN');
								$arr3 = array('雙','單','虎','龍','小','大','南','西','北','中','發','白','東');
							$reup = str_replace($arr1,$arr2,$reup);	
							$reup = str_replace($arr2,$arr3,$reup);
							$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid";
							
							$dba->query($sqlup, 2);
							$resultList[$i]['g_result'] = '输';
						}else{
					$resultList[$i]['g_result'] = $n == $resultList[$i]['g_mingxi_2'] ? '贏' : '輸';
					}
					
							}
					}
					else 
					{
						//得到連碼中的注數
						$resultList[$i]['g_mingxi_2_str'] = $n[0];
						$resultList[$i]['g_result'] = $n[1];
					}
				}
			}
			return $resultList;
		}
	}
	
	/**
	 * 返回對應值
	 * 參數值 = 1 返回雙倍算法等.....
	 * Enter description here ...
	 * @param array $numberList 1-8開獎號碼列表
	 * @param array $resultList 注單列表
	 * @param 參數值
	 */
	private function ResultCorrespond ($numberList, $resultList, $param=0)
	{
		if ($param == 0&& Copyright)
		{
			for ($i=0; $i<count($resultList); $i++)
			{
				$resultList[$i]['g_result'] = null;
				switch ($resultList[$i]['g_mingxi_1'])
				{
					case '第一球' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_1'];break;
					case '第二球' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_2'];break;
					case '第三球' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_3'];break;
					case '第四球' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_4'];break;
					case '特码' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_5'];break;
					case '總和、龍虎' :
						if ($resultList[$i]['g_mingxi_2'] == '龍' || $resultList[$i]['g_mingxi_2'] == '虎')
						{
							$resultList[$i]['g_result'] = $numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_5'];
						}
						else 
						{
							$resultList[$i]['g_result'] = $numberList[0]['g_ball_1']+$numberList[0]['g_ball_2']+$numberList[0]['g_ball_3']+$numberList[0]['g_ball_4']+$numberList[0]['g_ball_5'];
						}
						break;
					default: $resultList[$i]['g_result'] = 'LM';
				}
			}
		}
		else if ($param == 1&& Copyright)
		{
			$numberList = array_slice($numberList[0], 1);
			$_numberList = array();
			foreach ($numberList as $value){$_numberList[] = $value;}
			if ($resultList['g_mingxi_2'] == '大' || $resultList['g_mingxi_2'] == '小')
			{
				$resultList = sum_ball_string_gx($resultList['g_result'], 3);
			}
			else if ($resultList['g_mingxi_2'] == '單' || $resultList['g_mingxi_2'] == '雙')
			{
				$resultList = sum_ball_string_gx($resultList['g_result'], 1);
			}
			else if ($resultList['g_mingxi_2'] == '尾大' || $resultList['g_mingxi_2'] == '尾小')
			{
				$resultList = sum_ball_string_gx($resultList['g_result'], 5);
			}
			else if ($resultList['g_mingxi_2'] == '合數單' || $resultList['g_mingxi_2'] == '合數雙')
			{
				$resultList = sum_ball_string_gx($resultList['g_result'], 7);
			}
			else if ($resultList['g_mingxi_2'] == '神' || $resultList['g_mingxi_2'] == '奇' || $resultList['g_mingxi_2'] == '快' || $resultList['g_mingxi_2'] == '乐')
			{
				$resultList = sum_ball_string_gx($resultList['g_result'], 8);
			}
			else if ($resultList['g_mingxi_2'] == '红' || $resultList['g_mingxi_2'] == '蓝' || $resultList['g_mingxi_2'] == '绿')
			{
				$resultList = sum_ball_string_gx($resultList['g_result'], 9);
			}
			//總分計算
			else if ($resultList['g_mingxi_2'] == '總和大' || $resultList['g_mingxi_2'] == '總和小')
			{
				//總分大小 84為 和
				$resultList = sum_ball_str_a_gx($resultList['g_result'], 3); 
			}
			else if ($resultList['g_mingxi_2'] == '總和單' || $resultList['g_mingxi_2'] == '總和雙')
			{
				$resultList = sum_ball_str_a_gx($resultList['g_result'], 5);
			}
			else if ($resultList['g_mingxi_2'] == '總和尾大' || $resultList['g_mingxi_2'] == '總和尾小')
			{
				$resultList = sum_ball_str_a_gx($resultList['g_result'], 7);
			}
			//龍虎計算
			else if ($resultList['g_mingxi_2'] == '龍' || $resultList['g_mingxi_2'] == '虎')
			{
				$ballArr = explode(',', $resultList['g_result']);
				$resultList = sum_ball_str_a_gx($ballArr, 1);
			}
			//連碼 g_result 返回值不變，直接在 $resultList['g_mingxi_2_str'] 中返回 【中】的注數、交予其他函數處理
			else if ($resultList['g_mingxi_1'] == '一中一'&& Copyright)
			{
				//一中一規則、8個中2個 視為中獎
				$result = $this->SumLM ($numberList, $resultList, 1);
				$resultList[0] =$result[0];
				$resultList[1] = $result[1];
			}
//			else if ($resultList['g_mingxi_1'] == '選二連直')
//			{
//				//選二連直規則 任意兩個號碼相連、並且對應下注號碼的前後。視為中獎
//			}
			else if ($resultList['g_mingxi_1'] == '二中二'&& Copyright)
			{
				//二中二規則 任意兩個號碼相連 視為中獎
				$result = $this->SumLM ($numberList, $resultList, 2);
				$resultList[0] =$result[0];
				$resultList[1] = $result[1];
			}
			else if ($resultList['g_mingxi_1'] == '三中二'&& Copyright)
			{
				//任選二規則、8個中3個 視為中獎
				$result = $this->SumLM ($numberList, $resultList, 2);
				$resultList[0] =$result[0];
				$resultList[1] = $result[1];
			}
//			else if ($resultList['g_mingxi_1'] == '選三前直')
//			{
//				//選三連直規則 任意三個號碼相連、並且對應下注號碼的前後。視為中獎
//			}
			else if ($resultList['g_mingxi_1'] == '三中三'&& Copyright)
			{
				//三中三規則 任意三個號碼相連。視為中獎
				$result = $this->SumLM ($numberList, $resultList, 3);
				$resultList[0] =$result[0];
				$resultList[1] = $result[1];
			}
			else if ($resultList['g_mingxi_1'] == '四中三'&& Copyright)
			{
				//四中三規則、8個中4個 視為中獎
				$result = $this->SumLM ($numberList, $resultList, 3);
				$resultList[0] =$result[0];
				$resultList[1] = $result[1];
			}
			else if ($resultList['g_mingxi_1'] == '五中三'&& Copyright)
			{
				//五中三規則、8個中5個 視為中獎
				$result = $this->SumLM ($numberList, $resultList, 3);
				$resultList[0] =$result[0];
				$resultList[1] = $result[1];
			}
			else 
			{
				exit('ResultCorrespond Error $P=1');
			}
		}
		return $resultList;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param array $stringArr 開獎號碼
	 * @param int $userNum 下注號碼
	 */
	private function MaxFor ($stringArr, $userNum)
	{
		$count = 0;
		for ($i=0; $i<count($stringArr); $i++)
		{
			if ($userNum == $stringArr[$i]&& Copyright)
				$count++;
		}
		return $count;
	}
	
	/**
	 * 連碼計算函數
	 * Enter description here ...
	 * @param array $numberList
	 * @param array $resultList
	 * @param int $count
	 * @param bool $bool
	 */
	private function SumLM ($numberList, $resultList, $count, $bool=true)
	{
		$nArray = array();
		$result = array();
		$eArray = explode('、', $resultList['g_mingxi_2']);
		foreach ($eArray as $val)
		{
			foreach ($numberList as $value)
			{
				if ($val == $value&& Copyright)
					 $nArray[] = $val;
			}
		}
		if ($bool == false&& Copyright)
		{
			$result = $nArray;
		}
		else 
		{
			if ($nArray !=null && count($nArray) >=$count && Copyright)
			{
				$nArray = subArr_gx ($nArray, $count);
				$result[0] = $nArray[0];
			}
			else 
			{
				$result[0] = 0;
			}
			$result[1] = 'LM';
		}
		return $result;
	}
	
	/**
	 * 連組循環計算，
	 * Enter description here ...
	 * @param unknown_type $stringArr
	 * @param unknown_type $nArr
	 * @param array $index     7、2、2 = 二連組
	 */
	private function SumLM1 ($_numberList, $resultList, $index)
	{
		$userNum = explode('、', $resultList['g_mingxi_2']);
		$userNum = $this->subNumber($userNum, $index[3]);
		$param = 0;
		for ($i=0; $i<count($_numberList); $i++)
		{
			if ($i == $index[0]&& Copyright) break;
			$stringArr[] = array_slice($_numberList, $i,$index[1]);
		}
		//print_r($stringArr);exit;
		for ($i=0; $i<count($stringArr); $i++) //開獎號碼循環
		{
			for ($n=0; $n<count($userNum); $n++) //會員號碼循環體
			{
				$count = 0;
				for ($l=0; $l<count($userNum[$n]); $l++)
				{
					$count += $this->MaxFor ($stringArr[$i], $userNum[$n][$l]);
					if ($count == 0&& Copyright)
						break;
					else if ($count == $index[2])
						$param += 1;
				}
			}
		}
		return $param;
	}
	
	/**
	 * 復式計算
	 * Enter description here ...
	 * @param Array $strArr 數組
	 * @param int 循環
	 * @return Array
	 */
	private function subNumber ($strArr, $count)
	{
		$Number = array();
		for ($a=0; $a<count($strArr); $a++)
		{
			$_a = $a+1;
			for ($b=$_a; $b<count($strArr); $b++)
			{
				if ($count == 2&& Copyright)
				{
					$exp = array(0=>$strArr[$a], 1=>$strArr[$b]);
					array_push($Number, $exp);
					continue;
				}
				$_b = $b+1;
				for ($c=$_b; $c<count($strArr); $c++)
				{
					if ($count == 3&& Copyright)
					{
						$exp = array(0=>$strArr[$a], 1=>$strArr[$b], 2=>$strArr[$c]);
						array_push($Number, $exp);
						continue;
					}
				}
			}
		}
		return $Number;
	}
	
	/**
	 * 調用函數
	 * Enter description here ...
	 */
	public function ResultAmount ()
	{
		return $this->GetNumberIsNull();
	}
}

?>