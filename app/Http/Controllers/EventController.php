<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use DateTime;
use App\Http\Requests\EventRequest;
use App\Models\Guest;
use App\Repositories\EventRepository;
use App\Repositories\GuestRepository;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    var $events;
    var $guests;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(EventRepository $events, GuestRepository $guests)
    {
        $this->middleware('auth');

        $this->events = $events;
        $this->guests = $guests;
    }

    /**
     * イベントトップページ
     * 
     * @access public
     * 
     */
    public function index(Request $request)
    {
        $events = $this->events->forUser($request->user());
        $param = [
            'msg'       => '',
            'events'    => $events,
            'user_hash' => Auth::user()->user_hash,
        ];
        return view('event.index', $param);
    }

    /**
     * イベント作成画面
     * 
     * @access public
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
        $event_request = new EventRequest();
        $validator = Validator::make($request->all(),
                                    $event_request->rules(),
                                    $event_request->messages(),
        );
        if ($validator->fails()) {
        return redirect(route('home', ['user_hash' => Auth::user()->user_hash]))
                            ->withErrors($validator)
                            ->withInput();
        }

        Event::create([
            'event_name' => $request->new_event_name,
            'event_hash' => \Util::createHash($request->new_event_name),
            'user_id'    => $request->user()->id,
        ]);
        return redirect(route('home', ['user_hash' => Auth::user()->user_hash]));
    }

    /**
     * イベント詳細
     * 
     * @access public
     * 
     */
    public function show(Request $request, $event_hash)
    {
        $event = $this->events->getEvent($event_hash);
        if (!isset($event->event_id)) {
            \Util::alertToPolice();
        }
        $guests = Guest::where(
            ['event_id' => $event->event_id,
             'del_flg'  => 0,]
            )->get();
        $param = [
            'guests'    => $guests,
            'event'     => $event,
            'user_hash' => Auth::user()->user_hash,
        ];
        return view('event.show', $param);
    }

    /**
     * イベント編集
     */
    public function edit(Request $request, $event_hash)
    {
        $event = $this->events->getEvent($event_hash);
        if (!isset($event->event_id)) {
            \Util::alertToPolice();
        }
        $param = [
            'event'     => $event,
            'user_hash' => Auth::user()->user_hash,
        ];
        return view('event.edit', $param);
    }

    /**
     * イベント更新
     * 
     * 
     */
    public function update(Request $request, $event_hash)
    {
        // $event_request = new EventRequest();
        // $validator = Validator::make($request->all(),
        //                             $event_request->rules(),
        //                             $event_request->messages(),
        // );
        // var_dump($validator->fails());exit();
        // if ($validator->fails()) {
        // return redirect(route('home', ['user_hash' => Auth::user()->user_hash]))
        //                     ->withErrors($validator)
        //                     ->withInput();
        // }
        print_r($event_hash);
        print_r($request->event_name);exit();
        Event::updated([
            'event_name' => $request->event_name,
        ]);
        return redirect(route('home', ['user_hash' => Auth::user()->user_hash]));
    }

    /**
     * イベント削除（論理削除）
     * 
     * @access public
     * @param  string $event_hash イベントハッシュ
     * 
     */
    public function destroy($event_hash)
    {
        $event = Event::where('event_hash', $event_hash)->first();
        DB::beginTransaction();
        try {
            Event::where('event_id', $event->event_id)->update(['del_flg' => 1]);
            Guest::where('event_id', $event->event_id)->update(['del_flg' => 1]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect(route('home', Auth::user()->user_hash));
    }

    /**
     * Userの存在チェック
     * 
     * @access public
     * @return void
     */
    public function isUser(Request $request)
    {
        if ($request->user_hash != Auth::user()->user_hash) {
            \Util::alertToPolice();
        }
        return;
    }
}
