<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-7
*/

/***
 * 彈出並返回上一頁
 */
function back($str)
{
	echo '<script>alert("'.$str.'");history.back();</script>';
}

function go($str, $int)
{
	echo '<script>alert("'.$str.'");history.go(-'.$int.')</script>';
}

/***
 * 頁面跳轉
 */
function href ($url)
{
	echo '<script>location.href = "'.$url.'"</script>';
}

function alert_href ($str,$url)
{
	echo '<script>alert("'.$str.'");location.href = "'.$url.'"</script>';
}

function alert($str)
{
	echo '<script>alert("'.$str.'")</script>';
}

?>