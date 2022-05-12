@extends('layouts.guest_input')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>来客者登録</p>
        <a href="{{ route('events.show', ['event' => $event->event_hash]) }}">来客者一覧に戻る</a>
    </div>
    <form action="{{ route('guest.store') }}" method="POST">
        @csrf
        @include('guest.input')
        <p id="regist-btn" class="button">登録する</p>
        <input type="submit" id="regist" value="" style="display: none" />
    </form>
</div>
@endsection