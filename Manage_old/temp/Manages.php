<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $ConfigModel,$Users;
$db=new DB();
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (!Matchs::isNumber($_POST['mix_money'])) exit(back('最低金額輸入錯誤！'));
	if (!Matchs::isNumber($_POST['max_money'], 1, 8)) exit(back('最高派彩輸入錯誤！'));
	if (!Matchs::isNumber($_POST['up_odds_mix'])) exit(back('連續值輸入錯誤！'));
	//if (!Matchs::isNumber($_POST['up_odds_mix_gx'])) exit(back('廣西連續值輸入錯誤！'));
	if (!Matchs::isNumber($_POST['up_odds_mix_pk'])) exit(back('北京赛车連續值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_num'], 1, 8)) exit(back('1-8球總值輸入錯誤！'));
	//if (!Matchs::isFloating($_POST['odds_num_gx'], 1, 8)) exit(back('1-5球總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_num_pk'], 1, 8)) exit(back('北京赛车1-10名總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_str'], 1, 8)) exit(back('雙面總值輸入錯誤！'));
	if (!Matchs::isNumber($_POST['up_odds_mix_cq'])) exit(back('連續值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_num_cq'], 1, 8)) exit(back('1-5球總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_str_cq'], 1, 8)) exit(back('雙面總值輸入錯誤！'));
	//if (!Matchs::isFloating($_POST['odds_str_gx'], 1, 8)) exit(back('廣西雙面總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_str_pk'], 1, 8)) exit(back('北京赛车雙面總值輸入錯誤！'));
	if (!Matchs::isNumber($_POST['insert_number_day'])) exit(back('加載期數輸入錯誤！'));
	if (!Matchs::isFloating($_POST['close_time'])) exit(back('封盤時間輸入錯誤！'));
	if (!Matchs::isNumber($_POST['login_log_lock'])) exit(back('保存日誌格式錯誤！'));
	if (!Matchs::isNumber($_POST['out_time'])) exit(back('過期時間格式錯誤！'));
	if (!Matchs::isFloating($_POST['odds_ratio_b1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b1']));
	if (!Matchs::isFloating($_POST['odds_ratio_b2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b2']));
	if (!Matchs::isFloating($_POST['odds_ratio_b3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b3']));
	if (!Matchs::isFloating($_POST['odds_ratio_b4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b4']));
	if (!Matchs::isFloating($_POST['odds_ratio_b5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b5']));
	if (!Matchs::isFloating($_POST['odds_ratio_c1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c1']));
	if (!Matchs::isFloating($_POST['odds_ratio_c2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c2']));
	if (!Matchs::isFloating($_POST['odds_ratio_c3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c3']));
	if (!Matchs::isFloating($_POST['odds_ratio_c4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c4']));
	if (!Matchs::isFloating($_POST['odds_ratio_c5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c5']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_b1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_b1']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_b2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_b2']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_b3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_b3']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_c1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_c1']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_c2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_c2']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_c3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_c3']));
	
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_b1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_b1']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_b2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_b2']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_b3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_b3']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_b4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_b4']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_b5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_b5']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_c1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_c1']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_c2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_c2']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_c3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_c3']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_c4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_c4']));
	//if (!Matchs::isFloating($_POST['odds_ratio_gx_c5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_gx_c5']));
	
	
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_b1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_b1']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_b2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_b2']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_b3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_b3']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_b4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_b4']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_b5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_b5']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_c1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_c1']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_c2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_c2']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_c3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_c3']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_c4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_c4']));
	//if (!Matchs::isFloating($_POST['odds_ratio_nc_c5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_nc_c5']));
	
	//if (!Matchs::isFloating($_POST['odds_num_nc'], 1, 8)) exit(back('农场1-8球總值輸入錯誤！'));
	//if (!Matchs::isFloating($_POST['odds_str_nc'], 1, 8)) exit(back('农场雙面總值輸入錯誤！'));
	//if (!Matchs::isNumber($_POST['up_odds_mix_nc'])) exit(back('幸运农场連續值輸入錯誤！'));
	
	//if (!Matchs::isFloating($_POST['odds_num_xj'], 1, 8)) exit(back('新疆1-8球總值輸入錯誤！'));
	//if (!Matchs::isFloating($_POST['odds_str_xj'], 1, 8)) exit(back('新疆雙面總值輸入錯誤！'));
	//if (!Matchs::isNumber($_POST['up_odds_mix_xj'])) exit(back('新疆連續值輸入錯誤！'));
	
	
	$List = array();
	for ($i=1; $i<=10; $i++){
		$List['g_game_'.$i.''] = empty($_POST['game_'.$i.'']) ? 0 : $_POST['game_'.$i.''];
		$List['g_game_nc_'.$i.''] = empty($_POST['game_nc_'.$i.'']) ? 0 : $_POST['game_nc_'.$i.''];
		if ($i<=7)
			$List['g_game_cq_'.$i.''] = empty($_POST['game_cq_'.$i.'']) ? 0 : $_POST['game_cq_'.$i.''];
			$List['g_game_xj_'.$i.''] = empty($_POST['game_xj_'.$i.'']) ? 0 : $_POST['game_xj_'.$i.''];
		if ($i<=5||$i>=9){
			$List['g_game_gx_'.$i.''] = empty($_POST['game_gx_'.$i.'']) ? 0 : $_POST['game_gx_'.$i.''];
			}
		if ($i<=3)
			$List['g_game_pk_'.$i.''] = empty($_POST['game_pk_'.$i.'']) ? 0 : $_POST['game_pk_'.$i.''];
	}
	$List['g_web_lock'] = $_POST['web_lock'];
	$List['g_web_text'] = strip_tags($_POST['web_text']);
	$List['g_kg_game_lock'] = empty($_POST['kg_game_lock']) ? 0 : $_POST['kg_game_lock'];
	$List['g_cq_game_lock'] = empty($_POST['cq_game_lock']) ? 0 : $_POST['cq_game_lock'];
	$List['g_gx_game_lock'] = empty($_POST['gx_game_lock']) ? 0 : $_POST['gx_game_lock'];
	$List['g_pk_game_lock'] = empty($_POST['pk_game_lock']) ? 0 : $_POST['pk_game_lock'];
	
	$List['g_nc_game_lock'] = empty($_POST['nc_game_lock']) ? 0 : $_POST['nc_game_lock'];
	$List['g_xj_game_lock'] = empty($_POST['xj_game_lock']) ? 0 : $_POST['xj_game_lock'];
	$List['g_lhc_game_lock'] = empty($_POST['lhc_game_lock']) ? 0 : $_POST['lhc_game_lock'];
	$List['g_jsk3_game_lock'] = empty($_POST['jsk3_game_lock']) ? 0 : $_POST['jsk3_game_lock'];
	
	$List['g_restore_money_lock'] = $_POST['restore_money_lock'];
	$List['g_mix_money'] = $_POST['mix_money'];
	$List['g_max_money'] = $_POST['max_money'];
	$List['g_odds_ratio_b1'] = $_POST['odds_ratio_b1'];
	$List['g_odds_ratio_b2'] = $_POST['odds_ratio_b2'];
	$List['g_odds_ratio_b3'] = $_POST['odds_ratio_b3'];
	$List['g_odds_ratio_b4'] = $_POST['odds_ratio_b4'];
	$List['g_odds_ratio_b5'] = $_POST['odds_ratio_b5'];
	$List['g_odds_ratio_c1'] = $_POST['odds_ratio_c1'];
	$List['g_odds_ratio_c2'] = $_POST['odds_ratio_c2'];
	$List['g_odds_ratio_c3'] = $_POST['odds_ratio_c3'];
	$List['g_odds_ratio_c4'] = $_POST['odds_ratio_c4'];
	$List['g_odds_ratio_c5'] = $_POST['odds_ratio_c5'];
	$List['g_odds_ratio_cq_b1'] = $_POST['odds_ratio_cq_b1'];
	$List['g_odds_ratio_cq_b2'] = $_POST['odds_ratio_cq_b2'];
	$List['g_odds_ratio_cq_b3'] = $_POST['odds_ratio_cq_b3'];
	$List['g_odds_ratio_cq_c1'] = $_POST['odds_ratio_cq_c1'];
	$List['g_odds_ratio_cq_c2'] = $_POST['odds_ratio_cq_c2'];
	$List['g_odds_ratio_cq_c3'] = $_POST['odds_ratio_cq_c3'];
	$List['g_odds_ratio_gx_b1'] = $_POST['odds_ratio_gx_b1'];
	$List['g_odds_ratio_gx_b2'] = $_POST['odds_ratio_gx_b2'];
	$List['g_odds_ratio_gx_b3'] = $_POST['odds_ratio_gx_b3'];
	$List['g_odds_ratio_gx_b4'] = $_POST['odds_ratio_gx_b4'];
	$List['g_odds_ratio_gx_b5'] = $_POST['odds_ratio_gx_b5'];
	$List['g_odds_ratio_gx_c1'] = $_POST['odds_ratio_gx_c1'];
	$List['g_odds_ratio_gx_c2'] = $_POST['odds_ratio_gx_c2'];
	$List['g_odds_ratio_gx_c3'] = $_POST['odds_ratio_gx_c3'];
	$List['g_odds_ratio_gx_c4'] = $_POST['odds_ratio_gx_c4'];
	$List['g_odds_ratio_gx_c5'] = $_POST['odds_ratio_gx_c5'];
	$List['g_login_log_lock'] = $_POST['login_log_lock'];
	$List['g_out_time'] = $_POST['out_time'];
	$List['g_son_member_lock'] = $_POST['son_member_lock'];
	$List['g_cry_select_lock'] = $_POST['cry_select_lock'];
	$List['g_nowrecord_lock'] = $_POST['nowrecord_lock'];
	$List['g_automatic_bu_huo_lock'] = $_POST['automatic_bu_huo_lock'];
	$List['g_odds_execution_lock'] = $_POST['odds_execution_lock'];
	$List['g_up_odds_mix'] = $_POST['up_odds_mix'];
	$List['g_up_odds_mix_pk'] = $_POST['up_odds_mix_pk'];
	$List['g_odds_num_pk'] = $_POST['odds_num_pk'];
	$List['g_odds_str_pk'] = $_POST['odds_str_pk'];
	$List['g_odds_num'] = $_POST['odds_num'];
	$List['g_odds_str'] = $_POST['odds_str'];
	$List['g_up_odds_mix_cq'] = $_POST['up_odds_mix_cq'];
	$List['g_odds_num_cq'] = $_POST['odds_num_cq'];
	$List['g_odds_str_cq'] = $_POST['odds_str_cq'];
	$List['g_up_odds_mix_gx'] = $_POST['up_odds_mix_gx'];
	$List['g_odds_num_gx'] = $_POST['odds_num_gx'];
	$List['g_odds_str_gx'] = $_POST['odds_str_gx'];
	$List['g_automatic_money_lock'] = $_POST['automatic_money_lock'];
	$List['g_automatic_open_number_lock'] = $_POST['automatic_open_number_lock'];
	$List['g_automatic_open_result_lock'] = $_POST['automatic_open_result_lock'];
	$List['g_insert_number_day'] = $_POST['insert_number_day'];
	$List['g_close_time'] = $_POST['close_time'];
	$List['g_open_time_gd'] = $_POST['open_time_gd'];
	$List['g_open_time_cq'] = $_POST['open_time_cq'];
	$List['g_open_time_gx'] = $_POST['open_time_gx'];
	$List['g_open_time_pk'] = $_POST['open_time_pk'];
	
	$List['g_odds_ratio_nc_b1'] = $_POST['odds_ratio_nc_b1'];
	$List['g_odds_ratio_nc_b2'] = $_POST['odds_ratio_nc_b2'];
	$List['g_odds_ratio_nc_b3'] = $_POST['odds_ratio_nc_b3'];
	$List['g_odds_ratio_nc_b4'] = $_POST['odds_ratio_nc_b4'];
	$List['g_odds_ratio_nc_b5'] = $_POST['odds_ratio_nc_b5'];
	$List['g_odds_ratio_nc_c1'] = $_POST['odds_ratio_nc_c1'];
	$List['g_odds_ratio_nc_c2'] = $_POST['odds_ratio_nc_c2'];
	$List['g_odds_ratio_nc_c3'] = $_POST['odds_ratio_nc_c3'];
	$List['g_odds_ratio_nc_c4'] = $_POST['odds_ratio_nc_c4'];
	$List['g_odds_ratio_nc_c5'] = $_POST['odds_ratio_nc_c5'];
	$List['g_up_odds_mix_nc'] = $_POST['up_odds_mix_nc'];
	$List['g_odds_num_nc'] = $_POST['odds_num_nc'];
	$List['g_odds_str_nc'] = $_POST['odds_str_nc'];
	$List['g_open_time_nc'] = $_POST['open_time_nc'];
	$List['g_up_odds_mix_xj'] = $_POST['up_odds_mix_xj'];
	$List['g_odds_num_xj'] = $_POST['odds_num_xj'];
	$List['g_odds_str_xj'] = $_POST['odds_str_xj'];
	 
	
	$sql = "UPDATE g_config SET 
	g_web_lock='{$List['g_web_lock']}',
	g_web_text='{$List['g_web_text']}',
	g_kg_game_lock='{$List['g_kg_game_lock']}',
	g_cq_game_lock='{$List['g_cq_game_lock']}',
	g_gx_game_lock='{$List['g_gx_game_lock']}',
	g_pk_game_lock='{$List['g_pk_game_lock']}',
	
	g_nc_game_lock='{$List['g_nc_game_lock']}',
	g_lhc_game_lock='{$List['g_lhc_game_lock']}',
	g_xj_game_lock='{$List['g_xj_game_lock']}',
	g_jsk3_game_lock='{$List['g_jsk3_game_lock']}',
	
	g_restore_money_lock='{$List['g_restore_money_lock']}',
	g_restore_money_lock='{$List['g_restore_money_lock']}',
	g_mix_money='{$List['g_mix_money']}',
	g_max_money='{$List['g_max_money']}',
	g_odds_ratio_b1='{$List['g_odds_ratio_b1']}',
	g_odds_ratio_b2='{$List['g_odds_ratio_b2']}',
	g_odds_ratio_b3='{$List['g_odds_ratio_b3']}',
	g_odds_ratio_b4='{$List['g_odds_ratio_b4']}',
	g_odds_ratio_b5='{$List['g_odds_ratio_b5']}',
	g_odds_ratio_c1='{$List['g_odds_ratio_c1']}',
	g_odds_ratio_c2='{$List['g_odds_ratio_c2']}',
	g_odds_ratio_c3='{$List['g_odds_ratio_c3']}',
	g_odds_ratio_c4='{$List['g_odds_ratio_c4']}',
	g_odds_ratio_c5='{$List['g_odds_ratio_c5']}',
	g_odds_ratio_cq_b1='{$List['g_odds_ratio_cq_b1']}',
	g_odds_ratio_cq_b2='{$List['g_odds_ratio_cq_b2']}',
	g_odds_ratio_cq_b3='{$List['g_odds_ratio_cq_b3']}',
	g_odds_ratio_cq_c1='{$List['g_odds_ratio_cq_c1']}',
	g_odds_ratio_cq_c2='{$List['g_odds_ratio_cq_c2']}',
	g_odds_ratio_cq_c3='{$List['g_odds_ratio_cq_c3']}',
	g_odds_ratio_gx_b1='{$List['g_odds_ratio_gx_b1']}',
	g_odds_ratio_gx_b2='{$List['g_odds_ratio_gx_b2']}',
	g_odds_ratio_gx_b3='{$List['g_odds_ratio_gx_b3']}',
	g_odds_ratio_gx_b4='{$List['g_odds_ratio_gx_b4']}',
	g_odds_ratio_gx_b5='{$List['g_odds_ratio_gx_b5']}',
	g_odds_ratio_gx_c1='{$List['g_odds_ratio_gx_c1']}',
	g_odds_ratio_gx_c2='{$List['g_odds_ratio_gx_c2']}',
	g_odds_ratio_gx_c3='{$List['g_odds_ratio_gx_c3']}',
	g_odds_ratio_gx_c4='{$List['g_odds_ratio_gx_c4']}',
	g_odds_ratio_gx_c5='{$List['g_odds_ratio_gx_c5']}',
	g_login_log_lock = '{$List['g_login_log_lock']}',
	g_son_member_lock = '{$List['g_son_member_lock']}',
	g_cry_select_lock='{$List['g_cry_select_lock']}',
	g_nowrecord_lock='{$List['g_nowrecord_lock']}',
	g_automatic_bu_huo_lock='{$List['g_automatic_bu_huo_lock']}',
	g_odds_execution_lock='{$List['g_odds_execution_lock']}',
	g_up_odds_mix='{$List['g_up_odds_mix']}',
	g_odds_num='{$List['g_odds_num']}',
	g_odds_str='{$List['g_odds_str']}',
	g_up_odds_mix_pk='{$List['g_up_odds_mix_pk']}',
	g_odds_num_pk='{$List['g_odds_num_pk']}',
	g_odds_str_pk='{$List['g_odds_str_pk']}',
	g_up_odds_mix_cq='{$List['g_up_odds_mix_cq']}',
	g_odds_num_cq='{$List['g_odds_num_cq']}',
	g_odds_str_cq='{$List['g_odds_str_cq']}',
	g_up_odds_mix_gx='{$List['g_up_odds_mix_gx']}',
	g_odds_num_gx='{$List['g_odds_num_gx']}',
	g_odds_str_gx='{$List['g_odds_str_gx']}',
	g_automatic_money_lock='{$List['g_automatic_money_lock']}',
	g_automatic_open_number_lock='{$List['g_automatic_open_number_lock']}',
	g_automatic_open_number_lock='{$List['g_automatic_open_number_lock']}',
	g_automatic_open_result_lock='{$List['g_automatic_open_result_lock']}',
	g_insert_number_day='{$List['g_insert_number_day']}',
	g_close_time='{$List['g_close_time']}',
	g_out_time='{$List['g_out_time']}',
	g_open_time_gd='{$List['g_open_time_gd']}',
	g_open_time_cq='{$List['g_open_time_cq']}',
	g_open_time_gx='{$List['g_open_time_gx']}',
	g_open_time_pk='{$List['g_open_time_pk']}',
	g_game_cq_1='{$List['g_game_cq_1']}',
	g_game_cq_2='{$List['g_game_cq_2']}',
	g_game_cq_3='{$List['g_game_cq_3']}',
	g_game_cq_4='{$List['g_game_cq_4']}',
	g_game_cq_5='{$List['g_game_cq_5']}',
	g_game_cq_6='{$List['g_game_cq_6']}',
	g_game_cq_7='{$List['g_game_cq_7']}',
	
	g_game_xj_1='{$List['g_game_xj_1']}',
	g_game_xj_2='{$List['g_game_xj_2']}',
	g_game_xj_3='{$List['g_game_xj_3']}',
	g_game_xj_4='{$List['g_game_xj_4']}',
	g_game_xj_5='{$List['g_game_xj_5']}',
	g_game_xj_6='{$List['g_game_xj_6']}',
	g_game_xj_7='{$List['g_game_xj_7']}',
	
	g_game_1='{$List['g_game_1']}',
	g_game_2='{$List['g_game_2']}',
	g_game_3='{$List['g_game_3']}',
	g_game_4='{$List['g_game_4']}',
	g_game_5='{$List['g_game_5']}',
	g_game_6='{$List['g_game_6']}',
	g_game_7='{$List['g_game_7']}',
	g_game_8='{$List['g_game_8']}',
	g_game_9='{$List['g_game_9']}',
	g_game_10='{$List['g_game_10']}',
	g_game_pk_1='{$List['g_game_pk_1']}',
	g_game_pk_2='{$List['g_game_pk_2']}',
	g_game_pk_3='{$List['g_game_pk_3']}',
	g_game_gx_1='{$List['g_game_gx_1']}',
	g_game_gx_2='{$List['g_game_gx_2']}',
	g_game_gx_3='{$List['g_game_gx_3']}',
	g_game_gx_4='{$List['g_game_gx_4']}',
	g_game_gx_5='{$List['g_game_gx_5']}',
	g_game_gx_9='{$List['g_game_gx_9']}',
	
	
	g_nc_game_lock='{$List['g_nc_game_lock']}',
	g_odds_ratio_nc_b1='{$List['g_odds_ratio_nc_b1']}',
	g_odds_ratio_nc_b2='{$List['g_odds_ratio_nc_b2']}',
	g_odds_ratio_nc_b3='{$List['g_odds_ratio_nc_b3']}',
	g_odds_ratio_nc_b4='{$List['g_odds_ratio_nc_b4']}',
	g_odds_ratio_nc_b5='{$List['g_odds_ratio_nc_b5']}',
	g_odds_ratio_nc_c1='{$List['g_odds_ratio_nc_c1']}',
	g_odds_ratio_nc_c2='{$List['g_odds_ratio_nc_c2']}',
	g_odds_ratio_nc_c3='{$List['g_odds_ratio_nc_c3']}',
	g_odds_ratio_nc_c4='{$List['g_odds_ratio_nc_c4']}',
	g_odds_ratio_nc_c5='{$List['g_odds_ratio_nc_c5']}',
	g_up_odds_mix_nc='{$List['g_up_odds_mix_nc']}',
	g_odds_num_nc='{$List['g_odds_num_nc']}',
	g_odds_str_nc='{$List['g_odds_str_nc']}',
	g_open_time_nc='{$List['g_open_time_nc']}',
	
	g_up_odds_mix_xj='{$List['g_up_odds_mix_xj']}',
	g_odds_num_xj='{$List['g_odds_num_xj']}',
	g_odds_str_xj='{$List['g_odds_str_xj']}',
	 
	
	g_game_nc_1='{$List['g_game_nc_1']}',
	g_game_nc_2='{$List['g_game_nc_2']}',
	g_game_nc_3='{$List['g_game_nc_3']}',
	g_game_nc_4='{$List['g_game_nc_4']}',
	g_game_nc_5='{$List['g_game_nc_5']}',
	g_game_nc_6='{$List['g_game_nc_6']}',
	g_game_nc_7='{$List['g_game_nc_7']}',
	g_game_nc_8='{$List['g_game_nc_8']}',
	g_game_nc_9='{$List['g_game_nc_9']}',
	g_game_nc_10='{$List['g_game_nc_10']}',
	
	g_game_gx_10='{$List['g_game_gx_10']}'   
	WHERE g_id = '{$ConfigModel['g_id']}' LIMIT 1";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'Manages.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
	}
	
	
		function hybyh(){
		$.ajax({
			type : "POST",
			url : "hybyh.php",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						hybyh();
						return false;
					}
				}
			},
			success:function(data){
				if(data==1){
				alert("金额还原成功!");
				}else{
				alert("金额还原失败!");
				}
			}
		});
	}
