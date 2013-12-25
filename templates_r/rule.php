<?php
$tid = 1;
if (!isset($_GET['tid'])) {
    if ((isset($_SESSION['cq']) && $_SESSION['cq'] == true))
        $tid= 2;
    else if ((isset($_SESSION['gx']) && $_SESSION['gx'] == true))
        $tid= 3;
    else if ((isset($_SESSION['nc']) && $_SESSION['nc'] == true))
        $tid= 5;
    else if ((isset($_SESSION['pk']) && $_SESSION['pk'] == true))
        $tid= 6;
    else if ((isset($_SESSION['lhc']) && $_SESSION['lhc'] == true))
        $tid= 7;
    else if ((isset($_SESSION['xj']) && $_SESSION['xj'] == true))
        $tid= 8;
    else if ((isset($_SESSION['jsk3']) && $_SESSION['jsk3'] == true))
        $tid= 9;
    else {

    }
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