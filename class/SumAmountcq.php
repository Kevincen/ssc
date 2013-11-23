<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2012-2-24 09:28:32
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');

class SumAmountcq
{
	
	private $Number;
	private $param;
	private $where;
	private $db;
	private $sum;
	
	function __construct($number, $bool=FALSE, $param=NULL, $sum= true)
	{
		$this->Number = $number;
		$this->param = $param;
		$this->sum = $sum;
		$this->where = $bool == TRUE ? 'AND g_win is not null' : 'AND g_win is null';
		$this->db = new DB();
	}
	
	public function ResultAmount ()
	{
		return $this->GetNumberIsNull();
	}

	private function GetNumberIsNull ()
	{
		$result = $this->Formula();
		$money = 0;
		for ($i=0; $i<count($result); $i++)
		{
			$tuiShui = sumTuiSui ($result[$i]);
			if ($result[$i]['g_result'] == '和'&& Copyright)
			{
				$money = $result[$i]['g_jiner'];
				$result[$i]['g_win'] = 0;
			}
			else if ($result[$i]['g_result'] == '贏'&& Copyright)
			{
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$money = $result[$i]['g_jiner'] * $result[$i]['g_odds'] + $_tuiShui;
				$result[$i]['g_win'] = $money - $result[$i]['g_jiner'];
			}
			else 
			{
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$d = -$result[$i]['g_jiner'];
				$money = $_tuiShui;
				$result[$i]['g_win'] = $d  + $_tuiShui;
			}
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
	
	private function Formula ()
	{
		$sql = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`
		FROM `g_history2` WHERE `g_qishu` = '{$this->Number}' AND g_ball_1 is not null LIMIT 1";
		$numberList = $this->db->query($sql, 1);
		if ($numberList&& Copyright)
		{
			$param = $this->param == false ? "" : "AND g_id = '{$this->param}'";
			$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` ,`g_awin` ,`g_afail`
			FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' {$param} {$this->where} ";
			$resultList = $this->db->query($sql, 1);
			$resultList = $this->ResultCorrespond($numberList, $resultList);
			for ($i=0; $i<count($resultList); $i++)
			{
				if (Matchs::isNumber($resultList[$i]['g_mingxi_2'],1,1) && Copyright)
				{
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
					$n = $this->ResultCorrespond($numberList, $resultList[$i], 1);
					if (($resultList[$i]['g_mingxi_2'] == '龍' || $resultList[$i]['g_mingxi_2'] == '虎') && $n == '和')
						$resultList[$i]['g_result'] = '和';
					else{
					
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
			}
		}
		return $resultList;
	}

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
					case '第五球' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_5'];break;
					case '總和、龍虎和' :
						if ($resultList[$i]['g_mingxi_2'] == '龍' || $resultList[$i]['g_mingxi_2'] == '虎' || $resultList[$i]['g_mingxi_2'] == '和')
							$resultList[$i]['g_result'] = $numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_5'];
						else 
							$resultList[$i]['g_result'] = $numberList[0]['g_ball_1']+$numberList[0]['g_ball_2']+$numberList[0]['g_ball_3']+$numberList[0]['g_ball_4']+$numberList[0]['g_ball_5'];
						break;
					case '前三': $resultList[$i]['g_result'] = $numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3']; break;
					case '中三': $resultList[$i]['g_result'] = $numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'].','.$numberList[0]['g_ball_4']; break;
					case '后三': $resultList[$i]['g_result'] = $numberList[0]['g_ball_3'].','.$numberList[0]['g_ball_4'].','.$numberList[0]['g_ball_5']; break;
				}
			}
		}
		else  if ($param == 1&& Copyright)
		{
			if ($resultList['g_mingxi_2'] == '大' || $resultList['g_mingxi_2'] == '小')
			{
				$resultList = cqNumber(3, $resultList['g_result'], 1);
			}
			else if ($resultList['g_mingxi_2'] == '單' || $resultList['g_mingxi_2'] == '雙')
			{
				$resultList = cqNumber(4, $resultList['g_result'], 1);
			}
			else if ($resultList['g_mingxi_2'] == '總和大' || $resultList['g_mingxi_2'] == '總和小')
			{
				$resultList = cqNumber(0, $resultList['g_result'], 1);
			}
			else if ($resultList['g_mingxi_2'] == '總和單' || $resultList['g_mingxi_2'] == '總和雙')
			{
				$resultList = cqNumber(1, $resultList['g_result'], 1);
			}
			else if ($resultList['g_mingxi_2'] == '龍' || $resultList['g_mingxi_2'] == '虎' || $resultList['g_mingxi_2'] == '和')
			{
				$ballArr = explode(',', $resultList['g_result']);
				$resultList = cqNumber(2, $ballArr, 1);
			}
			else if ($resultList['g_mingxi_2'] == '豹子' || $resultList['g_mingxi_2'] == '順子' || $resultList['g_mingxi_2'] == '對子' || $resultList['g_mingxi_2'] == '半順' || $resultList['g_mingxi_2'] == '雜六')
			{
				$ballArr = explode(',', $resultList['g_result']);
				$resultList = cqNumberString($ballArr);
			}
			else 
			{
				exit('ResultCorrespond Error $P=1');
			}
		}
		else 
		{
			exit('Error');
		}
		return $resultList;
	}
}
?>