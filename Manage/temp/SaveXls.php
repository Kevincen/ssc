<?php   
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
header("Content-Type: text/html; charset=utf-8");


$tt=$_GET['type']==1? 'G':'U';
function downfile($fileurl)
{
$filename=$fileurl;
$tt=$_GET['type']==1? 'G':'U';
while(!file_exists($fileurl)){sleep(1000);}
$file   =   fopen($filename, "rb"); 
Header( "Content-type:   application/octet-stream "); 
Header( "Accept-Ranges:   bytes "); 

Header( "Content-Disposition:   attachment;   filename= ".$tt.time().".xls"); 


$contents = "";
while (!feof($file)) {
  $contents .= fread($file, 8192);
}
echo $contents;
fclose($file); 
@unlink($fileurl);  
}

$url=ROOT_PATH."xls/".$tt.".xls";
downfile($url);


 ?>