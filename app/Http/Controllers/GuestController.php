<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Event;
use App\Http\Requests\GuestRequest;
use App\Repositories\GuestRepository;
use Validator;

class GuestController extends Controller
{
    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(GuestRepository $guests)
    {
        $this->middleware('auth');
        $this->guests = $guests;
        return;
    }   

    /**
     * 参加者登録画面
     * 
     * @access public
     * @param object $request ポストパラメータ
     * @return
     */
    public function create(Request $request)
    {
        // イベント取得し、なければエラー
        $event = Event::getEvent($request->event_hash);
        // バリデーション作成
        $this->isEvent($event);
        $param  = [
            'event' => $event,
        ];
        return view('guest.create', $param);
    }

    /**
     * 参加者登録処理
     * 
     * @access public
     * @return 
     */
    public function store(Request $request)
    {
        // イベント取得し、なければエラー
        $event = Event::getEvent($request->event_hash);
        // バリデーション作成
        $this->isEvent($event);
        $guest_request = new GuestRequest();
        $validator = Validator::make($request->all(),
                                     $guest_request->rules(),
                                     $guest_request->messages(),
        );
        if ($validator->fails()) {
            return redirect('/events')
                            ->withErrors($validator)
                            ->withInput();
        }

        Guest::create([
            'event_id'     => $event->event_id,
            'guest_hash'   => \Util::createHash($request->guest_name),
            'guest_name'   => $request->guest_name,
            'company_name' => $request->company_name,
            'address'      => $request->address,
            'tel'          => $request->tel,
            'description'  => $request->description,
            'retuals'      => $request->retuals,
        ]);
        $param  = [
            'event' => $event,
        ];
        return view('guest.create', $param);
    }

    /**
     * 入力チェック
     * 
     * 
     * 
     */
    public function inputCheck()
    {
        // イベントが存在するか

        // バリデーション

        // 全部空欄か

        // 会社名またはご芳名は必須
    }

    /**
     * イベントの存在チェック
     * 
     * @access public
     * @return void
     */
    public function isEvent(Event $event)
    {
        if (!isset($event->event_id)) {
            echo '警察に通報しました。連絡をお待ちください。';exit();
        }
        return;
    }

}