-->
</script>
<script language="javascript">
    function check(){
    var data=document.getElementById("open_time_gd").value;
	var data2=document.getElementById("open_time_cq").value;
	var data3=document.getElementById("open_time_gx").value;
	var data5=document.getElementById("open_time_pk").value;
    if(data.substr(2,1)!=":" || data.substr(5,1)!=":"){
       alert("广东快乐十分输入的时间不合法!!");
        return false;
	}
	 if(data2.substr(2,1)!=":" || data2.substr(5,1)!=":"){
       alert("重庆时时彩输入的时间不合法!!");
        return false;
	}
	 if(data3.substr(2,1)!=":" || data3.substr(5,1)!=":"){
       alert("广西快乐十分输入的时间不合法!!");
        return false;
	}
	if(data5.substr(2,1)!=":" || data5.substr(5,1)!=":"){
       alert("北京赛车输入的时间不合法!!");
        return false;
	}
  var checkdata=data.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
  var checkdata2=data2.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
  var checkdata3=data3.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
    var checkdata5=data5.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
  if(checkdata==null)
    {
       alert("广东快乐十分请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata2==null)
    {
       alert("重庆时时彩请输入正确的时间,谢谢!!");
       return false;
    }
  if(checkdata[1]>24||checkdata[3]>60||checkdata[4]>60)
    {
       alert("广东快乐十分输入的时间不合法!!");
       return false;
    }
	if(checkdata2[1]>24||checkdata2[3]>60||checkdata2[4]>60)
    {
       alert("重庆时时彩输入的时间不合法!!");
       return false;
    }
	if(checkdata3==null)
    {
       alert("广西快乐十分请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata3[1]>24||checkdata3[3]>60||checkdata3[4]>60)
    {
       alert("广西快乐十分输入的时间不合法!!");
       return false;
    }
	if(checkdata5==null)
    {
       alert("北京赛车请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata5[1]>24||checkdata5[3]>60||checkdata5[4]>60)
    {
       alert("北京赛车输入的时间不合法!!");
       return false;
    }
   return isForm();
}
</script>
</head>
<body>
<form action="" method="post" onsubmit="return isForm()">
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;系統設置</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">系統設置</th>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">網站開啟:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_web_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio"  name="web_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_web_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="web_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:60px">
                                	<td class="bj">關閉提示語:</td>
                                	<td class="left_p6"><textarea style="height:50px;color:red" name="web_text"><?php echo$ConfigModel['g_web_text']?></textarea></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">彩種開啟:</td>
                                    <td class="left_p6">
                                    廣東快樂十分&nbsp;<input <?php if($ConfigModel['g_kg_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="kg_game_lock" value="1" />&nbsp;&nbsp;
                                    重慶時時彩&nbsp;<input style="position:relative;top:2px" type="checkbox" name="cq_game_lock" <?php if($ConfigModel['g_cq_game_lock']==1){echo 'checked="checked"';}?> value="1" />
									<!-- 廣西快樂十分&nbsp;<input <?php if($ConfigModel['g_gx_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="gx_game_lock" value="1" />-->
									 &nbsp;&nbsp;
									 北京赛车(pk10)&nbsp;<input style="position:relative;top:2px" type="checkbox" name="pk_game_lock" <?php if($ConfigModel['g_pk_game_lock']==1){echo 'checked="checked"';}?> value="1" />
									 幸運農場&nbsp;<input style="position:relative;top:2px" type="checkbox" name="nc_game_lock" <?php if($ConfigModel['g_nc_game_lock']==1){echo 'checked="checked"';}?> value="1" />
									  <!--  六合彩&nbsp;<input style="position:relative;top:2px" type="checkbox" name="lhc_game_lock" <?php if($ConfigModel['g_lhc_game_lock']==1){echo 'checked="checked"';}?> value="1" />-->
									  <!--  新疆時時彩&nbsp;<input style="position:relative;top:2px" type="checkbox" name="xj_game_lock" <?php if($ConfigModel['g_xj_game_lock']==1){echo 'checked="checked"';}?> value="1" />-->
									  江苏骰寶(快3)&nbsp;<input style="position:relative;top:2px" type="checkbox" name="jsk3_game_lock" <?php if($ConfigModel['g_jsk3_game_lock']==1){echo 'checked="checked"';}?> value="1" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj"><b>廣東快樂十分:</b></td>
                                    <td class="left_p6">
                                    第一球&nbsp;<input <?php if($ConfigModel['g_game_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_1" value="1" />&nbsp;&nbsp;
                                    第二球&nbsp;<input <?php if($ConfigModel['g_game_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_2" value="1" />&nbsp;&nbsp;
                                    		 第三球&nbsp;<input <?php if($ConfigModel['g_game_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_3" value="1" />&nbsp;&nbsp;
                                    第四球&nbsp;<input <?php if($ConfigModel['g_game_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_4" value="1" />&nbsp;&nbsp;
                                    第五球&nbsp;<input <?php if($ConfigModel['g_game_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_5" value="1" />&nbsp;&nbsp;
                                    第六球&nbsp;<input <?php if($ConfigModel['g_game_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_6" value="1" />&nbsp;&nbsp;
                                    第七球&nbsp;<input <?php if($ConfigModel['g_game_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_7" value="1" />&nbsp;&nbsp;
                                    第八球&nbsp;<input <?php if($ConfigModel['g_game_8']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_8" value="1" />&nbsp;&nbsp;
                                    總分龍虎&nbsp;<input <?php if($ConfigModel['g_game_9']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_9" value="1" />&nbsp;&nbsp;
                                    連碼&nbsp;<input <?php if($ConfigModel['g_game_10']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_10" value="1" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">B盤:</td>
                                	<td class="left_p6">
                                		1-8號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_b1" value="<?php echo$ConfigModel['g_odds_ratio_b1']?>" />&nbsp;
                                		1-8方位:&nbsp;<input type="text" class="textc" name="odds_ratio_b2" value="<?php echo$ConfigModel['g_odds_ratio_b2']?>" />&nbsp;
                                		1-8中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_b3" value="<?php echo$ConfigModel['g_odds_ratio_b3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_b4" value="<?php echo$ConfigModel['g_odds_ratio_b4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_b5" value="<?php echo$ConfigModel['g_odds_ratio_b5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">C盤:</td>
                                	<td class="left_p6">
                                		1-8號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_c1" value="<?php echo$ConfigModel['g_odds_ratio_c1']?>" />&nbsp;
                                		1-8方位:&nbsp;<input type="text" class="textc" name="odds_ratio_c2" value="<?php echo$ConfigModel['g_odds_ratio_c2']?>" />&nbsp;
                                		1-8中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_c3" value="<?php echo$ConfigModel['g_odds_ratio_c3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_c4" value="<?php echo$ConfigModel['g_odds_ratio_c4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_c5" value="<?php echo$ConfigModel['g_odds_ratio_c5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    連續值&nbsp;<input class="textc" style="width:50px" type="text" name="up_odds_mix" value="<?php echo$ConfigModel['g_up_odds_mix']?>" />&nbsp;&nbsp;
                                    		1-8球總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_num" value="<?php echo$ConfigModel['g_odds_num']?>" />&nbsp;&nbsp;
                                    		雙面總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_str" value="<?php echo$ConfigModel['g_odds_str']?>" />&nbsp;&nbsp;
                                    		<span class="odds">超出連續值以設置的總值累加，執行賠率變動。</span>
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj"><b>重慶時時彩:</b></td>
                                    <td class="left_p6">
                                    第一球&nbsp;<input <?php if($ConfigModel['g_game_cq_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_1" value="1" />&nbsp;&nbsp;
                                    第二球&nbsp;<input <?php if($ConfigModel['g_game_cq_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_2" value="1" />&nbsp;&nbsp;
                                    		 第三球&nbsp;<input <?php if($ConfigModel['g_game_cq_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_3" value="1" />&nbsp;&nbsp;
                                    第四球&nbsp;<input <?php if($ConfigModel['g_game_cq_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_4" value="1" />&nbsp;&nbsp;
                                    第五球&nbsp;<input <?php if($ConfigModel['g_game_cq_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_5" value="1" />&nbsp;&nbsp;
                                    總分龍虎&nbsp;<input <?php if($ConfigModel['g_game_cq_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_6" value="1" />&nbsp;&nbsp;
                                    前三、中三、后三&nbsp;<input <?php if($ConfigModel['g_game_cq_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_7" value="1" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">B盤:</td>
                                	<td class="left_p6">
                                		1-5號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_b1" value="<?php echo$ConfigModel['g_odds_ratio_cq_b1']?>" />&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_b2" value="<?php echo$ConfigModel['g_odds_ratio_cq_b2']?>" />&nbsp;&nbsp;
                                		前三、中三、后三:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_b3" value="<?php echo$ConfigModel['g_odds_ratio_cq_b3']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">C盤:</td>
                                	<td class="left_p6">
                                		1-5號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_c1" value="<?php echo$ConfigModel['g_odds_ratio_cq_c1']?>" />&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_c2" value="<?php echo$ConfigModel['g_odds_ratio_cq_c2']?>" />&nbsp;&nbsp;
                                		前三、中三、后三:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_c3" value="<?php echo$ConfigModel['g_odds_ratio_cq_c3']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    連續值&nbsp;<input class="textc" style="width:50px" type="text" name="up_odds_mix_cq" value="<?php echo$ConfigModel['g_up_odds_mix_cq']?>" />&nbsp;&nbsp;
                                    		1-5球總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_num_cq" value="<?php echo$ConfigModel['g_odds_num_cq']?>" />&nbsp;&nbsp;
                                    		雙面總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_str_cq" value="<?php echo$ConfigModel['g_odds_str_cq']?>" />&nbsp;&nbsp;
                                    		<span class="odds">超出連續值以設置的總值累加，執行賠率變動。</span>
                                    </td>
                                </tr>
								
								<? /*
								 <tr style="height:28px">
                                	<td class="bj"><b>新疆時時彩:</b></td>
                                    <td class="left_p6">
                                    第一球&nbsp;<input <?php if($ConfigModel['g_game_xj_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_1" value="1" />&nbsp;&nbsp;
                                    第二球&nbsp;<input <?php if($ConfigModel['g_game_xj_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_2" value="1" />&nbsp;&nbsp;
                                    		 第三球&nbsp;<input <?php if($ConfigModel['g_game_xj_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_3" value="1" />&nbsp;&nbsp;
                                    第四球&nbsp;<input <?php if($ConfigModel['g_game_xj_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_4" value="1" />&nbsp;&nbsp;
                                    第五球&nbsp;<input <?php if($ConfigModel['g_game_xj_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_5" value="1" />&nbsp;&nbsp;
                                    總分龍虎&nbsp;<input <?php if($ConfigModel['g_game_xj_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_6" value="1" />&nbsp;&nbsp;
                                    前三、中三、后三&nbsp;<input <?php if($ConfigModel['g_game_xj_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xj_7" value="1" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                 
                                <tr style="height:28px">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    連續值&nbsp;<input class="textc" style="width:50px" type="text" name="up_odds_mix_xj" value="<?php echo$ConfigModel['g_up_odds_mix_xj']?>" />&nbsp;&nbsp;
                                    		1-5球總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_num_xj" value="<?php echo$ConfigModel['g_odds_num_xj']?>" />&nbsp;&nbsp;
                                    		雙面總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_str_xj" value="<?php echo$ConfigModel['g_odds_str_xj']?>" />&nbsp;&nbsp;
                                    		<span class="odds">超出連續值以設置的總值累加，執行賠率變動。</span>
                                    </td>
                                </tr>
								
								
								<tr style="height:28px;">
                                	<td class="bj"><b>廣西快樂十分:</b></td>
                                    <td class="left_p6">
                                    第一球&nbsp;<input <?php if($ConfigModel['g_game_gx_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_1" value="1" />&nbsp;&nbsp;
                                    第二球&nbsp;<input <?php if($ConfigModel['g_game_gx_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_2" value="1" />&nbsp;&nbsp;
                                    		 第三球&nbsp;<input <?php if($ConfigModel['g_game_gx_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_3" value="1" />&nbsp;&nbsp;
                                    第四球&nbsp;<input <?php if($ConfigModel['g_game_gx_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_4" value="1" />&nbsp;&nbsp;
                                    特码&nbsp;<input <?php if($ConfigModel['g_game_gx_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_5" value="1" />&nbsp;&nbsp;
                                   
                                    總分龍虎&nbsp;<input <?php if($ConfigModel['g_game_gx_9']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_9" value="1" />&nbsp;&nbsp;
                                    連碼&nbsp;<input <?php if($ConfigModel['g_game_gx_10']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gx_10" value="1" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">B盤:</td>
                                	<td class="left_p6">
                                		1-5號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_b1" value="<?php echo$ConfigModel['g_odds_ratio_gx_b1']?>" />&nbsp;
                                		1-5方位:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_b2" value="<?php echo$ConfigModel['g_odds_ratio_gx_b2']?>" />&nbsp;
                                		1-5中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_b3" value="<?php echo$ConfigModel['g_odds_ratio_gx_b3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_b4" value="<?php echo$ConfigModel['g_odds_ratio_gx_b4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_b5" value="<?php echo$ConfigModel['g_odds_ratio_gx_b5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">C盤:</td>
                                	<td class="left_p6">
                                		1-5號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_c1" value="<?php echo$ConfigModel['g_odds_ratio_gx_c1']?>" />&nbsp;
                                		1-5方位:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_c2" value="<?php echo$ConfigModel['g_odds_ratio_gx_c2']?>" />&nbsp;
                                		1-5中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_c3" value="<?php echo$ConfigModel['g_odds_ratio_gx_c3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_c4" value="<?php echo$ConfigModel['g_odds_ratio_gx_c4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_gx_c5" value="<?php echo$ConfigModel['g_odds_ratio_gx_c5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px;display:none;">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    連續值&nbsp;<input class="textc" style="width:50px" type="text" name="up_odds_mix_gx" value="<?php echo$ConfigModel['g_up_odds_mix_gx']?>" />&nbsp;&nbsp;
                                    		1-5球總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_num_gx" value="<?php echo$ConfigModel['g_odds_num_gx']?>" />&nbsp;&nbsp;
                                    		雙面總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_str_gx" value="<?php echo$ConfigModel['g_odds_str_gx']?>" />&nbsp;&nbsp;
                                    		<span class="odds">超出連續值以設置的總值累加，執行賠率變動。</span>
                                    </td>
                                </tr>
								*/ ?>
								
								 <tr style="height:28px">
                                	<td class="bj"><b>幸运农场:</b></td>
                                    <td class="left_p6">
                                    第一球&nbsp;<input <?php if($ConfigModel['g_game_nc_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_1" value="1" />&nbsp;&nbsp;
                                    第二球&nbsp;<input <?php if($ConfigModel['g_game_nc_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_2" value="1" />&nbsp;&nbsp;
                                    		 第三球&nbsp;<input <?php if($ConfigModel['g_game_nc_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_3" value="1" />&nbsp;&nbsp;
                                    第四球&nbsp;<input <?php if($ConfigModel['g_game_nc_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_4" value="1" />&nbsp;&nbsp;
                                    第五球&nbsp;<input <?php if($ConfigModel['g_game_nc_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_5" value="1" />&nbsp;&nbsp;
                                    第六球&nbsp;<input <?php if($ConfigModel['g_game_nc_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_6" value="1" />&nbsp;&nbsp;
                                    第七球&nbsp;<input <?php if($ConfigModel['g_game_nc_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_7" value="1" />&nbsp;&nbsp;
                                    第八球&nbsp;<input <?php if($ConfigModel['g_game_nc_8']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_8" value="1" />&nbsp;&nbsp;
                                    總分龍虎&nbsp;<input <?php if($ConfigModel['g_game_nc_9']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_9" value="1" />&nbsp;&nbsp;
                                    連碼&nbsp;<input <?php if($ConfigModel['g_game_nc_10']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_10" value="1" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">B盤:</td>
                                	<td class="left_p6">
                                		1-8號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_b1" value="<?php echo$ConfigModel['g_odds_ratio_nc_b1']?>" />&nbsp;
                                		1-8方位:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_b2" value="<?php echo$ConfigModel['g_odds_ratio_nc_b2']?>" />&nbsp;
                                		1-8中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_b3" value="<?php echo$ConfigModel['g_odds_ratio_nc_b3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_b4" value="<?php echo$ConfigModel['g_odds_ratio_nc_b4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_b5" value="<?php echo$ConfigModel['g_odds_ratio_nc_b5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px; display:none">
                                	<td class="bj">C盤:</td>
                                	<td class="left_p6">
                                		1-8號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_c1" value="<?php echo$ConfigModel['g_odds_ratio_nc_c1']?>" />&nbsp;
                                		1-8方位:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_c2" value="<?php echo$ConfigModel['g_odds_ratio_nc_c2']?>" />&nbsp;
                                		1-8中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_c3" value="<?php echo$ConfigModel['g_odds_ratio_nc_c3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_c4" value="<?php echo$ConfigModel['g_odds_ratio_nc_c4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_nc_c5" value="<?php echo$ConfigModel['g_odds_ratio_nc_c5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    連續值&nbsp;<input class="textc" style="width:50px" type="text" name="up_odds_mix_nc" value="<?php echo$ConfigModel['g_up_odds_mix_nc']?>" />&nbsp;&nbsp;
                                    		1-8球總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_num_nc" value="<?php echo$ConfigModel['g_odds_num_nc']?>" />&nbsp;&nbsp;
                                    		雙面總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_str_nc" value="<?php echo$ConfigModel['g_odds_str_nc']?>" />&nbsp;&nbsp;
                                    		<span class="odds">超出連續值以設置的總值累加，執行賠率變動。</span>
                                    </td>
                                </tr>
							
								
								<tr style="height:28px">
                                	<td class="bj"><b>北京赛车(PK10):</b></td>
                                    <td class="left_p6">
                                    冠、亞軍 組合&nbsp;<input <?php if($ConfigModel['g_game_pk_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_1" value="1" />&nbsp;&nbsp;
                                    三、四、伍、六名&nbsp;<input <?php if($ConfigModel['g_game_pk_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_2" value="1" />&nbsp;&nbsp;
                                    七、八、九、十名&nbsp;<input <?php if($ConfigModel['g_game_pk_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_3" value="1" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                
                                <tr style="height:28px">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    連續值&nbsp;<input class="textc" style="width:50px" type="text" name="up_odds_mix_pk" value="<?php echo$ConfigModel['g_up_odds_mix_pk']?>" />
                                    &nbsp;&nbsp;
                                    		1-10名總值&nbsp;
                                    		<input class="textc" style="width:50px" type="text" name="odds_num_pk" value="<?php echo$ConfigModel['g_odds_num_pk']?>" />&nbsp;&nbsp;
                                    		雙面總值&nbsp;<input class="textc" style="width:50px" type="text" name="odds_str_pk" value="<?php echo$ConfigModel['g_odds_str_pk']?>" />&nbsp;&nbsp;
                                    		<span class="odds">超出連續值以設置的總值累加，執行賠率變動。</span>
                                    </td>
                                </tr>
								
                                <tr style="height:28px">
                                	<td class="bj">金額還原:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_restore_money_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="restore_money_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_restore_money_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="restore_money_lock" value="0" />
                                    <input type="button" onclick="hybyh();" value="手动还原" />								
									</td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">最低下注金額:</td>
                                    <td class="left_p6"><input class="textc" type="text" name="mix_money" value="<?php echo$ConfigModel['g_mix_money']?>" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">最高派彩:</td>
                                    <td class="left_p6"><input class="textc" type="text" name="max_money" value="<?php echo$ConfigModel['g_max_money']?>" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">日誌保存:</td>
                                    <td class="left_p6">
                                    	<input class="textc" type="text" name="login_log_lock" value="<?php echo$ConfigModel['g_login_log_lock']?>" />&nbsp;&nbsp;
                                    	<span class="odds">系統將會自動刪除超出天數的日誌。</span>
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">過期時間:</td>
                                    <td class="left_p6">
                                    	<input class="textc" type="text" name="out_time" value="<?php echo$ConfigModel['g_out_time']?>" />&nbsp;&nbsp;
                                    	<span class="odds">分鐘</span>
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">直屬會員:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_son_member_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="son_member_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_son_member_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="son_member_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">報表查詢:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_cry_select_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="cry_select_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_cry_select_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="cry_select_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">即時注單:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_nowrecord_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="nowrecord_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_nowrecord_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="nowrecord_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">自動補倉:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_automatic_bu_huo_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_bu_huo_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_automatic_bu_huo_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_bu_huo_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">動態賠率:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_odds_execution_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="odds_execution_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_odds_execution_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="odds_execution_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">自動結算:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_automatic_money_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_money_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_automatic_money_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_money_lock" value="0" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">自動開盤:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_automatic_open_number_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_number_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_automatic_open_number_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_number_lock" value="0" />&nbsp;&nbsp;
                                    		<span class="red">（此項關閉后，自動結算、動態賠率、自動加載期數、封盤時間、功能將失效）</span>
                                    </td>
                                </tr>
								 <tr style="height:28px">
                                	<td class="bj">自動開獎:</td>
                                    <td class="left_p6">
                                    開啟&nbsp;<input <?php if($ConfigModel['g_automatic_open_result_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_result_lock" value="1" />&nbsp;&nbsp;
                                    關閉&nbsp;<input <?php if($ConfigModel['g_automatic_open_result_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_result_lock" value="0" />&nbsp;&nbsp;
                                    		<span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span>
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">自動加載期數:</td>
                                    <td class="left_p6">
                                    	<input class="textc" type="text" name="insert_number_day" style="width:30px" value="<?php echo$ConfigModel['g_insert_number_day']?>" />&nbsp;&nbsp;
                                    	<span class="odds">以相隔天數計算</span>
                                    </td>
                                </tr>
								<tr style="height:28px">
                                	<td class="bj">每天开盤時間:</td>
                                    <td class="left_p6">
                                    	<span class="odds">廣東快樂十分:</span>&nbsp;<input class="textc" type="text" name="open_time_gd" id="open_time_gd" style="width:90px" value="<?php echo$ConfigModel['g_open_time_gd']?>" />&nbsp;&nbsp;
                                    	<span class="odds">重慶時時彩:</span>&nbsp;<input class="textc" type="text" name="open_time_cq"  id="open_time_cq"  style="width:90px" value="<?php echo$ConfigModel['g_open_time_cq']?>" />&nbsp;&nbsp;
										<span class="odds">江苏快3:</span><input class="textc" type="text" name="open_time_gx" id="open_time_gx" style="width:90px;" value="<?php echo$ConfigModel['g_open_time_gx']?>"  />
										<span class="odds">北京赛车(pk10):</span>&nbsp;<input class="textc" type="text" name="open_time_pk"  id="open_time_pk"  style="width:90px" value="<?php echo$ConfigModel['g_open_time_pk']?>" />&nbsp;&nbsp;
										<span class="odds">幸运农场:</span>&nbsp;<input class="textc" type="text" name="open_time_nc"  id="open_time_nc"  style="width:90px" value="<?php echo$ConfigModel['g_open_time_nc']?>" />&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">封盤時間:</td>
                                    <td class="left_p6">
                                    	<input class="textc" type="text" name="close_time" style="width:30px" value="<?php echo$ConfigModel['g_close_time']?>" />&nbsp;&nbsp;
                                    	<span class="odds">以開獎時間分鐘計算</span>&nbsp;
                                    	<span class="red">（封盤時間更變當天不會生效）</span>
                                    </td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確認更變" /></td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            <td width="6" bgcolor="#1873aa"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_59.gif" alt="" /></td>
            <td bgcolor="#1873aa"></td>
            <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_62.gif" alt="" /></td>
        </tr>
    </table>
</form>
</body>
</html>