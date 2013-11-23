<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $ConfigModel, $BakPassWord;

if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_7'])){
	if ($Users[0]['g_lock_1_7'] !=1) 
		exit(back('您的權限不足！'));
}
if($_REQUEST['act']=='confirm'){ 
	$db->query("UPDATE g_tixian set status=1 where id=".$_REQUEST['id'],0);
	header("Location:tixian.php");
	exit;
}
if($_REQUEST['act']=='fei'){ 
	$res=$db->query("select * from g_tixian where id=".$_REQUEST['id'],1);
	$money=$res[0]['Money'];
	$user=$db->query("select * from g_user where g_name='".$res[0]['g_name']."'",1);
	$db->query("UPDATE g_user SET g_money_yes=g_money_yes+$money where g_name='".$res[0]['g_name']."'",0);
	$db->query("UPDATE g_tixian set status=9 where id=".$_REQUEST['id'],0);
	
		$valueList = array();
		$valueList['g_name'] = $user[0]['g_name'];
		$valueList['g_f_name'] = $_SESSION['sName'];
		$valueList['g_initial_value'] = $user[0]['g_money_yes'];
		$valueList['g_up_value'] = $user[0]['g_money_yes']+$money;
		$valueList['g_up_type'] = '提现恢复';
		$valueList['g_s_id'] = 1;
		insertLogValue($valueList);
		
	header("Location:tixian.php");
	exit;
}


$keywords=$_REQUEST['keywords']; 
$status =$_REQUEST['status'];
$date1 =$_REQUEST['date1'];
$date2 =$_REQUEST['date2'];
if($status==""){
	$status="1"; 
}
if($date1==""){
	$date1=date("Y-m-d");
}
if($date2==""){
	$date2=date("Y-m-d");
}
if($status==4){
	$status_where="";
}else{
	$status_where=" and status='$status'";
}
$status_where.=" and optdt>='".$date1." 00:00:00' And optdt<='".$date2." 23:59:59'";

$pageNum = 15;
$total = $db->query("select * from g_tixian  where g_name like '%{$keywords}%' {$status_where} ", 3); 
$page = new Page($total, $pageNum);
$result = $db->query("select * from g_tixian  where g_name like '%{$keywords}%' {$status_where}  order by id desc ".$page->limit, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script> 
<title></title>
</head>
<body>
<form action="" method="post" onsubmit="return dataBakPost()">
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
                                    <td  >&nbsp;会员提现记录</td>
									<td>会员账户：<input type="text" name="keywords" value="<?=$keywords?>" /> <input type="radio" value="1" <?=$status==1 ? "checked" : ""?> name="status"/>已处理&nbsp;<input type="radio"  <?=$status==3 ? "checked" : ""?> value="3"  name="status"/>未处理&nbsp; <input type="radio"  <?=$status==4 ? "checked" : ""?> value="4"  name="status"/>全部&nbsp; 时间：<input type="text" name="date1" value="<?=$date1?>" />-<input type="text" name="date2" value="<?=$date2?>" />
									<input type="submit" value="查询" />
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
									 
									<td width="45">序號</td>
                                    <td>会员</td>	
									<td>金额</td>
									<td>银行</td> 
									<td>姓名</td>
									<td>账号</td> 
									<td>订单号</td> 
									<td>时间</td> 
									<td>状态</td> 
									<td>操作</td>	
									 
                                </tr>
                                <?php
								 $total=0;
                                foreach ($result as $line){
									$total+=$line['Money'];
                                	?>
                                <tr align="center" style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
									 
										<td><?php echo $line['id']?></td>
										<td><?php echo $line['g_name']?></td>
										<td style="color:#FF0000; font-weight:bold; background:#FFFFCC"><?php echo $line['Money']?></td>
										<td><?php echo $line['BankName']?></td>
										<td><?php echo $line['v_Name']?></td>
										<td><?php echo $line['BankNumber']?></td>
										<td><?php echo $line['ordernum']?></td>
										<td><?php echo $line['optdt']?></td> 
									 
									<td><?php
									if($line['status']=='3'){
										echo '<font color=blue>未处理</font>';
									}else if($line['status']=='9'){
										echo '<font color=red>已恢复</font>';
									}else if($line['status']=='1'){
										echo '<b>已处理</b>';
									}
									?></td>
                                    <td>
										<? if ($line['status']=='3'){?>
											<a href="?id=<?=$line['id']?>&act=confirm&payway=<?=$payway?>" onclick="return confirm('请确认？')">确认提现</a>
											<a href="?id=<?=$line['id']?>&act=fei&payway=<?=$payway?>" onclick="return confirm('请确认？')">恢复</a>
										<?php
										} 
										?>
									</td>
                                </tr> 
								<?php
								}
								?>
								<tr>
									<td colspan="2">总计</td> 
									<td><?=$total?></td>
									<td> </td> 
									<td> </td>
									<td> </td> 
									<td> </td> 
									<td> </td> 
									<td> </td> 
									<td> </td>	
								</tr>
                            </table>
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
    </form>
<div id="oddsPops" style="position:absolute;width:190px;display:none">

</div>
</body>
</html>