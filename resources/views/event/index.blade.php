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
            <th>操作</th>
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
            <td class="operetion-td">
                <p class="operation">
                    <span class="icon new-icon" title="参加者登録">

                    </span>
                    <span class="icon edit-icon"></span>
                    <form action="{{ route('events.edit', ['event' => $event->event_hash]) }}" method="GET">
                        <span class="icon garbage-icon"></span>
                        <input type="submit" class="execute" value="" style="display: none" />
                    </form>

                </p>
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
