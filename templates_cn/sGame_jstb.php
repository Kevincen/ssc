<?php 
error_reporting(E_ALL^E_NOTICE);
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamejsk3.php';
$ConfigModel = configModel("`g_jsk3_game_lock`, `g_mix_money`");
if ($ConfigModel['g_jsk3_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;
$_SESSION['cq'] = false;
$_SESSION['jsk3'] = true;
$_SESSION['pk'] = false;
$_SESSION['gd'] = false;
$_SESSION['nc'] = false;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 


$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGame_jsk3.js"></script>
<title></title>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
		if (s !== "left.php")
			window.parent.frames.leftFrame.location.href = "/templates/left.php";
			
			function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
<style type="text/css">
div#row1 { float: left;  }
div#row2 { }
</style>
</head>
<body>
<div style="display:none">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "%68%6D%2E%62%61%69%64%75%2E%63%6F%6D/h.js%3F9898c9fdab97319b23cd83299998e52e' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
<input type="hidden" id="hiden" value="<?php echo $g?>" />
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="105" height="20" class="bolds">江苏骰寶(快3)</td>
        <td colspan="2" class="bolds" style="color:red"> <div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span></div><div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td class="bolds" style="color:red" align="right"></td>
      <td align="right"><img id='soundbut' src="images/soundon.png" width="27" height="19" value='on' onclick="soundset(this);"  title="开奖音开关"/></td>
        <td align="right"  colspan="4">
        			<td class="bolds" width="146" align="left">
			        	<span id="number" style="position:relative;"></span>期開獎</td>
			        <td id="a" class="l"></td>
			        <td id="b" class="l"></td>
			        <td id="c" class="l"></td> 
	</tr>
</table>
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
    <tr>
    	<td height="30" width="125px" ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="90"><span style="color:#0033FF; font-weight:bold" id="tys"><?php echo$types?></span></td>
        <td width="60"><form id="form1" name="form1" method="post" action="">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			window.parent.frames.mainFrame.location.href = "sGame_jstb.php?g=<?php echo$g?>&abc="+sel.value;
			}
			
			</script>
           </label>
      </form></td>
        <td width="180">距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="4">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td width="75" align="right" style="position:relative;top:-1px;"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td colspan="12">三軍【賠率說明：一同骰=(賠率-1)x1、二同骰=(賠率-1)x2、三同骰=(賠率-1)x3】、大小</td>
    </tr>
   <tr class="t_td_text">
    	<td class="NO_JS_1 caption_1 ah1" width="27"></td>
    	<td class="o" width="60" id="ah1"></td>
    	<td class="loads" id="Ball_1Nah1" width="75"></td>
		
    	<td class="NO_JS_2 caption_1 ah2" width="27"></td>
    	<td class="o" width="60" id="ah2"></td>
    	<td class="loads" id="Ball_1Nah2" width="75"></td>
		
    	<td class="NO_JS_3 caption_1 ah3" width="27"></td>
    	<td class="o" width="60" id="ah3"></td>
    	<td class="loads" id="Ball_1Nah3" width="75"></td>
		
    	<td class="caption_1 ah7" width="27">大</td>
    	<td class="o" width="60" id="ah7"></td>
    	<td class="loads" id="Ball_1Nah7" width="75"></td>
		
    	 
    </tr>
    <tr class="t_td_text">
    	<td class="NO_JS_4 caption_1 ah4" width="27"></td>
    	<td class="o"  id="ah4" width="60"></td>
    	<td class="loads" id="Ball_1Nah4" width="75"></td>
		
    	<td class="NO_JS_5 caption_1 ah5" width="27"></td>
    	<td class="o"  id="ah5" width="60"></td>
    	<td class="loads" id="Ball_1Nah5" width="75"></td>
		
    	<td class="NO_JS_6 caption_1 ah6" width="27"></td>
    	<td class="o"  id="ah6" width="60"></td>
    	<td class="loads" id="Ball_1Nah6" width="75"></td>
		
    	<td class="caption_1 ah8" width="27">小</td>
    	<td class="o"  id="ah8" width="60"></td>
    	<td class="loads" id="Ball_1Nah8" width="75"></td> 
		
    </tr>
</table>

<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td colspan="12">圍骰、全骰</td>
    </tr>
   <tr class="t_td_text">
    	<td class="caption_1 bh1" width="84"><div class="NO_JS_1"></div><div class="NO_JS_1"></div><div class="NO_JS_1"></div></td>
    	<td class="o" width="60" id="bh1"></td>
    	<td class="loads" id="Ball_2Nbh1"></td>
		
    	<td class="caption_1 bh2" width="84"><div class="NO_JS_2"></div><div class="NO_JS_2"></div><div class="NO_JS_2"></div></td>
    	<td class="o" width="60" id="bh2"></td>
    	<td class="loads" id="Ball_2Nbh2"></td>
		
		<td class="caption_1 bh3" width="84"><div class="NO_JS_3"></div><div class="NO_JS_3"></div><div class="NO_JS_3"></div></td>
    	<td class="o" width="60" id="bh3"></td>
    	<td class="loads" id="Ball_2Nbh3"></td>  
    </tr>
   <tr class="t_td_text">
    	<td class="caption_1 bh4" width="84"><div class="NO_JS_4"></div><div class="NO_JS_4"></div><div class="NO_JS_4"></div></td>
    	<td class="o" width="60" id="bh4"></td>
    	<td class="loads" id="Ball_2Nbh4"></td>
		
    	<td class="caption_1 bh5" width="84"><div class="NO_JS_5"></div><div class="NO_JS_5"></div><div class="NO_JS_5"></div></td>
    	<td class="o" width="60" id="bh5"></td>
    	<td class="loads" id="Ball_2Nbh5"></td>
		
		<td class="caption_1 bh6" width="84"><div class="NO_JS_6"></div><div class="NO_JS_6"></div><div class="NO_JS_6"></div></td>
    	<td class="o" width="60" id="bh6"></td>
    	<td class="loads" id="Ball_2Nbh6"></td>  
    </tr>
	<tr class="t_td_text">
    	<td class="caption_1 bh7" width="84">全骰</td>
    	<td class="o" width="60" id="bh7"></td>
    	<td class="loads" id="Ball_2Nbh7"></td>
		
		<td colspan="6"></td>
	</tr>
</table>


<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td colspan="12">點數</td>
    </tr>
   <tr class="t_td_text">
   		<?php
		$arr = array(4,5,6,7,8,9,10,11,12,13,14,15,16,17);
		for($i=0;$i<count($arr);$i++){
			?>
			<td class="caption_1 ch<?=$i+1?>"><?=$arr[$i]?>點</td>
			<td class="o" width="60" id="ch<?=$i+1?>"></td>
			<td class="loads" id="Ball_3Nch<?=$i+1?>"></td>
			<?php
			if( ($i+1)%4==0 ) echo '<tr class="t_td_text">';
		}
		?>
    	<td  colspan="6" ></td>
    </tr> 
</table>


<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td colspan="12">長牌</td>
    </tr>
   <tr class="t_td_text">
   		<?php
		$arr=array(12,13,14,15,16,23,24,25,26,34,35,36,45,46,56);
		for($i=0;$i<count($arr);$i++){
			?>
			<td class="caption_1 dh<?=$i+1?>" width="56"><div class="NO_JS_<?=substr($arr[$i],0,1)?>"></div><div class="NO_JS_<?=$arr[$i]%10?>"></div></td>
			<td class="o" width="60" id="dh<?=$i+1?>"></td>
			<td class="loads" id="Ball_4Ndh<?=$i+1?>"></td>
			<?php	
			if( ($i+1)%3==0 && $i<count($arr)-1) echo '<tr class="t_td_text">';	
		}
		?> 
    </tr>
</table>

<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td colspan="12">短牌</td>
    </tr>
   <tr class="t_td_text">
   		<?php
		$arr=array(1,2,3,4,5,6);
		for($i=0;$i<count($arr);$i++){
			?>
			<td class="caption_1 eh<?=$i+1?>" width="56"><div class="NO_JS_<?=$arr[$i]?>"></div><div class="NO_JS_<?=$arr[$i]?>"></div></td>
			<td class="o" width="60" id="eh<?=$i+1?>"></td>
			<td class="loads" id="Ball_5Neh<?=$i+1?>"></td>
			<?php	
			if( ($i+1)%3==0 && $i<count($arr)-1) echo '<tr class="t_td_text">';	
		}
		?> 
    </tr>
</table>

 
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" onclick="reset()" class="inputs ti" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" id="submits" class="inputs ti" value="下註" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
 

<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div id="look" style="display:none"></div>
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