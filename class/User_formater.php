<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-11
 * Time: 下午10:46
 */
if (!defined('ROOT_PATH'))
    exit('invalid request');

include_once './UserModel.php';
include_once './DB.php';
include_once ROOT_PATH . 'function/parameter.php';
include_once ROOT_PATH . 'Class/zhudan.php';

Class ReportUser
{
    public $parent = NULL;
    public $cid;
    public $my_account_id;
    public $top_account_id;
    public $rank_name; //阶层名称：如会员、代理，总代理等
    public $my_name;
    public $password;
    public $account_money;
    public $panlu;
    public $status;
    public $buhuo; //补货设定
    public $my_distribution;
    public $upper_distribution;
    public $buhuo_dis; //补货是否占城
    public $beishu; //倍数投注

    protected $db;
    protected $userModel;
    protected $nid = ''; //辨识编码
    protected $data_get = 0;
    protected $login_id;
    protected $db_format_tuishui; //数据库格式退水

    function __construct($my_account_id, $cid, $top_account_id = "")
    {
        $this->cid = $cid;
        $this->my_account_id = $my_account_id;
        $this->top_account_id = $top_account_id;
        $this->db = new DB();
      //  $this->userModel = new UserModel();
    }
    public function get_userinfo_by_account($cid, $account_id)
    {
        $result = array();
        $sql_str = "";
        if ($cid == 5) {
            $sql_str = "select * from `g_user` where g_name='{$account_id}'";
        } else {
            $sql_str = "select * from `g_rank` where g_name='{$account_id}'";
        }
        $result = $this->db->query($sql_str, 1);
        return $result;
    }

    protected function set_info($my_info)
    {
        if ($this->cid == 5) {
            $this->my_name = $my_info['g_f_name'];
            $this->password = '';
            $this->account_money = $my_info['g_money'];
            $this->panlu = $my_info['g_panlu'];
            $this->status = $my_info['g_look'];
            $this->buhuo = 1;
            $this->my_distribution = NULL;
            $this->upper_distribution = $my_info['g_distribution'];
            $this->buhuodis = 1;
            $this->beishu = 1;
        } else {
            $this->my_name = $my_info['g_f_name'];
            $this->password = '';
            $this->account_money = $my_info['g_money'];
            $this->panlu = $my_info['g_panlu'];
            $this->status = $my_info['g_lock'];
            $this->buhuo = $my_info['g_immediate_lock'];
            $this->my_distribution = $my_info['g_distribution'];
            $this->upper_distribution = $my_info['g_distribution_limit'];
            $this->buhuodis = 1;
            $this->beishu = 1;
        }
        $this->nid = $my_info['g_nid'];
    }
    public function get_from_db()
    {
        //防止重复获取
        if ($this->data_get == 1) {
            return;
        }

        $my_info = $this->get_userinfo_by_account($this->cid, $this->my_account_id);
        $this->set_info($my_info[0]);
        switch ($this->cid) {
            case '5':
                $this->rank_name = '会员';
                break;
            case '4':
                $this->rank_name = '代理';
                break;
            case '3':
                $this->rank_name = '总代理';
                break;
            case '2':
                $this->rank_name = '股东';
                break;
            case '1':
                $this->rank_name = '分公司';
                break;

        }

        $this->data_get = 1;
    }
}

class User_info extends ReportUser
{


    public $klc_array = array();
    public $ssc_array = array();
    public $pk10_array = array();
    public $nc_array = array();
    public $jstb_array = array();
    public $color_array = array(
        '1~8单码' => 'bBlue',
        '正码' => 'bBlue',
        '1~5单码' => 'bBlue',
        '冠亚,3~10单码' => 'bBlue',
        '大小' => 'bBlue',
        '三军' => 'bBlue',

        '1~8两面' => 'bZise',
        '总和两面' => 'bZise',
        '1~4龙虎' => 'bZise',
        '两面' => 'bZise',
        '龙虎' => 'bZise',
        '和' => 'bZise',
        '1~10两面' => 'bZise',
        '1~5龙虎' => 'bZise',
        '冠亚大小' => 'bZise',
        '冠亚单双' => 'bZise',

        '1~8中发白' => 'bRed',
        '1~8方位' => 'bRed',
        '豹子' => 'bRed',
        '顺子' => 'bRed',
        '对子' => 'bRed',
        '半顺' => 'bRed',
        '杂六' => 'bRed',
        '冠亚和' => 'bRed',
        '1~8东南西北' => 'bRed',
        '点数' => 'bRed',

        '任选二' => 'bGreen',
        '选二连组' => 'bGreen',
        '选二连直' => 'bGreen',
        '任选三' => 'bGreen',
        '选三前组' => 'bGreen',
        '任选四' => 'bGreen',
        '任选五' => 'bGreen',
        '围骰' => 'bGreen',
        '全骰' => 'bGreen',
        '长牌' => 'bGreen',
        '短牌' => 'bGreen',
    );

