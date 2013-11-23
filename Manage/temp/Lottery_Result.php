<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'function/opNumberList.php';

if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2){
	//加載重慶
	$numberList = numberList(2);
	$GameType = 2;
} else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3){
	//加載广西
	$numberList = numberList(3);
	$GameType = 3;
} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 5){
	//加載农场
	$numberList = numberList(5);
	$GameType = 5;
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6){
	//加載PK10
	$numberList = numberList(6);
	$GameType = 6;
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 7){
	//六合彩
	$numberList = numberList(7);
	$GameType = 7;
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 8){
	//新疆時時彩
	$numberList = numberList(8);
	$GameType = 8;
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 9){
	//江苏骰寶(快3)
	$numberList = numberList(9);
	$GameType = 9;
}
else{
	 $numberList = numberList(1);
	 $GameType = 1;
}
$page = $numberList['page'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<title></title>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif"></td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="t_odds_1">
                            <?php if ($GameType == 1){?>
                            	<tr class="tr_top">
                                	<td width="100px">開獎期數</td>
                                    <td width="124px">開獎時間</td>
                                    <td colspan="8" width="224px">開出號碼</td>
                                    <td colspan="4">總和</td>
                                    <td>龍虎</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="8" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td width="35px"><?php echo$numberList[$i][4]?></td>
                                    <td width="30px"><?php echo $numberList[$i][5]?></td>
                                    <td width="30px"><?php echo $numberList[$i][6]?></td>
                                    <td width="35px"><?php echo $numberList[$i][7]?></td>
                                    <td width="30px"><?php echo $numberList[$i][8]?></td>
                                </tr>
								 <?php }}} else if($GameType == 5){?>
								<tr class="tr_top">
                                	<td>開獎期數</td>
                                    <td>開獎時間</td>
                                    <td>開出號碼</td>
                                    <td colspan="4">總和</td>
                                    <td>家禽野兽</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="8" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <td style="padding-left:18px"><?php echo$numberList[$i][3] ?></td>
                                    <td><?php echo$numberList[$i][4]?></td>
                                    <td><?php echo $numberList[$i][5]?></td>
                                    <td><?php echo $numberList[$i][6]?></td>
                                    <td><?php echo $numberList[$i][7]?></td>
                                    <td><?php echo $numberList[$i][8]?></td>
                                </tr>
								
                                <?php }}} else if ($GameType == 3){?>
                            	<tr class="tr_top">
                                	<td width="100px">開獎期數</td>
                                    <td width="124px">開獎時間</td>
                                    <td colspan="5">開出號碼</td>
                                    <td colspan="4">總和</td>
                                    <td>龍虎</td>
									<td colspan="6">特码</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="14" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td width="35px"><?php echo$numberList[$i][4]?></td>
                                    <td width="30px"><?php echo $numberList[$i][5]?></td>
                                    <td width="30px"><?php echo $numberList[$i][6]?></td>
                                    <td width="35px"><?php echo $numberList[$i][7]?></td>
                                    <td width="35px"><?php echo $numberList[$i][8]?></td>
									<td width="30px"><?php echo $numberList[$i][9]?></td>
			 						<td width="30px"><?php echo $numberList[$i][10]?></td>
			 						<td width="50px"><?php echo $numberList[$i][11]?></td>
			 						<td width="35px"><?php echo $numberList[$i][12]?></td>
			 						<td width="30px"><?php echo $numberList[$i][13]?></td>
			 						<td width="30px"><?php echo $numberList[$i][14]?></td>
                                </tr>
								
								 <?php }}} else if ($GameType == 7){?>
                            	<tr class="tr_top">
                                	<td>開獎期數</td>
                                    <td>開獎時間</td>
                                    <td width="250" colspan="7">開出號碼</td>
                                    <td>波段</td>
                                    <td>特肖</td>
                                    <td>五行</td>
                                    <td colspan="2">正碼總和</td> 
									<td colspan="2">總和</td> 
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="14" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td><?php echo$numberList[$i][4]?></td>
                                    <td><?php echo $numberList[$i][5]?></td> 
                                    <td><?php echo $numberList[$i][6]?></td>
									 <td><?php echo $numberList[$i][7]?></td>
                                    <td><?php echo $numberList[$i][8]?></td>
									<td><?php echo $numberList[$i][9]?></td>
                                    <td><?php echo $numberList[$i][10]?></td>
                                </tr>
								
								<?php }}} else if ($GameType == 8){?>
                            	<tr class="tr_top">
                                	<td>開獎期數</td>
                                    <td>開獎時間</td>
                                    <td width="250" colspan="5">開出號碼</td>
                                    <td colspan="3">總和</td>
                                    <td>龍虎</td>
                                    <td>前三</td>
                                    <td>中三</td>
                                    <td>后三</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="14" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td><?php echo$numberList[$i][4]?></td>
                                    <td><?php echo $numberList[$i][5]?></td>
                                    <td><?php echo $numberList[$i][6]?></td>
                                    <td><?php echo $numberList[$i][7]?></td>
                                    <td><?php echo $numberList[$i][8]?></td>
                                     <td><?php echo $numberList[$i][9]?></td>
                                      <td><?php echo $numberList[$i][10]?></td>
                                </tr>
								
								<?php }}} else if ($GameType == 9){?>
                            	<tr class="tr_top">
                                	<td>開獎期數</td>
                                    <td>開獎時間</td>
                                    <td width="250" colspan="3">開出號碼</td>
                                    <td>總和</td>
                                    <td>玩法</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="14" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td><?php echo$numberList[$i][4]?></td>
                                    <td><?php echo $numberList[$i][5]?></td>
                                </tr>
                                <?php }}} else if($GameType == 6){?>
								<tr class="tr_top">
                                	<td width="55px">開獎期數</td>
                                    <td width="124px">開獎時間</td>
                                    <td colspan="10">開出號碼</td>
                                    <td colspan="3">冠亞軍和</td>
                                    <td colspan="5">1～5 龍虎</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="8" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td width="35px"><?php echo$numberList[$i][4]?></td>
                                    <td width="30px"><?php echo $numberList[$i][5]?></td>
                                    <td width="30px"><?php echo $numberList[$i][6]?></td>
                                    <td width="30px"><?php echo $numberList[$i][7]?></td>
                                    <td width="30px"><?php echo $numberList[$i][8]?></td>
									<td width="30px"><?php echo $numberList[$i][9]?></td>
                                    <td width="30px"><?php echo $numberList[$i][10]?></td>
									<td width="30px"><?php echo $numberList[$i][11]?></td>
                                </tr>
								<?php }}}else {?>
                                <tr class="tr_top">
                                	<td width="100px">開獎期數</td>
                                    <td width="124px">開獎時間</td>
                                    <td width="135px" colspan="5">開出號碼</td>
                                    <td colspan="3">總和</td>
                                    <td>龍虎</td>
                                    <td>前三</td>
                                    <td>中三</td>
                                    <td>后三</td>
                                </tr>
                                <?php if (!$numberList){?>
                                <tr><td colspan="11" align="center">暫無記錄</td></tr>
                                <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
                                <tr class="td_text">
                                	<td><?php echo$numberList[$i][1]?></td>
                                    <td><?php echo$numberList[$i][2]?></td>
                                    <?php echo$numberList[$i][3] ?>
                                    <td width="35px"><?php echo$numberList[$i][4]?></td>
                                    <td width="30px"><?php echo$numberList[$i][5]?></td>
                                    <td width="30px"><?php echo$numberList[$i][6]?></td>
                                    <td width="35px"><?php echo $numberList[$i][7]?></td>
                                    <td width="35px"><?php echo $numberList[$i][8]?></td>
                                    <td width="35px"><?php echo $numberList[$i][9]?></td>
                                    <td width="35px"><?php echo $numberList[$i][10]?></td>
                                </tr>
								<?php }}}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></td>
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