<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-9
*/

echo '<div class="pops" stype="display:none">
<table bgcolor="#E9BA84" border="0" cellpadding="0" cellspacing="1"   id="cl"></table>
</div>'; 
?>
<script language="javascript">
setInterval(function(){
$('#cl').find('tr').each(
	function(){
		//$(this).find('td').first().css('width','100px');
	}
)
},100);</script>