<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-1-19
 * Time: 下午2:32
 * To change this template use File | Settings | File Templates.
 */

include_once 'ReportTree.php';
include_once 'zhudan.php';

class DataField {
    public $zhudan;
    function __construct() {
        $this->zhudan = new Zhudan();
    }
    public function sumField($key, $value) {
        $this->zhudan->$key += $value;
    }
}


class ReportTypeNode extends ReportNode
{
    public $zhudan;

    function __construct($zhudan, $parent = NULL)
    {
        parent::__construct($parent);
        $this->zhudan = $zhudan;
    }

/*    public function sum() {
        foreach ($this->zhudan as $key => $value) {
            if ($key == 'data') {
                $this->parent->sumField($key, $value);
            }
        }
    }*/
}

class ReportTypeTree extends ReportTree
{
    public $property;
    public $title;
    public $dataField;

/*    public function sumField($key, $value) {
        $this->dataField->sumField($key, $value);
        $this->parent->sumField($key, $value);
        $this->dataField = new DataField();
    }*/

    function __construct($property, $title, $parent = NULL)
    {
        parent::__construct($parent);
        $this->property = $property;
        $this->title = $title;
    }

    public function buildTree($zhudanArray)
    {
        foreach ($zhudanArray as $zhudan) {
            $this->insertChildren($this->property, $zhudan);
        }
    }

    private function insertChildren($property, $zhudan)
    {
        $this->property = $property;
        $nextProperty = $zhudan->findNextProperty($property);

        if ($nextProperty['depth'] > 3) {
            // 不需要再深入进去了
            $child = $this->findChild('date', $zhudan->date);
            if ($child == NULL) {
                $child = new ReportTypeDate($zhudan->date, $this);
                $this->children[] = $child;
            }
            $child->insertDate($zhudan);
        } else if ($nextProperty['property'] != NULL) {
            // 继续递归创建子树
            $child = $this->findChild('title', $zhudan->$nextProperty['property']);
            if ($child == NULL) {
                $child = new ReportTypeTree($nextProperty['property'], $zhudan->$nextProperty['property'], $this);
                $this->children[] = $child;
            }
            $child->insertChildren($nextProperty['property'], $zhudan);
        } else {
            // 出错了
        }
    }

}


class ReportTypeDate extends ReportTypeTree {
    public $date;
    function __construct($date, $parent = NULL) {
        parent::__construct('date', 'date', $parent);
        $this->date = $date;
    }
    public function insertDate($zhudan) {
        $this->children[] = new ReportTypeNode($zhudan, $this);

    }
}
