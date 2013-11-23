<?php
$payurl='https://www.yeepay.com/app-merchant-proxy/node'; 
echo "<form name='myform' action='$payurl' method='post'> ";
foreach($_POST as $key=>$val){ 
	echo "<input type=hidden name='$key' value='$val' />";
}
echo "</form><script>document.forms['myform'].submit()</script>";
?>