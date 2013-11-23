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

class GameInfojsk3
{
	private $result;
	function __construct()
	{
		$db = new DB(); 
		$sql = "SELECT g_qishu,`g_ball_1`, `g_ball_2`, `g_ball_3` FROM `g_history9` WHERE  g_ball_1 is not null ORDER BY g_qishu DESC limit 0,19";
		$this->result = $db->query($sql, 0);
	}
	
	function NumberDayAll()
	{
		return $this->result;
	}

	public function OpenNumberCount ()
	{
		$history = array();
		$result = $this->result;
		for ($i=0; $i<count($result); $i++)
		{
			$history[]="<tr>
							<td class='white' width=40>".substr($result[$i][0],-2)."期</td>
							<td class='NO_JS_".$result[$i][1]."' width=27></td>
							<td class='NO_JS_".$result[$i][2]."' width=27></td>
							<td class='NO_JS_".$result[$i][3]."' width=27></td>
							<td class='white' width=30>".($result[$i][1]+$result[$i][2]+$result[$i][3])."</td>
							<td class='white' width=30>".jsk3Number(array($result[$i][1],$result[$i][2],$result[$i][3]))."</td>
						</tr>";		 
		}
		return $history;
	}
	
	
}

?>