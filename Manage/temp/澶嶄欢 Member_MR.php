<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}

$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST['name'];
	$typeida = $_POST['typeida'];
	$typeidb = $_POST['typeidb'];
	$typeidc = $_POST['typeidc'];
	$typeid="";
	
	$memberModel = $userModel->GetMemberModel($name);
	if ($memberModel)
	{
		if ($memberModel[0]['g_mumber_type'] == 2){
			$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
		}else {
			$nid = $memberModel[0]['g_nid'];
		}
		$Lname = $userModel->GetUserName_Like($nid);
		if ($Lname[0]['g_lock'] != 1) {
			exit(back('更變權限不足！'));
		}
		$Lname = $Lname[0]['g_name'];
		if(isset($typeida)&&$typeida!=""){
		$typeidtemp = strtolower($typeida);
		$typeid = $typeid."g_{$typeidtemp}_limit";
		}
		if(isset($typeidb)&&$typeidb!=""){
		$typeidtemp = strtolower($typeidb);
		if($typeid=="") $typeid =  $typeid."g_{$typeidtemp}_limit";
		else $typeid =  $typeid.",g_{$typeidtemp}_limit";
		}
		if(isset($typeidc)&&$typeidc!=""){
		$typeidtemp = strtolower($typeidc);
		if($typeid=="") $typeid =  $typeid."g_{$typeidtemp}_limit";
		else $typeid =  $typeid.",g_{$typeidtemp}_limit";
		}
		$db = new DB();
		//讀取上級退水盤

		$LdetList = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			$aList = $_POST['a'.($i+1)];
			$gbList = $_POST['gb'.($i+1)];
			$gcList = $_POST['gc'.($i+1)];
			$bList = $_POST['b'.($i+1)];
			$cList = $_POST['c'.($i+1)];
			
				if($aList!=""){
				if (!Matchs::isFloating($aList)) exit(back('輸入的數值錯誤！'));}	if($gbList!=""){if (!Matchs::isFloating($gbList)) exit(back('輸入的數值錯誤！'));}	if($gcList!=""){if (!Matchs::isFloating($gcList)) exit(back('輸入的數值錯誤！'));}
			
			
			if (!Matchs::isFloating($bList) || !Matchs::isFloating($cList)) exit(back('輸入的數值錯誤！'));
			
			if($aList!=""){
			if ($aList < $LdetList[$i][4] || $aList > 100) exit(back($LdetList[$i][0].' [ A盤 ] 退水設置：'.$LdetList[$i][4].'---'.(100)));}
			if($gbList!=""){
			if ($gbList < $LdetList[$i][5] || $gbList > 100) exit(back($LdetList[$i][0].' [ B盤 ] 退水設置：'.$LdetList[$i][5].'---'.(100)));}
			if($gcList!=""){
			if ($gcList < $LdetList[$i][6] || $gcList > 100) exit(back($LdetList[$i][0].' [ C盤 ] 退水設置：'.$LdetList[$i][6].'---'.(100)));}
			if ($bList > $LdetList[$i][1]) exit(back($LdetList[$i][0].' 最高單註限額設置為：'.$LdetList[$i][1]));
			if ($cList > $LdetList[$i][2]) exit(back($LdetList[$i][0].' 最高單期限額設置為：'.$LdetList[$i][2]));
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetList[$i][0]}' AND g_game_id = '{$LdetList[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		exit(alert_href('更變成功', 'Actfor.php?cid='.$_GET['cid']));
	}
	else 
	{
		exit(alert_href('用戶不存在', 'Actfor.php?cid='.$_GET['cid']));
	}
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['uid']) && isset($_GET['cid']))
{
	if (!Matchs::isString($_GET['uid'], 3, 15)) exit(alert_href('用戶名不合法', 'Actfor.php?cid='.$_GET['cid']));
	$cid = $_GET['cid'];
	$uid = $_GET['uid'];
	
	//判斷當前用戶是否存在、檢查當前用戶是否已有未結算注單。
	$memberModel = $userModel->GetMemberModel($uid);
	if ($memberModel)
	{
		$detModel = new Detailed();
		$dets = $detModel->GetDetailedsAll($uid);
		$memberDetList = $userModel->GetUserMR($uid, true);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
</head>
<body>
<form action="" method="post">
<input type="hidden" name="name" value="<?php echo$memberModel[0]['g_name']?>" />
<?php $P = $memberModel[0]['g_panlus'];?>
<?php if(strstr($P,'A')!=''){echo "<input type='hidden' name='typeida' value='A' />";}?>
<?php if(strstr($P,'B')!=''){echo "<input type='hidden' name='typeidb' value='B' />";}?>
<?php if(strstr($P,'C')!=''){echo "<input type='hidden' name='typeidc' value='C' />";}?>
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
                                    <td width="99%">&nbsp;退水設定（<?php echo$memberModel[0]['g_name']?>）</td>
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
                                	<th colspan="6">廣東快樂十分</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=0; $i<13; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td>
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=13; $i<26; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="6">重慶時時彩</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                                <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=26; $i<33; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                                 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                                 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=33; $i<39; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                                 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
							 <table border="0" cellspacing="0" class="conter" style="display:none">
                            	<tr class="tr_top">
                                	<th colspan="6">廣西快樂十分</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=39; $i<50; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td>
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=50; $i<60; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
							<table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="6">北京赛车PK10</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=60; $i<68; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td>
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=68; $i<76; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
							
							
							<table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="6">六合彩</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=76; $i<100; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter" >
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=100; $i<123; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table> 
										
                                    </td>
                                </tr>
                            </table>
							
							
							<table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="6">幸运农场</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=123; $i<136; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter" >
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=136; $i<149; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table> 
										
                                    </td>
                                </tr>
                            </table>
							
							
							<table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="6">新疆時時彩</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=149; $i<156; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter" >
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=156; $i<162; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table> 
										
                                    </td>
                                </tr>
                            </table>
							
							
							<table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="6">江苏骰寶(快3)</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=162; $i<166; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
												 <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
                                
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter" >
                                        	<tr class="tr_top">
                                                <td width="150">交易類型</td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "<td width='90'>A盤</td>";}?>
												<?php if(strstr($P,'B')!=''){echo "<td width='90'>B盤</td>";}?>
												<?php if(strstr($P,'C')!=''){echo "<td width='90'>C盤</td>";}?>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=166; $i<count($memberDetList); $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $memberDetList[$i]['g_type']?></td>
                                               <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_a'].'</td>':'<td><input type="text" name="a'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_a'].'" /></td>';}?>
												<?php if(strstr($P,'B')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_b'].'</td>':'<td><input type="text" name="gb'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_b'].'" /></td>';}?>
												<?php if(strstr($P,'C')!=''){ echo $dets?'<td>'.$memberDetList[$i]['g_panlu_c'].'</td>':'<td><input type="text" name="gc'.($i+1).'" class="texta" value="'.$memberDetList[$i]['g_panlu_c'].'" /></td>';}?>
												
                                                <td><?php echo $dets?$memberDetList[$i]['g_danzhu']:'<input type="text" name="b'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danzhu'].'" />';?></td>
                                                <td><?php echo $dets?$memberDetList[$i]['g_danxiang']:'<input type="text" name="c'.($i+1).'" class="textb" value="'.$memberDetList[$i]['g_danxiang'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table> 
										
                                    </td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><?php if(!$dets){?><input type="submit" class="inputs" value="保存更變" /><?php }?></td>
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
</form>
</body>
</html>