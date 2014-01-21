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


class ReportTypeNode extends ReportNode
{
    public $zhudan;

    function __construct($zhudan, $parent = NULL)
    {
        parent::__construct($parent);
        $this->zhudan = $zhudan;
    }

}

class ReportTypeTree extends ReportTree
{
    public $property;
    public $title;
    public $zhudan;

    public function sumZhudan($zhudan) {
        $this->zhudan->sum($zhudan);
        if ($this->parent != NULL) {
            $this->parent->sumZhudan($zhudan);
        }

    }

    function __construct($property, $title, $parent = NULL)
    {
        parent::__construct($parent);
        $this->property = $property;
        $this->title = $title;
        $this->zhudan = new Zhudan();
    }

    public function buildTree($zhudanArray)
    {
        foreach ($zhudanArray as $zhudan) {
            $this->insertChildren($this->property, $zhudan);
        }
    }

    public function insertChildren($property, $zhudan)
    {
        $this->property = $property;
        $nextProperty = $zhudan->findNextProperty($property);
        $depth = $nextProperty['depth'];
        if ($depth < 0) {
            // error
        } else if ($depth > 3) {
            // 不需要再深入进去了
            $this->children[] = $zhudan;
            $this->sumZhudan($zhudan);
        } else if ($nextProperty['property'] != NULL) {
            // 继续递归创建子树
            $title = $zhudan->$nextProperty['property'];
            $child = $this->findChild('title', $title);
            if ($child == NULL) {
                $child = new ReportTypeTree($nextProperty['property'], $title, $this);
                $this->children[] = $child;
            }
            $child->insertChildren($nextProperty['property'], $zhudan);
        } else {
            // error
        }
    }

}
