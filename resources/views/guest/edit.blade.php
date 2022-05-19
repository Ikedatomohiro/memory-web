@extends('layouts.app')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>参加者詳細</p>
        <form action="{{ route('events.show', ['event' => $event->event_hash]) }}" method="GET">
            <span class="button-s execution-button">
                来客者一覧に戻る
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
    </div>
    @include('guest.input')
    <form id="guest-input" action="{{ route('guest.update', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('put')
        <span class="button execution-button">
            更新する
        </span>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
    <form action="{{ route('guest.destroy', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('delete')
        <span class="button delete-button">
            来客削除する
        </span>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
</div>
@endsection