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

class EventController extends Controller
{
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
        // print_r($events);exit();
        $param = [
            'msg'    => '',
            'events' => $events,
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
            return redirect('/events')
                            ->withErrors($validator)
                            ->withInput();
        }

        Event::create([
            'event_name' => $request->new_event_name,
            'event_hash' => \Util::createHash($request->new_event_name),
            'user_id'    => $request->user()->id,
        ]);
        return redirect('/events');
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
            'guests' => $guests,
            'event'  => $event,
        ];
        return view('event.show', $param);
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
        return redirect('/events');
    }


}
