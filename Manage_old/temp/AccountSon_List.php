<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users;
$lock_6 =false;
if (isset($Users[0]['g_lock_6'])){
	$lock_6 = true;
	if ($Users[0]['g_lock_6'] != 1)
		exit(back('您的權限不足！'));
}

$db=new DB();
if (isset($_GET['del']))
{
	if ($db->query("SELECT g_id FROM g_relation_user LIMIT 1", 0))
	{
		$db->query("DELETE FROM g_relation_user WHERE g_id = {$_GET['del']} LIMIT 1", 2);
		exit(alert_href('刪除成功', 'AccountSon_List.php'));
	} 
	else 
	{
		exit(alert_href('用戶不存在！', 'AccountSon_List.php'));
	}
} 
else 
{
	$sName = $lock_6 ? " g_s_name <> '{$Users[0]['g_s_name']}' AND g_sh_id = '{$Users[0]['g_sh_id']}' AND " : null;
	$result = $db->query("SELECT g_id, g_s_name, g_s_f_name,g_s_date, g_lock, g_out FROM 
	g_relation_user WHERE g_s_nid = '{$Users[0]['g_nid']}' AND {$sName} g_s_login_id = '{$Users[0]['g_login_id']}' 
	ORDER BY g_s_date DESC", 1);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/search.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function deluser(id){
		if (confirm("確定刪除嗎？")){
			location.href = location.href+"?del="+id;
		}
	}
	
	

function locationFile(strInt){
	_sType = strInt;
	var oddsPop = $("#oddsPops"+_sType);
	var offsetTop = event.y; 
	var offsetLeft = event.x-135; 
	oddsPop.slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function diplaydiv(strInt){
	_sType = strInt;
	var oddsPop = $("#oddsPops"+_sType);
	oddsPop.slideDown(200).css({"display" : "none"});
}



function changeAjax(type,uid,utype,utNum){
	$.ajax({
			type : "POST",
			data : {type : type,uid:uid,utype:utype},
			url : "setZT.php",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						changeAjax(type,uid,utype);
						return false;
					}
				}
			},
			success:function(data){
			//	if(data==1){
			//	alert("金额还原成功!");
			//	}else{
			//	alert("金额还原失败!");
				//}
				var utb = $("#ut"+utNum);
				utb.val(data);
				_sType = utNum;
				var oddsPop = $("#oddsPops"+_sType);
				oddsPop.slideDown(200).css({"display" : "none"});
			}
		});
}
-->
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
                                    <td width="16"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="1024">&nbsp;子帳號管理</td>
                                    <td width="14"><img src="images/22.gif" width="14" height="14" /></td>
                                    <td width="104"><a href="AccountSon_Add.php">新增子帳號</a></td>
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
                                	<td width="30">在綫</td>
                                    <td>子帳號</td>
                                    <td>名稱</td>
                                    <td>新增日期</td>
            						<td width="150">功能</td>
            						<td width="120">狀態</td>
                                </tr>
                                <?php if (!$result){echo '<tr><td colspan="6" align="center">暫無記錄</td></tr>';} else {
                                for ($i=0; $i<count($result); $i++){?>
                                <tr style="height:25px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''" align="center">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Manage/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_s_name']}',this,'3')\" />";
                                		} else {
                                			echo '<img src="/Manage/temp/images/USER_0.gif" />';
                                		}
                                	?>
                                	</td>
                                    <td><?php echo$result[$i]['g_s_name']?></td>
                                    <td><?php echo$result[$i]['g_s_f_name']?></td>
                                    <td><?php echo$result[$i]['g_s_date']?></td>
            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="15"><img src='/Manage/temp/images/edit.gif'/></td>
                                                    <td class="nones" width="30"><a href="AccountSon_Up.php?uid=<?php echo $result[$i]['g_id']?>">修改</a></td>
                                                    <td class="nones" width="16"><img src='/Manage/temp/images/55.gif'/></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo$result[$i]['g_s_name']?>">日誌</a></td>
                                                    <td class="nones" width="16"><img src='/Manage/temp/images/44.gif'/></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="deluser('<?php echo$result[$i]['g_id']?>')">刪除</a></td>
                                              </tr>
                                        </table>
                                    </td>
            						<td>
	            						<input type="button" name="ut<?php echo $i?>" id="ut<?php echo $i?>"  onclick="locationFile(<?php echo $i?>);" value="<?php if($result[$i]['g_lock']==1) echo '啟用';
if($result[$i]['g_lock']==2) echo '凍結'; if($result[$i]['g_lock']==3) echo '停用';?>"/>
										<div id="oddsPops<?php echo $i?>" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th align="right">修改賬戶狀態</th><th width="27%" align="right"><img src="/Manage/temp/images/del.gif" onclick="diplaydiv(<?php echo $i?>);" title="关闭" /></th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas<?php echo $i?>" colspan="2">                                              
		<input name="lock<?php echo $i?>" type="radio" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo$result[$i]['g_s_name']?>',3,<?php echo $i?>);" />
                    啟用&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="2" <?php if($result[$i]['g_lock']==2){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo$result[$i]['g_s_name']?>',3,<?php echo $i?>);" />
                    凍結&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="3" <?php if($result[$i]['g_lock']==3){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo$result[$i]['g_s_name']?>',3,<?php echo $i?>);" />
                    停用&nbsp;		
      	</td>
    </tr>
</table>
</div>
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
                        <td class="f" align="right"></td>
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