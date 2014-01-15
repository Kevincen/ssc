<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-16
 * Time: 上午3:03
 */


define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';

$report_type = $_POST['ReportType'];

$rank_transfer_array = array(
    0 => '',
    1 => '分公司',
    2 => '股东',
    3 => '总代',
    4 => '代理',
    5 => '会员'
);

if ($report_type == 1) //总账
{
    include_once "./rank_report.php";

} else if ($report_type == 2) { //分类账

}

