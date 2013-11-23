<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'function/Crystals.php';
$db = new DB();
$UserModel = new UserModel();
global $Users;

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	//報錶類型 1交收報錶  0分類報錶 暫時無法合併
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
	
	$tt = $_GET['t'];
	$page = null;
	$CentetArr = array();
	$CentetArr['userList']['s_name'] = $_GET['s_name'];
	$CentetArr['userList']['s_types'] = $_GET['s_types']; //彩票種類
	$CentetArr['userList']['s_type'] = $_GET['s_type']; //下註類型  第一球
	$CentetArr['userList']['s_t_N'] = $_GET['t_N']; //期數查詢或日期查詢
	$CentetArr['userList']['s_number'] = $_GET['s_number']; //期數查詢
	$CentetArr['userList']['startDate'] = $_GET['startDate']; //日期查詢
	$CentetArr['userList']['endDate'] = $_GET['endDate']; //日期查詢
	$CentetArr['userList']['s_Report'] = $_GET['ReportType']; //報錶類型    a交收報錶  b分類報錶
	$CentetArr['userList']['s_Balance'] = $_GET['Balance']; //結算狀態
	
	
	if ($_GET['ReportType']==1) 
	{
	if ($tt==2){
		$result = $db->query("SELECT `g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, `g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_Immediate2_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`, `g_out`, `g_count_time` FROM `g_rank` WHERE g_name = '{$CentetArr['userList']['s_name']}' LIMIT 1", 1);
	} else {
		$result = $db->query("SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` WHERE g_name = '{$CentetArr['userList']['s_name']}' LIMIT 1", 1);
	}
	if ($result){
		$CentetArr['userList']['s_nid'] = $result[0]['g_nid'];
		$CentetArr['userList']['s_name'] = $result[0]['g_name'];
		$a = $UserModel->GetLoginIdByString($result[0]['g_login_id']);
		$CentetArr['userList']['s_rank'] = $a[0];
		$CentetArr['userList']['g_login_id'] = $result[0]['g_login_id'];
		$CentetArr['userList']['g_panlu'] = $result[0]['g_panlu'];
		$pageNum = 20;
		if ($tt==1) 
		{
			$total = GetCrystals($db, $CentetArr['userList'], $result[0], false, 1);
			$page = new Page($total, $pageNum);
			$c = GetCrystals($db, $CentetArr['userList'], $result[0], false, 0, $page->limit);
			if ($c != null) {
				$a= $UserModel->GetLoginIdByString($result[0]['g_login_id']);
				$result[0]['s_rank'] = $a[0];
				$result[0]['cry'] = $c;
				$CentetArr['cryList'][] = $result[0];
			}
		} 
		else 
		{
			if ($CentetArr['userList']['g_login_id'] != 56 && $CentetArr['userList']['g_login_id'] != 89){
				$total = GetCrystals($db, $CentetArr['userList'], $result[0], true, 1);
				$page = new Page($total, $pageNum);
				$UserInfo = GetCrystals($db, $CentetArr['userList'], $result[0], true, 0, $page->limit);
				$result[0]['cry'] =$UserInfo;
				$CentetArr['cryList'][] = $result[0];
			}
		}
	}
	}
	else{
	$result=$Users;
	if ($result){
		$CentetArr['userList']['s_nid'] = $result[0]['g_nid'];
		$CentetArr['userList']['s_name'] = $result[0]['g_name'];
		$a = $UserModel->GetLoginIdByString($result[0]['g_login_id']);
		$CentetArr['userList']['s_rank'] = $a[0];
		$CentetArr['userList']['g_login_id'] = $result[0]['g_login_id'];
		$CentetArr['userList']['g_panlu'] = $result[0]['g_panlu'];
		$pageNum = 20;
		if ($tt==1) 
		{
			$total = GetCrystalsfen($db, $CentetArr['userList'], $result[0], false, 1);
			$page = new Page($total, $pageNum);
			$c = GetCrystalsfen($db, $CentetArr['userList'], $result[0], false, 0, $page->limit);
			if ($c != null) {
				$a= $UserModel->GetLoginIdByString($result[0]['g_login_id']);
				$result[0]['s_rank'] = $a[0];
				$result[0]['cry'] = $c;
				$CentetArr['cryList'][] = $result[0];
			}
		} 
		else 
		{
			if ($CentetArr['userList']['g_login_id'] != 56 && $CentetArr['userList']['g_login_id'] != 89){
				$total = GetCrystalsfen($db, $CentetArr['userList'], $result[0], true, 1);
				$page = new Page($total, $pageNum);
				$UserInfo = GetCrystalsfen($db, $CentetArr['userList'], $result[0], true, 0, $page->limit);
				$result[0]['cry'] =$UserInfo;
				$CentetArr['cryList'][] = $result[0];
			}
		}
	}
	
	
	
	}
	
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<title>下注明細</title>
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
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;下注明細</td>
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
                            	<tr class="tr_top">
                                	<td width="170">注單號碼/時間</td>
                                    <td width="130">下注類型</td>
                                    <td>帳號</td>
                                    <td>下注明細</td>
                                    <td>會員下注</td>
                                    <td>會員輸贏</td>
                                    <td>代理占成</td>
                                    <td>總代理占成</td>
                                    <?php if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] == 56 || $Users[0]['g_login_id'] == 22|| $Users[0]['g_login_id'] == 78) {?>
                                    <td>股東占成</td>
                                    <?php } if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] == 56 || $Users[0]['g_login_id'] == 22) {?>
                                    <td>分公司占成</td>
									<td>总公司占成</td>
                                    <?php }?>
                                    <td><b>您的結果</b></td>
                                </tr>
                                <?php for ($i=0; $i<count($CentetArr['cryList'][0]['cry']); $i++) {?>
                                <?php 
								if ($_GET['ReportType']==0){ 
								//alert($CentetArr['cryList'][0]['cry'][$i]['g_nid']);
								if ($tt==2){
									$result = $db->query("SELECT `g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, `g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_Immediate2_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`, `g_out`, `g_count_time` FROM `g_rank` WHERE g_name = '{$CentetArr['cryList'][0]['cry'][$i]['g_nid']}' LIMIT 1", 1);
								} else {
									$result = $db->query("SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` WHERE g_name = '{$CentetArr['cryList'][0]['cry'][$i]['g_nid']}' LIMIT 1", 1);
								}
								if($result){
								$CentetArr['userList']['g_panlu'] = $result[0]['g_panlu'];
								$CentetArr['cryList'][0]['g_login_id']=$result[0]['g_login_id'];
								}
								}
								
								
                                if ($CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1_str'] == null) {
                                	if ($CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1'] == '總和、龍虎' || $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1'] == '總和、龍虎和'){
                                		$n = $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_2'];
                                	}else {
                                		$n = $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1'].'『'.$CentetArr['cryList'][0]['cry'][$i]['g_mingxi_2'].'』';
                                	}
						        	//$n = $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1'] == '總和、龍虎' ? $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_2'] : $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1'].'『'.$CentetArr['cryList'][0]['cry'][$i]['g_mingxi_2'].'』';
						        	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$CentetArr['cryList'][0]['cry'][$i]['g_odds'].'</b></font>';
						        	$SumNum = $CentetArr['cryList'][0]['cry'][$i]['g_jiner'];
					        	}else {
						        	$_xMoney = $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1_str'] * $CentetArr['cryList'][0]['cry'][$i]['g_jiner'];
						        	$SumNum = '<font color="#009933">'.$CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$CentetArr['cryList'][0]['cry'][$i]['g_jiner'].'</font><br />'.$_xMoney;
						        	$html = '<font color="#0066FF">'.$CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$CentetArr['cryList'][0]['cry'][$i]['g_odds'].'</b></font><br />'.
						        				'<span style="line-height:23px">復式  『 '.$CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$CentetArr['cryList'][0]['cry'][$i]['g_mingxi_2'].'</span>';
						        }
						        
						        if ($CentetArr['cryList'][0]['cry'][$i]['g_mumber_type'] == 2 && $CentetArr['cryList'][0]['g_login_id'] ==48){
                                    	$z = $t = 0;
                                    	$t1 = $CentetArr['cryList'][0]['cry'][$i]['g_tueishui'];
                                    	$t2 = $CentetArr['cryList'][0]['cry'][$i]['g_tueishui_2'];
                                    } else if ($CentetArr['cryList'][0]['cry'][$i]['g_mumber_type'] == 2 && $CentetArr['cryList'][0]['g_login_id'] ==78) {
                                    	$t2 = $CentetArr['cryList'][0]['cry'][$i]['g_tueishui'];
                                    	$z = $t = $t1 = 0;
                                    } else {
                                    	$z =$CentetArr['cryList'][0]['cry'][$i]['g_distribution'];
                                    	$t =$CentetArr['cryList'][0]['cry'][$i]['g_tueishui'];
                                    	$t1=$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_1'];
                                    	$t2 = $CentetArr['cryList'][0]['cry'][$i]['g_tueishui_2'];
                                    }
                                    if ($tt == 2){
                                    	$t=0;
                                    }
                                    
                                    $zc2 = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_2'];
                                    $zc1 = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_1'];
                                    
                               		 if ($CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1_str'] != null){
											$je = $CentetArr['cryList'][0]['cry'][$i]['g_mingxi_1_str']*$CentetArr['cryList'][0]['cry'][$i]['g_jiner'];
										} else {
											$je = $CentetArr['cryList'][0]['cry'][$i]['g_jiner'];
										}
										$sy = $CentetArr['cryList'][0]['cry'][$i]['g_win'];
                                    	if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] == 56){if($Users[0]['g_login_id'] == 89){
										if ($CentetArr['cryList'][0]['cry'][$i]['g_mumber_type'] == 2 && $CentetArr['cryList'][0]['g_login_id'] ==22){
											
												$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_4'] / 100;
	                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
	                                    		$win =$sy*$zc;
	                                    		$TuiShui =$ts*$zc;
											}else{
                                    		$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_4'] / 100;
                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
											$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_4']) /100)*$je;
                                    		$win =($sy-$ts+$ts3 )*$zc;
                                    		$TuiShui =$ts3*$zc;
											}
										}else{
											if ($CentetArr['cryList'][0]['cry'][$i]['g_mumber_type'] == 2 && $CentetArr['cryList'][0]['g_login_id'] ==22){
											
												$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_3'] / 100;
	                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
	                                    		$win =$sy*$zc;
	                                    		$TuiShui =$ts*$zc;
											}else{
                                    		$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_3'] / 100;
                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
											$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_3']) /100)*$je;
                                    		$win =($sy-$ts+$ts3 )*$zc;
                                    		$TuiShui =$ts3*$zc;
											}
											}
                                    	} else if ($Users[0]['g_login_id'] == 22){
                                    		if ($CentetArr['cryList'][0]['cry'][$i]['g_mumber_type'] == 2 && $CentetArr['cryList'][0]['g_login_id'] ==78) {
                                    			$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_2'] / 100;
	                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
	                                    		$win =$sy*$zc;
	                                    		$TuiShui =$ts*$zc;
                                    		} else {
                                    			$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_2'] / 100;
	                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
	                                    		if ($CentetArr['cryList'][0]['cry'][$i]['g_tueishui_2'] >0){
													$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_2']) /100)*$je;
	                                    		} else {
	                                    			$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_3']) /100)*$je;
	                                    		}
	                                    		if ($zc >0){
	                                    			$win =($sy-$ts +$ts3)*$zc;
	                                    			$TuiShui =$ts3*$zc;
												}
	                                    		else {
	                                    			$win =($sy);
	                                    			$TuiShui =$ts3;
	                                    		}
                                    		}
                                    		
                                    	} else if ($Users[0]['g_login_id'] == 78){
                                    		if ($CentetArr['cryList'][0]['cry'][$i]['g_mumber_type'] == 2 && $CentetArr['cryList'][0]['g_login_id'] ==48)
                                    		{
                                    			$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_1'] / 100;
	                                    		$ts = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100)*$je; 
												//$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_2']) /100)*$je;
                                    			$win =$sy*$zc;
                                    			$TuiShui =$ts*$zc;
                                    			$zc2 = 100-$CentetArr['cryList'][0]['cry'][$i]['g_distribution_1'];
                                    		}
                                    		else 
                                    		{
	                                    		$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution_1'] / 100;
	                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
												//$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_1']) /100)*$je;
                                    			if ($CentetArr['cryList'][0]['cry'][$i]['g_tueishui_1'] >0){
                                    				$zc2 = 100-($CentetArr['cryList'][0]['cry'][$i]['g_distribution_1']+$CentetArr['cryList'][0]['cry'][$i]['g_distribution']);
													$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_1']) /100)*$je;
	                                    		} else {
	                                    			$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui_2']) /100)*$je;
	                                    			$zc2 = 100;
	                                    		}
	                                    		if ($zc >0){
	                                    			$win =($sy+$ts -$ts3)*$zc;
	                                    			$TuiShui =$ts3*$zc;
												}
	                                    		else {
	                                    			$win =$sy;
	                                    			$TuiShui =$ts3;
	                                    		}
                                    		}
                                    	} else {
                                    		$zc = $CentetArr['cryList'][0]['cry'][$i]['g_distribution'] / 100;
                                    		$zc1 = 100 - $CentetArr['cryList'][0]['cry'][$i]['g_distribution'];
                                    		$ts = (100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100*$je; 
											//$ts3 = ((100-$CentetArr['cryList'][0]['cry'][$i]['g_tueishui']) /100)*$je;
											if ($zc >0){
                                    			$win =$sy*$zc;
                                    			$TuiShui =$ts*$zc;
											}
                                    		else {
                                    			$win =$sy;
                                    			$TuiShui =$ts;
                                    		}
                                    	}
                                    	
                                    	$TuiShui = $win == 0 ? 0 : $TuiShui;
                                    
                                    	$wins = $CentetArr['cryList'][0]['cry'][$i]['g_win'] == null ? '<font color="#0066FF">未結算</font>' : $CentetArr['cryList'][0]['cry'][$i]['g_win'];
                                
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_id']?>#<br /><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_date'].' '.GetWeekDay($CentetArr['cryList'][0]['cry'][$i]['g_date'], 0)?></td>
                                    <td><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_type']?><br /><font color="#009933"><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_qishu']?>期</font></td>
                                    <td>
                                    <?php if ($tt == 2){?>
                                    <b><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_nid']?></b>
                                    <?php } else {?>
                                    <?php echo$CentetArr['cryList'][0]['cry'][$i]['g_nid']?><br />
                                    <?php echo$CentetArr['userList']['g_panlu']?>盤
                                    <?php }?>
                                    </td>
                                    <td><?php echo$html?></td>
                                    <td><?php echo$SumNum?></td>
                                    <td><?php echo is_Number($wins)?></td>
                                    <td><b><?php echo$z?></b>%<br /><?php echo $t?></td>
                                    <td><b><?php echo$zc1?></b>%<br /><?php echo $t1?></td>
                                    <?php if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] == 56 || $Users[0]['g_login_id'] == 22|| $Users[0]['g_login_id'] == 78) {?>
                                    <td><b><?php echo$zc2?></b>%<br /><?php echo $t2?></td>
                                    <?php } if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] == 56 || $Users[0]['g_login_id'] == 22) {?>
                                    <td><b><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_distribution_3']?></b>%<br /><?php echo $CentetArr['cryList'][0]['cry'][$i]['g_tueishui_3']?></td>
									 <td><b><?php echo$CentetArr['cryList'][0]['cry'][$i]['g_distribution_4']?></b>%<br /><?php echo $CentetArr['cryList'][0]['cry'][$i]['g_tueishui_4']?></td>
                                    <?php }?>
                                    <td align="right">
									<?php echo is_Number($win,2).'&nbsp;&nbsp;<br />'.is_Number($TuiShui,2); ?>
									&nbsp;</td>
                                </tr>
                                <?php }?>
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
</body>
</html>