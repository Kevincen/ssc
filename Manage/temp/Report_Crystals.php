<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'function/Crystals.php';
include_once ROOT_PATH . 'Manage/config/config.php';
if ($ConfigModel['g_cry_select_lock'] != 1) exit(back('抱歉！報表數據暫時維護，無法查詢。'));
if (isset($Users[0]['g_lock_5']) && $Users[0]['g_lock_5'] != 1) {
    exit(back('權限不足，無法查詢。'));
}
$db = new DB();
$UserModel = new UserModel();
global $Users;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //報表類型 1交收報表  0分類報表 暫時無法合併
    if ($_GET['ReportType'] == 0) {
        //exit(back('系統數據庫升級，分類報表暫時無法查詢！'));
    }
    if (!isset($_GET['s_type'])) {
        if (!Matchs::isNumber($_GET['s_type'])) exit('s_type');
    }
    if (!isset($_GET['s_number'])) {
        if (!Matchs::isNumber($_GET['s_number'])) exit('s_number');
    }
    if (!Matchs::isNumber($_GET['t_N'])) exit('t_N');
    if (!Matchs::isNumber($_GET['ReportType'])) exit('ReportType');
    if (!Matchs::isNumber($_GET['Balance'])) exit('Balance');

    $CentetArr = array();
    $CentetArr['userList']['s_name'] = isset($_GET['s_name']) ? $_GET['s_name'] : null;
    $CentetArr['userList']['s_types'] = $_GET['s_types']; //彩票種類
    $CentetArr['userList']['s_type'] = $_GET['s_type']; //下註類型  第壹球
    $CentetArr['userList']['s_t_N'] = $_GET['t_N']; //期數查詢或日期查詢
    $CentetArr['userList']['s_number'] = $_GET['s_number']; //期數查詢
    $CentetArr['userList']['startDate'] = $_GET['startDate']; //日期查詢
    $CentetArr['userList']['endDate'] = $_GET['endDate']; //日期查詢
    $CentetArr['userList']['s_Report'] = $_GET['ReportType']; //報表類型    a交收報表  b分類報表
    $CentetArr['userList']['s_Balance'] = $_GET['Balance']; //結算狀態
    $show = $CentetArr['userList']['s_t_N'] == 0 ? '按期數查詢：' . $CentetArr['userList']['s_number'] :
         $CentetArr['userList']['startDate'] . '~' . $CentetArr['userList']['endDate'];
    $show1 = $CentetArr['userList']['s_t_N'] == 0 ? '按期數：' . $CentetArr['userList']['s_number'] :
        '按日期：' . $CentetArr['userList']['startDate'] . ' -- ' . $CentetArr['userList']['endDate'];
    $param = false;
    if ($CentetArr['userList']['s_name'] == null) {
        if ($Users[0]['g_login_id'] == 89) {
            //$loginid=$Users[0]['g_nid'].UserModel::Like();
            //	$result = $db->query("SELECT `g_nid`,`g_login_id`, `g_name` FROM `g_rank` WHERE g_nid like '{$loginid}'", 1);
            $CentetArr['userList']['s_name'] = "莊家";
            $CentetArr['userList']['g_login_id'] = 89;
            $CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][1];
            $s_rank = $Users[0]['g_Lnid'][2];
            $CentetArr['userList']['s_nid'] = $Users[0]['g_nid'] . UserModel::Like();
        } else {
            $CentetArr['userList']['s_name'] = $Users[0]['g_name'];
            if ($Users[0]['g_login_id'] == 48) {
                $CentetArr['userList']['s_nid'] = $Users[0]['g_nid'];
                $param = true;
            } else {
                $CentetArr['userList']['s_nid'] = $Users[0]['g_nid'] . UserModel::Like();
            }
            $CentetArr['userList']['g_login_id'] = $Users[0]['g_login_id'];
            $CentetArr['userList']['s_rank'] = $Users[0]['g_Lnid'][0];
            $s_rank = $Users[0]['g_Lnid'][1];
        }
    } else {
        $result = ResultNid($db, $CentetArr['userList']['s_name']);
        if ($result[0]['g_login_id'] == 48) {
            $CentetArr['userList']['s_nid'] = $result[0]['g_nid'];
            $param = true;
        } else {
            $CentetArr['userList']['s_nid'] = $result[0]['g_nid'] . UserModel::Like();
        }
        $CentetArr['userList']['s_name'] = $result[0]['g_name'];
        $a = $UserModel->GetLoginIdByString($result[0]['g_login_id']);
        $CentetArr['userList']['s_rank'] = $a[0];
        $CentetArr['userList']['g_login_id'] = $result[0]['g_login_id'];
    }

    if ($_GET['ReportType'] == 1) {

        //查詢當前用護的所有下級帳號
        $result = ResultNid($db, $CentetArr['userList']['s_nid'], true, $param);
        for ($i = 0; $i < count($result); $i++) {
            $c = GetCrystals($db, $CentetArr['userList'], $result[$i]);
            if ($c != null) {
                if ($CentetArr['userList']['g_login_id'] == 48) {
                    $a = $UserModel->GetLoginIdByString($result[$i]['g_login_id']);
                    $a = $a[0];
                } else {
                    $a = $UserModel->GetLoginIdByString($CentetArr['userList']['g_login_id']);
                    $a = $a[1];
                }
                $result[$i]['s_rank'] = $a;
                $result[$i]['cry'] = $c;
                $CentetArr['cryList'][] = $result[$i];
            }
        }
        if ($CentetArr['userList']['g_login_id'] != 56 && $CentetArr['userList']['g_login_id'] != 89) {
            if ($CentetArr['userList']['g_login_id'] != 48) {
                $nid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid']) - 32);
            } else {
                $nid = $CentetArr['userList']['s_nid'];
            }
            $s['g_nid'] = $nid;
            $UserInfo = GetCrystals($db, $CentetArr['userList'], $s, true);
            $CentetArr['userInfo'] = $UserInfo;
        }
        $CentetArr = SumCrystals($CentetArr);

    } else {
        /////分類報表
        $first = 1;
        $end = 77;
        if ($CentetArr['userList']['s_types'] == 1) {
            $first = 1;
            $end = 27;
        }
        if ($CentetArr['userList']['s_types'] == 2) {
            $first = 26;
            $end = 40;
        }
        if ($CentetArr['userList']['s_types'] == 3) {
            $first = 39;
            $end = 61;
        }
        if ($CentetArr['userList']['s_types'] == 6) {
            $first = 60;
            $end = 77;
        }
        if ($CentetArr['userList']['s_types'] == 5) {
            $first = 775;
            $end = 800;
        }
        if ($CentetArr['userList']['s_types'] == 7) {
            $first = 78;
            $end = 92;
        }
        if ($CentetArr['userList']['s_types'] == 8) {
            $first = 828;
            $end = 840;
        }
        if ($CentetArr['userList']['s_types'] == 9) {
            $first = 902;
            $end = 906;
        }
        //查詢當前用護的所有下級帳號
        $result = $Users; //ResultNid ($db, $CentetArr['userList']['s_nid'], true, $param);
        for ($i = 0; $i < count($result); $i++) {
            if ($_GET['s_type'] == "") {
                for ($f = $first; $f < $end; $f++) {
                    $CentetArr['userList']['s_type'] = $f;
                    $c = GetCrystalsfen($db, $CentetArr['userList'], $result[$i]);
                    if ($c != null) {
                        if ($CentetArr['userList']['g_login_id'] == 48) {
                            $a = $UserModel->GetLoginIdByString($result[$i]['g_login_id']);
                            $a = $a[0];
                        } else {
                            $a = $UserModel->GetLoginIdByString($CentetArr['userList']['g_login_id']);
                            $a = $a[1];
                        }
                        $result[$i]['s_rank'] = $a;
                        $result[$i]['cry'] = $c;
                        $CentetArr['cryList'][] = $result[$i];
                    }
                }
            } else {


                $c = GetCrystalsfen($db, $CentetArr['userList'], $result[$i]);
                if ($c != null) {
                    if ($CentetArr['userList']['g_login_id'] == 48) {
                        $a = $UserModel->GetLoginIdByString($result[$i]['g_login_id']);
                        $a = $a[0];
                    } else {
                        $a = $UserModel->GetLoginIdByString($CentetArr['userList']['g_login_id']);
                        $a = $a[1];
                    }
                    $result[$i]['s_rank'] = $a;
                    $result[$i]['cry'] = $c;
                    $CentetArr['cryList'][] = $result[$i];
                }
            }

        }
        if ($CentetArr['userList']['g_login_id'] != 56 && $CentetArr['userList']['g_login_id'] != 89) {
            if ($CentetArr['userList']['g_login_id'] != 48) {
                $nid = mb_substr($CentetArr['userList']['s_nid'], 0, mb_strlen($CentetArr['userList']['s_nid']) - 32);
            } else {
                $nid = $CentetArr['userList']['s_nid'];
            }
            $s['g_nid'] = $nid;
            $UserInfo = GetCrystalsfen($db, $CentetArr['userList'], $s, true);
            $CentetArr['userInfo'] = $UserInfo;
        }
        $CentetArr = SumCrystalsfen($CentetArr);

    }


}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>

    <script type="text/javascript">
        <!--
        function GoCrystals(str) {
            var href;
            var sp = location.href.split("&");
            var s = sp[sp.length - 1].split("=");
            if (s[0] == "s_name") {
                sp = sp.splice(0, sp.length - 1);
            }
            sp.push("s_name=" + str);
            self.location = sp.join("&");
        }

        function GoCryPop(str, t) {
            var href;
            var sp = location.href.split("?");
            var href = "/Manage/temp/Report_CryPop.php?" + sp[1] + "&s_name=" + str + "&t=" + t;
            window.open(href);
        }

        function GoCryPopfen(str, t, type) {
            var href;
            var sp = location.href.split("?");
            sp[1] = sp[1].replace("&s_type=", "");
            var href = "/Manage/temp/Report_CryPop.php?" + sp[1] + "&s_name=" + str + "&t=" + t + "&s_type=" + type;
            window.open(href);
        }
        -->
    </script>
    <title></title>
    <script>
        var folderUrl;
        function BrowseFolder() {
            try {
                var Message = "請選擇文件夾";  //選擇框提示信息
                var Shell = new ActiveXObject("Shell.Application");
                var Folder = Shell.BrowseForFolder(0, Message, 0x0040, 0x11);//起始目錄爲：我的電腦
                //var Folder = Shell.BrowseForFolder(0,Message,0); //起始目錄爲：桌面
                if (Folder != null) {
                    Folder = Folder.items();  // 返回 FolderItems 對象
                    Folder = Folder.item();  // 返回 Folderitem 對象
                    Folder = Folder.Path;   // 返回路徑
                    if (Folder.charAt(Folder.length - 1) != "\\") {
                        Folder = Folder + "\\";
                    }
                    document.all.savePath.value = Folder;
                    return Folder;
                }
            } catch (e) {
                alert(e.message);
            }
        }


        function xlsput(xtype) {

            function getTableCell(obj) {
//BrowseFolder();
                var _arrCellOnes = [];
                var _arrCellarrs = [];
                var _oTBody = obj.TBodies ? obj.TBodies : obj;

                var _oTRows = _oTBody.rows;

                for (i = 0; i < _oTRows.length; i++) {
                    _arrCellOnes = [];
                    for (j = 0; j < _oTRows.item(i).cells.length; j++) {
                        if (_oTRows[i].cells[j]) {

                            _arrCellOnes.push(_oTRows[i].cells[j].innerText);
                        }
                    }
                    _arrCellarrs.push(_arrCellOnes);
                }

                return _arrCellarrs;

            }

            var arrCells = getTableCell(document.getElementById("xlstr"));

            excel(arrCells, xtype);
//alert(arrCells);

//alert(document.getElementById("xlstr").innerHTML);
        }


        function excel(dataArr, xtype) {
            $.ajax({
                type: "POST",
                data: {dataArr: dataArr, xtype: xtype},
                url: "putxls.php",
                dataType: "json",
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState == 4) {
                        if (XMLHttpRequest.status == 500) {
                            excel(dataArr);
                            return false;
                        }
                    }
                },
                success: function (data) {
                    if (data == 1) {
                        alert('導出報表成功');
                    } else {
                        alert('導出報表失敗');
                    }
                }
            });
        }
    </script>
