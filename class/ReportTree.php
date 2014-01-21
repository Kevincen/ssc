<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-1-19
 * Time: 下午2:25
 * To change this template use File | Settings | File Templates.
 */



class ReportNode {
    public $parent;
    function __construct($parent) {
        $this->parent = $parent;
    }
}

class ReportTree extends ReportNode {
    public $children = array();
    function __construct($parent) {
        parent::__construct($parent);
    }
    public function findChild($key, $value) {
        foreach ($this->children as $child) {
            if ($child->$key == $value) {
                return $child;
            }
        }
        return NULL;
    }
}
