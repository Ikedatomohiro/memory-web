<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Event;
use App\Http\Requests\GuestRequest;
use App\Repositories\GuestRepository;
use App\Repositories\EventRepository;
use Validator;

class GuestController extends Controller
{
    var $retualsList = [
        '通夜',
        '告別式',
    ];

    var $relationsList = [
        '故人様',
        '喪主様',
        'ご家族',
        'その他',
    ];

    var $groupsList = [
        '会社関係',
        'お取引先',
        '学校関係',
        '官公庁',
        '各種団体',
        '町内会',
        'ご友人',
        'ご親戚',
        'その他',
    ];

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(GuestRepository $guests, EventRepository $events)
    {
        $this->middleware('auth');
        $this->guests = $guests;
        $this->events = $events;
        return;
    }

    /**
     * パラメータ
     * 
     * @access public
     * 
     */
    public function initParam()
    {
        $param = [
            'guest'           => new Guest(),
            'relations_other' => '',
            'groups_other'    => '',
            'stored'          => false,
            'retuals'         => $this->retualsList,
            'relations'       => $this->relationsList,
            'groups'          => $this->groupsList,
        ];
        return $param;
    }

    /**
     * 参加者登録画面
     * 
     * @access public
     * @param  object $request ポストパラメータ
     * @return
     */
    public function create(Request $request)
    {
        // イベント取得し、なければエラー
        $event = $this->events->getEvent($request->event_hash);
        // バリデーション作成
        $this->isEvent($event);
        $param = $this->initParam();
        $param['event'] = $event;
        return view('guest.create', $param);
    }

    /**
     * 参加者登録処理
     * 
     * @access public
     * @param  object $request ポストパラメータ
     * @return
     */
    public function store(Request $request)
    {
        // 入力チェック
        $this->inputCheck($request);
        $param = $this->initParam();
        $param['event'] = $this->event;
        $guest_request = new GuestRequest();
        $validator = Validator::make($request->all(),
                                     $guest_request->rules(),
                                     $guest_request->messages(),
        );
        if ($validator->fails()) {
            return redirect(route('guest.create', ['event_hash' => $this->event->event_hash]))
                            ->withErrors($validator)
                            ->withInput();
        }
        Guest::create([
            'event_id'        => $this->event->event_id,
            'guest_hash'      => \Util::createHash($request->guest_name),
            'guest_name'      => $request->guest_name,
            'company_name'    => $request->company_name,
            'zip_code'        => $request->zip_code,
            'address'         => $request->address,
            'tel'             => $request->tel,
            'description'     => $request->description,
            'retuals'         => !is_null($request->retuals) ? implode(',', $request->retuals) : null,
            'relations'       => !is_null($request->relations) ? implode(',', $request->relations) : null,
            'relations_other' => $request->relations_other,
            'groups'          => !is_null($request->groups) ? implode(',', $request->groups) : null,
            'groups_other'    => $request->groups_other,
        ]);
        $param['stored'] = true;
        return view('guest.create', $param);
    }

    /**
     * 来客編集
     * 
     * @access public
     * 
     */ 
    public function edit($hash)
    {
        // 来客データ取得
        $guest = Guest::where('guest_hash', $hash)->first();
        $guest->retuals = explode(',', $guest->retuals);
        $guest->relations = explode(',', $guest->relations);
        $guest->groups = explode(',', $guest->groups);
        // 来客データの存在確認
        $this->isGuest($guest);
        // イベント情報取得
        $event = Event::where('event_id', $guest->event_id)->first();
        // パラメータセット
        $param = $this->initParam();
        $param['event'] = $event;
        $param['guest'] = $guest;
        return view('guest.edit', $param);
    }

    /**
     * 来客情報更新
     * 
     * @access public
     * @param  
     * 
     */
    public function update(Request $request, $hash)
    {
        // 入力チェック
        $this->inputCheck($request);
        // 来客情報更新
        Guest::where('guest_hash', $hash)->update([
            'guest_name'      => $request->guest_name,
            'company_name'    => $request->company_name,
            'zip_code'        => $request->zip_code,
            'address'         => $request->address,
            'tel'             => $request->tel,
            'description'     => $request->description,
            'retuals'         => !is_null($request->retuals) ? implode(',', $request->retuals) : null,
            'relations'       => !is_null($request->relations) ? implode(',', $request->relations) : null,
            'relations_other' => $request->relations_other,
            'groups'          => !is_null($request->groups) ? implode(',', $request->groups) : null,
            'groups_other'    => $request->groups_other,
        ]);
        return redirect(route('events.show', $this->event->event_hash));
    }

    /**
     * 入力チェック
     * 
     * @access public
     * 
     */
    public function inputCheck(Request $request)
    {
        // イベント取得し、なければエラー
        $this->event = $this->events->getEvent($request->event_hash);
        // バリデーション作成
        $this->isEvent($this->event);
        // ご芳名か会社名のいずれかは入力されているか

        // 会社名またはご芳名は必須
    }

    /**
     * イベントの存在チェック
     * 
     * @access public
     * @return void
     */
    public function isEvent(?Event $event)
    {
        if (!isset($event->event_id)) {
            \Util::alertToPolice();
        }
        return;
    }

    /**
     * 来客者の存在チェック
     * 
     * @access public
     * @return void
     */
    public function isGuest(?Guest $guest)
    {
        if (!isset($guest->guest_id)) {
            \Util::alertToPolice();
        }
        return;
    }

    /**
     * ご芳名か会社名のいずれかは入力されているか
     * 
     * 
     * 
     */
    public function nameEmpty(Request $request)
    {

    }

    /**
     * 来客者削除
     * 
     * @access public
     * 
     */
    public function destroy(Request $request)
    {
        Guest::where('guest_hash', $request->guest)->update(['del_flg' => 1]);


    }

    /**
     * CSVファイルダウンロード
     * 
     * 
     * 
     */
    public function download($hash)
    {
        // コールバック関数に１行ずつ書き込んでいく処理を記述
        $callback = function () use ($hash) {
            // 出力バッファをopen
            $stream = fopen('php://output', 'w');
            // 文字コードをShift-JISに変換
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            // ヘッダー行
            fputcsv($stream, [
            'ID',
            ]);
            // データ
            $guests = Guest::orderBy('guest_id', 'desc');
            // ２行目以降の出力
            foreach ($guests->cursor() as $guest) {
                fputcsv($stream, [
                    $guest->guest_id,
                    $guest->guest_name,
                ]);
            }
            fclose($stream);
        };
        
        // 保存するファイル名
        $filename = sprintf('guest-%s.csv', date('YmdHis'));
        
        // ファイルダウンロードさせるために、ヘッダー出力を調整
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];
        
        return response()->streamDownload($callback, $filename, $header);
    }
}
