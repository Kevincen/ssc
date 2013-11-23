<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$news = null;
$db=new DB();
$text = $db->query("SELECT `g_text` FROM `g_news` WHERE `g_number_show` = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$news = strip_tags($text[0][0]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript">
<!--
var Html = new Array();
Html[0] = '<td class="ag"><a onclick="usclick(this)" href="sGame_sm.php?g=g9" style="color:red;" class="us" target="mainFrame">兩面盤</a></td><td><a onclick="usclick(this)" href="sGame_sz.php?g=g9"  class="us" target="mainFrame">數字盤</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g1" class="us" target="mainFrame">第一球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g2" class="us" target="mainFrame">第二球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g3" class="us" target="mainFrame">第三球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g4" class="us" target="mainFrame">第四球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g5" class="us" target="mainFrame">第五球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g6" class="us" target="mainFrame">第六球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g7" class="us" target="mainFrame">第七球</a></td><td><a onclick="usclick(this)" href="sGame.php?g=g8" class="us" target="mainFrame">第八球</a></td><td><a onclick="usclick(this)" href="sGame_l.php?g=k1" class="us" target="mainFrame">總和、龍虎</a></td><td><a onclick="usclick(this)" href="sGame_k.php?g=k2" class="us aaa" target="mainFrame">連碼</a></td>';
Html[1] = '<td class="ag"><a style="color:red;" onclick="usclick(this)" href="sGame_sm_cq.php?g=g10" class="us" target="mainFrame">兩面盤</a></td><td><a onclick="usclick(this)" href="sGame_sz_cq.php?g=g10"  class="us" target="mainFrame">數字盤</a></td><td><a onclick="usclick(this)" href="sGame_cq.php?g=g1" class="us" target="mainFrame">第一球</a></td><td><a onclick="usclick(this)" href="sGame_cq.php?g=g2" class="us" target="mainFrame">第二球</a></td><td><a onclick="usclick(this)" href="sGame_cq.php?g=g3" class="us" target="mainFrame">第三球</a></td><td><a onclick="usclick(this)" href="sGame_cq.php?g=g4" class="us" target="mainFrame">第四球</a></td><td><a onclick="usclick(this)" href="sGame_cq.php?g=g5" class="us aaa" target="mainFrame">第五球</a></td>';
function usclick($this){
	var us = $(".us");
	us.css("color","");
	$($this).css("color","red");
}

function gamechang($this){
	var shownav = $("#shownav");
	if ($this.value == 1){
		shownav.html(Html[0]);
		window.parent.frames.mainFrame.location.href = "/templates/sGame_sm.php?g=g9";
	} else {
		shownav.html(Html[1]);
		window.parent.frames.mainFrame.location.href = "/templates/sGame_sm_cq.php?g=g10";
	}
}
//-->
</script>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div><!--
<div style="position:absolute;top:1px;">
            <object width="243" height="80" id="top_c" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codeBase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,22,0" altHtml="<embed src=/templates/images/lx.swf name=top_c quality=high wmode=transparent type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash" width=243 height=80></embed>">
            <param name="wmode" value="transparent"/>
            <param name="movie" value="/templates/images/lx.swf"/>
            <param name="menu" value="false"/>
            </object>
            </div> -->
<div style="width:85%; z-index:0;position:absolute;top:37px; padding-left:235px;">
                         <marquee onMouseOut="this.start()" onMouseOver="this.stop()" scrollamount="4" scrolldelay="100">
                            <font style="letter-spacing:1px;color:khaki"><?php echo $news?></font>
                        </marquee>
                    </div>
<div class="t_main">
	<dl>
    	<dt><img src="images/TopLogo_10.jpg" alt="" /></dt>
        <dd class="im">
        	<div onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='658px 0px';"  onmouseout="style.background='url(images/But_S.jpg)';"><a href="topMenu.php" target="mainFrame" title="信用資料"></a></div>
            <div   onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='556px 0px';"  onmouseout="style.background='url()';"><a href="upPwd.php" target="mainFrame" title="修改密碼"></a></div>
            <div onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='454px 0px';"  onmouseout="style.background='url()';"><a href="report.php" target="mainFrame" title="下注明細"></a></div>
            <div onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='352px 0px';"  onmouseout="style.background='url()';"><a href="repore.php" target="mainFrame" title="結算報表"></a></div>
            <div onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='250px 0px';"  onmouseout="style.background='url()';"><a href="result.php" target="mainFrame" title="歷史開獎"></a></div>
            <div class="j"   onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='148px 0px';"  onmouseout="style.background='url()';"><a href="/templates_r/rule.html" class="g" target="mainFrame" title="規則說明"></a></div>
            <div class="j" onmouseover="style.background='url(images/But_S.jpg)';style.backgroundPosition='78px 0px';"  onmouseout="style.background='url()';"><a href="quit.php" class="g" title="安全退出"></a></div>
        </dd>
        <dd class="xm">
        	<table border="0" cellspacing="0" width="658">
            <tr>
            	<td>
            		<select id="LT" onchange="gamechang(this)" style="color: #FF0000;font-weight:bold; position:absolute; top:36px;z-index:1">
                        <option value="1" selected>廣東快樂十分</option>
                         <option value="2">重慶時時彩</option>
                	</select>
                </td>
                <td class="t_o" width="100%" height="24"></td>
            </tr>
            </table>
        </dd>
        <dd>
        	<table border="0" cellspacing="0" class="kj">
                <tr id="shownav">
                	<td class="ag"><a onclick="usclick(this)" href="sGame_sm.php?g=g9" style="color:red;" class="us" target="mainFrame">兩面盤</a></td>
					<td ><a onclick="usclick(this)" href="sGame_sz.php?g=g10" class="us" target="mainFrame">數字盤</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g1" class="us" target="mainFrame">第一球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g2" class="us" target="mainFrame">第二球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g3" class="us" target="mainFrame">第三球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g4" class="us" target="mainFrame">第四球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g5" class="us" target="mainFrame">第五球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g6" class="us" target="mainFrame">第六球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g7" class="us" target="mainFrame">第七球</a></td>
                    <td><a onclick="usclick(this)" href="sGame.php?g=g8" class="us" target="mainFrame">第八球</a></td>
                    <td><a onclick="usclick(this)" href="sGame_l.php?g=k1" class="us" target="mainFrame">總和、龍虎</a></td>
                    <td><a onclick="usclick(this)" href="sGame_k.php?g=k2" class="us aaa" target="mainFrame">連碼</a></td>
                </tr>
        	</table>
        </dd>
    </dl>
</div>
</body>
</html>