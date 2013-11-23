<?php
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
include_once ROOT_PATH.'function/global.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title?></title>
<link type="text/css" rel="stylesheet" href="/pagef/login.css">
<style type="text/css">
<!--
    body {
	    margin-left: 0px;
	    margin-top: 0px;
	    margin-right: 0px;
	    margin-bottom: 0px;
	    background-color: #110502;
	    overflow:auto;
		background-image: url(/pagef/XY_Top.jpg);
		background-repeat: repeat-x;
    }
    p{
    	text-align:left;
    }
-->
</style>
</head>
<body>
<?php
	$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_pwd` = 1 LIMIT 1 ";
	$result = $db->query($sql, 1);
	if ($result)
	{
		//判斷帳號是否需要重新设置密码
		alert_href($loginName.'你是首次登陆或者上级更改密码，需要修改密码！','/templates/UpPwd_first.php');
	}
	else
	{
	?>
<div style="margin:0 auto;width:980px;" >
<form action="" method="post" name="form1">
<input type="hidden" name="sid" value="yes" />
<input type="hidden" name="version" value="hk"/>
<table width="980" height="795" cellspacing="0" cellpadding="0" border="0" background="/pagef/L1.jpg">
  <tbody><tr>
    <td height="103">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" height="531" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
        <td width="21%" height="531">&nbsp;</td>
        <td width="58%"><br><br>
        <br><br><br>
          <p>&nbsp;</p>
          <p>1，使用本公司網站的客戶，請留意閣下所在的國家或居住地的相關法律規定，如有疑問應就相關問題，尋求當地法律意見。<br>
             2、若發生遭駭客入侵破壞行為或不可抗拒之災害導致網站故障或資料損壞、資料丟失等情況，我們將以本公司之後備資料為最後處理依據；為確保各方利益，請各會員投注後列印資料。本公司不會接受沒有列印資料的投訴。<br>
             3、為避免糾紛，各會員在投注之後，務必進入下注狀況檢查及列印資料。若發現任何異常，請立即與代理商聯繫查證，一切投注將以本公司資料庫的資料為准，不得異議。如出现特殊网络情况或线路不稳定导致不能下注或下注失败。本公司概不负责。<br>
             4、單一注單最高派彩上限為一百萬。<br>
             5、開獎結果以官方公佈的結果為准。<br>
             6、我們將竭力提供準確而可靠的開獎統計等資料，但並不保證資料絕對無誤，統計資料只供參考，並非是對客戶行為的指引，本公司也不接受關於統計數據產生錯誤而引起的相關投訴。<br>
            7,本公司擁有一切判決及註消任何涉嫌以非正常方式下註之權利，在進行更深入調查期間將停止發放與其有關之任何彩金。客戶有責任確保自己的帳戶及密碼保密，如果客戶懷疑自己的資料被盜用，應立即通知本公司，並須更改其個人詳細資料。所有被盜用帳號之損失將由客戶自行負責。在某種特殊情況下，客人之信用額可能會出現透支。<br>
            <br>
            &#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288; “<?php echo $Title?>”管理層 敬啟<br>
            <br>
            <br>
          &#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288; &#12288;&#12288;&#12288;&#12288;我瞭解以及同意下註列明的協定和規則。 </p>
          </td>
        <td width="21%">&nbsp;</td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td height="161"><img border="0" usemap="#Map" src="/pagef/L2.jpg"></td>
  </tr>
</tbody></table>
    <map name="Map">
        <area shape="rect" onClick="top.location='/templates/quit.php'" href="#" coords="355,18,465,55">
        <area shape="rect" onClick="document.form1.submit();" href="#" coords="512,18,624,54">
</map>

</form>
	</div>
<?php 
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_number_alert_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$n = strip_tags($text[0][0]);
	alert(trim($n));
}
?>
<?php }?>

</body></html>