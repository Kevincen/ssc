<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');

class UserReportInfo 
{
	private $User;
	private $cid;
	private $db;
	private $UserList;
	
	/**
	 * 讀取用戶注單類
	 * @param Model $User
	 * @param Int $cid
	 */
	public function __construct($User=null, $cid=0)
	{
		$this->User = $User;
		$this->cid = $cid;
		$this->db = new DB();
		$this->UserList=null;
	}
	
	/**
	 * 讀取用戶注單信息
	 * @param Int 期數
	 * @return Array
	 */
	private function UserInfo ($number)
	{
		if ($this->User[0]['g_login_id'] !=48 && Copyright){
			$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User[0]['g_nid']}%' 
			AND g_s_nid <> '{$this->User[0]['g_nid']}' 
			AND g_qishu = '{$number}' 
			AND g_type = '廣東快樂十分' 
			AND g_win is null ";
		} else {
			$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User[0]['g_nid']}%' 
			AND g_mumber_type <> 5 
			AND g_qishu = '{$number}' 
			AND g_type = '廣東快樂十分' 
			AND g_win is null ";
		}
		$result = $this->db->query($sql, 1);
		if ($result && Copyright)
		{
			//判斷當前用戶級別。對應注單的佔成以及退水計算實佔。
			
			//print_r($result);exit;
			$RepList = $this->SumReport($result, $this->User[0]['g_login_id']);
			switch ($this->cid)
			{
				case 1: $typeString = '第一球'; break;
				case 2: $typeString = '第二球'; break;
				case 3: $typeString = '第三球'; break;
				case 4: $typeString = '第四球'; break;
				case 5: $typeString = '第五球'; break;
				case 6: $typeString = '第六球'; break;
				case 7: $typeString = '第七球'; break;
				case 8: $typeString = '第八球'; break;
				case 9: $typeString = '總和、龍虎'; break;
				case 10: $typeString = '連碼'; break;
			}
			
			$countList = $this->GroupCount($RepList, $typeString, $number);
			$countList = $this->GroupCounts($RepList, $typeString, $countList);
			return $countList;
		}
		else 
		{
			return NULL;
		}
	}
	
	/**
	 * 分組獲取總投注額
	 * @param Array $RepList
	 * @param String $typeString
	 */
	private function GroupCount ($RepList, $typeString, $number=null)
	{
		//print_r($RepList);exit;
		$arr = array('count'=>null, 'count_c'=>null, 'count_d'=>null, 'list'=>null, 'list_s'=>null, 'list_x'=>null);
		$sArr = array();
		$sql = "SELECT * FROM g_zhudan WHERE g_qishu='{$number}' 
		AND g_s_nid = '{$this->User[0]['g_nid']}' 
		AND g_mumber_type=5 
		AND g_type = '廣東快樂十分' 
		AND g_win is null ";
		$UserList = $this->db->query($sql, 1);
		$this->UserList = $UserList;
		for ($s=0; $s<21;$s++) {$countList[$s]=$arr['count_c'][$s]=$arr['count_d'][$s]=0;}
		for ($i=0; $i<count($RepList); $i++)
		{
			$arr['count_c'][0] += $RepList[$i]['g_jiner'];
			if ($RepList[$i]['g_mingxi_1'] == '第一球' && Copyright){
				$arr['count_c'][1] += $RepList[$i]['g_jiner'];
				$arr['count_d'][0] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第二球' && Copyright){
				$arr['count_c'][2] += $RepList[$i]['g_jiner'];
				$arr['count_d'][1] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第三球' && Copyright){
				$arr['count_c'][3] += $RepList[$i]['g_jiner'];
				$arr['count_d'][2] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第四球' && Copyright){
				$arr['count_c'][4] += $RepList[$i]['g_jiner'];
				$arr['count_d'][3] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第五球' && Copyright){
				$arr['count_c'][5] += $RepList[$i]['g_jiner'];
				$arr['count_d'][4] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第六球' && Copyright){
				$arr['count_c'][6] += $RepList[$i]['g_jiner'];
				$arr['count_d'][5] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第七球' && Copyright){
				$arr['count_c'][7] += $RepList[$i]['g_jiner'];
				$arr['count_d'][6] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '第八球' && Copyright){
				$arr['count_c'][8] += $RepList[$i]['g_jiner'];
				$arr['count_d'][7] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '總和、龍虎' && Copyright){
				if ($RepList[$i]['g_mingxi_2'] == '總和大' || $RepList[$i]['g_mingxi_2'] == '總和小'){
					$arr['count_c'][9] += $RepList[$i]['g_jiner'];
					$arr['count_d'][8] ++;
				} else if ($RepList[$i]['g_mingxi_2'] == '總和單' || $RepList[$i]['g_mingxi_2'] == '總和雙'){
					$arr['count_c'][10] += $RepList[$i]['g_jiner'];
					$arr['count_d'][9] ++;
				} else if ($RepList[$i]['g_mingxi_2'] == '總和尾大' || $RepList[$i]['g_mingxi_2'] == '總和尾小'){
					$arr['count_c'][11] += $RepList[$i]['g_jiner'];
					$arr['count_d'][10] ++;
				} else {
					$arr['count_c'][12] += $RepList[$i]['g_jiner'];
					$arr['count_d'][11] ++;
				}
			} else if ($RepList[$i]['g_mingxi_1'] == '任選二' && Copyright){
				$arr['count_c'][13] += $RepList[$i]['g_jiner'];
				$arr['count_d'][12] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '選二連直' && Copyright){
				$arr['count_c'][14] += $RepList[$i]['g_jiner'];
				$arr['count_d'][13] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '選二連組' && Copyright){
				$arr['count_c'][15] += $RepList[$i]['g_jiner'];
				$arr['count_d'][14] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '任選三' && Copyright){
				$arr['count_c'][16] += $RepList[$i]['g_jiner'];
				$arr['count_d'][15] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '選三連直' && Copyright){
				$arr['count_c'][17] += $RepList[$i]['g_jiner'];
				$arr['count_d'][16] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '選三連組' && Copyright){
				$arr['count_c'][18] += $RepList[$i]['g_jiner'];
				$arr['count_d'][17] ++;
			} else if ($RepList[$i]['g_mingxi_1'] == '任選四' && Copyright){
				$arr['count_c'][19] += $RepList[$i]['g_jiner'];
				$arr['count_d'][18] ++;
			} else {
				$arr['count_c'][20] += $RepList[$i]['g_jiner'];
				$arr['count_d'][19] ++;
			}
			if ($RepList[$i]['g_mingxi_1'] == $typeString && Matchs::isNumber($RepList[$i]['g_mingxi_2'])) {
				//1-20組總投注額
				$countList[0] += $RepList[$i]['g_jiner'];
				$countList[8] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='大' || $RepList[$i]['g_mingxi_2'] == '小')) {
				//大小組總投注額
				//$countList[1] += $RepList[$i]['g_jiner'];
				$countList[9] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='單' || $RepList[$i]['g_mingxi_2'] == '雙')) {
				//單雙組總投注額
				//$countList[2] += $RepList[$i]['g_jiner'];
				$countList[10] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='尾大' || $RepList[$i]['g_mingxi_2'] == '尾小')) {
				//尾大小組總投注額
				//$countList[3] += $RepList[$i]['g_jiner'];
				$countList[11] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='合數單' || $RepList[$i]['g_mingxi_2'] == '合數雙')) {
				//合數單雙組總投注額
				//$countList[4] += $RepList[$i]['g_jiner'];
				$countList[12] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='東' || $RepList[$i]['g_mingxi_2'] == '南' || $RepList[$i]['g_mingxi_2'] == '西' || $RepList[$i]['g_mingxi_2'] == '北')) {
				//東南西北組總投注額
				//$countList[5] += $RepList[$i]['g_jiner'];
				$countList[13] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='中' || $RepList[$i]['g_mingxi_2'] == '發' || $RepList[$i]['g_mingxi_2'] == '白')) {
				//中發白組總投注額
				//$countList[6] += $RepList[$i]['g_jiner'];
				$countList[14] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='總和大' || $RepList[$i]['g_mingxi_2'] == '總和小')) {
				//總和大小總投注額
				$countList[15] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='總和單' || $RepList[$i]['g_mingxi_2'] == '總和雙')) {
				//總和單雙總投注額
				$countList[16] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='總和尾大' || $RepList[$i]['g_mingxi_2'] == '總和尾小')) {
				//總和尾數大小總投注額
				$countList[17] += $RepList[$i]['g_tueishui'];
			} else if ($RepList[$i]['g_mingxi_1'] == $typeString && ($RepList[$i]['g_mingxi_2'] =='龍' || $RepList[$i]['g_mingxi_2'] == '虎')) {
				//龍虎總投注額
				$countList[18] += $RepList[$i]['g_tueishui'];
			}  else if ($typeString =='連碼' && $RepList[$i]['g_mingxi_1'] == "任選二") {
				$countList[2] += $RepList[$i]['g_tueishui'];
			}  else if ( $typeString =='連碼' && $RepList[$i]['g_mingxi_1'] == "選二連組") {
				$countList[3] += $RepList[$i]['g_tueishui'];
			}  else if ( $typeString =='連碼' && $RepList[$i]['g_mingxi_1'] == "任選三") {
				$countList[4] += $RepList[$i]['g_tueishui'];
			}  else if ( $typeString =='連碼' && $RepList[$i]['g_mingxi_1'] == "選三前組") {
				$countList[5] += $RepList[$i]['g_tueishui'];
			}  else if ( $typeString =='連碼' && $RepList[$i]['g_mingxi_1'] == "任選四") {
				$countList[6] += $RepList[$i]['g_tueishui'];
			}  else if ( $typeString =='連碼' && $RepList[$i]['g_mingxi_1'] == "任選五") {
				$countList[7] += $RepList[$i]['g_tueishui'];
			}
			
			
			if ($RepList[$i]['g_mingxi_1'] == $typeString && Copyright) 
			{
				switch ($RepList[$i]['g_mingxi_2']) {
					case '01' : $sArr['1'] += $RepList[$i]['g_jiner']; break;
					case '02' : $sArr['2'] += $RepList[$i]['g_jiner']; break;
					case '03' : $sArr['3'] += $RepList[$i]['g_jiner']; break;
					case '04' : $sArr['4'] += $RepList[$i]['g_jiner']; break;
					case '05' : $sArr['5'] += $RepList[$i]['g_jiner']; break;
					case '06' : $sArr['6'] += $RepList[$i]['g_jiner']; break;
					case '07' : $sArr['7'] += $RepList[$i]['g_jiner']; break;
					case '08' : $sArr['8'] += $RepList[$i]['g_jiner']; break;
					case '09' : $sArr['9'] += $RepList[$i]['g_jiner']; break;
					case '10' : $sArr['10'] += $RepList[$i]['g_jiner']; break;
					case '11' : $sArr['11'] += $RepList[$i]['g_jiner']; break;
					case '12' : $sArr['12'] += $RepList[$i]['g_jiner']; break;
					case '13' : $sArr['13'] += $RepList[$i]['g_jiner']; break;
					case '14' : $sArr['14'] += $RepList[$i]['g_jiner']; break;
					case '15' : $sArr['15'] += $RepList[$i]['g_jiner']; break;
					case '16' : $sArr['16'] += $RepList[$i]['g_jiner']; break;
					case '17' : $sArr['17'] += $RepList[$i]['g_jiner']; break;
					case '18' : $sArr['18'] += $RepList[$i]['g_jiner']; break;
					case '19' : $sArr['19'] += $RepList[$i]['g_jiner']; break;
					case '20' : $sArr['20'] += $RepList[$i]['g_jiner']; break;
					case '大' : $sArr['21'] += $RepList[$i]['g_jiner']; break;
					case '小' : $sArr['22'] += $RepList[$i]['g_jiner']; break;
					case '單' : $sArr['23'] += $RepList[$i]['g_jiner']; break;
					case '雙' : $sArr['24'] += $RepList[$i]['g_jiner']; break;
					case '尾大' : $sArr['25'] += $RepList[$i]['g_jiner']; break;
					case '尾小' : $sArr['26'] += $RepList[$i]['g_jiner']; break;
					case '合數單' : $sArr['27'] += $RepList[$i]['g_jiner']; break;
					case '合數雙' : $sArr['28'] += $RepList[$i]['g_jiner']; break;
					case '東' : $sArr['29'] += $RepList[$i]['g_jiner']; break;
					case '南' : $sArr['30'] += $RepList[$i]['g_jiner']; break;
					case '西' : $sArr['31'] += $RepList[$i]['g_jiner']; break;
					case '北' : $sArr['32'] += $RepList[$i]['g_jiner']; break;
					case '中' : $sArr['33'] += $RepList[$i]['g_jiner']; break;
					case '發' : $sArr['34'] += $RepList[$i]['g_jiner']; break;
					case '白' : $sArr['35'] += $RepList[$i]['g_jiner']; break;
					case '總和大' : $sArr['1'] += $RepList[$i]['g_jiner']; break;
					case '總和單' : $sArr['2'] += $RepList[$i]['g_jiner']; break;
					case '總和小' : $sArr['3'] += $RepList[$i]['g_jiner']; break;
					case '總和雙' : $sArr['4'] += $RepList[$i]['g_jiner']; break;
					case '總和尾大' : $sArr['5'] += $RepList[$i]['g_jiner']; break;
					case '龍' : $sArr['6'] += $RepList[$i]['g_jiner']; break;
					case '總和尾小' : $sArr['7'] += $RepList[$i]['g_jiner']; break;
					case '虎' : $sArr['8'] += $RepList[$i]['g_jiner']; break;
				}
			}
			else 
			{
				switch ($RepList[$i]['g_mingxi_1']) {
					case '任選二' : $sArr['101'] += $RepList[$i]['g_jiner']; break;
					case '選二連組' : $sArr['102'] += $RepList[$i]['g_jiner']; break;
					case '任選三' : $sArr['103'] += $RepList[$i]['g_jiner']; break;
					case '選三前組' : $sArr['104'] += $RepList[$i]['g_jiner']; break;
					case '任選四' : $sArr['105'] += $RepList[$i]['g_jiner']; break;
					case '任選五' : $sArr['106'] += $RepList[$i]['g_jiner']; break;
				}
			}
		}
		$arr['count'] = $countList;
		$arr['list']=$sArr;
		//print_r($RepList);exit;
		if ($UserList)
			$arr = $this->GetUserCrystals($UserList, $sArr, $arr, $typeString);
			//print_r($arr);
		return $arr;
	}
	
	private function GetUserCrystals($UserList, $sArr, $arr, $typeString)
	{
		$n=0; $h=1;
		for ($i=0; $i<count($UserList); $i++){
			$n =$UserList[$i]['g_jiner'];
			$h = $UserList[$i]['g_mingxi_1_str'];
			$arr['count_c'][0] = $arr['count_c'][0] - $n;
			if ($UserList[$i]['g_mingxi_1'] == '第一球'){
				$arr['count_c'][1] = $arr['count_c'][1]-$n;
				//$arr['count_d'][0] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第二球'){
				$arr['count_c'][2] = $arr['count_c'][2]-$n;
				//$arr['count_d'][1] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第三球'){
				$arr['count_c'][3] = $arr['count_c'][3]-$n;
				//$arr['count_d'][2] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第四球'){
				$arr['count_c'][4] = $arr['count_c'][4]-$n;
				//$arr['count_d'][3] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第五球'){
				$arr['count_c'][5] = $arr['count_c'][5]-$n;
				//$arr['count_d'][4] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第六球'){
				$arr['count_c'][6]  = $arr['count_c'][6]-$n;
				//$arr['count_d'][5] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第七球'){
				$arr['count_c'][7] = $arr['count_c'][7]-$n;
				//$arr['count_d'][6] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '第八球'){
				$arr['count_c'][8] = $arr['count_c'][8]-$n;
				//$arr['count_d'][7] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '總和、龍虎'){
				if ($UserList[$i]['g_mingxi_2'] == '總和大' || $UserList[$i]['g_mingxi_2'] == '總和小'){
					$arr['count_c'][9] = $arr['count_c'][9]-$n;
					//$arr['count_d'][8] ++;
				} else if ($UserList[$i]['g_mingxi_2'] == '總和單' || $UserList[$i]['g_mingxi_2'] == '總和雙'){
					$arr['count_c'][10] = $arr['count_c'][10]-$n;
					//$arr['count_d'][9] ++;
				} else if ($UserList[$i]['g_mingxi_2'] == '總和尾大' || $UserList[$i]['g_mingxi_2'] == '總和尾小'){
					$arr['count_c'][11] = $arr['count_c'][11]-$n;
					//$arr['count_d'][10] ++;
				} else {
					$arr['count_c'][12] = $arr['count_c'][12]-$n;
					//$arr['count_d'][11] ++;
				}
			} else if ($UserList[$i]['g_mingxi_1'] == '任選二' && Copyright){
				$arr['count_c'][13] = $arr['count_c'][13]-$n*$h;
				//$arr['count_d'][12] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '選二連直'){
				$arr['count_c'][14] = $arr['count_c'][14]-$n*$h;
				//$arr['count_d'][13] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '選二連組' && Copyright){
				$arr['count_c'][15] = $arr['count_c'][15]-$n*$h;
				//$arr['count_d'][14] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '任選三'){
				$arr['count_c'][16] = $arr['count_c'][16]-$n*$h;
				//$arr['count_d'][15] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '選三連直'){
				$arr['count_c'][17] = $arr['count_c'][17]-$n*$h;
				//$arr['count_d'][16] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '選三連組'){
				$arr['count_c'][18] = $arr['count_c'][18]-$n*$h;
				//$arr['count_d'][17] ++;
			} else if ($UserList[$i]['g_mingxi_1'] == '任選四'){
				$arr['count_c'][19] = $arr['count_c'][19]-$n*$h;
				//$arr['count_d'][18] ++;
			} else {
				$arr['count_c'][20] = $arr['count_c'][20]-$n*$h;
				//$arr['count_d'][19] ++;
			}
			
			if ($UserList[$i]['g_mingxi_1'] == $typeString && Copyright) 
			{
				switch ($UserList[$i]['g_mingxi_2']) {
					case '01' : 
						$arr['list']['1']=$arr['list']['1'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '02' : 
						$arr['list']['2']=$arr['list']['2'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '03' : 
						$arr['list']['3']=$arr['list']['3'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '04' : 
						$arr['list']['4']=$arr['list']['4'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '05' :  
						$arr['list']['5']=$arr['list']['5'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '06' :  
						$arr['list']['6']=$arr['list']['6'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '07' :  
						$arr['list']['7']=$arr['list']['7'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '08' :  
						$arr['list']['8']=$arr['list']['8'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '09' :  
						$arr['list']['9']=$arr['list']['9'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '10' :  
						$arr['list']['10']=$arr['list']['10'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '11' :   
						$arr['list']['11']=$arr['list']['11'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '12' :   
						$arr['list']['12']=$arr['list']['12'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '13' :   
						$arr['list']['13']=$arr['list']['13'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '14' :   
						$arr['list']['14']=$arr['list']['14'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '15' :   
						$arr['list']['15']=$arr['list']['15'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '16' :   
						$arr['list']['16']=$arr['list']['16'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '17' :   
						$arr['list']['17']=$arr['list']['17'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '18' :   
						$arr['list']['18']=$arr['list']['18'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '19' :   
						$arr['list']['19']=$arr['list']['19'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '20' :   
						$arr['list']['20']=$arr['list']['20'] - $n;
						$arr['count'][0] =$arr['count'][0]- $n;
						break;
					case '大' : $arr['list']['21']=$arr['list']['21'] - $n; break;
					case '小' : $arr['list']['22']=$arr['list']['22'] - $n; break;
					case '單' : $arr['list']['23']=$arr['list']['23'] - $n; break;
					case '雙' : $arr['list']['24']=$arr['list']['24'] - $n; break;
					case '尾大' : $arr['list']['25']=$arr['list']['25'] - $n; break;
					case '尾小' : $arr['list']['26']=$arr['list']['26'] - $n; break;
					case '合數單' : $arr['list']['27']=$arr['list']['27'] - $n; break;
					case '合數雙' : $arr['list']['28']=$arr['list']['28'] - $n; break;
					case '東' : $arr['list']['29']=$arr['list']['29'] - $n; break;
					case '南' : $arr['list']['30']=$arr['list']['30'] - $n; break;
					case '西' : $arr['list']['31']=$arr['list']['31'] - $n; break;
					case '北' : $arr['list']['32']=$arr['list']['32'] - $n; break;
					case '中' : $arr['list']['33']=$arr['list']['33'] - $n; break;
					case '發' : $arr['list']['34']=$arr['list']['34'] - $n; break;
					case '白' : $arr['list']['35']=$arr['list']['35'] - $n; break;
					case '總和大' : $arr['list']['1']=$arr['list']['1'] - $n; break;
					case '總和單' : $arr['list']['2']=$arr['list']['2'] - $n; break;
					case '總和小' : $arr['list']['3']=$arr['list']['3'] - $n; break;
					case '總和雙' : $arr['list']['4']=$arr['list']['4'] - $n; break;
					case '總和尾大' : $arr['list']['5']=$arr['list']['5'] - $n; break;
					case '龍' : $arr['list']['6']=$arr['list']['6'] - $n; break;
					case '總和尾小' : $arr['list']['7']=$arr['list']['7'] - $n; break;
					case '虎' : $arr['list']['8']=$arr['list']['8'] - $n; break;
				}
			}
			else 
			{
				switch ($UserList[$i]['g_mingxi_1']) {
					case '任選二' : $arr['list']['101']=$arr['list']['101'] - $n*$h; break;
					case '選二連組' : $arr['list']['102'] =$arr['list']['102']- $n*$h; break;
					case '任選三' : $arr['list']['103']=$arr['list']['103'] - $n*$h; break;
					case '選三前組' : $arr['list']['104']=$arr['list']['104'] - $n*$h; break;
					case '任選四' : $arr['list']['105']=$arr['list']['105'] - $n*$h; break;
					case '任選五' : $arr['list']['106']=$arr['list']['106'] - $n*$h; break;
				}
			}
		}
		return $arr;
	}

	private function GroupCounts ($RepList, $typeString, $list)
	{
		$lo =array(0=>null,1=>null);
		for ($i=0; $i<count($RepList); $i++)
		{
			if ($RepList[$i]['g_mingxi_1'] == $typeString && Copyright)
			{
				switch ($RepList[$i]['g_mingxi_2']) {
					case '01' : 
						if ($list['list']['1'] >0)
							$list['list_s']['1'] = $list['count'][0] + $list['count'][8] - $list['list']['1'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['1'] = $list['count'][8];
						break;
					case '02' : 
						if ($list['list']['2'] >0)
							$list['list_s']['2'] = $list['count'][0] + $list['count'][8] - $list['list']['2'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['2'] = $list['count'][8];
						break;
					case '03' : 
						if ($list['list']['3'] >0)
							$list['list_s']['3'] = $list['count'][0] + $list['count'][8] - $list['list']['3'] * $RepList[$i]['g_odds'];
						 else 
							$list['list_s']['3'] = $list['count'][8];
						break;
					case '04' : 
						if ($list['list']['4'] >0)
							$list['list_s']['4'] = $list['count'][0] + $list['count'][8] - $list['list']['4'] * $RepList[$i]['g_odds']; 
						 else 
							$list['list_s']['4'] = $list['count'][8];
						break;
					case '05' : 
						if ($list['list']['5'] >0)
							$list['list_s']['5'] = $list['count'][0] + $list['count'][8] - $list['list']['5'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['5'] = $list['count'][8];
						break;
					case '06' : 
						if ($list['list']['6'] >0)
							$list['list_s']['6'] = $list['count'][0] + $list['count'][8] - $list['list']['6'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['6'] = $list['count'][8];
						break;
					case '07' : 
						if ($list['list']['7'] >0)
							$list['list_s']['7'] = $list['count'][0] + $list['count'][8] - $list['list']['7'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['7'] = $list['count'][8];
						break;
					case '08' : 
						if ($list['list']['8'] >0)
							$list['list_s']['8'] = $list['count'][0] + $list['count'][8] - $list['list']['8'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['8'] = $list['count'][8];
						break;
					case '09' : 
						if ($list['list']['9'] >0)
							$list['list_s']['9'] = $list['count'][0] + $list['count'][8] - $list['list']['9'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['9'] = $list['count'][8];
						break;
					case '10' : 
						if ($list['list']['10'] >0)
							$list['list_s']['10'] = $list['count'][0] + $list['count'][8] - $list['list']['10'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['10'] = $list['count'][8];
							break;
					case '11' : 
						if ($list['list']['11'] >0)
							$list['list_s']['11'] = $list['count'][0] + $list['count'][8] - $list['list']['11'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['11'] = $list['count'][8];
						break;
					case '12' : 
						if ($list['list']['12'] >0)
							$list['list_s']['12'] = $list['count'][0] + $list['count'][8] - $list['list']['12'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['12'] = $list['count'][8];
						break;
					case '13' : 
						if ($list['list']['13'] >0)
							$list['list_s']['13'] = $list['count'][0] + $list['count'][8] - $list['list']['13'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['13'] = $list['count'][8];
						break;
					case '14' : 
						if ($list['list']['14'] >0)
							$list['list_s']['14'] = $list['count'][0] + $list['count'][8] - $list['list']['14'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['14'] = $list['count'][8];
						break;
					case '15' : 
						if ($list['list']['15'] >0)
							$list['list_s']['15'] = $list['count'][0] + $list['count'][8] - $list['list']['15'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['15'] = $list['count'][8];
						break;
					case '16' : 
						if ($list['list']['16'] >0)
							$list['list_s']['16'] = $list['count'][0] + $list['count'][8] - $list['list']['16'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['16'] = $list['count'][8];
						break;
					case '17' : 
						if ($list['list']['17'] >0)
							$list['list_s']['17'] = $list['count'][0] + $list['count'][8] - $list['list']['17'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['17'] = $list['count'][8];
						break;
					case '18' : 
						if ($list['list']['18'] >0)
							$list['list_s']['18'] = $list['count'][0] + $list['count'][8] - $list['list']['18'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['18'] = $list['count'][8];
						break;
					case '19' : 
						if ($list['list']['19'] >0)
							$list['list_s']['19'] = $list['count'][0] + $list['count'][8] - $list['list']['19'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['19'] = $list['count'][8];
						break;
					case '20' : 
						if ($list['list']['20'] >0)
							$list['list_s']['20'] = $list['count'][0] + $list['count'][8] - $list['list']['20'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['20'] = $list['count'][8];
						break;
					case '大' : 
						if ($list['list']['21'] >0)
							$list['list_s']['21'] = $list['list']['21'] + $list['count'][9] - $list['list']['21'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['21'] = $list['count'][9];
						break;
					case '小' : 
						if ($list['list']['22'] >0)
							$list['list_s']['22'] = $list['list']['22'] + $list['count'][9] - $list['list']['22'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['22'] = $list['count'][9];
						break;
					case '單' : 
						if ($list['list']['23'] >0){
							$list['list_s']['23'] = $list['list']['23'] + $list['count'][10] - $list['list']['23'] * $RepList[$i]['g_odds']; 
						}
						else 
							$list['list_s']['23'] = $list['count'][10];
						break;
					case '雙' : 
						if ($list['list']['24'] >0)
							$list['list_s']['24'] = $list['list']['24'] + $list['count'][10] - $list['list']['24'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['24'] = $list['count'][10];
						break;
					case '尾大' : 
						if ($list['list']['25'] >0){
							$list['list_s']['25'] = ($list['list']['25'] + $list['count'][11]) - $list['list']['25'] * $RepList[$i]['g_odds']; 
						}
						else 
							$list['list_s']['25'] = $list['count'][11];
						break;
					case '尾小' : 
						if ($list['list']['26'] >0)
							$list['list_s']['26'] = $list['list']['26'] + $list['count'][11] - $list['list']['26'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['26'] = $list['count'][11];
						break;
					case '合數單' : 
					if ($list['list']['27'] >0)
						$list['list_s']['27'] = $list['list']['27'] + $list['count'][12] - $list['list']['27'] * $RepList[$i]['g_odds']; 
					else 
							$list['list_s']['27'] = $list['count'][12];
						break;
					case '合數雙' : 
						if ($list['list']['28'] >0)
							$list['list_s']['28'] = $list['list']['28'] + $list['count'][12] - $list['list']['28'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['28'] = $list['count'][12];
						break;
					case '東' : 
						if ($list['list']['29'] >0)
							$list['list_s']['29'] = $list['list']['29'] + $list['count'][13] - $list['list']['29'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['29'] = $list['count'][13];
						break;
					case '南' : 
						if ($list['list']['30'] >0)
							$list['list_s']['30'] = $list['list']['30'] + $list['count'][13] - $list['list']['30'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['30'] = $list['count'][13];
						break;
					case '西' : 
						if ($list['list']['31'] >0)
							$list['list_s']['31'] = $list['list']['31'] + $list['count'][13] - $list['list']['31'] * $RepList[$i]['g_odds'];
						 else 
							$list['list_s']['31'] = $list['count'][13];
						break;
					case '北' : 
						if ($list['list']['32'] >0)
							$list['list_s']['32'] = $list['list']['32'] + $list['count'][13] - $list['list']['32'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['32'] = $list['count'][13];
						break;
					case '中' :
						if ($list['list']['33'] >0)
						 	$list['list_s']['33'] = $list['list']['33'] + $list['count'][14] - $list['list']['33'] * $RepList[$i]['g_odds']; 
						 else 
							$list['list_s']['33'] = $list['count'][14];
						 break;
					case '發' : 
						if ($list['list']['34'] >0)
							$list['list_s']['34'] = $list['list']['34'] + $list['count'][14] - $list['list']['34'] * $RepList[$i]['g_odds'];
						else 
							$list['list_s']['34'] = $list['count'][14];
						break;
					case '白' : 
						if ($list['list']['35'] >0)
							$list['list_s']['35'] = $list['list']['35'] + $list['count'][14] - $list['list']['35'] * $RepList[$i]['g_odds'];
						 else 
							$list['list_s']['35'] = $list['count'][14];
						break;			
					case '總和大' : 
						if ($list['list']['1'] >0)
							$list['list_s']['1'] = $list['list']['1'] + $list['count'][15] - $list['list']['1'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['1'] = $list['count'][15];
						break;
					case '總和單' : 
						if ($list['list']['2'] >0)
							$list['list_s']['2'] = $list['list']['2'] + $list['count'][16] - $list['list']['2'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['2'] = $list['count'][16];
						break;
					case '總和小' : 
						if ($list['list']['3'] >0)
							$list['list_s']['3'] = $list['list']['3'] + $list['count'][15] - $list['list']['3'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['3'] = $list['count'][15];
						break;
					case '總和雙' : 
						if ($list['list']['4'] >0)
							$list['list_s']['4'] = $list['list']['4'] + $list['count'][16] - $list['list']['4'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['4'] = $list['count'][16];
						break;
					case '總和尾大' : 
						if ($list['list']['5'] >0)
							$list['list_s']['5'] = $list['list']['5'] + $list['count'][17] - $list['list']['5'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['5'] = $list['count'][17];
						break;
					case '龍' : 
						if ($list['list']['6'] >0)
							$list['list_s']['6'] = $list['list']['6'] + $list['count'][18] - $list['list']['6'] * $RepList[$i]['g_odds'];
						else 
							$list['list_s']['6'] = $list['count'][18];
						 break;
					case '總和尾小' : 
						if ($list['list']['7'] >0)
							$list['list_s']['7'] = $list['list']['7'] + $list['count'][17] - $list['list']['7'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['7'] = $list['count'][17];
						break;
					case '虎' : 
						if ($list['list']['8'] >0)
							$list['list_s']['8'] = $list['list']['8'] + $list['count'][18] - $list['list']['8'] * $RepList[$i]['g_odds']; 
						else 
							$list['list_s']['8'] = $list['count'][18];
						break;
				} 
				//print_r($list['list_s'] );exit;
			}
			else 
			{
				switch ($RepList[$i]['g_mingxi_1']) {
					case '任選二' : 
						$h=$this->SumTM($RepList[$i]['g_jiner'],$RepList[$i]['g_id']);
						$ts = $RepList[$i]['g_jiner'] >0 ? ($RepList[$i]['g_tueishui'] / $RepList[$i]['g_jiner']) * $h:$RepList[$i]['g_tueishui'];
						$list['list_id']['i101'][] = $RepList[$i]['g_id'];
						$list['list_s']['101']++; //總注數
						$list['list_o']['o101'][] = $RepList[$i]['g_mingxi_1_str'];
						$list['list_n']['n101'][] = $h;
						$list['list_z']['z101'][] = $RepList[$i]['g_mingxi_2'];
						$list['list_t']['t101'][] = $ts;
						$list['list_p']['p101'][] = $h+$ts-$h* $RepList[$i]['g_odds']; 
						break;
					case '選二連組' : 
						$h=$this->SumTM($RepList[$i]['g_jiner'],$RepList[$i]['g_id']);
						$ts = $RepList[$i]['g_jiner'] >0 ? ($RepList[$i]['g_tueishui'] / $RepList[$i]['g_jiner']) * $h:$RepList[$i]['g_tueishui'];
						$list['list_id']['i102'][] = $RepList[$i]['g_id'];
						$list['list_s']['102']++; //總注數
						$list['list_o']['o102'][] = $RepList[$i]['g_mingxi_1_str'];
						$list['list_n']['n102'][] = $h;
						$list['list_z']['z102'][] = $RepList[$i]['g_mingxi_2'];
						$list['list_t']['t102'][] = $ts;
						$list['list_p']['p102'][] = $h+$ts-$h* $RepList[$i]['g_odds']; 
						break;
					case '任選三' : 
						$h=$this->SumTM($RepList[$i]['g_jiner'],$RepList[$i]['g_id']);
						$ts = $RepList[$i]['g_jiner'] >0 ? ($RepList[$i]['g_tueishui'] / $RepList[$i]['g_jiner']) * $h:$RepList[$i]['g_tueishui'];
						$list['list_id']['i103'][] = $RepList[$i]['g_id'];
						$list['list_s']['103']++; //總注數
						$list['list_o']['o103'][] = $RepList[$i]['g_mingxi_1_str'];
						$list['list_n']['n103'][] = $h;
						$list['list_z']['z103'][] = $RepList[$i]['g_mingxi_2'];
						$list['list_t']['t103'][] = $ts;
						$list['list_p']['p103'][] = $h+$ts-$h* $RepList[$i]['g_odds']; 
						break;
					case '選三前組' : 
						$h=$this->SumTM($RepList[$i]['g_jiner'],$RepList[$i]['g_id']);
						$ts = $RepList[$i]['g_jiner'] >0 ? ($RepList[$i]['g_tueishui'] / $RepList[$i]['g_jiner']) * $h:$RepList[$i]['g_tueishui'];
						$list['list_id']['i104'][] = $RepList[$i]['g_id'];
						$list['list_s']['104']++; //總注數
						$list['list_o']['o104'][] = $RepList[$i]['g_mingxi_1_str'];
						$list['list_n']['n104'][] = $h;
						$list['list_z']['z104'][] = $RepList[$i]['g_mingxi_2'];
						$list['list_t']['t104'][] = $ts;
						$list['list_p']['p104'][] = $h+$ts-$h* $RepList[$i]['g_odds']; 
						break;
					case '任選四' : 
						$h=$this->SumTM($RepList[$i]['g_jiner'],$RepList[$i]['g_id']);
						$ts = $RepList[$i]['g_jiner'] >0 ? ($RepList[$i]['g_tueishui'] / $RepList[$i]['g_jiner']) * $h:$RepList[$i]['g_tueishui'];
						$list['list_id']['i105'][] = $RepList[$i]['g_id'];
						$list['list_s']['105']++; //總注數
						$list['list_o']['o105'][] = $RepList[$i]['g_mingxi_1_str'];
						$list['list_n']['n105'][] = $h;
						$list['list_z']['z105'][] = $RepList[$i]['g_mingxi_2'];
						$list['list_t']['t105'][] = $ts;
						$list['list_p']['p105'][] = $h+$ts-$h* $RepList[$i]['g_odds']; 
					break;
					case '任選五' : 
						$h=$this->SumTM($RepList[$i]['g_id']);
						$ts = $RepList[$i]['g_jiner'] >0 ? ($RepList[$i]['g_tueishui'] / $RepList[$i]['g_jiner']) * $h:$RepList[$i]['g_tueishui'];
						$list['list_id']['i106'][] = $RepList[$i]['g_id'];
						$list['list_s']['106']++; //總注數
						$list['list_o']['o106'][] = $RepList[$i]['g_mingxi_1_str'];
						$list['list_n']['n106'][] = $h;
						$list['list_z']['z106'][] = $RepList[$i]['g_mingxi_2'];
						$list['list_t']['t106'][] = $ts;
						$list['list_p']['p106'][] = $h+$ts-$h* $RepList[$i]['g_odds']; 
						break;
				}
			}
		}
		for ($i=1; $i<21; $i++){
			$a[]=$list['list_s'][$i];
		}
		$list['count'][1] = sumMix ($a);
		return $list;
	}
	
	private function SumTM($money,$id)
	{
		$n=$money;
		if ($this->UserList)
		{
			for ($i=0; $i<count($this->UserList); $i++)
			{
				if ($this->UserList[$i]['g_t_id']==$id){
					$n = $n - ($this->UserList[$i]['g_jiner']*$this->UserList[$i]['g_mingxi_1_str']);
				}
			}
		}
		return $n;
	}
	
	
/**
	 * 復式計算
	 * Enter description here ...
	 * @param Array $strArr 數組
	 * @param int 循環
	 * @return Array
	 */
	private function subNumber ($strArr, $count)
	{
		$Number = array();
		for ($a=0; $a<count($strArr); $a++)
		{
			$_a = $a+1;
			for ($b=$_a; $b<count($strArr); $b++)
			{
				if ($count == 2 && Copyright)
				{
					$exp = $strArr[$a].'、'.$strArr[$b];
					array_push($Number, $exp);
					continue;
				}
				$_b = $b+1;
				for ($c=$_b; $c<count($strArr); $c++)
				{
					if ($count == 3)
					{
						$exp = $strArr[$a].'、'.$strArr[$b].'、'.$strArr[$c];
						array_push($Number, $exp);
						continue;
					}
				
					$_c = $c+1;
					for ($d=$_c; $d<count($strArr); $d++)
					{
						if ($count == 4)
						{
							$exp = $strArr[$a].'、'.$strArr[$b].'、'.$strArr[$c].'、'.$strArr[$d];
							array_push($Number, $exp);
							continue;
						}
					
						$_d = $d+1;
						for ($e=$_d; $e<count($strArr); $e++)
						{
							if ($count == 5)
							{
								$exp = $strArr[$a].'、'.$strArr[$b].'、'.$strArr[$c].'、'.$strArr[$d].'、'.$strArr[$e];
								array_push($Number, $exp);
								continue;
							}
						}
					}
				}
			}
		}
		return $Number;
	}
	
	/**
	 * 計算實佔注單
	 * @param Array 注單列表
	 * @param Int 用戶級別
	 * @return Array
	 */
	private function SumReport ($result, $logId)
	{

		$List = array();
		for ($i=0; $i<count($result); $i++) 
		{
			$List[$i]['g_id'] = $result[$i]['g_id'];
			$List[$i]['g_mingxi_1'] = $result[$i]['g_mingxi_1'];
			$List[$i]['g_mingxi_2'] = $result[$i]['g_mingxi_2'];
			$List[$i]['g_mingxi_1_str'] = $result[$i]['g_mingxi_1_str'];
			if ($result[$i]['g_mingxi_1_str'])
				$result[$i]['g_jiner'] = $result[$i]['g_jiner'] * $result[$i]['g_mingxi_1_str'];
				
			if ($logId == 89 ){
				//注額計算，注額*佔成
				$ts = (((100-$result[$i]['g_tueishui_4'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_4']/100);
				$List[$i]['g_jiner'] = $result[$i]['g_jiner'] * ($result[$i]['g_distribution_4']/100);
			}else if($logId == 56){
				if ($result[$i]['g_tueishui_3'] >0 && Copyright){
					$ts = (((100-$result[$i]['g_tueishui_3'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_3']/100);
				} else {
					$ts = (((100-$result[$i]['g_tueishui'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_3']/100);
				}
				$List[$i]['g_jiner'] = $result[$i]['g_jiner'] * ($result[$i]['g_distribution_3']/100);
			}else if ($logId == 22){
				//注額計算，注額*佔成
				if ($result[$i]['g_tueishui_2'] >0 && Copyright){
					$ts = (((100-$result[$i]['g_tueishui_2'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_2']/100);
				} else {
					$ts = (((100-$result[$i]['g_tueishui'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_2']/100);
				}
				$List[$i]['g_jiner'] = $result[$i]['g_jiner'] * ($result[$i]['g_distribution_2']/100);
			}else if ($logId == 78){
				//注額計算，注額*佔成
				if ($result[$i]['g_tueishui_1'] >0 && Copyright){
					$ts = (((100-$result[$i]['g_tueishui_1'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_1']/100);
				} else {
					$ts = (((100-$result[$i]['g_tueishui'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution_1']/100);
				}
				$List[$i]['g_jiner'] = $result[$i]['g_jiner'] * ($result[$i]['g_distribution_1']/100);
			}else if ($logId == 48){
				//注額計算，注額*佔成
				$ts = (((100-$result[$i]['g_tueishui'])/100) * $result[$i]['g_jiner']) * ($result[$i]['g_distribution']/100);
				$List[$i]['g_jiner'] = $result[$i]['g_jiner'] * ($result[$i]['g_distribution']/100);
			}
			$List[$i]['g_odds'] = $result[$i]['g_odds'];
			$List[$i]['g_tueishui'] = $ts;
		}
		return $List;
	}
	
	/**
	 * 讀取賠率列表，開盤時間，封盤時間，開盤期數
	 */
	private function GetOddsInfo ()
	{
		$result = $this->db->query("SELECT * FROM g_kaipan WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1  ", 1);
		if ($result)
		{
			switch ($this->cid)
			{
				case '1': $p=35; $g_id = "Ball_1"; break;
				case '2': $p=35; $g_id = "Ball_2"; break;
				case '3': $p=35; $g_id = "Ball_3"; break;
				case '4': $p=35; $g_id = "Ball_4"; break;
				case '5': $p=35; $g_id = "Ball_5"; break;
				case '6': $p=35; $g_id = "Ball_6"; break;
				case '7': $p=35; $g_id = "Ball_7"; break;
				case '8': $p=35; $g_id = "Ball_8"; break;
				case '9': $p=8; $g_id = "Ball_9"; break;
				case '10': $p=8; $g_id = "Ball_10"; break;
				default:$p = $g_id = null;
			}
			$oddsList = selectOdds($p, $g_id); //賠率
			$endTime = strtotime($result[0]['g_feng_date']) - time();
			$openTime =  strtotime($result[0]['g_open_date']) - time();
			$Phases = $result[0]['g_qishu'];
			$InfoList = array();
			$userList = $this->UserInfo ($Phases);
			$count = array(0=>0, 1=>0, 2=>0);
			$InfoList['userList'] = $userList;
			$InfoList['oddList'] = $oddsList;
			$InfoList['endTime'] = $endTime;
			$InfoList['openTime'] = $openTime;
			$InfoList['phasesNumber'] = $Phases;
			//$InfoList['opNumber'] = $opNumber[0][0];
			//$InfoList['countLose'] = $count[1];
			//$InfoList['countWin'] = $count[2];
			return $InfoList;
		}
		else 
		{
			return null;
		}
	}
	
	/**
	 * 計算用戶輸贏結果
	 * @param Array $user
	 */
	public function SumResult($Users)
	{
		include_once ROOT_PATH.'function/Crystals.php';
		$CentetArr = array();
		$CentetArr['userList']['s_types'] = null;
		$CentetArr['userList']['s_type'] = null;
		$CentetArr['userList']['s_t_N'] = 1;
		$CentetArr['userList']['startDate'] = date("Y-m-d");
		$CentetArr['userList']['endDate'] = date("Y-m-d");
		$CentetArr['userList']['s_Report'] = 'a';
		$CentetArr['userList']['s_Balance'] = 1;
		if ($Users[0]['g_login_id']==89)
		{
			$result = $this->db->query("SELECT `g_nid`,`g_login_id`, `g_name` FROM `g_manage` WHERE g_nid = '{$Users[0]['g_nid']}' LIMIT 1", 1);
			
			$CentetArr['userList']['s_name'] = $result[0]['g_name'];
			$CentetArr['userList']['g_login_id'] = $result[0]['g_login_id'];
			$CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][1];
			$s_rank = $Users[0]['g_Lnid'][2];
			$CentetArr['userList']['s_nid'] = $result[0]['g_nid'].UserModel::Like();
		}
		else 
		{
			$CentetArr['userList']['s_name'] = $Users[0]['g_name'];
			if ($Users[0]['g_login_id'] == 48){
				$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'];
				$param = true;
			}
			else {
				$CentetArr['userList']['s_nid'] = $Users[0]['g_nid'].UserModel::Like();
			}
			$CentetArr['userList']['g_login_id'] = $Users[0]['g_login_id'];
			$CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][0];
			$s_rank = $Users[0]['g_Lnid'][1];
		}
		$result = ResultNid ($this->db, $CentetArr['userList']['s_nid'], true, $param);
		for ($i=0; $i<count($result); $i++) {
			$c = GetCrystals($this->db, $CentetArr['userList'], $result[$i]);
			if ($c != null) {
					$result[$i]['cry'] = $c;
					$CentetArr['cryList'][] = $result[$i];
			}
		}//print_r($CentetArr);
		$CentetArr = SumCrystals ($CentetArr);
		$money = $CentetArr['userList']['s_rank']=='总公司' ? $CentetArr['userList']['count_s'][3] : $CentetArr['userList']['count_s'][9];
		return is_Number($money,1);
	}
	
	/**
	 * 補倉函數
	 * @param array $List
	 */
	public function PostCrystls($List, $param='a')
	{
		$arr = array();
		if ($List['g_typeid'] =='廣東快樂十分'){
			$p =$List['s_type'];
			$s = false;
		}else{
			$p = _getStringcq($List['s_type'], $List['s_num'][0]);
			$s = true;
		}
		switch ($this->User[0]['g_login_id'])
		{
			case 22 :
				$nid = mb_substr($this->User[0]['g_nid'], 0, mb_strlen($this->User[0]['g_nid'])-32);
				$RankUser = RankUser ($this->db,  $nid);
				$this->User[0]['g_panlu'] = $param;
				for ($i=0; $i<count($List['s_num']); $i++)
				{
					$floorMoney = floorMoney ($this->User, $p, $List['s_num'][$i], $RankUser, $s);
					$arr[$i]['g_t_id'] = $List['s_id'];
					$arr[$i]['g_s_nid'] = $this->User[0]['g_nid'];
					$arr[$i]['g_nid'] = '股東走飛';
					$arr[$i]['g_mumber_type'] = 5;
					$arr[$i]['g_type'] = $List['g_typeid'];
					$arr[$i]['g_qishu'] = $List['s_number'];
					$arr[$i]['g_mingxi_1'] = $List['s_type'];
					$arr[$i]['g_mingxi_1_str'] = $List['s_mingxi_1_str'];
					$arr[$i]['g_mingxi_2'] = $List['s_num'][$i];
					$arr[$i]['g_mingxi_2_str'] = null;
					$arr[$i]['g_odds'] = $List['s_odds'];
					$arr[$i]['g_jiner'] = $List['s_money'][$i];
					$arr[$i]['g_tueishui'] = $floorMoney;
					$arr[$i]['g_tueishui_1'] = 0;
					$arr[$i]['g_tueishui_2'] = 0;
					$arr[$i]['g_tueishui_3'] = $floorMoney;
					$arr[$i]['g_tueishui_4'] = $floorMoney;
					$arr[$i]['g_distribution'] = 0;
					$arr[$i]['g_distribution_1'] = 0;
					$arr[$i]['g_distribution_2'] = 0;
					$arr[$i]['g_distribution_3'] = $RankUser[0]['g_distribution_limit'];
					$arr[$i]['g_distribution_4'] = 100-$RankUser[0]['g_distribution_limit'];
					$arr[$i]['g_id'] = $this->WhileInsert ($arr[$i]);
				}
				break;
			case 78 :
				$nid = mb_substr($this->User[0]['g_nid'], 0, mb_strlen($this->User[0]['g_nid'])-32);
				$RankUser1 = RankUser ($this->db,  $nid); //股東
				$nid = mb_substr($this->User[0]['g_nid'], 0, mb_strlen($this->User[0]['g_nid'])-64);
				$RankUser2 = RankUser ($this->db,  $nid); //公司
				$this->User[0]['g_panlu'] = 'a';
				for ($i=0; $i<count($List['s_num']); $i++)
				{
					$floorMoney1 = floorMoney ($this->User, $p, $List['s_num'][$i], $RankUser1, $s);
					$floorMoney2 = floorMoney ($this->User, $p, $List['s_num'][$i], $RankUser2, $s);
					$arr[$i]['g_t_id'] = $List['s_id'];
					$arr[$i]['g_s_nid'] = $this->User[0]['g_nid'];
					$arr[$i]['g_nid'] = '總代理走飛';
					$arr[$i]['g_mumber_type'] = 5;
					$arr[$i]['g_type'] = $List['g_typeid'];
					$arr[$i]['g_qishu'] = $List['s_number'];
					$arr[$i]['g_mingxi_1'] = $List['s_type'];
					$arr[$i]['g_mingxi_1_str'] = $List['s_mingxi_1_str'];
					$arr[$i]['g_mingxi_2'] = $List['s_num'][$i];
					$arr[$i]['g_mingxi_2_str'] = null;
					$arr[$i]['g_odds'] = $List['s_odds'];
					$arr[$i]['g_jiner'] = $List['s_money'][$i];
					$arr[$i]['g_tueishui'] = $floorMoney1;
					$arr[$i]['g_tueishui_1'] = 0;
					$arr[$i]['g_tueishui_2'] = $floorMoney1;
					$arr[$i]['g_tueishui_3'] = $floorMoney2;
					$arr[$i]['g_tueishui_4'] = $floorMoney2;
					$arr[$i]['g_distribution'] = 0;
					$arr[$i]['g_distribution_1'] = 0;
					$arr[$i]['g_distribution_2'] = $this->User[0]['g_distribution_limit'];
					$arr[$i]['g_distribution_3'] = $RankUser2[0]['g_distribution_limit']  - $this->User[0]['g_distribution_limit'];
					$arr[$i]['g_distribution_4'] = 100- $RankUser2[0]['g_distribution_limit'] ;
					$arr[$i]['g_id'] = $this->WhileInsert ($arr[$i]);
				}
				break;
			case 48 :
				$nid = mb_substr($this->User[0]['g_nid'], 0, mb_strlen($this->User[0]['g_nid'])-32);
				$RankUser1 = RankUser ($this->db,  $nid); //總代理
				$nid = mb_substr($this->User[0]['g_nid'], 0, mb_strlen($this->User[0]['g_nid'])-64);
				$RankUser2 = RankUser ($this->db,  $nid); //股東
				$nid = mb_substr($this->User[0]['g_nid'], 0, mb_strlen($this->User[0]['g_nid'])-96);
				$RankUser3 = RankUser ($this->db,  $nid); //公司
				$this->User[0]['g_panlu'] = 'a';
				for ($i=0; $i<count($List['s_num']); $i++)
				{
					$floorMoney1 = floorMoney ($this->User, $p, $List['s_num'][$i], $RankUser1, $s);
					$floorMoney2 = floorMoney ($this->User, $p, $List['s_num'][$i], $RankUser2, $s);
					$floorMoney3 = floorMoney ($this->User, $p, $List['s_num'][$i], $RankUser3, $s);
					$arr[$i]['g_t_id'] = $List['s_id'];
					$arr[$i]['g_s_nid'] = $this->User[0]['g_nid'];
					$arr[$i]['g_nid'] = '代理走飛';
					$arr[$i]['g_mumber_type'] = 5;
					$arr[$i]['g_type'] = $List['g_typeid'];
					$arr[$i]['g_qishu'] = $List['s_number'];
					$arr[$i]['g_mingxi_1'] = $List['s_type'];
					$arr[$i]['g_mingxi_1_str'] = $List['s_mingxi_1_str'];
					$arr[$i]['g_mingxi_2'] = $List['s_num'][$i];
					$arr[$i]['g_mingxi_2_str'] = null;
					$arr[$i]['g_odds'] = $List['s_odds'];
					$arr[$i]['g_jiner'] = $List['s_money'][$i];
					$arr[$i]['g_tueishui'] = $floorMoney1;
					$arr[$i]['g_tueishui_1'] = $floorMoney1;
					$arr[$i]['g_tueishui_2'] = $floorMoney2;
					$arr[$i]['g_tueishui_3'] = $floorMoney3;
					$arr[$i]['g_tueishui_4'] = $floorMoney3;
					$arr[$i]['g_distribution'] = 0;
					$arr[$i]['g_distribution_1'] = $this->User[0]['g_distribution_limit'];
					$arr[$i]['g_distribution_2'] = $RankUser1[0]['g_distribution_limit'];
					$arr[$i]['g_distribution_3'] = $RankUser3[0]['g_distribution_limit'] - ($this->User[0]['g_distribution_limit']+$RankUser1[0]['g_distribution_limit']);
					$arr[$i]['g_distribution_4']=100-$RankUser3[0]['g_distribution_limit'];
					$arr[$i]['g_id'] = $this->WhileInsert ($arr[$i]);
				}
				break;
		}
		return $arr;
	}
	
	public  function WhileInsert ($list)
	{
		$sql = "INSERT INTO `g_zhudan` ( `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_distribution_4`,`g_t_id`) "; 
		$sql .= "VALUES (
					'{$list['g_s_nid']}', 
					'{$list['g_mumber_type']}', 
					'{$list['g_nid']}', 
					  now(), 
					'{$list['g_type']}', 
					'{$list['g_qishu']}', 
					'{$list['g_mingxi_1']}', 
					'{$list['g_mingxi_1_str']}', 
					'{$list['g_mingxi_2']}', 
					'{$list['g_mingxi_2_str']}', 
					'{$list['g_odds']}', 
					'{$list['g_jiner']}', 
					'{$list['g_tueishui']}',
					'{$list['g_tueishui_1']}',
					'{$list['g_tueishui_2']}',
					'{$list['g_tueishui_3']}',
					'{$list['g_tueishui_4']}',
					'{$list['g_distribution']}',
					'{$list['g_distribution_1']}',
					'{$list['g_distribution_2']}',
					'{$list['g_distribution_3']}',
					'{$list['g_distribution_4']}',
					'{$list['g_t_id']}')";
		return $this->db->query($sql, 4);
	}
	
	/**
	 * 調用函數
	 */
	public function ResultInfo ()
	{	
		return $this->GetOddsInfo();
	}
}

?>