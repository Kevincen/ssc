<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-18
 * Time: 下午2:28
 */

include_once './ReportView.php';

class ReportUserView extends ReportView
{
    public $user;

    function __construct ($user) {
        $this->user = $user;
        $this->user->get_my_sons();
    }

    public function show() {

    }

}

class FGSView extends ReportUserView
{
    private function gen_table($content) {
        $next_rank_name = User_info::$cid_rank_array[$this->user->cid +1];
        $prev_rank_name = User_info::$cid_rank_array[$this->user->cid -1];
        $caption=
            '<tr>
                <th>序号</th>
                <th>名称</th>
                <th>'.$next_rank_name.'</th>
            <th>注数</th>
            <th>下注金额</th>
            <th>会员盈亏</th>
            <th>占成上缴</th>
            <th class="sh1">'.$next_rank_name.'金额</th>
            <th class="sh1">'.$next_rank_name.'佣金</th>
            <th class="hc" id="sh1">'.$next_rank_name.'上缴</th>
            <th>占成%</th>
            <th>本级占成</th>
            <th class="sh2">'.$this->user->rank_name.'奖金</th>
            <th class="sh2">佣金</th>
            <th>佣金差</th>
            <th class="hc" id="sh2">'.$this->user->rank_name.'盈亏</th>
            <th>上级占成</th>
            <th class="sh3">'.$prev_rank_name.'金额</th>
            <th class="sh3">'.$prev_rank_name.'佣金</th>
            <th class="hc" id="sh3">上缴'.$prev_rank_name.'</th>
        </tr>';
        $table_html = '
 <div id="agent-reportForm" class="reportForm-table">
    <table class="bet-table z3-table">
        <thead>
        '.$caption.'
        </thead>
        '.$content.'
    </table>
</div>';
        return $table_html;

    }
    private function gen_content() {

        $rows = '';
        $sonlist = $this->user->son;
        $counter = 0;
        foreach ($sonlist as $son) {
            $counter++;
            $son_name = $son->my_account_id;
            $son_name .= $son->cid == 0? '.会员':'';
            $rows .= '
                <tr class="">
                    <td>'.$counter.'</td>
                    <td>
                        <a name="user" account_id="'.$son->my_account_id.'" cid="'.$son->cid.'">
                        '.$son_name.'
                        </a>
                    </td>
                    <td>'.$son->my_name.'</td>
                    <td><span>12</span></td>
                    <td><span>24</span></td>
                    <td><span>1</span></td>
                    <td><span>-</span></td>
                    <td class="sh1"><span>-</span></td>
                    <td class="sh1"><span>-</span></td>
                    <td class="col1"><span>-</span></td>
                    <td>0</td>
                    <td><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td class="sh2"><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="col1"><span class="win">0</span></td>
                    <td><span>24</span></td>
                    <td class="sh3"><span>-1</span></td>
                    <td class="sh3"><span>0</span></td>
                    <td class="col1"><span>-1</span></td>
                </tr>
            ';
        }


        $content ='
        <tbody>
        '.$rows.'
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td><span class="bluer">总计</span></td>
            <td><span>12</span></td>
            <td><span>24</span></td>
            <td><span>1</span></td>
            <td><span>0</span></td>
            <td class="sh1"><span>0</span></td>
            <td class="sh1"><span>0</span></td>
            <td class="col1"><span>0</span></td>
            <td>-</td>
            <td><span>0</span></td>
            <td class="sh2"><span>0</span></td>
            <td class="sh2"><span>0</span></td>
            <td><span>0</span></td>
            <td class="col1"><span class="win">0</span></td>
            <td><span>24</span></td>
            <td class="sh3"><span>-1</span></td>
            <td class="sh3"><span>0</span></td>
            <td class="col1"><span>-1</span></td>
        </tr>
        </tfoot>
        ';

        return $content;
    }
    public function show() {
        $content = $this->gen_content();
        $html = $this->gen_table($content);
        echo $html;
    }

}
class GDView extends ReportUserView
{

}
class ZDLView extends ReportUserView
{

}
class DLView extends ReportUserView
{


}
class HYView extends ReportUserView
{

}
class UnnameView extends ReportUserView//显示日期那个页面
{

}