    static $cid_rank_array = array(
        0 => '后台',
        1 => '分公司',
        2 => '股东',
        3 => '总代',
        4 => '代理',
        5 => '会员'
    );


    private $sort_array_klc =
        array('第一球' => '1~8单码',
            '任選二' => '',
            '正码' => '正码',
            '選二連組' => '',
            '1-8單雙' => '1~8两面',
            /*        '1-8大小'=>'1-8 大小',
                    '1-8尾數大小'=>'1-8 尾大尾小',
                    '1-8合數單雙'=>'',*/
            '任選三' => '',
            '總和單雙' => '总和两面',
            /*        '總和大小'=>'',
                    '總和尾數大小'=>'总和尾大尾小',*/
            '選三前組' => '',
            '1-8中發白' => '1~8中发白',
            '任選四' => '',
            '1-8方位' => '1~8方位',
            '任選五' => '',
            '龍虎' => '1~4龙虎',
        );
    private $sort_array_ssc =
        array('第一球' => '1~5单码',
            '顺子' => '',
            '總和單雙' => '两面',
            '对子' => '',
            '龍虎' => '龙虎',
            '半顺' => '',
            '和' => '',
            '杂六' => '',
            '豹子' => '',
        );
    private $sort_array_pk10 =
        array('冠军' => '冠亚,3~10单码',
            '1-10大小' => '1~10两面',
            '1-5龍虎' => '1~5龙虎',
            '冠亞和大小' => '冠亚大小',
            '冠亞和單雙' => '冠亚单双',
            '冠、亞軍和' => '冠亚和',
        );
    private $sort_array_nc =
        array('第一球' => '1~8单码',
            '任选二' => '',
            '正码' => '正码',
            '选二连直' => '',
            '1-8單雙' => '1~8两面',
            '选二连组' => '',
            '總和單雙' => '总和两面',
            '任选三' => '',
            '1-8中發白' => '1~8中发白',
            '选三前组' => '',
            '1-8梅兰菊竹' => '1~8东南西北',
            '任选四' => '',
            '家禽野兽' => '1~4龙虎',
            '任选五' => ''
        );
    private $sort_array_sb =
        array('三軍大小' => '大小',
            '點數' => '',
            '三軍' => '',
            '長牌' => '',
            '圍骰' => '',
            '短牌' => '',
            '全骰' => ''
        );


    private function get_array_by_id($result, $game_id)
    {
        $ret_array = array();
        for ($i = 0; $i < count($result); $i++) {
            if ($result[$i]['g_game_id'] == $game_id) {
                $ret_array[] = $result[$i];
            }
        }
        return $ret_array;
    }

    private function set_tuishui($tuishui)
    {
        $klc_array = $this->get_array_by_id($tuishui, 1);
        $ssc_array = $this->get_array_by_id($tuishui, 2);
        $pk10_array = $this->get_array_by_id($tuishui, 6);
        $nc_array = $this->get_array_by_id($tuishui, 5);
        $jstb_array = $this->get_array_by_id($tuishui, 9);

        $this->klc_array = reset_per_info($klc_array, $this->sort_array_klc);
        $this->ssc_array = reset_per_info($ssc_array, $this->sort_array_ssc);
        $this->pk10_array = reset_per_info($pk10_array, $this->sort_array_pk10);
        $this->nc_array = reset_per_info($nc_array, $this->sort_array_nc);
        $this->jstb_array = reset_per_info($jstb_array, $this->sort_array_sb);
    }






    function __construct($my_account_id, $cid, $top_account_id = "")
    {
        /*
        $this->clear_me();
        $this->cid = $cid;
        $this->my_account_id = $my_account_id;
        $this->top_account_id = $top_account_id;
        $this->db = new DB();*/
        $this->userModel = new UserModel();

        parent::__construct($my_account_id, $cid, $top_account_id);
    }

