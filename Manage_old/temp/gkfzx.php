<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users;
if ($Users[0]['g_login_id'] != 89) exit;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$gid = $_POST['gid'];
	$M_answer = $_POST['M_answer'];
	
	$db = new DB();
	if( $_POST['M_answer'] !=null){
	$sql = "update  g_cfzx set g_answer='{$M_answer}',g_anstime=now() where g_id='{$gid}' ";
	if ($db->query($sql, 2))
	{
		alert_href("回复已提交", "gkfzx.php");
		exit;
	}
	}else{
		alert_href("請輸入內容", "gkfzx.php");
		exit;
	}
}
if ($_SERVER["REQUEST_METHOD"] == "GET"&&isset($_GET['did']))
{
	$gid = $_GET['did'];
	$db = new DB();
	$sql = "delete from  g_cfzx  where g_id='{$gid}' ";
	if ($db->query($sql, 2))
	{
		alert_href("删除成功", "gkfzx.php");
		exit;
	}else{
		alert_href("删除失败", "gkfzx.php");
		exit;
	}
}
if ($_SERVER["REQUEST_METHOD"] == "GET"&&isset($_GET['delall']))
{
	$delall = $_GET['delall'];
	$db = new DB();
	if($delall==1389){
	$sql = "delete from  g_cfzx ";
	if ($db->query($sql, 2))
	{
		alert_href("删除成功", "gkfzx.php");
		exit;
	}else{
		alert_href("删除失败或者暂无留言信息", "gkfzx.php");
		exit;
	}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "GET"&&isset($_GET['selectId']))
{	
	$Selectid = $_GET['selectId'];
	
	if ($Selectid==0)
	{
		$selectType=" ";
	}else{
		$selectType=$Selectid==1?  " where g_answer is not null or g_answer!='' ":" where g_answer is  null or g_answer='' ";
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
<LINK href="/Manage/temp/js/jqdialog/dialog.css" type=text/css rel=stylesheet>
<SCRIPT src="/Manage/temp/js/jqdialog/dialog.js" type=text/javascript></SCRIPT>
<SCRIPT src="/Manage/temp/js/jqdialog/prettify.js" type=text/javascript></SCRIPT>
<!--[if lte IE 8]>
<SCRIPT src="/Manage/temp/js/jqdialog/html5.js" type=text/javascript></SCRIPT>
<![endif]-->


<SCRIPT type=text/javascript>
<!--
	function go(){
		if (document.getElementById("M_answer").value == ""){
			alert("請輸入內容"+document.getElementById("M_answer"));
			return false;
		}
		if (confirm("確定嗎？"))
			return true;
		else
			return false;
	}

	function del(str){
		if (confirm("確定刪除嗎？"))
			location.href = "gkfzx.php?did="+str;
	}
	
	function delAll(){
		if (confirm("確定全部刪除嗎？"))
			location.href = "gkfzx.php?delall=1389";
	}
	
	function diplaydiv(){
	var answer = $("#answer");
	answer.slideDown(200).css({"display" : "none"});
	}
	
	function locationFile(gid){
	//var answer = $("#answer");
	//var offsetTop = "20%";
	//var offsetLeft = "20%";
	$("#gid").val(gid);
	//answer.slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
	new Dialog({type:'id',value:'answer'}).show();
	}
	
	
	function GoSearch(typeid){
	var selectObj = $("#"+typeid);
	location.href = "gkfzx.php?selectId="+selectObj.val();
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
                <TD width=16><IMG src="/Manage/temp/images/tb.gif" width=16 height=16></TD>
                <TD width="10%">&nbsp;留言信息</TD>
				<td width="50%" align="right">篩選：</td>
                <td width="30%"><select id="Estate" onchange="GoSearch('Estate')" style='cursor: hand'>
                                    	<option value="0" <?php if($_GET['selectId']==0) echo 'selected="selected"';?>>全部</option>
                                        <option value="1" <?php if($_GET['selectId']==1) echo 'selected="selected"';?>>已回覆</option>
                                        <option value="2" <?php if($_GET['selectId']==2) echo 'selected="selected"';?>>未回覆</option>
                                        </select>
               </td>
			   <td width="119" align="right"><a href="javascript:void(0);" onclick="delAll()">全部删除</a></td>
              </TR>
            </TABLE></TD>
          <TD width=16><IMG alt="" src="/Manage/temp/images/tab_07.gif"></TD>
        </TR>
        <TR>
          <TD class=t></TD>
          <TD class=c><!-- strat -->
            <FORM onsubmit="return go()" method=post action="">
              <TABLE class=conter border=0 cellSpacing=0>
                <TR>
                  <TD colSpan=5><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                      <TR class=tr_top>
                        <TD width="10%">留言用戶</TD>
                        <TD width="10%">留言標題</TD>
                        <TD width="22%">留言內容</TD>
                        <TD width="22%">回覆內容</TD>
                        <TD width="10%">留言時間</TD>
                        <TD width="10%">回覆時間</TD>
                        <TD width="13%">操作</TD>
                      </TR>
                      <TR>
                        <?php    
		$sql = "select * from g_cfzx {$selectType} order by g_id desc ";
		$result=$db->query($sql, 3);
		$pageNum = 10;
		$page = new Page($result, $pageNum);
		$sql = "select * from g_cfzx {$selectType} order by g_id desc  {$page->limit} ";
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
                        <td><a href="javascript:void(0);" onclick="locationFile('<?php echo $result[$i]['g_id']?>')">（回覆/修改）</a>|<a href="javascript:void(0);" onclick="del('<?php echo $result[$i]['g_id']?>')">（删除）</a></td>
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

<div  id="answer"  style="display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%" style="float:none" >
    <form action="" method="post" onsubmit="return go()">
	<tr class="text" style="height:35px;text-align:center">
      <td><input type="hidden" id="gid" name="gid" value=""/><TEXTAREA id='M_answer' rows='5' cols='80' name='M_answer'>亲爱的玩家：</TEXTAREA></td>
    </tr>
	<tr class="text" style="height:35px;text-align:center">
      <td><input type="submit" value="提  交"/></td>
    </tr>
	</form>
  </table>
  </div>



</BODY>
</html>
