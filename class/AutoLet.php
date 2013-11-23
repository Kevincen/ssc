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
include_once ROOT_PATH.'Manage/config/global.php';
/**
 * 自動補倉
 * @author Mank
 *
 */
class AutoLet 
{
	private $db;
	private $number;
	private $ConfigModel;
	private $cryList;
	private $param;
	
	/**
	 * 構造函數
	 * @param $number 期數
	 * @param $cryList 補倉注單列表
	 */
	public function __construct($number, $cryList, $p=1)
	{
		$this->param = $p;
		$this->ConfigModel = configModel("`g_automatic_bu_huo_lock`, `g_mix_money`");
		$this->number = $number;
		$this->cryList = $cryList;
		$this->db = new DB();
		$this->GetUserCryList();
	}
	
	/**
	 * 寫入注單
	 */
	private function InsertCry($result)
	{
		$userModel = new UserModel();
		$Users = $userModel->GetUserModel(null, $result['g_l_name']);
		if ($Users && Copyright)
		{
			if ($Users[0]['g_login_id'] == 48 && Copyright)
				$yes_money = $Users[0]['g_money'] - $userModel->SumMoney($Users[0]['g_nid'], true);
			else 
				$yes_money = $Users[0]['g_money'] - $userModel->SumMoney($Users[0]['g_nid'].UserModel::Like());
				
			$s_money = $result['s_mingxi_1_str'] ? $result['g_jiner'] * $result['s_mingxi_1_str'] : $result['g_jiner'];
			
			if ($yes_money > 0 && $yes_money > $s_money && Copyright)
			{
				$userReportInfo = new UserReportInfo($Users, 0);
				$ResultList = $userReportInfo->WhileInsert($result);
			}
		}
	}
	
	/**
	 * 得到每個用戶補倉總值
	 * @return Array
	 */
	private function GetUserCryList()
	{
		//返回個級別補倉列表，2維數組
		$autoLetUserList = $this->GetAutoLetList();
		if ($autoLetUserList && Copyright)
		{
			for ($i=0; $i<count($this->cryList); $i++)
			{
				if ($this->cryList[$i]['g_type'] == '廣東快樂十分')
					$str = _getString($this->cryList[$i]['g_mingxi_1'], $this->cryList[$i]['g_mingxi_2']);
				else if($this->cryList[$i]['g_type'] == '北京赛车PK10')
					$str = _getStringpk($this->cryList[$i]['g_mingxi_1'], $this->cryList[$i]['g_mingxi_2']);
				else
					$str = _getStringcq($this->cryList[$i]['g_mingxi_1'], $this->cryList[$i]['g_mingxi_2']);
				foreach ($autoLetUserList as $v)
				{
					foreach ($v as $value)
					{
						if ($str == $value['g_type'] && Copyright)
						{
							//補倉
							$this->MyCry($value, $this->cryList[$i]);
						}
					}
				}
			}
		}
	}