    private function get_tuishui($account_id, $cid)
    {
        $ret = array();
        if ($cid == 5) {
            $tuishui = $this->userModel->GetUserMR($account_id, true);
            $ret = $tuishui;
        } else {
            $tuishui = $this->userModel->GetUserMR($account_id);
            for ($i = 0; $i < count($tuishui); $i++) {
                $tmp['g_type'] = $tuishui[$i]['g_type'];
                $tmp['g_panlu_a'] = $tuishui[$i]['g_a_limit'];
                $tmp['g_panlu_b'] = $tuishui[$i]['g_b_limit'];
                $tmp['g_panlu_c'] = $tuishui[$i]['g_c_limit'];
                $tmp['g_danzhu_min'] = $tuishui[$i]['g_danzhu_min'];
                $tmp['g_danzhu'] = $tuishui[$i]['g_d_limit'];
                $tmp['g_danxiang'] = $tuishui[$i]['g_e_limit'];
                $tmp['g_game_id'] = $tuishui[$i]['g_game_id'];
                $ret[] = $tmp;
            }
        }
        return $ret;
    }

    private function clear_me()
    {
        //全空初始化
        /*        foreach ($this as $key=>$value) {
                    $this->$key = '';
                }*/

    }

    public function get_from_db()
    {
        //防止重复获取
        if ($this->data_get == 1) {
            return;
        }

        if ($this->my_account_id == '') { //获取父级退水，盘路
            $tuishui = $this->get_tuishui($this->top_account_id, 4);
            $this->set_tuishui($tuishui);
            $parent_info = $this->get_userinfo_by_account(4, $this->top_account_id);
            $this->panlu = $parent_info[0]['g_panlu']; //新会员盘路跟随父级
        } else {
            $tuishui = $this->get_tuishui($this->my_account_id, $this->cid);
            $this->set_tuishui($tuishui);
            $my_info = $this->get_userinfo_by_account($this->cid, $this->my_account_id);
            $this->set_info($my_info[0]);
        }
        switch ($this->cid) {
            case '5':
                $this->rank_name = '会员';
                break;
            case '4':
                $this->rank_name = '代理';
                break;
            case '3':
                $this->rank_name = '总代理';
                break;
            case '2':
                $this->rank_name = '股东';
                break;
            case '1':
                $this->rank_name = '分公司';
                break;

        }

        $this->data_get = 1;
    }

    public function force_get_from_db()
    {
        $this->data_get = 0;
        $this->get_from_db();
    }

    //单纯的录入数据
    private function data_entry($array)
    {
        $this->my_name = $array['my_name'];
        $this->my_account_id = $array['my_account_id'];
        $this->password = $array['password'];
        $this->account_money = $array['account_money'];
        $this->panlu = $array['panlu'];
        $this->status = $array['status'];
        $this->buhuo = $array['buhuo'];
        $this->buhuo_dis = $array['buhuo_dis'];
        $this->upper_distribution = $array['upper_distribution'];
        $this->my_distribution = $array['my_distribution'];
        $this->beishu = $array['beishu'];
        $this->klc_array = $array['1'];
        $this->ssc_array = $array['2'];
        $this->pk10_array = $array['6'];
        $this->nc_array = $array['5'];
        $this->jstb_array = $array['9'];
    }

    private function general_data_into_array()
    {
        if ($this->cid == 5) {
            $insert_array['g_name'] = $this->my_account_id;
            $insert_array['g_f_name'] = $this->my_name;
            //普通会员和直属会员的区别
            if ($this->password != '') {
                $insert_array['g_password'] = $this->password;
            }
            $insert_array['g_money'] = $this->account_money;
            $insert_array['g_money_yes'] = $this->account_money;
            $insert_array['g_distribution'] = $this->upper_distribution;
            $insert_array['g_panlu'] = $this->panlu;
            $insert_array['g_look'] = $this->status;
            $insert_array['g_panlus'] = $this->panlu . '.';
        } else {
            $insert_array['g_name'] = $this->my_account_id;
            $insert_array['g_f_name'] = $this->my_name;
            if ($this->password != '') {
                $insert_array['g_password'] = $this->password;
            }
            $insert_array['g_money'] = $this->account_money;
            //占成诠释不同
            $insert_array['g_distribution'] = $this->my_distribution;
            $insert_array['g_distribution_limit'] = $this->upper_distribution;
            $insert_array['g_panlu'] = $this->panlu;
            $insert_array['g_lock'] = $this->status;
            //补货限制
            $insert_array['g_Immediate_lock'] = $this->buhuo;

        }
        return $insert_array;

    }

