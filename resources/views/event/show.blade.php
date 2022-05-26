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
<div class="container">
    <div class="header">
        <p>{{ $event->event_name }} 来客一覧</p>
        <form action="{{ route('guest.create', ['event_hash' => $event->event_hash]) }}" method="GET">
            <span class="button-s execution-button">
                参加者新規登録
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
        <div class="header-right">
            <form action="{{ route('events.edit', ['event' => $event->event_hash]) }}" method="GET">
                <span class="button-s execution-button">
                    イベント情報を編集する
                </span>
                <input type="submit" class="execute" value="" style="display: none" />
            </form>
            <form action="{{ route('home', ['user_hash' => $user_hash]) }}" method="GET">
                <span class="button-s execution-button">
                    イベント一覧に戻る
                </span>
                <input type="submit" class="execute" value="" style="display: none" />
            </form>
        </div>
    </div>
    <div>
        検索
    </div>
    <table>
        <tr>
            <th width="10%">No</th>
            <th width="20%">ご芳名</th>
            <th width="20%">会社名</th>
            <th width="20%">参加儀式</th>
            <th width="20%">ご関係</th>
            <th width="20%">ご所属</th>
        </tr>
        @foreach ($guests as $guest)
        <tr class="record">
            <td align="center">
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $guest->guest_name }}
            </td>
            <td>
                {{ $guest->company_name }}
            </td>
            <td>
                {{ $util->arrayValue($guest->retuals, $guestConst::RETUALS) }}
            </td>
            <td>
                {{ $util->arrayValue($guest->relations, $guestConst::RELATIONS) }}&nbsp;
                {{ $guest->relations_other }}
            </td>
            <td>
                {{ $util->arrayValue($guest->groups, $guestConst::GROUPS) }}&nbsp;
                {{ $guest->groups_other }}
                <a href="{{ route('guest.edit', ['guest' => $guest->guest_hash]) }}" class="execute"></a>
            </td>
        </tr>
        @endforeach
        @if (count($guests) == 0)
        <tr>
            <td colspan="6" align="center">
                参加者は未登録です
            </td>
        </tr>
        @endif
    </table>
    <div class="bottom-button">
        <form action="{{ route('guest.download', ['event_hash' => $event->event_hash]) }}" method="GET">
            <span class="button-s execution-button">
                一覧をダウンロード
            </span>
            <input type="submit" class="execute" value="" style="display: none" />
        </form>
        <form action="{{ route('events.show', ['event' => $event->event_hash]) }}" method="POST">
            @csrf
            @method('delete')
            <span class="button-s execution-button delete-button">
                イベントを削除する
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