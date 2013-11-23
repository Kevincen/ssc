<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2012-1-1
*/

class SumCrystals 
{

	public function SumFGS($CentetArr, $count)
	{
		$gd = ($CentetArr['g_distribution_4'])/100;
		$zc = $count[2][9]* $gd; //實占結果
		$zs = $count[2][10]* $gd; 
		$gd3 = $zc + $zs; //應收分公司
		//alert("".$count[2][9]."*".$gd."+".$count[2][0]."*". $gd."*0.02");
		//alert($CentetArr['g_distribution_3']);
		return $gd3;
	}
	
	public function SumGD($CentetArr, $count)
	{
		$zdl = ($CentetArr['g_distribution_2'])/100;
		$zc = ($count[2][9]+$count[2][6])* $zdl; //實占結果
		if ($zdl > 0){
			$gd2= ($count[2][5]-$count[2][6])*(1-($CentetArr['g_distribution_2']/100)); //賺水
					//	$gd2 = $count[2][5]-$count[2][6];

		} else {
			$gd2 = $count[2][5]-$count[2][6];
		}
		$gd3 = $zc - $gd2; //應收股東
		return $gd3;
	}
	
	public function SumZDL($CentetArr, $count)
	{
		$dl = ($CentetArr['g_distribution_1'])/100; //總代理占成
		$c = ($count[2][9]+$count[2][7])* $dl; //總代理實占結果
		if ($dl > 0){
			$dzs2= ($count[2][6]-$count[2][7])*(1-($CentetArr['g_distribution_1']/100));
		//			$dzs2 = $count[2][6]-$count[2][7];

		}
		else {
			$dzs2 = $count[2][6]-$count[2][7];
		}
		$cc = $c - $dzs2;
		return $cc;
	}
	
	/**
	 * 應收代理
	 * @param unknown_type $CentetArr
	 * @param unknown_type $count
	 */
	public function SumDL($CentetArr, $count)
	{
		$a = $count[2][9]+$count[2][8]; //應收會員
		$count[2][4] =$CentetArr['g_distribution']/100; //代理占成
		$xsz = ($count[2][9]+$count[2][8]) * $count[2][4]; //代理實占結果
		if ($count[2][4] > 0){
			$al= ($count[2][7]-$count[2][8])*(1-($CentetArr['g_distribution']/100)); //代理賺水
		//			$al= $count[2][7]-$count[2][8];

		}
		else {
			$al= $count[2][7]-$count[2][8];
		}
		$x =$a- ($xsz -$al);
		return $x;
	}
}

















?>
