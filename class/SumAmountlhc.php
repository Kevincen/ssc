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

class SumAmountlhc
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
		 
		for ($i=0; $i<count($result); $i++)
		{
			$tuiShui = sumTuiSui ($result[$i]);
			if ($result[$i]['g_result'] == 'LM' || $result[$i]['g_result'] == 'HX') //連碼和合肖
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
		$sql = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`
		FROM `g_history_lhc` WHERE `g_qishu` = '{$this->Number}' AND g_ball_1 is not null LIMIT 1";
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
				$n = $this->ResultCorrespond($numberList, $resultList[$i], 1);
				if( (is_string($n) && $n=="和") || (is_array($n) && $n[1]=="HX" && $resultList[$i]['g_result']==49) 	)
				{
					$resultList[$i]['g_result']="和"; 
					continue;
				}
				if( $resultList[$i]['g_mingxi_1']=="正碼" &&  Matchs::isNumber($resultList[$i]['g_mingxi_2'],1,2)){ 
					$g_kkk=$n[0];  
				}
				if( $resultList[$i]['g_mingxi_1']=="一肖" ){
					$g_kkk=$n[0];
				}
				if( $resultList[$i]['g_mingxi_1']=="尾數" ){
					$g_kkk=$n[0];
				}
				if($n[1]=="LM" || $n[1]=="HX")
				{
					$resultList[$i]['g_mingxi_2_str'] = $n[0];
					$resultList[$i]['g_result'] = $n[1]; 
				}
				else
				{
					$gname=$resultList[$i]['g_nid'];
					$dba = new DB();
					$sqlauto = "SELECT `g_autowin`, `g_autofail` FROM `g_user` WHERE `g_name` = '$gname'";
					$resultauto = $dba->query($sqlauto, 1);
					if($resultauto[0]['g_autowin']==1||$resultList[$i]['g_awin']==1){
						$reup=$n;
						if(isset($g_kkk)){ $reup=$g_kkk;}
						$upid=$resultList[$i]['g_id'];
						$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid"; 
						$dba->query($sqlup, 2);
						$resultList[$i]['g_result'] = '贏'; 
					}else if(($resultauto[0]['g_autofail']==1||$resultList[$i]['g_afail']==1) && $n == $resultList[$i]['g_mingxi_2'] && isset($g_kkk)==false){
						$reup=$n;
						$upid=$resultList[$i]['g_id'];
						$arr1 = array('單','雙','紅波', '綠波', '藍波', '大','小','金','木', '水','火','土');
						$arr2 = array('AA','BB','CC',  'DD',  'EE',   'FF','HH','II','JJ','KK','LL','MM');
						$arr3 = array('雙','單','綠波', '藍波', '紅波', '大', '南','木','水', '火','土','金');
						$reup = str_replace($arr1,$arr2,$reup);	
						$reup = str_replace($arr2,$arr3,$reup);
						$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid"; 
						$dba->query($sqlup, 2);
						$resultList[$i]['g_result'] = '输';
					}else if(($resultauto[0]['g_autofail']==1||$resultList[$i]['g_afail']==1) && $n == $resultList[$i]['g_mingxi_2'] && isset($g_kkk)){ 
						$upid=$resultList[$i]['g_id'];
						if( $resultList[$i]['g_mingxi_1']=="正碼" &&  Matchs::isNumber($resultList[$i]['g_mingxi_2'],1,2)){ 
							$c = $resultList[$i]['g_mingxi_2'];
							while(true){
								if( in_array($c,$n)==false ){
									$reup=$c;
									break;
								}else{
									$c=$c*1+1;
									if($c==50)$c=1;
									if(strlen($c)==1)$c="0".$c;
								}
							}
						}
						if( $resultList[$i]['g_mingxi_1']=="一肖" ){
							global $CONFIG;
							$c = $resultList[$i]['g_mingxi_2'];
							while(true){
								if( in_array($c,$n)==false ){
									$reup=$c;
									break;
								}else{
									$c=array_rand(array_keys($CONFIG['lhc_rgb']['SX']));
								}
							}
						}
						if( $resultList[$i]['g_mingxi_1']=="尾數" ){
							$c = $resultList[$i]['g_mingxi_2'];
							while(true){
								if( in_array($c,$n)==false ){
									$reup=$c;
									break;
								}else{
									$c=$c+1;
									if($c==10)$c=0; 
								}
							}
						}
						$reup = str_replace($arr1,$arr2,$reup);	
						$reup = str_replace($arr2,$arr3,$reup);
						$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid"; 
						$dba->query($sqlup, 2);
						$resultList[$i]['g_result'] = '输';
					}else{
						if(isset($g_kkk)){
							$resultList[$i]['g_result'] = "輸";
							foreach($n as $itm){
								if( Matchs::isNumber($itm,1,2) && Matchs::isNumber($resultList[$i]['g_mingxi_2'],1,2)){
									if($itm*1==$resultList[$i]['g_mingxi_2']*1){
										$resultList[$i]['g_result'] = "贏";break;
									} 
								}else{
									if($itm==$resultList[$i]['g_mingxi_2']){
										$resultList[$i]['g_result'] = "贏";break;
									} 
								}
							}  
						}else{
							$resultList[$i]['g_result'] = $n == $resultList[$i]['g_mingxi_2'] ? '贏' : '輸'; 
						}
					} 
					unset($g_kkk);
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
					case '特碼' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					case '正碼一' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_1'];break;
					case '正碼二' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_2'];break;
					case '正碼三' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_3'];break;
					case '正碼四' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_4'];break;
					case '正碼五' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_5'];break;
					case '正碼六' : $resultList[$i]['g_result'] = $numberList[0]['g_ball_6'];break;
					case '正碼'   : $resultList[$i]['g_result'] = $numberList[0];break;
					case '半波': $resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					case '五行': $resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					case '特碼生肖': $resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					case '一肖': $resultList[$i]['g_result'] = $numberList[0];break;
					case '特尾': $resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					case '尾數': $resultList[$i]['g_result'] = $numberList[0];break;
					case '特碼頭': $resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					case '總和': $resultList[$i]['g_result'] = $numberList[0]['g_ball_1']+$numberList[0]['g_ball_2']+$numberList[0]['g_ball_3']+$numberList[0]['g_ball_4']+$numberList[0]['g_ball_5']+$numberList[0]['g_ball_6']+$numberList[0]['g_ball_7'];break;
					case "三中三":$resultList[$i]['g_result']=array( $numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3'],$numberList[0]['g_ball_4'],$numberList[0]['g_ball_5'],$numberList[0]['g_ball_6'] );break;
					case "三中二":$resultList[$i]['g_result']=array( $numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3'],$numberList[0]['g_ball_4'],$numberList[0]['g_ball_5'],$numberList[0]['g_ball_6'] );break;
					case "二中二":$resultList[$i]['g_result']=array( $numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3'],$numberList[0]['g_ball_4'],$numberList[0]['g_ball_5'],$numberList[0]['g_ball_6'] );break;
					case "五不中":$resultList[$i]['g_result']=array( $numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3'],$numberList[0]['g_ball_4'],$numberList[0]['g_ball_5'],$numberList[0]['g_ball_6'],$numberList[0]['g_ball_7'] );break;
					case "二中特":$resultList[$i]['g_result']=array( $numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3'],$numberList[0]['g_ball_4'],$numberList[0]['g_ball_5'],$numberList[0]['g_ball_6'],$numberList[0]['g_ball_7'] );break;
					case "一肖中":
					case "一肖不中":
					case "二肖中":
					case "二肖不中":
					case "三肖中":
					case "三肖不中":
					case "四肖中":
					case "四肖不中":
					case "五肖中":
					case "五肖不中":
					case "六肖中":
					case "六肖不中":
					case "七肖中":
					case "七肖不中":
					case "八肖中":
					case "八肖不中":
					case "九肖中":
					case "九肖不中":
					case "十肖中":
					case "十肖不中":
					case "十一肖中":
					case "十一肖不中":
						$resultList[$i]['g_result'] = $numberList[0]['g_ball_7'];break;
					default:$resultList[$i]['g_result'] = $numberList[0];break;
						
				}
			}
		}
		else  if ($param == 1&& Copyright)
		{
			if($resultList['g_mingxi_1']=='特碼')
			{
				if( Matchs::isNumber($resultList['g_mingxi_2'],1,2) && Copyright )	
				{
					$resultList = $resultList['g_result'];
				}	
				else
				{
					if($resultList['g_result']*1==49 && 
						($resultList['g_mingxi_2'] != '紅波' && $resultList['g_mingxi_2'] != '藍波' && $resultList['g_mingxi_2'] != '綠波')
					){
						$resultList="和";
					}
					else if ($resultList['g_mingxi_2'] == '大' || $resultList['g_mingxi_2'] == '小')
					{
						$resultList = lhcNumber(0, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '單' || $resultList['g_mingxi_2'] == '雙')
					{
						$resultList = lhcNumber(1, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '合單' || $resultList['g_mingxi_2'] == '合雙')
					{
						$resultList = lhcNumber(2, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '尾大' || $resultList['g_mingxi_2'] == '尾小')
					{
						$resultList = lhcNumber(3, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '紅波' || $resultList['g_mingxi_2'] == '藍波' || $resultList['g_mingxi_2'] == '綠波')
					{
						$resultList = lhcNumber(4, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '合大' || $resultList['g_mingxi_2'] == '合小'  )
					{
						$resultList = lhcNumber(13, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '大單' || $resultList['g_mingxi_2'] == '大雙' ||  $resultList['g_mingxi_2'] == '小單' || $resultList['g_mingxi_2'] == '小雙' )
					{
						$resultList = lhcNumber(14, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '大單' || $resultList['g_mingxi_2'] == '大雙' ||  $resultList['g_mingxi_2'] == '小單' || $resultList['g_mingxi_2'] == '小雙' )
					{
						$resultList = lhcNumber(14, $resultList['g_result'], 1);
					}
					else if($resultList['g_mingxi_2'] == '紅大單' || $resultList['g_mingxi_2'] == '紅大雙' ||  $resultList['g_mingxi_2'] == '紅小單' || $resultList['g_mingxi_2'] == '紅小雙' || $resultList['g_mingxi_2'] == '綠大單' || $resultList['g_mingxi_2'] == '綠大雙' ||  $resultList['g_mingxi_2'] == '綠小單' || $resultList['g_mingxi_2'] == '綠小雙' || $resultList['g_mingxi_2'] == '藍大單' || $resultList['g_mingxi_2'] == '藍大雙' ||  $resultList['g_mingxi_2'] == '藍小單' || $resultList['g_mingxi_2'] == '藍小雙')
					{
						$resultList = lhcNumber(15, $resultList['g_result'], 1);
					}
				}		
			}
			else if( $resultList['g_mingxi_1']=='正碼一' || 
				$resultList['g_mingxi_1']=='正碼二' || 
				$resultList['g_mingxi_1']=='正碼三' || 
				$resultList['g_mingxi_1']=='正碼四' || 
				$resultList['g_mingxi_1']=='正碼五' ||
				$resultList['g_mingxi_1']=='正碼六' )
			{
				
				if( Matchs::isNumber($resultList['g_mingxi_2'],1,2) && Copyright )	
				{
					$resultList = $resultList['g_result'];
					
				}
				else
				{
					if($resultList['g_result']*1==49 && 
						($resultList['g_mingxi_2'] != '紅波' && $resultList['g_mingxi_2'] != '藍波' && $resultList['g_mingxi_2'] != '綠波')){
						$resultList="和";
					}
					else if ($resultList['g_mingxi_2'] == '大' || $resultList['g_mingxi_2'] == '小')
					{
						$resultList = lhcNumber(0, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '單' || $resultList['g_mingxi_2'] == '雙')
					{
						$resultList = lhcNumber(1, $resultList['g_result'], 1);
					}
					else if ($resultList['g_mingxi_2'] == '合單' || $resultList['g_mingxi_2'] == '合雙')
					{
						$resultList = lhcNumber(2, $resultList['g_result'], 1);
					}
					else if($resultList['g_mingxi_2'] == '紅波' || $resultList['g_mingxi_2'] == '藍波' || $resultList['g_mingxi_2'] == '綠波')
					{
						$resultList = lhcNumber(4, $resultList['g_result'], 1);
					}
				}  
			}
			else if($resultList['g_mingxi_1'] == '正碼')
			{
				if( Matchs::isNumber($resultList['g_mingxi_2'],1,2) && Copyright )	
				{ 
					$resultList = array($resultList['g_result']['g_ball_1'],
										$resultList['g_result']['g_ball_2'],
										$resultList['g_result']['g_ball_3'],
										$resultList['g_result']['g_ball_4'],
										$resultList['g_result']['g_ball_5'],
										$resultList['g_result']['g_ball_6']);
				}
				else if($resultList['g_mingxi_2']=="總大" || $resultList['g_mingxi_2']=="總小")
				{
					$resultList = lhcNumber(5, $resultList['g_result']['g_ball_1']+$resultList['g_result']['g_ball_2']+$resultList['g_result']['g_ball_3']+$resultList['g_result']['g_ball_4']+$resultList['g_result']['g_ball_5']+$resultList['g_result']['g_ball_6'], 1);
					 
				}
				else if($resultList['g_mingxi_2']=="總單" || $resultList['g_mingxi_2']=="總雙")
				{
					
					$resultList = lhcNumber(6, $resultList['g_result']['g_ball_1']+$resultList['g_result']['g_ball_2']+$resultList['g_result']['g_ball_3']+$resultList['g_result']['g_ball_4']+$resultList['g_result']['g_ball_5']+$resultList['g_result']['g_ball_6'], 1);
				} 
				else
				{  
					exit("dd");
				}
				
			}
			else if ($resultList['g_mingxi_1'] == '半波')
			{
				if($resultList['g_result']*1==49){
					$resultList="和";
				}else{
					$resultList = strstr(lhcNumber(7, $resultList['g_result'], 1),$resultList['g_mingxi_2']) ? $resultList['g_mingxi_2'] : "";
				} 
			}
			else if ($resultList['g_mingxi_1'] == '五行')
			{
				if($resultList['g_result']*1==49){
					$resultList="和";
				}else{
					$resultList = lhcNumber(8, $resultList['g_result'], 1);
				}
			}
			else if ($resultList['g_mingxi_1'] == '特碼生肖')
			{
				//if($resultList['g_result']*1==49){
					//$resultList="和";
				//}else{
					$resultList = lhcNumber(9, $resultList['g_result'], 1);
				//}
			} 
			else if ($resultList['g_mingxi_1'] == '一肖')
			{
				$opencode=array( $resultList['g_result']['g_ball_1'],$resultList['g_result']['g_ball_2'],$resultList['g_result']['g_ball_3'],$resultList['g_result']['g_ball_4'],$resultList['g_result']['g_ball_5'],$resultList['g_result']['g_ball_6'] );
				$str=array();
				global $CONFIG; 
				foreach($opencode as $c){
					if (strlen($c)==1)$c="0".$c;
					foreach( $CONFIG["lhc_rgb"]['SX'] as $key=>$val ){ 
						if( in_array($c,$val) ){
							if(in_array($key,$str)==false)
								$str[]=$key;
						}
					}
				} 
				$resultList=$str;
			}
			else if ($resultList['g_mingxi_1'] == '特尾')
			{
				$resultList = lhcNumber(11, $resultList['g_result'], 1);
			}
			else if ($resultList['g_mingxi_1'] == '尾數')
			{
				$resultList = array( $resultList['g_result']['g_ball_1']%10,
					 $resultList['g_result']['g_ball_2']%10,
					 $resultList['g_result']['g_ball_3']%10,
					 $resultList['g_result']['g_ball_4']%10,
					 $resultList['g_result']['g_ball_5']%10,
					 $resultList['g_result']['g_ball_6']%10,
					 $resultList['g_result']['g_ball_7']%10, );
			}
			else if ($resultList['g_mingxi_1'] == '特碼頭')
			{ 
				$resultList = lhcNumber(12, $resultList['g_result'], 1);  
			}
			else if($resultList['g_mingxi_1'] == '總和')
			{
				if($resultList['g_mingxi_2']=="總和大" || $resultList['g_mingxi_2']=="總和小")
				{
					$resultList = lhcNumber(16, $resultList['g_result'], 1); 
				}
				else if($resultList['g_mingxi_2']=="總和單" || $resultList['g_mingxi_2']=="總和雙")
				{
					$resultList = lhcNumber(17, $resultList['g_result'], 1); 
				}
			}
			else if($resultList['g_mingxi_1'] == '三中三')
			{ 
				$resultList[1]="LM";
				$eArray = explode('、', $resultList['g_mingxi_2']);
				$nArray = subArr ($eArray, 3);
				$cou=0;
				foreach( $nArray[1] as $number ){
					$arr=explode(",",$number);
					$n=0;
					foreach($arr as $v){
						$vv=strlen($v)==1 ? "0".$v : $v;
						if( in_array($vv,$resultList['g_result']) ){
							$n+=1;
						}
					}
					if( $n==3 )$cou+=1;
				}
				$resultList[0]=$cou;
			}
			else if($resultList['g_mingxi_1'] == '三中二')
			{ 
				$resultList[1]="LM";
				$eArray = explode('、', $resultList['g_mingxi_2']);
				$nArray = subArr ($eArray, 3);
				$cou=0;
				foreach( $nArray[1] as $number ){
					$arr=explode(",",$number);
					$n=0;
					foreach($arr as $v){
						$vv=strlen($v)==1 ? "0".$v : $v;
						if( in_array($vv,$resultList['g_result']) ){
							$n+=1;
						}
					}
					if( $n>=2 )$cou+=1;
				}
				$resultList[0]=$cou;
			}
			else if($resultList['g_mingxi_1'] == '二中二')
			{ 
				$resultList[1]="LM";
				$eArray = explode('、', $resultList['g_mingxi_2']);
				$nArray = subArr ($eArray, 2);
				$cou=0;
				foreach( $nArray[1] as $number ){
					$arr=explode(",",$number);
					$n=0;
					foreach($arr as $v){
						$vv=strlen($v)==1 ? "0".$v : $v;
						if( in_array($vv,$resultList['g_result']) ){
							$n+=1;
						}
					}
					if( $n==2 )$cou+=1;
				}
				$resultList[0]=$cou;
			}
			else if($resultList['g_mingxi_1'] == '五不中')
			{ 
				$resultList[1]="LM";
				$eArray = explode('、', $resultList['g_mingxi_2']);
				$nArray = subArr ($eArray, 5);
				$cou=0;
				foreach( $nArray[1] as $number ){
					$arr=explode(",",$number);
					$n=0;
					foreach($arr as $v){
						$vv=strlen($v)==1 ? "0".$v : $v;
						if( in_array($vv,$resultList['g_result'])==false ){
							$n+=1;
						}
					}
					if( $n==5 )$cou+=1;
				}
				$resultList[0]=$cou;
			}
			else if($resultList['g_mingxi_1'] == '二中特')
			{ 
				$resultList[1]="LM";
				$eArray = explode('、', $resultList['g_mingxi_2']);
				$nArray = subArr ($eArray, 2);
				$cou=0;
				foreach( $nArray[1] as $number ){
					$arr=explode(",",$number);
					$n=0;
					foreach($arr as $v){
						$vv=strlen($v)==1 ? "0".$v : $v;
						if( in_array($vv,$resultList['g_result'])  ){
							$n+=1;
						}
					}
					if( $n==2 )$cou+=1;
				}
				$resultList[0]=$cou;
			}
			else if($resultList['g_mingxi_1'] == '一肖中')
			{ 
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],1);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '二肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],2);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '三肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],3);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '四肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],4);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '五肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],5);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '六肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],6);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '七肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],7);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '八肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],8);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '九肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],9);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '十肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],10);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '十一肖中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],11);
				$resultList[1]="HX";
			} 
			else if($resultList['g_mingxi_1'] == '一肖不中')
			{ 
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],1,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '二肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],2,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '三肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],3,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '四肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],4,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '五肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],5,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '六肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],6,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '七肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],7,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '八肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],8,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '九肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],9,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '十肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],10,false);
				$resultList[1]="HX";
			}
			else if($resultList['g_mingxi_1'] == '十一肖不中')
			{ 	
				$resultList[0]=$this->sumHX($resultList,$resultList['g_result'],11,false);
				$resultList[1]="HX";
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
	
	public function sumHX($resultList,$numberList,$count,$isB=true)
	{ 
		global $CONFIG;
		$eArray = explode('、', $resultList['g_mingxi_2']);
		$nArray = subArr ($eArray, $count);
		$cou=0;
		if($isB){
			foreach( $nArray[1] as $number ){
				$arr = explode(",",$number);
				 
				$n=false;
				foreach($arr as $num){
					$code = $CONFIG['lhc_rgb']['SX'][$num];
					if( in_array($numberList,$code)){
						$n = true;break;
					}
				}
				if($n)$cou+=1;
			}
		}else{
			foreach( $nArray[1] as $number ){
				$arr = explode(",",$number);
				$n=0;
				foreach($arr as $num){
					$code = $CONFIG['lhc_rgb']['SX'][$num];
					if( in_array($numberList,$code)==false){
						$n+=1 ;
					}
				}
				if($n==$count)$cou+=1;
			}
		}
		return $cou;
	}
}
?>