    private function proccess_befor_add()
    {
        $top_info = $this->userModel->GetUserModel(null, $this->top_account_id);
        $top_nid = $top_info[0]['g_nid'];
        $top_login_id = $top_info[0]['g_login_id'];
        if ($this->cid == 5) {
            $this->cid = $top_nid;
        } else {
            $this->nid = $top_nid . md5(uniqid(time(), true));
        }
        switch ($this->cid) {
            case 5:
                $this->login_id = $top_login_id == $this->userModel->agent_id ? 9 : $top_login_id;
                break;
            case 4:
                $this->login_id = $this->userModel->agent_id;
                break;
            case 3:
                $this->login_id = $this->userModel->maina_id;
                break;
            case 2:
                $this->login_id = $this->userModel->stock_id;
                break;
            case 1:
                $this->login_id = $this->userModel->cop_id;
                break;

        }
    }

    private function insert_into_db()
    {
        //先生成自己的nid login_id等值
        $this->proccess_befor_add();
        //转化为数组
        $insert_array = $this->general_data_into_array();
        $sql_str = '';
        //新增特有的东西
        if ($this->cid == 5) {
            $sql_str_from = 'g_user';

            //下面的为新增才需要的
            //todo:单号限额暂写死为10000
            $insert_array['g_nid'] = $this->nid;
            $insert_array['g_login_id'] = $this->login_id;
            //普通会员和直属会员的区别
            $insert_array['g_mumber_type'] = $this->login_id == 9 ? 1 : 2;
            $insert_array['g_xianer'] = 1000000;
            $insert_array['g_out'] = 0;
            $insert_array['g_uid'] = md5(uniqid(time(), true));
            /*            $insert_array['g_state'] = null;*/
            //todo:要测试下这玩意到底是不是初次登陆改密码的根据
            $insert_array['g_pwd'] = 1;
            $insert_array['g_ip'] = UserModel::GetIP();
            $insert_array['g_date'] = date("Y-m-d H:i:s");
            $insert_array['g_autofail'] = 0;
            $insert_array['g_autowin'] = 0;
        } else {
            $sql_str_from = 'g_rank';

            //下面为新增才需要的
            $insert_array['g_nid'] = $this->nid;
            $insert_array['g_login_id'] = $this->login_id;
            $insert_array['g_uid'] = md5(uniqid(time(), true));
            $insert_array['g_ip'] = UserModel::GetIP();
            $insert_array['g_date'] = date("Y-m-d H:i:s");
            //todo:要测试下这玩意到底是不是初次登陆改密码的根据
            $insert_array['g_pwd'] = 1;
        }
        $ret = $this->db_ops($insert_array, $sql_str_from, 'add');
        if ($ret <= 0) {
            return -1;
        }

        //插入退水信息
        $ret = $this->insert_tuishui();

        return $ret;
    }

    private function db_ops($data_array, $db_name, $action, $wheres = null)
    {
        //插入自己的信息
        $sql_str = '';
        if ($action == 'add') {
            $sql_str_keys = "(";
            $sql_str_values = "(";
            foreach ($data_array as $key => $value) {
                $sql_str_keys .= '`' . $key . '`';
                $sql_str_values .= "'" . $value . "'";
                $sql_str_keys .= ',';
                $sql_str_values .= ',';
            }
            $sql_str_keys = substr($sql_str_keys, 0, -1);
            $sql_str_values = substr($sql_str_values, 0, -1);
            $sql_str_values .= ')';
            $sql_str_keys .= ')';

            $sql_str = "insert into $db_name $sql_str_keys values $sql_str_values";
        } else if ($action == 'update' && $wheres != null) {
            $sql_str_data = '';
            foreach ($data_array as $key => $value) {
                if ($value === '' && $key === 'g_password')
                    continue;
                $sql_str_data .= '`' . $key . '`=' . "'" . $value . "'";
                $sql_str_data .= ',';
            }
            $sql_str_data = substr($sql_str_data, 0, -1);
            $sql_str = "update $db_name set $sql_str_data where $wheres";
        }
        $ret = $this->db->query($sql_str, 2);
        if ($action == 'update') {
            $ret = 1;
        }
        return $ret;
    }

