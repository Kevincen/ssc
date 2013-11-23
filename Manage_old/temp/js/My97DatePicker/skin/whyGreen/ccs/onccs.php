<?php 
define('Copyright', '作者QQ：1458858574，唯一聯繫電話：15108387926');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/config/global.php';
include_once ROOT_PATH.'Manage/config/config.php';

global $Users, $LoginId;
$gnidr=$Users[0]['g_nid'];
$gnid=$Users[0]['g_nid']."__";

$lid=0;
if(isset($_GET['lid']))
$lid=$_GET['lid'];

$db=new DB();
if($lid==0){
$total1 = $db->query("SELECT g_name,g_count_time,g_out FROM g_user where g_out=1 ", 3);
$total2 = $db->query("SELECT g_name,g_count_time,g_out FROM g_rank where g_out=1 ", 3);
$total3 = $db->query("SELECT * FROM g_relation_user where g_out=1  ", 3);
$total4 = $db->query("SELECT g_name,g_count_time,g_out FROM g_manage where g_out=1 ", 3);
$total=$total1+$total2+$total3+$total4;

$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   (SELECT g_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1   UNION  SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1  UNION  SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_manage where g_out=1   UNION  SELECT g_s_name,g_count_time,g_out,1 as g_ip,0 as g_mumber_type FROM g_relation_user where g_out=1 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==1){
$total2 = $db->query("SELECT g_name,g_count_time,g_out FROM g_rank where g_out=1 ", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type  FROM g_rank where g_out=1  and g_login_id=56 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==2){
$total2 = $db->query("SELECT g_name,g_count_time,g_out FROM g_rank where g_out=1  ", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type  FROM g_rank where g_out=1  and g_login_id=22 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==3){
$total2 = $db->query("SELECT g_name,g_count_time,g_out FROM g_rank where g_out=1  ", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_count_time,g_out,g_ip,g_login_id  as g_mumber_type FROM g_rank where g_out=1  and g_login_id=78 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==4){
$total2 = $db->query("SELECT g_name,g_count_time,g_out FROM g_rank where g_out=1  ", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type FROM g_rank where g_out=1  and g_login_id=48 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==5){
$total1 = $db->query("SELECT g_name,g_count_time,g_out FROM g_user where g_out=1 ", 3);
$total=$total1;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1  ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==7){
$total4 = $db->query("SELECT g_name,g_count_time,g_out FROM g_manage where g_out=1 ", 3);
$total=$total4;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type FROM g_manage  where g_out=1  ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else{
$total3 = $db->query("SELECT * FROM g_relation_user where g_out=1 ", 3);
$total=$total3;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   (  SELECT g_s_name,g_count_time,g_out,1 as g_ip,0 as g_mumber_type FROM g_relation_user where g_out=1  ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);

}

$countma=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_manage  where g_out=1   ",1);
$countuser=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1   ",1);

$countfen=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1  and g_login_id=56 ",1);

$countgu=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1  and g_login_id=22 ",1);

$countzd=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1  and g_login_id=78 ",1);

$countdl=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1  and g_login_id=48 ",1);


$countzzh=$db->query("SELECT g_s_name,g_count_time,g_out,1 as g_ip,0 as g_mumber_type FROM g_relation_user where g_out=1 and g_s_nid like '$gnidr%' ",1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/search.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function showNews(){
		var show = document.getElementById("show");
		if (show.style.display == "none")
			show.style.display = "";
		else 
			show.style.display = "none";
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
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Manage/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="99%">&nbsp;在线人员查看</td>
              </tr>
            </table></td>
          <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            <table border="0" cellspacing="0" class="conter">
              <tr class="tr_top">
                <td colspan="6">
				全部：<a href="online.php?lid=0" ><font color="#FF0000"><?php echo count($countma)+count($countfen)+count($countgu)+count($countzd)+count($countdl)+count($countuser)+count($countzzh);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				 管理员：<a href="online.php?lid=7" ><font color="#FF0000"><?php echo count($countma);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  分公司：<a href="online.php?lid=1" ><font color="#FF0000"><?php echo count($countfen);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  
                  股东：<a href="online.php?lid=2" ><font color="#FF0000"><?php echo count($countgu);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 
                  总代理：<a href="online.php?lid=3" ><font color="#FF0000"><?php echo count($countzd);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 
                  代理： <a href="online.php?lid=4" ><font color="#FF0000"><?php echo count($countdl);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                  会员：<a href="online.php?lid=5" ><font color="#FF0000"><?php echo count($countuser);?></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  子账号：<a href="online.php?lid=6" ><font color="#FF0000"><?php echo count($countzzh);?></font></a> </td>
              </tr>
              <tr class="tr_top">
                <td width="10%">会员名</td>
                <td width="12%">级别</td>
                <td >在线状态</td>
				
                <td width="18%">登陆IP</td>
				
                <td width="15%">刷新时间</td>
                <td width="10%">操作</td>
              </tr>
              <?php if(!$result){echo'<td align="center" colspan="6">你旗下暫無会员在线</td>';}else{
				                	for ($i=0; $i<count($result); $i++){
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if(strtotime(date('Y-m-d H:i:s',time()))-strtotime($result[$i]['g_count_time'])>1800){
									if($result[$i]['g_mumber_type']<10){
									$result1 = $db->query("update g_user  set g_out=0 where g_name='$gname'", 2);
									}
									if($result[$i]['g_mumber_type']>10&&$result[$i]['g_mumber_type']<89){
									$result1 = $db->query("update g_rank  set g_out=0 where g_name='$gname'", 2);
									}
									if($result[$i]['g_mumber_type']>=89)
									$result1 = $db->query("update g_manage  set g_out=0 where g_name='$gname'", 2);
									if($result[$i]['g_mumber_type']==0)
									$result1 = $db->query("update g_relation_user  set g_out=0 where g_s_name='$gname'", 2);
									?>
              <tr style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td align="center"><?php echo $lid!=6? $result[$i]['g_name']:$result[$i]['g_s_name'];?></td>
                <td align="center"><?php 
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股东';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '总代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
								
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股东'.$zizhanghao;break;
									case 78: $zizhanghao='总代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直属会员";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股东'.$zhishu;break;
									case 78: $zhishu='总代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}
									?>
                </td>
                <td class="left_p6">该会员30分钟内没有任何动作，系统定位不在线。</td>
              	
			    <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpLocationApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip']."--".$ip_s?>
                  &nbsp;</td>
				  
                <td class="left_p6" align="center"><?php echo$result[$i]['g_count_time']?></td>
                <td class="left_p6" align="center">系统自动踢出</td>
              </tr>
              <?php 
									}else{
				                	?>
              <tr style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td align="center"><?php echo $lid!=6? $result[$i]['g_name']:$result[$i]['g_s_name'];?></td>
                <td align="center"><?php 
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if($result[$i]['g_mumber_type']==89){
									$lid=0;
									}else{
									if($result[$i]['g_mumber_type']<89&&$result[$i]['g_mumber_type']>9){
									$lid=1;
									}else{
									if($result[$i]['g_mumber_type']<9&&$result[$i]['g_mumber_type']>0)
									$lid=2;
									else
									$lid=3;
									}
									}
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股东';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '总代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股东'.$zizhanghao;break;
									case 78: $zizhanghao='总代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直属会员";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股东'.$zhishu;break;
									case 78: $zhishu='总代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}
									?>
                </td>
                <td class="left_p6">在线</td>
               
				 <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpLocationApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip']."--".$ip_s?>
                  &nbsp;</td>
				 
                <td class="left_p6" align="center"><?php echo$result[$i]['g_count_time']?></td>
                <td class="left_p6" align="center"><a  href="javascript:window.location.reload();" title="踢出系統" class="closepo" src="/Manage/temp/images/USER_1.gif" onclick="closeUser('<?php echo$result[$i]['g_name'] ?>',this,'<?php echo$lid ?>')" >踢出系統</a></td>
              </tr>
              <?php }}}?>
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
      </table></td>
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
