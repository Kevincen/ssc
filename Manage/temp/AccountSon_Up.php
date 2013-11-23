<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
$lock = false;
if ($LoginId == 89){
	$lock=true;
}

$lock_6 = false;
if (isset($Users[0]['g_lock_6'])){
	$lock_6 = true;
	if ($Users[0]['g_lock_6'] != 1)
		exit(back('您的權限不足！'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['uid']))
{
	$db=new DB();
	if ($db->query("SELECT g_id FROM g_relation_user WHERE g_id = '{$_GET['uid']}' LIMIT 1", 1)){
		if (!Matchs::isStringChi($_POST['s_f_Name'], 2, 20)) exit(back($_POST['s_f_Name'].' 輸入錯誤！'));
		$sonList = array();
		if	($_POST['s_pwd'] != null){
			$sonList['g_password'] = sha1($_POST['s_pwd']);
		} else {
			$sonList['g_password'] = $_POST['sid'];
		}
		$sonList['g_s_f_name'] = $_POST['s_f_Name'];
		$sonList['g_lock'] = $_POST['lock'];
		$sonList['g_lock_1'] = empty($_POST['lock_1']) ? 0 : $_POST['lock_1'];
		$sonList['g_lock_2'] = empty($_POST['lock_2']) ? 0 : $_POST['lock_2'];
		$sonList['g_lock_3'] = empty($_POST['lock_3']) ? 0 : $_POST['lock_3'];
		$sonList['g_lock_4'] = empty($_POST['lock_4']) ? 0 : $_POST['lock_4'];
		$sonList['g_lock_5'] = empty($_POST['lock_5']) ? 0 : $_POST['lock_5'];
		$sonList['g_lock_6'] = empty($_POST['lock_5']) ? 0 : $_POST['lock_6'];
		$sonList['g_lock_1_1'] = empty($_POST['lock_1_1']) ? 0 : $_POST['lock_1_1'];
		$sonList['g_lock_1_2'] = empty($_POST['lock_1_2']) ? 0 : $_POST['lock_1_2'];
		$sonList['g_lock_1_3'] = empty($_POST['lock_1_3']) ? 0 : $_POST['lock_1_3'];
		$sonList['g_lock_1_4'] = empty($_POST['lock_1_4']) ? 0 : $_POST['lock_1_4'];
		$sonList['g_lock_1_5'] = empty($_POST['lock_1_5']) ? 0 : $_POST['lock_1_5'];
		$sonList['g_lock_1_6'] = empty($_POST['lock_1_6']) ? 0 : $_POST['lock_1_6'];
		$sonList['g_lock_1_7'] = empty($_POST['lock_1_7']) ? 0 : $_POST['lock_1_7'];
		if ($sonList['g_lock_1'] == 0)
		{
			$sonList['g_lock_1_1']=$sonList['g_lock_1_2']=$sonList['g_lock_1_3']=$sonList['g_lock_1_4']=$sonList['g_lock_1_5']=$sonList['g_lock_1_6']=$sonList['g_lock_1_7']=0;
		}
		$db->query(" UPDATE g_relation_user SET 
		g_password = '{$sonList['g_password']}',
		g_s_f_name = '{$sonList['g_s_f_name']}',
		g_lock = '{$sonList['g_lock']}',
		g_lock_1 = '{$sonList['g_lock_1']}',
		g_lock_2 = '{$sonList['g_lock_2']}',
		g_lock_3 = '{$sonList['g_lock_3']}',
		g_lock_4 = '{$sonList['g_lock_4']}',
		g_lock_5 = '{$sonList['g_lock_5']}',
		g_lock_6 = '{$sonList['g_lock_6']}',
		g_lock_1_1 = '{$sonList['g_lock_1_1']}',
		g_lock_1_2 = '{$sonList['g_lock_1_2']}',
		g_lock_1_3 = '{$sonList['g_lock_1_3']}',
		g_lock_1_4 = '{$sonList['g_lock_1_4']}',
		g_lock_1_5 = '{$sonList['g_lock_1_5']}',
		g_lock_1_6 = '{$sonList['g_lock_1_6']}',
		g_lock_1_7 = '{$sonList['g_lock_1_7']}'
		WHERE g_id = '{$_GET['uid']}' LIMIT 1", 2);
		exit(alert_href('更變成功。', 'AccountSon_List.php'));
	} else {
		exit(back('帳號錯誤'));
	}
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['uid']))
{
	$db=new DB();
	if (!Matchs::isNumber($_GET['uid'], 1, 20)) exit(back('###'));
	$result = $db->query("SELECT * FROM g_relation_user WHERE g_id = '{$_GET['uid']}' LIMIT 1", 1);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
<title></title>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>

    <script type="text/javascript">
<!--
	$(function(){
		var lock_1 = $("#lock_1");
		if (lock_1.attr("checked")){
			var manages = $("#manages");
			manages.css("display", "");
		}
	})
	function setManages($this){
		var manages = $("#manages");
	 	if ($this.checked){
	 		manages.css("display", "");
	 	} else {
	 		manages.css("display", "none");
	 	}
	}

	function isForm(){
		var pwd = $("#s_pwd");
		if (pwd.val() != ""){
			if (pwd.val().length < 8 || pwd.val().length > 20){
				alert("密碼長度須8-20位");
				return false;
			}
			if(Pwd_Safety(pwd.val())!=true) {
				return false;
			}
		}
		return true;
	}
-->
</script>
</head>
<body>
<div id="layout" class="container" style="height: 274px;">
    <form action="" method="post" onsubmit="return isForm()">
        <div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
            <form id="user_info">
                <div id="guanliyuan" class=" guanliyuan">
                    <div class="title"><span id="account_name">修改管理员</span><a href="AccountSon_List.php?cid=0"
                                                                              id="reback" level="0"
                                                                              class="mag-btn1">返回</a></div>
                    <table class="clear-table base-info ">
                        <caption>
                            <div>基本资料</div>
                        </caption>
                        <tbody>
                        <tr>
                            <th>名称</th>
                            <td><input id="s_f_Name" autocomplete="off" type="text" name="s_f_Name" vname="name"
                                       vmessage="由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"
                                        value="<?php echo$result[0]['g_s_f_name']?>">
                                <span
                                    class="g-vd-status"></span></td>
                            <th>账号</th>
                            <td><input id="s_Name" autocomplete="off" type="text" name="s_Name" vname="account"
                                       vmessage="账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线！"
                                       value="<?php echo$result[0]['g_s_name']?>" readonly>
                                <span class="g-vd-status"></span>
                            </td>
                            <th>状态</th>
                            <td><select name="lock">
                                    <option value="0" <?php if($userList[0]['g_lock']==3){echo 'selected="selected"';}?> >停用</option>
                                    <option value="2" <?php if($userList[0]['g_lock']==2){echo 'selected="selected"';}?>>
                                        停押
                                    </option>
                                    <option value="1" <?php if($userList[0]['g_lock']==1){echo 'selected="selected"';}?> >
                                        启用
                                    </option>
                                </select></td>
                        </tr>
                        <tr>
                            <th>密码</th>
                            <td><input id="s_pwd" autocomplete="off" type="password" name="s_pwd" vname="password"
                                       vmessage="6~16位数字、字母组成！"><span class="g-vd-status"></span></td>
                            <th>确认密码</th>
                            <td><input autocomplete="off" type="password" name="repassword" vname="repassword"
                                       vmessage="6~16位数字、字母组成！"><span class="g-vd-status"></span></td>
                            <th id="ylch_t"></th>
                            <td id="ylch_c"></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="clear-table base-info right">
                        <caption>
                            <div><label><input type="checkbox" id="selectAll" checked="">全选</label>权限</div>
                        </caption>
                        <tbody>
                        <tr id="rights">

                            <?php if (($lock && !$lock_6 )
                                || ($lock_6 && $Users[0]['g_lock_1'] == 1)) { ?>
                                <td>
                                    內部管理 <input name="lock_1" onclick="setManages(this)" style="position:relative;top:3px"
                                                <?php if($result[0]['g_lock_1']==1){echo 'checked="checked"';}?>
                                                type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            <?php } ?>

                            <?php if ((!$lock_6) || ($lock_6 && $Users[0]['g_lock_2'] == 1)) { ?>
                                <td>
                                    下線管理 <input name="lock_2" style="position:relative;top:3px"
                                    <?php if($result[0]['g_lock_2']==1){echo 'checked="checked"';}?>
                                                type="checkbox"  value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            <?php } ?>

                            <?php if (($LoginId != 89 && $LoginId != 56 && !$lock_6)
                                || ($LoginId != 89 && $LoginId != 56 && $lock_6 && $Users[0]['g_lock_3'] == 1)) { ?>
                                <td>
                                    自動補倉 <input name="lock_3" style="position:relative;top:3px" type="checkbox"
                                        <?php if($result[0]['g_lock_3']==1){echo 'checked="checked"';}?>
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            <?php } ?>

                            <?php if (!$lock_6
                                    ||($lock_6 && $Users[0]['g_lock_4'] == 1)) { ?>
                                <td>
                                    即時注單 <input name="lock_4" style="position:relative;top:3px" type="checkbox"
                                        <?php if($result[0]['g_lock_4']==1){echo 'checked="checked"';}?>
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            <?php } ?>

                            <?php if (!$lock_6
                                        || ($lock_6 && $Users[0]['g_lock_5'] == 1)) { ?>
                                <td>
                                    報表查詢 <input name="lock_5" style="position:relative;top:3px" type="checkbox"
                                        <?php if($result[0]['g_lock_5']==1){echo 'checked="checked"';}?>
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            <?php } ?>

                            <?php if (!$lock_6
                                        || ($lock_6 && $Users[0]['g_lock_6'] == 1)) { ?>
                                <td>
                                    子帳管理 <input name="lock_6" style="position:relative;top:3px" type="checkbox"
                                        <?php if($result[0]['g_lock_6']==1){echo 'checked="checked"';}?>
                                                value="1"/>
                                </td>
                            <?php } ?>
                            <!--<td right="ZDGL"><label for="ZDGL"><input type="checkbox" name="right" id="ZDGL" checked/>注单管理</label></td>-->
                        </tr>
                        <?php if ($lock) { ?>
                            <tr id="manages">
                                <?php if (!$lock_6) { ?>
                                    系統設置 <input name="lock_1_1" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_1'] == 1) { ?>
                                    系統設置 <input name="lock_1_1" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } ?>

                                <?php if (!$lock_6) { ?>
                                    賠率設置 <input name="lock_1_2" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_2'] == 1) { ?>
                                    賠率設置 <input name="lock_1_2" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } ?>

                                <?php if (!$lock_6) { ?>
                                    公告設置 <input name="lock_1_3" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_3'] == 1) { ?>
                                    公告設置 <input name="lock_1_3" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } ?>

                                <?php if (!$lock_6) { ?>
                                    注單設置 <input name="lock_1_4" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_4'] == 1) { ?>
                                    注單設置 <input name="lock_1_4" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } ?>

                                <?php if (!$lock_6) { ?>
                                    開獎設置 <input name="lock_1_5" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_5'] == 1) { ?>
                                    開獎設置 <input name="lock_1_5" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } ?>

                                <?php if (!$lock_6) { ?>
                                    開盤設置 <input name="lock_1_6" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_6'] == 1) { ?>
                                    開盤設置 <input name="lock_1_6" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } ?>

                                <?php if (!$lock_6) { ?>
                                    數據備份 <input name="lock_1_7" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php } else if ($lock_6 && $Users[0]['g_lock_1_7'] == 1) { ?>
                                    數據備份 <input name="lock_1_7" style="position:relative;top:3px" type="checkbox"
                                                value="1"/>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="btn-line"><input type="submit" class="yellow-btn" id="submit" value="保 存"/>
                        <input
                            type="reset" class="white-btn" id="reset" value="取 消" /></div>
                </div>
            </form>

        </div>
        <!--bet content-->
        <div dom="main_nav" class="main-content1" style="display: none;"></div>
        <div dom="main" class="main-content1" style="display: none;"></div>
        <!--main content-->
</div>
</body>
</html>