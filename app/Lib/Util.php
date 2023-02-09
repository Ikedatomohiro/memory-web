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

    /**
     * 警察に通報する
     * 
     * @access public
     * 
     * 
     */
    public function alertToPolice()
    {
        sleep(2);
        echo '警察に通報しました。連絡をお待ちください。';exit();
    }

    /**
     * カンマ区切り数字を文字に変換
     * 
     * @access public
     */
    public function arrayValue($list, $array)
    {
        $string = '';
        if (!is_array($array)) {
            return $string;
        }
        $val = array();
        $keys = explode(',', $list);
        foreach ($keys as $index => $key) {
            if (array_key_exists($key, $array)) {
                $val[] = $array[$key];
            }
        }
        $string = implode('・', $val);
        return $string;
    }
}



