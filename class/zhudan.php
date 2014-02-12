<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-19
 * Time: 下午2:07
 */

define('Copyright', '作者QQ:1834219632');
//define('ROOT_PATH', '/Users/kevin/Documents/workspace/kevincen'.'/');

include_once 'DB.php';
include_once 'User_formater.php';
include_once 'Lang.php';


class Zhudan
{

    public $game = ''; //广东快乐十分
    public $type = ''; //总和单双、任选二
    public $detail = ''; //单、双
    /*    public $detail2;
        public $detail3;*/

    public $date = ''; //下注日期

    public $data = array();

    function __construct()
    {
        $this->data = array(
            'zhue' => 0,
            'zhushu' => 0,
            1 => array(),
            2 => array(),
            3 => array(),
            4 => array(),
            5 => array(),
        );
    }

    public function sum($zhudan)
    {
        $outer_data = $zhudan->data;
        $this->data['zhue'] += $outer_data['zhue'];
        $this->data['zhushu'] += $outer_data['zhushu'];
        for ($i = 1; $i <= 5; $i++) {
            foreach ($outer_data[$i] as $key => $value) {
                if ($key != 'dis'
                    && $key != 'tuishui_per'
                ) {
                    $this->data[$i][$key] += $value;
                } else {
                    $this->data[$i][$key] = $value;
                }

            }
        }
    }

    public function findNextProperty($property = NULL)
    {
        $find = NULL;
        $depth = -1;
        if ($property == 'total') {
            $depth = 0;
            $find = 'game';
        } else {
            foreach ($this as $key => $value) {
                $depth++;
                if ($key == $property && $find == NULL) {
                    $find = $key;
                    continue;
                } else if ($find != NULL) {
                    $find = $key;
                    break;
                }
            }
        }
        return array('depth' => $depth, 'property' => $find);
    }

    //user_nid为空时，为精确查找
    //$account_id 为空时，为子孙查找
    public static function getZhudan($start_date, $end_date, $balance, $number, $type, $user_nid,$account_id='')
    {
/*        echo 'balance='.$balance.'<br/>';
        echo 'number='.$number.'<br/>';
        echo 'type='.$type.'<br/>';
        echo 'user_nid='.$user_nid.'<br/>';
        echo 'account_id='.$account_id.'<br/>';*/
        $db = new DB();
        $condition_date = '';
        $condition_balance = '';
        $condition_number = '';
        $condition_type = '';
        $zhudan_array = array();

        if ($start_date != ''
            && $end_date != ''
        ) {
            $start_date .= ' 02:00';
            $end_date = dayMorning($end_date, (60 * 60 * 24)) . ' 02:00';
            $condition_date = "and g_date>'{$start_date}' and g_date <'{$end_date}'";
        }

        if ($balance == '1') {
            $condition_balance = "and `g_win` is not null";
        } else {
            $condition_balance = "and `g_win` is null";
        }

        if ($number != '' && $number != 'all') {
            $condition_number = "and `g_qishu`='{$number}'";
        }
        if ($type != 0) {
            switch ($type) {
                case 1:
                    $type = '廣東快樂十分';
                    break;
                case 2:
                    $type = '重慶時時彩';
                    break;
                case 6:
                    $type = '北京赛车PK10';
                    break;
                case 5:
                    $type = '幸运农场';
                    break;
                case 9:
                    $type = '江苏骰寶(快3)';
                    break;
            }
            $condition_type = "and `g_type`='{$type}'";
        }


        if ($account_id != '') {//精确查找
            $sql_str = "select * from g_zhudan where g_nid ='{$account_id}' $condition_balance $condition_date $condition_number $condition_type";
        } else {//子孙查找
            $sql_str = "select * from g_zhudan where g_s_nid like '{$user_nid}%' $condition_balance $condition_date $condition_number $condition_type";
        }

/*        echo $sql_str;
        echo '<br/>';*/

        $zhudan_array = $db->query($sql_str, 1);
        $zhudan_array = Zhudan::zhudan_translation($zhudan_array, $user_nid);
        //print_r($zhudan_array);
        return $zhudan_array;
    }

