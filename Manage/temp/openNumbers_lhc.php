<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $ConfigModel;
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_6'])){
	if ($Users[0]['g_lock_1_6'] !=1) 
		exit(back('您的權限不足！'));
}

$db=new DB();

if ($_GET['actcc']=="删除"){
	mysql_query("Delete from g_kaipan_lhc");
}


if (isset($_GET['delid']) && Matchs::isNumber($_GET['delid']))
{
	$delid = $_GET['delid'];
	$id = $db->query("SELECT g_lock FROM g_kaipan_lhc WHERE g_id = '{$delid}' LIMIT 1 ", 0);
	if ($id)
	{
		$db->query("DELETE FROM g_kaipan_lhc WHERE g_id = '{$delid}' LIMIT 1", 2);
		exit(alert_href('刪除成功', 'openNumbers_lhc.php'));
	}
	else 
	{
		exit(back($delid.' ID 不存在！'));
	}
}
if (isset($_GET['openid']) && Matchs::isNumber($_GET['openid']))
{
	$openid = $_GET['openid'];
	$openids = $db->query("SELECT g_lock FROM g_kaipan_lhc WHERE g_qishu = '{$openid}' LIMIT 1 ", 0);
	if ($openids)
	{
		$db->query("DELETE FROM g_kaipan_lhc WHERE g_qishu < '{$openid}' ", 2);
		$db->query("UPDATE g_kaipan_lhc SET g_lock = 2 WHERE g_qishu = '{$openid}' LIMIT 1 ", 2);
		exit(alert_href('操作成功', 'NumberInclude.php'));
	}
}

?>
<?php 
//修改信息
if ($_POST['act']=="添加") {
	if (empty($_POST['nn'])) {
		 
		echo "<script>alert('期数不能为空!');window.history.go(-1);</script>";
		exit;
	}


	if (empty($_POST['zfbdate1'])){
		echo "<script>alert('自动开盘时间不能为了空!');window.history.go(-1);</script>";
		exit;
	}
	
	$result=mysql_query("select * from g_kaipan_lhc where g_qishu=".$_POST['nn']."  order by g_qishu");
	$row11=mysql_fetch_array($result);
	if ($row11!=""){
		echo "<script>alert('对不起！这一“期”已被开过，请重新输入!');window.history.go(-1);</script>";
		exit;
	}
	 
	$mm=$_POST['MM'];
	$dd=$_POST['dd']+1;
	
	$zfbdate=date('Y-m-d H:i:s',strtotime($_POST['zfbdatend'])-$mm); 
	$sql="INSERT INTO  g_kaipan_lhc set g_qishu='".$_POST['nn']."',g_kai_date='".$_POST['zfbdate1']."',g_feng_date='".$zfbdate."',g_open_date='".$_POST['zfbdatend']."',g_lock=1 ";
	$exe=mysql_query($sql) or  die("数据库修改出错".$sql);
	
	/*$zfbdatend=$_POST['zfbdatend'];
	$nn=$_POST['nn'];
	for ($B=1;$B<$dd;$B++){
		$nn=$nn+1;
		$zfbdate=date('Y-m-d H:i:s',strtotime($zfbdatend)+(900-$mm));
		$zfbdate1=date('Y-m-d H:i:s',strtotime($zfbdatend));
		$zfbdatend=date('Y-m-d H:i:s',strtotime($zfbdatend)+900);
		if(strtotime($zfbdatend) > mktime('21','30','0',date('m',strtotime($zfbdatend)),date('d',strtotime($zfbdatend)),date('Y',strtotime($zfbdatend))))
		{
			break;
		}
		$sql="INSERT INTO  g_kaipan_lhc set g_qishu='".$nn."',g_kai_date='".$zfbdate1."',g_feng_date='".$zfbdate."',g_open_date='".$zfbdatend."',g_lock=1  ";
		$exe=mysql_query($sql) or  die("数据库修改出错".$sql);
		break;
	}*/
	echo "<script>alert('盘口修改成功!');window.location.href='/manage/temp/openNumbers_lhc.php';</script>";
	exit;
}
$result=mysql_query("select * from g_kaipan_lhc  order by g_qishu desc LIMIT 1");
$row=mysql_fetch_array($result);
$nn=$row['g_qishu']+1;

$zfbdate=$row['g_feng_date'];
$zfbdate=date('Y-m-d H:i:s',strtotime($zfbdate)+600);

$zfbdate1=$row['g_open_date'];
$zfbdate1 = date('Y-m-d H:i:s',strtotime($zfbdate1)+300);

