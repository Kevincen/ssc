<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-21
 * Time: 下午11:45
 */
include_once './UserModel.php';
include_once './DB.php';
include_once ROOT_PATH . 'function/parameter.php';
include_once ROOT_PATH . 'Class/zhudan.php';
include_once ROOT_PATH . 'Class/User_formater.php';
include_once ROOT_PATH . 'Class/ReportTypeTree.php';


class ReportMember extends ReportUser
{
    public $cid = 5;
    public $zhudan;
    public $zhudanArr;
    public $children;
    public $title = '';

    function __construct($my_account_id, $parent)
    {
        parent::__construct($my_account_id, 5);
        $this->parent = $parent;
        $this->zhudan = new Zhudan();
        $this->zhudanArr = array();
        $this->get_from_db();
    }

    public function get_user_zhudan($start_date, $end_date, $balance, $number, $type)
    {
        //$result = array();


        $this->zhudanArr = Zhudan::getZhudan($start_date, $end_date, $balance, $number, $type, '', $this->my_account_id);

        return $this->zhudanArr;
    }

    public function sumZhudan($zhudan)
    {
        $this->zhudan->sum($zhudan);
        if ($this->parent != NULL) {
            $this->parent->sumZhudan($zhudan);
        }
    }

    public function buildTree() {
        $child = new ReportTypeTree('detail','', $this);
        $child->buildTree($this->zhudanArr);
        $this->children = $child->children;
        foreach ($this->children as $child) {
            $child->parent = $this;
        }
        //$this->zhudan = $child->zhudan;
    }

}

class ReportProxy extends ReportUser
{
    //下级直属

    public $zhudan;

    protected $members = array();

    public $children = array();

    //public $direct_memenbers = array();

    function __construct($my_account_id, $cid, $parent = NULL)
    {
        parent::__construct($my_account_id, $cid);
        $this->parent = $parent;
        $this->zhudan = new Zhudan();
        $this->get_from_db();
    }

    //获取所有的下级会员名
    //@param type
    private function get_my_members($direct = false)
    {
        $ret = array();

        if ($this->nid === '') {
            $this->get_from_db();
        }

        $my_nid = $this->nid;
        if (!$direct) {
            $sql_str = "select g_name from g_user where g_nid like '{$my_nid}%' and g_mumber_type='1'";
        } else { //获取直属会员
            $my_nid .= UserModel::Like();
            $sql_str = "select g_name from g_user where g_nid like '{$my_nid}' and g_mumber_type='2'";
        }
        $member_name_array = $this->db->query($sql_str, 1);
        $ret = $member_name_array;

        return $ret;

    }

    //获得名下所有会员的注单总和
    //如果自己已经是会员则获取自己的注单数额
    //param 0为所有会员，1为直属会员
    public function get_member_zhudan($type = 0)
    {

        $members = $this->get_my_members($type);
        $sum_zhudan = array();

        for ($i = 0; $i < count($members); $i++) {
            $zhudan = $members[$i]->get_user_zhudan();
            //计算总和
            foreach ($zhudan as $key => $val) {
                $sum_zhudan[$key] += $zhudan[$key];
            }
        }
        return $sum_zhudan;

    }


    public function buildTree($start_date, $end_date, $balance, $number, $type)
    {
        //获取nid
        $next_nid = $this->nid . UserModel::Like();
        $db_name = $this->cid == 4 ? 'g_user' : 'g_rank';

        // 代理或者透明代理
        if ($this->cid == 4 || $this->cid == 0) {
            $members = $this->get_my_members($this->cid == 0);
            foreach ($members as $member) {
                $child = ReportFactory::CreateUser($member['g_name'],5, $this);
                //$this->children[] = $child;
                $child->get_user_zhudan($start_date, $end_date, $balance, $number, $type);
                if (count($child->zhudanArr) == 0) {
                    continue;
                }
                $this->children[] = $child;
                $child->buildTree();
                //foreach ($child->zhudanArr as $zhudan) {
                //    $child->sumZhudan($zhudan);
                //}
                //return $this;
            }

        } else {
            //获取下属
            $sql_str = "select g_name from $db_name where g_nid like '{$next_nid}'";
            $name_array = $this->db->query($sql_str, 1);
            for ($i = 0; $i < count($name_array); $i++) {
                $child = ReportFactory::CreateUser($name_array[$i]['g_name'], $this->cid + 1, $this);
                $child = $child->buildTree($start_date, $end_date, $balance, $number, $type, $this);
                if ($child != NULL) {
                    $this->children[] = $child;
                }
            }
            if ($this->cid != 4
                && count($this->get_my_members(true)) > 0
            ) {
                $child = ReportFactory::CreateUser($this->my_account_id, 0, $this, $this->my_name, $this->nid);
                $child = $child->buildTree($start_date, $end_date, $balance, $number, $type, $this);
                if ($child != NULL) {
                    $this->children[] = $child;
                }
            }

        }
        if (count($this->children) == 0) {
            return NULL;
        } else {
            return $this;
        }
    }

    public function sumZhudan($zhudan)
    {
        $this->zhudan->sum($zhudan);
        if ($this->parent != NULL) {
            $this->parent->sumZhudan($zhudan);
        }

    }

}


class TransparentReportProxy extends ReportProxy
{
    function __construct($account_id, $name, $nid, $parent)
    {
        $this->parent = $parent;
        $this->cid = 0;
        $this->nid = $nid;
        $this->my_account_id = $account_id.'.会员';
        $this->my_name = $name;
        $this->db = new DB();
        $this->zhudan = new Zhudan();
    }
}