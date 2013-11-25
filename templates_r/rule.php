<?php
$tid = 1;
if (!isset($_GET['tid'])) {
    $tid = 1;
} else {
    $tid = $_GET['tid'];
}

switch ($tid) {
    case 1:
        $rule_html = 'rule_klc.html';
        break;
    case 2:
        $rule_html = 'rule_ssc.html';
        break;
    case 6:
        $rule_html = 'rule_pk.html';
        break;
    case 5:
        $rule_html = 'rule_nc.html';
        break;
    case 4:
        $rule_html = 'rule_k3.html';
        break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script>
        var win_height = window.innerHeight;
        $("#layout").css('height',win_height+'px');
    </script>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
</head>
<body id="layout">
    <?php
        include($rule_html);
    ?>
</body>
</html>