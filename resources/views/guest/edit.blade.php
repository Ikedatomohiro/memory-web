@extends('layouts.app')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>参加者詳細</p>
        <a href="{{ route('events.show', ['event' => $event->event_hash]) }}">
            <span class="button">
                来客者一覧に戻る
            </span>
        </a>
    </div>
    @include('guest.input')
    <form id="guest-input" action="{{ route('guest.update', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('put')
        <p id="execution-button">
            <span class="button">
                更新する
            </span>
        </p>
        <input type="submit" id="execute" value="" style="display: none" />
    </form>
    <form action="{{ route('guest.destroy', ['guest' => $guest->guest_hash]) }}" method="POST">
        @csrf
        @method('delete')
        <p id="execution-button">
            <span class="button">
                来客削除する
            </span>
        </p>
        <input type="submit" id="execute" value="" style="display: none" />
    </form>
</div>
@endsection