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
include_once ROOT_PATH.'config/Odds.php';

class AutomaticOddscq
{
	private $db;
	private $Continuous;
	private $NumValue;
	private $StrValue;
	
	/**
	 *@param $Continuous 連續出次數
	 *@param $NumValue 號碼總降值
	 *@param $StrValue 雙面總降值
	 */
	public function __construct($Continuous, $NumValue, $StrValue)
	{
		$this->db = new DB();
		$this->Continuous = $Continuous;
		$this->NumValue = $NumValue;
		$this->StrValue = $StrValue;
	}
	
	public function UpExecution()
	{
		$result = $this->SearchNumber($this->Continuous, $this->NumValue, $this->StrValue);
		if ($result['Num'] && Copyright)
		{
			foreach ($result['Num'] as $key=>$value)
			{
				$sql = "UPDATE g_odds2 SET `{$key}`={$key}-{$value} WHERE g_type <> 'Ball_6' AND g_type <> 'Ball_7' AND g_type <> 'Ball_8' AND g_type <> 'Ball_9'";
				$this->db->query($sql, 2);
			}
		}
		if ($result['Str'] && Copyright)
		{
			for ($i=0; $i<count($result['Str']); $i++)
			{
				$sql = "UPDATE g_odds2 SET `{$result['Str'][$i][1]}` = {$result['Str'][$i][1]}-{$result['Str'][$i][2]} WHERE g_type ='{$result['Str'][$i][0]}' LIMIT 1 ";
				$this->db->query($sql, 2);
			}
		}
	}
	
	/**
	 * 查詢連續N期不出的號碼
	 */
	private function SearchNumber($Continuous, $NumValue, $StrValue)
	{
		$gameInfo = new GameInfo();
		//得到雙面無出期數
		$NumberStrArr = $gameInfo->OpenNumberCountb ($Continuous);
		
		foreach ($NumberStrArr as $key=>$value)
		{
			$values = $StrValue;
			if ($value > $Continuous && Copyright){
				$n = $value - $Continuous;
				$count = 0;
				for ($i=0; $i<$n; $i++)
					$count += $StrValue;
				$values += $count;
			}
			 $numArr[] = $this->NumberFormat($key, $values);
			 $values = $count= 0;
		}
		
		$NumberArr = $gameInfo->OpenNumberCount (1, true);
		$NumberArr = $this->ResultStrValue($NumberArr, $Continuous);
		
		//計算需要降多少次賠率
		$UpOddsArr = array();
		foreach ($NumberArr as $key=>$value)
		{
			$a = $key == 0 ? 1 : $key;
			$UpOddsArr['h'.$a] = $NumValue;
			if ($value > $Continuous && Copyright){
				$n = $value - $Continuous;
				$count = 0;
				for ($i=0; $i<$n; $i++)
					$count += $NumValue;
				$UpOddsArr['h'.$a] += $count;
			}
		}
		$result = array('Num'=>$UpOddsArr, 'Str'=>$numArr);
		return $result;
	}
	
	private function ResultStrValue($NumberArr, $Continuous)
	{
		$NumberArrs =array();
		foreach ($NumberArr as $key=>$value)
		{
			if ($value >= $Continuous && Copyright)
				$NumberArrs[$key] = $value;
		}
		return $NumberArrs;
	}
	
	private function NumberFormat($num, $param)
	{
		$str=array();
		$p = mb_substr($num, 3,1);
		switch ($num)
		{
			case "第{$p}球-大":  $str[0] = "Ball_{$p}"; $str[1] = 'h12'; break;
			case "第{$p}球-小" : $str[0] = "Ball_{$p}"; $str[1] = 'h11'; break;
			case "第{$p}球-單" : $str[0] = "Ball_{$p}"; $str[1] = 'h14'; break;
			case "第{$p}球-雙" : $str[0] = "Ball_{$p}"; $str[1] = 'h13'; break;
			case "總和大" :$str[0] = "Ball_6"; $str[1] = 'h2'; break;
			case "總和小" :$str[0] = "Ball_6"; $str[1] = 'h1'; break;
			case "總和單" :$str[0] = "Ball_6"; $str[1] = 'h4'; break;
			case "總和雙" :$str[0] = "Ball_6"; $str[1] = 'h3'; break;
			case "龍" :$str[0] = "Ball_6"; $str[1] = 'h6'; break;
			case "虎" :$str[0] = "Ball_6"; $str[1] = 'h5'; break;
		}
		$str[2]=$param;
		return $str;
	}
}
?>