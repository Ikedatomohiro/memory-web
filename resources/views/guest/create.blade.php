<div>
    <p>参加者登録</p>
    <div>
        <p>
        <form action="{{ url('guest') }}" method="POST">
            @csrf
            <p>
                ご芳名
                <input type="text" name="guest_name" class="">
            </p>
            <input type="hidden" name="event_hash" value="{{ $event->event_hash }}">
            <input type="submit" value="登録">
        </form>
        </p>
        <p>キャンセル</p>
        <a href="{{ url('events/'. $event->event_hash)}}">一覧に戻る</a>
        </div>
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>