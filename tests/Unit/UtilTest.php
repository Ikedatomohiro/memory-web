<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Facades\Util;
use App\Const\GuestConst;

class UtilTest extends TestCase
{
    /**
     * arrayValueのテスト
     *
     * @return void
     */
    public function test_arrayValue_retuals()
    {
        $list = '1,2';
        $string = Util::arrayValue($list, GuestConst::RETUALS);
        $this->assertEquals('通夜・告別式', $string);
    }

    /**
     * arrayValueのテスト
     *
     * @return void
     */
    public function test_arrayValue_groups()
    {
        $list = '1,4,8';
        $string = Util::arrayValue($list, GuestConst::GROUPS);
        $this->assertEquals('会社関係・官公庁・ご親戚', $string);
    }

    /**
     * ファサードのインスタンスを作る。。らしい。
     */
    public function setUp(): void
    {
        parent::setUp();
    }
}
