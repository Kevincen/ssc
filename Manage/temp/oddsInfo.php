<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $ConfigModel,$Users;

if ($Users[0]['g_login_id'] != 89) 
	exit;

if (isset($Users[0]['g_lock_1_2'])){
	if ($Users[0]['g_lock_1_2'] !=1) 
		exit(back('您的權限不足！'));
}
if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2){
	header('Location:/templates_r/Manage/oddsInfo3.html');
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3){
	header('Location:/templates_r/Manage/oddsInfogx.html');
} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 5){
	header('Location:/templates_r/Manage/oddsInfonc.html');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6){
	header('Location:/templates_r/Manage/oddsInfopk.html');
} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 7){
	header('Location:/templates_r/Manage/oddsInfolhc.php');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 8){
	header('Location:/templates_r/Manage/oddsInfo83.html');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 9){
	header('Location:/templates_r/Manage/oddsInfojsk3.php');
}else{
	header('Location:/templates_r/Manage/oddsInfo.html');
	exit;
}

function sSwitch($n){
	switch ($n){
		case 21: $n = '大';break;
		case 22: $n = '小';break;
		case 23: $n = '單';break;
		case 24: $n = '雙';break;
		case 25: $n = '尾大';break;
		case 26: $n = '尾小';break;
		case 27: $n = '合數單';break;
		case 28: $n = '合數雙';break;
		case 29: $n = '東';break;
		case 30: $n = '南';break;
		case 31: $n = '西';break;
		case 32: $n = '北';break;
		case 33: $n = '中';break;
		case 34: $n = '發';break;
		case 35: $n = '白';break;
	}
	return $n;
}
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
<input type="hidden" id="s_odds" value="1" />
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
                                    <td width="90"><input type="text" id="Ho" class="texta" value="0.001" /></td>
                                    <td width="60">批量設置：</td>
                                    <td width="80">
                                    	<select id="oddsType">
                                    		<option value="">---全部---</option>
                                    		<option value="Ball_1">第一球</option>
                                    		<option value="Ball_2">第二球</option>
                                    		<option value="Ball_3">第三球</option>
                                    		<option value="Ball_4">第四球</option>
                                    		<option value="Ball_5">第五球</option>
                                    		<option value="Ball_6">第六球</option>
                                    		<option value="Ball_7">第七球</option>
                                    		<option value="Ball_8">第八球</option>
                                    	</select>
									</td>
                                    <td width="70">
                                    	<select id="h">
                                    	<?php for ($i=1; $i<36; $i++){
                                    		if(mb_strlen($i) == 1){$h = '0'.$i;} else {$h = $i;}
                                    		$s = sSwitch($h);
                                    		?>
                                    		<option value="h<?php echo$i?>"><?php echo $s?></option>
                                    	<?php }?>
                                    	</select>
									</td>
									<td width="45">
                                    	<select id="s_num">
                                    		<option value="0">降</option>
                                    		<option value="1">升</option>
                                    	</select>
									</td>
                                    <td><input type="button" class="inputs" value="確認更變" id="m1" onclick="upOddaAll(this)" /></td>
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
                                	<td>第一球</td>
                                    <td>設置</td>
                                    <td>第二球</td>
                                    <td>設置</td>
                                    <td>第三球</td>
                                    <td>設置</td>
                                    <td>第四球</td>
                                    <td>設置</td>
                                    <td>第五球</td>
                                    <td>設置</td>
                                    <td>第六球</td>
                                    <td>設置</td>
                                    <td>第七球</td>
                                    <td>設置</td>
                                    <td>第八球</td>
                                    <td>設置</td>
                                </tr>
                                <?php 
                                for ($i=1; $i<=35; $i++){
                                 if ($i == 19 || $i == 20){$ball = 'red'; }else {$ball='ball';}
                                 if(mb_strlen($i) == 1){$n = '0'.$i;} else {$n = $i;}
                                 $m = sSwitch($n);
                                ?>
                                <tr align="center" >
                                	<td class="<?php echo$ball?>"><?php echo$m?></td>
                                	<td width="70" id="ah<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('ah<?php echo$i?>','Ball_1',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('ah<?php echo$i?>','Ball_1',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="bh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('bh<?php echo$i?>','Ball_2',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('bh<?php echo$i?>','Ball_2',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="ch<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('ch<?php echo$i?>','Ball_3',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('ch<?php echo$i?>','Ball_3',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="dh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('dh<?php echo$i?>','Ball_4',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('dh<?php echo$i?>','Ball_4',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="eh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('eh<?php echo$i?>','Ball_5',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('eh<?php echo$i?>','Ball_5',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="fh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('fh<?php echo$i?>','Ball_6',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('fh<?php echo$i?>','Ball_6',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="gh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('gh<?php echo$i?>','Ball_7',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('gh<?php echo$i?>','Ball_7',this)" class="aase aase_b" name="0" />
                                    </td>
                                    <td width="70" id="hh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                    <td>
	                                    <input title="上調賠率" type="button" onclick="setodds('hh<?php echo$i?>','Ball_8',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('hh<?php echo$i?>','Ball_8',this)" class="aase aase_b" name="0" />
                                    </td>
                                </tr>
                                <?php }?>
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