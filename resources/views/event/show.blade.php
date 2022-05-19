@extends('layouts.app')
@section('title', 'イベント')
@section('head')
@endsection('head')
@section('content')

<div class="container">
    <table>
        <tr>
            <th>参加者</th>
            <th>登録日</th>
            <th>参加儀式</th>
            <th>操作</th>
        </tr>
        @foreach ($guests as $guest)
        <tr>
            <td>
                <a href="{{ route('guest.edit', ['guest' => $guest->guest_hash]) }}">{{ $guest->guest_name }}</a>
            </td>
            <td>今日</td>
            <td>
            </td>
        </tr>
        @endforeach
    </table>
    <form action="{{ route('guest.create', ['event_hash' => $event->event_hash]) }}" method="GET">
        <p class="execution-button">
            <span class="button-s">
                参加者登録
            </span>
        </p>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
    <form action="{{ route('home', ['user_hash' => $user_hash]) }}" method="GET">
        <p class="execution-button">
            <span class="button-s">
                イベント一覧
            </span>
        </p>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
    <form action="{{ route('guest.download', ['event_hash' => $event->event_hash]) }}" method="GET">
        <p class="execution-button">
            <span class="button-s">
                ダウンロード
            </span>
        </p>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
</div>

<div class="footer">
    <div class="footer-center">
    </div>
</div>
@endsection