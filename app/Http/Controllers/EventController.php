<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * イベントトップページ
     * 
     * @access public
     * 
     */
    public function index(Request $request)
    {
        
        return view('event.index');
    }

    /**
     * イベント作成画面
     * 
     * 
     * 
     */
    public function create(Request $request)
    {
        return view('event.create');
    }

    /**
     * イベント登録処理
     * 
     * 
     */
    public function store(Request $request)
    {
        // 入力チェック
        $this->validate($request, [
            'event_name' => 'required|max:255',
        ]);

        Event::create([
            'event_name' => $request->event_name,
            'event_hash' => $this->createHash($request->event_name),
            'user_id' => 0,
        ]);
        // todo:ユーザーIDを登録
        // $request->events()->create([
        //     'event_name' => $request->event_name,
        //     'user_id' => 1,
        //     'event_hash' => $this->createHash($request->event_name),
        // ]);
        return redirect('event');
    }

    /**
     * ハッシュ作成
     * 
     * @access public 
     * @param  string $event_name イベント名
     * @return string $hash ハッシュ
     */
    public function createHash($event_name)
    {
        $t = new DateTime();
        $time = $t->format('YmdHis');
        $str = $time . $event_name;
        $hash = hash('md5', $str);
        return $hash;
    }


}
