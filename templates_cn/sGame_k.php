<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_10`");
if ($ConfigModel['g_kg_game_lock'] !=1 || $ConfigModel['g_game_10'] !=1)
	exit(href('right.php'));
$types = '连码';

//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 
 $gurl='sGame_k';
 
 $g = $_GET['g'];
?>
<?php include_once 'inc/top.php';?>
<?php include_once 'inc/file.php';?>
<form id="lm" action="" method="post" target="leftFrame">
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:5px">
    <tr style="text-align:center;" class="smallo">
      <td style="border-bottom:none;"><span id="tt1" style="display:none"><input type="radio" onclick="cRadio(this)" name="gg" value="t1" /></span>任选二<span class="o" id="h1" style="display:block"></span></td>
      <td style="border-bottom:none; border-top-color:#FFF;">&nbsp;</td>
      <td style="border-bottom:none;"><span id="tt3" style="display:none"><input type="radio" onclick="cRadio(this)" name="gg" value="t3" /></span>选二连组<span class="o" id="h3" style="display:block"></span></td>
      <td style="border-bottom:none; border-top-color:#FFF;">&nbsp;</td>
      <td style="border-bottom:none;"><span id="tt4" style="display:none"><input type="radio" onclick="cRadio(this)" name="gg" value="t4" /></span>任选三<span class="o" id="h4" style="display:block"></span></td>   
      <td style="border-bottom:none; border-top-color:#FFF;">&nbsp;</td>
      <td style="border-bottom:none;"><span id="tt6" style="display:none"><input type="radio" onclick="cRadio(this)" name="gg" value="t6" /></span>选三前组<span class="o" id="h6" style="display:block"></span></td>
      <td style="border-bottom:none; border-top-color:#FFF;">&nbsp;</td>
      <td style="border-bottom:none;"><span id="tt7" style="display:none"><input type="radio" onclick="cRadio(this)" name="gg" value="t7" /></span>任选四<span class="o" id="h7" style="display:block"></span></td>
      <td style="border-bottom:none; border-top-color:#FFF;">&nbsp;</td>
      <td style="border-bottom:none;"><span id="tt8" style="display:none"><input type="radio" onclick="cRadio(this)" name="gg" value="t8" /></span>任选五<span class="o" id="h8" style="display:block"></span></td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="1"  style="margin-top:0px; background:#E9BA84">
	<tr class="t_list_caption">
    	<td>号</td>
        <td>勾选</td>
        <td>号</td>
        <td>勾选</td>
        <td>号</td>
        <td>勾选</td>
        <td>号</td>
        <td>勾选</td>
    </tr>
    <tr class="t_td_text">
    	<td><span class="No_gd1">&nbsp;</span></td>
        <td class="t1 v"><input type="checkbox" style="display:none" name="t[]" id="t1" value="1" /></td>
        <td><span class="No_gd6">&nbsp;</span></td>
        <td class="t6 v"><input type="checkbox" style="display:none" name="t[]" id="t6" value="6" /></td>
        <td><span class="No_gd11">&nbsp;</span></td>
        <td class="t11 v"><input type="checkbox" style="display:none" name="t[]" id="t11" value="11" /></td>
        <td><span class="No_gd16">&nbsp;</span></td>
        <td class="t16 v"><input type="checkbox" style="display:none" name="t[]" id="t16" value="16" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><span class="No_gd2">&nbsp;</span></td>
        <td class="t2 v"><input type="checkbox" style="display:none" name="t[]" id="t2" value="2" /></td>
        <td><span class="No_gd7">&nbsp;</span></td>
        <td class="t7 v"><input type="checkbox" style="display:none" name="t[]" id="t7" value="7" /></td>
        <td><span class="No_gd12">&nbsp;</span></td>
        <td class="t12 v"><input type="checkbox" style="display:none" name="t[]" id="t12" value="12" /></td>
        <td><span class="No_gd17">&nbsp;</span></td>
        <td class="t17 v"><input type="checkbox" style="display:none" name="t[]" id="t17" value="17" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><span class="No_gd3">&nbsp;</span></td>
        <td class="t3 v"><input type="checkbox" style="display:none" name="t[]" id="t3" value="3" /></td>
        <td><span class="No_gd8">&nbsp;</span></td>
        <td class="t8 v"><input type="checkbox" style="display:none" name="t[]" id="t8" value="8" /></td>
        <td><span class="No_gd13">&nbsp;</span></td>
        <td class="t13 v"><input type="checkbox" style="display:none" name="t[]" id="t13" value="13" /></td>
        <td><span class="No_gd18">&nbsp;</span></td>
        <td class="t18 v"><input type="checkbox" style="display:none" name="t[]" id="t18" value="18" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><span class="No_gd4">&nbsp;</span></td>
        <td class="t4 v"><input type="checkbox" style="display:none" name="t[]" id="t4" value="4" /></td>
        <td><span class="No_gd9">&nbsp;</span></td>
        <td class="t9 v"><input type="checkbox" style="display:none" name="t[]" id="t9" value="9" /></td>
        <td><span class="No_gd14">&nbsp;</span></td>
        <td class="t14 v"><input type="checkbox" style="display:none" name="t[]" id="t14" value="14" /></td>
        <td><span class="No_gd19">&nbsp;</span></td>
        <td class="t19 v"><input type="checkbox" style="display:none" name="t[]" id="t19" value="19" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><span class="No_gd5">&nbsp;</span></td>
        <td class="t5 v"><input type="checkbox" style="display:none" name="t[]" id="t5" value="5" /></td>
        <td><span class="No_gd10">&nbsp;</span></td>
        <td class="t10 v"><input type="checkbox" style="display:none" name="t[]" id="t10" value="10" /></td>
        <td><span class="No_gd15">&nbsp;</span></td>
        <td class="t15 v"><input type="checkbox" style="display:none" name="t[]" id="t15" value="15" /></td>
        <td><span class="No_gd20">&nbsp;</span></td>
        <td class="t20 v"><input type="checkbox" style="display:none" name="t[]" id="t20" value="20" /></td>
    </tr>
</table>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
	<tr>
    	<td colspan="3"><b class="red">*</b>最多可选择&nbsp;<span class="red">10</span> 个号码
         <span> 已经选中<span id="selectedlist" class="red" style="font-size:14px;">11&nbsp;12&nbsp;14&nbsp;15</span> 共 <span id="selectedAmount" class="red" style="font-size:14px;">6</span> 注 （功能未做）</span>
        </td>
    </tr>
    <tr>
        <td width="65" class="tz_title" valign="top">&nbsp;</td>
        <td width="150">&nbsp;</td>
        <td align="left">
        	<table border="0" width="378" style="margin-top:10px;">
                <tr height="26">
					<td align="center">
                    	<span><font class="tz_title">金额</font>&nbsp;<input type="text"  id="AllMoney"  onkeydown="return IsNumeric()"  class="myAllMoney"  value="功能未做" style="width:90px;"  /></span>
                        <input type="submit" id="sub" disabled="disabled" class="inputs ti qw" value="确定" />
                        <input type="button" id="rn" disabled="disabled" class="inputs ti qw" value="重置" />
                    </td>                   
                </tr>
            </table>
         </td>
    </tr>	
</table>
</form>
<div class="blank10">&nbsp;</div>
<?php include_once 'inc/cl_file.php';?>
<?php 
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$name}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>