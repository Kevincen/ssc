/**
 * Created by koovincen on 13-11-1.
 * @depends tw_cn.js
 * @describe 默认简体，字体转换
 */
$(document).ready(function(){
    translation("http://192.168.1.102","");
});

function translation(domain_addr,toggle_id) {
    $('body').append("<a id='no_use' style='display: none'></a>");
        translateInitilization();
        $("body").show();
        $("frame").show();
}
