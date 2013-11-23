<?php 
define('Copyright', '作者QQ：1458858574，唯一聯繫電話：15108387926');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/config/global.php';
include_once ROOT_PATH.'Manage/config/config.php';

$db=new DB();
$userModel = new UserModel();
$RankList = $userModel->GetRankAll();
$MemberList = $userModel->GetMemberAll();

$pageNum = 50;
$rid = $_GET['rid'];
$r = $rid == 1 ? "g_win is not null" : "g_win is null";

$type=$_GET['type'];

if ($type == 2){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '重慶時時彩';
	$link = 'UpCrystalcq.php';
} else if ($type == 3){
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$p = '廣西快樂十分';
	$link = 'UpCrystalgx.php';
}else if($type == 4){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '江西時時彩';
	$link = 'UpCrystaljx.php';
}else if($type == 5){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '幸运农场';
	$link = 'UpCrystalnc.php';
}else if($type == 6){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '北京赛车PK10';
	$link = 'UpCrystalpk.php';
}else{
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$p = '廣東快樂十分';
	$link = 'UpCrystal.php';
}

if (isset($_GET['uid']) && isset($_GET['tid']) && isset($_GET['rid']))
{
	$uid = $_GET['uid'];
	$tid = $_GET['tid'];
	if ($tid == 1){
		$where = "g_qishu = '{$uid}'";
	} else if ($tid == 5) {
		$where = "g_nid = '{$uid}'";
	} else {
		$nams = $db->query("SELECT `g_nid` FROM `g_rank` WHERE `g_name` = '{$uid}' LIMIT 1", 0);
		$where = "g_s_nid LIKE '{$nams[0][0]}%'";
	}
	
	$sql = "SELECT * FROM g_zhudan WHERE {$where} AND {$r} AND g_type = '{$p}' ORDER BY g_id DESC ";
	$total = $db->query($sql, 3);
	$page = new Page($total, $pageNum);
	$result = $db->query($sql, 1);
}
else if (isset($_GET['Find']) && isset($_GET['searchName']))
{
	if (mb_strlen($_GET['searchName'])>15 || empty($_GET['searchName'])) exit(back('輸入查詢條件錯誤！'));
	if (empty($_GET['Find'])) exit(back('請選擇條件。'));
	$searchName = $_GET['searchName'];
	switch ($_GET['Find']) 
	{
		case 1: $str = " g_id = '{$searchName}' "; break;//注單號碼
		case 2: $str = " g_qishu = '{$searchName}' "; break;//下注期數
		case 3: $str = " g_nid = '{$searchName}' "; break;//會員帳號
		case 4: $str = " g_jiner > '{$searchName}' "; break;//金額大於
		case 5: $str = " g_jiner < '{$searchName}' "; break;//金額小於
		default:$str = null;
	}
	$select = "SELECT * FROM g_zhudan";
	$total = $db->query($select." WHERE ".$str." AND {$r} AND g_type = '{$p}'", 3);
	$page = new Page($total, $pageNum);
	$result = $db->query($select." WHERE ".$str." AND {$r} AND g_type = '{$p}' ORDER BY g_qishu DESC {$page->limit} ", 1);
}
else 
{
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$total = $db->query("SELECT `g_id` FROM `g_zhudan` WHERE {$date} AND g_type = '{$p}' AND g_win is not null ", 3);
	$page = new Page($total, $pageNum);
	$sql = "SELECT * FROM g_zhudan WHERE {$date} AND g_type = '{$p}' AND g_win is not null ORDER BY g_id DESC {$page->limit} ";
	$result = $db->query($sql, 1);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="crystalInfo.js"></script>
<title></title>
<script>
function setauto(zdid,title)
	{
	
		$.ajax({
			type : "POST",
			data : {zid : zdid,type:title},
			url : "/Manage/temp/autowin.php",
			dataType : "json",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						setauto();
						return false;
					}
				}
			},
			success:function(data){
				if(data==1){
				$("#"+zdid).html("还原");
				$("#"+zdid).attr("title","no");
				}else{
				 $("#"+zdid).html("必中");
				 $("#"+zdid).attr("title","yes");
				}
			}
		});
	}