    private static function zhudan_translation($zhudan_array, $user_nid)
    {
        $result = array();
        $lang = new utf8_lang();
        for ($i = 0; $i < count($zhudan_array); $i++) {
            $tmp = $zhudan_array[$i];
            $zhudan_obj = new Zhudan();

            $zhudan_obj->game = Zhudan::$zhudan_game_array[$tmp['g_type']];

            $date = explode(' ', $tmp['g_date']);
            $zhudan_obj->date = $date[0];

            foreach ($tmp as $key => $value) {
                $tmp[$key] = $lang->hk_cn($value);
            }
            switch ($zhudan_obj->game) {
                case '广东快乐十分':
                    $zhudan_obj = Zhudan::get_type_klc($zhudan_obj, $tmp['g_mingxi_1'], $tmp['g_mingxi_2']);
                    break;
                case '重庆时时彩':
                    $zhudan_obj = Zhudan::get_type_ssc($zhudan_obj, $tmp['g_mingxi_1'], $tmp['g_mingxi_2']);
                    break;
                case '北京赛车':
                    $zhudan_obj = Zhudan::get_type_pk10($zhudan_obj, $tmp['g_mingxi_1'], $tmp['g_mingxi_2']);
                    break;
                case '幸运农场':
                    $zhudan_obj = Zhudan::get_type_nc($zhudan_obj, $tmp['g_mingxi_1'], $tmp['g_mingxi_2']);
                    break;
                case '江苏骰宝':
                    $zhudan_obj = Zhudan::get_type_jstb($zhudan_obj, $tmp['g_mingxi_1'], $tmp['g_mingxi_2']);
                    break;

            }

            $zhudan_obj->data = Zhudan::zhudan_calculate($tmp);

            $zhudan_obj->data['username'] = $tmp['g_nid'];
            $zhudan_obj->data['id'] = $tmp['g_id'];
            $zhudan_obj->data['time'] = $tmp['g_date'];
            $zhudan_obj->data['qishu'] = substr($tmp['g_qishu'], -2);
            $zhudan_obj->data['odds'] =  $tmp['g_odds'];
            if (strstr($tmp['g_mingxi_1'],'选')) {
                if ($tmp['g_mingxi_1'] == '选二连直') {
                    $ball_array = explode('|',$tmp['g_mingxi_2']);
                    $front = $ball_array[0];
                    $end = $ball_array[1];

                    $zhudan_obj->data['type'] = $zhudan_obj->type . ' 前位 '.$front. ' 后位'.$end;
                } else {
                    $zhudan_obj->data['type'] = $zhudan_obj->type . $tmp['g_mingxi_2'];
                }
                $zhudan_obj->data['type'] = str_replace('、',',',$zhudan_obj->data['type']);
            } else {
                $zhudan_obj->data['type'] = $zhudan_obj->detail;
            }
                //TODO:
            $zhudan_obj->data['panlu'] = 'A';
            $zhudan_obj->data['is_zhishu'] = 0;

            if (strlen($tmp['g_s_nid']) - strlen($user_nid) < 32) {
                $zhudan_obj->data['is_zhishu'] = 1;
                $zhudan_obj->type .= '.会员';
                if ($zhudan_obj->detail != '') {
                    $zhudan_obj->detail .= '.会员';
                }
            }




            //$zhudan_obj->data = $tmp;
            $result[] = $zhudan_obj;
        }

        return $result;
    }

    private static function negtive($val)
    {
        return (0 - $val);
    }

    private static function zhudan_calculate($zhudan)
    {
        $ret = array();

        if ($zhudan['g_mingxi_1_str'] == '') {
            $ret['zhushu'] = 1;
        } else {
            $ret['zhushu'] = $zhudan['g_mingxi_1_str'];
        }

        $ret['zhue'] = $ret['zhushu'] * $zhudan['g_jiner'];

        //从分公司一直算到最后
        $ret = Zhudan::calculate_each_rank(1, $ret, $zhudan);
        return $ret;
    }


