@extends('layouts.guest_input')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>来客者登録</p>
        <form action="{{ route('events.show', ['event' => $event->event_hash]) }}" method="GET">
            <span class="button-s execution-button">
                来客者一覧に戻る
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
    </div>
    @include('guest.input')
    <form id="guest-input" action="{{ route('guest.store') }}" method="POST">
        @csrf
        <span class="button execution-button">
            登録する
        </span>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
</div>
@endsection