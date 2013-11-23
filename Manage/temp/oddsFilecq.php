<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/temp/offGamecq.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsFilecq.js"></script>
<title></title>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16055567.js"></script>
</div>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="120" class="ls">&nbsp;<span id="number"></span>&nbsp;期</td>
                                    <td width="73" class="balls" id="s_type" style="position:relative;top:1px">總項盤口</td>
                                    <td width="120" style="font-weight:bold">
	                                    <span id="offTime">距封盤</span>
	                                    <span id="EndTime" style="position:relative;color:red;letter-spacing:1px;">加載中...</span>
                                    </td>
                                    <td width="180" style="color:red;font-weight:bold">今天輸贏：<span id="win">0</span></td>
    								<td align="right">
    									<span id="q_number"></span>期:
    								</td>
    								<td width="150">
    									<span id="q_a" class="qiuqiu" style="float:left"></span>
    									<span id="q_b" class="qiuqiu" style="float:left"></span>
    									<span id="q_c" class="qiuqiu" style="float:left"></span>
    									<span id="q_d" class="qiuqiu" style="float:left"></span>
    									<span id="q_e" class="qiuqiu" style="float:left"></span>
    								</td>
                                    <td align="right">刷新：<span id="RefreshTime">加載中...</span>&nbsp;&nbsp;
                                    	<select id="EstateTime">
	                                    	<option value="30">30秒</option>
	                                        <option value="60">60秒</option>
	                                        <option value="90" selected="selected">90秒</option>
                                        </select>
                                   </td>
                                  </tr>
							</table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="t_odds" width="310">
                            	<tr class="tr_top">
                                	<td>號</td>
                                    <td>賠率</td>
                                    <td>注額</td>
                                    <td>盈虧</td>
                                </tr>
                            	<tr style="background-color:azure;height:23px">
                                	<th colspan="4">第一球</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">大</td>
                                    <td class="odds" id="ah11" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah11" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">小</td>
                                    <td class="odds" id="ah12" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah12" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">單</td>
                                    <td class="odds" id="ah13" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah13" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雙</td>
                                    <td class="odds" id="ah14" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah14" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">0</td>
                                    <td class="odds" id="ah1" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">1</td>
                                    <td class="odds" id="ah2" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">2</td>
                                    <td class="odds" id="ah3" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">3</td>
                                    <td class="odds" id="ah4" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">4</td>
                                    <td class="odds" id="ah5" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah5" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">5</td>
                                    <td class="odds" id="ah6" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah6" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">6</td>
                                    <td class="odds" id="ah7" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah7" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">7</td>
                                    <td class="odds" id="ah8" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah8" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">8</td>
                                    <td class="odds" id="ah9" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah9" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">9</td>
                                    <td class="odds" id="ah10" width="76"></td>
                                    <td class="odds a" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                                    <td class="odds a"><a class="psp bah10" >-</a></td>
                                </tr>
                                <tr style="background-color:azure;height:23px">
                                	<th colspan="4">第四球</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">大</td>
                                    <td class="odds" id="dh11" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah11" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">小</td>
                                    <td class="odds" id="dh12" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah12" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">單</td>
                                    <td class="odds" id="dh13" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah13" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雙</td>
                                    <td class="odds" id="dh14" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah14" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">0</td>
                                    <td class="odds" id="dh1" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">1</td>
                                    <td class="odds" id="dh2" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">2</td>
                                    <td class="odds" id="dh3" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">3</td>
                                    <td class="odds" id="dh4" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">4</td>
                                    <td class="odds" id="dh5" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah5" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">5</td>
                                    <td class="odds" id="dh6" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah6" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">6</td>
                                    <td class="odds" id="dh7" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah7" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">7</td>
                                    <td class="odds" id="dh8" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah8" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">8</td>
                                    <td class="odds" id="dh9" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah9" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">9</td>
                                    <td class="odds" id="dh10" width="76"></td>
                                    <td class="odds d" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                                    <td class="odds d"><a class="psp bah10" >-</a></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="310">
                            	<tr class="tr_top">
                                	<td>號</td>
                                    <td>賠率</td>
                                    <td>注額</td>
                                    <td>盈虧</td>
                                </tr>
                            	<tr style="background-color:azure;height:23px">
                                	<th colspan="4">第二球</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">大</td>
                                    <td class="odds" id="bh11" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah11" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">小</td>
                                    <td class="odds" id="bh12" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah12" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">單</td>
                                    <td class="odds" id="bh13" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah13" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雙</td>
                                    <td class="odds" id="bh14" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah14" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">0</td>
                                    <td class="odds" id="bh1" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">1</td>
                                    <td class="odds" id="bh2" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">2</td>
                                    <td class="odds" id="bh3" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">3</td>
                                    <td class="odds" id="bh4" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">4</td>
                                    <td class="odds" id="bh5" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah5" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">5</td>
                                    <td class="odds" id="bh6" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah6" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">6</td>
                                    <td class="odds" id="bh7" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah7" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">7</td>
                                    <td class="odds" id="bh8" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah8" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">8</td>
                                    <td class="odds" id="bh9" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah9" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">9</td>
                                    <td class="odds" id="bh10" width="76"></td>
                                    <td class="odds b" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                                    <td class="odds b"><a class="psp bah10" >-</a></td>
                                </tr>
                                <tr style="background-color:azure;height:23px">
                                	<th colspan="4">第五球</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">大</td>
                                    <td class="odds" id="eh11" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah11" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">小</td>
                                    <td class="odds" id="eh12" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah12" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">單</td>
                                    <td class="odds" id="eh13" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah13" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雙</td>
                                    <td class="odds" id="eh14" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah14" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">0</td>
                                    <td class="odds" id="eh1" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">1</td>
                                    <td class="odds" id="eh2" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">2</td>
                                    <td class="odds" id="eh3" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">3</td>
                                    <td class="odds" id="eh4" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">4</td>
                                    <td class="odds" id="eh5" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah5" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">5</td>
                                    <td class="odds" id="eh6" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah6" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">6</td>
                                    <td class="odds" id="eh7" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah7" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">7</td>
                                    <td class="odds" id="eh8" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah8" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">8</td>
                                    <td class="odds" id="eh9" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah9" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">9</td>
                                    <td class="odds" id="eh10" width="76"></td>
                                    <td class="odds e" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                                    <td class="odds e"><a class="psp bah10" >-</a></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="310">
                            	<tr class="tr_top">
                                	<td>號</td>
                                    <td>賠率</td>
                                    <td>注額</td>
                                    <td>盈虧</td>
                                </tr>
                            	<tr style="background-color:azure;height:23px">
                                	<th colspan="4">第三球</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">大</td>
                                    <td class="odds" id="ch11" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah11" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">小</td>
                                    <td class="odds" id="ch12" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah12" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">單</td>
                                    <td class="odds" id="ch13" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah13" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雙</td>
                                    <td class="odds" id="ch14" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah14" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">0</td>
                                    <td class="odds" id="ch1" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">1</td>
                                    <td class="odds" id="ch2" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">2</td>
                                    <td class="odds" id="ch3" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">3</td>
                                    <td class="odds" id="ch4" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">4</td>
                                    <td class="odds" id="ch5" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah5" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">5</td>
                                    <td class="odds" id="ch6" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah6" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">6</td>
                                    <td class="odds" id="ch7" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah7" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">7</td>
                                    <td class="odds" id="ch8" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah8" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">8</td>
                                    <td class="odds" id="ch9" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah9" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">9</td>
                                    <td class="odds" id="ch10" width="76"></td>
                                    <td class="odds c" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                                    <td class="odds c"><a class="psp bah10" >-</a></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="310">
                            	<tr class="tr_top">
                                	<td>號</td>
                                    <td>賠率</td>
                                    <td>注額</td>
                                    <td>盈虧</td>
                                </tr>
                                <tr style="background-color:azure;height:23px">
                                	<th colspan="4">總和、龍虎和</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">總和大</td>
                                    <td class="odds" id="hh1" width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和大')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh1" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">總和小</td>
                                    <td class="odds" id="hh2"  width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和小')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh2" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">總和單</td>
                                    <td class="odds" id="hh3"  width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和單')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh3" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">總和雙</td>
                                    <td class="odds" id="hh4"  width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和雙')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh4" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">龍</td>
                                    <td class="odds" id="hh5"  width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh5" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh5" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">虎</td>
                                    <td class="odds" id="hh6"  width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh6" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh6" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">和</td>
                                    <td class="odds" id="hh7"  width="76"></td>
                                    <td class="odds w" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('和')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh7" target="_blank">-</a></td>
                                    <td class="odds w"><a class="psp bbh7" >-</a></td>
                                </tr>
                                <tr style="background-color:azure;height:23px">
                                	<th colspan="4">前三</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">豹子</td>
                                    <td class="odds" id="ih1" width="76"></td>
                                    <td class="odds i" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('豹子')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach1" target="_blank">-</a></td>
                                    <td class="odds i"><a class="psp bch1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">順子</td>
                                    <td class="odds" id="ih2"  width="76"></td>
                                    <td class="odds i" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('順子')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach2" target="_blank">-</a></td>
                                    <td class="odds i"><a class="psp bch2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">對子</td>
                                    <td class="odds" id="ih3"  width="76"></td>
                                    <td class="odds i" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('對子')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach3" target="_blank">-</a></td>
                                    <td class="odds i"><a class="psp bch3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">半順</td>
                                    <td class="odds" id="ih4"  width="76"></td>
                                    <td class="odds i" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('半順')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach4" target="_blank">-</a></td>
                                    <td class="odds i"><a class="psp bch4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雜六</td>
                                    <td class="odds" id="ih5"  width="76"></td>
                                    <td class="odds i" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雜六')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach5" target="_blank">-</a></td>
                                    <td class="odds i"><a class="psp bch5" >-</a></td>
                                </tr>
                                 <tr style="background-color:azure;height:23px">
                                	<th colspan="4">中三</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">豹子</td>
                                    <td class="odds" id="sh1" width="76"></td>
                                    <td class="odds s" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('豹子')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach1" target="_blank">-</a></td>
                                    <td class="odds s"><a class="psp bch1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">順子</td>
                                    <td class="odds" id="sh2"  width="76"></td>
                                    <td class="odds s" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('順子')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach2" target="_blank">-</a></td>
                                    <td class="odds s"><a class="psp bch2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">對子</td>
                                    <td class="odds" id="sh3"  width="76"></td>
                                    <td class="odds s" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('對子')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach3" target="_blank">-</a></td>
                                    <td class="odds s"><a class="psp bch3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">半順</td>
                                    <td class="odds" id="sh4"  width="76"></td>
                                    <td class="odds s" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('半順')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach4" target="_blank">-</a></td>
                                    <td class="odds s"><a class="psp bch4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雜六</td>
                                    <td class="odds" id="sh5"  width="76"></td>
                                    <td class="odds s" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雜六')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach5" target="_blank">-</a></td>
                                    <td class="odds s"><a class="psp bch5" >-</a></td>
                                </tr>
                                 <tr style="background-color:azure;height:23px">
                                	<th colspan="4">后三</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball">豹子</td>
                                    <td class="odds" id="xh1" width="76"></td>
                                    <td class="odds x" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('豹子')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach1" target="_blank">-</a></td>
                                    <td class="odds x"><a class="psp bch1" >-</a></td>
                                </tr>
                                <tr align="center">
                                	<td class="ball">順子</td>
                                    <td class="odds" id="xh2"  width="76"></td>
                                    <td class="odds x" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('順子')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach2" target="_blank">-</a></td>
                                    <td class="odds x"><a class="psp bch2" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">對子</td>
                                    <td class="odds" id="xh3"  width="76"></td>
                                    <td class="odds x" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('對子')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach3" target="_blank">-</a></td>
                                    <td class="odds x"><a class="psp bch3" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">半順</td>
                                    <td class="odds" id="xh4"  width="76"></td>
                                    <td class="odds x" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('半順')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach4" target="_blank">-</a></td>
                                    <td class="odds x"><a class="psp bch4" >-</a></td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">雜六</td>
                                    <td class="odds" id="xh5"  width="76"></td>
                                    <td class="odds x" width="73"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雜六')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach5" target="_blank">-</a></td>
                                    <td class="odds x"><a class="psp bch5" >-</a></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" class="t_odds" width="130" id="cl">
                            	 <!--  <tr class="tr_top">
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
                        <input type="text" class="textb" id="Param" value="-10000000" />&nbsp;&nbsp;
                        <input type="button" class="inputs" value="計算補貨" />&nbsp;&nbsp;
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
<div id="oddsPop">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th colspan="2">補貨單</th>
    </tr>
    <tr class="text" align="center">
        <td width="50" >類型</td>
        <td class="balls" id="type_s"></td>
    </tr>
    <tr class="text" align="center">
        <td width="50">賠率</td>
        <td class="odds" id="odds_s"></td>
    </tr>
    <tr class="text" align="center">
        <td width="50">金額</td>
        <td><input type="text" id="s_money" class="textc" /></td>
    </tr>
    <tr class="text" align="center">
        <td width="50">限額</td>
        <td id="money_s">0</td>
    </tr>
    <tr class="texts">
        <td align="center" height="60" colspan="2">
            <input type="button" class="inputa" onclick="GoPost()" value="補出" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="inputa" onclick="closePop(2)" value="關閉" />
            <input type="hidden" id="typeid" />
      	</td>
    </tr>
</table>
</div>
<div id="kOddsPop">
	<table border="0" cellspacing="0" class="t_odds" width="100%">
    	<tr class="tr_top" align="center">
        	<td colspan="5">補貨結果明細</td>
        </tr>
        <tr class="texts" align="center">
        	<td><b>單碼</b></td>
            <td><b>明細</b></td>
            <td><b>金額</b></td>
            <td><b>可贏</b></td>
            <td><b>結果</b></td>
        </tr>
        <tfoot id="vList"></tfoot>
    </table>
</div>
</body>
</html>