<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-22
*/

/**
 * 驗證字符串 0-9
 * Enter description here ...
 * @param string $string
 */
function isString ($string)
{
	if (preg_match('/^[0-9]*$/', $string))
		return true;
	else 
		return false;
}

/**
 * 格式化數字
 * Enter description here ...
 * @param int $number
 * @param int $index
 */
function is_Number3 ($number, $index=0)
{
	if (stristr($number, '.'))
	{
		$a = explode('.', $number);
		if (mb_strlen($a[1]) == 1)
			return number_format($number, 1);
		else
			return number_format($number, 2);
	}
	return number_format($number);
}




function is_Number2 ($number, $index=0)
{
	if (stristr($number, '.'))
	{
		return number_format($number, 1,".","");
		/*
		$a = explode('.', $number);
		if (mb_strlen($a[1]) == 1)
			return number_format($number, 1,".","");
		else
			return number_format($number, 2,".","");
		*/
	}
	return number_format($number,0,".","");
}

function is_Number ($number, $index=0)
{
	if (stristr($number, '.'))
	{
		return number_format($number, 1,".","");
		/*
		$a = explode('.', $number);
		if (mb_strlen($a[1]) == 1)
			return number_format($number, 1,".","");
		else
			return number_format($number, 2,".","");
		*/
	}
	return number_format($number,0,".","");
}

function is_Number4 ($number, $index=0)
{
	return number_format($number,0,".","");
}









?>