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
class UserReportInfocq 
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
		$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date` FROM `g_kaipan2` WHERE g_lock = 2 ORDER BY g_qishu ASC LIMIT 1";
		$result = $this->db->query($sql, 1);
		$a = array(
			'endTime'=>strtotime($result[0]['g_feng_date']) - time(),
			'openTime'=>strtotime($result[0]['g_open_date']) - time(),
			'Phases'=>$result[0]['g_qishu']);
		return $a;
	}
	
	public function GetInfocq()
	{
		$sql = "SELECT g_qishu FROM g_kaipan2 WHERE g_lock = 2 ORDER BY g_qishu DESC LIMIT 1";
		$number = $this->db->query($sql, 0);
		if ($number && Copyright)
		{
			if ($this->User['g_login_id'] !=48 && Copyright){
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_s_nid <> '{$this->User['g_nid']}' 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '重慶時時彩' 
				AND g_win is null ";
			} else {
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_mumber_type<>5 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '重慶時時彩' 
				AND g_win is null ";
			}
			$result = $this->db->query($sql, 1);
			$sql = "SELECT * FROM g_zhudan WHERE g_qishu='{$number[0][0]}' 
			AND g_s_nid = '{$this->User['g_nid']}' 
			AND g_mumber_type=5 
			AND g_type = '重慶時時彩' 
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
			//print_r($cc);exit;
			return $c;
		}
	}
	
	private function Results($result)
	{
		$count = array();
		$c = array();
		$count[0]= $this->SubCount($result, '第一球');
		//print_r($count[0]);exit;
		if ($count[0][0]>0 || $count[0][1]>0 || $count[0][2]>0)
		{
			$a = $this->IsDetailed($result, '第一球');
			//print_r($a);exit;
			//$a['b'] = $this->Sumwin($count[0], $a['b']);
			$c['a'] = $a;
			//print_r($c);exit;
		}
		
		$count[1] = $this->SubCount($result, '第二球');
		if ($count[1][0]>0 || $count[1][1]>0 || $count[1][2]>0)
		{
			$a = $this->IsDetailed($result, '第二球');
			//$a['b'] = $this->Sumwin($count[1], $a['b']);
			$c['b'] = $a;
		}
		
		$count[2] = $this->SubCount($result, '第三球');
		if ($count[2][0]>0 || $count[2][1]>0 || $count[2][2]>0)
		{
			$a = $this->IsDetailed($result, '第三球');
			//$a['b'] = $this->Sumwin($count[2], $a['b']);
			$c['c'] = $a;
		}
		
		$count[3] = $this->SubCount($result, '第四球');
		if ($count[3][0]>0 || $count[3][1]>0 || $count[3][2]>0)
		{
			$a = $this->IsDetailed($result, '第四球');
			//$a['b'] = $this->Sumwin($count[3], $a['b']);
			$c['d'] = $a;
		}
		
		$count[4] = $this->SubCount($result, '第五球');
		if ($count[4][0]>0 || $count[4][1]>0 || $count[4][2]>0)
		{
			$a = $this->IsDetailed($result, '第五球');
			//$a['b'] = $this->Sumwin($count[4], $a['b']);
			$c['e'] = $a;
		}
		
		$count[5] = $this->SubCount($result, '總和、龍虎和');
		if ($count[5][3]>0 || $count[5][4]>0 || $count[5][5]>0)
		{
			$a = $this->IsDetailed($result, '總和、龍虎和');
			//$a['b'] = $this->Sumwin($count[5], $a['b'], 1);
			$c['w'] = $a;
		}
		
		$count[6] = $this->SubCount($result, '前三');
		if ($count[6][6]>0)
		{
			$a = $this->IsDetailed($result, '前三');
			//$a['b'] = $this->Sumwin($count[6], $a['b'], 2);
			$c['i'] = $a;
		}
		
		$count[7] = $this->SubCount($result, '中三');
		if ($count[7][6]>0)
		{
			$a = $this->IsDetailed($result, '中三');
			//$a['b'] = $this->Sumwin($count[7], $a['b'], 2);
			$c['s'] = $a;
		}
		
		$count[8] = $this->SubCount($result, '后三');
		if ($count[8][6]>0)
		{
			$a = $this->IsDetailed($result, '后三');
			//$a['b'] = $this->Sumwin($count[8], $a['b'], 2);
			$c['x'] = $a;
		}
		return $c;
	}
	
	private function IsDetailed($result, $typeKey)
	{
		$counts = array();
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $typeKey)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $list['g_jiner'];
				$smoney = $list['g_jiner'] - ($list['g_jiner'] * $result[$i]['g_odds']+$list['g_tueishui']);
				switch ($result[$i]['g_mingxi_2'])
				{
					case '0' : 
						$counts['a']['ah1'] += $money;
						$counts['b']['ah1']+= $smoney;
						break;
					case '1' : 
						$counts['a']['ah2'] += $money;
						$counts['b']['ah2']+= $smoney;
						break;
					case '2' : 
						$counts['a']['ah3'] += $money;
						$counts['b']['ah3']+= $smoney;
						break;
					case '3' : 
						$counts['a']['ah4'] += $money;
						$counts['b']['ah4']+= $smoney;
						break;
					case '4' : 
						$counts['a']['ah5'] += $money;
						$counts['b']['ah5']+=$smoney;
						break;
					case '5' : 
						$counts['a']['ah6'] += $money;
						$counts['b']['ah6']+=$smoney;
						break;
					case '6' : 
						$counts['a']['ah7'] += $money;
						$counts['b']['ah7']+=$smoney;
						break;
					case '7' : 
						$counts['a']['ah8'] += $money;
						$counts['b']['ah8']+=$smoney;
						break;
					case '8' : 
						$counts['a']['ah9'] += $money;
						$counts['b']['ah9']+=$smoney;
						break;
					case '9' : 
						$counts['a']['ah10'] += $money;
						$counts['b']['ah10']+=$smoney;
						break;
					case '大' : 
						$counts['a']['ah11'] += $money;
						$counts['b']['ah11']+=$smoney;
						break;
					case '小' : 
						$counts['a']['ah12'] += $money;
						$counts['b']['ah12']+=$smoney;
						break;
					case '單' : 
						$counts['a']['ah13'] += $money;
						$counts['b']['ah13']+=$smoney;
						break;
					case '雙' : 
						$counts['a']['ah14'] += $money;
						$counts['b']['ah14']+=$smoney;
						break;
					case '總和大' : 
						$counts['a']['bh1'] += $money;
						$counts['b']['bh1']+=$smoney;
						break;
					case '總和小' : 
						$counts['a']['bh2'] += $money;
						$counts['b']['bh2']+=$smoney;
						break;
					case '總和單' : 
						$counts['a']['bh3'] += $money;
						$counts['b']['bh3']+=$smoney;
						break;
					case '總和雙' : 
						$counts['a']['bh4'] += $money;
						$counts['b']['bh4']+=$smoney;
						break;
					case '龍' : 
						$counts['a']['bh5'] +=$money;
						$counts['b']['bh5']+=$smoney;
						break;
					case '虎' : 
						$counts['a']['bh6'] += $money;
						$counts['b']['bh6']+=$smoney;
						break;
					case '和' : 
						$counts['a']['bh7'] += $money;
						$counts['b']['bh7']+=$smoney;
						break;
					case '豹子' : 
						$counts['a']['ch1'] += $money;
						$counts['b']['ch1']+=$smoney;
						break;
					case '順子' : 
						$counts['a']['ch2'] +=$money;
						$counts['b']['ch2']+=$smoney;
						break;
					case '對子' : 
						$counts['a']['ch3'] += $money;
						$counts['b']['ch3']+=$smoney;
						break;
					case '半順' : 
						$counts['a']['ch4'] +=$money;
						$counts['b']['ch4']+=$smoney;
						break;
					case '雜六' : 
						$counts['a']['ch5'] += $money;
						$counts['b']['ch5']+=$smoney;
						break;
				}
			}
		}
		return $counts;
	}
	
	private function SubCount($result, $type)
	{
		$count = array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0);
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $type)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $list['g_jiner'];
				if (Matchs::isNumber($result[$i]['g_mingxi_2']))
				{
					$count[0] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '大' || $result[$i]['g_mingxi_2'] == '小')
				{
					$count[1] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '單' || $result[$i]['g_mingxi_2'] == '雙')
				{
					$count[2] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '總和大' || $result[$i]['g_mingxi_2'] == '總和小')
				{
					$count[3] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '總和單' || $result[$i]['g_mingxi_2'] == '總和雙')
				{
					$count[4] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '龍' || $result[$i]['g_mingxi_2'] == '虎' || $result[$i]['g_mingxi_2'] == '和')
				{
					$count[5] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '豹子' || $result[$i]['g_mingxi_2'] == '順子' || $result[$i]['g_mingxi_2'] == '對子' || $result[$i]['g_mingxi_2'] == '半順' || $result[$i]['g_mingxi_2'] == '雜六')
				{
					$count[6] += $money;
				}
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
	
	/*private function Results($result)
	{
		$count = array();
		$c = array();
		$count[0] = $this->SubCount($result, '第一球');
		if ($count[0][0]>0 || $count[0][1]>0 || $count[0][2]>0)
		{
			$a = $this->IsDetailed($result, '第一球', $count[0]);
			print_r($a);exit;
			$a['b'] = $this->Sumwin($count[0], $a['b']);
			$c['a'] = $a;
		}
		
		$count[1] = $this->SubCount($result, '第二球');
		if ($count[1][0]>0 || $count[1][1]>0 || $count[1][2]>0)
		{
			$a = $this->IsDetailed($result, '第二球', $count[1]);
			$a['b'] = $this->Sumwin($count[1], $a['b']);
			$c['b'] = $a;
		}
		
		$count[2] = $this->SubCount($result, '第三球');
		if ($count[2][0]>0 || $count[2][1]>0 || $count[2][2]>0)
		{
			$a = $this->IsDetailed($result, '第三球', $count[2]);
			$a['b'] = $this->Sumwin($count[2], $a['b']);
			$c['c'] = $a;
		}
		
		$count[3] = $this->SubCount($result, '第四球');
		if ($count[3][0]>0 || $count[3][1]>0 || $count[3][2]>0)
		{
			$a = $this->IsDetailed($result, '第四球', $count[3]);
			$a['b'] = $this->Sumwin($count[3], $a['b']);
			$c['d'] = $a;
		}
		
		$count[4] = $this->SubCount($result, '第五球');
		if ($count[4][0]>0 || $count[4][1]>0 || $count[4][2]>0)
		{
			$a = $this->IsDetailed($result, '第五球', $count[4]);
			$a['b'] = $this->Sumwin($count[4], $a['b']);
			$c['e'] = $a;
		}
		
		$count[5] = $this->SubCount($result, '總和、龍虎和');
		if ($count[5][3]>0 || $count[5][4]>0 || $count[5][5]>0)
		{
			$a = $this->IsDetailed($result, '總和、龍虎和', $count[5]);
			$a['b'] = $this->Sumwin($count[5], $a['b'], 1);
			$c['w'] = $a;
		}
		
		$count[6] = $this->SubCount($result, '前三');
		if ($count[6][6]>0)
		{
			$a = $this->IsDetailed($result, '前三', $count[6]);
			$a['b'] = $this->Sumwin($count[6], $a['b'], 2);
			$c['i'] = $a;
		}
		
		$count[7] = $this->SubCount($result, '中三');
		if ($count[7][6]>0)
		{
			$a = $this->IsDetailed($result, '中三', $count[7]);
			$a['b'] = $this->Sumwin($count[7], $a['b'], 2);
			$c['s'] = $a;
		}
		
		$count[8] = $this->SubCount($result, '后三');
		if ($count[8][6]>0)
		{
			$a = $this->IsDetailed($result, '后三', $count[8]);
			$a['b'] = $this->Sumwin($count[8], $a['b'], 2);
			$c['x'] = $a;
		}
		return $c;
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
					$a = $money - $results[$n]['g_jiner'];
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
	
	private function IsDetailed($result, $typeKey, $count)
	{
		$counts = array();
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $typeKey)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $this->SumPoshMoney($result[$i], $this->UserList, $list['g_jiner']);
				$smoney = $money * $result[$i]['g_odds'];
				//$money =$list['g_jiner'];
				//$smoney = $list['g_jiner']*$result[$i]['g_odds'];
				switch ($result[$i]['g_mingxi_2'])
				{
					case '0' : 
						$counts['a']['ah1'] += $money;
						$counts['b']['ah1']+= $smoney;
						break;
					case '1' : 
						$counts['a']['ah2'] += $money;
						$counts['b']['ah2']+= $smoney;
						break;
					case '2' : 
						$counts['a']['ah3'] += $money;
						$counts['b']['ah3']+= $smoney;
						break;
					case '3' : 
						$counts['a']['ah4'] += $money;
						$counts['b']['ah4']+= $smoney;
						break;
					case '4' : 
						$counts['a']['ah5'] += $money;
						$counts['b']['ah5']+=$smoney;
						break;
					case '5' : 
						$counts['a']['ah6'] += $money;
						$counts['b']['ah6']+=$smoney;
						break;
					case '6' : 
						$counts['a']['ah7'] += $money;
						$counts['b']['ah7']+=$smoney;
						break;
					case '7' : 
						$counts['a']['ah8'] += $money;
						$counts['b']['ah8']+=$smoney;
						break;
					case '8' : 
						$counts['a']['ah9'] += $money;
						$counts['b']['ah9']+=$smoney;
						break;
					case '9' : 
						$counts['a']['ah10'] += $money;
						$counts['b']['ah10']+=$smoney;
						break;
					case '大' : 
						$counts['a']['ah11'] += $money;
						$counts['b']['ah11']+=$smoney;
						break;
					case '小' : 
						$counts['a']['ah12'] += $money;
						$counts['b']['ah12']+=$smoney;
						break;
					case '單' : 
						$counts['a']['ah13'] += $money;
						$counts['b']['ah13']+=$smoney;
						break;
					case '雙' : 
						$counts['a']['ah14'] += $money;
						$counts['b']['ah14']+=$smoney;
						break;
					case '總和大' : 
						$counts['a']['bh1'] += $money;
						$counts['b']['bh1']+=$smoney;
						break;
					case '總和小' : 
						$counts['a']['bh2'] += $money;
						$counts['b']['bh2']+=$smoney;
						break;
					case '總和單' : 
						$counts['a']['bh3'] += $money;
						$counts['b']['bh3']+=$smoney;
						break;
					case '總和雙' : 
						$counts['a']['bh4'] += $money;
						$counts['b']['bh4']+=$smoney;
						break;
					case '龍' : 
						$counts['a']['bh5'] +=$money;
						$counts['b']['bh5']+=$smoney;
						break;
					case '虎' : 
						$counts['a']['bh6'] += $money;
						$counts['b']['bh6']+=$smoney;
						break;
					case '和' : 
						$counts['a']['bh7'] += $money;
						$counts['b']['bh7']+=$smoney;
						break;
					case '豹子' : 
						$counts['a']['ch1'] += $money;
						$counts['b']['ch1']+=$smoney;
						break;
					case '順子' : 
						$counts['a']['ch2'] +=$money;
						$counts['b']['ch2']+=$smoney;
						break;
					case '對子' : 
						$counts['a']['ch3'] += $money;
						$counts['b']['ch3']+=$smoney;
						break;
					case '半順' : 
						$counts['a']['ch4'] +=$money;
						$counts['b']['ch4']+=$smoney;
						break;
					case '雜六' : 
						$counts['a']['ch5'] += $money;
						$counts['b']['ch5']+=$smoney;
						break;
				}
			}
		}
		return $counts;
	}
	
	private function SubCount($result, $typeKey)
	{
		$count = array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0);
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $typeKey)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				//$money = $this->SumPoshMoney($result[$i], $this->UserList, $list['g_jiner']);
				//$result[$i]['g_jiner'] = $money;
				//$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				//$money = $money-$list['g_tueishui'];
				$money = $result[$i]['g_jiner'];
				if (Matchs::isNumber($result[$i]['g_mingxi_2']))
				{
					$count[0] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '大' || $result[$i]['g_mingxi_2'] == '小')
				{
					$count[1] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '單' || $result[$i]['g_mingxi_2'] == '雙')
				{
					$count[2] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '總和大' || $result[$i]['g_mingxi_2'] == '總和小')
				{
					$count[3] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '總和單' || $result[$i]['g_mingxi_2'] == '總和雙')
				{
					$count[4] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '龍' || $result[$i]['g_mingxi_2'] == '虎' || $result[$i]['g_mingxi_2'] == '和')
				{
					$count[5] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '豹子' || $result[$i]['g_mingxi_2'] == '順子' || $result[$i]['g_mingxi_2'] == '對子' || $result[$i]['g_mingxi_2'] == '半順' || $result[$i]['g_mingxi_2'] == '雜六')
				{
					$count[6] += $money;
				}
			}
		}
		return $count;
	}
	
	private function CountNum($result)
	{
		
	}
	
	private function SumReport($result, $logId)
	{
		$List = array();
		if ($logId == 89 || $logId == 56)
		{
			$List['g_tueishui'] = (((100-$result['g_tueishui_3'])/100) * $result['g_jiner']) * ($result['g_distribution_3']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_3']/100);
		}
		else if ($logId == 22)
		{
			if ($result['g_tueishui_2'] >0 && Copyright)
				$List['g_tueishui'] = (((100-$result['g_tueishui_2'])/100) * $result['g_jiner']) * ($result['g_distribution_2']/100);
			else
				$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($result['g_distribution_2']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_2']/100);
		}
		else if ($logId == 78)
		{
			if ($result['g_tueishui_1'] >0 && Copyright)
				$List['g_tueishui'] = (((100-$result['g_tueishui_1'])/100) * $result['g_jiner']) * ($result['g_distribution_1']/100);
			else
				$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($result['g_distribution_1']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_1']/100);
		}
		else if ($logId == 48)
		{
			$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($result['g_distribution']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution']/100);
		}
		return $List;
	}*/
}
?>