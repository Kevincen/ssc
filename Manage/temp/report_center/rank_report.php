<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-16
 * Time: 上午12:51
 */

include_once ROOT_PATH . 'Class/User_formater.php';

global $Users;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];

    $user_model = new UserModel();

    $type = $_POST['s_type'];//彩票类型
    switch ($type) {
        case 0:
            $type_name = '全部';
            break;
        case 1:
            $type_name = '广东快乐十分';
            break;
        case 2:
            $type_name = '重庆时时彩';
            break;
        case 6:
            $type_name = '北京赛车';
            break;
        case 5:
            $type_name = '幸运农场';
            break;
        case 9:
            $type_name = '江苏骰宝';
            break;
    }
    if ($type!=0  && $start_date==$end_date) {//只有在同一天并且写明彩票类型的情况下才会有期数这一说
        $number = $_POST['s_number'];//期数
    }
    $status = $_POST['Balance'];//结算状态 1为已结算，0为未结算

    $current_user_account_id = $Users[0]['g_name'];
    $current_login_id = $Users[0]['g_login_id'];
    switch ($current_login_id) {
        case $user_model->cop_id:
            $current_cid = 1;
            break;
        case $user_model->stock_id:
            $current_cid = 2;
            break;
        case $user_model->maina_id:
            $current_cid = 3;
            break;
        case $user_model->agent_id:
            $current_cid = 4;
            break;
        default:
            exit(alert('用户登录权限有误，请联系管理员'));
    }

    $current_user_info= new Proxy($current_user_account_id,$current_cid);
    $current_user_info->get_from_db();//从数据库中填充对象

    $current_user_info->get_my_sons();
/*    var_dump($current_user_info->get_user_zhudan());
    exit;*/

    $son_array = $current_user_info->son;

    //$top_user_info = $current_user_info;
}
//var_dump($Users);

//print_r($current_user_info->son);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
</head>
<body>
<div dom="main" class="main-content1">
    <div id="reportForm_con">
        <div id="bet-type">
            <p class="bet-type">
                [<?php echo $type_name?>]
                <span class="bluer">日期范围: </span><span name="date"><?php echo $start_date?>~<?php echo $end_date?></span>
                <span class="bluer">报表分类:</span> 总账
                <?php
                for ($i=$current_cid;$i<$current_user_info->cid;$i++) {
                    echo '-&gt;<span onclick="history.go('.$i-$current_user_info->cid.')">'.$rank_transfer_array[$i].'</span>';
                }
                ?>
                -&gt; <?php echo $current_user_info->rank_name?>
                [<span class="bluer"><?php echo $current_user_info->my_name ?></span>]<?php echo $current_user_info->my_account_id?>
                <a href="javascript:void(0)" onclick="history.go(-1)" id="getBack">返回</a>
            </p>
        </div>
        <!--  总账分类   总代理  表格 -->
        <div id="agent-reportForm" class="reportForm-table">
            <table class="bet-table z3-table">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>代理</th>
                    <th>名称</th>
                    <th>注数</th>
                    <th>下注金额</th>
                    <th>会员盈亏</th>
                    <th>占成上缴</th>
                    <th class="sh1">代理金额</th>
                    <th class="sh1">代理佣金</th>
                    <th class="hc" id="sh1">代理上缴</th>
                    <th>占成%</th>
                    <th>本级占成</th>
                    <th class="sh2">总代奖金</th>
                    <th class="sh2">佣金</th>
                    <th>佣金差</th>
                    <th class="hc" id="sh2">总代盈亏</th>
                    <th>上级占成</th>
                    <th class="sh3">股东金额</th>
                    <th class="sh3">股东佣金</th>
                    <th class="hc" id="sh3">上缴股东</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0;$i<count($son_array);$i++) {
                    $current_obj = $son_array[$i];

                    //todo:这里要注释掉
                    //$current_obj = new Proxy(1,2);

                    $zhudan_array = $current_obj->get_user_zhudan();
                    //var_dump($zhudan_array);
                    //exit;
                    if ( count($zhudan_array) > 0) {?>
                <tr class="">
                    <td></td>
                    <td>
                        <a href="">
                            <?php echo $current_obj->my_account_id //本行用户账号?>
                        </a>
                    </td>
                    <td><?php echo $current_obj->my_name ?></td>
                    <td><span>12</span></td>
                    <td><span>24</span></td>
                    <td><span>1</span></td>
                    <td><span>-</span></td>
                    <td class="sh1"><span>-</span></td>
                    <td class="sh1"><span>-</span></td>
                    <td class="col1"><span>-</span></td>
                    <td>0</td>
                    <td><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="col1"><span class="win">0</span></td>
                    <td><span>24</span></td>
                    <td class="sh3"><span>-1</span></td>
                    <td class="sh3"><span>0</span></td>
                    <td class="col1"><span>-1</span></td>
                </tr>

                <?php
                    }
                } ?>
                <?php
                $current_user_zhudan = $current_user_info->get_user_zhudan();
                ?>
                <tr class="">
                    <td></td>
                    <td>
                        <a href="">
                            <?php echo $current_user_info->my_account_id?>.会员
                        </a>
                    </td>
                    <td><?php echo $current_user_info->my_name?></td>
                    <td><span><?php echo $current_user_zhudan['count']?></span></td>
                    <td><span><?php echo $current_user_zhudan['money']?></span></td>
                    <td><span><?php echo $current_user_zhudan['win']?></span></td>
                    <td><span>-</span></td>
                    <td class="sh1"><span>-</span></td>
                    <td class="sh1"><span>-</span></td>
                    <td class="col1"><span>-</span></td>
                    <td>0</td>
                    <td><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="col1"><span class="win">0</span></td>
                    <td><span>24</span></td>
                    <td class="sh3"><span>-1</span></td>
                    <td class="sh3"><span>0</span></td>
                    <td class="col1"><span>-1</span></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td><span class="bluer">总计</span></td>
                    <td><span>12</span></td>
                    <td><span>24</span></td>
                    <td><span>1</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td>-</td>
                    <td><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="col1"><span class="win">0</span></td>
                    <td><span>24</span></td>
                    <td class="sh3"><span>-1</span></td>
                    <td class="sh3"><span>0</span></td>
                    <td class="col1"><span>-1</span></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>