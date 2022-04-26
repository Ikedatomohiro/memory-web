<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\EventListRequest;
use Validator;

class EventListController extends Controller
{
    /**
     * イベントトップページ
     * 
     * @access public
     * 
     */
    public function index(Request $request)
    {
        $events = Event::all();
        $param = [
            'msg'   => '',
            'events' => $events,
        ];
        return view('event_list.index', $param);
    }

    /**
     * イベント作成画面
     * 
     * @access public
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
            'event_hash' => \Util::createHash($request->new_event_name),
        // todo:ユーザーIDを登録
            'user_id' => 0,
        ]);
        // $request->events()->create([
        //     'event_name' => $request->event_name,
        //     'user_id' => 1,
        //     'event_hash' => $this->createHash($request->event_name),
        // ]);
        return redirect('/events');
    }

    /**
     * イベント詳細
     * 
     * @access public
     * 
     */
    public function show($event_hash)
    {
        // $guests = Event::


        $query = Event::query();
        $event = $query->where('event_hash', $event_hash)->first();
        $guests = $event->guests;
        $param = [
            'guests' => $guests,
        ];
        return view('event_list.show', $param);
    }

    /**
     * イベント削除
     * 
     * @access public
     * 
     */
    public function destroy($event_hash)
    {
        $query = Event::query();
        $query->where('event_hash', $event_hash)->delete();
        return redirect('/events');
    }

}
