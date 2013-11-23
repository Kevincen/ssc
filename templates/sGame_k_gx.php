<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_gx_game_lock`, `g_game_gx_10`");
if ($ConfigModel['g_gx_game_lock'] !=1 || $ConfigModel['g_game_gx_10'] !=1)
	exit(href('right.php'));
$types = '連碼';



//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 
 $gurl='sGame_k_gx';
 
 $g = $_GET['g'];
?>
<?php include_once 'inc/top_gx.php';?>
<?php include_once 'inc/file_gx.php';?>
<form id="lm" action="" method="post" target="leftFrame">
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" id="ts"></tr>
    <tr class="t_td_text">
    	<td>一中一<br /><span class="stt o" id="h1"></span></td>
        <td>二中二<br /><span class="stt o" id="h3"></span></td>
        <td>三中二<br /><span class="stt o" id="h4"></span></td>
        <td>三中三<br /><span class="stt o" id="h6"></span></td>
        <td>四中三<br /><span class="stt o" id="h7"></span></td>
        <td>五中三<br /><span class="stt o" id="h8"></span></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gx1"></td>
        <td class="t1 v"><input type="checkbox" style="display:none" name="t[]" id="t1" value="1" /></td>
         <td class="No_gx8"></td>
        <td class="t8 v"><input type="checkbox" style="display:none" name="t[]" id="t8" value="8" /></td>
        <td class="No_gx15"></td>
        <td class="t15 v"><input type="checkbox" style="display:none" name="t[]" id="t15" value="15" /></td>
       
    </tr>
    <tr class="t_td_text">
    	<td class="No_gx2"></td>
        <td class="t2 v"><input type="checkbox" style="display:none" name="t[]" id="t2" value="2" /></td>
        <td class="No_gx9"></td>
        <td class="t9 v"><input type="checkbox" style="display:none" name="t[]" id="t9" value="9" /></td>
        <td class="No_gx16"></td>
        <td class="t16 v"><input type="checkbox" style="display:none" name="t[]" id="t16" value="16" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gx3"></td>
        <td class="t3 v"><input type="checkbox" style="display:none" name="t[]" id="t3" value="3" /></td>
          <td class="No_gx10"></td>
        <td class="t10 v"><input type="checkbox" style="display:none" name="t[]" id="t10" value="10" /></td>
         <td class="No_gx17"></td>
        <td class="t17 v"><input type="checkbox" style="display:none" name="t[]" id="t17" value="17" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gx4"></td>
        <td class="t4 v"><input type="checkbox" style="display:none" name="t[]" id="t4" value="4" /></td>
    	 <td class="No_gx11"></td>
        <td class="t11 v"><input type="checkbox" style="display:none" name="t[]" id="t11" value="11" /></td>
       <td class="No_gx18"></td>
        <td class="t18 v"><input type="checkbox" style="display:none" name="t[]" id="t18" value="18" /></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gx5"></td>
        <td class="t5 v"><input type="checkbox" style="display:none" name="t[]" id="t5" value="5" /></td>
        <td class="No_gx12"></td>
        <td class="t12 v"><input type="checkbox" style="display:none" name="t[]" id="t12" value="12" /></td>
        <td class="No_gx19"></td>
        <td class="t19 v"><input type="checkbox" style="display:none" name="t[]" id="t19" value="19" /></td>
    </tr>
	
	<tr class="t_td_text">
	<td class="No_gx6"></td>
        <td class="t6 v"><input type="checkbox" style="display:none" name="t[]" id="t6" value="6" /></td>
		<td class="No_gx13"></td>
        <td class="t13 v"><input type="checkbox" style="display:none" name="t[]" id="t13" value="13" /></td>
		<td class="No_gx20"></td>
        <td class="t20 v"><input type="checkbox" style="display:none" name="t[]" id="t20" value="20" /></td>
	</tr>
	
	  <tr class="t_td_text">
	   <td class="No_gx7"></td>
        <td class="t7 v"><input type="checkbox" style="display:none" name="t[]" id="t7" value="7" /></td>
		 <td class="No_gx14"></td>
        <td class="t14 v"><input type="checkbox" style="display:none" name="t[]" id="t14" value="14" /></td>
		<td class="No_gx21"></td>
        <td class="t21 v"><input type="checkbox" style="display:none" name="t[]" id="t21" value="21" /></td>
	  </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" disabled="disabled" class="inputq qw" id="rn" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" disabled="disabled" class="inputq qw" id="sub" value="下註" /></td>
    </tr>
	
	
</table>
</form>
<?php include_once 'inc/cl_file.php';?>
<?php $db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>