@extends('layouts.guest_input')
@section('title', '来客者登録')
@section('content')
<div>
    <div class="header">
        <p>来客者登録</p>
        <a href="{{ route('events.show', ['event' => $event->event_hash]) }}" class="back-button">
            <span class="button-s">来客者一覧に戻る</span>
        </a>
    </div>
    <form action="{{ route('guest.store') }}" method="POST">
        @csrf
        @include('guest.input')
        <span class="button execution-button">登録する</span>
        <input type="submit" class="exexcute" value="" style="display: none" />
    </form>
</div>
@endsection