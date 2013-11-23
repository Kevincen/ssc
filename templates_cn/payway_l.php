<?php
$BankName=$_REQUEST['BankName'];
$res=$db->query("select * from g_paycard where BankName='$BankName'",1);
$Money=$_REQUEST['Money'];
$v_code=$_REQUEST['v_code'];
?>
<div id="div1">
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" align="center">
                                    <tbody>
										 <tr>
                                            <td colspan="2" align="right" bgcolor="#FFFFFF">
                                                <table width="200" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="146" height="18" align="center">
                                                            <a href="#this" class="font-bluemini" onclick="showBZ()">网银自助转账帮助</a></td>
                                                        <td width="54">&nbsp;
                                                            </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center" bgcolor="#FFFFFF">
                                                您已成功提交网银自助转账申请，请及时完成转账！<BR>
												<font color=red>并在附言处填写本站生成的验证码！</font>以便系统更快确认您的转账金额并充值。
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
												<table cellpadding="0" cellspacing="1" width="420"  style="border:#cccccc solid 1px"  align="center">
													<tr style="background:#f9f9f9; ">
														<td width="20%" height="28" align="right">汇款银行：</td>
														<td width="80%"><?=$res[0]['BankName']?></td>
													</tr>
													<tr style="background:#f9f9f9">
														<td height="28" align="right">收款人：</td>
														<td><font color=blue><?=$res[0]['BankUser']?></font>[<a href="#this" onclick="window.clipboardData.setData('Text','<?=$res[0]['BankUser']?>')">点击复制</a>]</td>
													</tr>
													<tr style="background:#f9f9f9">
														<td height="28" align="right">银行账号：</td>
														<td><font color=blue><?=$res[0]['Account']?></font>[<a href="#this" onclick="window.clipboardData.setData('Text','<?=$res[0]['Account']?>')">点击复制</a>]</td>
													</tr>
													<tr style="background:#f9f9f9">
														<td height="28" align="right">开户行地址：</td>
														<td><font color=blue><?=$res[0]['AccountAddr']?></font></td>
													</tr>
													<tr style="background:#f9f9f9">
														<td height="28" align="right">验证码：</td>
														<td ><font color=blue style="background:#FFCC99; font-weight:bold; display:block; padding:3px; width:30px;"><?=$v_code?></font></td>
													</tr>
													<tr style="background:#f9f9f9">
														<td height="28" align="right">用户账号：</td>
														<td><font color="#FF9900"><?=$user[0]['g_name']?></font></td>
													</tr>
													<tr style="background:#f9f9f9">
														<td height="28" align="right">存款金额：</td>
														<td><font color="#FF9900"><?=$Money?>&nbsp;RMB</font></td>
													</tr>
												</table>
											</td>
                                        </tr>
										<tr>
											<td align="center">
												<a href="<?=$res[0]['PayUrl']?>" target="_blank"><img src="/images/Clickonselfhelptransfer-1.gif"  border=0 /></a>
											</td>
										</tr>
                                    </tbody>
                                </table></div>
							<script >parent.document.getElementById('td1').innerHTML=document.getElementById('div1').innerHTML</script>