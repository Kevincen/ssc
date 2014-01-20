<?php
/**
 *
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-18
 * Time: 下午2:39
 */

include_once 'GameType.php';
include_once 'ReportView.php';

class ReportTypeView extends ReportView
{
    public $type;

    function __construct($type)  {
        $this->type = $type;
    }

    public function show() {

    }
}

