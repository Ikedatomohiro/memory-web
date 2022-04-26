<div>
    <p>参加者登録</p>
    <div>
        <p>
            <form action="{{ route('guest.store') }}" method="POST">
                @csrf
                <p>
                    ご芳名
                    <input type="text" name="guest_name" class="">
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

