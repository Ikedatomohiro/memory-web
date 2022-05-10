@extends('layouts.guest_input')
@section('title', '来客者登録')
@section('content')
<div>
    <p>来客者登録</p>
    <form action="{{ route('guest.store') }}" method="POST">
        @csrf
    @include('guest.input')
    <input type="submit" value="登録">
    </form>
    <a href="{{ route('events.show', ['event' => $event->event_hash]) }}">来客者一覧に戻る</a>
</div>
@endsection
