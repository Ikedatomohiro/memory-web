<div>
    <p>
        <p>
            ご参加
            <input type="checkbox" name="retuals[0]" value="0">通夜
            <input type="checkbox" name="retuals[1]" value="1">告別式
        </p>
        <p>
            ご芳名
            <input type="text" name="guest_name" class="" value="{{ old('guest_name', $guest->guest_name) }}">
        </p>
        <p>
            会社名
            <input type="text" name="company_name" class="" value="{{ old('company_name', $guest->company_name) }}">
        </p>
        <p>
            郵便番号
            <input type="text" id="zip_code" name="zip_code" class="" value="{{ old('zip_code', $guest->zip_code) }}">
        </p>
        <p>
            住所
            <input type="text" name="address" class="" value="{{ old('address', $guest->address) }}">
        </p>
        <p>
            電話番号
            <input type="text" name="tel" class="" value="{{ old('tel', $guest->tel) }}">
        </p>
        <p>
            どなたのご関係ですか
            <input type="checkbox" name="relations[0]" value="0">故人様
            <input type="checkbox" name="relations[1]" value="1">喪主様
            <input type="checkbox" name="relations[2]" value="2">ご家族
            <input type="checkbox" name="relations[3]" value="3">その他
            <input type="text" name="relations_other" value="{{ old('relations_other', $guest->relations_other) }}">
        </p>
        <p>
            どのようなご関係ですか
            <input type="checkbox" name="groups[0]" value="0">会社関係
            <input type="checkbox" name="groups[1]" value="1">お取引先
            <input type="checkbox" name="groups[2]" value="2">学校関係
            <input type="checkbox" name="groups[3]" value="3">官公庁
            <input type="checkbox" name="groups[4]" value="4">各種団体
            <input type="checkbox" name="groups[5]" value="5">町内会
            <input type="checkbox" name="groups[6]" value="6">ご友人
            <input type="checkbox" name="groups[7]" value="7">ご親戚
            <input type="checkbox" name="groups[8]" value="8">その他
            <input type="text" name="groups_other" value="{{ old('groups_other', $guest->groups_other) }}">
        </p>
        <input type="hidden" name="event_hash" value="{{ $event->event_hash }}">
    </p>
</div>
@foreach ($errors->all() as $error)
{{ $error }}
@endforeach