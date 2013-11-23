<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
header('Location:/templates_r/Manage/oddsInfo2.html');
exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsInfo.js"></script>
<title></title>
</head>
<body>
<input type="hidden" id="s_odds" value="2" />
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
                                    <td width="75">&nbsp;賠率設置</td>
                                    <td width="55"><a href="oddsInfo.php">1-8賠率</a></td>
                                    <td width="125"><a href="oddsInfo2.php">總分龍虎連碼賠率</a></td>
                                    <td width="60">升降總值：</td>
                                    <td><input type="text" id="Ho" class="texta" value="0.001" /></td>
                                   <!-- <td width="60">批量設置：</td>
                                    <td width="95">
                                    	<select id="oddsType">
                                    		<option value="Ball_9">總和、龍虎</option>
                                    	</select>
									</td>
                                    <td width="70">
                                    	<select id="h">
                                    		<option value="h1">總和大</option>
                                    		<option value="h3">總和小</option>
                                    		<option value="h2">總和單</option>
                                    		<option value="h4">總和雙</option>
                                    		<option value="h5">總和尾大</option>
                                    		<option value="h7">總和尾小</option>
                                    		<option value="h6">龍</option>
                                    		<option value="h8">虎</option>
                                    	</select>
									</td>
									<td width="45">
                                    	<select id="s_num">
                                    		<option value="1">升</option>
                                    		<option value="0">降</option>
                                    	</select>
									</td>
                                    <td width="60"><input type="text" id="sHo" class="texta" value="0.001" /></td>
                                    <td><input type="button" class="inputs" value="確認更變" id="m1" onclick="upOddaAll(this)" /></td> -->
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                    <td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                    <td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                    <td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                    <td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                    <td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                    <td>號</td>
                                	<td>賠率</td>
                                    <td>設置</td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">總和大</td>
                                	<td id="ah1" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah1','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah1','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">總和小</td>
                                	<td id="ah3" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah3','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah3','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">總和單</td>
                                	<td id="ah2" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah2','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah2','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">總和雙</td>
                                	<td id="ah4" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah4','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah4','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">總和尾大</td>
                                	<td id="ah5" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah5','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah5','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">總和尾小</td>
                                	<td id="ah7" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah7','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah7','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">龍</td>
                                	<td id="ah6" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah6','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah6','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                </tr>
                                <tr align="center" >
                                	<td class="ball">虎</td>
                                	<td id="ah8" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('ah8','Ball_9',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('ah8','Ball_9',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">任選二</td>
                                	<td id="bh1" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('bh1','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('bh1','Ball_10',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">選二連組</td>
                                	<td id="bh3" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('bh3','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('bh3','Ball_10',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">任選三</td>
                                	<td id="bh4" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('bh4','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('bh4','Ball_10',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">選三前組</td>
                                	<td id="bh6" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('bh6','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('bh6','Ball_10',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">任選四</td>
                                	<td id="bh7" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('bh7','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('bh7','Ball_10',this)" class="aase aase_b" name="0" />
	                                </td>
                                    <td class="ball">任選五</td>
                                	<td id="bh8" style="font-size:14px;color:blueviolet"></td>
                                    <td>
                                    	<input type="button" onclick="setodds('bh8','Ball_10',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input type="button" onclick="setodds('bh8','Ball_10',this)" class="aase aase_b" name="0" />
	                                </td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center">默認賠率表更變不會即時影響正在開盤中的賠率。</td>
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
</body>
</html>