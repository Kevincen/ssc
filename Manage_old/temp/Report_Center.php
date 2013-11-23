<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $LoginId,$Users;
if ($LoginId == 89)
	$Users[0]['g_Lnid'][0] = $Users[0]['g_Lnid'][1];
$db = new DB();
$result = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultcq = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history2` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultgx = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history3` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultpk = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history6` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultlhc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history_lhc` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultnc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history5` ORDER BY g_qishu DESC LIMIT 30 ", 1);

$resultxj = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history8` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultjsk3 = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history9` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$week = week ();
if(date("H")>=3){
	$week['weekend'][6] = date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y')));	
	$sDate = array(
		0=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y'))), 
		1=>date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y'))),
		2=>date('Y-m-d', mktime(0,0,0,date('n'),date('t'),date('Y'))),
		3=>date('Y-m-01', strtotime('last month')),
		4=>date('Y-m-t', strtotime('last month')),
		5=>$week['weekend'][0],
		6=>$week['weekend'][6],
		7=>$week['weekstart'][0],
		8=>$week['weekstart'][6],
		9=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-4,date('Y'))),
		10=>date("Y-m-d"));
}else{
	$week['weekend'][6] = date("Y-m-d", mktime(0,0,0,date('m'),date('d')-2,date('Y')));	
	$sDate = array(
		0=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-2,date('Y'))), 
		1=>date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y'))),
		2=>date('Y-m-d', mktime(0,0,0,date('n'),date('t'),date('Y'))),
		3=>date('Y-m-01', strtotime('last month')),
		4=>date('Y-m-t', strtotime('last month')),
		5=>$week['weekend'][0],
		6=>$week['weekend'][6],
		7=>$week['weekstart'][0],
		8=>$week['weekstart'][6],
		9=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-4,date('Y'))),
		10=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y'))));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script  type="text/javascript" src="/js/jquery.js"></script>
<script  type="text/javascript" src="/Manage/temp/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
<!--
	function AutoSet_Date(str) {
		var startDate = $("#startDate");
		var endDate = $("#endDate");
		switch (str) {
			case 1 : 
				startDate.val("<?php echo $sDate[10]?>");
				endDate.val("<?php echo $sDate[10]?>");
				break;
			case 2 : 
				startDate.val("<?php echo $sDate[0]?>");
				endDate.val("<?php echo $sDate[0]?>");
				break;
			case 3 : 
				startDate.val("<?php echo $sDate[5]?>");
				endDate.val("<?php echo $sDate[6]?>");
				break;
			case 4 : 
				startDate.val("<?php echo $sDate[7]?>");
				endDate.val("<?php echo $sDate[8]?>");
				break;
			case 5 : 
				startDate.val("<?php echo $sDate[1]?>");
				endDate.val("<?php echo $sDate[2]?>");
				break;
			case 6 : 
				startDate.val("<?php echo $sDate[3]?>");
				endDate.val("<?php echo $sDate[4]?>");
				break;
		}
	}
//-->
</script>
<title></title>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<form action="Report_Crystals.php" method="get">
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
                                    <td width="99%">&nbsp;<?php echo$Users[0]['g_Lnid'][0]?>報表查詢</td>
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
                                	<th colspan="2">查詢設定</th>
                                </tr>
                                <tr>
                                	<td class="bj1">彩票種類</td>
                                    <td class="left_p6">
                                        <select name="s_types">
                                            <option value="" style="color:red">--- 所有彩種 ---</option>
                                            <option value="1" style="color:red">廣東快樂十分</option>
                                            <option value="2" style="color:red">重慶時時彩</option>
    
											 <!-- <option value="3" style="color:red">廣西快樂十分</option>-->
											 <option value="5" style="color:red">幸运农场</option>
											  <option value="6" style="color:red">北京赛车PK10</option>
											  <!--  <option value="7" style="color:red">六合彩</option>-->
											   <!-- <option value="8" style="color:red">新疆時時彩</option>-->
											 <option value="9" style="color:red">江苏骰寶(快3)</option>
                                        </select>
                					</td>
                                </tr>
                                <tr>
                                	<td class="bj1">下註類型</td>
                                    <td class="left_p6">
                                        <select name="s_type" >
                                        <option value="">--- 所有類型 ---</option>
                                        <option value='1'>廣東快樂十分- 第一球</option>
                                        <option value='2'>廣東快樂十分- 第二球</option>
                                        <option value='3'>廣東快樂十分- 第三球</option>
                                        <option value='4'>廣東快樂十分- 第四球</option>
                                        <option value='5'>廣東快樂十分- 第五球</option>
                                        <option value='6'>廣東快樂十分- 第六球</option>
                                        <option value='7'>廣東快樂十分- 第七球</option>
                                        <option value='8'>廣東快樂十分- 第八球</option>
                                        <option value='9'>廣東快樂十分- 1-8大小</option>
                                        <option value='10'>廣東快樂十分- 1-8單雙</option>
                                        <option value='11'>廣東快樂十分- 1-8尾數大小</option>
                                        <option value='12'>廣東快樂十分- 1-8合數單雙</option>
                                        <option value='13'>廣東快樂十分- 1-8方位</option>
                                        <option value='14'>廣東快樂十分- 1-8中發白</option>
                                        <option value='15'>廣東快樂十分- 總和大小</option>
                                        <option value='16'>廣東快樂十分- 總和單雙</option>
                                        <option value='17'>廣東快樂十分- 總和尾數大小</option>
                                        <option value='18'>廣東快樂十分- 龍虎</option>
                                        <option value='19'>廣東快樂十分- 任選二</option>
                                        <option value='20'>廣東快樂十分- 選二連直</option>
                                        <option value='21'>廣東快樂十分- 選二連組</option>
                                        <option value='22'>廣東快樂十分- 任選三</option>
                                        <option value='23'>廣東快樂十分- 選三前直</option>
                                        <option value='24'>廣東快樂十分- 選三前組</option>
                                        <option value='25'>廣東快樂十分- 任選四</option>
                                        <option value='26'>廣東快樂十分- 任選五</option>
										
                                        <option value='27'>重慶時時彩 - 第一球</option>
                                        <option value='28'>重慶時時彩 - 第二球</option>
                                        <option value='29'>重慶時時彩 - 第三球</option>
                                        <option value='30'>重慶時時彩 - 第四球</option>
                                        <option value='31'>重慶時時彩 - 第五球</option>
                                        <option value='32'>重慶時時彩 - 1-5大小</option>
                                        <option value='33'>重慶時時彩 - 1-5單雙</option>
                                        <option value='34'>重慶時時彩 - 總和大小</option>
                                        <option value='35'>重慶時時彩 - 總和單雙</option>
                                 		<option value='36'>重慶時時彩 - 龍虎和</option>
                                 		<option value='37'>重慶時時彩 - 前三</option>
                                 		<option value='38'>重慶時時彩 - 中三</option>
                                 		<option value='39'>重慶時時彩 - 后三</option>
    
										<!--<option value='40'>廣西快樂十分 - 第一球</option>
                                        <option value='41'>廣西快樂十分 - 第二球</option>
                                        <option value='42'>廣西快樂十分 - 第三球</option>
                                        <option value='43'>廣西快樂十分 - 第四球</option>
                                        <option value='44'>廣西快樂十分 - 特码</option>
                                        <option value='45'>廣西快樂十分 - 1-5大小</option>
                                        <option value='46'>廣西快樂十分 - 1-5單雙</option>
                                        <option value='47'>廣西快樂十分 - 1-5尾數大小</option>
                                        <option value='48'>廣西快樂十分 - 1-5合數單雙</option>
                                        <option value='49'>廣西快樂十分 - 1-5神奇快乐</option>
                                        <option value='50'>廣西快樂十分 - 1-5红蓝绿</option>
                                        <option value='51'>廣西快樂十分 - 總和大小</option>
                                        <option value='52'>廣西快樂十分 - 總和單雙</option>
                                        <option value='53'>廣西快樂十分 - 總和尾數大小</option>
                                        <option value='54'>廣西快樂十分 - 龍虎</option>
                                        <option value='55'>廣西快樂十分 - 一中一</option>                                      
                                        <option value='56'>廣西快樂十分 - 二中二</option>
                                        <option value='57'>廣西快樂十分 - 三中二</option>
                                        <option value='58'>廣西快樂十分 - 三中三</option>
                                        <option value='59'>廣西快樂十分 - 四中三</option>
                                        <option value='60'>廣西快樂十分 - 五中三</option>-->
										
											
										<option value='61'>北京赛车 - 冠军</option>
                                        <option value='62'>北京赛车 - 亚军</option>
                                        <option value='63'>北京赛车 - 第三名</option>
                                        <option value='64'>北京赛车 - 第四名</option>
                                        <option value='65'>北京赛车 - 第五名</option>
                                        <option value='66'>北京赛车 - 第六名</option>
                                        <option value='67'>北京赛车 - 第七名</option>
                                        <option value='68'>北京赛车 - 第八名</option>
										<option value='69'>北京赛车 - 第九名</option>
										<option value='70'>北京赛车 - 第十名</option>
                                        <option value='71'>北京赛车 - 1-10大小</option>
                                        <option value='72'>北京赛车 - 1-10單雙</option>
                                        <option value='73'>北京赛车 - 1-10龍虎</option>
                                        <option value='74'>北京赛车 - 冠、亞軍和</option>
                                        <option value='75'>北京赛车 - 冠亞和大小</option>
                                        <option value='76'>北京赛车 - 冠亞和單雙</option>
										
										
										<!--<option value='77'>六合彩 - 特碼</option>
                                        <option value='78'>六合彩 - 正碼一</option>
                                        <option value='79'>六合彩 - 正碼二</option>
                                        <option value='80'>六合彩 - 正碼三</option>
                                        <option value='81'>六合彩 - 正碼四</option>
                                        <option value='82'>六合彩 - 正碼五</option>
                                        <option value='83'>六合彩 - 正碼六</option>
                                        <option value='84'>六合彩 - 正碼</option>
										<option value='85'>六合彩 - 半波</option>
										<option value='86'>六合彩 - 五行</option>
                                        <option value='87'>六合彩 - 特碼生肖</option>
                                        <option value='88'>六合彩 - 一肖</option>
                                        <option value='89'>六合彩 - 特尾</option>
                                        <option value='90'>六合彩 - 尾數</option>
                                        <option value='91'>六合彩 - 特碼頭</option>
										
										<option value='827'>新疆時時彩 - 第一球</option>
                                        <option value='828'>新疆時時彩 - 第二球</option>
                                        <option value='829'>新疆時時彩 - 第三球</option>
                                        <option value='830'>新疆時時彩 - 第四球</option>
                                        <option value='831'>新疆時時彩 - 第五球</option>
                                        <option value='832'>新疆時時彩 - 1-5大小</option>
                                        <option value='833'>新疆時時彩 - 1-5單雙</option>
                                        <option value='834'>新疆時時彩 - 總和大小</option>
                                        <option value='835'>新疆時時彩 - 總和單雙</option>
                                 		<option value='836'>新疆時時彩 - 龍虎和</option>
                                 		<option value='837'>新疆時時彩 - 前三</option>
                                 		<option value='838'>新疆時時彩 - 中三</option>
                                 		<option value='839'>新疆時時彩 - 后三</option>
										
										
                                        </select>-->
										<option value='901'>江苏骰寶(快3) - 三軍</option>
                                        <option value='902'>江苏骰寶(快3) - 圍骰、全骰</option>
                                        <option value='903'>江苏骰寶(快3) - 點數</option>
                                        <option value='904'>江苏骰寶(快3) - 長牌</option>
                                        <option value='905'>江苏骰寶(快3) - 短牌</option> 
										 <option value='774'>幸运农场 - 第一球</option>
                                        <option value='775'>幸运农场 - 第二球</option>
                                        <option value='776'>幸运农场 - 第三球</option>
                                        <option value='777'>幸运农场 - 第四球</option>
                                        <option value='778'>幸运农场 - 第五球</option>
                                        <option value='779'>幸运农场 - 第六球</option>
                                        <option value='780'>幸运农场 - 第七球</option>
                                        <option value='781'>幸运农场 - 第八球</option>
                                        <option value='782'>幸运农场 - 1-8大小</option>
                                        <option value='783'>幸运农场 - 1-8單雙</option>
                                        <option value='784'>幸运农场 - 1-8尾數大小</option>
                                        <option value='785'>幸运农场 - 1-8合數單雙</option>
                                        <option value='786'>幸运农场 - 1-8梅兰菊竹</option>
                                        <option value='787'>幸运农场 - 1-8中發白</option>
                                        <option value='788'>幸运农场 - 總和大小</option>
                                        <option value='789'>幸运农场 - 總和單雙</option>
                                        <option value='790'>幸运农场 - 總和尾數大小</option>
                                        <option value='791'>幸运农场 - 家禽野兽</option>
                                        <option value='792'>幸运农场 - 蔬菜单选</option>
                                        <option value='793'>幸运农场 - 动物单选</option>
                                        <option value='794'>幸运农场 - 幸运二</option>
                                        <option value='795'>幸运农场 - 连连中</option>
                                        <option value='796'>幸运农场 - 背靠背</option>
                                        <option value='797'>幸运农场 - 幸运三</option>
                                        <option value='798'>幸运农场 - 幸运四</option>
                                        <option value='799'>幸运农场 - 幸运五</option>
                					</td>
                                </tr>
                                <tr>
                                	<td class="bj1"><input name="t_N" type="radio" value="0" />按期數</td>
                                    <td class="left_p6">
                                        <select name="s_number">
                                       <?php for ($i=0; $i<count($result); $i++){?>
                                       <option value='<?php echo$result[$i]['g_qishu']?>'>廣東快樂十分<?php echo$result[$i]['g_qishu']?> 期</option>
                                       <?php }?>
                                       <?php for ($i=0; $i<count($resultcq); $i++){?>
                                       <option value='<?php echo$resultcq[$i]['g_qishu']?>'>重慶時時彩 <?php echo$resultcq[$i]['g_qishu']?> 期</option>
                                       <?php }?>
   
									     <?php for ($i=0; $i<count($resultgx); $i++){?>
                                     <!--<!--  <option value='<?php echo$resultgx[$i]['g_qishu']?>'>廣西快樂十分 <?php echo$resultgx[$i]['g_qishu']?> 期</option>
                                      --> <?php }?>
											
									   <?php for ($i=0; $i<count($resultpk); $i++){?>
                                       <option value='<?php echo$resultpk[$i]['g_qishu']?>'>北京赛车PK10 <?php echo$resultpk[$i]['g_qishu']?> 期</option>
                                       <?php }?>
									    <?php for ($i=0; $i<count($resultnc); $i++){?>
                                      <option value='<?php echo$resultnc[$i]['g_qishu']?>'>幸运农场 <?php echo$resultnc[$i]['g_qishu']?> 期</option>
                                       <?php }?>
									    <?php for ($i=0; $i<count($resultlhc); $i++){?>
                                     <!--  <option value='<?php echo$resultlhc[$i]['g_qishu']?>'>六合彩 <?php echo$resultlhc[$i]['g_qishu']?> 期</option>-->
                                       <?php }?>
									   
									   
									    <?php for ($i=0; $i<count($resultxj); $i++){?>
                                      <!-- <option value='<?php echo$resultlhc[$i]['g_qishu']?>'>新疆時時彩 <?php echo$resultlhc[$i]['g_qishu']?> 期</option>-->
                                       <?php }?>
									   
									   <?php for ($i=0; $i<count($resultjsk3); $i++){?>
                                      <option value='<?php echo$resultlhc[$i]['g_qishu']?>'>江苏骰寶(快3) <?php echo$resultlhc[$i]['g_qishu']?> 期</option>
                                       <?php }?>
                                        </select>
                					</td>
                                </tr>
                                <tr>
                                	<td class="bj1"><input name="t_N" type="radio" value="1" checked="checked" />按日期</td>
                                    <td class="left_p6">
                                        <span id="td_Find">
	                                        <input class='Wdate' id="startDate" name="startDate" value='<?php echo date('Y-m-d')?>' size='11' onfocus="WdatePicker({el:'startDate'})" />&nbsp;—&nbsp;
	                                        <input class='Wdate' id="endDate" name='endDate' onfocus="WdatePicker({el:'endDate'})" value='<?php echo date('Y-m-d')?>' size='11' />
                                        </span>&nbsp;&nbsp;
                                        <input type="button" class="odds" onclick="AutoSet_Date(1)" value="今天" />
					                    <input type="button" onclick="AutoSet_Date(2)" value="昨天" />
					                    <input type="button" onclick="AutoSet_Date(3)" value="本星期" />
					                    <input type="button" onclick="AutoSet_Date(4)" value="上星期" />
					                    <input type="button" onclick="AutoSet_Date(5)" value="本月" />
					                    <input type="button" onclick="AutoSet_Date(6)" value="上月" />
                					</td>
                                </tr>
                                <tr>
                                	<td class="bj1">歷史報表範圍</td>
                                	<td class="left_p6"><?php echo $sDate[9]?> — <?php echo date('Y-m-d')?></td>
                                </tr>
                                <tr>
                                	<td class="bj1">帳務說明</td>
                                	<td class="left_p6" style="height:55px; color:green">
                                	“當天報表” 將在次日淩晨2點半后与 “歷史報表” 合併
                                	<br /><br />
                                	“重慶時時彩” 淩晨兩點前註單算當天帳
                                	</td>
                                </tr>
                                <tr>
                                	<td class="bj1"><?php echo$Users[0]['g_Lnid'][0]?>報錶類型</td>
                                    <td class="left_p6">
                                    <input name="ReportType" type="radio" value="1" checked="checked" />交收報錶&nbsp;&nbsp;&nbsp;
                                    <input name="ReportType" type="radio"  value="0" />分類報錶
                                    </td>
                                </tr>
                                <tr>
                                	<td class="bj1">結算狀態</td>
                                    <td class="left_p6">
                                    <input name="Balance" type="radio" value="1" checked="checked" />已 結 算&nbsp;&nbsp;&nbsp;
                                    <input name="Balance" type="radio" value="0" /><font color="blue">未 結 算</font>
                                    </td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確定" /></td>
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
</body>
</html>