$zfbdatend = $row['g_kai_date'];
$zfbdatend = date('Y-m-d H:i:s',strtotime($zfbdatend)+900);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style2 {color: #ffffff}
.STYLE3 {color: #FF3300}
-->
</style>
<script type="text/javascript">
<!--

	function delNumber(id, sInt){
		var href, lock=false;
		if (sInt == 1){
			if (confirm("警告：沒必要情況下建議不要操作。\n你確定刪除嗎？")){
				href = "?delid=";
				lock =true;
			}
		} else if (sInt == 2) {
			if (confirm("你確定開盤嗎？")){
				href = "?openid=";
				lock =true;
			}
		} else {
			if (confirm("警告：系統將會自動重新加載1-50期，開獎、封盤時間。\n你確定嗎？")){
				href = "?inserid=";
				id = document.getElementById("day").value;
				lock =true;
			}
		}
		if (lock==true)
			location.href = location.href + href +id;
	}
-->
</script>
<SCRIPT>
function SubChk()
{
	
 		if(document.all.testFrm.nn.value=='')
 		{ document.all.testFrm.nn.focus(); alert("期数请务必输入!!"); return false; }
		
		if(document.all.testFrm.dd.value=='')
 		{ document.all.testFrm.dd.focus(); alert("添加期数请务必输入!!"); return false; }
  	
 		if(document.all.testFrm.MM.value=='')
 		{ document.all.testFrm.MM.focus(); alert("提前封盘时间请务必输入!!"); return false; }
 		if(document.all.testFrm.zfbdatend.value=='')
 		{ document.all.testFrm.zfbdatend.focus(); alert("开奖时间请务必输入!!"); return false; }
		if(document.all.testFrm.zfbdate1.value=='')
 		{ document.all.testFrm.zfbdate1.focus(); alert("开盘时间请务必输入!!"); return false; }
 	
		if(!confirm("是否确定修改盘口?")){
  		return false;
 	}
}
</SCRIPT>
</head>
<body>
 
<table width="100%" height="100%" border="0" cellspacing="0" class="a">
  <tr>
    <td width="6" height="99%" bgcolor="#1873aa"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Manage/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="99%">&nbsp;開盤設置--六合彩</td>
              </tr>
            </table></td>
          <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            <table border="0" cellspacing="0" class="conter">
              <tr class="tr_top">
                <th colspan="2">盘口設置</th>
              </tr>
              <form name="testFrm" onSubmit="return SubChk()" method="post"
		action="">
                <tr>
                  <td valign="top"><table width="100%" border="0" >
                      <tr>
                        <td width="11%" height="30" align="right" bordercolor="#CCCCCC"
					bgcolor="#D4E5F4">期数：</td>
                        <td width="27%" bordercolor="#CCCCCC"><input name="nn" type="text"
					class="textc1" id="nn" value="<?=$nn?>" size="15" />
                          <span
					class="STYLE2"> *</span></td>
                        <td align="right" bordercolor="#CCCCCC" bgcolor="#D4E5F4">添加：</td>
                        <td bordercolor="#CCCCCC"><input name="dd" class="textc" id="dd" type="text" size="5" value="1" readonly/>
                          期 <span
					class="STYLE2"> *</span></td>
                      </tr>
                      <tr>
                        <td align="right" bordercolor="#CCCCCC" bgcolor="#D4E5F4">开盘时间：</td>
                        <td bordercolor="#CCCCCC"><input name="zfbdate1" type="text"
					class="textc1" id="zfbdate1" value="<?=$zfbdate1?>" size="35" />
                          <span
					class="STYLE2"> *</span></td>
                        <td height="30" align="right" bordercolor="#CCCCCC"
					bgcolor="#D4E5F4">提前封盘时间：</td>
                        <td bordercolor="#CCCCCC"><INPUT id="MM" class="textc" value=90 size=5 name="MM">
                          秒<SPAN class=STYLE4><SPAN class=style22>（90秒就是在开奖时间前提前一分半封盘！）</SPAN></SPAN><span
					class="STYLE2">*</span></td>
                      </tr>
                      <tr>
                        <td align="right" bordercolor="#CCCCCC" bgcolor="#D4E5F4">开奖时间：</td>
                        <td bordercolor="#CCCCCC"><input name="zfbdatend" type="text"
					class="textc1" id="zfbdatend" value="<?=$zfbdatend?>" size="35" />
                          <span
					class="STYLE2"> *</span></td>
                        <td height="30" align="right" bordercolor="#CCCCCC"
					bgcolor="#D4E5F4">&nbsp;</td>
                        <td bordercolor="#CCCCCC"><input type="hidden" id="act" name="act" value="添加" />
                          <input class="button_a" type="submit" name="Submit" value="保存盘口" /></td>
                      </tr>
                      
                    </table></td>
                </tr>
              </form>
              <tr>
                <td><table id="tb"  border="0" align="center"  width="99%">
                    <tr class="tr_top">
                      <td height="28" colspan="7" align="left" nowrap="nowrap" bordercolor="cccccc" bgcolor="#D4E5F4"><input class="button_a" type="button" name="Submit2" value="一键删除" onclick="javascript:location.href='/manage/temp/openNumbers_lhc.php?actcc=删除'" /></td>
                    </tr>
                    <tr class="tr_top">
                      <td width="4%"  align="center" nowrap="nowrap" bordercolor="cccccc" bgcolor="#D4E5F4">序号</td>
                      <td align="center" bordercolor="cccccc" bgcolor="#D4E5F4">期数</td>
                      <td align="center" bordercolor="cccccc" bgcolor="#D4E5F4" class="m_title_reall">开盘时间</td>
                      <td align="center" bordercolor="cccccc" bgcolor="#D4E5F4" class="m_title_reall">封盘时间</td>
                      <td align="center" bordercolor="cccccc" bgcolor="#D4E5F4" class="m_title_reall">开奖时间</td>
                      <td align="center" bordercolor="cccccc" bgcolor="#D4E5F4" class="m_title_reall">状态</td>
                      <td align="center" bordercolor="cccccc" bgcolor="#D4E5F4" class="m_title_reall">操作</td>
                    </tr>
                    <?	
		 $result = mysql_query("SELECT `g_id`, `g_qishu`, `g_feng_date`, `g_open_date`, `g_kai_date`, `g_lock` FROM `g_kaipan_lhc` ORDER BY g_qishu ASC "); 
		 
									if (!$result){echo '<tr><td align="center" colspan="7">暫無記錄</td></tr>';}
                                	else {		 
		   
									$ii=0;
									while($rs = mysql_fetch_array($result)){

									$ii++;

									if ($rs['g_lock'] == 2){
                                		$lock =  '<span class="odds">正在開盤中</span>';
                                		$open = '<span class="red">已開</span>';
                                	} else {
                                		$lock =  '未開盤';
                                		$open ="<a href=\"javascript:void(0)\" onclick=\"delNumber('{$rs['g_qishu']}','2')\">開盤</a>";
                                	}



?>
                    <form action="" method="post" name="form" id="form">
                      <tr >
                        <td  align="center" nowrap="nowrap" bordercolor="cccccc"><?=$ii?></td>
                        <td align="center" nowrap="nowrap" bordercolor="cccccc"><?=$rs['g_qishu']?></td>
                        <td  align="center" nowrap="nowrap" bordercolor="cccccc"><?=$rs['g_kai_date']?></td>
                        <td align="center" nowrap="nowrap" bordercolor="cccccc"><?=$rs['g_feng_date']?></td>
                        <td align="center" nowrap="nowrap" bordercolor="cccccc"><?=$rs['g_open_date']?></td>
                        <td align="center" nowrap="nowrap" bordercolor="cccccc"><?php echo$lock?></td>
                        <td align="center" nowrap="nowrap" bordercolor="cccccc"><input type="hidden" id="id" name="id" value="<?=$rs['g_id']?>" />
                          <input type="hidden" id="save" name="save" value="save" />
                          <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="nones" width="15"><img src="/Manage/temp/images/edit.gif"/></td>
                              <td class="nones" width="30"><?php echo$open?></td>
                              <td class="nones" width="16"><img src="/Manage/temp/images/55.gif" /></td>
                              <td class="nones" width="30"><a href="javascript:void(0)" onclick="delNumber('<?php echo$rs['g_id']?>','1')">刪除</a></td>
                            </tr>
                          </table>
                      </tr>
                    </form>
                    <? 
	  }
	  }?>
                  </table></td>
              </tr>
            </table>
            <!-- end -->
          </td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center"></td>
          <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
        </tr>
      </table></td>
    <td width="6" bgcolor="#1873aa"></td>
  </tr>
  <tr>
    <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_59.gif" alt="" /></td>
    <td bgcolor="#1873aa"></td>
    <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_62.gif" alt="" /></td>
  </tr>
</table>
<br />
</body>
</html>