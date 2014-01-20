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


if ($report_type == 1) //总账
{
    include_once "./rank_report.php";

} else if ($report_type == 2) { //分类账
    include_once "./type_report.php";
}

