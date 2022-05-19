@extends('layouts.guest_input')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>来客者登録</p>

        <form action="{{ route('events.show', ['event' => $event->event_hash]) }}" method="GET">
            <p id="execution-button">
                <span class="button">
                    来客者一覧に戻る
                </span>
            </p>
            <input type="submit" id="execute" value="" style="display: none" />
        </form>
    </div>
    <form id="guest-input" action="{{ route('guest.store') }}" method="POST">
        @csrf
        @method('post')
    @include('guest.input')
        <p id="execution-button">
            <span class="button">
                登録する
            </span>
        </p>
        <input type="submit" id="execute" value="" style="display: none" />
    </form>
</div>
@endsection