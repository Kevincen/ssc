<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
include_once ROOT_PATH.'function/opNumberList.php';
if (isset($_GET['id'])){
	$li = $_GET['id'];
} else {
	if ((isset($_SESSION['cq']) && $_SESSION['cq'] == true))
		$li = 2;
	else if((isset($_SESSION['gx']) && $_SESSION['gx'] == true))
				$li = 3;
		else if((isset($_SESSION['nc']) && $_SESSION['nc'] == true))
				$li = 5;
		else if((isset($_SESSION['pk']) && $_SESSION['pk'] == true))
				$li = 6;
			else if((isset($_SESSION['lhc']) && $_SESSION['lhc'] == true))
				$li = 7;
			else if((isset($_SESSION['xj']) && $_SESSION['xj'] == true))
				$li = 8;
			else if((isset($_SESSION['jsk3']) && $_SESSION['jsk3'] == true))
				$li = 9;
			else
				$li = 1;
}

$numberList = numberList($li);
$page = $numberList['page'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?=$oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript" src="js/sc.js"></script>
<script type="text/javascript">
<!--
	function selects($this){
		location.href = "result.php?id="+$this.value;
	}
//-->
</script>
</head>
<body>
	<select id="lt" onchange="selects(this)" style="margin-top:15px;">
        <option  <?php if ($li == 1) echo 'selected="selected"'?> value="1">廣東快樂十分鐘</option>
       <option <?php if ($li == 2) echo 'selected="selected"'?>  value="2">重慶時時彩</option>
		 <option <?php if ($li == 5) echo 'selected="selected"'?>  value="5">幸运农场</option>
		 <option <?php if ($li == 6) echo 'selected="selected"'?>  value="6">北京赛车(PK10)</option>
		  <option <?php if ($li == 9) echo 'selected="selected"'?>  value="9">江苏骰寶(快3)</option>
	</select>
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" style="margin-top:0px;top:1px; ">
		<?php if ($li == 1){?>
        <tr class="t_list_caption">
            <td width="100">期數</td>
            <td width="124">開獎時間</td>
            <td colspan="8">開出號碼</td>
            <td colspan="4">總和</td>
            <td>龍虎</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text">
             <td><?php echo$numberList[$i][1]?></td>
             <td><?php echo$numberList[$i][2]?></td>
             <?php echo$numberList[$i][3] ?>
             <td width="35"><?php echo$numberList[$i][4]?></td>
             <td width="30"><?php echo $numberList[$i][5]?></td>
             <td width="30"><?php echo $numberList[$i][6]?></td>
             <td width="35"><?php echo $numberList[$i][7]?></td>
             <td width="30"><?php echo $numberList[$i][8]?></td>
             </tr>
        <?php }}}else if($li==3){
		?>
        <tr class="t_list_caption">
            <td width="100">期數</td>
            <td width="124">開獎時間</td>
            <td colspan="5">開出號碼</td>
            <td colspan="4">總和</td>
            <td>龍虎</td>
			<td colspan="6">特码</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="14" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text">
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
		 <?php }}}else if($li==5){
		?>
		  <tr class="t_list_caption">
            <td width="100">期數</td>
            <td width="110">開獎時間</td>
            <td width="620">開出號碼</td>
            <td colspan="4">總和</td>
            <td>家禽野兽</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text">
             <td><?php echo$numberList[$i][1]?></td>
             <td><?php echo$numberList[$i][2]?></td>
             <td class="hj"><?php echo$numberList[$i][3] ?></td>
             <td><?php echo$numberList[$i][4]?></td>
             <td><?php echo $numberList[$i][5]?></td>
             <td><?php echo $numberList[$i][6]?></td>
             <td><?php echo $numberList[$i][7]?></td>
             <td><?php echo $numberList[$i][8]?></td>
             </tr>
        <?php }}}else if($li==6){
		?>
		  <tr class="t_list_caption">
            <td width="55">期數</td>
            <td width="124">開獎時間</td>
            <td colspan="10">開出號碼</td>
            <td colspan="3">冠亞軍和</td>
            <td colspan="5">1～5 龍虎</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text">
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
		<?php }}}else if($li==7){
		?>
		  <tr class="t_list_caption">
            <td width="55">期數</td>
            <td width="124">開獎時間</td>
            <td width="250" colspan="7">開出號碼</td>
            <td>波段</td>
			<td>特肖</td>
			<td>五行</td>
			<td colspan="2">正碼總和</td> 
			<td colspan="2">總和</td> 
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text">
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
		
		<?php }}}else if($li==9){
		?>
		  <tr class="t_list_caption">
            <td width="95">期數</td>
            <td width="124">開獎時間</td>
            <td  colspan="3">開出號碼</td> 
			<td colspan="2">總和</td> 
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text">
             <td><?php echo$numberList[$i][1]?></td>
			<td><?php echo$numberList[$i][2]?></td>
			<?php echo$numberList[$i][3] ?>
			<td width="35"><?php echo$numberList[$i][4]?></td>
			<td width="30"><?php echo $numberList[$i][5]?></td> 
			 
             </tr>
		<?php }}}else{?>
			<tr align="center" class="t_list_caption">
			     <td width="100">期數</td>
            	 <td width="124">開獎時間</td>
			     <td colspan="5">開出號碼</td>
			     <td colspan="3" width="80">總和</td>
			     <td>龍虎</td>
			     <td>前三</td>
			     <td>中三</td>
			     <td>后三</td>
			</tr>
       <?php if (!$numberList){?><tr><td colspan="10" align="center">暫無記錄</td></tr><?php }else {
       for ($i=0; $i<count($numberList)-1; $i++){?>
			<tr align="center" class="t_td_text">
				<td><?php echo$numberList[$i][1]?></td>
				<td><?php echo$numberList[$i][2]?></td>
				<?php echo$numberList[$i][3] ?>
				<td width="35"><?php echo$numberList[$i][4]?></td>
				<td width="30"><?php echo $numberList[$i][5]?></td>
				<td width="30"><?php echo $numberList[$i][6]?></td>
				<td width="35"><?php echo $numberList[$i][7]?></td>
				<td width="35"><?php echo $numberList[$i][8]?></td>
				<td width="35"><?php echo $numberList[$i][9]?></td>
				<td width="35"><?php echo $numberList[$i][10]?></td>
			</tr>
        <?php }}}?>
        <tr class="t_list_caption">
        	<td <?php if($li==1 || $li==5) echo 'colspan="15"';else if($li==2|$li==4) echo'colspan="14"'; else  if($li==6) echo 'colspan="20"'; else  echo 'colspan="18"'?> align="right"><?php echo $page->fpage(array(3,4,5,6,7,0,1))?></td>
        </tr>
</table>
</tr>
</body>
</html>