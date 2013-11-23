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

class UserModel 
{
	private $db;
    public $cop_id = 56;
    public $stock_id = 22;
    public $maina_id = 78;
    public $agent_id = 48;
    private  $top_nid = '67552ea64c6dce1646a263bae714e788';
	function __construct()
	{
		$this->db = new DB();
	}
    /*
     * 返回每个等级的个数
     * @param $query_type 查询的类型，1为查询结果，3为查询数量
     * @param $top_id 当前用户的nid
     * @param $loginid 当前用户的权限id
     * @return 0是当前下一级，以此类推
     */
    public function  Get_all_count($query_type,$top_id='67552ea64c6dce1646a263bae714e788',$loginid=89)
    {
        $counter = 0;
        if ($loginid == $this->cop_id) {
            $counter = 5;
        } else if ($loginid == $this->stock_id) {
            $counter = 4;
        } else if ($loginid == $this->maina_id) {
            $counter = 3;
        } else if ($loginid == $this->agent_id) {
            $counter = 2;
        } else {
            $counter = 6;
        }
        $Like= UserModel::Like();
        $ret = array();
        $sql = '';
        for ($i=0; $i<$counter; $i++) {
            if ($i != ($counter - 1)) {//说明是会员
                $sql= "select g_name from `g_rank` where g_nid like '{$top_id}'";
            } else {
                $sql = 'select g_name from `g_user`';
            }
            $top_id .= $Like;
            $ret[$i]= $this->db->query($sql,$query_type);
        }

        return $ret;
    }
    //获取上级数据
    public function get_upper($user_nid) {
        $ret = array();
        $v = mb_substr($user_nid, 0, mb_strlen($user_nid, 'utf-8') - 32);
        $tmp = $this->GetUserName_Like($v);
        $tmp = $tmp[0];
        return $tmp;
    }
    //从名称获取其阶乘名称
    public function Get_rank_from_name($name)
    {
        $l = 32;//每一个等级之间相隔的数量
        $toplength = strlen($this->top_nid);
        $sql_str = "select g_nid from `g_rank` where g_name='{$name}'";
        $result = $this->db->query($sql_str, 1);
        if (!$result) {
            $sql_str = "select g_nid from `g_user` where g_name='{$name}'";
            $result = $this->db->query($sql_str,1);
            if ($result) {
                return "会员";
            }
        }
        $length = strlen($result[0]["g_nid"]);
        $sub = $length - $toplength;
        $i = intval( $sub / $l);
        switch ($i) {
            case 1:
                return "分公司";
                break;
            case 2:
                return "股东";
                break;
            case 3:
                return "总代理";
                break;
            case 4:
                return "代理";
                break;
            case 5:
                return "会员";
                break;
            default:
                exit(alert("Get_rank_from_name erro!i=$i,name=$name"));
        }
    }
	/**
	 * UNION 查詢
	 * 判斷帳號用戶是否存在
	 */
	public function ExistUnion ($userName, $passWord=null)
	{
		$pwd = $passWord==null ? "" : " AND g_password = '{$passWord}' ";
		$sql = " (SELECT `g_login_id` FROM `g_manage` WHERE g_name = '{$userName}' {$pwd}) UNION ".
				     " (SELECT `g_login_id` FROM `g_user` WHERE g_name = '{$userName}' {$pwd}) UNION ".
					 " (SELECT `g_s_name` FROM `g_relation_user` WHERE g_s_name = '{$userName}' {$pwd}) UNION ".
				     " (SELECT `g_login_id` FROM `g_rank` WHERE g_name = '{$userName}' {$pwd}) ";
		 
		return $this->db->query($sql, 0);
	}

	public function ExistUniondl ($userName, $passWord=null)
	{
		$pwd = $passWord==null ? "" : " AND g_password = '{$passWord}' ";
		$sql = " (SELECT `g_login_id` FROM `g_user` WHERE g_name = '{$userName}' {$pwd}) UNION ".
					 " (SELECT `g_s_name` FROM `g_relation_user` WHERE g_s_login_id<>89 and  g_s_name = '{$userName}' {$pwd}) UNION ".
				     " (SELECT `g_login_id` FROM `g_rank` WHERE g_name = '{$userName}' {$pwd}) ";
		return $this->db->query($sql, 0);
	}
	
	
	public function GetRankAll()
	{
		$sql = "SELECT `g_nid`, `g_name` FROM g_rank ORDER BY g_date DESC";
		$rankResult = $this->db->query($sql, 1);
		$list = array();
		if ($rankResult)
		{
			foreach ($rankResult as $value)
			{
				$len = mb_strlen($value['g_nid']);
				if ($len == 64 && Copyright)
					$list[0][] = $value['g_name'];
				else if ($len == 96 && Copyright)
					$list[1][] = $value['g_name'];
				else if ($len == 128 && Copyright)
					$list[2][] = $value['g_name'];
			}
		}
		return $list;
	}
	