    private function update_into_db()
    {
        //更新自己的信息
        //更新退水信息
        $insert_array = $this->general_data_into_array();
        if ($this->cid == 5) {
            $db_name = 'g_user';
        } else {
            $db_name = 'g_rank';
        }
        $db_where = "g_name ='" . $this->my_account_id . "'";
        $ret = $this->db_ops($insert_array, $db_name, 'update', $db_where);
        if ($ret <= 0) {
            echo 'db_ops erro';
            return -1;
        }
        $ret = $this->update_tuishui();
        return 1;
    }

    //@param $action 更新 or 新增
    public function set_from_array($array, $action = 'update')
    {
        $ret = 0;

        $this->data_entry($array);
        $this->data_process($action);

        if ($action == 'add') {
            $ret = $this->insert_into_db();
        } else {
            $ret = $this->update_into_db();
        }
        return $ret;
    }

    private function data_process($action)
    {
        if ($action == 'add' || $this->password !== '') {
            if (!Matchs::isString($this->password, 8, 20)) exit(back('密码输入有误'));
            $this->password = sha1($this->password);
        }

        $this->db_format_tuishui = $this->tuishui_data_process();
    }

    private function tuishui_data_process()
    {
        $klc_decode_array = array(
            '1~8单码' => array('第一球', '第二球', '第三球', '第四球', '第五球', '第六球', '第七球', '第八球'),
            '正码' => array('正码'),
            '1~8两面' => array('1-8單雙', '1-8大小', '1-8尾數大小', '1-8合數單雙'),
            '总和两面' => array('總和單雙', '總和大小', '總和尾數大小'),
            '1~8中发白' => array('1-8中發白'),
            '1~8方位' => array('1-8方位'),
            '1~4龙虎' => array('龍虎'),
            '任选二' => array('任選二'),
            '任选三' => array('任選三'),
            '选二连组' => array('選二連組'),
            '选三前组' => array('選三前組'),
            '任选四' => array('任選四'),
            '任选五' => array('任選五'),
        );
        $ssc_decode_array = array(
            '1~5单码' => array('第一球', '第二球', '第三球', '第四球', '第五球'),
            '龙虎' => array('龍虎'),
            '顺子' => array('顺子'),
            '两面' => array('總和單雙', '總和大小', '1-5單雙', '1-5大小'),
            '对子' => array('对子'),
            '半顺' => array('半顺'),
            '和' => array('和'),
            '杂六' => array('杂六'),
            '豹子' => array('豹子'),
        );
        $pk10_decode_array = array(
            '冠亚,3~10单码' => array('冠军', '亚军', '第三名', '第四名', '第五名', '第六名', '第七名',
                '第八名', '第九名', '第十名'),
            '1~10两面' => array('1-10單雙', '1-10大小'),
            '1~5龙虎' => array('1-5龍虎'),
            '冠亚大小' => array('冠亞和大小'),
            '冠亚单双' => array('冠亞和單雙'),
            '冠亚和' => array('冠、亞軍和'),
        );
        $nc_decode_array = array(
            '1~8单码' => array('第一球', '第二球', '第三球', '第四球', '第五球', '第六球', '第七球', '第八球'),
            '正码' => array('正码'),
            '1~8两面' => array('1-8單雙', '1-8大小', '1-8尾數大小', '1-8合數單雙'),
            '总和两面' => array('總和單雙', '總和大小', '總和尾數大小'),
            '1~8中发白' => array('1-8中發白'),
            '1~8方位' => array('1-8梅兰菊竹'),
            '1~4龙虎' => array('家禽野兽'),
            '任选二' => array('任選二'),
            '任选三' => array('任選三'),
            '选二连组' => array('選二連組'),
            '选二连直' => array('选二连直'),
            '选三前组' => array('選三前組'),
            '任选四' => array('任選四'),
            '任选五' => array('任選五'),
        );
        $jstb_decode_array = array(
            '大小' => array('三軍大小'),
            '点数' => array('點數'),
            '三军' => array('三軍'),
            '长牌' => array('長牌'),
            '围骰' => array('圍骰'),
            '短牌' => array('短牌'),
            '全骰' => array('全骰')
        );
        $decoded_array = array();
        $klc_array = $this->sub_type_decode($this->klc_array, $klc_decode_array);
        $klc_array['game_id'] = 1;
        $decoded_array[] = $klc_array;
        $ssc_array = $this->sub_type_decode($this->ssc_array, $ssc_decode_array);
        $ssc_array['game_id'] = 2;
        $decoded_array[] = $ssc_array;
        $pk10_array = $this->sub_type_decode($this->pk10_array, $pk10_decode_array);
        $pk10_array['game_id'] = 6;
        $decoded_array[] = $pk10_array;
        $nc_array = $this->sub_type_decode($this->nc_array, $nc_decode_array);
        $nc_array['game_id'] = 5;
        $decoded_array[] = $nc_array;
        $jstb_array = $this->sub_type_decode($this->jstb_array, $jstb_decode_array);
        $jstb_array['game_id'] = 9;
        $decoded_array[] = $jstb_array;
        return $decoded_array;

        /*    var_dump($decoded_array);
            exit;*/

        //update_tuishui($decoded_array,$user_name,$user_rank);
    }

//@parame $result 大项分类后的数组，如时时彩的数组
    private function sub_type_decode($result, $index_array)
    {
        $ret = array();
        foreach ($result as $key => $sub_array) {
            for ($i = 0; $i < count($index_array[$key]); $i++) {
                $real_typename = $index_array[$key][$i];
                $result[$key]['type'] = $real_typename;
                $ret[] = $result[$key];
            }
        }
        return $ret;
    }

