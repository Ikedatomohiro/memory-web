@extends('layouts.guest_input')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>来客者登録</p>
        <form action="{{ route('events.show', ['event' => $event->event_hash]) }}" method="GET">
            <p class="execution-button">
                <span class="button">
                    来客者一覧に戻る
                </span>
            </p>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
    </div>
    @include('guest.input')
    <form id="guest-input" action="{{ route('guest.store') }}" method="POST">
        @csrf
        <p class="execution-button">
            <span class="button">
                登録する
            </span>
        </p>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
</div>
@endsection