	public function GetMemberAll()
	{
		$sql = "SELECT `g_name` FROM g_user ORDER BY g_date DESC";
		return $this->db->query($sql, 0);
	}
	
	/**
	 * 得到會員實體
	 * @param String $name
	 */
	public function GetMemberModel ($name)
	{
		$sql = "SELECT * FROM g_user WHERE `g_name` = '{$name}' LIMIT 1";
		return $this->db->query($sql, 1);
	}
	
	/**
	 * 得到當前用戶Model
	 * @param int $param 89管理員、56公司、22股東、78總代、48代理
	 * @return Array
	 */
	public function GetUserModel ($loginId=null, $userName, $passWord=null, $son=false)
	{
		$pwd = $passWord == null ? "" : "AND `g_password` = '{$passWord}' ";
		if ($son == false && Copyright)
		{
			$from = $loginId == null ? "`g_rank`" : $this->GetLoginId($loginId);
			$sql = "SELECT * FROM {$from} WHERE `g_name` = '{$userName}' {$pwd} LIMIT 1 ";
		} 
		else //查詢子帳號，首選查詢管理員子帳號
		{
			$sonUser = $this->db->query("SELECT g_s_login_id FROM g_relation_user WHERE g_s_name = '{$userName}' {$pwd} LIMIT 1 ", 0);
			if ($sonUser[0][0] == 89 && Copyright){
				//管理員子帳號
				$rFrom = "g_manage";
			} else {
				$rFrom = "g_rank";
			}
			$sql ="SELECT r. * , 
						u.`g_s_name`, 
						u.`g_lock` AS g_s_lock, 
						u.`g_lock_1` , 
						u.`g_lock_2` , 
						u.`g_lock_3` , 
						u.`g_lock_4` , 
						u.`g_lock_5` , 
						u.`g_lock_6` , 
						u.`g_lock_1_1` , 
						u.`g_lock_1_2` , 
						u.`g_lock_1_3` , 
						u.`g_lock_1_4` , 
						u.`g_lock_1_5` , 
						u.`g_lock_1_6` , 
						u.`g_lock_1_7` , 
						u.`g_out` AS g_s_out, 
						u.`g_s_uid` , 
						u.`g_s_login_id`,
						u.`g_sh_id` 
						FROM `g_relation_user` AS u
						INNER JOIN {$rFrom} AS r ON u.g_s_nid = r.g_nid
						WHERE u.g_s_name = '{$userName}' ";
		}
		return $this->db->query($sql, 1);
	}
	
	/**
	 * 得到用戶退水盤、$param = true 讀取會員退水盤
	 * @param String $name
	 * @param Bool $param
	 */
	public function GetUserMR ($name, $param=FALSE)
	{
		if ($param && Copyright)
			$sql = "SELECT g_type, g_panlu_a,g_panlu_b,g_panlu_c, g_danzhu, g_danxiang FROM g_panbiao WHERE `g_nid` = '{$name}' ORDER BY g_id DESC ";
		else 
			$sql = "SELECT g_type, g_a_limit, g_b_limit, g_c_limit, g_d_limit, g_e_limit  FROM g_send_back WHERE `g_name` = '{$name}' ORDER BY g_id DESC ";

			return $this->db->query($sql, 1);
	}
	
