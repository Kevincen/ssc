<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';


$name = base64_decode($_COOKIE['g_user']);


$db=new DB();
$sql = "SELECT * FROM g_zhudan where g_nid='$name' ORDER BY g_id DESC LIMIT 10";
$result1 = $db->query($sql, 1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<style type="text/css">
body {background-color:#5480ED}
</style>
</head>
<script>
function getinfo()
	{
		$.ajax({
			type : "POST",
			url : '/function/Refresh.php',
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						getinfo();
						return false;
					}
				}
			},
			success:function(data){
				var datestr=data.split(';');
				$("#pls").html(datestr[0]);
				$("#xinyong").html(datestr[1]);
				$("#jine").html(datestr[2]);
				$("#tentable").html(datestr[3]);
			}
		});
	}
setInterval(getinfo, 5000);
</script>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="210">
                    <tr>
                        <td class="t_list_caption" colspan="2">請覈對您的帳戶</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">會員帳戶</td>
                        <td class="t_td_text" width="137"><?php echo $user[0]['g_name']?>（<label id="pls" ><?php echo strtoupper($user[0]['g_panlus'])?></label>盤）</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1">信用額度</td>
                        <td id="xinyong"  class="t_td_text"><?php echo is_Number($user[0]['g_money'])?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1">可用金額</td>
                        <td id="jine" class="t_td_text"><?php echo is_Number($user[0]['g_money_yes'])?></td>
                    </tr>
                </table>
<br />
<table border="0" cellpadding="0" cellspacing="1" width="210" class="t_list">
  <tr>
                        <td class="JZRCB"><a href="kfzx.php" target="mainFrame" style="color:#FFFFFF;" title="客服中心"> 客服中心</a></td>
                    </tr>
                    <tr>
                        <td class="JZRCB"><a href="javascript:void(0);" onclick="window.open('http://www.egdfc.com/webvar/sohu/happy10.html','廣東快樂十分','width=687,height=464,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no');" style="color:#FFFFFF;"> “廣東快樂十分”開獎网</a></td>
                    </tr>
                    <tr>
                        <td class="JZRCB"><a href="javascript:void(0);" onclick="window.open('http://video.shishicai.cn/Assist/Test.aspx?lt=4','重慶時時彩','width=488,height=183,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no');" style="color:#FFFFFF;"> “重慶時時彩”開獎网</a></td>
                    </tr>
</table>
<br />
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="210" id="tentable">
<TR class="t_list_caption">
<TD colSpan=4 align="middle"><SPAN class=STYLE2>最新下註的十個單</SPAN></TD></TR>
<TR class="t_list_caption">
<TD align="middle"><FONT color=#000000>時間</FONT></TD>
<TD align="middle"><FONT color=#000000>内容</FONT></TD>
<TD align="middle"><FONT color=#000000>賠率</FONT></TD>
<TD align="middle"><FONT color=#000000>金額</FONT></TD></TR>

<?php for($i=0;$i<count($result1);$i++){

$SumNum = sumCountMoney ($user, $result1[$i], true);
        if ($result1[$i]['g_mingxi_1_str'] == null) {
        	if ($result1[$i]['g_mingxi_1'] == '總和、龍虎' || $result1[$i]['g_mingxi_1'] == '總和、龍虎和'){
        		$n = $result1[$i]['g_mingxi_2'];
        	}else {
        		$n = $result1[$i]['g_mingxi_1'].'『'.$result1[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<font color="#0066FF">'.$n.'</font>';
        } else {
        	$_xMoney = $result1[$i]['g_mingxi_1_str'] * $result1[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result1[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result1[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<font color="#0066FF">'.$result1[$i]['g_mingxi_1'].'</font><br />'.
        				'<span style="line-height:23px">復式  『 '.$result1[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result1[$i]['g_mingxi_2'].'</span>';
        }

?>
<TR class="t_td_text">
<TD align="middle"><FONT color=#000000><?php echo date('H:i:s',strtotime($result1[$i]['g_date']));?></FONT></TD>
<TD align="middle"><FONT color=#000000><?php echo $html?></FONT></TD>
<TD align="middle"><FONT color=#000000><font color="red"><b><?php echo $result1[$i]['g_odds']?></b></font></FONT></TD>
<TD align="middle"><FONT color=#000000><?php echo $result1[$i]['g_jiner']?></FONT></TD></TR>


<?php

}


?>
                </table>
</body>
</html>