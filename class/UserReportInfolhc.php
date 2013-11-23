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
class UserReportInfolhc 
{
	private $db;
	private $User;
	private $UserList;
	
	public function __construct($User=null)
	{
		$this->db = new DB();
		if ($User)
			$this->User = $User;
	}
	
	public function GetNumberAll()
	{
		$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date` FROM `g_kaipan_lhc` WHERE g_lock = 2 ORDER BY g_qishu ASC LIMIT 1";
		$result = $this->db->query($sql, 1);
		$a = array(
			'endTime'=>strtotime($result[0]['g_feng_date']) - time(),
			'openTime'=>strtotime($result[0]['g_open_date']) - time(),
			'Phases'=>$result[0]['g_qishu']);
		return $a;
	}
	
	public function GetInfolhc()
	{
		$sql = "SELECT g_qishu FROM g_kaipan_lhc WHERE g_lock = 2 ORDER BY g_qishu DESC LIMIT 1";
		$number = $this->db->query($sql, 0);
		if ($number && Copyright)
		{
			if ($this->User['g_login_id'] !=48 && Copyright){
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_s_nid <> '{$this->User['g_nid']}' 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '六合彩' 
				AND g_win is null ";
			} else {
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_mumber_type<>5 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '六合彩' 
				AND g_win is null ";
			}
			$result = $this->db->query($sql, 1);
			 
			$sql = "SELECT * FROM g_zhudan WHERE g_qishu='{$number[0][0]}' 
			AND g_s_nid = '{$this->User['g_nid']}' 
			AND g_mumber_type=5 
			AND g_type = '六合彩' 
			AND g_win is null ";
			$this->UserList = $this->db->query($sql, 1);
			 
			if ($this->UserList)
				$cc = $this->Results($this->UserList); 
			if ($result)
				$c = $this->Results($result); 
			if ($c)
			{
				foreach ($c as $a=>$_a)
				{
					foreach ($_a as $aa=>$_aa)
					{
						foreach ($_aa as $aaa=>$_aaa)
						{
							if ($cc)
							{
								foreach ($cc as $b=>$_b)
								{
									if ($b == $a)
									{
										foreach ($_b as $bb=>$_bb)
										{
											foreach ($_bb as $bbb=>$_bbb)
											{
												if ($bb == $aa && $bbb == $aaa)
												{
													$c[$a][$aa][$aaa] = $_aaa-$_bbb;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			 
			return $c;
		}
	}
	
	private function Results($result)
	{
		$count = array();
		$c = array();
		$arr=array(
			"正碼一"=>"a",
			"正碼二"=>"b",
			"正碼三"=>"c",
			"正碼四"=>"d",
			"正碼五"=>"e",
			"正碼六"=>"f",
			"特碼"=>"g",
			"正碼"=>"h",
			"半波"=>"i",
			"五行"=>"j",
			"特碼生肖"=>"k",
			"一肖"=>"l",
			"特尾"=>"m",
			"尾數"=>"n",
			"特碼頭"=>"o"
		);
		foreach( $arr as $k=>$v ){
			$count = $this->SubCount($result, $k); 
			if($count>0){
				$c[$v]=$this->IsDetailed($result, $k); 
			}
		} 
		 
		return $c;
	}
	
	private function IsDetailed($result, $typeKey)
	{
		$counts = array();
		$numarr=array();
		for($i=1;$i<=49;$i++){
			$numarr[$i-1]= strlen($i)==1 ? "0".$i : $i; 
		}
		$carr=array("大","小","單","雙","合單","合雙","紅波","綠波","藍波");
		$karr=array("合大","合小","尾大","尾小","大單","大雙","小單","小雙","紅大單","紅大雙","紅小單","紅小雙","藍大單","藍大雙","藍小單","藍小雙","綠大單","綠大雙","綠小單","綠小雙");
		$zarr=array("總大","總小","總單","總雙");
		 
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $typeKey)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $list['g_jiner'];
				$smoney = $list['g_jiner'] - ($list['g_jiner'] * $result[$i]['g_odds']+$list['g_tueishui']);
				switch($typeKey)
				{
					case "正碼一":
					case "正碼二":
					case "正碼三":
					case "正碼四":
					case "正碼五":
					case "正碼六":
						$arr = array_merge($numarr,$carr);
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]  += $smoney;
							}
						}
						break;
					case "特碼":
						$arr = array_merge($numarr,$carr,$karr);
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break;
					case "正碼":
						$arr = array_merge($numarr,$zarr);
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break;
					case "半波":
						$arr = array("紅單","紅雙","紅大","紅小","綠單","綠雙","綠大","綠小","藍單","藍雙","藍大","藍小");
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break;
					case "五行":
						$arr = array("金","木","水","火","土");
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break;
					case "特碼生肖":
					case "一肖":
						global $CONFIG;
						$arr = array_keys($CONFIG['lhc_rgb']['SX']);
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break;
					case "特尾":
					case "尾數":
						$arr=array(0,1,2,3,4);
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break;
					case "特碼頭":
						$arr=array(0,1,2,3,4,5,6,7,8,9);
						for($k=0;$k<count($arr);$k++){
							if($result[$i]['g_mingxi_2']==$arr[$k]){
								$counts['a']['ah'.($k+1)] += $money;
								$counts['b']['ah'.($k+1)]+= $smoney;
							}
						}
						break; 
				} 
			}
		} 
		return $counts;
	}
	
	private function SubCount($result, $type)
	{
		$count = array(0=>0);
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $type)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $list['g_jiner'];
				$count[0] += $money;
			}
		}
		return $count;
	}
	
	private function SumPoshMoney($result, $results, $money)
	{
		$a = $money;
		if ($results)
		{
			for ($n=0; $n<count($results); $n++)
			{
				if ($result['g_mingxi_1'] == $results[$n]['g_mingxi_1'] && $result['g_mingxi_2'] == $results[$n]['g_mingxi_2'])
				{
					$c = ((1 - ($results[$n]['g_tueishui']/100))*$results[$n]['g_jiner']);
					$a = $a - $results[$n]['g_jiner'];
				}
			}
		}
		return $a;
	}
	
	private function Sumwin($kCount, $vCount, $p=0)
	{
		$count =$vCount;
		foreach ($vCount as $i=>$v)
		{
			if ($p == 0)
			{
				if (($i == 'ah1'||$i == 'ah2'||$i == 'ah3'||$i == 'ah4'||$i == 'ah5'||$i == 'ah6'||$i == 'ah7'||$i == 'ah8'||$i == 'ah9'||$i == 'ah10')&&$v>0)
					$count[$i] = $kCount[0] - $v;
				else if (($i=='ah11'||$i=='ah12')&&$v>0)
					$count[$i] = $kCount[1] - $v;
				else if (($i=='ah13'||$i=='ah14')&&$v>0)
					$count[$i] = $kCount[2] - $v;
			}
			else if ($p == 1)
			{
				if (($i=='bh1'||$i=='bh2')&&$v>0){
					$count[$i] = $kCount[3] - $v;
				}
				else if (($i=='bh3'||$i=='bh4')&&$v>0)
					$count[$i] = $kCount[4] - $v;
				else if (($i=='bh5'||$i=='bh6' || $i=='bh7')&&$v>0)
					$count[$i] = $kCount[5] - $v;
			}
			else 
			{
				if (($i == 'ch1'||$i == 'ch2'||$i == 'ch3'||$i == 'ch4'||$i == 'ch5')&&$v>0)
					$count[$i] = $kCount[6] - $v;
			}
		}
		return $count;
	}
	
	private function SumReport($result, $logId)
	{
		$List = array();
		if ($logId == 89 )
		{
			$List['g_tueishui'] = (((100-$result['g_tueishui_4'])/100) * $result['g_jiner']) * ($result['g_distribution_4']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_4']/100);
		}
		else if ($logId == 56)
		{
			$a = $result['g_distribution_3'];
			if ($a == 0){
				$List['g_jiner'] =$result['g_jiner'];
				if ($result['g_tueishui_3'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_3'])/100) * $result['g_jiner']);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']);
			}else {
				$List['g_jiner'] =$result['g_jiner'] * ($a/100);
				if ($result['g_tueishui_3'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_3'])/100) * $result['g_jiner']) * ($a/100);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
			}
		}
		else if ($logId == 22)
		{
			$a = $result['g_distribution_2'];
			if ($a == 0){
				$List['g_jiner'] =$result['g_jiner'];
				if ($result['g_tueishui_2'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_2'])/100) * $result['g_jiner']);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']);
			}else {
				$List['g_jiner'] =$result['g_jiner'] * ($a/100);
				if ($result['g_tueishui_2'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_2'])/100) * $result['g_jiner']) * ($a/100);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
			}
		}
		else if ($logId == 78)
		{
			$a = $result['g_distribution_1'];
			if ($a == 0){
				$List['g_jiner'] =$result['g_jiner'];
				if ($result['g_tueishui_1'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_1'])/100) * $result['g_jiner']);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']);
			}else {
				$List['g_jiner'] =$result['g_jiner'] * ($a/100);
				if ($result['g_tueishui_1'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_1'])/100) * $result['g_jiner']) * ($a/100);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
			}
		}
		else if ($logId == 48)
		{
			$a = $result['g_distribution'];
			if($a == 0){
				$p = ((100-$result['g_tueishui'])/100) * $result['g_jiner'];
				$c = $result['g_jiner'];
			}else {
				$p = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
				$c = $result['g_jiner'] * ($a/100);
			}
			$List['g_tueishui'] = $p;
			$List['g_jiner'] = $c;
		}
		return $List;
	}
	public function SumResult($Users)
	{
		include_once ROOT_PATH.'function/Crystals.php';
		$CentetArr = array();
		$CentetArr['userList']['s_types'] = null;
		$CentetArr['userList']['s_type'] = null;
		$CentetArr['userList']['s_t_N'] = 1;
		$CentetArr['userList']['startDate'] = date("Y-m-d");
		$CentetArr['userList']['endDate'] = date("Y-m-d");
		$CentetArr['userList']['s_Report'] = 'a';
		$CentetArr['userList']['s_Balance'] = 1;
		if ($Users[0]['g_login_id']==89)
		{
			$result = $this->db->query("SELECT `g_nid`,`g_login_id`, `g_name` FROM `g_manage` WHERE g_nid = '{$Users[0]['g_nid']}' LIMIT 1", 1);
			//print_r($Users[0]['g_nid']);
			$CentetArr['userList']['s_name'] = $result[0]['g_name'];
			$CentetArr['userList']['g_login_id'] = $result[0]['g_login_id'];
			$CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][1];
			$s_rank = $Users[0]['g_Lnid'][2];
			$CentetArr['userList']['s_nid'] = $result[0]['g_nid'].UserModel::Like();
		}
		else 
		{
			$CentetArr['userList']['s_name'] = $Users[0]['g_name'];
			if ($Users[0]['g_login_id'] == 48){
				$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'];
				$param = true;
			}
			else {
				$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'].UserModel::Like();
			}
			$CentetArr['userList']['g_login_id'] = $Users[0]['g_login_id'];
			$CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][0];
			$s_rank = $Users[0]['g_Lnid'][1];
		}
		$result = ResultNid ($this->db, $CentetArr['userList']['s_nid'], true, $param);
		for ($i=0; $i<count($result); $i++) {
			$c = GetCrystals($this->db, $CentetArr['userList'], $result[$i]);
			if ($c != null) {
					$result[$i]['cry'] = $c;
					$CentetArr['cryList'][] = $result[$i];
			}
		}
		$CentetArr = SumCrystals ($CentetArr);
		$money = $CentetArr['userList']['s_rank']=='总公司' ? $CentetArr['userList']['count_s'][3] : $CentetArr['userList']['count_s'][9];
		
		return is_Number($money,1);
	}
}
?>