	/**
	 * LIKE 查詢
	 * @param String $uid
	 * @param $param == true 時、查詢會員表
	 * @return Array
	 */
	public function GetUserName_Like ($nid, $param=FALSE, $s_name=null, $limit=null,$lname=null,$level=1)
	{
	
		$sql ="select g_nid from g_rank where g_name='{$lname}'";
	
		$result=$this->db->query($sql, 1);

		$order = "ORDER BY g_date DESC";
		$name = $s_name;
		if (!$param && Copyright) {	
		if($lname!=null){
		$Like=$result[0]['g_nid'];
		for ($i=0; $i<(32*$level); $i++) $Like .='_';
		$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, `g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_Immediate2_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`, `g_out`, `g_count_time` FROM `g_rank` 
			WHERE g_nid like '".$Like."'  {$name}  {$order} {$limit}";
			}
		else{
			$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, `g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_Immediate2_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`, `g_out`, `g_count_time` FROM `g_rank` 
			WHERE g_nid LIKE '{$nid}'  {$name}  {$order} {$limit}";
			
			}
		}
		else {
		$order = "ORDER BY g_id DESC";
		if($lname!=null){
			
			if($level==4){
			$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid`,`iscash` FROM `g_user` 
			WHERE g_nid LIKE '{$result[0]['g_nid']}%' {$name}  {$order} {$limit}";
			}else{
				$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid`,`iscash` FROM `g_user`  
			WHERE g_nid = '".$result[0]['g_nid']."'  {$name}  {$order} {$limit}";
			}
		}else
			$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid`,`iscash` FROM `g_user` 
			WHERE g_nid LIKE '{$nid}' {$name}  {$order} {$limit}";
		}
		return $this->db->query($sql, 1);
	}
	
	
	public function GetUserName_LikeNo ($nid, $param=FALSE, $s_name=null, $limit=null,$lname=null,$level=1)
	{
		if($level==null) $level=1;
		$sql ="select g_nid from g_rank where g_name='{$lname}'";
	
		$result=$this->db->query($sql, 1);

		$order = "ORDER BY g_date DESC";
		$name = $s_name;
		if (!$param && Copyright) {	
		if($lname!=null){
		$Like=$result[0]['g_nid'];
		for ($i=0; $i<(32*$level); $i++) $Like .='_';
		$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, `g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_Immediate2_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`, `g_out`, `g_count_time` FROM `g_rank` 
			WHERE g_nid like '".$Like."'  {$name}  {$order}";
			}
		else{
			$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, `g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_Immediate2_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`, `g_out`, `g_count_time` FROM `g_rank` 
			WHERE g_nid LIKE '{$nid}'  {$name}  {$order}";
			
			}
		}
		else {
			$order = "ORDER BY g_id DESC";
		if($lname!=null){
			if($level==4){
			$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` 
			WHERE g_nid LIKE '{$result[0]['g_nid']}%' {$name}  {$order}";
			}else{
				$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` 
			WHERE g_nid = '".$result[0]['g_nid']."'  {$name}  {$order}";
			}
		}else
			$sql = " SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` 
			WHERE g_nid LIKE '{$nid}' {$name}  {$order}";
		}
		return $this->db->query($sql, 1);
	}
	
	/**
	 * 得到下一級帳號總數
	 * @param String $uid
	 */
	public function SumCount ($nid, $param=FALSE)
	{
		$from = $param == TRUE ? "g_user" : "g_rank";
		$sql = "SELECT g_name FROM {$from} WHERE g_nid LIKE '{$nid}' ";
		$b = $this->db->query($sql, 3);
		return $b;
	}
	
