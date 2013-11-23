<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'function/Crystals.php';
include_once ROOT_PATH.'Manage/config/config.php';
if ($ConfigModel['g_cry_select_lock'] !=1)exit(back('抱歉！報表數據暫時維護，無法查詢。'));
 if (isset($Users[0]['g_lock_5']) && $Users[0]['g_lock_5'] != 1){
 	exit(back('權限不足，無法查詢。'));
 }
$db = new DB();
$UserModel = new UserModel();
global $Users;

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	//報表類型 1交收報表  0分類報表 暫時無法合併
	if ($_GET['ReportType']==0) 
	{
		//exit(back('系統數據庫升級，分類報表暫時無法查詢！'));
	}
	if (!isset($_GET['s_type']))
	{
		if (!Matchs::isNumber($_GET['s_type'])) exit('s_type');
	}
	if (!isset($_GET['s_number']))
	{
		if (!Matchs::isNumber($_GET['s_number'])) exit('s_number');
	}
	if (!Matchs::isNumber($_GET['t_N'])) exit('t_N');
	if (!Matchs::isNumber($_GET['ReportType'])) exit('ReportType');
	if (!Matchs::isNumber($_GET['Balance'])) exit('Balance');
	
	$CentetArr = array();
	$CentetArr['userList']['s_name'] = isset($_GET['s_name']) ? $_GET['s_name'] : null;
	$CentetArr['userList']['s_types'] = $_GET['s_types']; //彩票種類
	$CentetArr['userList']['s_type'] = $_GET['s_type']; //下註類型  第壹球
	$CentetArr['userList']['s_t_N'] = $_GET['t_N']; //期數查詢或日期查詢
	$CentetArr['userList']['s_number'] = $_GET['s_number']; //期數查詢
	$CentetArr['userList']['startDate'] = $_GET['startDate']; //日期查詢
	$CentetArr['userList']['endDate'] = $_GET['endDate']; //日期查詢
	$CentetArr['userList']['s_Report'] = $_GET['ReportType']; //報表類型    a交收報表  b分類報表
	$CentetArr['userList']['s_Balance'] = $_GET['Balance']; //結算狀態
	$show = $CentetArr['userList']['s_t_N'] == 0 ? '按期數查詢：'.$CentetArr['userList']['s_number'] :
	'按日期查詢：'.$CentetArr['userList']['startDate'].' -- '.$CentetArr['userList']['endDate'];
	$show1 = $CentetArr['userList']['s_t_N'] == 0 ? '按期數：'.$CentetArr['userList']['s_number'] :
	'按日期：'.$CentetArr['userList']['startDate'].' -- '.$CentetArr['userList']['endDate'];
	$param = false;
	if ($CentetArr['userList']['s_name'] == null)
	{
		if ($Users[0]['g_login_id']==89)
		{
			//$loginid=$Users[0]['g_nid'].UserModel::Like();
		//	$result = $db->query("SELECT `g_nid`,`g_login_id`, `g_name` FROM `g_rank` WHERE g_nid like '{$loginid}'", 1);
			$CentetArr['userList']['s_name'] = "莊家";
			$CentetArr['userList']['g_login_id'] = 89;
			$CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][1];
			$s_rank = $Users[0]['g_Lnid'][2];
			$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'].UserModel::Like();	
		}
		else 
		{
			$CentetArr['userList']['s_name'] = $Users[0]['g_name'];
			if ($Users[0]['g_login_id'] == 48){
				$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'];
				$param = true;
			}
			else {
				$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'].UserModel::Like();
			}
			$CentetArr['userList']['g_login_id'] = $Users[0]['g_login_id'];
			$CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][0];
			$s_rank = $Users[0]['g_Lnid'][1];
		}
	} 
	else 
	{
		$result = ResultNid ($db, $CentetArr['userList']['s_name']);
		if ($result[0]['g_login_id'] == 48) {
			$CentetArr['userList']['s_nid'] = $result[0]['g_nid'];
			$param = true;
		} else {
			$CentetArr['userList']['s_nid'] = $result[0]['g_nid'].UserModel::Like();
		}
		$CentetArr['userList']['s_name'] = $result[0]['g_name'];
		$a = $UserModel->GetLoginIdByString($result[0]['g_login_id']);
		$CentetArr['userList']['s_rank'] = $a[0];
		$CentetArr['userList']['g_login_id'] = $result[0]['g_login_id'];
	}

	if ($_GET['ReportType']==1) 
	{
		
	//查詢當前用護的所有下級帳號
	$result = ResultNid ($db, $CentetArr['userList']['s_nid'], true, $param);
	for ($i=0; $i<count($result); $i++) {	
		$c = GetCrystals($db, $CentetArr['userList'], $result[$i]);
		if ($c != null) {
			if ($CentetArr['userList']['g_login_id']==48){
				$a= $UserModel->GetLoginIdByString($result[$i]['g_login_id']);
				$a = $a[0];
			} else {
				$a= $UserModel->GetLoginIdByString($CentetArr['userList']['g_login_id']);
				$a = $a[1];
			}
			$result[$i]['s_rank'] = $a;
			$result[$i]['cry'] = $c;
			$CentetArr['cryList'][] = $result[$i];
		}
	}
	if ($CentetArr['userList']['g_login_id'] != 56 && $CentetArr['userList']['g_login_id'] != 89){
		if ($CentetArr['userList']['g_login_id'] != 48){
			$nid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid'])-32);
		} else {
			$nid = $CentetArr['userList']['s_nid'];
		}
		$s['g_nid'] = $nid;
		$UserInfo = GetCrystals($db, $CentetArr['userList'], $s, true);
		$CentetArr['userInfo'] = $UserInfo;
	}
	$CentetArr = SumCrystals ($CentetArr);
	
	}
	else{
		/////分類報表
		$first=1;$end=77;
		if($CentetArr['userList']['s_types']==1){
		$first=1;$end=27;
		}
		if($CentetArr['userList']['s_types']==2){
		$first=26;$end=40;
		}	
		if($CentetArr['userList']['s_types']==3){
		$first=39;$end=61;
		}		
		if($CentetArr['userList']['s_types']==6){
		$first=60;$end=77;
		}	
		if($CentetArr['userList']['s_types']==5){
		$first=775;$end=800;
		}
		if($CentetArr['userList']['s_types']==7){
		$first=78;$end=92;
		}
		if($CentetArr['userList']['s_types']==8){
		$first=828;$end=840;
		}
		if($CentetArr['userList']['s_types']==9){
		$first=902;$end=906;
		}
		//查詢當前用護的所有下級帳號
	$result = $Users;//ResultNid ($db, $CentetArr['userList']['s_nid'], true, $param);
	for ($i=0; $i<count($result); $i++) {	
	if($_GET['s_type']==""){
	for($f=$first;$f<$end;$f++){
	$CentetArr['userList']['s_type']=$f;
	$c = GetCrystalsfen($db, $CentetArr['userList'], $result[$i]);
	if ($c != null) {
			if ($CentetArr['userList']['g_login_id']==48){
				$a= $UserModel->GetLoginIdByString($result[$i]['g_login_id']);
				$a = $a[0];
			} else {
				$a= $UserModel->GetLoginIdByString($CentetArr['userList']['g_login_id']);
				$a = $a[1];
			}
			$result[$i]['s_rank'] = $a;
			$result[$i]['cry'] = $c;
			$CentetArr['cryList'][] = $result[$i];
		}
	}
	}else{
	
	
	$c = GetCrystalsfen($db, $CentetArr['userList'], $result[$i]);
		if ($c != null) {
			if ($CentetArr['userList']['g_login_id']==48){
				$a= $UserModel->GetLoginIdByString($result[$i]['g_login_id']);
				$a = $a[0];
			} else {
				$a= $UserModel->GetLoginIdByString($CentetArr['userList']['g_login_id']);
				$a = $a[1];
			}
			$result[$i]['s_rank'] = $a;
			$result[$i]['cry'] = $c;
			$CentetArr['cryList'][] = $result[$i];
		}
	}

	}
	if ($CentetArr['userList']['g_login_id'] != 56 && $CentetArr['userList']['g_login_id'] != 89){
		if ($CentetArr['userList']['g_login_id'] != 48){
			$nid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid'])-32);
		} else {
			$nid = $CentetArr['userList']['s_nid'];
		}
		$s['g_nid'] = $nid;
		$UserInfo = GetCrystalsfen($db, $CentetArr['userList'], $s, true);
		$CentetArr['userInfo'] = $UserInfo;
	}
	$CentetArr = SumCrystalsfen ($CentetArr);

	}
	
	
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
	function GoCrystals(str){
		var href;
		var sp = location.href.split("&");
		var s = sp[sp.length-1].split("=");
		if (s[0] == "s_name") {
			sp = sp.splice(0,sp.length-1);
		}
		sp.push("s_name=" + str);
		self.location = sp.join("&");
	}

	function GoCryPop(str, t){
		var href;
		var sp = location.href.split("?");
		var href = "/Manage/temp/Report_CryPop.php?"+sp[1]+"&s_name="+str+"&t="+t;
		window.open(href);
	}
	
	function GoCryPopfen(str, t,type){
		var href;
		var sp = location.href.split("?");
		sp[1]=sp[1].replace("&s_type=","");
		var href = "/Manage/temp/Report_CryPop.php?"+sp[1]+"&s_name="+str+"&t="+t+"&s_type="+type;
		window.open(href);
	}