</script>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
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
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="10%">&nbsp;注單管理</td>
                                    <td width="45" align="right">期數：</td>
                                    <td width="40">
                                    	<select id="numbers" onchange="FromSubmit(this,'1','1','<?php echo $type?>')">
	                                    	<option value="0" selected="selected">-----請選擇-----</option>
                                        </select>
                                	</td>
                                    <td width="45" align="right">股東：</td>
                                    <td width="40">
                                    	<select id="rank1" onchange="FromSubmit(this,'1','2','<?php echo $type?>')">
	                                    	<option value="0" selected="selected">----請選擇----</option>
	                                    	<?php if ($RankList[0]){ for ($i=0; $i<count($RankList[0]); $i++){
	                                    			echo '<option value="'.$RankList[0][$i].'">'.$RankList[0][$i].'</option>';
	                                    		}}?>
                                        </select>
                                	</td>
                                	<td width="55" align="right">總代理：</td>
                                    <td width="40">
                                    	<select id="rank2" onchange="FromSubmit(this,'1','3','<?php echo $type?>')">
	                                    	<option value="0" selected="selected">----請選擇----</option>
	                                        <?php if ($RankList[1]){ for ($i=0; $i<count($RankList[1]); $i++){
	                                    			echo '<option value="'.$RankList[1][$i].'">'.$RankList[1][$i].'</option>';
	                                    		}}?>
                                        </select>
                                	</td>
                                	<td width="45" align="right">代理：</td>
                                    <td width="40">
                                    	<select id="rank3" onchange="FromSubmit(this,'1','4','<?php echo $type?>')">
	                                    	<option value="0" selected="selected">----請選擇----</option>
	                                        <?php if ($RankList[2]){ for ($i=0; $i<count($RankList[2]); $i++){
	                                    			echo '<option value="'.$RankList[2][$i].'">'.$RankList[2][$i].'</option>';
	                                    		}}?>
                                        </select>
                                	</td>
                                    <td width="45" align="right">會員：</td>
                                    <td width="40">
                                    	<select id="member" onchange="FromSubmit(this,'1','5','<?php echo $type?>')">
	                                    	<option value="0" selected="selected">----請選擇----</option>
	                                       <?php if ($MemberList){ for ($i=0; $i<count($MemberList); $i++){
	                                       		echo '<option value="'.$MemberList[$i][0].'">'.$MemberList[$i][0].'</option>';
	                                       	}}?>
                                        </select>
                                	</td>
                                	<td width="120" align="right">
                                	已結算<input type="radio" name="re" checked="checked" id="rs" style="position:relative;top:1px" value="1" />&nbsp;
                                	未結算<input type="radio" name="re"  id="rs" style="position:relative;top:1px" value="0" />
                                	</td>
                                    <td width="65" align="right">查詢：</td>
                                    <td>
                                        <select id="FindType">
                                        <option value="">---選擇條件---</option>
                                        <option value="1">注單號碼：</option>
                                        <option value="2">下注期數：</option>
                                        <option value="3">會員帳號：</option>
                                        <option value="4">金額大於：</option>
                                        <option value="5">金額小於：</option>
                                        </select>
                                        <input type="text"  maxlength="30" id="searchName" class="textb" />&nbsp;
                                        <input name="Find_VN" type="button" class="inputa" onclick="FromSubmit('FindType','2', '','<?php echo $type?>')" value="查找" />
                                    </td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr style="height:30px">
                            		<td colspan="7">&nbsp;&nbsp;批量刪除：
	                            		<select id="startNumber">
		                                    	<option value="0" selected="selected">----開始期數----</option>
	                                     </select>
	                                        ---
	                                        <select id="endNumber">
		                                    	<option value="0" selected="selected">----結束期數----</option>
	                                        </select>
	                                        &nbsp;&nbsp;
	                                        <input type="button" class="inputa" value="刪除" onclick="delAll()" /> 
	                                        &nbsp;&nbsp; &nbsp;&nbsp;
                            		<a href="CrystalInfo.php?type=1">广东快乐十分</a>&nbsp;|&nbsp;<a href="CrystalInfo.php?type=2">重庆时时彩</a>&nbsp;|&nbsp;<a href="CrystalInfo.php?type=6">pk10</a></td>
                            	</tr>
                            	<tr class="tr_top">
                                	<td width="180">注單號碼/時間</td>
                                    <td width="120">下注類型</td>
                                    <td width="80">帳號</td>
                                    <td>下注明細</td>
                                    <td>會員下注</td>
                                    <td>輸贏結果</td>
                                    <td width="130">基本操作</td>
                                </tr>
                                <?php if (!$result){echo'<tr><td align="center" colspan="8">暫無記錄</td></tr>';}else{
                                for ($i=0; $i<count($result); $i++){
                               			if ($result[$i]['g_mingxi_1_str'] == null) {
                               				if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和'){
                               					$n = $result[$i]['g_mingxi_2'];
                               				} else {
                               					$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
                               				}
                                		 	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
                                		 	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font>';
                                		 	$SumNum = $result[$i]['g_jiner'];
                                		 } else {
                                		 	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
                                		 	$SumNum = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
											$html = '<font color="#0066FF">'.$result[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font><br />'.
						        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
                                		 }
                                $win = $result[$i]['g_win'] != null ? $result[$i]['g_win'] : '<span style="color:#0000FF">『 未結算 』</span>';
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo$result[$i]['g_id']?>#<br /><?php echo$result[$i]['g_date'].'&nbsp;'.GetWeekDay($result[$i]['g_date'],1)?></td>
                                    <td><?php echo$result[$i]['g_type']?><br /><font color="#009933"><?php echo$result[$i]['g_qishu']?>期</font></td>
                                    <td><?php echo$result[$i]['g_nid']?></td>
                                    <td><?php echo$html?></td>
                                    <td><?php echo $SumNum?></td>
                                    <td><?php echo$win?></td>
                                    <td>
                                    	<table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="15"><img src="/Manage/temp/images/onlie.gif"/></td>
                                                    <td class="nones" width="30"><a id='<?php echo $result[$i]['g_id']?>' title="<?php echo $result[$i]['g_awin']==1? 'no':'yes'?>" href="javascript:void(0)" onclick="setauto(<?php echo $result[$i]['g_id']?>,this.title)"><?php echo $result[$i]['g_awin']==1? '还原':'必中'?></a></td>
                                                    <td class="nones" width="15"><img src="/Manage/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="<?php echo $link?>?uid=<?php echo$result[$i]['g_id']?>">修改</a></td>
                                                    <td class="nones" width="16"><img src="/Manage/temp/images/del.gif" /></td>
                                                    <td class="nones" width="30"><a href="javascript:void(0)" onclick="delCrystal(this,'<?php echo$result[$i]['g_id']?>')">刪除</a></td>
                                              </tr>
                                        </table>
									</td>
                                </tr>
                                <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            <td width="6" bgcolor="#1873aa"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_59.gif" alt="" /></td>
            <td bgcolor="#1873aa"></td>
            <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_62.gif" alt="" /></td>
        </tr>
    </table>
<div id="oddsPops" style="position:absolute;width:340px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th colspan="2" id="typeids">單號&nbsp;4550024#</th>
    </tr>
    <tr class="text">
        <td>&nbsp;是否返回下注金額：<input style="position:relative; top:3px" type="checkbox" id="ros" /></td>
    </tr>
    <tr class="text">
        <td class="odds">&nbsp;警告：如果開啟金額還原，系統將在凌晨2點后自動還原金額。<br />&nbsp;此時刪除注單請勿選擇【金額還原】</td>
    </tr>
    <tr class="texts">
        <td align="center" height="60" colspan="2">
            <input type="button" class="inputa" onclick="GoDel()" value="確認" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="inputa" onclick="closesPop()" value="取消" />
      	</td>
    </tr>
</table>
</div>
</body>
</html>