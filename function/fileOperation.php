<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-7
*/

header("Content-Type: text/html; charset=utf-8");
class fileOperation {//基类
    var $fileName='test';
    var $extendName='csv';
    var $mPath='./report/';
    var $mFp;
    function fileOperation() {
        
    }
    function openFile($mode='w'){
        if(empty($this->fileName)){
            $this->setTimeFileName();
        }
        if (empty($this->extendName)){
            $this->setExtendName();
        }
        
        $fp=fopen($this->mPath.'/'.$this->fileName.'.'.$this->extendName,$mode);
        if($fp){
            $this->mFp=$fp;
        }else{
            return 0;
        }
    }
    function closeFile(){
        return fclose($this->mFp);
    }
    function setTimeFileName($type='Ymd'){
        if(!empty($type)){
            $this->fileName=$type;
        }else{
            $this->fileName=time();
        }
    }
    function setExtendName($extend='txt'){
        if(!empty($extend)){
            $this->extendName=$extend;
        }else{
            $this->extendName='.csv';
        }
    }
    function setPath($path='./'){
        $this->mPath=$path;
    }
}


?>