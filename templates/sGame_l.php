<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_9`");
if ($ConfigModel['g_kg_game_lock'] !=1 || $ConfigModel['g_game_9'] !=1)exit(href('right.php'));
$types = '總和、龍虎';
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;




//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 
 $gurl='sGame_l';
 $g = $_GET['g'];
?>
<?php include_once 'inc/top.php';?>
<table class="ths" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="bolds">廣東快樂十分</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys"><?=$types?></span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div></td>
		<td align="left" class="bolds" style="color:#FF0000">
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="n" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
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
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="85"></td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>  

<form id="dp" action="" method="post" target="leftFrame">
<table class="ths" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td >投注类型：</td>
        <td width="100"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="center"><table border="0" width="500" >
                <tr height="30">
					<td id="td_input_money"><table><tr><td>金額</td><td><input type="text"  id="AllMoney"    onkeydown="return IsNumeric()"  class=myAllMoney  value=""  /></td></tr></table></td>
                    <td align="right" style="padding-right:10px"><input type="submit" id="submits1" class="inputs ti" value="確定" /></td>
                    <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
                    <td width="200" ></td>
                </tr>
            </table></td>
    </tr>
</table> 
<input type="hidden" name="actions" value="fn1" />
<input type="hidden" name="gtypes" value="1" />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td width="120">項目</td>
        <td>賠率</td>
        <td width="70" class="je">金額</td>
        <td width="120">項目</td>
        <td>賠率</td>
        <td width="70" class="je">金額</td>
    </tr>
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
    <tr class="t_td_text">
    	<td class="caption_1">總和尾小</td>
        <td class="o" id="h7"></td>
        <td class="tt" id="t7"></td>
        <td class="caption_1">虎</td>
        <td class="o" id="h8"></td>
        <td class="tt" id="t8"></td>
    </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	 <td align="right" style="padding-right:10px"><input type="submit" id="submits" class="inputs ti" value="確定" /></td>
         <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<br />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和尾數大小</a></td>
        <td class="nv_ab" ><a class="nv_a" <?php echo $onclick?>>龍虎</a></td>
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