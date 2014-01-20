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



class Zhudan {

    public $game = '';//广东快乐十分
    public $type = '';//总和单双、任选二
    public $detail = '';//单、双
    public $detail1 = '';//以下为时时彩专用
/*    public $detail2;
    public $detail3;*/

    public $date;//下注日期

    public $data = array();

    public function findNextProperty($property = NULL) {
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
        return array('depth'=>$depth, 'property'=>$find);
    }


    public static function getZhudan($start_date,$end_date,$balance,$number,$type,$user_nid)
    {
        $db = new DB();
        $condition_date = '';
        $condition_balance = '';
        $condition_number ='';
        $condition_type = '';
        $zhudan_array = array();

        if ($start_date != ''
            && $end_date != '') {
            $start_date .= '2:00';
            $end_date = dayMorning($end_date, (60 * 60 * 24)) . ' 02:00';
            $condition_date = "and g_date>'{$start_date}' and g_date <'{$end_date}'";
        }

        if ($balance == '1') {
            $condition_balance = "and `g_win` is not null";
        } else {
            $condition_balance = "and `g_win` is null";
        }

        if ($number != '') {
            $condition_number = "and `g_qishu`='{$number}";
        }
        if ($type != '') {
            $condition_type = "and `g_type`='{$type}'";
        }

        if ($user_nid == '') {
            return null;
        }


        $sql_str = "select * from g_zhudan where g_s_nid like '{$user_nid}%' $condition_balance $condition_date $condition_number $condition_type";
        $zhudan_array = $db->query($sql_str,1);
        $zhudan_array = Zhudan::zhudan_translation($zhudan_array);

        return $zhudan_array;
    }

    private static function zhudan_translation($zhudan_array)
    {
        $result = array();
        $lang = new utf8_lang();
        for ($i=0;$i<count($zhudan_array);$i++) {
            $tmp = $zhudan_array[$i];
            $zhudan_obj = new Zhudan();

            $zhudan_obj->game = Zhudan::$zhudan_game_array[$tmp['g_type']];

            $date = explode(' ',$tmp['g_date']);
            $zhudan_obj->date = $date[0];

            foreach ($tmp as $key=>$value) {
                $tmp[$key] = $lang->hk_cn($value);
            }
            switch ($zhudan_obj->game) {
                case '广东快乐十分':
                    $zhudan_obj = Zhudan::get_type_klc($zhudan_obj,$tmp['g_mingxi_1'],$tmp['g_mingxi_2']);
                    break;
                case '重庆时时彩':
                    $zhudan_obj = Zhudan::get_type_ssc($zhudan_obj,$tmp['g_mingxi_1'],$tmp['g_mingxi_2']);
                    break;
                case '北京赛车':
                    $zhudan_obj = Zhudan::get_type_pk10($zhudan_obj,$tmp['g_mingxi_1'],$tmp['g_mingxi_2']);
                    break;
                case '幸运农场':
                    $zhudan_obj = Zhudan::get_type_nc($zhudan_obj,$tmp['g_mingxi_1'],$tmp['g_mingxi_2']);
                    break;
                case '江苏骰宝':
                    $zhudan_obj = Zhudan::get_type_jstb($zhudan_obj,$tmp['g_mingxi_1'],$tmp['g_mingxi_2']);
                    break;

            }

            $zhudan_obj->data = Zhudan::zhudan_calculate($tmp);

            //$zhudan_obj->data = $tmp;
            $result[] = $zhudan_obj;
        }

        return $result;
    }

    private static function negtive($val) {
        return (0-$val);
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
        $ret = Zhudan::calculate_each_rank(1,$ret,$zhudan);
        return $ret;
    }

