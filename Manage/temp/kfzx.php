<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';

global $Users;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$qtype = $_POST['qtype'];
	$s_pan = $_POST['s_pan'];
	$M_Content = $_POST['M_Content'];
	$title=$qtype.'--'.$s_pan;
	$name=$Users[0]['g_name'];
	$nid=$Users[0]['g_nid'];
	$loginid=$Users[0]['g_login_id'];
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
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/search.js"></script>
<SCRIPT type=text/javascript>
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

	function del(str){
		if (confirm("確定刪除嗎？"))
			location.href = "Message.php?did="+str;
	}
	function reply_Meg(str){
		if (confirm("確定回覆此留言嗎？"))
			location.href = "R_Message.php?mid="+str;
	}
//-->
</SCRIPT>
</HEAD>
<BODY>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<TABLE class=a border=0 cellSpacing=0 width="100%" height="100%">
  <TR>
    <TD bgColor=#1873aa height="99%" width=6></TD>
    <TD class=c><TABLE class=main border=0 cellSpacing=0>
        <TR>
          <TD width=12><IMG alt="" src="/Manage/temp/images/tab_03.gif"></TD>
          <TD background=/Manage/temp/images/tab_05.gif><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TR>
                <TD width=17><IMG src="/Manage/temp/images/tb.gif" width=16 height=16></TD>
                <TD width="99%">&nbsp;留言信息</TD>
              </TR>
            </TABLE></TD>
          <TD width=16><IMG alt="" src="/Manage/temp/images/tab_07.gif"></TD>
        </TR>
        <TR>
          <TD class=t></TD>
          <TD class=c><!-- strat -->
            <FORM onsubmit="return go()" method=post action="">
              <TABLE class=conter border=0 cellSpacing=0>
                <TR class=tr_top>
                  <TH colSpan=5></TH>
                </TR>
                <TR>
                  <TD class=bj>類別</TD>
                  <TD class=left_p6 colSpan=4><SELECT id='qtype' name='qtype'>
                      <OPTION selected value='系統問題'>系統問題</OPTION>
                      <OPTION value='賬務問題'>賬務問題</OPTION>
                      <OPTION value='客戶建議'>客戶建議</OPTION>
                      <OPTION value='其他'>其他</OPTION>
                    </SELECT>
                  </TD>
                </TR>
                <TR>
                  <TD class=bj>問題</TD>
                  <TD class=left_p6 colSpan=4><INPUT value='網速過慢' type='radio' name='s_pan' checked="checked">
                    網速過慢&nbsp;
                    <INPUT value='無法登入' type='radio' name='s_pan'>
                    無法登入&nbsp;
                    <INPUT value='賠率問題' type='radio' name='s_pan'>
                    賠率問題&nbsp;
                    <INPUT value='無法下注' type='radio' name='s_pan'>
                    無法下注&nbsp;
                    <INPUT value='網頁無法開啟' type='radio' name='s_pan'>
                    網頁無法開啟&nbsp;
                    <INPUT value='開獎結果錯誤' type='radio' name='s_pan'>
                    開獎結果錯誤&nbsp; </TD>
                </TR>
                <TR>
                  <TD class=bj>內容</TD>
                  <TD class=left_p6 colSpan=4><TEXTAREA id='M_Content' rows='5' cols='100' name='M_Content'></TEXTAREA></TD>
                </TR>
                <TR>
                  <TD class=bj></TD>
                  <TD class=left_p6 colSpan=4>&nbsp; &nbsp;
                    <INPUT class='inputs' value='確定發佈' type='submit' name='insert'>
                  </TD>
                </TR>
                <TR>
                  <TD colSpan=5><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                      <TR class=tr_top>
                        <TD width="15%">留言用戶</TD>
                        <TD width="15%">留言標題</TD>
                        <TD width="25%">留言內容</TD>
                        <TD width="25%">回覆內容</TD>
                        <TD width="10%">留言時間</TD>
                        <TD width="10%">回覆時間</TD>
                      </TR>
                      <TR>
                        <?php    
		$nid=$Users[0]['g_nid'];
		$sql = "select * from g_cfzx where g_nid like '{$nid}%' order by g_id desc ";
		$result=$db->query($sql, 3);
		$pageNum = 10;
		$page = new Page($result, $pageNum);
		$sql = "select * from g_cfzx where g_nid like '{$nid}%' order by g_id desc  {$page->limit} ";
		if ($result=$db->query($sql, 1))
		{
		
			for($i=0;$i<count($result);$i++){
		?>
                      <tr class="t_td_text" align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
					 	<td><?php
						$logid=$result[$i]['g_login_id'];
						switch($logid)
						{
						case 89:echo "<font color='#FF0000'>后台管理员【{$result[$i]['g_name']}】</font>";break;
						case 56:echo "<font color='#FF0000'>公司【{$result[$i]['g_name']}】</font>";break;
						case 22:echo "<font color='#FF0000'>股东【{$result[$i]['g_name']}】</font>";break;
						case 78:echo "<font color='#FF0000'>总代理【{$result[$i]['g_name']}】</font>";break;
						case 48:echo "<font color='#FF0000'>代理【{$result[$i]['g_name']}】</font>";break;
						case  9:echo "普通會員【{$result[$i]['g_name']}】";break;
						default:break;
						}
						?></td>
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
                    </table></TD>
                </TR>
              </TABLE>
            </FORM>
            <!-- end --></TD>
          <TD class=r></TD>
        </TR>
        <TR>
          <TD width=12><IMG alt="" src="/Manage/temp/images/tab_18.gif"></TD>
          <TD class=f align=right><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></TD>
          <TD width=16><IMG alt="" src="/Manage/temp/images/tab_20.gif"></TD>
        </TR>
      </TABLE></TD>
    <TD bgColor=#1873aa width=6></TD>
  </TR>
  <TR>
    <TD bgColor=#1873aa height=6><IMG alt="" src="/Manage/images/main_59.gif"></TD>
    <TD bgColor=#1873aa></TD>
    <TD bgColor=#1873aa height=6><IMG alt="" src="/Manage/images/main_62.gif"></TD>
  </TR>
</TABLE>
</BODY>
</html>
