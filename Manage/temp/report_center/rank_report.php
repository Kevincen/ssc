<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-16
 * Time: 上午12:51
 */

define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'Class/User_formater.php';
include_once ROOT_PATH . 'Class/ReportFactory.php';
include_once ROOT_PATH . 'Class/UserModel.php';
include_once ROOT_PATH . 'Class/DB.php';

global $Users;

$user_model = new UserModel();

$rank_transfer_array = array(
    0 => '',
    1 => '分公司',
    2 => '股东',
    3 => '总代',
    4 => '代理',
    5 => '会员'
);

$top_login_id = $Users[0]['g_login_id'];
switch ($top_login_id) {
    case $user_model->cop_id:
        $top_cid = 1;
        break;
    case $user_model->stock_id:
        $top_cid = 2;
        break;
    case $user_model->maina_id:
        $top_cid = 3;
        break;
    case $user_model->agent_id:
        $top_cid = 4;
        break;
    default:
        exit(alert('用户登录权限有误，请联系管理员'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];


    $type = $_POST['s_type'];//彩票类型
    if ($type!=0  && $start_date==$end_date) {//只有在同一天并且写明彩票类型的情况下才会有期数这一说
        $number = $_POST['s_number'];//期数
    }
    $status = $_POST['Balance'];//结算状态 1为已结算，0为未结算

    $current_user_account_id = $Users[0]['g_name'];
    $current_cid = $top_cid;

    $current_user = ReportFactory::CreateUser($current_user_account_id,$current_cid);
/*    print_r($current_user);*/
    $current_view = ReportFactory::CreateUserView($current_user);

} else {
    $start_date = $_GET['startDate'];
    $end_date = $_GET['endDate'];


    $type = $_GET['s_type'];//彩票类型
    if ($type!=0  && $start_date==$end_date) {//只有在同一天并且写明彩票类型的情况下才会有期数这一说
        $number = $_GET['s_number'];//期数
    }
    $status = $_GET['Balance'];//结算状态 1为已结算，0为未结算
    $current_account_id = $_GET['account_id'];
/*    $param_show_type = $_GET['type']; //0为普通会员，1为直属会员*/
    $current_cid = intval($_GET['cid']);
    $current_user = ReportFactory::CreateUser($current_account_id,$current_cid);
    $current_view = ReportFactory::CreateUserView($current_user);

}


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

//var_dump($Users);

//print_r($current_user_info->son);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
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
                for ($i=$top_cid;$i<$current_user->cid;$i++) {
                    echo '-&gt; <a href="javascript:void(0)" onclick="history.go('.($i-$current_user->cid).')">'.$rank_transfer_array[$i].'</a>';
                    //echo '-&gt; <span onclick="history.go('.$i-$current_user->cid.')">'.$rank_transfer_array[$i].'</span>';
                }
                ?>
                -&gt; <?php echo $current_user->rank_name?>
                [<span class="bluer"><?php echo $current_user->my_name ?></span>]<?php echo $current_user->my_account_id?>
                <a href="javascript:void(0)" onclick="history.go(-1)" id="getBack">返回</a>
            </p>
        </div>
        <script>
            $(document).ready(function(){

                $('.hc').click(function(){
                    var id = $(this).attr('id');

                    $('.'+id).toggle();
                });

                $('a[name=user]').click(function(){
                    var form_selecter = '#url_form';
                    var url = "./rank_report.php";
                    var account_id = $(this).attr('account_id');
                    var cid = $(this).attr('cid');
                    $(form_selecter).find('input[name=account_id]').val(account_id);
                    $(form_selecter).find('input[name=cid]').val(cid);
                    $(form_selecter).attr('action',url);
                    $(form_selecter).submit();
                });
            });

        </script>
    </div>
    <?php $current_view->show(); ?>
</div>


<form action="" method="get" id="url_form">
    <input type="hidden" name="account_id" value=""/>
    <input type="hidden" name="cid" id=""/>
    <input type="hidden" name="startDate" value="<?php echo $start_date?>"/>
    <input type="hidden" name="endDate" value="<?php echo $end_date?>"/>
    <input type="hidden" name="s_type" value="<?php echo $type?>"/>
    <input type="hidden" name="s_number" value="<?php echo $number?>"/>
    <input type="hidden" name="Balance" value="<?php echo $status?>"/>
</form>
</body>
</html>