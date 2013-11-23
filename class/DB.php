<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:914190123
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
exit('作者QQ:914190123');
if (!defined('ROOT_PATH'))
exit('invalid request');
class DB 
{
	//数据库地址
	private $dbHost = 'localhost';
	
	//MySql数据库用户名
	private $dbUser = 'facebak';
	
	 //MySql数据库密码 
	private $dbPwd = 'r6v5y6n9';
	
	//MySql数据库名称
	private $dbName = 'facebak';
	
	private function connect ()
	{
		$link = mysql_connect($this->dbHost, $this->dbUser, $this->dbPwd) or die ("Could not connect"); 
		mysql_select_db($this->dbName, $link) or die ("Could not selectDB");
		mysql_query("SET NAMES UTF8;") or die ("Could not UTF8");
		mysql_query("SET time_zone = '+8:00';"); 
		return $link;
	}
	
	public function query ($sql, $parameter)
	{
		$result = NULL;
		$conn = $this->connect();
		$query = mysql_query ($sql,$conn) or die ("Invalid query：".$sql);
		switch ($parameter)
		{
			case 0 : 
				while (!!$row = mysql_fetch_row($query)) { $result[] = $row; }
				break;
			case 1 :
				while (!!$row = mysql_fetch_assoc($query)){ $result[] = $row; }
				 break;
			case 2 : $result = mysql_affected_rows($conn); //返回 INERT UPDATE DELETE 響應行數
				break;
			case 3 : $result = mysql_num_rows($query); 
				break;
			case 4 : $result = mysql_insert_id($conn);
			break;
			case 5 : while (!!$row = mysql_fetch_field($query)){$result[] = $row->name;}
			break;
			case 6 : return $query;
		}
		return $result;
	}
	
	/**
	 * 得到表結構
	 */
	public function GetTables()
	{
		$conn = $this->connect();
		//$tables = mysql_list_tables($this->dbName);
		$database = $this->dbName;
		$tables = mysql_query("SHOW TABLES FROM $database");
		while (!!$row = mysql_fetch_row($tables)){ 
			$result[] = $row[0]; 
		}
		return $result;
	}
	
/**
	 * SELECT 查詢語句
	 * @param String $param
	 * @param String $from
	 * @param Int $limit
	 * @param String $where
	 * @param Int $parameter
	 */
	public function Select ($param, $from, $limit, $where=null, $parameter=1)
	{
		$db = new DB();
		$sql = $where == null ? " SELECT {$param} FROM {$from} LIMIT = $limit ":
											 " SELECT {$param} FROM {$from} WHERE {$where} LIMIT $limit ";
		return $db->query($sql, $parameter);
	}
	
	/**
	 * UPDATE 更改語句
	 * @param String $param
	 * @param String $from
	 * @param Int $limit
	 * @param String $where
	 */
	public function Update ($set, $from, $where, $limit)
	{
		$db = new DB();
		$sql = " UPDATE {$from} SET {$set} WHERE {$where} LIMIT $limit";
		return $db->query($sql, 2);
	}
	
	public function selectField($sql)
	{
		$result=$this->query($sql,6);
		$row = mysql_fetch_row($result);
		return $row[0];
	}
	
	public function selectOne($sql)
	{
		$result=$this->query($sql,6);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
}













?>