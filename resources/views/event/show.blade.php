@extends('layouts.app')
@section('title', 'イベント')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.js"></script>
<script src="{{ asset('js/guest-book.js') }}" defer></script>
<link rel="stylesheet" href="/css/guest-book.css">
@endsection('head')
@section('content')

<div class="container">
    <div class="">
        <form action="{{ route('guest.create', ['event_hash' => $event->event_hash]) }}" method="GET">
            <span class="button-s execution-button">
                参加者登録
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
    </div>
    <table>
        <tr>
            <th>ご芳名</th>
            <th>会社名</th>
            <th>参加儀式</th>
            <th>ご関係</th>
            <th>ご所属</th>
            <th>登録日</th>
            <th>操作</th>
        </tr>
        @foreach ($guests as $guest)
        <tr class="guest-record">
            <td>
                {{ $guest->guest_name }}
            </td>
            <td>
                {{ $guest->company_name }}
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="{{ route('guest.edit', ['guest' => $guest->guest_hash]) }}" class="execute"></a>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <form action="{{ route('home', ['user_hash' => $user_hash]) }}" method="GET">
            <span class="button-s execution-button">
                イベント一覧
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
    </div>
    <div>
        <form action="{{ route('guest.download', ['event_hash' => $event->event_hash]) }}" method="GET">
            <span class="button-s execution-button">
                ダウンロード
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
    </div>
</div>

<div class="footer">
    <div class="footer-center">
    </div>
</div>
@endsection