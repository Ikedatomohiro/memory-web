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
            'retuals'         => $this->retualsList(),
            'relations'       => $this->relationsList(),
            'groups'          => $this->groupsList(),
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
        $event = Event::getEvent($request->event_hash);
        // バリデーション作成
        $this->isEvent($event);
        $param = $this->initParam();
        $param['event'] = $event;
        $value = $param['guest']->guest_name;
        // var_dump(htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8', true));
        // var_dump($param['guest']->guest_name);exit();
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
        $retuals   = !is_null($request->retuals) ? implode(',', $request->retuals) : null;
        $relations = !is_null($request->relations) ? implode(',', $request->relations) : null;
        $groups    = !is_null($request->groups) ? implode(',', $request->groups) : null;
        Guest::create([
            'event_id'        => $event->event_id,
            'guest_hash'      => \Util::createHash($request->guest_name),
            'guest_name'      => $request->guest_name,
            'company_name'    => $request->company_name,
            'zip_code'        => $request->zip_code,
            'address'         => $request->address,
            'tel'             => $request->tel,
            'description'     => $request->description,
            'retuals'         => $retuals,
            'relations'       => $relations,
            'relations_other' => $request->relations_other,
            'groups'          => $groups,
            'groups_other'    => $request->groups_other,
        ]);
        $param = $this->initParam();
        $param['event'] = $event;
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
     * 
     * 
     */
    public function update($hash)
    {
        Guest::where('guest_hash', $hash)->first();
        
        echo 's..sjdljka';exit();
    }

    /**
     * 入力チェック
     * 
     * @access public
     * 
     */
    public function inputCheck()
    {
        // イベントが存在するか

        // バリデーション

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
     * 儀式リスト
     * 
     * @access public
     * @return array $retuals
     */
    public function retualsList()
    {
        $retuals = [
            '通夜',
            '告別式',
        ];
        return $retuals;
    }

    /**
     * 儀式リスト
     * 
     * @access public
     * @return array $relations
     */
    public function relationsList()
    {
        $relations = [
            '故人様',
            '喪主様',
            'ご家族',
            'その他',
        ];
        return $relations;
    }

    /**
     * 儀式リスト
     * 
     * @access public
     * @return array $groups
     */
    public function groupsList()
    {
        $groups = [
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
        return $groups;
    }

}