-->
</script>
<title></title>
<script>
var folderUrl;
function BrowseFolder(){   
 try{   
  var Message = "請選擇文件夾";  //選擇框提示信息   
  var Shell = new ActiveXObject( "Shell.Application" );   
  var Folder = Shell.BrowseForFolder(0,Message,0x0040,0x11);//起始目錄爲：我的電腦   
  //var Folder = Shell.BrowseForFolder(0,Message,0); //起始目錄爲：桌面   
  if(Folder != null){   
    Folder = Folder.items();  // 返回 FolderItems 對象   
    Folder = Folder.item();  // 返回 Folderitem 對象   
    Folder = Folder.Path;   // 返回路徑   
    if(Folder.charAt(Folder.length-1) != "\\"){   
      Folder = Folder + "\\";   
    }   
    document.all.savePath.value=Folder;   
    return Folder;   
  }   
}catch(e){    
  alert(e.message);   
 }   
}  


function xlsput(xtype){

function getTableCell (obj){
//BrowseFolder();
var _arrCellOnes =[];
var _arrCellarrs =[];
var _oTBody = obj.TBodies ? obj.TBodies : obj;

var _oTRows = _oTBody.rows;

for(i=0;i<_oTRows.length;i++){
_arrCellOnes =[];
for(j=0;j<_oTRows.item(i).cells.length;j++){
if(_oTRows[i].cells[j]){

_arrCellOnes.push(_oTRows[i].cells[j].innerText);
}
}
_arrCellarrs.push(_arrCellOnes);
}

return _arrCellarrs;

}

var arrCells = getTableCell(document.getElementById("xlstr"));

excel(arrCells,xtype);
//alert(arrCells);

//alert(document.getElementById("xlstr").innerHTML);
}





