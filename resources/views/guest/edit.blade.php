<div>
    <p>参加者詳細</p>
    <form action="{{ route('guest.update', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('put')
    @include('guest.input')
    <input type="submit" value="更新">
    </form>
    <a href="{{ route('events.show', ['event' => $event->event_hash]) }}">来客者一覧に戻る</a>
</div>