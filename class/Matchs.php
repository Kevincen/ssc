<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/

/**
 * 正則驗證類
 * Enter description here ...
 * @author Administrator
 *
 */
class Matchs 
{
	/**
	 * 驗證字符串是否是整數，如果是返回True
	 * @param String $string	字符串
	 * @param int $max		最大範圍
	 * @param int $mix		最小範圍
	 * @return Bool
	 */
	public static function isNumber ($string, $mix=1, $max=9)
	{
		return preg_match('/^[0-9]{'.$mix.','.$max.'}$/', $string) ? TRUE : FALSE;
	}
	
	/**
	 * 驗證字符串是否是小數或數字，如果是返回True
	 * @param String $string	字符串
	 * @return Bool
	 */
	public static function isFloating ($string)
	{
		if(substr($string,0,1)=='-') //负数的情况
		{
			$string=substr($string,1);
		}
		return preg_match('/^(0|([1-9]+[0-9]*))(\\.[0-9]+)?$/', $string) ? TRUE : FALSE;
	}
	
	/**
	 * 驗證字符串是否是字母或數字，如果是返回True
	 * @param String $string	字符串
	 * @param int $max		最大範圍
	 * @param int $mix		最小範圍
	 * @return Bool
	 */
	public static function isString ($string, $mix=1, $max=9)
	{
		return preg_match('/^[a-zA-Z0-9]{'.$mix.','.$max.'}$/', $string) ? TRUE : FALSE;
	}
	
	/**
	 * 驗證字符串允許中文、字母、數字組合，如果是返回True
	 * @param String $string	字符串
	 * @param int $max		最大範圍
	 * @param int $mix		最小範圍
	 * @return Bool
	 */
	public static function isStringChi ($string, $mix=1, $max=9)
	{
		return preg_match('/^[\x{4e00}-\x{9fa5}A-Za-z0-9\、\-]{'.$mix.','.$max.'}$/u', $string) ? TRUE : FALSE;
	}
	
}
?>