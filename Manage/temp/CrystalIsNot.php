<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users;


if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	if (isset($_GET['pid']) && isset($_GET['tid']))
	{
		$pid = base64_decode($_GET['pid']);
		$tid = base64_decode($_GET['tid']);
		$cid = $_GET['cid'];
		if($cid=="7"){
			$cid="六合彩";
		}else if($cid=="1"){
			$cid="重慶時時彩";
		}else{
			$cid="廣東快樂十分";
		}
		$db = new DB();
		$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` 
		FROM g_zhudan WHERE g_s_nid LIKE '{$Users[0]['g_nid']}%' 
		AND g_type ='{$cid}' ";
		 
		if ($pid== 'wd')
			$pid = '尾大';
		else if ($pid == 'wx')
			$pid = '尾小';
		else if ($pid == 'zwd')
			$pid = '總和尾大';
		else if ($pid == 'zwx')
			$pid = '總和尾小';
		if ($tid == '連碼'){
			$sql .= "AND `g_mingxi_1` = '{$pid}' AND g_win is null ";
		} else {
			$sql .= "AND `g_mingxi_1` = '{$tid}' AND `g_mingxi_2` = '{$pid}' AND g_win is null ";
		}
		//exit($sql);
		$result = $db->query($sql, 1);
	
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<title>即時注單</title>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>

            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;&nbsp;即時注單</td>
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
                                    <?php if ($Users[0]['g_login_id']==89 || $Users[0]['g_login_id']==56 || $Users[0]['g_login_id']==22 ||$Users[0]['g_login_id']==78){?>
                                    <td>股東占成</td>
                                    <?php } if ($Users[0]['g_login_id']==89 || $Users[0]['g_login_id']==56 || $Users[0]['g_login_id']==22){?>
                                    <td>公司占成</td>
                                    <?php }?>
                                </tr>
                                <?php 
                                if ($result) {
                                	for ($i=0; $i<count($result); $i++){
                                		$zc2 = $result[$i]['g_distribution_2'];
                                		$zc1 = $result[$i]['g_distribution_1'];
                                		
                                		if ($Users[0]['g_login_id']==78){
                                			$zc2=100 - ($result[$i]['g_distribution']+$result[$i]['g_distribution_1']);
                                		} else if ($Users[0]['g_login_id']==48){
                                			$zc1 =100-$result[$i]['g_distribution'];
                                		}
                                		
                                		if ($result[$i]['g_mumber_type']==5){
                                			$ts = 0;
                                		} else {
                                			$ts = $result[$i]['g_tueishui'];
                                		}
                                		
                                		if ($result[$i]['g_mumber_type']==2){
                                			$nidLen = mb_strlen($result[$i]['g_s_nid'], 'utf-8');
                                			if ($nidLen == 96){ //股東直屬
                                				$ts = 0;
                                				$ts1 = $result[$i]['g_tueishui_1'];
                                				$ts2 = $result[$i]['g_tueishui'];
                                			} else if ($nidLen == 128){ //總代理直屬
                                				$ts = 0;
                                				$ts1 = $result[$i]['g_tueishui'];
                                				$ts2 = $result[$i]['g_tueishui_2'];
                                			}
                                		} else {
                                			if ($zc1==0){
                                				$ts1=0;
                                			} else {
                                				$ts1 = $result[$i]['g_tueishui_1'];
                                			}
                                			if ($zc2==0){
                                				$ts2=0;
                                			} else {
                                				$ts2 = $result[$i]['g_tueishui_2'];
                                			}
                                		}
                                		
                                		 if ($result[$i]['g_mingxi_1_str'] == null) {
                                		 	if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和'){
                                		 		$n =$result[$i]['g_mingxi_2'];
                                		 	}else {
                                		 		$n =$result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
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
                                		
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo $result[$i]['g_id']?>#<br /><?php echo $result[$i]['g_date']?></td>
                                    <td><b><?php echo $result[$i]['g_type']?></b><br /><span style="color:#28A651"><?php echo $result[$i]['g_qishu']?>期</span></td>
                                    <td><b><?php echo $result[$i]['g_nid']?></b></td>
                                    <td><?php echo$html?></td>
                                    <td><?php echo $SumNum?></td>
                                    <td style="color:#0000FF">『 未結算 』</td>
                                    <td><b><?php echo $result[$i]['g_distribution']?>%</b><br /><?php echo $ts?></td>
                                    <td><b><?php echo $zc1?>%</b><br /><?php echo $ts1?></td>
                                    <?php if ($Users[0]['g_login_id']==89 || $Users[0]['g_login_id']==56 || $Users[0]['g_login_id']==22 || $Users[0]['g_login_id']==78){?>
                                    <td><b><?php echo $zc2?>%</b><br /><?php echo $ts2?></td>
                                    <?php } if ($Users[0]['g_login_id']==89 || $Users[0]['g_login_id']==56 || $Users[0]['g_login_id']==22){?>
                                    <td><b><?php echo $result[$i]['g_distribution_3']?>%</b><br /><?php echo $result[$i]['g_tueishui_3']?></td>
                               		<?php }?>
                                </tr>
                                <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f"></td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            
        </tr>

    </table>
</body>
</html>