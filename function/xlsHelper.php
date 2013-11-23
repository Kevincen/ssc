<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-7
*/


require_once 'fileOperation.php';
class xlsHelper extends fileOperation{//具体实现子类
     var $mSpace = '';
     var $mHead;
     var $mBody='';
     
function addHeader($head=array()){
         $this->mHead='<table width="500" border="1" align="center" cellpadding="5"><tr>';
   if (is_array($head)){
             foreach($head as $hd){
    $this->mHead.='<th bgcolor="#A5A0DE">'.iconv("UTF-8", "GBK",$hd).'</th>';
    }
         }
   $this->mHead.='</tr>';
   return $this->mHead;
     }
     function addBodyData($body=array()){
         if(is_array($body)){
   
       for($i=0;$i<count($body);$i++){
                 $childBody=$body[$i];
                 $this->mBody.='<tr>';
     $this->mSpace = '<td align="center">';
                 for($j=0;$j<count($childBody);$j++){                
      $this->mBody.=iconv("UTF-8", "GBK",$this->mSpace.$childBody[$j]).'</td>';
                 }
                 $this->mBody.="</tr>";
             }
    
         }
         $this->mBody.='</table>';
		 return $this->mBody;
     }
     function _construct(){
         
     }
     function writeCSVDate(){
         return fwrite($this->mFp,$this->mHead.mb_convert_encoding($this->mBody,'sjis','sjis'));
     }
     function setSpace($type=','){
         $this->mSpace=$type;
     }
}

?>