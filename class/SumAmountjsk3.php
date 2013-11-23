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

class SumAmountjsk3
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
			if ($result[$i]['g_result'] == '贏'&& Copyright)
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
		$sql = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3` FROM `g_history9` WHERE `g_qishu` = '{$this->Number}'  AND g_ball_1 is not null LIMIT 1";
		$numberList = $this->db->query($sql, 1);
		if ($numberList&& Copyright)
		{
			$param = $this->param == false ? "" : "AND g_id = '{$this->param}'";
			$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` ,`g_awin` ,`g_afail`
			FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' And g_type='江苏骰寶(快3)' {$param} {$this->where} ";
			$resultList = $this->db->query($sql, 1); 
			for ($i=0; $i<count($resultList); $i++)
			{ 
				$n = $this->ResultCorrespond($numberList, $resultList[$i]);
				
				$gname=$resultList[$i]['g_nid']; 
				$dba = new DB();
				$sqlauto = "SELECT `g_autowin`, `g_autofail` FROM `g_user` WHERE `g_name` = '$gname'";
				$resultauto = $dba->query($sqlauto, 1);
				if($resultauto[0]['g_autowin']==1||$resultList[$i]['g_awin']==1){
					$reup=$n['ying'];
					$upid=$resultList[$i]['g_id'];
					$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid"; 
					$dba->query($sqlup, 2);
					$resultList[$i]['g_result'] = '贏'; 
				}else if(($resultauto[0]['g_autofail']==1||$resultList[$i]['g_afail']==1)){
					$reup=$n['shu'];
					$upid=$resultList[$i]['g_id']; 
					$sqlup = "update g_zhudan set g_mingxi_2='$reup' where g_id=$upid"; 
					$dba->query($sqlup, 2);
					$resultList[$i]['g_result'] = '输';
				}else{ 
					$resultList[$i]['g_result']=$n['result']; 
				}
			}
		}
		return $resultList;
	}

	private function ResultCorrespond ($numberList, $resultList, $param=0)
	{
		$result = "輸";
		$shu =  $resultList['g_mingxi_2'];
		$ying=  "";
		switch($resultList['g_mingxi_1']){
			case "三軍":
			{
				$tongsha = false;
				if( $numberList[0]['g_ball_1']== $numberList[0]['g_ball_2'] && $numberList[0]['g_ball_2']==$numberList[0]['g_ball_3']){
					$tongsha=true;
				}
				$sum = $numberList[0]['g_ball_1']+$numberList[0]['g_ball_2']+$numberList[0]['g_ball_3']; 
				if( $resultList['g_mingxi_2']=='大' ){
					if($sum>=11 || $tongsha){
						$ying = $resultList['g_mingxi_2'];
						for($i=1;$i<=6;$i++){
							if(!in_array($i,array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']))){
								$shu=$i;
								break;
							}						
						} 
						$result =  '贏';
					}
				}else if($resultList['g_mingxi_2']=='小'){
					if($sum<11 || $tongsha){
						$result = '贏';
						$ying = $resultList['g_mingxi_2'];
						for($i=1;$i<=6;$i++){
							if(!in_array($i,array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']))){
								$shu=$i;
								break;
							}						
						} 
					}
				}else{
					if($numberList[0]['g_ball_1']== $resultList['g_mingxi_2'] ||
						$numberList[0]['g_ball_2']== $resultList['g_mingxi_2'] ||
						$numberList[0]['g_ball_3']== $resultList['g_mingxi_2']){
						$result = '贏';	
						$ying = $resultList['g_mingxi_2'];
						for($i=1;$i<=6;$i++){
							if(!in_array($i,array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']))){
								$shu=$i;
								break;
							}						
						} 
					}
				}
				if($result=="輸"){
					$ying = array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']);
					$ying = $ying[array_rand($ying)];
				}
				break;
			}
			case "圍骰、全骰":
			{
				if($resultList['g_mingxi_2']=='全骰'){
					if( $numberList[0]['g_ball_1']== $numberList[0]['g_ball_2'] && $numberList[0]['g_ball_2']==$numberList[0]['g_ball_3']){
						$ying = $resultList['g_mingxi_2'];
						for($i=1;$i<=6;$i++){
							if(!in_array($i,array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']))){
								$shu=$i;
								break;
							}						
						} 
						$result = '贏';
					}
				}else{
					if( $numberList[0]['g_ball_1']== $numberList[0]['g_ball_2'] && 
						$numberList[0]['g_ball_2']==$numberList[0]['g_ball_3'] && 
						$numberList[0]['g_ball_1']==$resultList['g_mingxi_3']){
						$result = '贏';
						$ying = $resultList['g_mingxi_2'];
						for($i=1;$i<=6;$i++){
							if(!in_array($i,array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']))){
								$shu=$i;
								break;
							}						
						} 
					}
				}
				if($result=="輸"){
					if( $numberList[0]['g_ball_1']== $numberList[0]['g_ball_2'] && 
						$numberList[0]['g_ball_2']==$numberList[0]['g_ball_3'] && 
						$numberList[0]['g_ball_1']==$resultList['g_mingxi_3']){
						$ying = $numberList[0]['g_ball_1'];	
					}else{
						//实在没办法赢
						$ying="";
					}
				}
				break;
			}
			case "點數":
			{
				$dian = str_replace("點","",$resultList['g_mingxi_2']);
				$sum = $numberList[0]['g_ball_1']+$numberList[0]['g_ball_2']+$numberList[0]['g_ball_3'];
				$result  = $dian==$sum ? '贏' : '輸';	
				if($result=="贏"){
					$ying = $resultList['g_mingxi_2'];	
					$shu = ($dian-1 < 4 ? $dian+1 : $dian-1)."點";
				}else{
					$ying = $sum."點";	
					$shu = $resultList['g_mingxi_2'];
				}
				break;			 
			}
			case "長牌":
			{
				$n = explode("+",$resultList['g_mingxi_2']);
				$n1 = $n[0];
				$n2 = $n[1];
				if( ($numberList[0]['g_ball_1']== $n1 ||
						$numberList[0]['g_ball_2']== $n1 ||
						$numberList[0]['g_ball_3']== $n1 ) && 
						($numberList[0]['g_ball_1']== $n2 ||
						$numberList[0]['g_ball_2']== $n2 ||
						$numberList[0]['g_ball_3']== $n2) ){
					$result = '贏';
				}
				if($result=="贏"){
					$ying = $resultList['g_mingxi_2'];	
					$shu = ($n1-1 < 1 ? $n1+1 : $n1-1)."+".$n2;
				}else{
					$ying = $numberList[0]['g_ball_1'].'+'.$numberList[0]['g_ball_2'];	
					$shu = $resultList['g_mingxi_2'];
				}
				break;
			}
			case "短牌":
			{
				$n = explode("+",$resultList['g_mingxi_2']);
				$n1 = $n[0];
				$n2 = $n[1];
				$arr = array($numberList[0]['g_ball_1'],$numberList[0]['g_ball_2'],$numberList[0]['g_ball_3']);
				if($numberList[0]['g_ball_1']==$numberList[0]['g_ball_2'] && $n1== $numberList[0]['g_ball_1']){
					$result = '贏';
				}else if($numberList[0]['g_ball_1']==$numberList[0]['g_ball_3'] && $n1== $numberList[0]['g_ball_1']){
					$result = '贏';
				}else if($numberList[0]['g_ball_2']==$numberList[0]['g_ball_3'] && $n1== $numberList[0]['g_ball_2']){
					$result = '贏';
				}  
				if($result=="贏"){
					$ying = $resultList['g_mingxi_2'];	
					$shu = ($n1-1 < 1 ? $n1+1 : $n1-1);
					$shu=$shu.'+'.$shu;
				}else{
					$ying = "";	
					$shu = $resultList['g_mingxi_2'];
				}
				break;
			}
		} 
		return array('result'=>$result,'ying'=>$ying,'shu'=>$shu);
	}
}
?>