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
	$usersModel = $userModel->GetUserModel(null, $name);
	if ($usersModel)
	{
		$Lname = mb_substr($usersModel[0]['g_nid'], 0, mb_strlen($usersModel[0]['g_nid'])-32);
		$Lname = $userModel->GetUserName_Like($Lname);//返回查询出来的用户信息
		$db = new DB();
		if ($usersModel[0]['g_login_id'] == 56){//如果被操作用户为分公司，则将类赋给$Lname，否则宣告权限不足
			$Lname=$usersModel;
		} else {
			if ($Lname[0]['g_lock'] != 1) {
				exit(back('更變權限不足！'));
			}
		}
		$sList = array(0=>0, 1=>0, 2=>0);
		$LdetList = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' ORDER BY g_id DESC", 0); //获取退水表
		for ($i=0; $i<count($LdetList); $i++) {
			$aList = $_POST['a'.($i+1)];//A盘退水
			$bList = $_POST['b'.($i+1)];//B盘退水
			$cList = $_POST['c'.($i+1)];//C盘退水
			$dList = $_POST['d'.($i+1)];//单注
			$eList = $_POST['e'.($i+1)];//单期
			if (!Matchs::isFloating($aList) || !Matchs::isFloating($bList) || !Matchs::isFloating($cList) || !Matchs::isFloating($dList) || !Matchs::isFloating($eList)) 
				exit(back('輸入的數值錯誤！'.$i));
			if ($usersModel[0]['g_login_id'] != 56){
				if ($aList < $LdetList[$i][3] || $aList > 100) exit(back(' [ '.$LdetList[$i][2].'盤 ] 退水設置：'.$LdetList[$i][3].'---'.(100)));
				if ($bList < $LdetList[$i][4] || $aList > 100) exit(back(' [ '.$LdetList[$i][2].'盤 ] 退水設置：'.$LdetList[$i][4].'---'.(100)));
				if ($cList < $LdetList[$i][5] || $aList > 100) exit(back(' [ '.$LdetList[$i][2].'盤 ] 退水設置：'.$LdetList[$i][5].'---'.(100)));
				if ($dList > $LdetList[$i][6] || $dList < 0) exit(back($LdetList[$i][2].' 最高單註限額設置為：'.$LdetList[$i][6].'---'.(0)));
				if ($eList > $LdetList[$i][7] || $eList < 0) exit(back($LdetList[$i][2].' 最高單期限額設置為：'.$LdetList[$i][7].'---'.(0)));
			}
			if ($aList > $LdetList[$i][3])
			{
				//取A盘
				$LdetList[$i][3] = $aList;
				updateTuiShui ($db, $LdetList[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList[$i][4])
			{
				//取B盘
				$LdetList[$i][4] = $bList;
				updateTuiShui ($db, $LdetList[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList[$i][5])
			{
				//取C盘
				$LdetList[$i][5] = $cList;
				updateTuiShui ($db, $LdetList[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList[$i][2]}' AND g_game_id = '{$LdetList[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//print_r($LdetList);
		//exit;
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
	
	$user = $userModel->GetUserModel(null, $uid);
	//$count = $userModel->SumCount($user[0]['g_nid'].UserModel::Like());
	$dateTime = date('Y-m-d H:i:s');
	$a = day();
	$stratGame = $a[0];
	$endGame = $a[1];
	$date = " `g_date` > '{$stratGame}' AND `g_date` < '{$endGame}' ";
	$db = new DB();
	if (!$db->query("SELECT g_id FROM g_zhudan WHERE {$date} AND g_s_nid LIKE '{$user[0]['g_nid']}%' LIMIT 1", 0)){
		$count = 0;
	} else {
		$count = 1;
	}

	//讀取退水
	$result = $userModel->GetUserMR($uid);
	if (!$result)exit(alert_href('無法讀取退水設置！請于上級聯繫', "Actfor.php?cid={$cid}"));
}

function updateTuiShui ($db, $LdetList, $usersModel, $p, $param){
	if ($usersModel[0]['g_login_id'] != 48) {
		$sql = "SELECT `g_name` FROM g_rank WHERE g_nid LIKE '{$usersModel[0]['g_nid']}%'";
		$result = $db->query($sql, 1);
		if ($result) {
			for ($i=0; $i<count($result); $i++){
				$sql = "UPDATE `g_send_back` SET g_a_limit='{$LdetList[3]}', g_b_limit='{$LdetList[4]}', g_c_limit='{$LdetList[5]}'
				WHERE g_name = '{$result[$i]['g_name']}' 
				AND  g_type='{$LdetList[2]}'
				AND g_game_id = '{$LdetList[8]}' 
				AND (g_a_limit < '{$LdetList[3]}' OR g_b_limit <'{$LdetList[4]}' OR g_c_limit <'{$LdetList[5]}') LIMIT 1 ";
				$db->query($sql, 2);
			}
		}
	}
	
	$sql = "SELECT u.g_name, p.* FROM `g_user` AS u 
				INNER JOIN g_panbiao as p ON u.g_name = p.g_nid
				WHERE u.g_nid LIKE '{$usersModel[0]['g_nid']}%'
				AND p.g_game_id = '{$LdetList[8]}' 
				AND p.g_type = '{$LdetList[2]}' AND u.g_panlu = '{$p}'";
	$result = $db->query($sql, 1);
	
	if ($result) {
		for ($i=0; $i<count($result); $i++){
		if($p=="a"){
		$parm="g_panlu_a";
		}
		if($p=="b"){
		$parm="g_panlu_b";
		}
		if($p=="c"){
		$parm="g_panlu_c";
		}
			$sql = "UPDATE `g_panbiao` SET {$parm}='{$param}' WHERE g_nid = '{$result[$i]['g_name']}' 
			AND  g_type='{$LdetList[2]}'
			AND g_game_id = '{$LdetList[8]}' LIMIT 1 ";
			$db->query($sql, 2);
		}
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
<title></title>
<script type="text/javascript">
<!--
	function isAuto($this, a, c){
		var val = $this.value;
		var name;
		if (a == 1){
			n = 8;
			s = 1;
		} else {
			n = 31;
			s = 27;
		}
		for (var i=s; i<=n; i++){
			name = $("input[name="+c+i+"]");
			name.val(val);
		}
	}
	
	function jia(){
		var sel = $('#chuli').val();
		var start=sel.split('-')[0];
		var end=sel.split('-')[1];
		var pankou_arr = $('#pankou').val().split(',');
		for(var i=start;i<=end;i++){
			for(var p=0;p<pankou_arr.length;p++){
				var t=$('input[name='+pankou_arr[p]+i+']').val();
				t=fmtnumeric(t*1+0.1,10);
				$('input[name='+pankou_arr[p]+i+']').val(t);
			}
		}
	}
	function jian(){
		var sel = $('#chuli').val();
		var start=sel.split('-')[0];
		var end=sel.split('-')[1];
		var pankou_arr = $('#pankou').val().split(',');
		for(var i=start;i<=end;i++){
			for(var p=0;p<pankou_arr.length;p++){
				var t=$('input[name='+pankou_arr[p]+i+']').val();
				t=fmtnumeric(t*1-0.1,10);
				$('input[name='+pankou_arr[p]+i+']').val(t);
			}
		}
	}
	
	function ok(){
		var sel = $('#chuli').val();
		var start=sel.split('-')[0];
		var end=sel.split('-')[1];
		var pankou_arr = $('#pankou').val().split(',');
		for(var i=start;i<=end;i++){
			for(var p=0;p<pankou_arr.length;p++){
				$('input[name='+pankou_arr[p]+i+']').val( $('#scel').val()  ); 
			}
		}
	}
	
	function fmtnumeric(val,len)
	{
		if(!isNaN(val))
		{
			val=Math.round(val*len)/len;
		}
		else
		{
			val="";
		}
		return val;
	}
//-->
</script>
</head>
<body>
<form action="" method="post">
<input type="hidden" name="name" value="<?php echo$uid?>" />
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
                                    <td width="99%">
										<table cellpadding="0" cellspacing="0">
										<tr> 
										<td>&nbsp;退水設定（<?php echo$uid?>）</td>
										<td style="color:#FF0000; font-weight:bold;">&nbsp;批量操作</td>
										<td><select  id="chuli"  >
										<option value="1-200">==所有玩法==</option>
										<option value="1-26">廣東快樂十分</option>
										<option value="27-39">重庆时时彩</option>
										<option value="40-55">北京赛车(PK10)</option>
										<option value="123-149">幸运农场</option>
										<option value="163-170">江苏快三</option>
										</select></td>
										<td><select  id="pankou"  >
										<option value="a,b,c">==所有盘口==</option>
										<option value="a">A盘</option>
										<option value="b">B盘</option>
										<option value="c">C盘</option> 
										<option value="d">单注限额</option> 
										<option value="e">单期限额</option> 
										</select></td>
										
										<td><div id="jia"><span onclick="jia()"  style="border:#CCCCCC outset 1px; background:#FFFFFF; height:8px; width:20px; line-height:8px; cursor:pointer; display:block; text-align:center">+</span></div>
				<div id="jian"><span onclick="jian()" style="border:#CCCCCC outset 1px; background:#FFFFFF; height:8px; width:20px;line-height:8px;text-align:center; cursor:pointer; display:block">-</span></div></td>
									<td><input id="scel" size="3" /></td>
									<td><span onclick="ok()" style="border:#CCCCCC outset 1px; background:#FFFFFF; height:16px; width:20px; cursor:pointer; text-align:center; display:block">√</span></td>
									</tr>
									</table> 
									
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
                            	<tr class="tr_top">
                                	<th colspan="6">廣東快樂十分</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=0; $i<13; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td>
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=13; $i<26; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
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
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=26; $i<33; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td  valign="top">
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=33; $i<39; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
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
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=39; $i<50; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td>
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=50; $i<60; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
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
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=60; $i<68; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td>
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=68; $i<76; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
							
							
							 <table border="0" cellspacing="0" class="conter" style="display:none">
                            	<tr class="tr_top">
                                	<th colspan="6">六合彩</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=76; $i<100; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=100; $i<123; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
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
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=123; $i<136; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=136; $i<149; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
							
							
							
							<table border="0" cellspacing="0" class="conter" style="display:none">
                            	<tr class="tr_top">
                                	<th colspan="6">新疆时时彩</th>
                                </tr>
                            	<tr>
                                	<td>
                                    	<table border="0" cellspacing="0" width="100%" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=149; $i<156; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=156; $i<162; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
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
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=162; $i<166; $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                    <td valign="top">
                                    	<table border="0" cellspacing="0" class="conter">
                                        	<tr class="tr_top">
                                                <td width="110">交易類型</td>
                                                <td>A盤</td>
                                                <td>B盤</td>
                                                <td>C盤</td>
                                                <td>單註限額</td>
                                                <td>單期限額</td>
                                            </tr>
                                            <?php for ($i=166; $i<count($result); $i++){?>
                                            <tr align="center" style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                                <td class="caption_11"><?php echo $result[$i]['g_type']?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_a_limit']:'<input type="text" name="a'.($i+1).'" class="texta" value="'.$result[$i]['g_a_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_b_limit']:'<input type="text" name="b'.($i+1).'" class="texta" value="'.$result[$i]['g_b_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_c_limit']:'<input type="text" name="c'.($i+1).'" class="texta" value="'.$result[$i]['g_c_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_d_limit']:'<input type="text" name="d'.($i+1).'" class="textb" value="'.$result[$i]['g_d_limit'].'" />';?></td>
                                                <td><?php echo $count > 0 ? $result[$i]['g_e_limit']:'<input type="text" name="e'.($i+1).'" class="textb" value="'.$result[$i]['g_e_limit'].'" />';?></td>
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
                        <td class="f" align="center"><input type="submit" class="inputs" value="保存更變" /></td>
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