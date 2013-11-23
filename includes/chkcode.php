<?php
class validateImage
{

var $x;
var $y;
var $numChars;
var $Code;
var $Width;
var $Height;
var $BG;
var $colTxt;
var $colBorder;
var $numCirculos;


function validateImage()
{
$this->x = 5;
$this->y = 6;
$this->numChars = $numChars = "4"; //Number of Code
$this->Width = $Width = "80"; //Width of Image
$this->Height = $Height = "24"; //Height of Image
$this->BG = $BG = "255 255 255"; //RGB color of background
$this->colTxt = $colTxt = "125 0 0 0"; //RGB color of code
$this->Border = $colBorder = "0 255 255"; //RGB color of Border
$this->numCirculos = $numCirculos = "800"; //Number of random point
}

//Create base Image
function createImage()
{
//Create a image
$im = imagecreate ($this->Width, $this->Height) or die ("Cannot Initialize new GD image stream");

//Get the RGB color code
$colorBG = explode(" ", $this->BG);

$colorBorder = explode(" ", $this->Border);

$colorTxt = explode(" ", $this->colTxt);

//put the background color on the image
$imBG = imagecolorallocate ($im, $colorBG[0], $colorBG[1], $colorBG[2]);

//put the border on the image
$Border = ImageColorAllocate($im, $colorBorder[0], $colorBorder[1], $colorBorder[2]);
$imBorder = ImageRectangle($im, 0, 0, $this->Width-1,$this->Height-1, $Border);

//put the code color on the image
$imTxt = imagecolorallocate ($im, $colorTxt[0], $colorTxt[1], $colorTxt[2]);

//Drop 800 points
for($i = 0; $i < $this->numCirculos; $i++)
{
$imPoints = imagesetpixel($im, mt_rand(0,80), mt_rand(0,80), $Border);
}

//put the Code on image
for($i = 0; $i < $this->numChars; $i++)
{
//get $x's location
$this->x = 21 * $i + 5;

//get the code
mt_srand((double) microtime() * 1000000*getmypid());
$this->Code.= (mt_rand(0, 9));

$putCode = substr($this->Code, $i, "1");

//put the code;
$Code = imagestring($im, 5, $this->x, $this->y, $putCode,$imTxt);

}

return $im;

}


//Transfer the code to next page
function getCode()
{
 
$vCode = $this->Code;
return $vCode;
}


//display the image
function show()
{
 header("Content-type:image/png");
 $im=$this->createImage();
 imagepng($im);
 imagedestroy($im); 
}

}

$img = new validateImage();
session_start();
$img->show();
$_SESSION['yzcode'] = $img->getCode();
?>
