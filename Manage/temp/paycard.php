<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $ConfigModel, $BakPassWord;

if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_7'])){
	if ($Users[0]['g_lock_1_7'] !=1) 
		exit(back('您的權限不足！'));
}

$result = $db->query("select * from g_paycard order by id", 1);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script> 
<title></title>
</head>
<body>
<form action="" method="post" onsubmit="return dataBakPost()">
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
                                    <td width="99%">&nbsp;银行卡设置【<a href="paycardopt.php">添加</a>】</td>
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
									<td width="45">序號</td>
                                    <td>银行</td>	
									<td>收款人</td>
									<td>银行账号</td> 
									<td>开户行</td> 
									<td>网址</td> 
									<td>操作</td>	
                                </tr>
                                <?php
								$n = 1;
                                foreach ($result as $line){
                                	?>
                                <tr align="center" style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
									<td><?php echo $line['id']?></td>
                                	<td><?php echo $line['BankName']?></td>
									<td><?php echo $line['BankUser']?></td>
                                    <td><?php echo $line['Account']?></td>
                                    <td><?php echo $line['AccountAddr']?></td>
                                    <td><?php echo $line['PayUrl']?></td>
                                    <td><a href="paycardopt.php?id=<?=$line['id']?>" >修改</a> 
										<a href="?act=del&id=<?=$line['id']?>">删除</a> </td>
                                </tr>
                                <?php $n++; }?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"></td>
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
    </form>
<div id="oddsPops" style="position:absolute;width:190px;display:none">

</div>
</body>
</html>