    private static function calculate_each_rank($cid, $ret, $zhudan)
    {

        if ($cid == 5) {
            //会员金额:退水前输赢
            $ret[5]['jiangjin'] = $zhudan['g_win'];
            //会员退水百分比
            $ret[5]['tuishui_per'] = 100 - $zhudan['g_tueishui'];
            //会员退水
            $ret[5]['tuishui'] = $ret['zhue'] * ($ret[5]['tuishui_per'] / 100);
            //取整佣金
            $ret[5]['yongjin'] = intval($ret[5]['tuishui']);

            //会员盈亏
            $ret[5]['yingkui'] = $ret[5]['jiangjin'] + $ret[5]['yongjin'];
        } else {
            $ret = Zhudan::calculate_each_rank($cid + 1, $ret, $zhudan);

            if ($cid != 4) {
                $ret[$cid]['dis'] = $zhudan['g_distribution_' . (4 - $cid)];
            } else {
                $ret[$cid]['dis'] = $zhudan['g_distribution'];
            }
            $ret[$cid]['tuishui_per'] = 100 - $zhudan['g_tueishui_' . (5 - $cid)];
            $ret[$cid]['dis_money'] = ($ret[$cid]['dis'] / 100) * $ret['zhue'];
            $ret[$cid]['jiangjin'] = Zhudan::negtive(($ret[$cid]['dis'] / 100) * $ret[5]['jiangjin']);
            $ret[$cid]['tuishui'] = $ret[$cid]['dis_money'] * ($ret[$cid]['tuishui_per'] / 100);
            $ret[$cid]['yongjin'] = intval($ret[$cid]['tuishui']);
            $ret[$cid]['yongjincha'] = $ret[$cid + 1]['tuishui'] - $ret[$cid + 1]['yongjin'];
            $ret[$cid]['yingkui'] = $ret[$cid]['yongjincha']+$ret[$cid]['jiangjin']-$ret[$cid]['yongjin']  ;

            if ($cid == 4) {
                $ret[$cid]['up_dis_money'] = $ret['zhue'] - $ret[$cid]['dis_money'];
                $ret[$cid]['up_jine'] = Zhudan::negtive($ret[$cid + 1]['jiangjin'] + $ret[$cid]['jiangjin']);
                $ret[$cid]['up_yongjin'] = ($ret[$cid]['tuishui'] - $ret[$cid + 1]['tuishui']);
                $ret[$cid]['up_all'] = ($ret[$cid]['tuishui'] - $ret[$cid + 1]['tuishui'] + $ret[$cid]['up_jine']);
            } else {

                $ret[$cid]['down_dis_money'] = -$ret[$cid+1]['up_dis_money'];
                $ret[$cid]['down_jine'] = -$ret[$cid+1]['up_jine'];
                $ret[$cid]['down_yongjin'] = -$ret[$cid+1]['up_yongjin'];
                $ret[$cid]['down_shangjiao'] = -$ret[$cid]['up_all'];

                $ret[$cid]['up_dis_money'] = $ret[$cid]['down_dis_money'] - $ret[$cid]['dis_money'];
                $ret[$cid]['up_jine'] = -($ret[$cid]['down_jine'] + $ret[$cid]['jiangjin']);
                $ret[$cid]['up_yongjin'] = $ret[$cid]['tuishui'] - $ret[$cid]['up_yongjin'];
                $ret[$cid]['up_all'] = $ret[$cid]['up_yongjin'] + $ret[$cid]['up_jine'];
            }
        }
        return $ret;
    }