	/**
	 * 得到用戶下級總餘額
	 * Enter description here ...
	 * @param int $nid
	 * @param bool $param
	 */
	public function SumMoney ($nid, $param=FALSE)
	{
		$r = 0;
		if (!$param && Copyright) { //取非會員級別的總額
			$sql = "SELECT SUM(g_money) FROM `g_rank` WHERE g_nid LIKE '{$nid}' LIMIT 1";
			$r = $this->db->query($sql, 0);
			$r = $r[0][0] ? $r[0][0] : 0;
			//$n = mb_substr($nid, 0, mb_strlen($nid)-32);
			$sql = "SELECT SUM(g_money) FROM `g_user` WHERE g_nid LIKE '{$nid}' AND `g_mumber_type` = 2 LIMIT 1";
			$n = $this->db->query($sql, 0);
			$n = $n[0][0] ? $n[0][0] : 0;
			$r = $r + $n;
			$m = mb_substr($nid, 0, mb_strlen($nid)-32);
		} else {
			$sql = "SELECT SUM(g_money) FROM `g_user` WHERE g_nid LIKE '{$nid}' LIMIT 1";
			$r = $this->db->query($sql, 0);
			$r = $r[0][0] ? $r[0][0] : 0;
			$m = $nid;
		}
		//獲取當前用戶今天的補飛總金額
		//$m = mb_substr($nid, 0, mb_strlen($nid)-32);
		$date = date('Y-m-d');
		$startDate = $date.' 00:00';
		$endDate = $date.' 24:00';
		$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
		$s=0;
		//$sql = "SELECT g_jiner, g_mingxi_1_str FROM g_zhudan WHERE g_s_nid = '{$m}' AND {$date} ";
		$sql = "SELECT g_jiner, g_mingxi_1_str FROM g_zhudan WHERE g_s_nid = '{$m}' AND g_mumber_type = 5 AND {$date} ";
		$result = $this->db->query($sql, 1);
		if ($result && Copyright){
			for ($i=0; $i<count($result); $i++){
				if ($result[$i]['g_mingxi_1_str']){
					$s+= $result[$i]['g_jiner'] * $result[$i]['g_mingxi_1_str'];
				}else{
					$s+= $result[$i]['g_jiner'];
				}
			}
		}
		$r += $s;
		return $r;
	}
	
	/**
	 * 修改用戶GUID
	 * @param int $param
	 * @param String $userName
	 * @param String $passWord
	 */
	public function UpdateGuid ($loginId, $userName, $uniqid, $son=false)
	{
		$gip=GetIP();
		if ($son == false && Copyright){
			$from = $this->GetLoginId($loginId);
			$uid = "`g_uid`";
			$where = " `g_name` = '{$userName}' ";
		} else {
			$from = "`g_relation_user`";
			$uid = "`g_s_uid`";
			$where = " `g_s_name` = '{$userName}' ";
		}
		$this->db->Update(" {$uid} = '{$uniqid}', `g_out` =1, `g_count_time`=now(), g_ip='{$gip}' ", $from, $where, 1);
	}
	
	/**
	 * 得到對應登陸標示的表名
	 * @param int $loginId
	 */
	private function GetLoginId ($loginId)
	{
		if ($loginId == 89 && Copyright){
			return "`g_manage`";
		}else {
			return "`g_rank`";
		}
	}
	
	/**
	 * 登陸權限轉換中文
	 * @param int $loginId
	 */
	public function GetLoginIdByString ($loginId)
	{
		$a = array();
		switch ($loginId)
		{
			case 89 : 
				$a[0] = '管理員';$a[1] = '总公司'; $a[2] = '股東';$a[3] = '總代理';$a[4] = '代理';$a[5] = '會員';
				$a[6] = 56;$a[7] = 22; $a[8] = 78;$a[9] = 48;$a[10] = 9;$a[11] = '分公司';
				break;
			case 56 : 
				$a[0] = '分公司';$a[1] = '股東'; $a[2] = '總代理';$a[3] = '代理';$a[4] = '會員';
				$a[5] = 22;$a[6] = 78; $a[7] = 48;$a[8] = 9;
				break;
			case 22 : 
				$a[0] = '股東'; $a[1] = '總代理';$a[2] = '代理';$a[3] = '會員';
				$a[4] = 78; $a[5] = 48;$a[6] = 9;
				break;
			case 78 : 
				$a[0] = '總代理';$a[1] = '代理';$a[2] = '會員';
				$a[3] = 48;$a[4] = 9;
				break;
			case 48 : 
				$a[0] = '代理';$a[1] = '會員';
				$a[2] = 9;
				break;
			case 9 : $a[0] = '會員';
				break;
		}
		return $a;
	}
	
