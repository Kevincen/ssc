<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-11
 * Time: 下午10:46
 */
if (!defined('ROOT_PATH'))
    exit('invalid request');

class Field
{
    public $name;
    public $value;
    public $max;
    public $min;
    public $vmessage;
}

class User_info
{
    public $cid;
    public $my_account_id;
    public $top_account_id;

    public $rank_name;//阶层名称：如会员、代理，总代理等
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
    public $klc_array = array();
    public $ssc_array = array();
    public $pk10_array = array();
    public $nc_array = array();
    public $jstb_array = array();
    public $color_array = array(
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


    private $db;
    private $userModel;
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

    private function get_array_by_id($result,$game_id) {
        $ret_array = array();
        for ($i=0; $i<count($result); $i++) {
            if ($result[$i]['g_game_id'] == $game_id) {
                $ret_array[] =  $result[$i];
            }
        }
        return $ret_array;
    }
    private function set_tuishui($tuishui)
    {
        $klc_array = $this->get_array_by_id($tuishui,1);
        $ssc_array = $this->get_array_by_id($tuishui,2);
        $pk10_array = $this->get_array_by_id($tuishui,6);
        $nc_array = $this->get_array_by_id($tuishui,5);
        $jstb_array = $this->get_array_by_id($tuishui,9);

        $this->klc_array = reset_per_info($klc_array,$this->sort_array_klc);
        $this->ssc_array = reset_per_info($ssc_array,$this->sort_array_ssc);
        $this->pk10_array = reset_per_info($pk10_array,$this->sort_array_pk10);
        $this->nc_array = reset_per_info($nc_array,$this->sort_array_nc);
        $this->jstb_array = reset_per_info($jstb_array,$this->sort_array_sb);
    }

    private function set_info($my_info)
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
    }

    public function get_userinfo_by_account($cid,$account_id)
    {
        $result = array();
        $sql_str = "";
        if ($cid == 5) {
            $sql_str = "select * from `g_user` where g_name='{$account_id}'";
        } else {
            $sql_str = "select * from `g_rank` where g_name='{$account_id}'";
        }
        $result = $this->db->query($sql_str,1);
        return $result;
    }


    function __construct($my_account_id, $cid, $top_account_id="")
    {
        $this->clear_me();
        $this->cid = $cid;
        $this->my_account_id = $my_account_id;
        $this->top_account_id = $top_account_id;
        $this->db = new DB();
        $this->userModel = new UserModel();
    }
    private function get_tuishui($account_id,$cid)
    {
        $ret = array();
        if ($cid == 5 ) {
            $tuishui = $this->userModel->GetUserMR($account_id,true);
            $ret = $tuishui;
        } else {
            $tuishui = $this->userModel->GetUserMR($account_id);
            for ($i=0;$i<count($tuishui);$i++) {
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
        if ($this->my_account_id == '') {//获取父级退水，盘路
            $tuishui = $this->get_tuishui($this->top_account_id,4);
            $this->set_tuishui($tuishui);
            $parent_info = $this->get_userinfo_by_account(4,$this->top_account_id);
            $this->panlu = $parent_info[0]['g_panlu'];//新会员盘路跟随父级
        } else {
            if ($this->cid == 5 ) {
                $tuishui = $this->userModel->GetUserMR($this->my_account_id,true);
            } else {
                $tuishui = $this->userModel->GetUserMR($this->my_account_id);
            }
            $this->set_tuishui($tuishui);
            $my_info = $this->get_userinfo_by_account($this->cid,$this->my_account_id);
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

    }
}