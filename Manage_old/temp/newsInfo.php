<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $ConfigModel;
if ($ConfigModel['g_news_lock'] != 1) exit(back('您的權限不足！'));
$db=new DB();
$cid=0; $Editors =null; $NumberShow=0; $g_number_alert_show=0; $RankShow=0;


$total = $db->query("SELECT * FROM g_news", 3);
$pageNum = 10;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM g_news ORDER BY g_id DESC {$page->limit} ", 1);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST['Editors'])) exit(back('請填寫公告內容！'));
	if (mb_strlen($_POST['Editors'], 'utf-8')>500) exit(back('內容最大字符200個。'));
	$news = array();
	$news['Editors'] = $_POST['Editors'];
	$news['NumberShow'] = empty($_POST['NumberShow']) ? 0 : 1;
	$news['NumberAlertShow'] = empty($_POST['NumberAlertShow']) ? 0 : 1;
	$news['RankShow'] = empty($_POST['RankShow']) ? 0 : 1;
	$cid = isset($_GET['cid']) ? $_GET['cid'] : 0;
	if ($ConfigModel['g_news_lock'] == 1 && $cid == 0){
		$sql = "INSERT INTO g_news (g_text,g_date,g_number_show,g_number_alert_show,g_rank_show) VALUES (
		'{$news['Editors']}',
		now(),
		'{$news['NumberShow']}',
		'{$news['NumberAlertShow']}',
		'{$news['RankShow']}')";
		$db->query($sql, 2);
		exit(back('寫入成功。'));
	} else {
		//print_r("UPDATE g_news SET g_text = '{$news['Editors']}', g_number_show = '{$news['NumberShow']}', g_number_alert_show = '{$news['NumberAlertShow']}', g_rank_show  = '{$news['RankShow']}' WHERE g_id = '{$cid}' LIMIT 1 ");exit;
		if ($db->query("SELECT g_text FROM g_news WHERE g_id = '{$cid}' LIMIT 1", 0)){
			$db->query("UPDATE g_news SET g_text = '{$news['Editors']}', g_number_show = '{$news['NumberShow']}', g_number_alert_show = '{$news['NumberAlertShow']}', g_rank_show  = '{$news['RankShow']}' WHERE g_id = '{$cid}' LIMIT 1 ", 2);
			exit(alert_href('更變成功。', 'newsInfo.php'));
		}
	}
}
else if (isset($_GET['cid']) && !isset($_GET['page']))
{
	if (Matchs::isNumber($_GET['cid'])){
		$cid=1;
		$text = $db->query("SELECT * FROM g_news WHERE g_id = '{$_GET['cid']}' LIMIT 1", 1);
		if($text){
			$Editors = $text[0]['g_text'];
			$NumberShow = $text[0]['g_number_show'];
			$NumberAlertShow  = $text[0]['g_number_alert_show'];
			$RankShow = $text[0]['g_rank_show'];
		}
	}
}
else if (isset($_GET['delid']))
{
	$delid = $_GET['delid'];
	if ($db->query("SELECT g_text FROM g_news WHERE g_id = '{$delid}' LIMIT 1", 0)){
		$db->query("DELETE FROM g_news WHERE g_id ='{$delid}' LIMIT 1", 2);
		exit(back('刪除成功。'));
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
<script type="text/javascript" src="/tools/ckeditor/ckeditor.js"></script>
<title></title>
<script type="text/javascript">
<!--
	$(function(){
		CKEDITOR.replace( 'Editors', {toolbar : [ ['Styles','Format','Font','FontSize','TextColor']]}); 
	});
-->
</script>
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
                                    <td width="99%">&nbsp;公告設置</td>
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
                                	<th>新增公告</th>
                                </tr>
                                <tr>
                                	<td align="center"><textarea cols="100%" id="Editors" name="Editors" ><?php echo$Editors?></textarea></td>
                                </tr>
                                <tr>
                    				<td>&nbsp; &nbsp; 
                    					會員走馬燈顯示:<input style="position:relative;top:2px" name="NumberShow" <?php if($NumberShow ==1){echo' checked="checked"';}?> type="checkbox"/>&nbsp; &nbsp; &nbsp; &nbsp; 
                    					會員彈出窗口顯示:<input style="position:relative;top:2px" <?php if($NumberAlertShow ==1){echo' checked="checked"';}?> name="NumberAlertShow" type="checkbox" />&nbsp; &nbsp; &nbsp; &nbsp; 
                    					代理走馬燈顯示:<input style="position:relative;top:2px" <?php if($RankShow ==1){echo' checked="checked"';}?> name="RankShow" type="checkbox" />
                    				</td>
                    			</tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="<?php echo$cid==1 ? '確認更變' : '確認新增'; ?>" /></td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
                <br/>
                <table border="1" cellspacing="0" class="conter" style="width:70%;margin:0 auto">
                	<tr class="tr_top">
                		<td width="30">序號</td>
                		<td width="20%">新增日期</td>
                		<td>新增日期</td>
                		<td width="60">會員顯示</td>
                		<td width="60">窗口顯示</td>
                		<td width="60">代理顯示</td>
                		<td width="10%">基本操作</td>
                	</tr>
                	<?php if(!$result){echo'<td align="center" colspan="4">暫無記錄</td>';}else{
                	for ($i=0; $i<count($result); $i++){
                	?>
                	<tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                		<td><?php echo$i+1?></td>
                		<td><?php echo$result[$i]['g_date']?></td>
                		<td class="left_p6" align="left"><?php echo$result[$i]['g_text']?></td>
                		<td><?php echo$result[$i]['g_number_show'] == 1 ? '<span class="red">是</span>' : '<span class="odds">否</span>';?></td>
                		<td><?php echo$result[$i]['g_number_alert_show'] == 1 ? '<span class="red">是</span>' : '<span class="odds">否</span>';?></td>
                		<td><?php echo$result[$i]['g_rank_show'] == 1 ? '<span class="red">是</span>' : '<span class="odds">否</span>';?></td>
                		<td>
                		<table border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                 <td class="nones" width="14" height="18"><img src="/Manage/temp/images/edt.gif"/></td>
                                  <td class="nones" width="30"><a href="newsInfo.php?cid=<?php echo$result[$i]['g_id']?>">修改</a></td>
                                  <td class="nones" width="15"><img src="/Manage/temp/images/edit.gif"/></td>
                                  <td class="nones" width="30"><a href="javascript:if(confirm('確定刪除嗎？')){location.href= 'newsInfo.php?delid=<?php echo$result[$i]['g_id']?>'}">刪除</a></td>
                               </tr>
                          </table>
						</td>
                	</tr>
                	<?php }}?>
                	<tr>
                		<td colspan="7" class="bj"><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></td>
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