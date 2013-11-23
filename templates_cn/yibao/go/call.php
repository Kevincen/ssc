<?php
$r8_MP = $_REQUEST['r8_MP'];
$payurl=base64_decode($r8_MP);   
$o="";
foreach ($_POST as $k=>$v)
{
    $o.= "$k=".urlencode($v)."&";
}
foreach ($_GET as $k=>$v)
{
    $o.= "$k=".urlencode($v)."&";
}
$post_data=substr($o,0,-1);
file_get_contents($payurl."?".$post_data);
?>
<script language="javascript">location.href='<?php echo $payurl?>?<?php echo $post_data?>'</script>