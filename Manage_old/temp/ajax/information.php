<?php 
define('Copyright', '作者QQ:1099412183');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/config/global.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $LoginId;
$uid = $_GET['uid'];
$uptext = null;
$inputValue = "確定發佈";
$inputId = "insert";
$db=new DB();
$total = $db->query("SELECT `g_id` FROM `g_set_user_news` ", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM `g_set_user_news`  ORDER BY g_id DESC {$page->limit} ", 1);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$text = strip_tags($_POST['textfield']);
	if (mb_strlen($text) < 1 || mb_strlen($text) >100) exit(back('內容長度不能小於1或大於100個字符'));
	if (isset($_POST['insert']))
	{
		if ($db->query("SELECT g_id FROM g_set_user_news WHERE g_name = '{$uid}' LIMIT 1", 0))
			exit(back($uid.'帳號已發佈過信息。'));
		$sql = "INSERT INTO g_set_user_news (`g_name`, `g_text`, `g_date`) VALUES (
		'{$uid}',
		'{$text}',
		now())";
		$db->query($sql, 2);
		exit(back('寫入成功'));
	}
	else if (isset($_POST['update']))
	{
		$sql = "UPDATE g_set_user_news SET g_text = '{$text}' WHERE g_name = '{$uid}' LIMIT 1";
		$db->query($sql, 2);
		exit(alert_href('修改成功', 'information.php?uid='.$uid));
	}
}
else if (isset($_GET['uid']) && isset($_GET['up']))
{
	$resultText = $db->query("SELECT g_text FROM `g_set_user_news` WHERE g_name = '{$uid}' LIMIT 1", 0);
	if ($resultText)
	{
		$uptext = $resultText[0][0];
		$inputValue = "確定修改";
		$inputId = "update";
	}
}
else if (isset($_GET['did']))
{
	$sql = "DELETE FROM g_set_user_news WHERE g_name = '{$_GET['did']}' LIMIT 1";
	$db->query($sql, 2);
	exit(back('刪除成功'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<script type="text/javascript">
<!--
	function go(){
		if (document.getElementById("textfield").value == ""){
			alert("請輸入內容");
			return false;
		}
		if (confirm("確定嗎？"))
			return true;
		else
			return false;
	}

	function del(str){
		if (confirm("確定刪除嗎？"))
			location.href = "information.php?did="+str;
	}
//-->
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
                                    <td width="99%">&nbsp;發佈消息</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                        <form action="" method="post" onsubmit="return go()">
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="4">帳號：<?php echo$uid?></th>
                                </tr>
                                <tr style="height:75px">
                                	<td class="bj">發佈消息:</td>
                                    <td class="left_p6" colspan="3">
                                    <textarea name="textfield" id="textfield" style="height:60px"><?php echo$uptext?></textarea>&nbsp; &nbsp; 
                                    <input type="submit" class="inputs" name="<?php echo$inputId?>" value="<?php echo$inputValue?>" />
                                    </td>
                                </tr>
                                <tr class="texts" align="center">
                                	<td>帳號</td>
                                	<td>內容</td>
                                	<td>發佈時間</td>
                                	<td width="130">基本操作</td>
                                </tr>
                                <?php if (!$result){echo '<tr><td colspan="4" align="center">暫無記錄</td></tr>';}else {foreach ($result as $value){?>
                                <tr align="center">
                                	<td><?php echo $value['g_name']?></td>
                                	<td><?php echo $value['g_text']?></td>
                                	<td><?php echo $value['g_date']?></td>
                                	<td>
										<table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="15"><img src="/Manage/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="information.php?uid=<?php echo$value['g_name']?>&up=1">修改</a></td>
                                                    <td class="nones" width="16"><img src="/Manage/temp/images/del.gif" /></td>
                                                    <td class="nones" width="30"><a href="javascript:void(0)" onclick="del('<?php echo$value['g_name']?>')">刪除</a></td>
                                              </tr>
                                        </table>
									</td>
                                </tr>
                                <?php }}?>
                            </table>
                            </form>
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