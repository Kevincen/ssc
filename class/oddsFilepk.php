<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/temp/offGamepk.php';
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
if ($ConfigModel['g_nowrecord_lock'] !=1 || $ConfigModel['g_pk_game_lock'] !=1)exit(href('right.php'));
$oddsLock = false;
if ($Users[0]['g_login_id']==48){
	if ($Users[0]['g_Immediate2_lock'] != 1) exit(back('抱歉！您無權限訪問即時注單。'));
}
if ($Users[0]['g_login_id']==89){
	$oddsLock=true;
} 
else if (isset($Users[0]['g_odds_lock']) && $Users[0]['g_odds_lock']==1){
	$oddsLock=true;
}

$g = $_GET['cid'];
$Mean = -1000000;
switch ($g) {
	case '1':
		$types = '冠、亞軍 組合';
		if ($ConfigModel['g_game_pk_1'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean1']))
			$Mean = $_SESSION['Mean1'];
		break;
	case '2':
		$types = '三、四、伍、六名';
		if ($ConfigModel['g_game_pk_2'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean2']))
			$Mean = $_SESSION['Mean2'];
		break;
	case '3':
		$types = '七、八、九、十名';
		if ($ConfigModel['g_game_pk_3'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean3']))
			$Mean = $_SESSION['Mean3'];
		break;
	
	default:exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsFilepk.js"></script>
<script type="text/javascript" src="/Manage/temp/js/setOddspk.js"></script>
<script type="text/javascript">
<!--
	function setMean($this){
		var patrn=/^[0-9-]{1,9}$/; 
		if (patrn.exec($this.value)){
			$.post("/Manage/temp/ajax/jsonnc.php", {typeid : 4, meanid : $this.value, cid : <?php echo $g?>}, function(){});
		}
	}
	function GoLocation(sInt){
		location.href = "/Manage/temp/"+sInt;
	}
//-->
</script>
<title></title>
</head>
<body>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<?php include_once ROOT_PATH.'Manage/temp/oddsToppk.php';?>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
						<?php if($g==1){?>
                            <table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">冠、亞軍和 指定</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">冠、亞軍和 指定</td><?php }?>
								</tr>
                                <tr align="center">
                                	<td class="ball_pk" id="nt11_1">3</td>
                                    <td class="odds" id="t11_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="冠、亞軍和";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_1">-</a><span id="bt11_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_1">-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball_pk" id="nt11_2">4</td>
                                    <td class="odds" id="t11_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_2">-</a><span id="bt11_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_2">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_3">5</td>
                                    <td class="odds" id="t11_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_3">-</a><span id="bt11_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_3">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_4">6</td>
                                    <td class="odds" id="t11_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_4">-</a><span id="bt11_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_4">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_5">7</td>
                                    <td class="odds" id="t11_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_5">-</a><span id="bt11_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_5">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_6">8</td>
                                    <td class="odds" id="t11_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_6">-</a><span id="bt11_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_6">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_7">9</td>
                                    <td class="odds" id="t11_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_7">-</a><span id="bt11_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_7">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_8">10</td>
                                    <td class="odds" id="t11_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_8">-</a><span id="bt11_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_8">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_9">11</td>
                                    <td class="odds" id="t11_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('11')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_9">-</a><span id="bt11_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_9">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_10">12</td>
                                    <td class="odds" id="t11_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('12')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_10">-</a><span id="bt11_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_10">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_11">13</td>
                                    <td class="odds" id="t11_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('13')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_11">-</a><span id="bt11_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_12">14</td>
                                    <td class="odds" id="t11_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('14')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_12">-</a><span id="bt11_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_13">15</td>
                                    <td class="odds" id="t11_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('15')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_13">-</a><span id="bt11_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_14">16</td>
                                    <td class="odds" id="t11_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('16')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_14">-</a><span id="bt11_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_14">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_15">17</td>
                                    <td class="odds" id="t11_h15"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h15','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h15','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('17')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_15">-</a><span id="bt11_15" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_15">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_16">18</td>
                                    <td class="odds" id="t11_h16"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h16','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h16','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('18')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_16">-</a><span id="bt11_16" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_16">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt11_17">19</td>
                                    <td class="odds" id="t11_h17"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h17','Ball_11',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h17','Ball_11',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('19')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at11_17">-</a><span id="bt11_17" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt11_17">-</a></td>
                                </tr>
                                
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td width="20%">注額</td>
                                    <td width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">冠、亞軍和 兩面</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">冠、亞軍和 兩面</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt12_1">大</td>
                                    <td class="odds" id="t12_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_12',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_12',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="冠亞和";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('冠亞和大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at12_1">-</a><span id="bt12_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt12_1">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt12_2">小</td>
                                    <td class="odds" id="t12_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_12',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_12',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('冠亞和小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at12_2">-</a><span id="bt12_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt12_2">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt12_3">單</td>
                                    <td class="odds" id="t12_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_12',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_12',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('冠亞和單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at12_3">-</a><span id="bt12_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt12_3">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt12_4">雙</td>
                                    <td class="odds" id="t12_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_12',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_12',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('冠亞和雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at12_4">-</a><span id="bt12_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt12_4">-</a></td>
                                </tr>
                               
                                <tr>
                                	<td colspan="4" class="hbv">
                                    	<div>總投注額：<span class="ls" id="CountNum">0</span></div><br />
                                        <div>最高虧損：<span class="ballr" id="CountLose">0</span></div><br />
                                        <div>最高盈利：<span class="balls" id="CountWin">0</span></div>
                                    </td>
                                </tr>
                            </table>
						
							<table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">冠軍</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">冠軍</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt1_11">大</td>
                                    <td class="odds" id="t1_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }
									$types="冠军";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_11">-</a><span id="bt1_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt1_12">小</td>
                                    <td class="odds" id="t1_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_12">-</a><span id="bt1_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt1_13">單</td>
                                    <td class="odds" id="t1_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_13">-</a><span id="bt1_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt1_14">雙</td>
                                    <td class="odds" id="t1_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_14">-</a><span id="bt1_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_14">-</a></td>
                                </tr>
								
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_15">龍</td>
                                    <td class="odds" id="t1_h15"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h15','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h15','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_15">-</a><span id="bt1_15" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_15">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_16">虎</td>
                                    <td class="odds" id="t1_h16"></td>
                                    <?php if ($oddsLock){?>
                                  <td>
                                   	<input title="上調賠率" type="button" onclick="setodds('h16','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
									<input title="下調賠率" type="button" onclick="setodds('h16','Ball_1',this)" class="aase aase_b" name="02"  /></td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_16">-</a><span id="bt1_16" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_16">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t1_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_1">-</a><span id="bt1_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t1_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_2">-</a><span id="bt1_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t1_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_3">-</a><span id="bt1_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t1_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_4">-</a><span id="bt1_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t1_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_5">-</a><span id="bt1_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t1_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_6">-</a><span id="bt1_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t1_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_7">-</a><span id="bt1_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t1_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_8">-</a><span id="bt1_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t1_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_9">-</a><span id="bt1_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt1_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t1_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_1',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at1_10">-</a><span id="bt1_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt1_10">-</a></td>
                                </tr>
							</table>
							
							<table border="0" cellspacing="0" class="t_odds" width="19%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">亞軍</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">亞軍</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt2_11">大</td>
                                    <td class="odds" id="t2_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_2',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="亚军";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_11">-</a><span id="bt2_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt2_12">小</td>
                                    <td class="odds" id="t2_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_2',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_12">-</a><span id="bt2_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt2_13">單</td>
                                    <td class="odds" id="t2_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_2',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_13">-</a><span id="bt2_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt2_14">雙</td>
                                    <td class="odds" id="t2_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_2',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_14">-</a><span id="bt2_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_14">-</a></td>
                                </tr>
                               <tr align="center" >
                                	<td class="ball_pk" id="nt2_15">龍</td>
                                    <td class="odds" id="t2_h15"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h15','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h15','Ball_2',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_15">-</a><span id="bt2_15" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_15">-</a></td>
                              </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_16">虎</td>
                                    <td class="odds" id="t2_h16"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h16','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h16','Ball_2',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_16">-</a><span id="bt2_16" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_16">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t2_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_1">-</a><span id="bt2_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t2_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_2">-</a><span id="bt2_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t2_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_3">-</a><span id="bt2_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t2_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_4">-</a><span id="bt2_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t2_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_5">-</a><span id="bt2_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t2_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_6">-</a><span id="bt2_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t2_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_7">-</a><span id="bt2_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t2_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_8">-</a><span id="bt2_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t2_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_9">-</a><span id="bt2_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt2_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t2_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_2',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at2_10">-</a><span id="bt2_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt2_10">-</a></td>
                                </tr>
							</table>
							<?php }else if($g==2){
							?>
							<table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第三名</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">第三名</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt3_11">大</td>
                                    <td class="odds" id="t3_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }
									$types="第三名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_11">-</a><span id="bt3_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt3_12">小</td>
                                    <td class="odds" id="t3_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_12">-</a><span id="bt3_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt3_13">單</td>
                                    <td class="odds" id="t3_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_13">-</a><span id="bt3_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt3_14">雙</td>
                                    <td class="odds" id="t3_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_14">-</a><span id="bt3_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_14">-</a></td>
                                </tr>
								
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_15">龍</td>
                                    <td class="odds" id="t3_h15"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h15','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h15','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_15">-</a><span id="bt3_15" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_15">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_16">虎</td>
                                    <td class="odds" id="t3_h16"></td>
                                    <?php if ($oddsLock){?>
                                  <td>
                                   	<input title="上調賠率" type="button" onclick="setodds('h16','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
									<input title="下調賠率" type="button" onclick="setodds('h16','Ball_3',this)" class="aase aase_b" name="02"  /></td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_16">-</a><span id="bt3_16" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_16">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t3_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_1">-</a><span id="bt3_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t3_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_2">-</a><span id="bt3_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t3_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_3">-</a><span id="bt3_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t3_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_4">-</a><span id="bt3_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t3_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_5">-</a><span id="bt3_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t3_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_6">-</a><span id="bt3_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t3_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_7">-</a><span id="bt3_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t3_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_8">-</a><span id="bt3_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t3_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_9">-</a><span id="bt3_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt3_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t3_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_3',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at3_10">-</a><span id="bt3_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt3_10">-</a></td>
                                </tr>
								<tr>
                                	<td colspan="4" class="hbv"> <div>總投注額：<span class="ls" id="CountNum">0</span></div></td>
                                   
                                </tr>
							</table>
							
							<table border="0" cellspacing="0" class="t_odds" width="19%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第四名</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">第四名</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt4_11">大</td>
                                    <td class="odds" id="t4_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_4',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="第四名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_11">-</a><span id="bt4_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt4_12">小</td>
                                    <td class="odds" id="t4_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_4',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_12">-</a><span id="bt4_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt4_13">單</td>
                                    <td class="odds" id="t4_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_4',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_13">-</a><span id="bt4_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt4_14">雙</td>
                                    <td class="odds" id="t4_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_4',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_14">-</a><span id="bt4_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_14">-</a></td>
                                </tr>
                               <tr align="center" >
                                	<td class="ball_pk" id="nt4_15">龍</td>
                                    <td class="odds" id="t4_h15"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h15','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h15','Ball_4',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_15">-</a><span id="bt4_15" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_15">-</a></td>
                              </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_16">虎</td>
                                    <td class="odds" id="t4_h16"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h16','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h16','Ball_4',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_16">-</a><span id="bt4_16" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_16">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t4_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_1">-</a><span id="bt4_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t4_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_2">-</a><span id="bt4_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t4_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_3">-</a><span id="bt4_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t4_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_4">-</a><span id="bt4_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t4_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_5">-</a><span id="bt4_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t4_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_6">-</a><span id="bt4_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t4_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_7">-</a><span id="bt4_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t4_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_8">-</a><span id="bt4_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t4_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_9">-</a><span id="bt4_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt4_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t4_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_4',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at4_10">-</a><span id="bt4_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt4_10">-</a></td>
                                </tr>
								<tr>
                                  <td colspan="4" class="hbv"> <div>最高虧損：<span class="ballr" id="CountLose">0</span></div></td>   
                                </tr>
								 
							</table>
							<table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第五名</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">第五名</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt5_11">大</td>
                                    <td class="odds" id="t5_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }
									$types="第五名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_11">-</a><span id="bt5_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt5_12">小</td>
                                    <td class="odds" id="t5_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_12">-</a><span id="bt5_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt5_13">單</td>
                                    <td class="odds" id="t5_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_13">-</a><span id="bt5_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt5_14">雙</td>
                                    <td class="odds" id="t5_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_14">-</a><span id="bt5_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_14">-</a></td>
                                </tr>
								
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_15">龍</td>
                                    <td class="odds" id="t5_h15"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h15','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h15','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_15">-</a><span id="bt5_15" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_15">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_16">虎</td>
                                    <td class="odds" id="t5_h16"></td>
                                    <?php if ($oddsLock){?>
                                  <td>
                                   	<input title="上調賠率" type="button" onclick="setodds('h16','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
									<input title="下調賠率" type="button" onclick="setodds('h16','Ball_5',this)" class="aase aase_b" name="02"  /></td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_16">-</a><span id="bt5_16" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_16">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t5_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_1">-</a><span id="bt5_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t5_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_2">-</a><span id="bt5_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t5_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_3">-</a><span id="bt5_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t5_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_4">-</a><span id="bt5_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t5_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_5">-</a><span id="bt5_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t5_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_6">-</a><span id="bt5_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t5_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_7">-</a><span id="bt5_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t5_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_8">-</a><span id="bt5_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t5_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_9">-</a><span id="bt5_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt5_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t5_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_5',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at5_10">-</a><span id="bt5_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt5_10">-</a></td>
                                </tr>
								<tr>
                              <td colspan="4" class="hbv"> <div>最高盈利：<span class="balls" id="CountWin">0</span></div></td>    
                                </tr>
							</table>
							
							<table border="0" cellspacing="0" class="t_odds" width="19%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第六名</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">第六名</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt6_11">大</td>
                                    <td class="odds" id="t6_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_6',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="第六名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_11">-</a><span id="bt6_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt6_12">小</td>
                                    <td class="odds" id="t6_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_6',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_12">-</a><span id="bt6_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt6_13">單</td>
                                    <td class="odds" id="t6_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_6',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_13">-</a><span id="bt6_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt6_14">雙</td>
                                    <td class="odds" id="t6_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_6',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_14">-</a><span id="bt6_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_14">-</a></td>
                                </tr>
                              
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t6_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_1">-</a><span id="bt6_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t6_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_2">-</a><span id="bt6_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t6_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_3">-</a><span id="bt6_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t6_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_4">-</a><span id="bt6_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t6_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_5">-</a><span id="bt6_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t6_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_6">-</a><span id="bt6_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t6_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_7">-</a><span id="bt6_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t6_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_8">-</a><span id="bt6_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t6_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_9">-</a><span id="bt6_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt6_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t6_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_6',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at6_10">-</a><span id="bt6_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt6_10">-</a></td>
                                </tr>
							</table>
							
							<?php } else if($g==3){
							?>
							<table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第七名</td><?php }else{ ?>
								<td  colspan="4"  class="tr_top">第七名</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt7_11">大</td>
                                    <td class="odds" id="t7_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }
									$types="第七名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_11">-</a><span id="bt7_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt7_12">小</td>
                                    <td class="odds" id="t7_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_12">-</a><span id="bt7_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt7_13">單</td>
                                    <td class="odds" id="t7_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_13">-</a><span id="bt7_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt7_14">雙</td>
                                    <td class="odds" id="t7_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_14">-</a><span id="bt7_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_14">-</a></td>
                                </tr>
								
								
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t7_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_1">-</a><span id="bt7_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t7_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_2">-</a><span id="bt7_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t7_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_3">-</a><span id="bt7_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t7_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_4">-</a><span id="bt7_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t7_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_5">-</a><span id="bt7_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t7_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_6">-</a><span id="bt7_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t7_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_7">-</a><span id="bt7_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t7_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_8">-</a><span id="bt7_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t7_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_9">-</a><span id="bt7_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt7_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t7_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_7',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at7_10">-</a><span id="bt7_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt7_10">-</a></td>
                                </tr>
								<tr>
                                	<td colspan="4" class="hbv"> <div>總投注額：<span class="ls" id="CountNum">0</span></div></td>
                               </tr>
							</table>
							
							<table border="0" cellspacing="0" class="t_odds" width="19%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第八名</td>
								<?php }else{ ?>
								<td  colspan="4"  class="tr_top">第八名</td>
								<?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt8_11">大</td>
                                    <td class="odds" id="t8_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_8',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="第八名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_11">-</a><span id="bt8_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt8_12">小</td>
                                    <td class="odds" id="t8_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_8',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_12">-</a><span id="bt8_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt8_13">單</td>
                                    <td class="odds" id="t8_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_8',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_13">-</a><span id="bt8_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt8_14">雙</td>
                                    <td class="odds" id="t8_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_8',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_14">-</a><span id="bt8_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_14">-</a></td>
                                </tr>
                              
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t8_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_1">-</a><span id="bt8_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t8_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_2">-</a><span id="bt8_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t8_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_3">-</a><span id="bt8_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t8_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_4">-</a><span id="bt8_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t8_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_5">-</a><span id="bt8_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t8_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_6">-</a><span id="bt8_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t8_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_7">-</a><span id="bt8_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t8_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_8">-</a><span id="bt8_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t8_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_9">-</a><span id="bt8_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt8_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t8_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_8',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at8_10">-</a><span id="bt8_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt8_10">-</a></td>
                                </tr>
							<tr>
                                     <td colspan="4" class="hbv"> <div>最高虧損：<span class="ballr" id="CountLose">0</span></div></td>
							</tr>
							</table>
							<table border="0" cellspacing="0" class="t_odds" width="20%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第九名</td>
								<?php }else{ ?>
								<td  colspan="4"  class="tr_top">第九名</td>
								<?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt9_11">大</td>
                                    <td class="odds" id="t9_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }
									$types="第九名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_11">-</a><span id="bt9_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt9_12">小</td>
                                    <td class="odds" id="t9_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_12">-</a><span id="bt9_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt9_13">單</td>
                                    <td class="odds" id="t9_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_13">-</a><span id="bt9_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt9_14">雙</td>
                                    <td class="odds" id="t9_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_14">-</a><span id="bt9_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_14">-</a></td>
                                </tr>
								
								
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t9_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_1">-</a><span id="bt9_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t9_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_2">-</a><span id="bt9_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t9_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_3">-</a><span id="bt9_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t9_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_4">-</a><span id="bt9_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t9_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_5">-</a><span id="bt9_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t9_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_6">-</a><span id="bt9_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t9_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_7">-</a><span id="bt9_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t9_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_8">-</a><span id="bt9_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t9_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_9">-</a><span id="bt9_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt9_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t9_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_9',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at9_10">-</a><span id="bt9_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt9_10">-</a></td>
                                </tr>
								<tr>
                                     <td colspan="4" class="hbv"> <div>最高盈利：<span class="balls" id="CountWin">0</span></div></td>
                                </tr>
							</table>
							
							<table border="0" cellspacing="0" class="t_odds" width="19%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="20%">賠率</td>
                                    <?php if ($oddsLock){?><td width="20%">設置</td><?php }?>
                                    <td  width="20%">注額</td>
                                    <td  width="20%">虧盈</td>
                                </tr>
								<tr>
								<?php if ($oddsLock){?>
								<td  colspan="5"  class="tr_top">第十名</td>
								<?php }else{ ?>
								<td  colspan="4"  class="tr_top">第十名</td><?php }?>
								</tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt10_11">大</td>
                                    <td class="odds" id="t10_h11"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h11','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h11','Ball_10',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }
									$types="第十名";
									?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_11">-</a><span id="bt10_11" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_11">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt10_12">小</td>
                                    <td class="odds" id="t10_h12"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h12','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h12','Ball_10',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_12">-</a><span id="bt10_12" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_12">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt10_13">單</td>
                                    <td class="odds" id="t10_h13"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h13','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h13','Ball_10',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_13">-</a><span id="bt10_13" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_13">-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball_pk" id="nt10_14">雙</td>
                                    <td class="odds" id="t10_h14"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h14','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h14','Ball_10',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_14">-</a><span id="bt10_14" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_14">-</a></td>
                                </tr>
                              
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_1"><font color="#959612">1</font></td>
                                    <td class="odds" id="t10_h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_1">-</a><span id="bt10_1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_1">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_2"><font color="#0188fe">2</font></td>
                                    <td class="odds" id="t10_h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_2">-</a><span id="bt10_2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_2">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_3"><font color="#111111">3</font></td>
                                    <td class="odds" id="t10_h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_3">-</a><span id="bt10_3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_3">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_4"><font color="#ff7300">4</font></td>
                                    <td class="odds" id="t10_h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_4">-</a><span id="bt10_4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_4">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_5"><font color="#2dc3c2">5</font></td>
                                    <td class="odds" id="t10_h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_5">-</a><span id="bt10_5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_5">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_6"><font color="#3500a8">6</font></td>
                                    <td class="odds" id="t10_h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_6">-</a><span id="bt10_6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_6">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_7"><font color="#666666">7</font></td>
                                    <td class="odds" id="t10_h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_7">-</a><span id="bt10_7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_7">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_8"><font color="#fe0000">8</font></td>
                                    <td class="odds" id="t10_h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_8">-</a><span id="bt10_8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_8">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_9"><font color="#770101">9</font></td>
                                    <td class="odds" id="t10_h9"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h9','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h9','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_9">-</a><span id="bt10_9" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_9">-</a></td>
                                </tr>
								<tr align="center" >
                                	<td class="ball_pk" id="nt10_10"><font color="#167301">10</font></td>
                                    <td class="odds" id="t10_h10"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h10','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h10','Ball_10',this)" class="aase aase_b" name="0"  />	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotpk.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="at10_10">-</a><span id="bt10_10" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="dt10_10">-</a></td>
                                </tr>
							</table>
							
							<?php }?>
							
                            <table border="0" cellspacing="0" class="t_odds" width="110">
                            	<tr class="tr_top">
                                	<td>總額：<span id="CountNums" class="ls">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=1')">冠亞軍和：<span class="ls" id="l11">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=1')">冠亞大小：<span class="ls" id="l12">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=1')">冠亞單雙：<span class="ls" id="l13">0</span></td>
                                </tr>
								<tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=1')">冠&nbsp;&nbsp;&nbsp;&nbsp;軍<span class="odds">總</span>：<span class="ls" id="l1">0</span></td>
                                </tr>
								<tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=1')">亞&nbsp;&nbsp;&nbsp;&nbsp;軍<span class="odds">總</span>：<span class="ls" id="l2">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=2')">第三名<span class="odds">總</span>：<span class="ls" id="l3">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=2')">第四名<span class="odds">總</span>：<span class="ls" id="l4">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=2')">第五名<span class="odds">總</span>：<span class="ls" id="l5">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=2')">第六名<span class="odds">總</span>：<span class="ls" id="l6">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=3')">第七名<span class="odds">總</span>：<span class="ls" id="l7">0</span></td>
                                </tr>
                                 <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=3')">第八名<span class="odds">總</span>：<span class="ls" id="l8">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=3')">第九名<span class="odds">總</span>：<span class="ls" id="l9">0</span></td>
                                </tr>
                                <tr align="center">
                                	<td class="zh" onclick="GoLocation('oddsFilepk.php?cid=3')">第十名<span class="odds">總</span>：<span class="ls" id="l10">0</span></td>
                                </tr>
                               
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="135" id="cl">
                            	<!-- <tr class="tr_top">
                                	<th colspan="2">兩面長龍</th>
                                </tr>
                                <tr align="center">
                                	<td class="uo">第一球-單</td>
                                    <td class="fe">5期</td>
                                </tr> -->
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center">評價虧損：
                        <input type="text" class="textb" id="Param" onkeyup="setMean(this)" value="<?php echo$Mean?>" />&nbsp;&nbsp;
                        <input type="button" class="inputs" onclick="planning()" value="計算補貨" />&nbsp;&nbsp;
                        <?php if ($oddsLock){?>
                        <input type="button" class="inputs" value="還原賠率" onclick="initializes()" />&nbsp;&nbsp;&nbsp;&nbsp;
                        設置調動幅度：<input type="text" class="texta" id="Ho" value="0.001" />
                        <?php }?>
                        </td>
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
<?php echo $HtmlPop?>
<?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$Users[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>