    private function update_tuishui()
    {
        $db = $this->db;
        $array = $this->db_format_tuishui;
        $user_rank = $this->cid;
        $user_name = $this->my_account_id;
        $sql_str = '';
        for ($i = 0; $i < count($array); $i++) {
            $game_id = $array[$i]['game_id'];
            //var_dump($array[$i]);
            //echo (count($array[$i],1));
            unset($array[$i]['game_id']);
            for ($j = 0; $j < count($array[$i]); $j++) {
                if ($user_rank == 5) {
                    $panlu_a = isset($array[$i][$j]['panlu_a']) ? '`g_panlu_a`=' . (100 - $array[$i][$j]['panlu_a']) . ',' : '';
                    $panlu_b = isset($array[$i][$j]['panlu_b']) ? '`g_panlu_b`=' . (100 - $array[$i][$j]['panlu_b']) . ',' : '';
                    $panlu_c = isset($array[$i][$j]['panlu_c']) ? '`g_panlu_c`=' . (100 - $array[$i][$j]['panlu_c']) . ',' : '';
                } else {
                    $panlu_a = isset($array[$i][$j]['panlu_a']) ? '`g_a_limit`=' . (100 - $array[$i][$j]['panlu_a']) . ',' : '';
                    $panlu_b = isset($array[$i][$j]['panlu_b']) ? '`g_b_limit`=' . (100 - $array[$i][$j]['panlu_b']) . ',' : '';
                    $panlu_c = isset($array[$i][$j]['panlu_c']) ? '`g_c_limit`=' . (100 - $array[$i][$j]['panlu_c']) . ',' : '';
                }
                $danzhu_min = $array[$i][$j]['danzhu_min'];
                $danzhu_max = $array[$i][$j]['danzhu_max'];
                $danxiang_max = $array[$i][$j]['danxiang_max'];
                $type_name = $array[$i][$j]['type'];
                /*            echo $panlu_a;
                            echo ' ';
                            echo $panlu_a;
                            echo ' ';
                            echo $panlu_b;
                            echo ' ';
                            echo $panlu_c;
                            echo ' ';
                            echo $danzhu_min;
                            echo ' ';
                            echo $danzhu_max;
                            echo ' ';
                            echo $danxiang_max;*/
                //var_dump($array[$i][$j]);

                if ($user_rank == 5) {

                    $sql_str = "update g_panbiao set
                $panlu_a
                $panlu_b
                $panlu_c
                `g_danzhu_min`='{$danzhu_min}',
                `g_danzhu`='{$danzhu_max}',
                `g_danxiang`='{$danxiang_max}'
                WHERE g_nid = '{$user_name}' and g_game_id='{$game_id}' and g_type='{$type_name}' LIMIT 1";
                } else {
                    $sql_str = "UPDATE `g_send_back` SET
                            $panlu_a
                            $panlu_b
                            $panlu_c
                            `g_danzhu_min`='{$danzhu_min}',
                            `g_d_limit` = '{$danzhu_max}',
                            `g_e_limit` = '{$danxiang_max}'
                        WHERE `g_name` = '{$user_name}'
                        AND g_type = '{$type_name}'
                        AND g_game_id = '{$game_id}' LIMIT 1";
                }

                /*            echo $sql_str;
                            echo '</br>';*/
                if ($db->query($sql_str, 2) == -1) {
                    return -1;
                }
            }
        }

    }

