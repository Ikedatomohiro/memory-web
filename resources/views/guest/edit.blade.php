@extends('layouts.app')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>参加者詳細</p>
        <a href="{{ route('events.show', ['event' => $event->event_hash]) }}">来客者一覧に戻る</a>
    </div>
    <form action="{{ route('guest.update', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('put')
        @include('guest.input')
        <input type="submit" value="更新">
    </form>
    <form action="{{ route('guest.destroy', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('delete')
        <input type="submit" value="来客削除">
    </form>
</div>
@endsection