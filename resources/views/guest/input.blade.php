<div>
    <p>
        <p>
            ご参加
            @foreach ($retuals as $key => $retual)
                @if (!is_null($guest->retuals) && in_array($key, $guest->retuals))
            <input type="checkbox" name="retuals[{{ $key }}]" value="{{ $key }}" checked>{{ $retual }}
                @else
            <input type="checkbox" name="retuals[{{ $key }}]" value="{{ $key }}">{{ $retual }}
                @endif
            @endforeach
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
            @foreach ($relations as $key => $relation)
                @if (!is_null($guest->relations) && in_array($key, $guest->relations))
            <input type="checkbox" name="relations[{{ $key }}]" value="{{ $key }}" checked>{{ $relation }}
                @else
            <input type="checkbox" name="relations[{{ $key }}]" value="{{ $key }}">{{ $relation }}
                @endif
            @endforeach
            <input type="text" name="relations_other" value="{{ old('relations_other', $guest->relations_other) }}">
        </p>
        <p>
            どのようなご関係ですか
            @foreach ($groups as $key => $group)
                @if (!is_null($guest->groups) && in_array($key, $guest->groups))
            <input type="checkbox" name="groups[{{ $key }}]" value="{{ $key }}" checked>{{ $group }}
                @else
            <input type="checkbox" name="groups[{{ $key }}]" value="{{ $key }}">{{ $group }}
                @endif
            @endforeach
            <input type="text" name="groups_other" value="{{ old('groups_other', $guest->groups_other) }}">
        </p>
        <input type="hidden" name="event_hash" value="{{ $event->event_hash }}">
    </p>
</div>
@foreach ($errors->all() as $error)
{{ $error }}
@endforeach