    private static function get_type_klc($zhudan_obj, $mingxi_1, $mingxi_2)
    {
        $zhudan_obj->game = '[' . $zhudan_obj->game . ']';
        switch ($mingxi_1) {
            case '第一球':
            case '第二球':
            case '第三球':
            case '第四球':
            case '第五球':
            case '第六球':
            case '第七球':
            case '第八球':
                if (is_int($mingxi_2)) {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1;
                    $zhudan_obj->detail = $zhudan_obj->type . ' ' . $mingxi_2;
                    $zhudan_obj->game .= $mingxi_1;
                } elseif (strstr($mingxi_2, '合数')) {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '合数单双';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~8 合数单双';
                } elseif (strstr($mingxi_2, '尾')) {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '尾大尾小';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~8 尾大尾小';
                } elseif ($mingxi_2 == '单' || $mingxi_2 == '双') {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '单双';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~8 单双';
                } elseif ($mingxi_2 == '大' || $mingxi_2 == '小') {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '大小';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~8 大小';
                } elseif ($mingxi_2 == '龙' || $mingxi_2 == '虎') {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . $mingxi_2;
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~4 龙虎';
                } elseif ($mingxi_2 == '东'
                    || $mingxi_2 == '南'
                    || $mingxi_2 == '西'
                    || $mingxi_2 == '北'
                ) {
                    $zhudan_obj->type = $zhudan_obj->game . '方位' . $mingxi_1;
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~8 方位';
                } elseif ($mingxi_2 == '中'
                    || $mingxi_2 == '发'
                    || $mingxi_2 == '白'
                ) {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '中发白';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '1~8 中发白';
                }
                break;
            case '总和、龙虎':
                switch ($mingxi_2) {
                    case '总和大':
                    case '总和小':
                        $zhudan_obj->type = $zhudan_obj->game . '总和大小';
                        $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                        $zhudan_obj->game .= '总和大小';
                        break;
                    case '总和单':
                    case '总和双':
                        $zhudan_obj->type = $zhudan_obj->game . '总和单双';
                        $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                        $zhudan_obj->game .= '总和单双';
                        break;
                    case '总和尾大':
                    case '总和尾小':
                        $zhudan_obj->type = $zhudan_obj->game . '总和尾大尾小';
                        $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                        $zhudan_obj->game .= '总和尾大尾小';
                        break;

                }
                break;
            case '正码':
                switch ($mingxi_2) {
                    case '总和大':
                    case '总和小':
                        $zhudan_obj->type = $zhudan_obj->game . '总和大小';
                        $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                        $zhudan_obj->game .= '总和大小';
                        break;
                    case '总和单':
                    case '总和双':
                        $zhudan_obj->type = $zhudan_obj->game . '总和单双';
                        $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                        $zhudan_obj->game .= '总和单双';
                        break;
                    case '总和尾大':
                    case '总和尾小':
                        $zhudan_obj->type = $zhudan_obj->game . '总和尾大尾小';
                        $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                        $zhudan_obj->game .= '总和尾大尾小';
                        break;
                    default:
                        $zhudan_obj->game .= '正码';
                        $zhudan_obj->type = $zhudan_obj->game;
                        $zhudan_obj->detail = $zhudan_obj->type . $mingxi_2;
                }
                break;
            default:
                $zhudan_obj->game = $zhudan_obj->game . $mingxi_1;
                $zhudan_obj->type = $zhudan_obj->game;
                $zhudan_obj->detail = '';
        }
        /*        $type = $zhudan_obj->type;
                $game = $zhudan_obj->game;
                $zhudan_obj->game = '['.$zhudan_obj->game .']'.$type;
                $zhudan_obj->type = '['.$game.']'.$type;
                $zhudan_obj->detail = '['.$game.']'.' ' .$zhudan_obj->detail;*/
        return $zhudan_obj;
    }

    private static function get_type_ssc($zhudan_obj, $mingxi_1, $mingxi_2)
    {
        $zhudan_obj->game = '[' . $zhudan_obj->game . ']';
        switch ($mingxi_1) {
            case '第一球':
            case '第二球':
            case '第三球':
            case '第四球':
            case '第五球':
                if (is_int($mingxi_2)) {
                    $zhudan_obj->type = $zhudan_obj->game . ' ' . $mingxi_1;
                    $zhudan_obj->detail = $zhudan_obj->type . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '单码';
                } else {
                    $zhudan_obj->type = $zhudan_obj->game . ' ' . $mingxi_1;
                    $zhudan_obj->detail = $zhudan_obj->type . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '两面';
                }
                break;
            case '总和龙虎':
                if ($mingxi_2 == '和') {
                    $zhudan_obj->game .= '和';
                    $zhudan_obj->type = $zhudan_obj->game;
                    $zhudan_obj->detail = $zhudan_obj->type;
                } elseif ($mingxi_2 == '龙' || $mingxi_2 == '虎') {
                    $zhudan_obj->type = $zhudan_obj->game . ' ' . $mingxi_2;
                    $zhudan_obj->detail = $zhudan_obj->type;
                    $zhudan_obj->game .= '龙虎';
                } else {
                    $zhudan_obj->type = $zhudan_obj->game . '两面 总和';
                    $zhudan_obj->detail = $zhudan_obj->game . '总和 ' . substr($mingxi_2, 6);
                    $zhudan_obj->game .= '两面';
                }
                break;
            case '前三':
            case '中三':
            case '后三':
                $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                $zhudan_obj->detail = $zhudan_obj->type;
                $zhudan_obj->game .= $mingxi_2;
                break;
        }
        return $zhudan_obj;
    }

