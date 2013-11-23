<body><table cellspacing="2" cellpadding="0" width="100%" bgcolor="#cccccc"  >
	<tr  style="height:20px; background-color:#a7d7f8; text-align:center">
		<td>流水号</td>
		<td>提交时间</td>
		<td>汇款金额</td> 
		<td>汇款银行</td>
		<td>汇款方式</td>
		<td>状态</td> 
	</tr>
	<?php foreach($list as $line){?>
	<tr  style="height:24px; background-color:#fff; text-align:center">
		<td style="color:blue"><?=$line['ordernum']?></td>
		<td style="color:#666666"><?=$line['optdt']?></td>
		<td style="color:red"><?=$line['Money']?></td>
		<td><?=$line['BankName']?></td>
		<td><?=$line['InType']?></td>
		<td><?php
		if($line['status']=='3'){
			echo '<font color=blue>未处理</font>';
		}else if($line['status']=='9'){
			echo '<font color=red>已作废</font>';
		}else if($line['status']=='1'){
			echo '<b>已处理</b>';
		}
		?></td> 
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="6" align="center"><?=$splitpage?></td>
	</tr>
</table></body>