</head>
<body>
<div id="layout" class="container" style="height: 274px;">
    <div dom="left" class="sidebar" style="display: none;"></div>
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: none;"></div>
    <div dom="main" class="main-content1">
        <div id="reportForm_con">
            <div id="bet-type">
                <p class="bet-type">
                    [全部]
                    <span class="bluer">日期范围: </span><span name="date"><?php echo$show?></span>
                    <span class="bluer">报表分类:</span>
                    <?php
                    if ($_GET['ReportType']==1) {
                        echo "总账";
                    } else {
                        echo "分类账";
                    }
                    ?>
                    -&gt;
                    <?php echo$CentetArr['userList']['s_rank']?>
                    [<span class="bluer"><?php echo$CentetArr['userList']['s_f_name']?><span>]
                            <?php $CentetArr['userList']['s_name'] ?><a href="Report_Center.php" id="getBack">返回</a></p>
            </div>
            <!--  总账分类   大股东  表格 -->
            <div id="fbigShareholder-reportForm" class="reportForm-table">
                <table class="bet-table z3-table">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>股东</th>
                        <th>名称</th>
                        <th>注数</th>
                        <th>下注金额</th>
                        <th>会员盈亏</th>
                        <th>占成上缴</th>
                        <th class="sh1">股东金额</th>
                        <th class="sh1">股东佣金</th>
                        <th class="hc" id="sh1">股东上缴</th>
                        <th>占成%</th>
                        <th>本级占成</th>
                        <th class="sh2">分公司奖金</th>
                        <th class="sh2">佣金</th>
                        <th>佣金差</th>
                        <th class="hc" id="sh2">分公司盈亏</th>
                        <th>上级占成</th>
                        <th class="sh3">后台金额</th>
                        <th class="sh3">后台佣金</th>
                        <th class="hc" id="sh3">上缴后台</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="">
                        <td colspan="18" class="center">暂无数据</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--main content--></div>
</body>
</html>