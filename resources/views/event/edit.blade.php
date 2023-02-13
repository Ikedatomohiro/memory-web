@extends('layouts.app')
@section('title', 'イベント')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.js"></script>
<script src="{{ asset('js/guest-book.js') }}" defer></script>
<link rel="stylesheet" href="/css/guest-book.css">
@endsection('head')
@inject('util', 'App\Lib\Util')
@inject('guestConst', 'App\Constant\GuestConst')
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
                開催日
            </span>
            <input type="text" name="hold_date" class="input-area" value="{{ old('hold_date', $event->hold_date) }}" placeholder="例）20XX年10月10日" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                開催場所
            </span>
            <input type="text" name="hold_place" class="input-area" value="{{ old('hold_place', $event->hold_place) }}" placeholder="例）〇〇葬儀" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                喪主
            </span>
            <input type="text" name="organizer_name" class="input-area" value="{{ old('organizer_name', $event->organizer_name) }}" placeholder="例）山田太郎" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
        <li class="input-item">
            <span class="title">
                備考
            </span>
            <input type="text" name="description" class="input-area" value="{{ old('description', $event->description) }}" placeholder="" autocomplete="off" form="event-input">&nbsp;
            <span class="delete"></span>
        </li>
    </p>
    <form action="{{ route('events.update', ['event' => $event->event_hash]) }}" method="POST">
        @csrf
        @method('put')
        <span class="button-s execution-button">
            更新する
        </span>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>

@endsection