	/**
	 * 新增一個用戶
	 * @param Array $userList
	 */
	public function AddUser ($userList)
	{
		$sql = " INSERT INTO `g_rank` (`g_nid`, `g_login_id`, `g_name`, `g_password`, `g_f_name`, `g_money`, 
		`g_distribution`, `g_distribution_limit`, `g_Immediate_lock`, `g_lock`, `g_ip`, `g_date`, `g_uid`,`g_zcgs`) VALUES(
		'{$userList['g_nid']}',
		'{$userList['g_login_id']}',
		'{$userList['g_name']}',
		'{$userList['g_password']}',
		'{$userList['g_f_name']}',
		'{$userList['g_money']}',
		'{$userList['g_distribution']}',
		'{$userList['g_distribution_limit']}',
		'{$userList['g_Immediate_lock']}',
		'{$userList['g_lock']}',
		'{$userList['g_ip']}',
		'{$userList['g_date']}',
		'{$userList['g_uid']}',
		'{$userList['g_zcgs']}' )";
		$this->db->query($sql, 2);
		if ($userList['id'] == 1)
		{
			$sql = " SELECT `g_type`, `g_a_limit`, `g_b_limit`, `g_c_limit`, `g_d_limit`, `g_e_limit`, `g_game_id` FROM g_send_back_default ORDER BY g_id DESC ";
		}
		else if ($userList['id'] == 2)
		{
			$sql = " SELECT `g_type`, `g_a_limit`, `g_b_limit`, `g_c_limit`, `g_d_limit`, `g_e_limit`, `g_game_id` FROM g_send_back WHERE `g_name` = '{$userList['L_name']}' ORDER BY g_id ASC ";
		}
		$SendBackList = $this->db->query($sql, 1);
		$sql = " INSERT INTO g_send_back (`g_name`, g_type, `g_a_limit`, `g_b_limit`, `g_c_limit`, `g_d_limit`, `g_e_limit`, `g_game_id`) VALUES ";
		$sql1 = "INSERT INTO g_autolet (`g_nid`, `g_name`, `g_type`, `g_game_id`) VALUES ";
		for ($i=0; $i<count($SendBackList); $i++)
		{
			$sql.="(
			'{$userList['g_name']}',
			'{$SendBackList[$i]['g_type']}',
			'{$SendBackList[$i]['g_a_limit']}',
			'{$SendBackList[$i]['g_b_limit']}',
			'{$SendBackList[$i]['g_c_limit']}',
			'{$SendBackList[$i]['g_d_limit']}',
			'{$SendBackList[$i]['g_e_limit']}',
			'{$SendBackList[$i]['g_game_id']}'),";
			if ($userList['id'] == 2 && Copyright){
				$sql1.="(
				'{$userList['g_nid']}',
				'{$userList['g_name']}',
				'{$SendBackList[$i]['g_type']}',
				'{$SendBackList[$i]['g_game_id']}'),";
			}
		}
		$sql = mb_substr($sql, 0,mb_strlen($sql)-1);
		$this->db->query($sql, 2);
		if ($userList['id'] == 2 && Copyright){
			$sql1 = mb_substr($sql1, 0,mb_strlen($sql1)-1);
			$this->db->query($sql1, 2);
		}
	}
	
	/**
	 * 新增會員
	 * Enter description here ...
	 * @param unknown_type $userList
	 */
	public function AddMumberUser ($userList)
	{
		$sql = "INSERT INTO g_user (g_nid, g_login_id, g_name, g_f_name, g_mumber_type, g_password, g_money, g_money_yes, g_distribution, g_panlus,g_panlu, g_xianer, g_out, g_look, g_ip, g_date, g_uid,iscash) VALUES (
		'{$userList['g_nid']}',
		'{$userList['g_login_id']}',
		'{$userList['g_name']}',
		'{$userList['g_f_name']}',
		'{$userList['g_mumber_type']}',
		'{$userList['g_password']}',
		'{$userList['g_money']}',
		'{$userList['g_money_yes']}',
		'{$userList['g_distribution']}',
		'{$userList['g_panlus']}',
		'{$userList['g_panlu']}',
		'{$userList['g_xianer']}',
		'{$userList['g_out']}',
		'{$userList['g_look']}',
		'{$userList['g_ip']}',
		'{$userList['g_date']}',
		'{$userList['g_uid']}',
		'{$userList['iscash']}') ";
		$this->db->query($sql, 2);
		//取出退水盤
		$lenght=0;
		$sql = "SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`";
		$P=$userList['g_panlus'];
		if(strstr($P,'A')!=''){$sql.=',g_a_limit ';$lenght++;}
		if(strstr($P,'B')!=''){$sql.=',g_b_limit ';$lenght++;}
		if(strstr($P,'C')!=''){$sql.=',g_c_limit ';$lenght++;}
		$sql = $sql."FROM `g_send_back` WHERE `g_name` = '{$userList['s_L_Name']}' ORDER BY g_id ASC ";
		
		$result = $this->db->query($sql, 0);
		//寫入退水盤
		$sql = " INSERT INTO `g_panbiao` (`g_nid`, `g_type`,`g_danzhu`, `g_danxiang`, `g_game_id`";
		if(strstr($P,'A')!=''){$sql.=',g_panlu_a ';}
		if(strstr($P,'B')!=''){$sql.=',g_panlu_b ';}
		if(strstr($P,'C')!=''){$sql.=',g_panlu_c ';}
		$sql = $sql.") VALUES ";
		for ($i=0; $i<count($result); $i++)
		{
			$sql.= "('{$userList['g_name']}', '{$result[$i][0]}', '{$result[$i][1]}', '{$result[$i][2]}', '{$result[$i][3]}'"; 			         for($m=1;$m<=$lenght;$m++){
			$flag=3+$m;
		//	$sql.=",'{$result[$i][$flag]}'";
		
		if($userList['g_tuishui']+$result[$i][$flag] > 100 ) {
		$sql.=",'100'";
		}
		if($userList['g_tuishui']+$result[$i][$flag] <= 100 ) {
			$temp=$result[$i][$flag]+$userList['g_tuishui'];
			$sql.=",'{$temp}'";
		}
			}
			
			$sql.=" ),";
						
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$this->db->query($sql, 2);
	}
	
	/**
	 * 獲取客戶端IP
	 */
	public static function GetIP()
	{
				// 初始化一个变量$realip
    static $realip = NULL;

    // 如果$realip不真等于NULL,返回之
    if ($realip !== NULL)
    {
        return $realip;
    }
// 如果$_SERVER有值
    if (isset($_SERVER))
    {
    // 如果$_SERVER['HTTP_X_FORWARDED_FOR']有值
    // 表明客户端通过代理上网
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
        // 使用explode()函数将其用','分割成数组
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            // 开始遍历数组
            foreach ($arr AS $ip)
            {
            // 去掉首尾的空白
                $ip = trim($ip);
     // 不是unknown就是真实上网地址,存值并退出循环
                if ($ip != 'unknown')
                {
                    $realip = $ip;
                    break;
                }
            }
        }
        // $_SERVER['HTTP_X_FORWARDED_FOR']无值 且
        // $_SERVER['HTTP_CLIENT_IP']有值，取其值作为真实IP
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        // $_SERVER['HTTP_X_FORWARDED_FOR']无值(不是用过代理上网)并且
        // $_SERVER['HTTP_CLIENT_IP']也没有值
        else
        {
        // 如果$_SERVER['REMOTE_ADDR']有值，取其值作为真实IP
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else // 都没有值返回'0.0.0.0'
            {
                $realip = '0.0.0.0';
            }
        }
    }
    // $_SERVER没有值
    else 
    {
    // 如果getenv('HTTP_X_FORWARDED_FOR')非空取其值作为真实IP
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        // 如果getenv('HTTP_CLIENT_IP')非空取其值作为真实IP
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        // 否则取getenv('REMOTE_ADDR')的值作为真实IP
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
	}
	
	/**
	 * 每個級別的32個匹配符
	 * Enter description here ...
	 */
	public static function Like ()
	{
		$Like =null;
		for ($i=0; $i<32; $i++) $Like .='_';
		return $Like;
	}
	
	/**
	 * 返回下一級名稱
	 * @param int $cid
	 * @param int $LoginId
	 * @param Array $Users
	 */
	public static function GetNextRank ($cid, $LoginId, $Users)
	{
		$Rank = array();
		$Like = UserModel::Like();
		if ($cid == 1 && $LoginId ==89 && Copyright) //新增公司
		{
			$Rank[0] = $Users[0]['g_Lnid'][0];
			$Rank[1] = $Users[0]['g_Lnid'][1];
			$Rank[2] = $Users[0]['g_nid'];
			$Rank[3] = $Users[0]['g_nid'].$Like;
			$Rank[4] = 1;
			$Rank[5] = 2;
		}
		else if ($cid == 2 && ($LoginId ==89 || $LoginId ==56) && Copyright) //新增股東
		{
			if ($LoginId ==89 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][1];
				$Rank[1] = $Users[0]['g_Lnid'][2];
			}
			else if ($LoginId ==56 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][0];
				$Rank[1] = $Users[0]['g_Lnid'][1];
			}
			if($LoginId ==89){
			$Rank[2] = $Users[0]['g_nid'].$Like;
			$Rank[3] = $Users[0]['g_nid'].$Like.$Like;
			}
			else{
			$Rank[2] = $Users[0]['g_nid'];
			$Rank[3] = $Users[0]['g_nid'].$Like;
			}
		}
		else if ($cid == 3 && ($LoginId ==89 || $LoginId ==56 || $LoginId ==22) && Copyright) //新增總代理
		{
			if ($LoginId ==89 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][2];
				$Rank[1] = $Users[0]['g_Lnid'][3];
				$Rank[2] = $Users[0]['g_nid'].$Like.$Like;
				$Rank[3] = $Users[0]['g_nid'].$Like.$Like.$Like;
			}
			else if ($LoginId ==56 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][1];
				$Rank[1] = $Users[0]['g_Lnid'][2];
				$Rank[2] = $Users[0]['g_nid'].$Like;
				$Rank[3] = $Users[0]['g_nid'].$Like.$Like;
			}
			else if ($LoginId ==22 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][0];
				$Rank[1] = $Users[0]['g_Lnid'][1];
				$Rank[2] = $Users[0]['g_nid'];
				$Rank[3] = $Users[0]['g_nid'].$Like;
			}
		}
		else if ($cid == 4 && ($LoginId ==89 || $LoginId ==56 || $LoginId ==22 || $LoginId ==78) && Copyright) //新增代理
		{
			if ($LoginId ==89 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][3];
				$Rank[1] = $Users[0]['g_Lnid'][4];
				$Rank[2] = $Users[0]['g_nid'].$Like.$Like.$Like;
				$Rank[3] = $Users[0]['g_nid'].$Like.$Like.$Like.$Like;
				$Rank[4] = 3;
			}
			else if ($LoginId ==56 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][2];
				$Rank[1] = $Users[0]['g_Lnid'][3];
				$Rank[2] = $Users[0]['g_nid'].$Like.$Like;
				$Rank[3] = $Users[0]['g_nid'].$Like.$Like.$Like;
				$Rank[4] = 3;
			}
			else if ($LoginId ==22 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][1];
				$Rank[1] = $Users[0]['g_Lnid'][2];
				$Rank[2] = $Users[0]['g_nid'].$Like;
				$Rank[3] = $Users[0]['g_nid'].$Like.$Like;
			}
			else if ($LoginId ==78 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][0];
				$Rank[1] = $Users[0]['g_Lnid'][1];
				$Rank[2] = $Users[0]['g_nid'];
				$Rank[3] = $Users[0]['g_nid'].$Like;
			}
		}
		else if ($cid == 5 && ($LoginId ==89 || $LoginId ==56 || $LoginId ==22 || $LoginId ==78 || $LoginId ==48) && Copyright) //新增會員
		{
			if ($LoginId ==89 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][4];
				$Rank[1] = $Users[0]['g_Lnid'][5];
				$Rank[2] = $Users[0]['g_nid'].$Like.$Like.$Like.$Like;
				$Rank[3] = $Users[0]['g_nid'].'%';
			}
			else if ($LoginId ==56 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][3];
				$Rank[1] = $Users[0]['g_Lnid'][4];
				$Rank[2] = $Users[0]['g_nid'].$Like.$Like.$Like;
				$Rank[3] = $Users[0]['g_nid'].'%';
			}
			else if ($LoginId ==22 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][2];
				$Rank[1] = $Users[0]['g_Lnid'][3];
				$Rank[2] = $Users[0]['g_nid'].$Like.$Like;
				$Rank[3] = $Users[0]['g_nid'].'%';
			}
			else if ($LoginId ==78 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][1];
				$Rank[1] = $Users[0]['g_Lnid'][2];
				$Rank[2] = $Users[0]['g_nid'].$Like;
				$Rank[3] = $Users[0]['g_nid'].'%';
			}
			else if ($LoginId ==48 && Copyright){
				$Rank[0] = $Users[0]['g_Lnid'][0];
				$Rank[1] = $Users[0]['g_Lnid'][1];
				$Rank[2] = $Users[0]['g_nid'];
				$Rank[3] = $Users[0]['g_nid'].'%';
			}
		}
		return $Rank;
	}
}

?>