    private function insert_tuishui()
    {
        $insert_array = array();
        $array = $this->db_format_tuishui;
        for ($i = 0; $i < count($array); $i++) {

            $game_id = $array[$i]['game_id'];
            unset($array[$i]['game_id']);

            if ($this->cid == 5) {
                $db_name = 'g_panbiao';
                for ($j = 0; $j < count($array[$i]); $j++) {
                    $insert_array['g_panlu_a'] = isset($array[$i][$j]['panlu_a']) ? (100 - $array[$i][$j]['panlu_a']) : 'NULL';
                    $insert_array['g_panlu_b'] = isset($array[$i][$j]['panlu_b']) ? (100 - $array[$i][$j]['panlu_b']) : 'NULL';
                    $insert_array['g_panlu_c'] = isset($array[$i][$j]['panlu_c']) ? (100 - $array[$i][$j]['panlu_c']) : 'NULL';
                    $insert_array['g_danzhu_min'] = $array[$i][$j]['danzhu_min'];
                    $insert_array['g_danzhu'] = $array[$i][$j]['danzhu_max'];
                    $insert_array['g_danxiang'] = $array[$i][$j]['danxiang_max'];
                    $insert_array['g_nid'] = $this->my_account_id;
                    $insert_array['g_type'] = $array[$i][$j]['type'];
                    $insert_array['g_game_id'] = $game_id;

                    $ret = $this->db_ops($insert_array, $db_name, 'add');
                    if ($ret == -1) {
                        return $ret;
                    }
                }
            } else {
                $db_name = 'g_send_back';
                for ($j = 0; $j < count($array[$i]); $j++) {
                    $insert_array['g_a_limit'] = isset($array[$i][$j]['panlu_a']) ? (100 - $array[$i][$j]['panlu_a']) : 'NULL';
                    $insert_array['g_b_limit'] = isset($array[$i][$j]['panlu_b']) ? (100 - $array[$i][$j]['panlu_b']) : 'NULL';
                    $insert_array['g_c_limit'] = isset($array[$i][$j]['panlu_c']) ? (100 - $array[$i][$j]['panlu_c']) : 'NULL';
                    $insert_array['g_danzhu_min'] = $array[$i][$j]['danzhu_min'];
                    $insert_array['g_d_limit'] = $array[$i][$j]['danzhu_max'];
                    $insert_array['g_e_limit'] = $array[$i][$j]['danxiang_max'];
                    $insert_array['g_name'] = $this->my_account_id;
                    $insert_array['g_type'] = $array[$i][$j]['type'];
                    $insert_array['g_game_id'] = $game_id;

                    $ret = $this->db_ops($insert_array, $db_name, 'add');
                    if ($ret == -1) {
                        return $ret;
                    }
                }
            }
        }

        return 1;
    }


//获取下级总额
    public function get_son_money()
    {

        $top_nid = $this->nid;
        $cid = $this->cid;
        $ret = 0;
        if ($cid == 5) {
            return 0;
        }

        if ($cid == 4) {
            $sql_str = "select sum(g_money) as money from g_user where g_nid like '{$top_nid}'";
            $db = new DB();

            $result = $db->query($sql_str, 1);
            $ret += $result[0]['money'];
        }

        $sql_str = "select sum(g_money) as money from g_user where g_nid like '{$top_nid}'";
        $db = new DB();

        $result = $db->query($sql_str, 1);
        $ret += $result[0]['money'];

        $db = new DB();

        $top_nid .= UserModel::Like();
        $sql_str = "select sum(g_money) as money from g_rank where g_nid like '{$top_nid}'";
        $result = $db->query($sql_str, 1);

        $ret += $result[0]['money'];

        return $ret;
    }
}

