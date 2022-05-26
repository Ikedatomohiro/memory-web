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
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" placeholder="例）葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                イベント名
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" placeholder="例）葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                イベント名
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" placeholder="例）葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                イベント名
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" placeholder="例）葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                イベント名
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" placeholder="例）葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                イベント名
            </span>
            <input type="text" name="event_name" class="input-area" value="{{ old('event_name', $event->event_name) }}" placeholder="例）葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
    </p>
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>

@endsection