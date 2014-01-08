<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-9
*/
//右侧栏位
echo '<div class="pops" stype="display:block"><table class="wqs" style="float:auto; width:134px;" border="0" cellpadding="0" cellspacing="0" id="cl"><tr class="t_list_caption"><td colspan="2">两面长龙排行</td></tr><tr height="20"><td colspan="2">暂无数据</td></tr></table></div>';
        
?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script language="javascript">
setInterval(function()
{
	$('#cl').find('tr').each(
		function(){
			//$(this).find('td').first().css('width','100px');
		}
	)
},100);
//切换风格
function ChangeSkin(skin)
{
	$("body").removeClass("skin_brown skin_blue skin_red").addClass(skin);
}
</script>