    private static function get_type_pk10($zhudan_obj, $mingxi_1, $mingxi_2)
    {
        $zhudan_obj->game = '[' . $zhudan_obj->game . ']';
        switch ($mingxi_1) {
            case '冠军':
            case '亚军':
            case '第三名':
            case '第四名':
            case '第五名':
            case '第六名':
            case '第七名':
            case '第八名':
            case '第九名':
            case '第十名':
                if (is_int($mingxi_2)) {
                    $zhudan_obj->game .= $mingxi_1;
                    $zhudan_obj->type = $zhudan_obj->game;
                    $zhudan_obj->detail = $zhudan_obj->type . ' ' . $mingxi_2;
                } elseif ($mingxi_2 == '单' || $mingxi_2 == '双') {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '单双';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '单双';
                } elseif ($mingxi_2 == '大' || $mingxi_2 == '小') {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_1 . '大小';
                    $zhudan_obj->detail = $zhudan_obj->game . $mingxi_1 . ' ' . $mingxi_2;
                    $zhudan_obj->game .= '大小';
                } elseif ($mingxi_2 == '龙' || $mingxi_2 == '虎') {
                    $zhudan_obj->type = $zhudan_obj->game . $mingxi_2;
                    $zhudan_obj->detail = $zhudan_obj->type;
                    $zhudan_obj->game .= '龙虎';
                }
                break;
            case '冠亚和':
                switch ($mingxi_2) {
                    case '冠亚和大':
                    case '冠亚和小':
                        $zhudan_obj->type = $zhudan_obj->game . '冠亚大小';
                        $zhudan_obj->detail = $zhudan_obj->game . '冠亚 ' . substr($mingxi_2, 9); //预期为大小
                        $zhudan_obj->game = $zhudan_obj->type;
                        break;
                    case '冠亚和单':
                    case '冠亚和双':
                        $zhudan_obj->type = $zhudan_obj->game . '冠亚单双';
                        $zhudan_obj->detail = $zhudan_obj->game . '冠亚 ' . substr($mingxi_2, 9); //预期为大小
                        $zhudan_obj->game = $zhudan_obj->type;
                        break;
                }
                break;
            case '冠、亚军和':
                $zhudan_obj->game .= '冠亚和';
                $zhudan_obj->type = $zhudan_obj->game;
                $zhudan_obj->detail = $zhudan_obj->type . ' '. $mingxi_2;
                break;
        }
        return $zhudan_obj;
    }

    private static function get_type_nc($zhudan_obj, $mingxi_1, $mingxi_2)
    {
        return Zhudan::get_type_klc($zhudan_obj, $mingxi_1, $mingxi_2);
    }

    private static function get_type_jstb($zhudan_obj, $mingxi_1, $mingxi_2)
    {
        $zhudan_obj->game = '[' . $zhudan_obj->game . ']';

        $zhudan_obj->type = $zhudan_obj->game.$mingxi_1;
        $zhudan_obj->detail = $zhudan_obj->game .$mingxi_2;
        $zhudan_obj->game .= $zhudan_obj->type;
        return $zhudan_obj;
    }


    private static $zhudan_game_array = array(
        '江苏骰寶(快3)' => '江苏骰宝',
        '北京赛车PK10' => '北京赛车',
        '廣東快樂十分' => '广东快乐十分',
        '重慶時時彩' => '重庆时时彩',
        '幸运农场' => '幸运农场'
    );

}