	private function MyCry($userList, $cryList)
	{
		//返回當前級別的用戶對應每條注單的占成金額
		$logId = result_login_id($userList['g_nid']);
		$list = $this->SumReport ($cryList, $logId);
		//補出金額
		$bMoney = $list['g_jiner'] - $userList['g_money'];
		$arral = array();
		if ($bMoney > 0 && stristr($cryList['g_s_nid'], $userList['g_nid']) && Copyright)
		{
			$arr['g_t_id'] = $cryList['id'];
			$arr['g_type'] = $cryList['g_type'];
			$arr['g_qishu'] = $this->number;
			$arr['g_s_nid'] = $userList['g_nid'];
			$arr['g_jiner'] = $bMoney;
			$arr['g_odds'] = $cryList['g_odds'];
			$arr['g_mingxi_1'] = $cryList['g_mingxi_1'];
			$arr['g_mingxi_2'] = $cryList['g_mingxi_2'];
			$arr['g_mingxi_1_str'] = $cryList['g_mingxi_1_str'];
			$arr['g_mingxi_2_str'] = null;
			$arr['g_mumber_type'] = 5;
			$arr['g_l_name'] = $userList['g_name'];
			switch ($logId)
			{
				case 22 : 
					$arr['g_nid'] = '股東走飛';
					$arr['g_tueishui']= $cryList['g_tueishui_3'];
					$arr['g_tueishui_1']= 0;
					$arr['g_tueishui_2']= 0;
					$arr['g_tueishui_3']= $cryList['g_tueishui_3'];
					$arr['g_tueishui_4']= $cryList['g_tueishui_4'];
					$arr['g_distribution'] = 0;
					$arr['g_distribution_1'] = 0;
					$arr['g_distribution_2'] = 0;
					if($arr['g_distribution_4']==0)
					$arr['g_distribution_3'] = 100;
					else
					{
					$arr['g_distribution_3'] = $arr['g_distribution_3']+$arr['g_distribution_2'];
					}
					break;
				case 78 : 
					$arr['g_nid'] = '總代理走飛';
					$arr['g_tueishui']= $cryList['g_tueishui_2'];
					$arr['g_tueishui_1']= 0;
					$arr['g_tueishui_2']= $cryList['g_tueishui_2'];
					$arr['g_tueishui_3']= $cryList['g_tueishui_3'];
					$arr['g_tueishui_4']= $cryList['g_tueishui_4'];
					$arr['g_distribution'] = 0;
					$arr['g_distribution_1'] = 0;
					$arr['g_distribution_2'] = $cryList['g_distribution_2'];
					if($arr['g_distribution_4']==0)
					$arr['g_distribution_3'] = 100-$cryList['g_distribution_2'];
					else{
					$arr['g_distribution_3'] = 100-($cryList['g_distribution_2']+$cryList['g_distribution_4']);
					}
					break;
				case 48 : 
					$arr['g_nid'] = '代理走飛'; 
					$arr['g_tueishui']= $cryList['g_tueishui_1'];
					$arr['g_tueishui_1']= $cryList['g_tueishui_1'];
					$arr['g_tueishui_2']= $cryList['g_tueishui_2'];
					$arr['g_tueishui_3']= $cryList['g_tueishui_3'];
					$arr['g_tueishui_4']= $cryList['g_tueishui_4'];
					$arr['g_distribution'] = 0;
					$arr['g_distribution_1'] = $cryList['g_distribution_1'];
					$arr['g_distribution_2'] = $cryList['g_distribution_2'];
					if($arr['g_distribution_4']==0)
					$arr['g_distribution_3'] = 100-($cryList['g_distribution_1']+$cryList['g_distribution_2']);
					else{
					$arr['g_distribution_3'] = 100-($cryList['g_distribution_1']+$cryList['g_distribution_2']+$cryList['g_distribution_4']);
					}
					break;
			}
			$this->InsertCry($arr);
		}
	}
	
	/**
	 * 得到占成金額
	 * @param unknown_type $result
	 * @param unknown_type $logId
	 */
	private function SumReport ($result, $logId)
	{
		$List = array();
		$List['g_mingxi_1'] = $result['g_mingxi_1'];
		$List['g_mingxi_2'] = $result['g_mingxi_2'];
		$List['g_mingxi_1_str'] = $result['g_mingxi_1_str'];
		if ($logId == 89 || $logId == 56){
			//注額計算，注額*佔成
			$ts = (((100-$result['g_tueishui_3'])/100) * $result['g_jiner']) * ($result['g_distribution_3']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_3']/100);
		}else if ($logId == 22){
			//注額計算，注額*佔成
			if ($result['g_tueishui_2'] >0){
				$ts = (((100-$result['g_tueishui_2'])/100) * $result['g_jiner']) * ($result['g_distribution_2']/100);
			} else {
				$ts = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($result['g_distribution_2']/100);
			}
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_2']/100);
		}else if ($logId == 78){
			//注額計算，注額*佔成
			if ($result['g_tueishui_1'] >0){
				$ts = (((100-$result['g_tueishui_1'])/100) * $result['g_jiner']) * ($result['g_distribution_1']/100);
			} else {
				$ts = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($result['g_distribution_1']/100);
			}
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_1']/100);
		}else if ($logId == 48){
			//注額計算，注額*佔成
			$ts = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($result['g_distribution']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution']/100);
		}
		$List['g_odds'] = $result['g_odds'];
		$List['g_tueishui'] = $ts;
		return $List;
	}
	
	/**
	 * 得到每個級別自動補倉的列表
	 * @return Array
	 */
	private function GetAutoLetList()
	{
		$sql = "SELECT `g_id`, `g_nid`, `g_name`, `g_type`, `g_choose`, `g_money`, `g_lock` FROM g_autolet WHERE g_lock='1' AND g_game_id = '{$this->param}'";
		$result = $this->db->query($sql, 1);
		if ($result && $this->ConfigModel['g_automatic_bu_huo_lock'] == 1 && Copyright)
		{
			$List = array();
			for ($i=0; $i<count($result); $i++)
			{
				$length = mb_strlen($result[$i]['g_nid']);
				if ($result[$i]['g_money'] >= $this->ConfigModel['g_mix_money'])
				{
					if ($length == 160 && Copyright)
						$List[0][] = $result[$i];
					else if ($length == 128 && Copyright)
						$List[1][] = $result[$i];
					else if ($length == 96 && Copyright)
						$List[2][] = $result[$i];
				}
			}
			ksort($List);
			return $List;
		}
		return null;
	}
}
?>