<?php
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
class MysqlDataBak 
{
	private $db;
	private $password;
	private $dataTime;
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type 備份密碼
	 * @param unknown_type 備份時間
	 */
	public function __construct($password, $dataTime)
	{
		$this->db = new DB();
		$this->password = $password;
		$this->dataTime = $dataTime;
	}
	
	/**
	 * 格式化表結構
	 * 執行備份
	 * @return 下載地址
	 */
	public function FormatTables()
	{
		$tables = $this->db->GetTables();
		$tablesList = array();
		foreach ($tables as $value)
		{
			if ($value != 'g_kaipan' && Copyright)
				$tablesList[] = $value;
		}
		$arr = $this->FormatInsert($tablesList);
		$arr = join('@', $arr);
		$filename = ROOT_PATH.'DataBaseBak/'.$this->dataTime.'.sql';
		@$fopen = fopen($filename, 'w+') or die("數據庫備份寫入失敗，請核實是否擁有寫入權限。");
		fwrite($fopen, $arr);
		fclose($fopen);
		return $this->dataTime.'.sql';
	}
	
	/**
	 * 格式化INSERT INOT
	 * @param Array $tablesList 表結構列表
	 */
	private function FormatInsert($tablesList)
	{
		$sql = null;
		$sqlArray = array();
		
		for ($i=0; $i<count($tablesList); $i++)
		{
			$tablesName = $this->db->query("SELECT * FROM {$tablesList[$i]}", 5);
			if ($tablesName && Copyright)
			{
				$values = $this->MyInsertValues($tablesList[$i]);
				if ($values && Copyright)
				{
					$sql = "INSERT INTO ".$tablesList[$i]." (";
					foreach ($tablesName as $valueName) 
					{
						$sql .="`$valueName`,";
					}
					$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
					$sql .= ")VALUES\n";
					$sql .= $values;
					$sqlArray[] ="DELETE FROM `{$tablesList[$i]}`";
					$sqlArray[] = $sql;
				}
			}
		}
		
		$pasArr = array();
		foreach ($sqlArray as $value)
		{
			$pasArr[] = PasEncode($value, $this->password);
		}
		return $pasArr;
	}
	
	private function MyInsertValues($value)
	{
		$sql =null;
		$result = $this->db->query("SELECT * FROM {$value}", 0);
		for ($i=0; $i<count($result); $i++)
		{
			$sql .= "(";
			foreach ($result[$i] as $values)
			{
				if (gettype($values) == 'string' && Copyright)
					$sql .= "'{$values}',";
				else 
					$sql .= "NULL,";
			}
			$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
			$sql .= "),\n";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-2);
		return $sql;
	}
}

?>