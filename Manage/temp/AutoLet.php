<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $stratGamecq, $endGamecq;
$ConfigModel = configModel("`g_automatic_bu_huo_lock`, `g_mix_money`, `g_mix_money`");
if ($ConfigModel['g_automatic_bu_huo_lock'] != 1) exit(back('自動補倉功能維護中...'));
if ($Users[0]['g_Immediate_lock'] != 1) exit(back('您的權限不足！'));
$db=new DB();

$sql = "SELECT `g_id`, `g_nid`, `g_name`, `g_type`, `g_choose`, `g_money`,`g_lock`, `g_game_id` FROM g_autolet
WHERE g_name = '{$Users[0]['g_name']}' ORDER BY g_id DESC";
$result = $db->query($sql, 1);
if (!$result) exit(back('您的帳號異常，無法讀取補倉盤，請與上級聯繫。'));
$a = date('Y-m-d ').'01:55:00';
$myTime = date('Y-m-d H:i:s');
$bool = false;
if ( ($myTime < $stratGamecq && $myTime > $a) || $myTime > $endGamecq){
	$bool =true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$List = array();
	for ($i=0; $i<76; $i++){
		$n=$i+1;
		$List[$i]['g_id'] = $_POST['type'.$n];
		$List[$i]['g_money'] = empty($_POST['money'.$n]) ? 0 : $_POST['money'.$n];
		$List[$i]['g_lock'] = empty($_POST['lock'.$n]) ? 0 : 1;
		if ($List[$i]['g_lock'] == 1){
			if (!Matchs::isNumber($List[$i]['g_money'])){
				exit(back('控製額度輸入錯誤！'));
			}
			if ($List[$i]['g_money'] < $ConfigModel['g_mix_money'])
				exit(back('最低“起補額度” '.$ConfigModel['g_mix_money']));
		}
		if ($bool == false){
			if ($result[$i]['g_money'] > 0 && $List[$i]['g_lock'] != 1){
				exit(back('開盤狀態，不可更變狀態！'));
			}
			if ($List[$i]['g_money'] < $result[$i]['g_money']){
				exit(back('最低可調額度！'.$result[$i]['g_money']));
			}
		}
	}
	
	for ($i=0; $i<count($List); $i++){
		if ($List[$i]['g_money'] != $result[$i]['g_money'] || $List[$i]['g_lock'] != $result[$i]['g_lock']){
			$valueList = array();
			$name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
			$valueList['g_name'] = $name;
			$valueList['g_f_name'] = $name;
			$valueList['g_initial_value'] = $result[$i]['g_money'];
			$valueList['g_up_value'] = $List[$i]['g_lock'] != 1 ? 0 : $List[$i]['g_money'];
		    if($result[$i]['g_game_id'] == 1){
			$valueList['g_up_type'] ='廣東快樂十分【'.$result[$i]['g_type'].'】' ;
			}else{
			if($result[$i]['g_game_id'] == 2){
			$valueList['g_up_type'] ='重慶時時彩【'.$result[$i]['g_type'].'】';
			}else  if($result[$i]['g_game_id'] ==6){
				$valueList['g_up_type'] = '北京赛车【'.$result[$i]['g_type'].'】';
			}else {
				$valueList['g_up_type'] = '廣西快樂十分【'.$result[$i]['g_type'].'】';
			}
			}		
			$valueList['g_s_id'] = 2;
			insertLogValue($valueList);
			$sql = "UPDATE g_autolet SET `g_money` = '{$List[$i]['g_money']}', g_lock='{$List[$i]['g_lock']}' WHERE g_id = '{$List[$i]['g_id']}' LIMIT 1";
			$db->query($sql, 2);
		}
	}
	exit(alert_href('更變成功', 'AutoLet.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript">
<!--
	$(function(){
		$(":checkbox").each(function(){
			var _checkedId = $(this).attr("checked");
			ischeckbox($(this));
		});
	});

	function ischeckbox($this){
		var _thisId = $this.attr("id");
		var id = _thisId.substr(4);
		var choose = $("#choose"+id);
		var money = $("#money"+id);
		var pid = $("#p"+id);
		if ($this.attr("checked")){
			pid.css("background", "#FFFFA2");
			choose.attr("disabled","");
			money.attr("disabled","");
		} else {
			pid.css("background", "#FFF");
			choose.attr("disabled","disabled");
			money.attr("disabled","disabled");
		}
	}
//-->
</script>
<title></title>
</head>
<body>
<form action="" method="post">
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
                                    <td width="99%">&nbsp;自動補倉設置</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="t_odds" width="50%">
                            	<tr class="tr_top">
                                	<td>補貨類型</td>
                                    <td>選擇計算方式</td>
                                    <td>控製額度</td>
                                    <td>最低可調額度</td>
                                    <td>起補額度</td>
                                    <td>启用</td>
                                </tr>
                                <tr class="tr_top">
                                	<th colspan="6">廣東快樂十分</th>
                                </tr>
                                <?php 
                                for ($i=0; $i<26; $i++){
                                	$n=$i+1;
                                	$s = $i>=18 ? '[單註計算]' : null;
                                	$mix = $bool ? 0 : $result[$i]['g_money'];
                                	?>
                                <tr id="p<?php echo$n?>" align="center" style="height:25px">
                                	<td class="caption_11"><?php echo$result[$i]['g_type']?><input type="hidden" name="type<?php echo$n?>" value="<?php echo$result[$i]['g_id']?>" /></td>
                                    <td>
                                    	<select name="choose<?php echo$n?>" id="choose<?php echo$n?>" disabled="disabled">
                                        <option value="<?php echo$result[$i]['g_choose']?>">下註額<?php echo$s?></option>
                                        </select>
                                    </td>
                                    <td><input class="inp1" name="money<?php echo$n?>" id="money<?php echo$n?>" maxlength="9" type="text" value="<?php echo$result[$i]['g_money']?>"  disabled="disabled" /></td>
                                    <td><?php echo$mix?></td>
                                    <td><?php echo$ConfigModel['g_mix_money']?></td>
                                    <td><input type="checkbox" <?php if ($result[$i]['g_type'] == '選二連直' || $result[$i]['g_type'] == '選三前直' || $result[$i]['g_type'] == '選三前組'){echo'disabled="disabled"';}?> onclick="ischeckbox($(this))" name="lock<?php echo$n?>" id="lock<?php echo$n?>" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?> /></td>
                                </tr>
                                <?php }?>
                                <tr>
                                	<td colspan="6" align="center">註意：單筆低于"起補額度"時不自動補出；連碼為"單註"註額度計。</td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="49%">
                            	<tr class="tr_top">
                                	<td>補貨類型</td>
                                    <td>選擇計算方式</td>
                                    <td>控製額度</td>
                                    <td>最低可調額度</td>
                                    <td>起補額度</td>
                                    <td>启用</td>
                                </tr>
                                <tr class="tr_top">
                                	<th colspan="6">重慶時時彩</th>
                                </tr>
                                <?php 
                                for ($i=26; $i<39; $i++){
                                	$n=$i+1;
                                	$mix = $bool ? 0 : $result[$i]['g_money'];
                                	?>
                                <tr id="p<?php echo$n?>" align="center">
                                	<td class="caption_11"><?php echo$result[$i]['g_type']?><input type="hidden" name="type<?php echo$n?>" value="<?php echo$result[$i]['g_id']?>" /></td>
                                    <td>
                                    	<select name="choose<?php echo$n?>" id="choose<?php echo$n?>" disabled="disabled">
                                        <option value="<?php echo$result[$i]['g_choose']?>">下註額</option>
                                        </select>
                                    </td>
                                    <td><input class="inp1" name="money<?php echo$n?>" id="money<?php echo$n?>" maxlength="9" type="text" value="<?php echo$result[$i]['g_money']?>"  disabled="disabled" /></td>
                                    <td><?php echo$mix?></td>
                                    <td><?php echo$ConfigModel['g_mix_money']?></td>
                                    <td><input type="checkbox" <?php if ($result[$i]['g_type'] == '選二連直' || $result[$i]['g_type'] == '選三前直'){echo'disabled="disabled"';}?> onclick="ischeckbox($(this))" name="lock<?php echo$n?>" id="lock<?php echo$n?>" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?> /></td>
                                </tr>
                                <?php }?>
                                <tr>
                                	<td colspan="6" align="center">註意：單筆低于"起補額度"時不自動補出；連碼為"單註"註額度計。</td>
                                </tr>
                            </table>
							
							
							<table border="0" cellspacing="0" class="t_odds" width="49%">
                            	<tr class="tr_top">
                                	<td>補貨類型</td>
                                    <td>選擇計算方式</td>
                                    <td>控製額度</td>
                                    <td>最低可調額度</td>
                                    <td>起補額度</td>
                                    <td>启用</td>
                                </tr>
                                <tr class="tr_top">
                                	<th colspan="6">北京赛车(PK10)</th>
                                </tr>
                                <?php 
                                for ($i=60; $i<count($result); $i++){
                                	$n=$i+1;
                                	$mix = $bool ? 0 : $result[$i]['g_money'];
                                	?>
                                <tr id="p<?php echo$n?>" align="center">
                                	<td class="caption_11"><?php echo$result[$i]['g_type']?><input type="hidden" name="type<?php echo$n?>" value="<?php echo$result[$i]['g_id']?>" /></td>
                                    <td>
                                    	<select name="choose<?php echo$n?>" id="choose<?php echo$n?>" disabled="disabled">
                                        <option value="<?php echo$result[$i]['g_choose']?>">下註額</option>
                                        </select>
                                    </td>
                                    <td><input class="inp1" name="money<?php echo$n?>" id="money<?php echo$n?>" maxlength="9" type="text" value="<?php echo$result[$i]['g_money']?>"  disabled="disabled" /></td>
                                    <td><?php echo$mix?></td>
                                    <td><?php echo$ConfigModel['g_mix_money']?></td>
                                    <td><input type="checkbox" <?php if ($result[$i]['g_type'] == '選二連直' || $result[$i]['g_type'] == '選三前直'){echo'disabled="disabled"';}?> onclick="ischeckbox($(this))" name="lock<?php echo$n?>" id="lock<?php echo$n?>" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?> /></td>
                                </tr>
                                <?php }?>
                                <tr>
                                	<td colspan="6" align="center">註意：單筆低于"起補額度"時不自動補出；連碼為"單註"註額度計。</td>
                                </tr>
                            </table>
							
							
							 <table border="0" cellspacing="0" class="t_odds" width="49%" style="display:none">
                            	<tr class="tr_top">
                                	<td>補貨類型</td>
                                    <td>選擇計算方式</td>
                                    <td>控製額度</td>
                                    <td>最低可調額度</td>
                                    <td>起補額度</td>
                                    <td>启用</td>
                                </tr>
                                <tr class="tr_top">
                                	<th colspan="6">廣西快樂十分</th>
                                </tr>
                                  <?php 
                                for ($i=39; $i<60; $i++){
                                	$n=$i+1;
                                	$s = $i>=54 ? '[單註計算]' : null;
                                	$mix = $bool ? 0 : $result[$i]['g_money'];
                                	?>
                                <tr id="p<?php echo$n?>" align="center" style="height:25px">
                                	<td class="caption_11"><?php echo$result[$i]['g_type']?><input type="hidden" name="type<?php echo$n?>" value="<?php echo$result[$i]['g_id']?>" /></td>
                                    <td>
                                    	<select name="choose<?php echo$n?>" id="choose<?php echo$n?>" disabled="disabled">
                                        <option value="<?php echo$result[$i]['g_choose']?>">下註額<?php echo$s?></option>
                                        </select>
                                    </td>
                                    <td><input class="inp1" name="money<?php echo$n?>" id="money<?php echo$n?>" maxlength="9" type="text" value="<?php echo$result[$i]['g_money']?>"  disabled="disabled" /></td>
                                    <td><?php echo$mix?></td>
                                    <td><?php echo$ConfigModel['g_mix_money']?></td>
                                    <td><input type="checkbox"  onclick="ischeckbox($(this))" name="lock<?php echo$n?>" id="lock<?php echo$n?>" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?> /></td>
                                </tr>
                                <?php }?>
                                <tr>
                                	<td colspan="6" align="center">註意：單筆低于"起補額度"時不自動補出；連碼為"單註"註額度計。</td>
                                </tr>
                            </table>
							
							
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確定" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="inputs" value="取消" /></td>
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