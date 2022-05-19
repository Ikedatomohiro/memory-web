@section('head')
@endsection('head')
<div>
    <p>
        <li class="input-item">
            <span class="title">
                ご参加
            </span>
            @foreach ($retuals as $key => $retual)
            <label class="checkbox-label">
                <input type="checkbox" name="retuals[{{ $key }}]" value="{{ $key }}" {{ (!is_null($guest->retuals) && in_array($key, $guest->retuals)) ? 'checked' : '' }} style="display: none" form="guest-input"/>
                <span>{{ $retual }}</span>
            </label>
            @endforeach
        </li>
        <li class="input-item">
            <span class="title">
                ご芳名
            </span>
            <input type="text" name="guest_name" class="input-area" value="{{ old('guest_name', $guest->guest_name) }}" placeholder="例）山田　太郎" autocomplete="off" form="guest-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                会社名
            </span>
            <input type="text" name="company_name" class="input-area" value="{{ old('company_name', $guest->company_name) }}" placeholder="例）（株）やまだたろう" autocomplete="off" form="guest-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                郵便番号
            </span>
            <input type="text" id="zip_code" name="zip_code" class="input-area" value="{{ old('zip_code', $guest->zip_code) }}" placeholder="例）100-0001" autocomplete="off" form="guest-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                住所
            </span>
            <input type="text" id="address" name="address" class="input-area" value="{{ old('address', $guest->address) }}" placeholder="例）東京都千代田区千代田１２３−４" autocomplete="off" form="guest-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                電話番号
            </span>
            <input type="tel" name="tel" class="input-area" value="{{ old('tel', $guest->tel) }}" placeholder="例）03-1234-5678" autocomplete="off" form="guest-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                どなたの<br>ご関係ですか
            </span>
            <p>
                @foreach ($relations as $key => $relation)
                <label class="checkbox-label">
                    <input type="checkbox" name="relations[{{ $key }}]" value="{{ $key }}" {{ (!is_null($guest->relations) && in_array($key, $guest->relations)) ? 'checked' : '' }} style="display: none" form="guest-input"/>
                    <span>{{ $relation }}</span>
                </label>
                @if (($loop->iteration % 3 == 0 && $loop->iteration != $loop->count) || $loop->iteration == $loop->count - 1)
                <br>
                @endif
                @endforeach
                <input type="text" name="relations_other" class="input-other" value="{{ old('relations_other', $guest->relations_other) }}" autocomplete="off" form="guest-input">
                <span class="delete-s"></span>
            </p>
        </li>
        <li class="input-item">
            <span class="title">
                どのような<br>ご関係ですか
            </span>
            <p>
                @foreach ($groups as $key => $group)
                <label class="checkbox-label">
                    <input type="checkbox" name="groups[{{ $key }}]" value="{{ $key }}" {{ (!is_null($guest->groups) && in_array($key, $guest->groups)) ? 'checked' : '' }} style="display: none" form="guest-input"/>
                    <span>{{ $group }}</span>
                </label>
                @if (($loop->iteration % 4 == 0 && $loop->iteration != $loop->count) || $loop->iteration == $loop->count - 1)
                <br>
                @endif
                @endforeach
                <input type="text" name="groups_other" class="input-other" value="{{ old('groups_other', $guest->groups_other) }}" autocomplete="off" form="guest-input">
                <span class="delete-s"></span>
            </p>
        </li>
        <input type="hidden" name="event_hash" value="{{ $event->event_hash }}" form="guest-input">
    </p>
</div>
@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach