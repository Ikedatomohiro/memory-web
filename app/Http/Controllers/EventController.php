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
        $event = Event::getEvent($event_hash);
        if (!isset($event->event_id)) {
            sleep(2);
            echo '警察に通報しました。連絡をお待ちください。';exit();
        }
        $guests = Guest::where('event_id', $event->event_id)->get();
        $param = [
            'guests' => $guests,
            'event'  => $event,
        ];
        return view('event.show', $param);
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
