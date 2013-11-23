<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
exit('作者QQ:914190123');
if (!defined('ROOT_PATH'))
exit('invalid request');

class Detailed 
{
	private $db;
	function __construct()
	{
		$this->db = new DB();
	}
	
	/**
	 * 得到會員下注明細，當 $param = TRUE 查詢已結算的
	 * @param String $name 帳號
	 * @param Bool $param
	 */
	public function GetDetaileds ($name, $param=FALSE)
	{
		$win = $param == TRUE ? " AND g_win is not null " : " AND g_win is null ";
		$sql = "SELECT * FROM g_zhudan WHERE g_nid = '{$name}' {$win}";
		return $this->db->query($sql, 1);
	}
	
	/**
	 * 得到當前會員所有下注明細
	 * @param String $name
	 * @return Count
	 */
	public function GetDetailedsAll ($name)
	{
		$a = day();
		$startDate = $a[0];
		$endDate = $a[1];
		$date = " AND `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
		$sql = "SELECT `g_id` FROM `g_zhudan` WHERE `g_nid` = '{$name}' {$date} LIMIT 1 ";
		return $this->db->query($sql, 3);
	}
}

?>