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
include_once ROOT_PATH . "Class/ReportUser.php";
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


    $type = $_POST['s_type']; //彩票类型
    if ($type != 0 && $start_date == $end_date) { //只有在同一天并且写明彩票类型的情况下才会有期数这一说
        $number = $_POST['s_number']; //期数
    }
    $status = $_POST['Balance']; //结算状态 1为已结算，0为未结算

    $current_user_account_id = $Users[0]['g_name'];
    $current_user_name = $Users[0]['g_f_name'];
    $current_cid = $top_cid;

    $tree = ReportFactory::CreateUser($current_user_account_id, $current_cid, NULL);
    $tree->buildTree('', '', '1', '', '');

    /*    print_r($current_user);*/
    //$current_view = ReportFactory::CreateUserView($current_user);

} else {
    $start_date = $_GET['startDate'];
    $end_date = $_GET['endDate'];


    $type = $_GET['s_type']; //彩票类型
    if ($type != 0 && $start_date == $end_date) { //只有在同一天并且写明彩票类型的情况下才会有期数这一说
        $number = $_GET['s_number']; //期数
    }
    $status = $_GET['Balance']; //结算状态 1为已结算，0为未结算
    $current_account_id = $_GET['account_id'];
    /*    $param_show_type = $_GET['type']; //0为普通会员，1为直属会员*/
    $current_cid = intval($_GET['cid']);

    //$current_view = ReportFactory::CreateUserView($current_user);

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
    <script src="/wjl_tmp/type_rep.js"></script>
    <script src="/wjl_tmp/user_rep.js"></script>
    <script>
        var current_tree = undefined;
        var cid = <?php echo $current_cid?>;
        var level = 1;
        var nav_stack = new Array();
        var nav_head = '[<?php echo $type_name ?>]\
            <span class="bluer">日期范围: </span><span name="date"><?php echo $start_date ?>\
            ~<?php echo $end_date ?></span>\
        <span class="bluer">报表分类:</span> 总账';
        var nav_obj = function (cid,step) {
            this.name = rank_name_array[cid];
            this.step = step;
        }

        function nav_push(cid, account_id) {
            var obj;
            if (cid != undefined && account_id.indexOf('会员') < 0) {
                obj = new nav_obj(cid,0);
                nav_stack.push(obj);
            }

            //对stack所有的元素step+1
            for (var i=0;i<nav_stack.length; i++) {
                nav_stack[i].step++;
            }
        }

        function nav_pop() {
            if (nav_stack[nav_stack.length-1].step == 1) {
                nav_stack.pop();
            }
            //对stack所有的元素step+1
            for (var i=0;i<nav_stack.length; i++) {
                nav_stack[i].step--;
            }
        }


        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');


            current_tree = JSON.parse('<?php echo json_encode((object)$tree)?>');
            console.log(current_tree);

            var c_view = new UserView(current_tree);
            $('#table').html(c_view.show());

            $('.hc').click(function () {
                var id = $(this).attr('id');
                $('.' + id).toggle();
            });


            $('#getBack').click(function () {
                history.go(-1);
            });
        });

        function sub_click($this) {
            var index = $this.attr('index');
            console.log('current_tree');
            console.log(current_tree);

            nav_push(current_tree.cid, current_tree.my_account_id);

            var parent = current_tree;
            current_tree = current_tree.children[index];
            current_tree.parent = parent;
            /* while (current_tree.children[0].title == '') {
             parent = current_tree;
             current_tree = current_tree.children[0];
             current_tree.parent = parent;
             }*/

            var view;
            if (current_tree.property === 'date') {
                //draw caption
                view = new DateView(cid, current_tree);
            } else if (current_tree.cid == 5) {
                view = new FLZDetailView(cid, current_tree);
            } else {
                view = new UserView(current_tree);
            }

            var html = view.show();
            document.getElementById('table').innerHTML = html;
            document.getElementById('getBack').onclick = backward;

            document.getElementById('nav').innerHTML = gen_nav();
            $('#getBack').unbind('click').click(function () {
                backward();
            });
        }
        function backward(level) {
            if (level === undefined) {
                level = 1;
            }
            for (var i = 0; i < level; i++) {
                current_tree = current_tree.parent;
            }
            var view;

            if (current_tree.parent == null) {
                $('#getBack').unbind('click').click(function () {
                    history.go(-1);
                });
            }
            if (current_tree.property === 'date') {
                view = new DateView(cid, current_tree);
            } else if (current_tree.cid == 5) {
                view = new FLZDetailView(cid, current_tree);
            } else {
                view = new UserView(current_tree);
            }
            nav_pop();

            var html = view.show();
            document.getElementById('table').innerHTML = html;
            document.getElementById('nav').innerHTML = gen_nav();
            if (current_tree.parent == null) {
                $('#getBack').unbind('click').click(function () {
                    history.go(-1);
                });
            } else {
                $('#getBack').unbind('click').click(function () {
                    backward();
                });
            }
        }
        function gen_nav() {
            var nav_html = '';
            nav_html += nav_head;
            for (var i=0;i<nav_stack.length; i++) {
                nav_html += '-&gt; ';
                nav_html += wrap_elem('a', nav_stack[i].name, 'onclick="backward('+nav_stack[i].step+')"');
            }

            if (current_tree.cid != undefined && current_tree.my_account_id.indexOf('会员')<0) {
                nav_tail = '-&gt; ';
                nav_tail += rank_name_array[current_tree.cid];
                nav_tail += '[<span class="bluer">'+ current_tree.my_account_id +'</span>]'+current_tree.my_name;
                nav_tail += '<a href="javascript:void(0)" id="getBack">返回</a>'
            }

            nav_html += nav_tail;

            return nav_html;
        }
    </script>
</head>
<body>
<div id="layout" class="container">
    <div dom="main" class="main-content1">
        <div id="reportForm_con">
            <div id="bet-type">
                <p class="bet-type" id="nav">
                    [<?php echo $type_name ?>]
                    <span class="bluer">日期范围: </span><span name="date"><?php echo $start_date ?>
                        ~<?php echo $end_date ?></span>
                    <span class="bluer">报表分类:</span> 总账
                    -&gt; <?php echo $rank_transfer_array[$current_cid] ?>
                    [<span
                        class="bluer"><?php echo $current_user_name ?></span>]<?php echo $current_user_account_id ?>
                    <a href="javascript:void(0)" id="getBack">返回</a>
                </p>
            </div>
            <script>
                /*            $(document).ready(function(){

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


                 var obj = JSON.parse('<?php echo json_encode($current_user)?>');
                 console.log(obj);
                 });*/

            </script>
        </div>
        <div class="reportForm-table" id="table">
        </div>
    </div>

</div>
</body>
</html>