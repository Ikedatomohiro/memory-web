@extends('layouts.app')
@section('title', 'イベントリスト')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/guest-book.js') }}" defer></script>
<link rel="stylesheet" href="/css/guest-book.css">
@endsection('head')
@section('content')
@if (count($events) > 0)
<div class="container">
    <div class="header">
        <p>イベント一覧</p>
    </div>
    <table>
        <tr>
            <th>イベント名</th>
            <th>登録日</th>
            <th>開催日</th>
            <th>参加人数</th>
        </tr>
        @foreach ($events as $event)
        <tr class="record">
            <td>
                {{ $event['event_name'] }}
            </td>
            <td align="center">
                {{ optional($event->created_at)->format('Y年 n月 j日') }}
            </td>
            <td align="center">
                {{ optional($event->hold_date)->format('Y年 n月 j日') }}
            </td>
            <td align="center">
                {{ $event->guest_count }} 名
                <a href="{{ route('events.show', ['event' => $event->event_hash]) }}" class="execute"></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endif
<div class="footer">
    <div class="footer-center">
        <form action="{{ route('events.store')}}" method="POST">
            @csrf
            <input type="text" name="new_event_name" value="{{ old('new_event_name') }}" />
            <input type="submit" value="作成する">
            @error ('new_event_name')
            {{ $message }}
            @enderror
            {{ $msg }}
        </form>
    </div>
</div>
@endsection