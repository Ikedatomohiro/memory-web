<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * イベント作成画面
     * 
     * 
     * 
     */
    public function create(Request $request)
    {
        return view('event_list.create');
    }

    /**
     * イベント登録処理
     * 
     * 
     */
    public function store(Request $request)
    {
        $event_request = new EventListRequest();
        $validator = Validator::make($request->all(),
                                    $event_request->rules(),
                                    $event_request->messages(),
        );
        if ($validator->fails()) {
            return redirect('/events')
                            ->withErrors($validator)
                            ->withInput();
        }
        Event::create([
            'event_name' => $request->new_event_name,
            'event_hash' => $this->createHash($request->new_event_name),
            'user_id' => 0,
        ]);
        // todo:ユーザーIDを登録
        // $request->events()->create([
        //     'event_name' => $request->event_name,
        //     'user_id' => 1,
        //     'event_hash' => $this->createHash($request->event_name),
        // ]);
        return redirect('/events');
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
