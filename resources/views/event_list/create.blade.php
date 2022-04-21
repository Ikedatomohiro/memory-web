<div>
    <p>イベント名</p>
    <div>
        <p>
            <form action="{{ route('event.store') }}" method="POST">
                @csrf
                <p>
                    <input type="text" name="event_name" class="">
                </p>
                <input type="submit" value="登録">
            </form>
        </p>
        <p>キャンセル</p>
    </div>
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>

