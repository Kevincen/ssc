<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH .'class/Lang.php';
global $Users, $LoginId;
if ($LoginId != 89)
    if ($Users[0]['g_lock'] == 2)
        exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])) {
    if ($Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
        exit(back($UserOut)); //帳號已被凍結
}
$p = false;
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ') . '01:55:00';
global $stratGamecq, $endGamecq;
if (($dateTime < $stratGamecq && $dateTime > $a) || $dateTime > $endGamecq) {
    $p = true;
}


$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['cid'])) {
    $name = $_POST['name'];
    $cid = $_GET['cid'];
    $s_Pwd = $_POST['s_Pwd'];
    $s_F_Name = $_POST['s_F_Name'];
    $lock = $_POST['lock'];
    if (!Matchs::isStringChi($s_F_Name, 2, 8)) exit(back('輸入名稱錯誤！'));
    if ($cid == 5) {
        $userList = $userModel->GetMemberModel($name);
    } else {
        $userList = $userModel->GetUserModel(null, $name);
    }
    if ($userList) {
        if (!empty($s_Pwd)) {
            if (!Matchs::isString($s_Pwd, 8, 20)) exit(back('輸入密碼錯誤！'));
            $s_Pwd = sha1($s_Pwd);
            $g_pwd = ' ,g_pwd=1 ';
        } else {
            $s_Pwd = $userList[0]['g_password'];
            $g_pwd = ' ,g_pwd=g_pwd ';
        }
        $db = new DB();
        if ($cid == 1 && $LoginId == 89) {
            $s_size_ky = $_POST['s_size_ky'];
            $s_next_ky = $_POST['s_next_ky'];
            $s_money = $_POST['s_money'];

            if (!Matchs::isNumber($s_size_ky) || !Matchs::isNumber($s_next_ky)) exit(back('輸入占成錯誤'));
            /**
             * $s_size_ky = 上級占成 判斷上級總占成是否大於修改后的占成
             *  $s_next_ky = 當前被修改帳號占成、必須進行判斷此帳號所分配的占成是否超出所修改的值，
             *  如果超出將禁止修改。
             */
            if (($s_size_ky + $s_next_ky) > 100)
                exit(back('最高可設占成：100%'));
            if (($s_size_ky + $s_next_ky) != 100)
                exit(back('总公司和分公司占成总和小于：100%'));
            if (!Matchs::isNumber($s_money)) exit(back('輸入信用額錯誤！'));

            if ($userList[0]['g_lock'] != $lock) {
                $sql = "SELECT g_name, g_lock FROM g_rank WHERE g_nid LIKE '{$userList[0]['g_nid']}%' AND g_name <> '{$userList[0]['g_name']}' ";
                $result = $db->query($sql, 1);
                upDateRankLock($db, $result, $lock);
                $sql = "SELECT g_name, g_look FROM g_user WHERE g_nid LIKE '{$userList[0]['g_nid']}%' ";
                $results = $db->query($sql, 1);
                upDateRankLock($db, $results, $lock, 1);
            }
            $sql = " UPDATE `g_rank` SET `g_f_name` = '{$s_F_Name}', g_password = '{$s_Pwd}', `g_lock` = '{$lock}' " . $g_pwd . ",g_money='{$s_money}',g_distribution='{$s_next_ky}',g_distribution_limit='{$s_next_ky}' WHERE `g_name` = '{$userList[0]['g_name']}' LIMIT 1";
            $db->query($sql, 2);
            if ($userList[0]['g_f_name'] != $s_F_Name) {
                $valueList = array();
                $valueList['g_name'] = $userList[0]['g_name'];
                $valueList['g_f_name'] = $_SESSION['sName'];
                $valueList['g_initial_value'] = $userList[0]['g_f_name'];
                $valueList['g_up_value'] = $s_F_Name;
                $valueList['g_up_type'] = '名稱';
                $valueList['g_s_id'] = 1;
                insertLogValue($valueList);
            }
            exit(alert_href('更變成功', 'Actfor.php?cid=' . $cid));
        } else {
            $Lnid = mb_substr($userList[0]['g_nid'], 0, mb_strlen($userList[0]['g_nid']) - 32);
            $Luser = $userModel->GetUserName_Like($Lnid);
            $s_money = $_POST['s_money'];
            $s_a_lock = $_POST['s_a_lock'];
            $s_b_lock = isset($_POST['s_b_lock']) ? $_POST['s_b_lock'] : 1;
            if ($p == true) {
                $s_size_ky = $_POST['s_size_ky'];
                $s_next_ky = $_POST['s_next_ky'];
            } else {
                $s_size_ky = $_POST['s_size_ky'];
                $s_next_ky = $userList[0]['g_distribution'];
            }

            /*$s_size_ky = $_POST['s_size_ky']; //上級占成
            $s_next_ky = $_POST['s_next_ky'] ;*/ //當前被修改帳號占成
            if ($s_a_lock != $userList[0]['g_Immediate_lock']) {
                if ($Luser[0]['g_Immediate_lock'] != 1) {
                    exit(back('更變權限不足！'));
                } else {
                    $sql = "SELECT g_name, g_Immediate_lock FROM g_rank WHERE g_nid LIKE '{$userList[0]['g_nid']}%' AND g_name <> '{$userList[0]['g_name']}' ";
                    $Immediate = $db->query($sql, 1);
                    upDateRankLock($db, $Immediate, 'g_Immediate_lock', $s_a_lock);
                    //print_r($Immediate);exit;
                }
            }
            if ($Luser[0]['g_lock'] != 1) {
                exit(back('更變權限不足！'));
            }
            if (!Matchs::isNumber($s_money)) exit(back('輸入信用額錯誤！'));
            /**
             * 判斷當前修改的信用額是否超出上級可用額
             * 如果超出競爭修改
             */
            if ($userList[0]['g_login_id'] == 48) {
                $validMoney = validMoney($userModel, $userList[0]['g_money'], $userList[0]['g_nid'], true);
            } else {
                $validMoney = validMoney($userModel, $userList[0]['g_money'], $userList[0]['g_nid'] . UserModel::Like(), false);
            }

            if ($s_money != $userList[0]['g_money']) {
                /**
                 * 當信用額發生變化
                 */
                if ($s_money < $userList[0]['g_money']) {
                    $s_moneys = $userList[0]['g_money'] - $s_money;
                    exit(back($validMoney));
                    if ($s_moneys > $validMoney) exit(back('可 “回收” 餘額：' . $validMoney));
                } else {
                    /**
                     * 當前帳號級別不是股東的情況下
                     * 計算出上級的可用金額
                     */
                    if ($userList[0]['g_login_id'] != 56) {
                        $LvalidMoney = validMoney($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'] . UserModel::Like(), false);
                        $LRank = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
                        $LvalidMoneys = $LvalidMoney + $userList[0]['g_money'];
                        if ($s_money > $LvalidMoneys) exit(back($LRank[0] . '可用餘額：' . $LvalidMoney));
                    }
                }
            }

            if (!Matchs::isNumber($s_size_ky) || !Matchs::isNumber($s_next_ky)) exit(back('輸入占成錯誤'));
            /**
             * $s_size_ky = 上級占成 判斷上級總占成是否大於修改后的占成
             *  $s_next_ky = 當前被修改帳號占成、必須進行判斷此帳號所分配的占成是否超出所修改的值，
             *  如果超出將禁止修改。
             */
            if ($s_size_ky > $Luser[0]['g_distribution'] || $s_next_ky > $Luser[0]['g_distribution'] || ($s_size_ky + $s_next_ky) > $Luser[0]['g_distribution'])
                exit(back('最高可設占成：' . $Luser[0]['g_distribution'] . '%'));

            if ($userList[0]['g_login_id'] == 48) {
                $nid = $userList[0]['g_nid'];
                $sql = "SELECT max(`g_distribution`) FROM `g_user` WHERE `g_nid` like '{$nid}' LIMIT 1";
                $max = $db->query($sql, 0);
                $max = $max[0][0] ? $max[0][0] : 0;
            } else {
                $nid = $userList[0]['g_nid'] . UserModel::Like();
                $sql = "SELECT  max(g_distribution_limit), max(`g_distribution`) FROM `g_rank` WHERE `g_nid` like '{$nid}' LIMIT 1";
                $max = $db->query($sql, 0);
                $max = $max[0][1] ? $max[0][1] : 0;
            }
            if ($userList[0]['g_login_id'] == 22) {
                if ($s_next_ky > 99) exit(back('公司最低占成：1%'));
                $s_size_ky = $s_size_ky;
            }
            if ($s_next_ky < $max) {
                exit(back('回調占成率最小值：' . $max . '%'));
            }
            if ($userList[0]['g_lock'] != $lock) {
                $sql = "SELECT g_name, g_lock FROM g_rank WHERE g_nid LIKE '{$userList[0]['g_nid']}%' AND g_name <> '{$userList[0]['g_name']}' ";
                $result = $db->query($sql, 1);
                upDateRankLock($db, $result, 'g_lock', $lock);
                $sql = "SELECT g_name, g_look FROM g_user WHERE g_nid LIKE '{$userList[0]['g_nid']}%' ";
                $results = $db->query($sql, 1);
                upDateRankLock($db, $results, 'g_look', $lock, 1);
            }

            $sql = "UPDATE g_rank SET
			`g_password`='{$s_Pwd}',
			`g_f_name`='{$s_F_Name}',
			`g_money`='{$s_money}',
			`g_distribution`='{$s_next_ky}',
			`g_distribution_limit`='{$s_size_ky}',
			`g_Immediate_lock`='{$s_a_lock}',
			`g_Immediate2_lock`='{$s_b_lock}',
			`g_lock`='{$lock}' " . $g_pwd . "
			WHERE g_name = '{$name}' LIMIT 1";
            $db->query($sql, 2);

            if ($userList[0]['g_f_name'] != $s_F_Name) {
                $valueList = array();
                $valueList['g_name'] = $userList[0]['g_name'];
                $valueList['g_f_name'] = $_SESSION['sName'];
                $valueList['g_initial_value'] = $userList[0]['g_f_name'];
                $valueList['g_up_value'] = $s_F_Name;
                $valueList['g_up_type'] = '名稱';
                $valueList['g_s_id'] = 1;
                insertLogValue($valueList);
            }

            if ($s_money != $userList[0]['g_money']) {
                $valueList = array();
                $valueList['g_name'] = $userList[0]['g_name'];
                $valueList['g_f_name'] = $_SESSION['sName'];
                $valueList['g_initial_value'] = $userList[0]['g_money'];
                $valueList['g_up_value'] = $s_money;
                $valueList['g_up_type'] = '信用額';
                $valueList['g_s_id'] = 1;
                insertLogValue($valueList);
            }

            if ($s_next_ky != $userList[0]['g_distribution']) {
                $valueList = array();
                $valueList['g_name'] = $userList[0]['g_name'];
                $valueList['g_f_name'] = $_SESSION['sName'];
                $valueList['g_initial_value'] = $userList[0]['g_distribution'] . '%';
                $valueList['g_up_value'] = $s_next_ky . '%';
                $valueList['g_up_type'] = '下級占成';
                $valueList['g_s_id'] = 1;
                insertLogValue($valueList);
            }

            if ($s_size_ky != $userList[0]['g_distribution_limit']) {
                $valueList = array();
                $valueList['g_name'] = $userList[0]['g_name'];
                $valueList['g_f_name'] = $_SESSION['sName'];
                $valueList['g_initial_value'] = $userList[0]['g_login_id'] == 22 ? (100 - $userList[0]['g_distribution_limit']) . '%' : $userList[0]['g_distribution_limit'] . '%';
                $valueList['g_up_value'] = $userList[0]['g_login_id'] == 22 ? (100 - $s_size_ky) . '%' : $s_size_ky . '%';
                $valueList['g_up_type'] = '上級占成';
                $valueList['g_s_id'] = 1;
                insertLogValue($valueList);
            }

            //end of 用户信息修改

            //start 退水修改
            update_MR($_GET['cid']);
            exit(alert_href('更變成功！', 'Actfor.php?cid=' . $cid));
        }

    } else {
        exit(alert_href('無法讀取帳號信息！', 'Actfor.php?cid=' . $cid));
    }

    exit('POST');
} else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cid']) && isset($_GET['uid'])) {
    if (!Matchs::isString($_GET['uid'], 3, 15)) exit(alert_href('用戶名不合法', 'Actfor.php?cid=' . $_GET['cid']));
    $uid = $_GET['uid'];
    $cid = $_GET['cid'];
    if ($cid == 5 ) {
        $userList = $userModel->GetMemberModel($uid);
    } else {
        $userList = $userModel->GetUserModel(null, $uid);

    }
    if ($userList) {
        $Rank = $userModel->GetLoginIdByString($userList[0]['g_login_id']);
        $Lnid = mb_substr($userList[0]['g_nid'], 0, mb_strlen($userList[0]['g_nid']) - 32);
        $Luser = $userModel->GetUserName_Like($Lnid);
        $LRank = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
        //得到當前用戶可用額
        if ($userList[0]['g_login_id'] == 48) {
            $validMoney = validMoney($userModel, $userList[0]['g_money'], $userList[0]['g_nid'], true);
        } else {
            $validMoney = validMoney($userModel, $userList[0]['g_money'], $userList[0]['g_nid'] . UserModel::Like(), false);
        }
        //get mr  by 2b
        $dateTime = date('Y-m-d H:i:s');
        $a = day();
        $stratGame = $a[0];
        $endGame = $a[1];
        $date = " `g_date` > '{$stratGame}' AND `g_date` < '{$endGame}' ";
        $db = new DB();
        //TODO:这里是干什么的
        if (!$db->query("SELECT g_id FROM g_zhudan WHERE {$date} AND g_s_nid LIKE '{$userList[0]['g_nid']}%' LIMIT 1", 0)) {
            $count = 0;
        } else {
            $count = 1;
        }
        $count = 1;//by wjl

        //讀取退水
        //这里显示不出来是因为数据库和会员名字对不上需要给更改数据库
        if ($cid == 5) {
            $detModel = new Detailed();
            $result = $userModel->GetUserMR($uid, true);
            $dets = $detModel->GetDetailedsAll($uid);
            //if (!$dets) $result = array();
        } else {
            $result = $userModel->GetUserMR($uid);
        }
        //获取上级信息
        $top_info = array();
        $top_info = $userModel->get_upper($userList[0]['g_nid']);
        $top_info['rank'] = $userModel->Get_rank_from_name($top_info['g_name']);//获取该等级的名称

        if (!$result) exit(alert_href('無法讀取退水設置！請于上級聯繫', "Actfor.php?cid={$cid}"));
    } else {
        exit(alert_href('無法讀取用戶信息！', 'Actfor.php?cid=' . $cid));
    }
}
else {
    exit(href('quit.php'));
}
function update_MR($cid)
{
    echo "enter update_MR";
    global $_POST;
    $uModel = new UserModel();
    $name = $_POST['name'];
    if ($cid == 5) {
        $usersModel = $uModel->GetMemberModel($name);
    } else {
        $usersModel = $uModel->GetUserModel(null, $name);
    }
    if ($usersModel) {
        $Lname = mb_substr($usersModel[0]['g_nid'], 0, mb_strlen($usersModel[0]['g_nid']) - 32);
        $Lname = $uModel->GetUserName_Like($Lname); //返回查询出来的用户信息
        $db = new DB();
        if ($usersModel[0]['g_login_id'] == 56) { //如果被操作用户为分公司，则将类赋给$Lname，否则宣告权限不足
            $Lname = $usersModel;
        } else {
            if ($Lname[0]['g_lock'] != 1) {
                exit(back('更變權限不足！'));
            }
        }
        $sList = array(0 => 0, 1 => 0, 2 => 0);
        $LdetList = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id`
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' ORDER BY g_id DESC", 0); //获取退水表
        for ($i = 0; $i < count($LdetList); $i++) {
            if (!isset($_POST['a'.($i)])) {
                continue;
            }
            $aList = 100 - $_POST['a' . ($i)]; //A盘退水
            $bList = 100 - $_POST['b' . ($i)]; //B盘退水
            $cList = 100 - $_POST['c' . ($i)]; //C盘退水
            $dList = $_POST['d' . ($i)]; //单注
            $eList = $_POST['e' . ($i)]; //单期

            if (!Matchs::isFloating($aList) || !Matchs::isFloating($bList) || !Matchs::isFloating($cList) || !Matchs::isFloating($dList) || !Matchs::isFloating($eList))
                exit(back('輸入的數值錯誤！' . $i));
            if ($usersModel[0]['g_login_id'] != 56) {
                if ($aList < $LdetList[$i][3] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][3] . '---' . (100)));
                if ($bList < $LdetList[$i][4] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][4] . '---' . (100)));
                if ($cList < $LdetList[$i][5] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][5] . '---' . (100)));
                if ($dList > $LdetList[$i][6] || $dList < 0) exit(back($LdetList[$i][2] . ' 最高單註限額設置為：' . $LdetList[$i][6] . '---' . (0)));
                if ($eList > $LdetList[$i][7] || $eList < 0) exit(back($LdetList[$i][2] . ' 最高單期限額設置為：' . $LdetList[$i][7] . '---' . (0)));
            }
            if ($aList > $LdetList[$i][3]) {
                //取A盘
                $LdetList[$i][3] = $aList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'a', $aList);
            }
            if ($bList > $LdetList[$i][4]) {
                //取B盘
                $LdetList[$i][4] = $bList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'b', $bList);
            }
            if ($cList > $LdetList[$i][5]) {
                //取C盘
                $LdetList[$i][5] = $cList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'c', $cList);
            }

            //修改退水
            $sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList[$i][2]}' AND g_game_id = '{$LdetList[$i][8]}' LIMIT 1";
            $db->query($sql, 2);
        }
        //print_r($LdetList);
        //exit;
        //exit(alert_href('更變成功', 'Actfor.php?cid='.$_GET['cid']));
    } else {
        exit(alert_href('用戶不存在', 'Actfor.php?cid=' . $_GET['cid']));
    }
}

function validMoney($userModel, $countMoney, $nid, $param)
{
    $validMoney = $countMoney - $userModel->SumMoney($nid, $param);
    return $validMoney;
}

function upDateRankLock($db, $result, $lock, $p=0){
    if ($p==1){
        $from = "g_user";
        $l = "g_look";
    } else {
        $from = "g_rank";
        $l = "g_lock";
    }
    for ($i=0; $i<count($result); $i++){
        $db->query("UPDATE `{$from}` SET `{$l}` = '{$lock}' WHERE g_name = '{$result[$i]['g_name']}' ",2);
    }
}

function get_array_by_id($result,$game_id)
{
    $ret_array = array();
    for ($i=0; $i<count($result); $i++) {
        if ($result[$i]['g_game_id'] == $game_id) {
            $ret_array[] =  $result[$i];
        }
    }
    return $ret_array;
}

$sort_array_klc =
    array('第一球'=>'1~8单码',
        '任選二'=>'',
        '正码'=>'正码',
        '選二連組'=>'',
        '1-8單雙'=>'1~8两面',
/*        '1-8大小'=>'1-8 大小',
        '1-8尾數大小'=>'1-8 尾大尾小',
        '1-8合數單雙'=>'',*/
        '任選三'=>'',
        '總和單雙'=>'总和两面',
/*        '總和大小'=>'',
        '總和尾數大小'=>'总和尾大尾小',*/
        '選三前組'=>'',
        '1-8中發白'=>'1~8中发白',
        '任選四'=>'',
        '1-8方位'=>'1~8方位',
        '任選五'=>'',
        '龍虎'=>'1~4龙虎',
    );
$sort_array_ssc =
    array('第一球'=>'1~5单码',
        '顺子'=>'',
        '總和單雙'=>'两面',
        '对子'=>'',
        '龍虎'=>'龙虎',
        '半顺'=>'',
        '和'=>'',
        '杂六'=>'',
        '豹子'=>'',
    );
$sort_array_pk10 =
    array('冠军'=>'冠亚,3~10单码',
        '1-10大小'=>'1~10两面',
        '1-5龍虎'=>'1~5龙虎',
        '冠亞和大小'=>'冠亚大小',
        '冠亞和單雙'=>'冠亚单双',
        '冠、亞軍和'=>'冠亚和',
    );
$sort_array_nc =
    array('第一球'=>'1~8单码',
        '任选二'=>'',
        '正码'=>'正码',
        '选二连直'=>'',
        '1-8單雙'=>'1~8两面',
        '选二连组'=>'' ,
        '總和單雙'=>'总和两面',
        '任选三'=>'',
        '1-8中發白'=>'1~8中发白',
        '选三前组'=>'',
        '1-8梅兰菊竹'=>'1~8东南西北',
        '任选四'=>'',
        '家禽野兽'=>'1~4龙虎',
        '任选五'=>''
    );
$sort_array_sb =
    array('三軍大小'=>'大小',
        '點數'=>'',
        '三軍'=>'',
        '長牌'=>'',
        '圍骰'=>'',
        '短牌'=>'',
        '全骰'=>''
    );

$klc_array = get_array_by_id($result,1);
$ssc_array = get_array_by_id($result,2);
$pk10_array = get_array_by_id($result,6);
$nc_array = get_array_by_id($result,5);
$jstb_array = get_array_by_id($result,9);

//var_dump($result);
$klc_array = reset_per_info($klc_array,$sort_array_klc);
$ssc_array = reset_per_info($ssc_array,$sort_array_ssc);
$pk10_array = reset_per_info($pk10_array,$sort_array_pk10);
$nc_array = reset_per_info($nc_array,$sort_array_nc);
$jstb_array = reset_per_info($jstb_array,$sort_array_sb);

$color_array = array(
    '1~8单码'=>'bBlue',
    '正码'=>'bBlue',
    '1~5单码'=>'bBlue',
    '冠亚,3~10单码'=>'bBlue',
    '大小'=>'bBlue',
    '三军'=>'bBlue',

    '1~8两面'=>'bZise',
    '总和两面'=>'bZise',
    '1~4龙虎'=>'bZise',
    '两面'=>'bZise',
    '龙虎'=>'bZise',
    '和'=>'bZise',
    '1~10两面'=>'bZise',
    '1~5龙虎'=>'bZise',
    '冠亚大小'=>'bZise',
    '冠亚单双'=>'bZise',

    '1~8中发白'=>'bRed',
    '1~8方位'=>'bRed',
    '豹子'=>'bRed',
    '顺子'=>'bRed',
    '对子'=>'bRed',
    '半顺'=>'bRed',
    '杂六'=>'bRed',
    '冠亚和'=>'bRed',
    '1~8东南西北'=>'bRed',
    '点数'=>'bRed',

    '任选二'=>'bGreen',
    '选二连组'=>'bGreen',
    '选二连直'=>'bGreen',
    '任选三'=>'bGreen',
    '选三前组'=>'bGreen',
    '任选四'=>'bGreen',
    '任选五'=>'bGreen',
    '围骰'=>'bGreen',
    '全骰'=>'bGreen',
    '长牌'=>'bGreen',
    '短牌'=>'bGreen',
);


$lang = new utf8_lang();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/Manage/temp/js/common.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var win_height = window.innerHeight;
            $("#layout").css('height',win_height+'px');

        });
    </script>
    <script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height:358px;">


    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
        <div id="member" class="member">
            <div class="title">
    <span id="account_name">修改<?php echo $userModel->Get_rank_from_name($userList[0]['g_f_name']) ?><?php echo $userList[0]['g_f_name'] ?>
            </span>上级<span id="superior"><?php echo $top_info['rank'].$top_info['g_name'] ?></span><a href="Actfor.php?cid=<?php echo $cid ?>"
                                                                                                      id="reback" level="1"
                                                                                                      class="mag-btn1">返回</a></div>
            <form method="post" action="Manage_Up.php?cid=<?php echo $cid?>&uid=<?php echo $uid?>">
                <table class="clear-table base-info">
                    <caption>
                        <div>基本资料</div>
                    </caption>
                    <tbody>
                    <tr>
                        <th>名称</th>
                        <td><input autocomplete="off" name="s_F_Name" type="text" vname="name"
                                   vmessage="由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"
                                   value="<?php echo $userList[0]['g_f_name'] ?>"></td>
                        <th>账号</th>
                        <td><input autocomplete="off" name="name" type="text" vname="account" readonly
                                   vmessage="账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线！" value="<?php echo $userList[0]['g_name'] ?>" class="">
                        </td>
                        <th>密码</th>
                        <td><input autocomplete="off" name="s_Pwd" type="password" vname="password"
                                   vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
                        <th>确认密码</th>
                        <td class="error-info"><input autocomplete="off" name="repassword" type="password"
                                                      vname="repassword" vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
                    </tr>
                    <?php
                    if ($cid == 5) {
                        include_once "./account_edit_interface_memenber.php";
                    } else {
                        include_once "./account_edit_interface_user.php";
                    }
                    ?>
                    </tbody>
                </table>
                <table class="general_info games_info" id="general_info"><!-- 快速设置-->
                    <tbody id="general ">
                    <tr>
                        <td class="game-flag" colspan="8">
                            <div>大项快速设置（注意：设置高于上级最高限制时按最高可调）??</div>
                            <p class="reder game-tip">*占成、退水修改后，第二天新开期才能生效。下级会员当日没下注注单，修改占成、退水即时生效！</p></td>
                    </tr>
                    <tr class="games_head">
                        <td width="400px">调整项目</td>
                        <td>单注最低</td>
                        <td>单注最高</td>
                        <td>单项最高</td>
                        <td>A盘(%)</td>
                        <td>B盘(%)</td>
                        <td>C盘(%)</td>
                        <td>操作</td>
                    </tr>
                    <tr>
                        <th>单码项（1~8单码、1~5单码、冠亚，3~10单码...）</th>
                        <td><span class="playColor bBlue">&nbsp;</span>
                            <input name="general00" vname="general_bBlue_ordermin" autocomplete="off" maxlength="9" type="text"
                                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
                        <td><input name="general00" vname="general_bBlue_ordermax" autocomplete="off" maxlength="9" type="text"
                                   value="20000"></td>
                        <td><input name="general00" vname="general_bBlue_itemmax" autocomplete="off" maxlength="9" type="text"
                                   value="50000"></td>
                        <td>
                            <div class="spaning">
                                <input name="general00" value="0.6" vname="general_bBlue_A" type="text"
                                       minvalue="0" maxvalue="100"
                                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>

                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="1.6" vname="general_bBlue_B" type="text"
                                                        minvalue="0" maxvalue="100"
                                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="2.6" vname="general_bBlue_C" type="text"
                                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <button id="bBlue" type="button" onclick="change_input_by_color($(this))">修改</button>
                        </td>
                    </tr>
                    <tr>
                        <th>两面项（1~8两面，1~10两面、龙虎、三军…）</th>
                        <td><span class="playColor bZise">&nbsp;</span>
                            <input name="general00" vname="general_bZise_ordermin" autocomplete="off" maxlength="9" type="text"
                                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
                        <td><input name="general00" vname="general_bZise_ordermax" autocomplete="off" maxlength="9" type="text"
                                   value="20000"></td>
                        <td><input name="general00" vname="general_bZise_itemmax" autocomplete="off" maxlength="9" type="text"
                                   value="50000"></td>
                        <td>
                            <div class="spaning"><input name="general00" value="0.6" vname="general_bZise_A" type="text"
                                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                <a href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="1.6" vname="general_bZise_B" type="text"
                                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                <a href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="2.6" vname="general_bZise_C" type="text"
                                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <button id="bZise" type="button" onclick="change_input_by_color($(this))">修改</button>
                        </td>
                    </tr>
                    <tr>
                        <th>连码项（任选二、任选三、围骰、长牌…）</th>
                        <td><span class="playColor bGreen">&nbsp;</span>
                            <input name="general00" vname="general_bGreen_ordermin" autocomplete="off" maxlength="9" type="text"
                                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
                        <td><input name="general00" vname="general_bGreen_ordermax" autocomplete="off" maxlength="9" type="text"
                                   value="20000"></td>
                        <td><input name="general00" vname="general_bGreen_itemmax" autocomplete="off" maxlength="9" type="text"
                                   value="50000"></td>
                        <td>
                            <div class="spaning"><input name="general00" value="0.6" vname="general_bGreen_A" type="text"
                                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="1.6" vname="general_bGreen_B" type="text"
                                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="2.6" vname="general_bGreen_C" type="text"
                                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <button id="bGreen" type="button" onclick="change_input_by_color($(this))">修改</button>
                        </td>
                    </tr>
                    <tr>
                        <th>杂项（方位、豹子、冠亚和、点数…）</th>
                        <td><span class="playColor bRed">&nbsp;</span>
                            <input name="general00" vname="general_bRed_ordermin" autocomplete="off" maxlength="9" type="text"
                                   style="margin-top:4px;_margin-top:2px;_" value="2"></td>
                        <td><input name="general00" vname="general_bRed_ordermax" autocomplete="off" maxlength="9" type="text"
                                   value="20000"></td>
                        <td><input name="general00" vname="general_bRed_itemmax" autocomplete="off" maxlength="9" type="text"
                                   value="50000"></td>
                        <td>
                            <div class="spaning"><input name="general00" value="0.6" vname="general_bRed_A" type="text"
                                    <?php if (strstr($P,'A')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="1.6" vname="general_bRed_B" type="text"
                                    <?php if (strstr($P,'B')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <div class="spaning"><input name="general00" value="2.6" vname="general_bRed_C" type="text"
                                    <?php if (strstr($P,'C')=='') echo 'readonly="readonly" disabled="disabled"' ?>>
                                <a href="javascript:void(0)" name="up"></a><a
                                    href="javascript:void(0)" class="down" name="down"></a></div>
                        </td>
                        <td>
                            <button id="bRed" type="button" onclick="change_input_by_color($(this))">修改</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="games_info" id="games_info"><!-- 广东快乐十分 -->
                    <?php
                    $type_name = '广东快乐十分';
                    $sub_array = $klc_array;
                    include './account_inter_face.php'
                    ?>
                    <?php
                    $type_name = '重庆时时彩';
                    $sub_array = $ssc_array;
                    include './account_inter_face.php'
                    ?>
                    <?php
                    $type_name = '北京赛车';
                    $sub_array = $pk10_array;
                    include './account_inter_face.php'
                    ?>
                    <?php
                    $type_name = '幸运农场';
                    $sub_array = $nc_array;
                    include './account_inter_face.php'
                    ?>
                    <?php
                    $type_name = '江苏骰宝';
                    $sub_array = $jstb_array;
                    include './account_inter_face.php'
                    ?>
                    <!-- 重庆时时彩 -->
                </table>
                <div class="btn-line"><input type="submit" class="yellow-btn" id="submit"  value="确定" />
                    <input
                        type="reset" class="white-btn" id="reset" /></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
