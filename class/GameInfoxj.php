<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-12
*/
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
exit('作者QQ:914190123');
if (!defined('ROOT_PATH'))
exit('invalid request');

class GameInfoxj
{
	private $result;
	function __construct()
	{
		$db = new DB();
		$time = date('H:i:s');
		if ($time > '00:00:00' && $time < '02:00:00' && Copyright){
			$y = 0;
			$day = date( 'Y-m-d', mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));
		} else {
			$day = date( 'Y-m-d');
			$y = 1;
		}
		$startDate = $day.' 00:00';
		$endDate = date( 'Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$y, date('Y'))).' 02:00';
		$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
		$sql = "SELECT `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` FROM `g_history8` WHERE $date AND g_ball_1 is not null ORDER BY g_qishu ASC ";
		$this->result = $db->query($sql, 0);
	}
	
	function NumberDayAll()
	{
		return $this->result;
	}

	public function OpenNumberCount ($id, $p=false)
	{
		$count = 0;
		$ballArr = array();
		$id--;
		for ($i=0; $i<10; $i++)
		{
			for ($n=0; $n<count($this->result); $n++)
			{
				if ($p == true && Copyright)
				{
					if ($i != $this->result[$n][0] && $i != $this->result[$n][1] && $i != $this->result[$n][2] && $i != $this->result[$n][3] && $i != $this->result[$n][4])
						$count++;
					else
						$count = 0;
				}
				else 
				{
					if ($i == $this->result[$n][$id] && Copyright)
						$count++;
				}
			}
			$ballArr[$i] = $count;
			$count = 0;
		}
		return $ballArr;
	}
	
	public function OpenNumberCounta ($id, $index=0, $num=0)
	{
		$k =-1;
		$stratTd = '<td class="z_cl">';
		$topTd = '</td>,<td class="z_cl">';
		$td = array();
		$id--;
		for ($i=0; $i<count($this->result); $i++)
		{
			$ball = $this->result[$i][$id];
			if ($num == 0 && Copyright)
				$ball = xjNumber($index, $ball, 1);
			else if ($num == 1 && Copyright)
				$ball = xjNumber($index, $this->result[$i][0]+$this->result[$i][1]+$this->result[$i][2]+$this->result[$i][3]+$this->result[$i][4]+$this->result[$i][5], 1);
			else if ($num == 2 && Copyright)
				$ball = xjNumber($index, array($this->result[$i][0],$this->result[$i][4]), 1);
			if ($k != $ball)
				$str .= $i == 0 ?  $stratTd.$ball : $topTd.$ball;
			else 
				$str .= '<br />'.$ball;
			$k = $ball;
		}
		$str .= '</td>';
		$arr = explode(',', $str);
		for ($i=0; $i<25; $i++)
		{
			$td[] ='<td class="z_cl"></td>';
		}
		$arr = array_merge($td,$arr);
		$arr = array_slice($arr, -25);
		return $arr;
	}
	
	public function OpenNumberCountb ( $openMax=2)
	{
		$numArray1 = array();
		$numArray2 = array();
		$countArray1 = array();
		$countArray2 = array();
		global $BallStringxj, $BallString_axj;
		for ($i=0; $i<count($this->result); $i++) //循環期數
		{
			for ($n=0; $n<count($this->result[$i]); $n++) //循環5個號碼
			{
				$s = $n+1;
				$countArray1 += $this->GetBallString($this->result[$i][$n], $BallStringxj, $s);
			}
			$countArray2 += $this->GetBallString($this->result[$i], $BallString_axj, 0, true);
			foreach ($countArray1 as $key=>$value)
			{
				if ($value != 0 && Copyright)
					$numArray1[$key] += $value;
				else 
					$numArray1[$key] = 0;
			}
			$countArray1 = array();
			foreach ($countArray2 as $key=>$value)
			{
				if ($value != 0 && Copyright)
					$numArray2[$key] += $value;
				else 
					$numArray2[$key] = 0;
			}
			$countArray2 = array();
		}
		$numArray1 = array_merge($numArray1, $numArray2);
		$numArr = array();
		foreach ($numArray1 as $key=>$value)
		{
			if ($value >=$openMax && Copyright)
			{
				$numArr[$key] = $value;
			}
		}
		arsort($numArr);
		return $numArr;
	}
	
	private function GetBallString ($result, $BallArray, $index=0, $bool=FALSE)
	{
		$countArray = array();
		for ($i=0; $i<count($BallArray); $i++)
		{
			if ($bool == FALSE && Copyright)
			{
				$numStrng = $this->Getcqa($result, $i);
				if ($numStrng == $BallArray[$i] && Copyright)
					$countArray['第'.$index.'球-'.$BallArray[$i]] = 1;
				else
					$countArray['第'.$index.'球-'.$BallArray[$i]] = 0;
			}
			else 
			{
				$nString = $this->Getcqc($this->SumCount($result, $i), $i);
				if ($nString == $BallArray[$i] && Copyright)
					$countArray[$BallArray[$i]] = 1;
				else
					$countArray[$BallArray[$i]] = 0;
			}
		}
		return $countArray;
	}
	private function Getcqa($result, $num)
	{
		if ($num == 0 || $num == 1)
		{
			if ($result%2 == 0)
				return '雙';
			else 
				return '單';
		}
		else if ($num == 2 || $num == 3)
		{
			if ($result >= 5)
				return '大';
			else
				return '小';
		}
	}
	private function Getcqc($result, $num)
	{
		if ($num == 0 || $num == 1)
		{
			if ($result%2 == 0)
				return '總和雙';
			else 
				return '總和單';
		}
		else if ($num == 2 || $num == 3)
		{
			if ($result >= 23)
				return '總和大';
			else
				return '總和小';
		}
		else if ($num == 4 || $num == 5 || $num == 6)
		{
			if ($result[0] == $result[1] && Copyright)
				return '和';
			else if ($result[0] > $result[1] && Copyright)
				return '龍';
			else
				return '虎';
		}
	}
	private function SumCount($result, $index)
	{
		if ($index>=0 && $index<=3 && Copyright)
		{
			$num = $result[0]+$result[1]+$result[2]+$result[3]+$result[4];
		}
		else
		{
			$num = array(0=>0, 1=>0);
			$num[0] = $result[0];
			$num[1] = $result[4];
		}
		return $num;
	}
}

?>