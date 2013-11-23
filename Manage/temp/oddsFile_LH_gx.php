<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/temp/offGamegx.php';
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
if ($ConfigModel['g_nowrecord_lock'] !=1 || $ConfigModel['g_gx_game_lock'] !=1 ||$ConfigModel['g_game_gx_9'] !=1)
	exit(href('right.php'));
$oddsLock = false;
if ($Users[0]['g_login_id']==48){
	if ($Users[0]['g_Immediate2_lock'] != 1) exit(back('抱歉！您無權限訪問即時注單。'));
}
if ($Users[0]['g_login_id']==89){
	$oddsLock=true;
} else if (isset($Users[0]['g_odds_lock']) && $Users[0]['g_odds_lock']==1){
	$oddsLock=true;
}

$g = $_GET['cid'];
$Mean = -1000000;
$types = '總和、龍虎';
if (isset($_SESSION['Mean9']))
	$Mean = $_SESSION['Mean9'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsFilegx.js"></script>
<script type="text/javascript" src="/Manage/temp/js/setOddsgx.js"></script>
<script type="text/javascript">
<!--
	function setMean($this){
		var patrn=/^[0-9-]{1,9}$/; 
		if (patrn.exec($this.value)){
			$.post("/Manage/temp/ajax/jsongx.php", {typeid : 4, meanid : $this.value, cid : <?php echo $g?>}, function(){});
		}
	}
-->
</script>
<title></title>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        <?php include_once ROOT_PATH.'Manage/temp/oddsTop.php';?>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="t_odds" width="88%">
                            	<tr class="tr_top">
                                	<td>號碼</td>
                                    <td width="10%">賠率</td>
                                    <?php if ($oddsLock){?><td width="5%">設置</td><?php }?>
                                    <td>注額</td>
                                    <td>虧盈</td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n1">總和大</td>
                                    <td class="odds" id="h1"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('總和大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a1">-</a><span id="b1" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d1">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n3">總和小</td>
                                    <td class="odds" id="h3"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('總和小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a3">-</a><span id="b3" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d3">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n2">總和單</td>
                                    <td class="odds" id="h2"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('總和單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a2">-</a><span id="b2" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d2">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n4">總和雙</td>
                                    <td class="odds" id="h4"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('總和雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a4">-</a><span id="b4" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d4">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n5">總和尾大</td>
                                    <td class="odds" id="h5"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('zwd')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a5">-</a><span id="b5" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d5">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n7">總和尾小</td>
                                    <td class="odds" id="h7"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('zwx')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a7">-</a><span id="b7" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d7">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n6">龍</td>
                                    <td class="odds" id="h6"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a6">-</a><span id="b6" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d6">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="ball_1" id="n8">虎</td>
                                    <td class="odds" id="h8"></td>
                                    <?php if ($oddsLock){?>
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
                                    <?php }?>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a8">-</a><span id="b8" class="so"></span></td>
                                    <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d8">-</a></td>
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
	                        <input type="button" onclick="planning()" class="inputs" value="計算補貨" />&nbsp;&nbsp;
	                        <?php if ($oddsLock){?>
                        	<input type="button" class="inputs" value="還原賠率" onclick="initializes()" />&nbsp;&nbsp;&nbsp;&nbsp;
                        設置調動幅度：<input type="text" class="texta" id="Ho" value="0.01" />
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