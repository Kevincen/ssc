<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_10`");
if ($ConfigModel['g_kg_game_lock'] !=1 || $ConfigModel['g_game_10'] !=1)
	exit(href('right.php'));
$types = '連碼';



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
<table class="wq" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
	<tr class="t_list_caption" id="ts"></tr>
    <tr class="t_td_text">
    	<td>任選二<br /><span class="stt o" id="h1"></span></td>
        <td>選二連直<br /><span class="stt o" id="h2"></span></td>
        <td>選二連組<br /><span class="stt o" id="h3"></span></td>
        <td>任選三<br /><span class="stt o" id="h4"></span></td>
        <td>選三前直<br /><span class="stt o" id="h5"></span></td>
        <td>選三前組<br /><span class="stt o" id="h6"></span></td>
        <td>任選四<br /><span class="stt o" id="h7"></span></td>
        <td>任選五<br /><span class="stt o" id="h8"></span></td>
    </tr>
</table>
<table class="wqo" border="0" cellpadding="0" cellspacing="1"  style="margin-top:0px; background:#E9BA84">
	<tr class="t_list_caption">
    	<td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd1">&nbsp;</td>
        <td class="t1 v"><input type="checkbox" style="display:none" name="t[]" id="t1" value="1" /></td>
        <td class="No_gd6">&nbsp;</td>
        <td class="t6 v"><input type="checkbox" style="display:none" name="t[]" id="t6" value="6" /></td>
        <td class="No_gd11">&nbsp;</td>
        <td class="t11 v"><input type="checkbox" style="display:none" name="t[]" id="t11" value="11" /></td>
        <td class="No_gd16">&nbsp;</td>
        <td class="t16 v"><input type="checkbox" style="display:none" name="t[]" id="t16" value="16" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd2">&nbsp;</td>
        <td class="t2 v"><input type="checkbox" style="display:none" name="t[]" id="t2" value="2" /></td>
        <td class="No_gd7">&nbsp;</td>
        <td class="t7 v"><input type="checkbox" style="display:none" name="t[]" id="t7" value="7" /></td>
        <td class="No_gd12">&nbsp;</td>
        <td class="t12 v"><input type="checkbox" style="display:none" name="t[]" id="t12" value="12" /></td>
        <td class="No_gd17">&nbsp;</td>
        <td class="t17 v"><input type="checkbox" style="display:none" name="t[]" id="t17" value="17" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd3">&nbsp;</td>
        <td class="t3 v"><input type="checkbox" style="display:none" name="t[]" id="t3" value="3" /></td>
        <td class="No_gd8">&nbsp;</td>
        <td class="t8 v"><input type="checkbox" style="display:none" name="t[]" id="t8" value="8" /></td>
        <td class="No_gd13">&nbsp;</td>
        <td class="t13 v"><input type="checkbox" style="display:none" name="t[]" id="t13" value="13" /></td>
        <td class="No_gd18">&nbsp;</td>
        <td class="t18 v"><input type="checkbox" style="display:none" name="t[]" id="t18" value="18" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd4">&nbsp;</td>
        <td class="t4 v"><input type="checkbox" style="display:none" name="t[]" id="t4" value="4" /></td>
        <td class="No_gd9">&nbsp;</td>
        <td class="t9 v"><input type="checkbox" style="display:none" name="t[]" id="t9" value="9" /></td>
        <td class="No_gd14">&nbsp;</td>
        <td class="t14 v"><input type="checkbox" style="display:none" name="t[]" id="t14" value="14" /></td>
        <td class="No_gd19">&nbsp;</td>
        <td class="t19 v"><input type="checkbox" style="display:none" name="t[]" id="t19" value="19" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd5">&nbsp;</td>
        <td class="t5 v"><input type="checkbox" style="display:none" name="t[]" id="t5" value="5" /></td>
        <td class="No_gd10">&nbsp;</td>
        <td class="t10 v"><input type="checkbox" style="display:none" name="t[]" id="t10" value="10" /></td>
        <td class="No_gd15">&nbsp;</td>
        <td class="t15 v"><input type="checkbox" style="display:none" name="t[]" id="t15" value="15" /></td>
        <td class="No_gd20">&nbsp;</td>
        <td class="t20 v"><input type="checkbox" style="display:none" name="t[]" id="t20" value="20" /></td>
    </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" disabled="disabled" class="inputq qw" id="rn" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" disabled="disabled" class="inputq qw" id="sub" value="下註" /></td>
    </tr>
</table>
</form>
<?php $db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>