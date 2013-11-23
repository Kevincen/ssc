<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $ConfigModel, $BakPassWord;

if ($Users[0]['g_login_id'] != 89) exit;

$keywords=$_REQUEST['keywords'];
$payway=$_REQUEST['payway']; 
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
$total = $db->query("select * from g_payrecord where g_name like '%{$keywords}%' {$status_where}", 3); 
$page = new Page($total, $pageNum);
$result = $db->query("select * from g_payrecord where g_name like '%{$keywords}%' {$status_where} order by id  desc ".$page->limit, 1);
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
                                    <td>&nbsp;<?=$payway==0 ? "会员充值记录" : "会员汇款记录"?></td>
									<td>会员账户：<input type="text" name="keywords" value="<?=$keywords?>" /> <input type="radio" value="1" <?=$status==1 ? "checked" : ""?> name="status"/>已支付&nbsp;<input type="radio"  <?=$status==3 ? "checked" : ""?> value="3"  name="status"/>未支付&nbsp; <input type="radio"  <?=$status==4 ? "checked" : ""?> value="4"  name="status"/>全部&nbsp; 时间：<input type="text" name="date1" value="<?=$date1?>" />-<input type="text" name="date2" value="<?=$date2?>" />
									<input type="submit" value="查询" /></td>
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
									<td>支付银行</td>
									<td>订单号</td> 
									<td>金额</td>  
									<td>时间</td> 
									<td>状态</td>  
                                </tr>
                                <?php
								$n = 1;
								$total=0;
                                foreach ($result as $line){
									$total+=$line['Money'];
                                	?>
                                <tr align="center" style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
									 
										<td><?php echo $line['id']?></td> 
										<td style="color:#FF0000; font-weight:bold; background:#FFFFCC"><?php echo $line['g_name']?></td>
										<td style="color:#FF0000; font-weight:bold; background:#FFFFCC"><?php echo $line['BankName']?></td>
										<td><?php echo $line['ordernum']?></td>
										<td><?php echo $line['Money']?></td> 
										<td><?php echo $line['optdt']?></td> 
										<td><?php
										if($line['status']=='3'){
											echo '<font color=blue>未支付</font>';
										}else if($line['status']=='9'){
											echo '<font color=red>支付失败</font>';
										}else if($line['status']=='1'){
											echo '<b>已支付</b>';
										}
										?></td>
                                    
                                </tr> 
								<?php
								}
								?>
								<tr> 
									<td colspan="2"> 合计</td>	
									<td></td>
									<td></td>
									
									 
									<td><?=$total?></td>  
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