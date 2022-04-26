<?php

namespace App\Lib;

use DateTime;

class Util
{
    /**
     * ハッシュ作成
     * 
     * @access public 
     * @param  string $str 文字列
     * @return string $hash ハッシュ
     */
    public function createHash($str)
    {
        $t = new DateTime();
        $time = $t->format('YmdHis');
        $str = $time . $str;
        $hash = hash('md5', $str);
        return $hash;
    }
}



