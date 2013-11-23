<?php   
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
header("Content-Type: text/html; charset=utf-8");
include_once ROOT_PATH.'function/fileOperation.php';
include_once ROOT_PATH.'function/xlsHelper.php';



$data=$_POST['dataArr'];
$xtype=$_POST['xtype'];

//echo count($id);

$folderUrl=ROOT_PATH."xls/";

$fname=$xtype==1? 'G':'U';
$xls=new xlsHelper();
$xls->fileName=$fname;//设置生成文件的文件名
$xls->extendName='xls';//文件扩展名
$xls->mPath=$folderUrl;//文件保存路径

$headerarr=$data[0];//头部字段名
$xls->addHeader($headerarr);

for($i=0;$i<count($data);$i++){
$datasarr[$i]= $data[$i+1];
}
//$datasarr=array(//注意：此处的二维数组一定要是数字索引
 //                         $data[1],
 //                         $data[2],
//						  $data[3],
	//					  $data[4],
  //                );
$xls->addBodyData($datasarr);

$xls->openFile('w');
if($xls->writeCSVDate())    echo 1;
else    echo 2;



 ?>