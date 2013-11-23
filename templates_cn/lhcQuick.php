<table border="0" width="700">
	<tr> 
        <td align="center" >
			<a href="#this" class="quite" rel="<?=implode(",",$CONFIG["lhc_rgb"]['red_arr'])?>">紅</a>
			<a href="#this" class="quite" rel="<?=implode(",",$CONFIG["lhc_rgb"]['green_arr'])?>">綠</a>
			<a href="#this" class="quite" rel="<?=implode(",",$CONFIG["lhc_rgb"]['blue_arr'])?>">藍</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=1;$i<=48;$i++){ 
				if($i%2==1){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=",";
				}
			}
			echo $str;
			?>">單</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=1;$i<=48;$i++){ 
				if($i%2==0){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=",";
				}
			}
			echo $str;
			?>">雙</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=25;$i<=48;$i++){  
				$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
				$sp=","; 
			}
			echo $str;
			?>">大</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=24;$i++){  
				$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
				$sp=","; 
			}
			echo $str;
			?>">小</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1)+substr($i,1,1);
				if($he%2==1){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">合單</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1)+substr($i,1,1);
				if($he%2==0){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">合雙</a>
			<a href="#this" class="quite"  rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1)+substr($i,1,1);
				if($he>6){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">合大</a>
			<a href="#this" class="quite"  rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1)+substr($i,1,1);
				if($he<=6){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">合小</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			$jar=$CONFIG['lhc_rgb']['JQ'];
			foreach($CONFIG["lhc_rgb"]['SX'] as $key=>$val){  
				if(in_array($key,$jar)){
					$str.=$sp.implode(",",$val);
					$sp=",";
				}
			}
			echo $str;
			?>">家禽</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			$jar=$CONFIG['lhc_rgb']['JQ'];
			foreach($CONFIG["lhc_rgb"]['SX'] as $key=>$val){  
				if(in_array($key,$jar)==false){
					$str.=$sp.implode(",",$val);
					$sp=",";
				}
			}
			echo $str;
			?>">野獸</a>
			<BR>
			<?php
			foreach($CONFIG["lhc_rgb"]['SX'] as $k=>$val){
				echo "<a href=\"#this\" class=\"quite\" rel=\"".implode(",",$val)."\">$k</a>";
			}
			?>
			<BR>
			頭:<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1);
				if($he==0){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">0</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1);
				if($he==1){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">1</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1);
				if($he==2){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">2</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1);
				if($he==3){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">3</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,0,1);
				if($he==4){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">4</a>
			尾:<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==0){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">0</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==1){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">1</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==2){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">2</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==3){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">3</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==4){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">4</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==5){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">5</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==6){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">6</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==7){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">7</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==8){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">8</a>
			<a href="#this" class="quite" rel="<?php
			$str="";$sp="";
			for($i=0;$i<=48;$i++){  
				$i=strlen($i)==1 ? "0".$i : $i;
				$he=substr($i,1,1);
				if($he==9){
					$str.=$sp.(strlen($i)==1 ? "0".$i : $i);
					$sp=","; 
				} 
			}
			echo $str;
			?>">9</a>
			 金額:<input type="text"  size="3" id="money" /><input type="button" onclick="songchu()" class="inputs ti" value="送出" /><input type="button" onclick="chongshe()" class="inputs ti" value="重设" />
		</td> 
    </tr>
</table>
<script language="javascript">
var i=0;
$(function(){
	$('a.quite').bind('click',function(){
		chongshe()
		$code =  $(this).attr('rel');
		if($code!=""){
			$codeArr = $code.split(",");
			$('.haoma').each(function(){
				if( in_array($(this).html(),$codeArr) ){
					var attrClass = $(this).attr('class');
					if(attrClass.indexOf('_normal')>=0){
						 $(this).attr('class',attrClass.replace('_normal','_select'));
						  
					} 
				}
			})
		}
	})
})
function songchu(){
	$('.haoma').each(function(){ 
		var attrClass = $(this).attr('class');
		if(attrClass.indexOf('_select')>=0){
			 var id = $(this).attr('id');
			 $('#'+id.replace('Q','N')).find('input').val( $('#money').val() );			 
		}  
	})
}
function chongshe(){
	$('.haoma').each(function(){ 
		var attrClass = $(this).attr('class');
		if(attrClass.indexOf('_select')>=0){
			 $(this).attr('class',attrClass.replace('_select','_normal'));
		}  
	})
	$('.loads').find('input').val('');
}
</script>