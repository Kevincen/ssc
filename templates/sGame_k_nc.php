<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_game_nc_10`");
if ($ConfigModel['g_nc_game_lock'] !=1 || $ConfigModel['g_game_nc_10'] !=1)
	exit(href('right.php'));
$types = '連碼';

$_SESSION['cq'] = false;
$_SESSION['gx'] = false;
$_SESSION['jx'] = false;
$_SESSION['gd'] = false;
$_SESSION['nc'] = true;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 
 $gurl='sGame_k_nc';
 
 $g = $_GET['g'];
?>
<?php include_once 'inc/topnc.php';?>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="width:700px">
    <tr>
        <td class="bolds">幸运农场</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys"><?=$types?></span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
        <td width="32"><div  id="a" class="nc1"></div></td>
        <td width="32"><div  id="b"></div></td>
        <td width="32"><div   id="c"></div></td>
        <td width="32"><div  id="d"></div></td>
        <td width="32"><div   id="e"></div></td>
        <td width="32"><div  id="f"></div></td>
        <td width="32"><div   id="g"></div></td>
        <td width="32"><div   id="h"></div></td>
    </tr>
</table>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="width:700px">
    <tr>
        <td ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="85"></td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="lm" action="" method="post" target="leftFrame">
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" id="ts"></tr>
    <tr class="t_td_text">
    	<td>蔬菜单选<br /><span class="stt o" id="h1"></span></td>
        <td>动物单选<br /><span class="stt o" id="h2"></span></td>
        <td>幸运二<br /><span class="stt o" id="h3"></span></td>
        <td>连连中<br /><span class="stt o" id="h4"></span></td>
        <td>背靠背<br /><span class="stt o" id="h5"></span></td>
        <td>幸运三<br /><span class="stt o" id="h6"></span></td>
        <td>幸运四<br /><span class="stt o" id="h7"></span></td>
        <td>幸运五<br /><span class="stt o" id="h8"></span></td>
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
        <td>號</td>
        <td>勾選</td>
    </tr>
    <tr class="t_td_text">
    	<td><div class="nc1">1</div></td>
        <td class="t1 v"><input type="checkbox" style="display:none" name="t[]" id="t1" value="1" /></td>
        <td><div class="nc6">6</div></td>
        <td class="t6 v"><input type="checkbox" style="display:none" name="t[]" id="t6" value="6" /></td>
        <td><div class="nc11">11</div></td>
        <td class="t11 v"><input type="checkbox" style="display:none" name="t[]" id="t11" value="11" /></td>
        <td><div class="nc16">16</div></td>
        <td class="t16 v"><input type="checkbox" style="display:none" name="t[]" id="t16" value="16" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><div class="nc2">2</div></td>
        <td class="t2 v"><input type="checkbox" style="display:none" name="t[]" id="t2" value="2" /></td>
        <td><div class="nc7">7</div></td>
        <td class="t7 v"><input type="checkbox" style="display:none" name="t[]" id="t7" value="7" /></td>
        <td><div class="nc12">12</div></td>
        <td class="t12 v"><input type="checkbox" style="display:none" name="t[]" id="t12" value="12" /></td>
        <td><div class="nc17">17</div></td>
        <td class="t17 v"><input type="checkbox" style="display:none" name="t[]" id="t17" value="17" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><div class="nc3">3</div></td>
        <td class="t3 v"><input type="checkbox" style="display:none" name="t[]" id="t3" value="3" /></td>
        <td><div class="nc8">8</div></td>
        <td class="t8 v"><input type="checkbox" style="display:none" name="t[]" id="t8" value="8" /></td>
        <td><div class="nc13">13</div></td>
        <td class="t13 v"><input type="checkbox" style="display:none" name="t[]" id="t13" value="13" /></td>
        <td><div class="nc18">18</div></td>
        <td class="t18 v"><input type="checkbox" style="display:none" name="t[]" id="t18" value="18" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><div class="nc4">4</div></td>
        <td class="t4 v"><input type="checkbox" style="display:none" name="t[]" id="t4" value="4" /></td>
        <td><div class="nc9">9</div></td>
        <td class="t9 v"><input type="checkbox" style="display:none" name="t[]" id="t9" value="9" /></td>
        <td><div class="nc14">14</div></td>
        <td class="t14 v"><input type="checkbox" style="display:none" name="t[]" id="t14" value="14" /></td>
        <td><div class="nc19">19</div></td>
        <td class="t19 v"><input type="checkbox" style="display:none" name="t[]" id="t19" value="19" /></td>
    </tr>
    <tr class="t_td_text">
    	<td><div class="nc5">5</div></td>
        <td class="t5 v"><input type="checkbox" style="display:none" name="t[]" id="t5" value="5" /></td>
        <td><div class="nc10">10</div></td>
        <td class="t10 v"><input type="checkbox" style="display:none" name="t[]" id="t10" value="10" /></td>
        <td><div class="nc15">15</div></td>
        <td class="t15 v"><input type="checkbox" style="display:none" name="t[]" id="t15" value="15" /></td>
        <td><div class="nc20">20</div></td>
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
<?php include_once 'inc/cl_file.php';?>
<?php $db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>