function excel(dataArr,xtype)
	{	
		$.ajax({
			type : "POST",
			data : {dataArr : dataArr,xtype:xtype},
			url : "putxls.php",
			dataType : "json",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						excel(dataArr);
						return false;
					}
				}
			},
			success:function(data){
				if(data==1){
				alert('導出報表成功');
				}else{
				alert('導出報表失敗');
				}
			}
		});
	}
</script>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16055567.js"></script>
</div>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="16"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
							<?php		if ($_GET['ReportType']==1) { ?>
                                    <td width="291">&nbsp;<?php echo$CentetArr['userList']['s_rank'].'（'.$CentetArr['userList']['s_name'].'） - 交收報表'?></td>
									<?php }else {?>
									    <td width="291">&nbsp;<?php echo$CentetArr['userList']['s_rank'].'（'.$CentetArr['userList']['s_name'].'） - 分類報表'?></td>
									<?php }?>
                                    <td width="203"><?php echo$show?></td>
									<td width="14"><img src="images/44.gif"/></td>
                                    <td width="177"><a 
									<?php if($CentetArr['userList']['g_login_id'] ==56){?>href="SaveXls.php?type=1"  onclick="xlsput(1);" <?php }else {?>href="SaveXls.php?type=0"  onclick="xlsput(0);"<?php } ?>
									>導出XLS報表</a></td>
                                    <td width="13"><img src="images/fh.gif" /></td>
                                    <td width="36"><a href="javascript:history.go(-1);" class="font_r F_bold">返囬</a></td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
						 <table id='xlstr' border="0" cellspacing="0" class="conter">
						<?php if ($_GET['ReportType']==1) {?>
                            	<tr  class="tr_top">
                                	<td><?php echo$CentetArr['userList']['s_rank_1']?>直屬會員</td>
                                    <td>名稱</td>
                                    <td>筆數</td>
                                    <td><b>有效金額</b></td>
                                    <td>會員輸贏</td>
                                    <?php if($CentetArr['userList']['g_login_id'] ==89) {
									?>
									<td>實占成數</td>
                                    <td>股東應付</td>
                                    <td>應收分公司</td>
                                    <?php 	
									}else{?>
                                    <td>應收下綫</td>
                                    <?php }?>
                                    <?php if($CentetArr['userList']['g_login_id'] !=89) {?>
                                    <td width="70">實占成數</td>
                                    <td>實占註額</td>
                                    <td>實占輸贏</td>
                                    <td>實占退水</td>
                                    <td>實占結果</td>
                                    <td>賺取水錢</td>
                                    <td>賺水後結果</td>
                                    <td>貢獻上級</td>
                                    <td>應付上級</td>
                                    <?php }?>
                                </tr>
                                <?php if (isset($CentetArr['cryList'])) {
                                for ($i=0; $i<count($CentetArr['cryList']); $i++){?>
                                <tr style="height:26px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''" align="center">
                                	<td>
                                	<?php
                                	 $lid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid'])-32);
                                	 $xid = mb_substr($CentetArr['cryList'][$i]['cry'][0]['g_s_nid'], 0, mb_strlen($CentetArr['cryList'][$i]['cry'][0]['g_s_nid'])-32);
                                	?>
                                	<?php if (($CentetArr['cryList'][$i]['cry'][0]['g_mumber_type'] == 2 && $lid == $xid) || $CentetArr['cryList'][$i]['g_login_id']==9){ ?>
                                	<?php echo$CentetArr['cryList'][$i]['g_name']?>
                                	<?php } else {
									?>
                                	<a href="javascript:GoCrystals('<?php echo$CentetArr['cryList'][$i]['g_name']?>','1')"  class="tt"><?php echo$CentetArr['cryList'][$i]['g_name']?></a>
                                	<?php }?>
                                	</td>
                                	<td><?php echo$CentetArr['cryList'][$i]['g_f_name']?></td>
                                	<td><?php echo$CentetArr['cryList'][$i]['s_count']?></td>
                                    <td>
                                    <?php if(($CentetArr['cryList'][$i]['cry'][0]['g_mumber_type'] == 2 && $lid == $xid) || $CentetArr['cryList'][$i]['g_login_id']==9){?>
                                    	<a href="javascript:GoCryPop('<?php echo$CentetArr['cryList'][$i]['g_name']?>','1')" class="tt"><?php echo is_Number2($CentetArr['cryList'][$i]['s_countMoney'], 1)?></a>
                                    <?php } else{
                                    	echo is_Number2($CentetArr['cryList'][$i]['s_countMoney'], 1);
                                    }?>
                                    </td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberWin'], 1)?></td>
                                    <?php									
									if($CentetArr['userList']['g_login_id'] ==89) {
									?>
									<td><?php echo 	100-$CentetArr['cryList'][$i]['g_distribution']?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanWin'], 1)?></td>
                                    <?php 								
									}?>
                                    <td class="ll"><b><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberJieGuo'], 1)?></b></td>
									
                                    <?php if($CentetArr['userList']['g_login_id'] !=89) {?>
                                    <td><?php echo number_format($CentetArr['cryList'][$i]['s_distribution'], 2,".","")?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_ShiZhanZhiEr'], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanWin'], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanTuiShui'], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanTuiShuiWin'], 1)?></td>
                                    
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_WinSui'], 1)?></td>
                                    <td><b><?php echo is_Number2($CentetArr['cryList'][$i]['s_WinSuiJieGuo'], 1)?></b></td>
                                    <td class="bg_b"><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberWin_S'], 1)?></td>
                                    <td class="bg_b"><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberWin_Y'], 1)?></td>
                                    <?php }?>
                                </tr>
                                <?php }}
								}else{
								?>
								

                            	<tr  class="tr_top">
                                	<td>下注類型</td>                              
                                    <td>筆數</td>
                                    <td><b>有效金額</b></td>
                                    <td>會員輸贏</td>
                                    <?php if($CentetArr['userList']['g_login_id'] ==89) {
									?>
									<td>實占成數</td>
                                    <td>股東應付</td>
                                    <td>應收分公司</td>
                                    <?php 	
									}else{?>
                                    <td>應收下綫</td>
                                    <?php }?>
                                    <?php if($CentetArr['userList']['g_login_id'] !=89) {?>
                                    <td width="70">實占成數</td>
                                    <td>實占註額</td>
                                    <td>實占輸贏</td>
                                    <td>實占退水</td>
                                    <td>實占結果</td>
                                    <td>賺取水錢</td>
                                    <td>賺水後結果</td>
                                    <td>貢獻上級</td>
                                    <td>應付上級</td>
                                    <?php }?>
                                </tr>
                                <?php if (isset($CentetArr['cryList'])) {
                                for ($i=0; $i<count($CentetArr['cryList']); $i++){?>
                                <tr style="height:26px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''" align="center">
                                	<td>
                                	<?php
                                	 $lid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid'])-32);
                                	 $xid = mb_substr($CentetArr['cryList'][$i]['cry'][0]['g_s_nid'], 0, mb_strlen($CentetArr['cryList'][$i]['cry'][0]['g_s_nid'])-32);
									 
									 $typeStr=$CentetArr['cryList'][$i]['cry'][0]['g_type'].'--';
									switch($CentetArr['cryList'][$i]['cry'][0]['typeid']){
									case 1:$typeStr.='第壹球';break;
									case 2:$typeStr.='第二球';break;
									case 3:$typeStr.='第三球';break;
									case 4:$typeStr.='第四球';break;
									case 5:$typeStr.='第五球';break;
									case 6:$typeStr.='第六球';break;
									case 7:$typeStr.='第七球';break;
									case 8:$typeStr.='第八球';break;
									case 9:$typeStr.='1-8球大小';break;
									case 10:$typeStr.='1-8球單雙';break;
									case 11:$typeStr.='1-8球尾數大小';break;
									case 12:$typeStr.='1-8球尾數雙單';break;
									case 13:$typeStr.='1-8球方位';break;
									case 14:$typeStr.='1-8球中發白';break;
									case 15:$typeStr.='1-8球總和大小';break;
									case 16:$typeStr.='1-8球總和雙單';break;
									case 17:$typeStr.='1-8球總和尾數大小';break;
									case 18:$typeStr.='1-8球龍虎';break;
									case 19:$typeStr.='任選二';break;
									case 20:$typeStr.='選二連直';break;
									case 21:$typeStr.='選二連組';break;
									case 22:$typeStr.='任選三';break;
									case 23:$typeStr.='選三前直';break;
									case 24:$typeStr.='選三前組';break;
									case 25:$typeStr.='任選四';break;
									case 26:$typeStr.='任選五';break;
									case 27:$typeStr.='第壹球';break;
									case 28:$typeStr.='第二球';break;
									case 29:$typeStr.='第三球';break;
									case 30:$typeStr.='第四球';break;
									case 31:$typeStr.='第五球';break;
									case 32:$typeStr.='1-5球大小';break;
									case 33:$typeStr.='1-5球單雙';break;
									case 34:$typeStr.='1-5球總和大小';break;
									case 35:$typeStr.='1-5球總和雙單';break;
									case 36:$typeStr.='龍虎';break;
									case 37:$typeStr.='前三';break;
									case 38:$typeStr.='中三';break;
									case 39:$typeStr.='後三';break;
									
									case 40:$typeStr.='第壹球';break;
									case 41:$typeStr.='第二球';break;
									case 42:$typeStr.='第三球';break;
									case 43:$typeStr.='第四球';break;
									case 44:$typeStr.='特码';break;
									case 45:$typeStr.='1-5球大小';break;
									case 46:$typeStr.='1-5球單雙';break;
									case 47:$typeStr.='1-5球尾數大小';break;
									case 48:$typeStr.='1-5球尾數雙單';break;
									case 49:$typeStr.='1-5球神奇快乐';break;
									case 50:$typeStr.='1-5球红蓝绿';break;
									case 51:$typeStr.='1-5球總和大小';break;
									case 52:$typeStr.='1-5球總和雙單';break;
									case 53:$typeStr.='1-5球總和尾數大小';break;
									case 54:$typeStr.='1-5球龍虎';break;
									case 55:$typeStr.='一中一';break;
									case 56:$typeStr.='二中二';break;
									case 57:$typeStr.='三中二';break;
									case 58:$typeStr.='三中三';break;
									case 59:$typeStr.='四中三';break;
									case 60:$typeStr.='五中三';break;
									
									case 61:$typeStr.='冠军';break;
									case 62:$typeStr.='亚军';break;
									case 63:$typeStr.='第三名';break;
									case 64:$typeStr.='第四名';break;
									case 65:$typeStr.='第五名';break;
									case 66:$typeStr.='第六名';break;
									case 67:$typeStr.='第七名';break;
									case 68:$typeStr.='第八名';break;
									case 69:$typeStr.='第九名';break;
									case 70:$typeStr.='第十名';break;
									case 71:$typeStr.='1-10大小';break;
									case 72:$typeStr.='1-10單雙';break;
									case 73:$typeStr.='1-10龍虎';break;
									case 74:$typeStr.='冠、亞軍和';break;
									case 75:$typeStr.='冠亞和大小';break;
									case 76:$typeStr.='冠亞和單雙';break;
									
									case 774:$typeStr.='第壹球';break;
									case 775:$typeStr.='第二球';break;
									case 776:$typeStr.='第三球';break;
									case 777:$typeStr.='第四球';break;
									case 778:$typeStr.='第五球';break;
									case 779:$typeStr.='第六球';break;
									case 780:$typeStr.='第七球';break;
									case 781:$typeStr.='第八球';break;
									case 782:$typeStr.='1-8球大小';break;
									case 783:$typeStr.='1-8球單雙';break;
									case 784:$typeStr.='1-8球尾數大小';break;
									case 785:$typeStr.='1-8球尾數雙單';break;
									case 786:$typeStr.='1-8球梅兰菊竹';break;
									case 787:$typeStr.='1-8球中發白';break;
									case 788:$typeStr.='1-8球總和大小';break;
									case 789:$typeStr.='1-8球總和雙單';break;
									case 790:$typeStr.='1-8球總和尾數大小';break;
									case 791:$typeStr.='1-8球家禽野兽';break;
									case 792:$typeStr.='蔬菜单选';break;
									case 793:$typeStr.='动物单选';break;
									case 794:$typeStr.='幸运二';break;
									case 795:$typeStr.='连连中';break;
									case 796:$typeStr.='背靠背';break;
									case 797:$typeStr.='幸运三';break;
									case 798:$typeStr.='幸运四';break;
									case 799:$typeStr.='幸运五';break;
									}								
                                	?>
                                	<?php if (($CentetArr['cryList'][$i]['cry'][0]['g_mumber_type'] == 2 && $lid == $xid) || $CentetArr['cryList'][$i]['g_login_id']==9){ 				
									?>
                                	<?php echo$typeStr;?>
                                	<?php } else {									
									?>
                                	<?php echo$typeStr;?><?php }?></td>
                                	<td><a href="javascript:GoCryPopfen('<?php echo$typeStr?>','1','<?php echo$CentetArr['cryList'][$i]['cry'][0]['typeid']?>')"  class="tt"><?php echo$CentetArr['cryList'][$i]['s_count']?></a></td>
                                    <td>
                                    <?php if(($CentetArr['cryList'][$i]['cry'][0]['g_mumber_type'] == 2 && $lid == $xid) || $CentetArr['cryList'][$i]['g_login_id']==9){?>
                                    <?php echo is_Number2($CentetArr['cryList'][$i]['s_countMoney'], 1)?>
                                    <?php } else{
                                    	echo is_Number2($CentetArr['cryList'][$i]['s_countMoney'], 1);
                                    }?>
                                    </td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberWin'], 1)?></td>
                                    <?php									
									if($CentetArr['userList']['g_login_id'] ==89) {
									?>
									<td><?php echo 	$CentetArr['cryList'][$i]['s_distribution']?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanWin'], 1)?></td>
                                    <?php 								
									}?>
                                    <td class="ll"><b><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberJieGuo'], 1)?></b></td>
									
                                    <?php if($CentetArr['userList']['g_login_id'] !=89) {?>
                                    <td><?php echo number_format($CentetArr['cryList'][$i]['s_distribution'], 2,".","")?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_ShiZhanZhiEr'], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanWin'], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanTuiShui'], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_shizhanTuiShuiWin'], 1)?></td>
                                    
                                    <td><?php echo is_Number2($CentetArr['cryList'][$i]['s_WinSui'], 1)?></td>
                                    <td><b><?php echo is_Number2($CentetArr['cryList'][$i]['s_WinSuiJieGuo'], 1)?></b></td>
                                    <td class="bg_b"><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberWin_S'], 1)?></td>
                                    <td class="bg_b"><?php echo is_Number2($CentetArr['cryList'][$i]['s_memberWin_Y'], 1)?></td>
                                    <?php }?>
                                </tr>
                                <?php }}?>
								
								
								
								
								
								
								
								<?php }?>
                                <tr align="center" class="bg_a">
									<?php if ($_GET['ReportType']==1) { ?>
                                   <td align="center" width="20%"><?php echo$show1?></td>
									<?php }?>
									
                                	<td align="center">合計：</td>
                                	<td><?php echo$CentetArr['userList']['count_s'][0]?></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][1], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][2], 1)?></td>
                                    <?php if($CentetArr['userList']['g_login_id'] ==89) {?>
                                    <td>--</td>
									<td><?php echo is_Number2($CentetArr['userList']['count_s'][5], 1)?></td>
									<td><b><?php echo is_Number2($CentetArr['userList']['count_s'][3], 1)?></b></td>						
                                    <?php }?>
									<?php if($CentetArr['userList']['g_login_id'] !=89){?>
									<td><b><?php echo is_Number2($CentetArr['userList']['count_s'][3], 1)?></b></td>
								   <?php }?>
                                   <?php if($CentetArr['userList']['g_login_id'] !=89) {?>
                                    <td>--</td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][12], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][5], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][6], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][7], 1)?></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][8], 1)?></td>
                                    <td><b><?php echo is_Number2($CentetArr['userList']['count_s'][9], 1)?></b></td>
                                    <td><?php echo is_Number2($CentetArr['userList']['count_s'][10], 1)?></td>
                                    <td><b><?php echo is_Number2($CentetArr['userList']['count_s'][11], 1)?></b></td>
                                    <?php }?>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f yu">
                        <?php if($CentetArr['userList']['g_login_id'] !=89) {?>
                        占成結果：<font color="red"><?php echo is_Number2($CentetArr['userList']['count_s'][7], 1)?></font>&nbsp;&nbsp;/&nbsp;&nbsp;
                        	  賺取退水：<font color="#0000FF"><?php echo is_Number2($CentetArr['userList']['count_s'][8], 2)?></font>&nbsp;&nbsp;/&nbsp;&nbsp;
                        	  抵扣補貨及賺水後結果：<font color="red"><?php echo is_Number2(($CentetArr['userList']['count_s'][9]-$CentetArr['userList']['count_info']), 1)?></font>&nbsp;&nbsp;/&nbsp;&nbsp;
                        	  應付上級：<font color="#009933"><?php echo is_Number2(($CentetArr['userList']['count_s'][11]+$CentetArr['userList']['count_info']), 1)?></font>
                        	 <?php }?>
                        						    </td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
                <br />
                <?php 
                if (isset($CentetArr['userInfo'])){
                	$cc = array(0=>0,1=>0,2=>0,3=>0,4=>0);
			    	for ($i=0; $i<count($CentetArr['userInfo']); $i++){
			    		$ac = $CentetArr['userInfo'][$i]['g_mingxi_1_str'] ?  $CentetArr['userInfo'][$i]['g_jiner'] * $CentetArr['userInfo'][$i]['g_mingxi_1_str'] : $CentetArr['userInfo'][$i]['g_jiner'];
			    		$cc[0] +=$ac;
			    		if ($CentetArr['userInfo'][$i]['g_win'] !=0){
				    		$cc[1] += $CentetArr['userInfo'][$i]['g_win'] - (((100-$CentetArr['userInfo'][$i]['g_tueishui'])/100)*$ac);
				    		$cc[2] += (((100-$CentetArr['userInfo'][$i]['g_tueishui'])/100)*$CentetArr['userInfo'][$i]['g_jiner']);
				    		$cc[3] += $CentetArr['userInfo'][$i]['g_win'];
			    		}
			    		$cc[4] +=1;
			    	}
                ?>
                    <table border="0" cellspacing="0" class="con">
				    	<tr class="tr_top">
				    		<td>筆數</td>
				    		<td>補貨金額</td>
				    		<td>補貨輸贏</td>
				    		<td>退水</td>
				    		<td>退水後結果</td>
				    	</tr>
				    	<tr>
				    		<td><?php echo is_Number2($cc[4])?></td>
				    		<td><a style="font-size:104%" href="javascript:GoCryPop('<?php echo $CentetArr['userList']['s_name']?>','2')" class="tt"><?php echo is_Number2($cc[0])?></a></td>
				    		<td><?php echo is_Number2($cc[1])?></td>
				    		<td><?php echo is_Number2($cc[2])?></td>
				    		<td><?php echo is_Number2($cc[3])?></td>
				    	</tr>
				    </table>
				    <?php }?>
            </td>
            <td width="6" bgcolor="#1873aa"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_59.gif" alt="" /></td>
            <td bgcolor="#1873aa"></td>
            <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_62.gif" alt="" /></td>
        </tr>
    </table>
</body>
</html>