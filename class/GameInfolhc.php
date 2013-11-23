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

class GameInfolhc
{
	private $result;
	function __construct()
	{
		$db = new DB(); 
		$sql = "SELECT `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7` FROM `g_history_lhc` WHERE  g_ball_1 is not null ORDER BY g_qishu ASC limit 0,10";
		$this->result = $db->query($sql, 0);
	}
	
	function NumberDayAll()
	{
		return $this->result;
	}

	/*public function OpenNumberCount ($id, $p=false)
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
	}*/
	
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
				$ball = lhcNumber($index, $ball, 1);
			else if ($num == 1 && Copyright)
				$ball = $this->result[$i][0]+$this->result[$i][1]+$this->result[$i][2]+$this->result[$i][3]+$this->result[$i][4]+$this->result[$i][5];
			else if ($num == 2 && Copyright)
				$ball = lhcNumber($index, $this->result[$i][0]+$this->result[$i][1]+$this->result[$i][2]+$this->result[$i][3]+$this->result[$i][4]+$this->result[$i][5], 1);
			else if ($num == 3 && Copyright)
				$ball = lhcNumber($index, $ball, 1);
			else if ($num == 4 && Copyright)
				$ball = lhcNumber($index, $this->result[$i], 1);
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
		global $BallStringlhc;
		for ($i=0; $i<count($this->result); $i++) //循環期數
		{
			$n=6; 
			$s = $n+1;
			$countArray1 += $this->GetBallString($this->result[$i][$n], $BallStringcq, $s); 
			foreach ($countArray1 as $key=>$value)
			{
				if ($value != 0 && Copyright)
					$numArray1[$key] += $value;
				else 
					$numArray1[$key] = 0;
			}
			$countArray1 = array(); 
		} 
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
				if($index===7){
					$k="特碼";
				}else{
					$k=="正碼".$index;
				}
				if ($numStrng == $BallArray[$i] && Copyright)
					$countArray[$k.'-'.$BallArray[$i]] = 1;
				else
					$countArray[$k.'-'.$BallArray[$i]] = 0;
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
			if ($result >= 25)
				return '大';
			else
				return '小';
		}
		else if ($num == 4 || $num == 5)
		{
			if(strlen($result)==1)$result="0".$result;
			$result=substr($result,0,1)+substr($result,1,1);
			if ($result%2==0)
				return '合雙';
			else
				return '合單';
		}
		else if ($num == 6 || $num == 7 || $num == 8)
		{
			if(strlen($result)==1)$result="0".$result;
			global $CONFIG; 
			if( in_array($result,$CONFIG['lhc_rgb']['red_arr']) ){ 
				return   '紅波';
			}else if( in_array($result,$CONFIG['lhc_rgb']['green_arr']) ){
				return  '綠波';
			}else if( in_array($result,$CONFIG['lhc_rgb']['blue_arr']) ){
				return  '藍波';
			}
		}
		else if($num>=9 && $num<=18)
		{
			if(strlen($result)==1)$result="0".$result;
			global $CONFIG; 
			$SX=$CONFIG['lhc_rgb']['SX'];
			foreach($SX as $key=>$val){
				if( in_array($result,$val) ){
					return $key;
				}
			}
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