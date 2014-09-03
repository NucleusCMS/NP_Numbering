<?php

class NP_Numbering extends NucleusPlugin {

    var $id = array();
    
    function getName()        { return 'Numbering'; }
    function getAuthor()      { return 'Taka'; }
    function getURL()         { return 'http://reverb.jp/vivian/download.php?itemid=NP_Numbering'; }
    function getVersion()     { return '0.1'; }
    function getDescription() { return 'Automatic Numbering'; }
    function supportsFeature($id) {return in_array($id, array('SqlTablePrefix'));}
    
    function init()
    {
        $this->id = array();
    }
    
    function doSkinVar($skinType, $id, $p2=1, $p3='', $p4='')
    {
        $p2 = strtolower($p2);
        if ($p2 == 'clear')
        {
            unset($this->id[$id]);
            return;
        }
        if (!isset($this->id[$id])) $this->id[$id] = 0;
        
        if ($p2 == 'stripe')
        {
            $this->id[$id] ++;
            if ($this->id[$id] % 2)
                echo $p3;
            else
            {
                echo $p4;
                $this->id[$id] -= 2;
            }
        }
        else
        {
            if ($p3 == '') $p3 = 1;
            if ($p4 == '') $p4 = 1;
            if ($p2 == 'current')
            {
                $curnum =  $this->id[$id];
                while (strlen(strval($curnum)) < $p3)
                {
                    $curnum = '0' . $curnum;
                }
                echo $curnum;
            }
            else
            {
                $curnum =  $this->id[$id] + intval($p3);
                while (strlen(strval($curnum)) < $p2)
                {
                    $curnum = '0' . $curnum;
                }
                echo $curnum;
                $this->id[$id] += intval($p4);
            }
        }
    }
}
