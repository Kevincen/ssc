<?php
define('Copyright', '作者QQ:1834219632');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Manage/config/global.php';
	session_start();
	$mid = $_POST['mid'];
	$db = new DB();
	if ($mid == 1)
	{
		if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2)
			$from = "g_history2";
		else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3)
			$from = "g_history3";
		else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6)
			$from = "g_history6";
		else 
			$from = "g_history";
		$sql = "SELECT g_qishu FROM `{$from}` ORDER BY g_qishu DESC limit 10";
		$result = $db->query($sql, 0);
		$result = json_encode($result);
		echo <<<JSON
				{
					"rows" : $result
				}
JSON;
	}
}
?>