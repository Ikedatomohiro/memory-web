<?php

namespace App\Constant;

class GuestConst
{
    /**
     * 儀式リスト
     */
    public const TSUYA         = '1';
    public const KOKUBETSUSIKI = '2';
    public const RETUALS = [
        self::TSUYA         => '通夜',
        self::KOKUBETSUSIKI => '告別式',
    ];

    /**
     * ご関係リスト
     */
    public const KOJINSAMA       = '1';
    public const MOSYUSAMA       = '2';
    public const GOKAZOKU        = '3';
    public const RELATION_SONOTA = '4';
    public const RELATIONS = [
        self::KOJINSAMA       => '故人様',
        self::MOSYUSAMA       => '喪主様',
        self::GOKAZOKU        => 'ご家族',
        self::RELATION_SONOTA => 'その他',
    ];

    /**
     * ご所属リスト
     */
    public const KAISYAKANKEI  = '1';
    public const OTORIHIKISAKI = '2';
    public const GAKKOUKANKEI  = '3';
    public const KANKOUCYOU    = '4';
    public const KAKUSYUDANTAI = '5';
    public const CYOUNAIKAI    = '6';
    public const GOYUUJIN      = '7';
    public const GOSINSEKI     = '8';
    public const GROUP_SONOTA  = '9';
    public const GROUPS = [
        self::KAISYAKANKEI  => '会社関係',
        self::OTORIHIKISAKI => 'お取引先',
        self::GAKKOUKANKEI  => '学校関係',
        self::KANKOUCYOU    => '官公庁',
        self::KAKUSYUDANTAI => '各種団体',
        self::CYOUNAIKAI    => '町内会',
        self::GOYUUJIN      => 'ご友人',
        self::GOSINSEKI     => 'ご親戚',
        self::GROUP_SONOTA  => 'その他',
    ];
}