    private static function calculate_each_rank($cid,$ret,$zhudan) {

        if ($cid == 5) {
            //会员金额:退水前输赢
            $ret[5]['jiangjin'] = $zhudan['g_win'];
            //会员退水百分比
            $ret[5]['tuishui_per'] = 100 - $zhudan['g_tueishui'];
            //会员退水
            $ret[5]['tuishui'] = $ret['zhue'] * ($ret[5]['tuishui_per']/100);
            //取整佣金
            $ret[5]['yongjin'] = floor($ret[5]['tuishui']);

            //会员盈亏
            $ret[5]['yingkui'] = $ret[5]['jiangjin'] + $ret[5]['yongjin'];
        } else {
            $ret = Zhudan::calculate_each_rank($cid+1,$ret,$zhudan);

            if ($cid != 4) {
                $ret[$cid]['dis'] = $zhudan['g_distribution_'.(4-$cid)];
            } else {
                $ret[$cid]['dis'] = $zhudan['g_distribution'];
            }
            $ret[$cid]['tuishui_per'] = 100 - $zhudan['g_tueishui_'.(5-$cid)];
            $ret[$cid]['dis_money'] = ($ret[$cid]['dis'] / 100) * $ret['zhue'];
            $ret[$cid]['jiangjin'] = Zhudan::negtive(($ret[$cid]['dis'] / 100) * $ret[5]['jiangjin']);
            $ret[$cid]['tuishui'] = $ret[$cid]['dis_money'] * ($ret[$cid]['tuishui_per']/100);
            $ret[$cid]['yongjin'] = floor($ret[$cid]['tuishui']);
            $ret[$cid]['yongjincha'] = $ret[$cid+1]['tuishui'] - $ret[$cid+1]['yongjin'];
            $ret[$cid]['yingkui'] = $ret[$cid]['jiangjin'] + $ret[$cid]['yongjin'] + $ret[$cid]['yongjincha'];
        }
        return $ret;
    }

