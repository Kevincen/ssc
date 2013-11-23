<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamecq.php';
$ConfigModel = configModel("`g_cq_game_lock`, `g_mix_money`");
if ($ConfigModel['g_cq_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;

//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 

$_SESSION['cq'] = true;
$_SESSION['nc'] = false;
$_SESSION['jsk3'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = false;
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_sz_cq.js"></script>
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
div#row1 { float: left;}
div#row2 {}
</style>
</head>
<body>
<table class="thsz" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td class="bolds wanfa">重慶時時彩</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys">整合盤</span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
       <td width="27" class="l" id="a">&nbsp;</td>
        <td width="27" class="l" id="b">&nbsp;</td>
        <td width="27" class="l" id="c">&nbsp;</td>
        <td width="27" class="l" id="d">&nbsp;</td>
        <td width="27" class="l" id="e">&nbsp;</td>
    </tr>
</table>
<table class="thsz" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="85">&nbsp;</td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table> 
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<table class="thsz" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td >投注类型：</td>
        <td width="100"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="center"><table border="0" width="500" >
                <tr height="30">
					<td id="td_input_money"><table><tr><td>金額</td><td><input type="text"  id="AllMoney"    onkeydown="return IsNumeric()"  class=myAllMoney  value=""  /></td></tr></table></td>
					 
                    <td align="right" style="padding-right:10px" ><input type="submit" id="submits1" class="inputs ti" value="確定" /></td>
                    <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
                    <td width="150"  ></td>
                </tr>
            </table></td>
    </tr>
</table> 
 
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="wqsz" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000" id="tr_header">
    	<td colspan="3">第一球</td>
    	<td colspan="3">第二球</td>
    	<td colspan="3">第三球</td>
    	<td colspan="3">第四球</td>
		<td colspan="3">第五球</td>
		<td colspan="3">總和、龍虎</td>
   	</tr>
	
	<tr class="t_td_text">
    	<td  class="caption_1">大</td>
    	<td class="o" width="45" id="ah11">&nbsp;</td>
    	<td class="loads" id="Ball_1mah11">&nbsp;</td>
    	<td  class="caption_1">大</td><td class="o" width="45" id="bh11">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh11">&nbsp;</td>
    	<td  class="caption_1">大</td><td class="o" width="45" id="ch11">&nbsp;</td>
    	<td class="loads" id="Ball_3mch11">&nbsp;</td>
    	<td  class="caption_1">大</td><td class="o" width="45" id="dh11">&nbsp;</td>
    	<td class="loads"  id="Ball_4mdh11">&nbsp;</td>
		<td  class="caption_1">大</td><td class="o" width="45" id="eh11">&nbsp;</td>
    	<td class="loads" id="Ball_5meh11">&nbsp;</td>
		
		<td  class="caption_1">總和大</td><td class="o" width="45" id="fh1">&nbsp;</td>
    	<td class="loads" id="Ball_6mfh1" >&nbsp;</td>
   	</tr>
	
	 <tr class="t_td_text">
    	<td  class="caption_1">小</td>
    	<td class="o" width="45" id="ah12">&nbsp;</td>
    	<td class="loads" id="Ball_1mah12">&nbsp;</td>
    	<td  class="caption_1">小</td><td class="o" width="45" id="bh12">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh12">&nbsp;</td>
    	<td  class="caption_1">小</td><td class="o" width="45" id="ch12">&nbsp;</td>
    	<td class="loads" id="Ball_3mch12">&nbsp;</td>
    	<td  class="caption_1">小</td><td class="o" width="45" id="dh12">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh12">&nbsp;</td>
		<td  class="caption_1">小</td><td class="o" width="45" id="eh12">&nbsp;</td>
    	<td class="loads" id="Ball_5meh12">&nbsp;</td>
		
		<td  class="caption_1">總和小</td><td class="o" width="45" id="fh2">&nbsp;</td>
    	<td class="loads" id="Ball_6mfh2">&nbsp;</td>
   	</tr>
	
	 <tr class="t_td_text">
    	<td  class="caption_1">單</td>
    	<td class="o" width="45" id="ah13">&nbsp;</td>
    	<td class="loads" id="Ball_1mah13">&nbsp;</td>
    	<td  class="caption_1">單</td><td class="o" width="45" id="bh13">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh13">&nbsp;</td>
    	<td  class="caption_1">單</td><td class="o" width="45" id="ch13">&nbsp;</td>
    	<td class="loads" id="Ball_3mch13">&nbsp;</td>
    	<td  class="caption_1">單</td><td class="o" width="45" id="dh13">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh13">&nbsp;</td>
		<td  class="caption_1">單</td><td class="o" width="45" id="eh13">&nbsp;</td>
    	<td class="loads" id="Ball_5meh13">&nbsp;</td>
		
		<td  class="caption_1">總和單</td><td class="o" width="45" id="fh3">&nbsp;</td>
    	<td class="loads" id="Ball_6mfh3">&nbsp;</td>
   	</tr>
	
	 <tr class="t_td_text">
    	<td  class="caption_1">雙</td>
    	<td class="o" width="45" id="ah14">&nbsp;</td>
    	<td class="loads" id="Ball_1mah14">&nbsp;</td>
    	<td  class="caption_1">雙</td><td class="o" width="45" id="bh14">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh14">&nbsp;</td>
    	<td  class="caption_1">雙</td><td class="o" width="45" id="ch14">&nbsp;</td>
    	<td class="loads" id="Ball_3mch14">&nbsp;</td>
    	<td  class="caption_1">雙</td><td class="o" width="45" id="dh14">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh14">&nbsp;</td>
		<td  class="caption_1">雙</td><td class="o" width="45" id="eh14">&nbsp;</td>
    	<td class="loads" id="Ball_5meh14">&nbsp;</td>
		
		<td  class="caption_1">總和雙</td><td class="o" width="45" id="fh4">&nbsp;</td>
    	<td class="loads" id="Ball_6mfh4">&nbsp;</td>
   	</tr>
	
	
<tr class="t_td_text">
    	<td  class="No_cq0">&nbsp;</td>
    	<td class="o" width="45" id="ah1">&nbsp;</td>
    	<td class="loads"  id="Ball_1mah1">&nbsp;</td>
		<td  class="No_cq0">&nbsp;</td>
    	<td class="o" width="45" id="bh1">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh1">&nbsp;</td>
		<td  class="No_cq0">&nbsp;</td>
    	<td class="o" width="45" id="ch1">&nbsp;</td>
    	<td class="loads" id="Ball_3mch1">&nbsp;</td>
		<td  class="No_cq0">&nbsp;</td>
    	<td class="o" width="45" id="dh1">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh1">&nbsp;</td>
		<td  class="No_cq0">&nbsp;</td>
		<td class="o" width="45" id="eh1">&nbsp;</td>
    	<td class="loads" id="Ball_5meh1">&nbsp;</td>
		
		<td  class="caption_1">龍</td><td class="o" width="45" id="fh5">&nbsp;</td>
    	<td class="loads" id="Ball_6mfh5">&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq1">&nbsp;</td>
    	<td class="o" width="45" id="ah2">&nbsp;</td>
    	<td class="loads" id="Ball_1mah2">&nbsp;</td>
		<td  class="No_cq1">&nbsp;</td>
    	<td class="o" width="45" id="bh2">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh2">&nbsp;</td>
		<td  class="No_cq1">&nbsp;</td>
    	<td class="o" width="45" id="ch2">&nbsp;</td>
    	<td class="loads" id="Ball_3mch2">&nbsp;</td>
		<td  class="No_cq1">&nbsp;</td>
    	<td class="o" width="45" id="dh2">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh2">&nbsp;</td>
		<td  class="No_cq1">&nbsp;</td>
		<td class="o" width="45" id="eh2">&nbsp;</td>
    	<td class="loads" id="Ball_5meh2">&nbsp;</td>
		
		<td  class="caption_1">虎</td><td class="o" width="45" id="fh6">&nbsp;</td>
    	<td class="loads" id="Ball_6mfh6">&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq2">&nbsp;</td>
    	<td class="o" width="45" id="ah3">&nbsp;</td>
    	<td class="loads" id="Ball_1mah3">&nbsp;</td>
    	<td  class="No_cq2">&nbsp;</td>
		<td class="o" width="45" id="bh3">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh3">&nbsp;</td>   	
		<td  class="No_cq2">&nbsp;</td>
		<td class="o" width="45" id="ch3">&nbsp;</td>
    	<td class="loads"  id="Ball_3mch3">&nbsp;</td>
    	<td  class="No_cq2">&nbsp;</td>
		<td class="o" width="45" id="dh3">&nbsp;</td>
    	<td class="loads"  id="Ball_4mdh3">&nbsp;</td>
		<td  class="No_cq2">&nbsp;</td>
		<td class="o" width="45" id="eh3">&nbsp;</td>
    	<td class="loads "  id="Ball_5meh3">&nbsp;</td>
		
		<td  class="caption_1">和</td><td class="o" width="45" id="fh7">&nbsp;</td>
    	<td class="loads"  id="Ball_6mfh7">&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq3">&nbsp;</td>
    	<td class="o" width="45" id="ah4">&nbsp;</td>
    	<td class="loads"  id="Ball_1mah4">&nbsp;</td>
    	<td class="No_cq3">&nbsp;</td><td class="o" width="45" id="bh4">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh4">&nbsp;</td>
    	<td class="No_cq3">&nbsp;</td><td class="o" width="45" id="ch4">&nbsp;</td>
    	<td class="loads" id="Ball_3mch4">&nbsp;</td>
    	<td class="No_cq3">&nbsp;</td><td class="o" width="45" id="dh4">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh4">&nbsp;</td>
		<td class="No_cq3">&nbsp;</td><td class="o" width="45" id="eh4">&nbsp;</td>
    	<td class="loads" id="Ball_5meh4">&nbsp;</td>
		
		<td  colspan="3">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr class="t_list_caption">
					<td class="nv_ab"><a class="nv_a" id="qs" onclick="qs()" href="#this">前三</a></td>
					<td class="nv_a"><a class="nv" id="zs" onclick="zs()" href="#this">中三</a></td>
					<td class="nv_a"><a class="nv" id="hs" onclick="hs()" href="#this">后三</a></td>
				</tr>
			</table> 
		</td>
		<script language="javascript">
		function qs(){
			$('td[title=gh]').each(function(){
				var id = $(this).attr('id');
				if(id.indexOf('Ball_')>=0){
					id=id.replace('Ball_8mh','Ball_7mg').replace('Ball_9mi','Ball_7mg');
					$(this).find('input').attr('name',id);
				}else{
					id=id.replace('hh','gh').replace('ih','gh');
					var href = $(this).find('a').attr('href');
					href = href.replace('hid=hh','hid=gh').replace('hid=ih','hid=gh').replace('Ball_8','Ball_7').replace('Ball_9','Ball_7');
					$(this).find('a').attr('href',href);
				}
				$(this).attr('id',id);
			})
			$('#qs').removeClass("nv").addClass("nv_a"); 
			$("#zs").addClass("nv").removeClass("nv_a");
			$("#hs").addClass("nv").removeClass("nv_a");
			
			$('#qs').parent().addClass("nv_ab");
			$('#zs').parent().removeClass("nv_ab");
			$('#hs').parent().removeClass("nv_ab");
		}
		function zs(){
			$('td[title=gh]').each(function(){
				var id = $(this).attr('id');
				if(id.indexOf('Ball_')>=0){
					id=id.replace('Ball_7mg','Ball_8mh').replace('Ball_9mi','Ball_8mh');
					$(this).find('input').attr('name',id);
				}else{
					id=id.replace('gh','hh').replace('ih','gh');
					var href = $(this).find('a').attr('href');
					href = href.replace('hid=gh','hid=hh').replace('hid=ih','hid=hh').replace('Ball_9','Ball_8').replace('Ball_7','Ball_8');
					$(this).find('a').attr('href',href);
				}
				$(this).attr('id',id);
			})
			
			$("#qs").addClass("nv").removeClass("nv_a");
			$('#zs').removeClass("nv").addClass("nv_a"); 
			$("#hs").addClass("nv").removeClass("nv_a");
			
			$('#qs').parent().removeClass("nv_ab");
			$('#zs').parent().addClass("nv_ab"); 
			$('#hs').parent().removeClass("nv_ab");
		}
		function hs(){
			$('td[title=gh]').each(function(){
				var id = $(this).attr('id');
				if(id.indexOf('Ball_')>=0){
					id=id.replace('Ball_7mg','Ball_9mi').replace('Ball_8mh','Ball_9mi');
					$(this).find('input').attr('name',id);
				}else{
					id=id.replace('gh','ih').replace('hh','ih');
					var href = $(this).find('a').attr('href');
					href = href.replace('hid=gh','hid=ih').replace('hid=hh','hid=ih').replace('Ball_7','Ball_9').replace('Ball_8','Ball_9');
					$(this).find('a').attr('href',href);
				}
				$(this).attr('id',id);
			})
			$("#qs").addClass("nv").removeClass("nv_a");
			$('#hs').removeClass("nv").addClass("nv_a"); 
			$("#zs").addClass("nv").removeClass("nv_a");
			
			$('#qs').parent().removeClass("nv_ab");
			$('#hs').parent().addClass("nv_ab"); 
			$('#zs').parent().removeClass("nv_ab");
		}
		</script>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq4">&nbsp;</td>
    	<td class="o" width="45" id="ah5">&nbsp;</td>
    	<td class="loads" id="Ball_1mah5">&nbsp;</td>
    	<td class="No_cq4">&nbsp;</td><td class="o" width="45" id="bh5">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh5">&nbsp;</td>
    	<td class="No_cq4">&nbsp;</td><td class="o" width="45" id="ch5">&nbsp;</td>
    	<td class="loads" id="Ball_3mch5">&nbsp;</td>
    	<td class="No_cq4">&nbsp;</td><td class="o" width="45" id="dh5">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh5">&nbsp;</td>
		<td class="No_cq4">&nbsp;</td><td class="o" width="45" id="eh5">&nbsp;</td>
    	<td class="loads" id="Ball_5meh5">&nbsp;</td>
		
		
		<td class="caption_1">豹子</td><td class="o" width="45" title="gh" id="gh1">&nbsp;</td>
    	<td class="loads" id="Ball_7mgh1" title="gh">&nbsp;</td>
		
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq5">&nbsp;</td>
    	<td class="o" width="45" id="ah6">&nbsp;</td>
    	<td class="loads" id="Ball_1mah6">&nbsp;</td>
    	<td  class="No_cq5">&nbsp;</td><td class="o" width="45" id="bh6">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh6">&nbsp;</td>
    	<td  class="No_cq5">&nbsp;</td><td class="o" width="45" id="ch6">&nbsp;</td>
    	<td class="loads" id="Ball_3mch6">&nbsp;</td>
    	<td  class="No_cq5">&nbsp;</td><td class="o" width="45" id="dh6">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh6">&nbsp;</td>
		<td  class="No_cq5">&nbsp;</td><td class="o" width="45" id="eh6">&nbsp;</td>
    	<td class="loads" id="Ball_5meh6">&nbsp;</td>
		
		<td class="caption_1">順子</td><td class="o" width="45" title="gh" id="gh2">&nbsp;</td>
    	<td class="loads" id="Ball_7mgh2" title="gh">&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq6">&nbsp;</td>
    	<td class="o" width="45" id="ah7">&nbsp;</td>
    	<td class="loads" id="Ball_1mah7">&nbsp;</td>
    	<td class="No_cq6">&nbsp;</td><td class="o" width="45" id="bh7">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh7">&nbsp;</td>
    	<td class="No_cq6">&nbsp;</td><td class="o" width="45" id="ch7">&nbsp;</td>
    	<td class="loads" id="Ball_3mch7">&nbsp;</td>
    	<td class="No_cq6">&nbsp;</td><td class="o" width="45" id="dh7">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh7">&nbsp;</td>
		<td class="No_cq6">&nbsp;</td><td class="o" width="45" id="eh7">&nbsp;</td>
    	<td class="loads" id="Ball_5meh7">&nbsp;</td>
		
		<td class="caption_1">對子</td><td class="o" width="45" title="gh" id="gh3">&nbsp;</td>
    	<td class="loads" id="Ball_7mgh3" title="gh">&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td class="No_cq7">&nbsp;</td>
    	<td class="o" width="45" id="ah8">&nbsp;</td>
    	<td class="loads" id="Ball_1mah8">&nbsp;</td>
    	<td class="No_cq7">&nbsp;</td><td class="o" width="45" id="bh8">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh8">&nbsp;</td>
    	<td class="No_cq7">&nbsp;</td><td class="o" width="45" id="ch8">&nbsp;</td>
    	<td class="loads" id="Ball_3mch8">&nbsp;</td>
    	<td class="No_cq7">&nbsp;</td><td class="o" width="45" id="dh8">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh8">&nbsp;</td>
		<td class="No_cq7">&nbsp;</td><td class="o" width="45" id="eh8">&nbsp;</td>
    	<td class="loads" id="Ball_5meh8">&nbsp;</td>
		
		<td class="caption_1">半順</td><td class="o" width="45" title="gh" id="gh4">&nbsp;</td>
    	<td class="loads" id="Ball_7mgh4" title="gh" >&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td  class="No_cq8">&nbsp;</td>
    	<td class="o" width="45" id="ah9">&nbsp;</td>
    	<td class="loads" id="Ball_1mah9">&nbsp;</td>
    	<td  class="No_cq8">&nbsp;</td><td class="o" width="45" id="bh9">&nbsp;</td>
    	<td class="loads" id="Ball_2mbh9">&nbsp;</td>
    	<td  class="No_cq8">&nbsp;</td><td class="o" width="45" id="ch9">&nbsp;</td>
    	<td class="loads" id="Ball_3mch9">&nbsp;</td>
    	<td  class="No_cq8">&nbsp;</td><td class="o" width="45" id="dh9">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh9">&nbsp;</td>
		<td  class="No_cq8" >&nbsp;</td><td class="o" width="45" id="eh9">&nbsp;</td>
    	<td class="loads" id="Ball_5meh9">&nbsp;</td>
		
		<td class="caption_1">雜六</td><td class="o" width="45" title="gh" id="gh5">&nbsp;</td>
    	<td class="loads" id="Ball_5mgh5" title="gh">&nbsp;</td>
   	</tr>
	 <tr class="t_td_text">
    	<td  class="No_cq9">&nbsp;</td>
    	<td class="o" width="45" id="ah10">&nbsp;</td>
    	<td class="loads" id="Ball_1mah10">&nbsp;</td>
    	<td  class="No_cq9">&nbsp;</td><td class="o" width="45" id="bh10">&nbsp;</td>
    	<td class="loads"  id="Ball_2mbh10">&nbsp;</td>
    	<td  class="No_cq9">&nbsp;</td><td class="o" width="45" id="ch10">&nbsp;</td>
    	<td class="loads" id="Ball_3mch10">&nbsp;</td>
    	<td  class="No_cq9">&nbsp;</td><td class="o" width="45" id="dh10">&nbsp;</td>
    	<td class="loads" id="Ball_4mdh10">&nbsp;</td>
		<td  class="No_cq9">&nbsp;</td><td class="o" width="45" id="eh10">&nbsp;</td>
    	<td class="loads" id="Ball_5meh10">&nbsp;</td>
   	</tr>
	
	
	 
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px" ><input type="submit" id="submits" class="inputs ti" value="確定" /></td>
        <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
        <td width="0" class="actiionn">&nbsp;</td>
    </tr>
</table>
</form>
<table class="wqsz" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#0066FF">
    	<th width="10%">0</th>
    	<th width="10%">1</th>
        <th width="10%">2</th>
        <th width="10%">3</th>
        <th width="10%">4</th>
        <th width="10%">5</th>
        <th width="10%">6</th>
        <th width="10%">7</th>
        <th width="10%">8</th>
        <th>9</th>
    </tr>
    <tr class="t_td_text" id="su">
    	<td colspan="10">&nbsp;</td>
    </tr>
</table>
<br />
<table class="wqsz" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td><a class="nv_a" <?php echo $onclick?>>第1球</a></td>
        <td><a class="nv" <?php echo $onclick?>>第2球</a></td>
		 <td><a class="nv" <?php echo $onclick?>>第3球</a></td>
		  <td><a class="nv" <?php echo $onclick?>>第4球</a></td>
		   <td><a class="nv" <?php echo $onclick?>>第5球</a></td>
    </tr>
    <tr>
    	<td colspan="5" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
<div id="look" style="display:none"></div>
<?php include_once 'inc/cl_filesz.php';?>
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