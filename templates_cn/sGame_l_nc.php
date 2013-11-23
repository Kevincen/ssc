<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_game_nc_9`");
if ($ConfigModel['g_nc_game_lock'] !=1 || $ConfigModel['g_game_nc_9'] !=1)exit(href('right.php'));
$types = '家禽野兽';
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;




//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 
 $gurl='sGame_l_nc';
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
<form id="dp" action="" method="post" target="leftFrame">
<input type="hidden" name="actions" value="fn1" />
<input type="hidden" name="gtypes" value="1" />
<table class="wq" border="0" cellpadding="0" cellspacing="0">
<tr class="t_list_caption">
<td colspan="6" background="images/jiaq.png">						
	<embed src="images/l.swf" width="100%" height="250" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" quality="High" wmode="transparent"></OBJECT>
</td>
</tr>
	<tr class="t_list_caption">
    	<td width="120">項目</td>
        <td>賠率</td>
        <td>金額</td>
        <td width="120">項目</td>
        <td>賠率</td>
        <td>金額</td>
    </tr>
	<!--
    <tr class="t_td_text">
    	<td class="caption_1">總和大</td>
        <td class="o" id="h1"></td>
        <td class="tt" id="t1"></td>
        <td class="caption_1">總和單</td>
        <td class="o" id="h2"></td>
        <td class="tt" id="t2"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1">總和小</td>
        <td class="o" id="h3"></td>
        <td class="tt" id="t3"></td>
        <td class="caption_1">總和雙</td>
        <td class="o" id="h4"></td>
        <td class="tt" id="t4"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1">總和尾大</td>
        <td class="o" id="h5"></td>
        <td class="tt" id="t5"></td>
        <td class="caption_1">龍</td>
        <td class="o" id="h6"></td>
        <td class="tt" id="t6"></td>
    </tr>
	-->
    <tr class="t_td_text">
    	<td class="caption_1">家禽</td>
        <td class="o" id="h6"></td>
        <td class="tt" id="t6"></td>
        <td class="caption_1">野兽</td>
        <td class="o" id="h8"></td>
        <td class="tt" id="t8"></td>
    </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" onclick="reset()" class="inputs" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" id="submits" class="inputs" value="下註" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<br />
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
        <td><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和尾數大小</a></td>
        <td><a class="nv_a" <?php echo $onclick?>>家禽野兽</a></td>
    </tr>
    <tr>
    	<td colspan="4" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"></tr>
            </table>
        </td>
    </tr>
</table>
<?php include_once 'inc/cl_file.php';?>
<?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>
