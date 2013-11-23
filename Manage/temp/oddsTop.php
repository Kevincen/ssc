<?php
echo '<div id="supervision_nav" class="supervision_nav sv_nav_klc klc"><p class="today_info"><strong>今天输赢：<span
                        id="win" class=" bold">0</span></strong><strong>【<span class="dgreen2 letter_space3 bold"
                                                                               id="number"></span>】<span
                        class="ggray">期</span> &nbsp;&nbsp;&nbsp;距离封盘：<span class="bluer letter_space2 bold"
                                                                            id="offTime" nc="264">加载中...</span>
                                                                            &nbsp;&nbsp;&nbsp;距离开奖：<span
                        class="reder letter_space2" id="EndTime" nc="359">05:59</span></strong><strong
                    class="resultnum-str">【<span class="bluer letter_space3 bold" id="q_number">加载中...</span>】<span
                        class="ggray">期</span>&nbsp;&nbsp;&nbsp;开奖号码：
                        <span class="reder resultnum" id="resultnum">
                            <span id="q_a" class="number num16"></span>
                            <span id="q_b" class="number num17"></span>
                            <span id="q_c" class="number num19"></span>
                            <span id="q_d" class="number num11"></span>
                            <span id="q_e" class="number num2"></span>
                            <span id="q_f" class="number num4"></span>
                            <span id="q_g" class="number num8"></span>
                            <span id="q_h" class="number num6"></span>
                            </span>
                            </strong>
                            </p>
            <ul>
                <li class="red '.(isset($g)?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php\')" id="sumDT">正码-总和</li>
                <li class="red '.($types != '第一球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=1\')" id="ball1">第一球</li>
                <li class="red '.($types != '第二球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=2\')" id="ball2">第二球</li>
                <li class="red '.($types != '第三球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=3\')" id="ball3">第三球</li>
                <li class="red '.($types != '第四球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=4\')" id="ball4">第四球</li>
                <li class="red '.($types != '第五球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=5\')" id="ball5">第五球</li>
                <li class="red '.($types != '第六球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=6\')" id="ball6">第六球</li>
                <li class="red '.($types != '第七球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=7\')" id="ball7">第七球</li>
                <li class="red '.($types != '第八球'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile.php?cid=8\')" id="ball8">第八球</li>
                <li class="red '.($types != '连码'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/oddsFile_LM.php?cid=10\')" id="evenCode">连码</li>
                <li class="red '.($types != '账单'?'':'active').'" onclick="Actfor_load(\'/Manage/temp/Reckoning.php?tid=1\')" id="lizhangdan">账单</li>
            </ul>
        </div>
';
?>
