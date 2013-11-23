<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(back($UserOut));
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$qtype = $_POST['qtype'];
	$s_pan = $_POST['s_pan'];
	$M_Content = $_POST['M_Content'];
	$title=$qtype.'--'.$s_pan;
	$name=$user[0]['g_name'];
	$nid=$user[0]['g_nid'];
	$loginid=$user[0]['g_login_id'];
	$db = new DB();
	if( $_POST['M_Content'] !=null){
	$sql = "insert into g_cfzx(g_title,g_content,g_addtime,g_nid,g_name,g_login_id) values('$title','$M_Content',now(),'$nid','$name',{$loginid}) ";
	if ($db->query($sql, 2))
	{
		alert_href("留言已提交", "kfzx.php");
		exit;
	}
	}else{
		alert_href("請輸入內容", "kfzx.php");
		exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript"> 
<!--
	function go(){
		if (document.getElementById("M_Content").value == ""){
			alert("請輸入內容");
			return false;
		}
		if (confirm("確定嗎？"))
			return true;
		else
			return false;
	}
//-->
</script>
</head>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<body>
 
<form action="" method="post" onsubmit="return go()">
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="800">
        <tr>
            <td class="t_list_caption" colspan="2">發佈留言</td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="160">類別</td>
            <td class="t_td_text" width="530"><select id="qtype" name="qtype">
              <option value="系統問題">系統問題</option>
              <option value="賬務問題">賬務問題</option>
              <option value="客戶建議">客戶建議</option>
              <option value="其他">其他</option>
            </select>
            </td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="160">問題</td>
            <td class="t_td_text">
			
			 <input type="radio" value="網速過慢" name="s_pan" checked="checked" />網速過慢&nbsp;
             <input type="radio" value="無法登入" name="s_pan" />無法登入&nbsp;
             <input type="radio" value="賠率問題" name="s_pan" />賠率問題&nbsp;
			 <input type="radio" value="無法下注" name="s_pan" />無法下注&nbsp;
             <input type="radio" value="網頁無法開啟" name="s_pan" />網頁無法開啟&nbsp;
             <input type="radio" value="開獎結果錯誤" name="s_pan" />開獎結果錯誤&nbsp;
			
			
			
			</td>
        </tr>
        <tr style="height:28px">
            <td  style="text-align:right" class="t_td_caption_1" width="160">內容</td>
            <td class="t_td_text"><textarea name="M_Content" cols="100" rows="5" id="M_Content" style=" margin-left:3px;border:1px #0099CC solid; background:#F3F3F3;"></textarea></td>
        </tr>
        <tr>
        	<td colspan="2" align="center" class="textcc"><input type="submit" class="inputs" value="  確認" /></td>
        </tr>
</table>
<br />
<table border="0" cellpadding="0" cellspacing="1" class="t_list">
        <tr class="t_list_caption_1">
			<td width="150">留言標題</td>
            <td width="252">留言內容</td>
            <td width="270">回覆內容</td>
            <td width="161">留言時間</td>
            <td width="157">回覆時間</td>
        </tr>
		
		<?php    
		$sql = "select * from g_cfzx where g_name='{$user[0]['g_name']}' order by g_id desc ";
		$result=$db->query($sql, 3);
		$pageNum = 10;
		$page = new Page($result, $pageNum);
		$sql = "select * from g_cfzx where g_name='{$user[0]['g_name']}'  order by g_id desc  {$page->limit} ";
		if ($result=$db->query($sql, 1))
		{
		
			for($i=0;$i<count($result);$i++){
		?>
		                                 <tr class="t_td_text" align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo $result[$i]['g_title']?></td>
                                    <td><?php echo $result[$i]['g_content']?></td>
                                    <td><?php echo $result[$i]['g_answer']?></td>
                                    <td><?php echo $result[$i]['g_addtime']?></td>
									<td><?php echo $result[$i]['g_anstime']?></td>
                                </tr>
			<?php
			}
		}
		?>
                                        <tr class="t_list_caption_1">
        	<td colspan="5" align="right"><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></td>
        </tr>
</table>
</form>
 
</body>
</html>