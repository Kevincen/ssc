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
include_once ROOT_PATH.'config/Odds.php';

class AutomaticOddsnc 
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
	
	/**
	 * 執行降賠率
	 * @param unknown_type $Continuous
	 * @param unknown_type $NumValue
	 * @param unknown_type $StrValue
	 */
	public function UpExecution()
	{
		$result = $this->SearchNumber($this->Continuous, $this->NumValue, $this->StrValue);
		if ($result['Num'] && Copyright)
		{
			foreach ($result['Num'] as $key=>$value)
			{
				$sql = "UPDATE g_odds5 SET `{$key}`={$key}-{$value} WHERE g_type <> 'Ball_9' AND g_type <> 'Ball_10'";
				$this->db->query($sql, 2);
			}
		}
		if ($result['Str'] && Copyright)
		{
			for ($i=0; $i<count($result['Str']); $i++)
			{
				$sql = "UPDATE g_odds5 SET `{$result['Str'][$i][1]}` = {$result['Str'][$i][1]}-{$result['Str'][$i][2]} WHERE g_type ='{$result['Str'][$i][0]}' LIMIT 1 ";
				$this->db->query($sql, 2);
			}
		}
	}
	
	/**
	 * 查詢連續N期不出的號碼
	 */
	private function SearchNumber($Continuous, $NumValue, $StrValue)
	{
		$ResultNumber = history_resultnc(0);
		
		//得到雙面無出期數
		global $BallString, $BallString_nc;
		$NumberStrArr = sum_ball_count_1_nc ($BallString, $BallString_nc, $ResultNumber, 1);
		
		//取出大於$Continuous連續出期數的雙面
		$NumberStrArr = $this->ResultStrValue($NumberStrArr, $Continuous);

		//雙面轉換
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
		
		//得到1-20無出期數
		$NumberArr = sum_ball_count_nc ($ResultNumber, 1);
		$NumberArr = $NumberArr['row_2'];
		
		//取出大於$Continuous連續不出期數的1-20號碼
		$NumberArr = $this->ResultStrValue($NumberArr, $Continuous);
		
		//計算需要降多少次賠率
		$UpOddsArr = array();
		foreach ($NumberArr as $key=>$value)
		{
			$UpOddsArr['h'.$key] = $NumValue;
			if ($value > $Continuous && Copyright){
				$n = $value - $Continuous;
				$count = 0;
				for ($i=0; $i<$n; $i++)
					$count += $NumValue;
				$UpOddsArr['h'.$key] += $count;
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
			case "第{$p}球-大":  $str[0] = "Ball_{$p}"; $str[1] = 'h22'; break;
			case "第{$p}球-小" : $str[0] = "Ball_{$p}"; $str[1] = 'h21'; break;
			case "第{$p}球-單" : $str[0] = "Ball_{$p}"; $str[1] = 'h24'; break;
			case "第{$p}球-雙" : $str[0] = "Ball_{$p}"; $str[1] = 'h23'; break;
			case "第{$p}球-尾大" : $str[0] = "Ball_{$p}"; $str[1] = 'h26'; break;
			case "第{$p}球-尾小" : $str[0] = "Ball_{$p}"; $str[1] = 'h25'; break;
			case "第{$p}球-合數單" : $str[0] = "Ball_{$p}"; $str[1] = 'h28'; break;
			case "第{$p}球-合數雙" : $str[0] = "Ball_{$p}"; $str[1] = 'h27'; break;
			case "第{$p}球-梅" : $str[0] = "Ball_{$p}"; $str[1] = 'h30'; break;
			case "第{$p}球-兰" : $str[0] = "Ball_{$p}"; $str[1] = 'h29'; break;
			case "第{$p}球-菊" :$str[0] = "Ball_{$p}"; $str[1] = 'h31'; break;
			case "第{$p}球-竹" :$str[0] = "Ball_{$p}"; $str[1] = 'h32'; break;
			case "第{$p}球-中" :$str[0] = "Ball_{$p}"; $str[1] = 'h33'; break;
			case "第{$p}球-發" :$str[0] = "Ball_{$p}"; $str[1] = 'h34'; break;
			case "第{$p}球-白" :$str[0] = "Ball_{$p}"; $str[1] = 'h35'; break;
			case "總和大" :$str[0] = "Ball_9"; $str[1] = 'h3'; break;
			case "總和小" :$str[0] = "Ball_9"; $str[1] = 'h1'; break;
			case "總和單" :$str[0] = "Ball_9"; $str[1] = 'h4'; break;
			case "總和雙" :$str[0] = "Ball_9"; $str[1] = 'h2'; break;
			case "總和尾大" :$str[0] = "Ball_9"; $str[1] = 'h7'; break;
			case "總和尾小" :$str[0] = "Ball_9"; $str[1] = 'h5'; break;
			case "家禽" :$str[0] = "Ball_9"; $str[1] = 'h8'; break;
			case "野兽" :$str[0] = "Ball_9"; $str[1] = 'h6'; break;
		}
		$str[2]=$param;
		return $str;
	}
}
?>