    private static function get_type_klc($zhudan_obj,$mingxi_1,$mingxi_2)
    {
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
                    $zhudan_obj->type = $mingxi_1;
                    $zhudan_obj->detail = $mingxi_2;
                } elseif (strstr($mingxi_2,'合数')) {
                    $zhudan_obj->type = '1~8 和数';
                    $zhudan_obj->detail = $mingxi_2=='合数单'?'单':'双';
                } elseif (strstr($mingxi_2,'尾')) {
                    $zhudan_obj->type = '1~8 尾大尾小';
                    $zhudan_obj->detail = $mingxi_2=='尾大'?'大':'小';
                } elseif ($mingxi_2 == '单' || $mingxi_2 == '双') {
                    $zhudan_obj->type = '1~8 单双';
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 =='大' || $mingxi_2 == '小') {
                    $zhudan_obj->type = '1~8 大小';
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 == '龙' || $mingxi_2 == '虎') {
                    $zhudan_obj->type = '1~8 龙虎';
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 == '东'
                    ||$mingxi_2 == '南'
                    || $mingxi_2 == '西'
                    ||$mingxi_2 == '北') {
                    $zhudan_obj->type = '1~8 方位';
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 == '中'
                    ||$mingxi_2 == '发'
                    ||$mingxi_2 == '白') {
                    $zhudan_obj->type = '1~8 中发白';
                    $zhudan_obj->detail = $mingxi_2;
                }
                break;
            case '总和、龙虎':
                switch ($mingxi_2) {
                    case '总和大':
                    case '总和小':
                        $zhudan_obj->type = '总和大小';
                        break;
                    case '总和单':
                    case '总和双':
                        $zhudan_obj->type = '总和单双';
                        break;
                    case '总和尾大':
                    case '总和尾小':
                        $zhudan_obj->type ='总和尾大尾小';
                        break;

                }
                $zhudan_obj->detail = substr($mingxi_2,6);//预期为大小
                break;
            case '正码':
                switch ($mingxi_2) {
                    case '总和大':
                    case '总和小':
                        $zhudan_obj->type = '总和大小';
                        $zhudan_obj->detail = substr($mingxi_2,6);//预期为大小
                        break;
                    case '总和单':
                    case '总和双':
                        $zhudan_obj->type = '总和单双';
                        $zhudan_obj->detail = substr($mingxi_2,6);//预期为大小
                        break;
                    case '总和尾大':
                    case '总和尾小':
                        $zhudan_obj->type ='总和尾大尾小';
                        $zhudan_obj->detail = substr($mingxi_2,6);//预期为大小
                        break;
                    default:
                        $zhudan_obj->type = '正码';
                        $zhudan_obj->detail = $mingxi_2;
                }
                break;
            default:
                $zhudan_obj->type= $mingxi_1;
                $zhudan_obj->detail = '';
        }
        return $zhudan_obj;
    }
    private static function get_type_ssc($zhudan_obj,$mingxi_1,$mingxi_2)
    {
        switch ($mingxi_1) {
            case '第一球':
            case '第二球':
            case '第三球':
            case '第四球':
            case '第五球':
                if (is_int($mingxi_2)) {
                    $zhudan_obj->type = '单码';
                    $zhudan_obj->detail = $mingxi_1;
                    $zhudan_obj->detail1 =$mingxi_2;
                } else {
                    $zhudan_obj->type = '两面';
                    $zhudan_obj->detail = $mingxi_1;
                    $zhudan_obj->detail1 =$mingxi_2;
                }
                break;
            case '总和龙虎':
                if ($mingxi_2 == '和') {
                    $zhudan_obj->type = '和';
                } elseif ($mingxi_2 == '龙' || $mingxi_2 == '虎'){
                    $zhudan_obj->type = '龙虎';
                    $zhudan_obj->detail = $mingxi_2;
                    $zhudan_obj->detail1= $mingxi_2;
                } else {
                    $zhudan_obj->type = '两面';
                    $zhudan_obj->detail = '两面 总和';
                    $zhudan_obj->detail1 = '总和 '.substr($mingxi_2,6);
                }
                break;
            case '前三':
            case '中三':
            case '后三':
                $zhudan_obj->type = $mingxi_2;
                $zhudan_obj->detail = $mingxi_2.' '.$mingxi_1;
        }

        return $zhudan_obj;
    }
    private static function get_type_pk10($zhudan_obj,$mingxi_1,$mingxi_2)
    {
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
                    $zhudan_obj->type = $mingxi_1;
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 == '单' || $mingxi_2 == '双') {
                    $zhudan_obj->type = '单双';
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 =='大' || $mingxi_2 == '小') {
                    $zhudan_obj->type = '大小';
                    $zhudan_obj->detail = $mingxi_2;
                } elseif ($mingxi_2 == '龙' || $mingxi_2 == '虎') {
                    $zhudan_obj->type = '龙虎';
                    $zhudan_obj->detail = $mingxi_2;
                }
                break;
            case '冠亚和':
                switch ($mingxi_2) {
                    case '冠亚和大':
                    case '冠亚和小':
                        $zhudan_obj->type = '冠亚大小';
                        $zhudan_obj->detail = substr($mingxi_2,9);//预期为大小
                        break;
                    case '冠亚和单':
                    case '冠亚和双':
                        $zhudan_obj->type = '冠亚单双';
                        $zhudan_obj->detail = substr($mingxi_2,9);//预期为大小
                        break;
                }
                break;
            case '冠、亚军和':
                $zhudan_obj->type = '冠亚和';
                $zhudan_obj->detail = $mingxi_2;
                break;
        }
        return $zhudan_obj;
    }
    private static function get_type_nc($zhudan_obj,$mingxi_1,$mingxi_2)
    {
        return Zhudan::get_type_klc($zhudan_obj,$mingxi_1,$mingxi_2);
    }
    private static function get_type_jstb($zhudan_obj,$mingxi_1,$mingxi_2)
    {
        $zhudan_obj->type = $mingxi_1;
        $zhudan_obj->detail = $mingxi_2;
        return $zhudan_obj;
    }


    private static $zhudan_game_array = array(
        '江苏骰寶(快3)'=>'江苏骰宝',
        '北京赛车PK10'=>'北京赛车',
        '廣東快樂十分'=>'广东快乐十分',
        '重慶時時彩'=>'重庆时时彩',
        '幸运农场'=>'幸运农场'
    );

}









