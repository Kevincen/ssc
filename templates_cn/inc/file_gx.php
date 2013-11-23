<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-9
*/

$htmlsrc1='<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="110" height="20" class="bolds">廣西快樂十分</td>
        <td  colspan="2"  style="color:red; font-family:Helvetica, sans-serif" class="bolds">
         <div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span></div><div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div>
        </td>
		<td class="bolds" style="color:red" align="right"><img id="soundbut" src="images/soundon.png" width="27" height="19" value="on" onclick="soundset(this);"  title="开奖音开关"/></td>
        <td class="bolds" width="132">
        <span id="n" style="font-size:14px;position:relative; top:1px"></span>期開獎
        </td>
        <td id="g"  ></td>
        <td id="h"  ></td>
        <td id="a" class="l"></td>
        <td id="b" class="l"></td>
        <td id="c" class="l"></td>
        <td id="d" class="l"></td>
        <td id="e" class="l"></td>
    </tr>
    <tr>
    	<td height="30"><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="82"><span style="color:#0033FF; font-weight:bold" id="tys">'.$types.'</span></td> <td width="150"><form id="form1" name="form1" method="post" action="selpan.php">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			document.form1.submit();
			}
			
			</script>
           
           </label>
		   <input type="hidden" value="'.$g.'" name="gp"/>
		     <input type="hidden" value="'.$gurl.'" name="gsrc"/>
      </form></td>
	  <td></td>
	  <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red; font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table><input type="hidden" id="mix" value="'.$ConfigModel['g_mix_money'].'"><div id="look" style="display:none"></div>';

echo $htmlsrc1.$htmlsrc2;
?>