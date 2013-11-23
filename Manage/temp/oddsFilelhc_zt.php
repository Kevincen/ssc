<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/temp/offGamelhc.php'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsFilelhc.js"></script>
<script language="javascript">
var red='<?=implode(",",$CONFIG["lhc_rgb"]['red_arr'])?>';
var green='<?=implode(",",$CONFIG["lhc_rgb"]['green_arr'])?>';
var blue='<?=implode(",",$CONFIG["lhc_rgb"]['blue_arr'])?>';
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
    								<td width="450">
    									<span id="q_a" class="qiuqiu" style="float:left"></span>
    									<span id="q_b" class="qiuqiu" style="float:left"></span>
    									<span id="q_c" class="qiuqiu" style="float:left"></span>
    									<span id="q_d" class="qiuqiu" style="float:left"></span>
    									<span id="q_e" class="qiuqiu" style="float:left"></span>
										<span id="q_f" class="qiuqiu" style="float:left"></span>
    									<span id="q_g" class="qiuqiu" style="float:left"></span>
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
						<?php
						$arr=array("特碼"=>"g","正碼"=>"h");
						$numarr=array();
						for($i=1;$i<=49;$i++){
							$numarr[$i-1]= strlen($i)==1 ? "0".$i : $i; 
						}
						$carr=array("大","小","單","雙","合單","合雙","紅波","綠波","藍波","合大","合小","尾大","尾小","大單","大雙","小單","小雙","紅大單","紅大雙","紅小單","紅小雙","藍大單","藍大雙","藍小單","藍小雙","綠大單","綠大雙","綠小單","綠小雙");
						$tarr=array("總大","總小","總單","總雙");
						$tm=array_merge($numarr,$carr);
						$zm=array_merge($numarr,$tarr);
						foreach($arr as $k=>$char){ 
								?>
						<table border="0" cellspacing="0" class="t_odds" >
							<tr class="tr_top">
								<td colspan="24"><?=$k?></td>
							</tr>
							<tr class="tr_top">
								<td>號</td>
								<td>賠率</td>
								<td>注額</td>
								<td>盈虧</td> 
								
								<td>號</td>
								<td>賠率</td>
								<td>注額</td>
								<td>盈虧</td> 
								
								<td>號</td>
								<td>賠率</td>
								<td>注額</td>
								<td>盈虧</td> 
								
								<td>號</td>
								<td>賠率</td>
								<td>注額</td>
								<td>盈虧</td> 
								
								<td>號</td>
								<td>賠率</td>
								<td>注額</td>
								<td>盈虧</td> 
								
								<td>號</td>
								<td>賠率</td>
								<td>注額</td>
								<td>盈虧</td> 
							</tr> 
							<tr align="center">
								<?php
								if($char=="g"){
									$arr=$tm;
								}else{
									$arr=$zm;
								}
								for($i=0;$i<count($arr);$i++){
									?>  
									<td class="ball" style="width:50px;"><?=$arr[$i]?></td>
									<td class="odds" style="width:50px;" id="<?=$char?>h<?=($i+1)?>" width="76"></td>
									<td class="odds <?=$char?>" style="width:50px; background:none"><a href="CrystalIsNot.php?pid=<?php echo base64_encode($arr[$i])?>&tid=<?php echo base64_encode($k)?>&cid=7" class="aah<?=($i+1)?>" target="_blank">-</a></td>
									<td class="odds <?=$char?>" style="width:80px; background:none"><a class="psp bah<?=($i+1)?>" >-</a></td> 
									<?php
									if(($i+1)%6==0)echo '<tr align="center">';
								}
								?> 
							</table> 
							<?php
							}
							?>
							
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
                        <input type="text" class="textb" id="Param" value="-10000000"  />&nbsp;&nbsp;
                        <input type="button" class="inputs"  value="計算補貨"/>&nbsp;&nbsp;
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