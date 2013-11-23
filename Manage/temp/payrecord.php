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
$payway=$_REQUEST['payway']; 
if($_REQUEST['act']=='confirm'){
	$res=$db->query("select * from g_payrecord where id=".$_REQUEST['id'],1);
	$money=$res[0]['Money'];
	$db->query("UPDATE g_user SET g_money_yes=g_money_yes+$money where g_name='".$res[0]['g_name']."'",0);
	$db->query("UPDATE g_payrecord set status=1 where id=".$_REQUEST['id'],0);
	header("Location:payrecord.php?payway=$payway");
	exit;
}
if($_REQUEST['act']=='fei'){ 
	$db->query("UPDATE g_payrecord set status=9 where id=".$_REQUEST['id'],0);
	header("Location:payrecord.php?payway=$payway");
	exit;
}
if($_REQUEST['act']=='del'){ 
	$db->query("delete from g_payrecord  where id=".$_REQUEST['id'],0);
	header("Location:payrecord.php?payway=$payway");
	exit;
}
$pageNum = 15;
$total = $db->query("select * from g_payrecord where PayWay=$payway", 3); 
$page = new Page($total, $pageNum);
$result = $db->query("select * from g_payrecord where PayWay=$payway order by id  desc ".$page->limit, 1);
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
                                    <td width="99%">&nbsp;<?=$payway==0 ? "会员充值记录" : "会员汇款记录"?></td>
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
									<?php
									if($payway==0){
									?>
									<td width="45">序號</td>
                                    <td>会员</td>	
									<td>收款银行</td>
									<td>订单号</td> 
									<td>金额</td> 
									<td>验证码</td> 
									<td>时间</td> 
									<td>状态</td> 
									<td>操作</td>	
									<?php
									}else{
									?>
									<td width="45">序號</td>
                                    <td>会员</td>	
									<td>汇款银行</td>
									<td>流水号</td> 
									<td>提交时间</td> 
									<td>汇款金额</td> 
									<td>汇款方式</td> 
									<td>汇款地点</td> 
									<td>备注</td> 
									<td>状态</td> 
									<td>操作</td>	
									<?php
									}
									?>
                                </tr>
                                <?php
								$n = 1;
                                foreach ($result as $line){
                                	?>
                                <tr align="center" style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
									<?php if($payway==1){?>
										<td><?php echo $line['id']?></td>
										<td><?php echo $line['g_name']?></td>
										<td style="color:#FF0000; font-weight:bold; background:#FFFFCC"><?php echo $line['BankName']?></td>
										<td><?php echo $line['ordernum']?></td>
										<td><?php echo $line['optdt']?></td>
										<td><?php echo $line['Money']?></td>
										<td><?php echo $line['InType']?>/<?php echo $line['v_Name']?></td>
										<td><?php echo $line['v_site']?></td>
										<td><?php echo $line['v_remark']?></td> 
									<?php
									}else{
									?>
										<td><?php echo $line['id']?></td> 
										<td style="color:#FF0000; font-weight:bold; background:#FFFFCC"><?php echo $line['BankName']?></td>
										<td><?php echo $line['ordernum']?></td>
										<td><?php echo $line['Money']?></td>
										<td style="color:#FF0000; font-weight:bold; background:#FFFFCC"><?php echo $line['v_code']?></td>
										<td><?php echo $line['optdt']?></td>
									<?php
									}
									?>
									<td><?php
									if($line['status']=='3'){
										echo '<font color=blue>未处理</font>';
									}else if($line['status']=='9'){
										echo '<font color=red>已作废</font>';
									}else if($line['status']=='1'){
										echo '<b>已处理</b>';
									}
									?></td>
                                    <td>
										<? if ($line['status']=='3'){?>
											<a href="?id=<?=$line['id']?>&act=confirm&payway=<?=$payway?>" onclick="return confirm('请确认？')">确认存入</a>
											<a href="?id=<?=$line['id']?>&act=fei&payway=<?=$payway?>" onclick="return confirm('请确认？')">作废</a>
										<?php
										}
										if ($line['status']=='3' || $line['status']==9){
										?>
										<a href="?id=<?=$line['id']?>&act=del&payway=<?=$payway?>" onclick="return confirm('请确认？')">删除</a>
										<?php
										}
										?>
									</td>
                                </tr> 
								<?php
								}
								?>
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