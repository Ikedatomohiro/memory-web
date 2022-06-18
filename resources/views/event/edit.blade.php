@extends('layouts.app')
@section('title', 'イベント')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.js"></script>
<script src="{{ asset('js/guest-book.js') }}" defer></script>
<link rel="stylesheet" href="/css/guest-book.css">
@endsection('head')
@inject('util', 'App\Lib\Util')
@inject('guestConst', 'App\Const\GuestConst')
@section('content')
<div>
    <p>
        <li class="input-item">
            <span class="title">
                イベント名
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                開催日
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('hold_date', $event->hold_date) }}" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                開催場所
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('hold_place', $event->hold_place) }}" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                主催者
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('organizer_name', $event->organizer_name) }}" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                備考
            </span>
            <textarea type="text" name="event_name" class="input-area" autocomplete="off" form="event-input">{{ old('description', $event->description) }}</textarea>&nbsp;
            <span class="delete"></span>
        </li>
    </p>
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>

@endsection