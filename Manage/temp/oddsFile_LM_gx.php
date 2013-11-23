<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
include_once ROOT_PATH.'Manage/temp/offGamegx.php';
if ($ConfigModel['g_nowrecord_lock'] !=1 || $ConfigModel['g_gx_game_lock'] !=1 ||$ConfigModel['g_game_gx_10'] !=1)
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
$types = '連碼';
if (isset($_SESSION['Mean10']))
	$Mean = $_SESSION['Mean10'];
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
                            <table border="0" cellspacing="0" class="t_odds" width="100%">
                            	<tr class="tr_top">
                                	<th colspan="6">連碼</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball_2">一中一</td>
                                    <td class="ball_2">二中二</td>
                                    <td class="ball_2">三中二</td>
                                    <td class="ball_2">三中三</td>
                                    <td class="ball_2">四中三</td>
                                    <td class="ball_2">五中三</td>
                                </tr>
                                <tr align="center">
                                	<td class="odds" id="h1"></td>
                                    <td class="odds" id="h3"></td>
                                    <td class="odds" id="h4"></td>
                                    <td class="odds" id="h6"></td>
                                    <td class="odds" id="h7"></td>
                                    <td class="odds" id="h8"></td>
                                </tr>
                                <?php if ($oddsLock){?>
                                <tr align="center">
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_<?php echo$g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_<?php echo$g?>',this)" class="aase aase_b" name="0"  />	                                </td>
	                            </tr>
                                    <?php }?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('一中一')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a101">-</a></td>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('二中二')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a102">-</a></td>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('三中二')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a103">-</a></td>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('三中三')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a104">-</a></td>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('四中三')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a105">-</a></td>
                                    <td class="odds"><a href="CrystalIsNotgx.php?pid=<?php echo base64_encode('五中三')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a106">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="odds"  id="d101">-</td>
                                    <td class="odds"  id="d102">-</td>
                                    <td class="odds"  id="d103">-</td>
                                    <td class="odds"  id="d104">-</td>
                                    <td class="odds"  id="d105">-</td>
                                    <td class="odds"  id="d106">-</td>
                                </tr>
                                <tr align="center">
                                	<td class="ball_2"><input type="radio" name="ros" value="一中一" id="101" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="二中二" id="102" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="三中二" id="103" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="三中三" id="104" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="四中三" id="105" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="五中三" id="106" onclick="GoPinn(this)" /></td>
                                </tr>
                            </table>
                            <table style=" display:none;" id="s_table" border="0" cellspacing="0" class="t_odds">
	                            	<!--<tr align="center">
	                                	<td colspan="8">
	                                	每注保留額度（超過部份補出）：<input type="text" id="kb" class="textb" />&nbsp;&nbsp;
	                                	<input type="button" class="inputs" onclick="GoSum()" value="計算補貨" />&nbsp;&nbsp;
	                                	 <input type="button" class="inputs" onclick="Gost()" value="快速補出" /> </td>
	                                </tr>-->
	                                <tr class="tr_top">
	                                	<td colspan="8">『 <span class="ballr" id="a_s_type"></span> 』按總組統計排行</td>
	                                </tr>
                                <tr>
                                	<td class="ball_3">排名</td>
                                    <td class="ball_3">組合號碼</td>
                                    <td class="ball_3">總注額</td>
                                    <td class="ball_3">總組</td>
                                    <td class="ball_3">單組金額</td>
                                    <td class="ball_3">退水</td>
                                    <td class="ball_3">派彩額</td>
                                    <td class="ball_3">補貨</td>
                                </tr>
                                <tfoot id="sList">
                                	
                                </tfoot>
                               <!-- <tr align="center" id="sList">
                                	 <td>排名</td>
                                    <td>組合</td>
                                    <td>下注額</td>
                                    <td>快補金額</td>
                                    <td>退水</td>
                                    <td>派彩額</td>
                                    <td>單補</td>
                                </tr> -->
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><?php if ($oddsLock){?>
                        	<input type="button" class="inputs" value="還原賠率" onclick="initializes()" />&nbsp;&nbsp;&nbsp;&nbsp;
                        設置調動幅度：<input type="text" class="texta" id="Ho" value="0.01" />
                        	<?php }?></td>
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
    <?php echo$HtmlPop?>
    <?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$Users[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>