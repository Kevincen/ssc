<?php
echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="120" class="ls">&nbsp;<span id="number"></span>&nbsp;期</td>
                                    <td width="120" class="balls" id="s_type" style="position:relative;top:1px">'.$types.'</td>
									<td width="120" class="balls" id="s_type1" style="position:relative;top:1px; display:none">'.$types.'</td>
                                    <td width="120" style="font-weight:bold"><span id="offTime">加載中...</span><span id="EndTime" style="position:relative;color:red;letter-spacing:1px;">加載中...</span></td>
                                    <td width="180" style="color:red;font-weight:bold">今天輸贏：<span id="win">0</span></td>
    								<td align="right">
    									<span id="q_number"></span>期:
    								</td>
    								<td width="300">
    									<span id="q_a" class="qiuqiu" style="float:left;width:27px;height:27px;"></span>
    									<span id="q_b" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_c" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_d" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_e" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_f" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_g" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_h" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_i" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    									<span id="q_j" class="qiuqiu" style="float:left;width:27px;height:27px"></span>
    								</td>
                                    <td align="right">刷新：<span id="RefreshTime">加載中...</span>&nbsp;&nbsp;
                                    	<select id="EstateTime">
	                                    	<option value="30">30秒</option>
	                                        <option value="60">60秒</option>
	                                        <option value="90" selected="selected">90秒</option>
                                        </select>
                                   </td>
                                  </tr>
</table>';

$HtmlPop = '<div id="oddsPop">
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
            <input type="button" class="inputa" onclick="GoPost(2)" value="補出" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="inputa" onclick="closePop(1)" value="關閉" />
      	</td>
    </tr>
</table>
</div>
<div id="sOddsPop">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
		<td>號</td>
		<td>賠率</td>
		<td>金額</td>
		<td>號</td>
		<td>賠率</td>
		<td>金額</td>
	</tr>
	<tr class="text" align="center">
		<td class="l">01</td>
		<td class="odds" id="w1"></td>
		<td><input type="text" id="q1" class="texta" /></td>
		<td class="l">11</td>
		<td class="odds" id="w11"></td>
		<td><input type="text" id="q11" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">02</td>
		<td class="odds" id="w2"></td>
		<td><input type="text" id="q2" class="texta" /></td>
		<td class="l">12</td>
		<td class="odds" id="w12"></td>
		<td><input type="text" id="q12" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">03</td>
		<td class="odds" id="w3"></td>
		<td><input type="text" id="q3" class="texta" /></td>
		<td class="l">13</td>
		<td class="odds" id="w13"></td>
		<td><input type="text" id="q13" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">04</td>
		<td class="odds" id="w4"></td>
		<td><input type="text" id="q4" class="texta" /></td>
		<td class="l">14</td>
		<td class="odds" id="w14"></td>
		<td><input type="text" id="q14" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">05</td>
		<td class="odds" id="w5"></td>
		<td><input type="text" id="q5" class="texta" /></td>
		<td class="l">15</td>
		<td class="odds" id="w15"></td>
		<td><input type="text" id="q15" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">06</td>
		<td class="odds" id="w6"></td>
		<td><input type="text" id="q6" class="texta" /></td>
		<td class="l">16</td>
		<td class="odds" id="w16"></td>
		<td><input type="text" id="q16" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">07</td>
		<td class="odds" id="w7"></td>
		<td><input type="text" id="q7" class="texta" /></td>
		<td class="l">17</td>
		<td class="odds" id="w17"></td>
		<td><input type="text" id="q17" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">08</td>
		<td class="odds" id="w8"></td>
		<td><input type="text" id="q8" class="texta" /></td>
		<td class="l">18</td>
		<td class="odds" id="w18"></td>
		<td><input type="text" id="q18" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">09</td>
		<td class="odds" id="w9"></td>
		<td><input type="text" id="q9" class="texta" /></td>
		<td class="h">19</td>
		<td class="odds" id="w19"></td>
		<td><input type="text" id="q19" class="texta" /></td>
	</tr>
	<tr class="text" align="center">
		<td class="l">10</td>
		<td class="odds" id="w10"></td>
		<td><input type="text" id="q10" class="texta" /></td>
		<td class="h">20</td>
		<td class="odds" id="w20"></td>
		<td><input type="text" id="q20" class="texta" /></td>
	</tr>
	<tr class="texts">
        <td align="center" height="60" colspan="6">
            <input type="button" class="inputa" onclick="GoPost(2)" value="補出" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="inputa" onclick="closePop(2)" value="關閉" />
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
</div>';
?>