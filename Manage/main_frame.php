<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-2-16
 * Time: 下午3:44
 */
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
define('Copyright', '作者QQ:1834219632');
/*include_once ROOT_PATH . 'function/cheCookie.php';
if (!isset($_SESSION['code'])) {
    echo "code erro";
    exit;
    exit(href('/Manage/Quit.php'));
} else {
    unset($_SESSION['code']);
}*/

//获取有效线路
$host = array();
foreach ($dHome as $key => $line) {
    if (!empty($line) && !empty($dPort[$key])) {
        if ($dPort[$key] == '80') {
            $host[] = 'http://' . $line;
        } else {
            $host[] = 'http://' . $line . ':' . $dPort[$key];
        }
    }
}
$login_name = isset($loginName)?$loginName:base64_decode($_COOKIE['manage_user']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $login_name; ?> - <?php echo $Title_cn; ?></title>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <link id="css_link" type="text/css" rel="stylesheet" href="/templates_cn/css/skin.css">
    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body class="skin_red">

<?php

$name=$loginName;
$sql = "SELECT * FROM `g_rank` WHERE `g_name` = '{$name}' AND `g_pwd` = 1 LIMIT 1 ";
$result = $db->query($sql, 1);
if ($result)
{
    //判斷帳號是否需要重新设置密码
    alert('你是首次登陆或者上级更改密码，需要修改密码！');
    ?>

    <body>
    <iframe src="/Manage/temp/UpdatePwd_first.php" name="mainFrame" scrolling="No" noresize="noresize" id="mainFrame" width="100%" height="300px" frameborder="no" border="0" framespacing="0"/>
    </body>
    <?php
    //include_once ROOT_PATH.'Manage/temp/UpdatePwd_first.php';
}else{
?>
<iframe src="/Manage/main.php" style="width:100%; height:100%; border:0;" scrolling="no"></iframe>
<div id="lineSelectBox" style="display:none;">
    <ul>
        <?php foreach ($host as $link_key => $link) { ?>
            <li>
                <span class="linetitle">线路<?php echo $link_key + 1; ?>:&nbsp;</span><span class="timebox">反应时间:<font
                        id="<?php echo $link_key; ?>m" style="color:red;"></font></span>
                <a href="<?php echo $link; ?>" onclick="return false;">选择</a>
            </li>
        <?php } ?>
    </ul>
    <div style="clear: both;"><font color="red">提示:</font>反应时间越小，网速越快。</div>
</div>
<div id="speed" style="display:none"></div>
<script type="text/javascript">

    var Dialog = null;
    //显示测速
    function ShowLinkBox() {
        var left_distance = document.body.scrollWidth - 300;
        Dialog = art.dialog({
            id: 'LinkBox',
            title: false,
            content: document.getElementById('lineSelectBox'),
            resize: false,
            drag: false,
            fixed: true,
            width: 268,
            padding: 0,
            left: left_distance,
            top: 50,
            button: [
                {
                    name: '测速',
                    callback: function () {
                        test(0);
                        return false;
                    }
                }
            ],
            cancel: true,
            cancelVal: '关闭',
            close: function () {
                Dialog = null;
            }

        });
        test(0);
    }

    //线路切换
    $(function () {
        $("#lineSelectBox li a").click(function () {
            var n_link = $(this).attr("href");
            if (n_link != '') {
                n_link = n_link + "/index.php?version=agent";
                //alert('功能未完成！');
                window.location = n_link;
            }
        });
    });

    //测速
    var li = $("#lineSelectBox li"), count = 0;
    var speed = document.getElementById('speed');
    var cache = [], timeout = null;
    var cacheImg = function () {
        var cid = '';
        for (var c = 0; c < li.length; c++) {
            var clink = {}
            cid = c + '';
            clink.img = document.createElement('img');
            clink.url = li[c].getElementsByTagName("a")[0].href.split('/').slice(0, 3).join('/') + "/speed.gif?";
            clink.time = 0;
            clink.number = 0;
            clink.img.onerror = getError;
            clink.img.onload = getLoad;
            clink.img.id = cid;
            clink.loadTime = [];
            clink.stop = false;
            cache[c] = clink;
        }
    }
    //清除文字
    var clear = function (c) {
        clearTimeout(timeout);
        timeout = null;
        if (!c) {
            for (var i = li.length - 1; i >= 0; i--) {
                if (li[i].getElementsByTagName('font').length) {
                    li[i].getElementsByTagName('font')[0].innerHTML = '';
                }
            }
            ;
        }
        ;
    }
    var test = function (c) {
        clear(c);
        if (Dialog != null) {
            art.dialog({id: 'LinkBox'}).button({
                name: '测速',
                disabled: true
            });
        }

        var cid = "";
        if (cache.length > 0 && cache[c]) {
            li[c].getElementsByTagName("font")[0].innerHTML = "测速中";
            cache[c].img.src = cache[c].url + (Math.random() + '').replace('0.', '');
            speed.appendChild(cache[c].img);
            cache[c].time = new Date().getTime();
            cache[c].stop = false;
            timeout = setTimeout(function () {
                getError.call(cache[c].img, c);
            }, 5000);
        }
        else {
            if (Dialog != null) {
                art.dialog({id: 'LinkBox'}).button({
                    name: '测速',
                    disabled: false
                });
            }
        }
        ;
    }

    function getError(c) {
        var n = this.id;
        if (typeof c === 'number') {
            n = c;
        }
        ;
        n = parseInt(n, 10);
        if (document.getElementById(this.id + 'm')) {
            if (!cache[parseInt(n, 10)].stop) {
                cache[parseInt(n, 10)].number = 0;
                cache[parseInt(n, 10)].stop = true;
                if (document.getElementById(n + 'm').innerHTML == '测速中') {
                    document.getElementById(n + 'm').innerHTML = '无法链接';
                }
            }
            ;
            setTimeout(function () {
                test(n + 1);
            }, 500);
        }
    }
    function getLoad() {
        var end = new Date().getTime(),
            cid = parseInt(this.id, 10),
            clink = cache[cid],
            td = clink.number ? end - cache[cid].time : end - cache[cid].time,
            total = 0;
        cache[cid].loadTime.push(td);
        cache[cid].number += 1;
        if (cache[cid].stop) {
            return;
        }
        if (cache[cid].number < 2) {
            setTimeout(function () {
                test(cid);
            }, 500);
        }
        else {
            for (var c = 0; c < 2; c++) {
                total += clink.loadTime[c];
            }
            document.getElementById(cid + 'm').innerHTML = (total / 2).toFixed(2) + '毫秒';
            count -= 1;
            cache[cid].number = 0;
            cache[cid].loadTime.length = 0;
            cache[cid].stop = true;
            setTimeout(function () {
                test(cid + 1);
            }, 500);
        }
    }
    cacheImg();
</script>


</body>
<?php }?>
</html>
