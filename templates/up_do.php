<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/sc.js"></script>
<style type="text/css">
body {background-color:#ffefe2}
</style>
</head>
<body>
<div style="display:none">
</div>
    <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="210">
    <tr>
        <td class="t_list_caption" colspan="2"><span>第一球</span> - 下註</td>
    </tr>
    <tr>
        <td class="t_td_caption_1" width="64">會員帳戶</td>
        <td class="t_td_text" width="137"><?php echo $user[0]['g_name']?>（<?php echo $user[0]['g_panlu']?>盤）</td>
    </tr>
    <tr>
        <td class="t_td_caption_1">可用金額</td>
        <td class="t_td_text">200</td>
    </tr>
    <tr class="t_td_but">
        <td colspan="2" align="center">
            <input type="button" value="打印" style="width:50px" />
            <input type="button" value="返回" style="width:50px" />
        </td>
    </tr>
    <tr class="t_td_unite_1">
    	<th colspan="2">2011112929期</th>
    </tr>
    <tr class="t_td_text">
    	<td colspan="2">
        <!-- 需要動態載入，包括所有標籤 -->
        	註單號：<span>107953</span> #<br />
            <div style="text-align:center;">
                <span style="color:#0000FF">第一球『 <span>01</span> 』</span>@
                <span style="color:red; font-weight:bold">19.3</span>
            </div>
            下註額：<span>20</span><br />
            可贏額：<span>183</span><br />
            <!-- 連碼載入格式 
            <table border="0" cellpadding="0" cellspacing="1" style="margin:0 auto; width:99%; margin-bottom:2px; background:#BFDEFF">
            	<tr class="s_td_3">
                	<td>ID</td>
                    <td>號碼組合</td>
                    <td>下註額</td>
                </tr>
                <tr class="s_td_4">
                	<td>1</td>
                    <td>02,05</td>
                    <td align="left">￥1</td>
                </tr>
            </table>
              連碼載入格式 end -->
            <!-- 需要動態載入，包括所有標籤 end -->
        </td>
    </tr>
    <tr>
    	<td class="t_td_caption_2" width="64">下註筆數</td>
        <td class="t_td_text" width="137"><span>1</span> 筆</td>
    </tr>
    <tr>
    	<td class="t_td_caption_2" width="64">總計註額</td>
        <td class="t_td_text" width="137">￥<span>10</span></td>
    </tr>
</table>
</body>
</html>