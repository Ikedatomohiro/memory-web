@extends('layouts.app')
@section('title', '来客リスト')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.js"></script>
<script src="{{ asset('js/guest-book.js') }}" defer></script>
<link rel="stylesheet" href="/css/guest-book.css">
@endsection('head')

@section('content')

<div class="container">
    <table>
        <tr>
            <th>イベント名</th>
            <th>登録日</th>
            <th>開催日</th>
            <th>参加人数</th>
            <th>操作</th>
        </tr>
        @foreach ($events as $event)
        <tr>
            <td>
                <a href="">{{ $event['event_name'] }}</a>
            </td>
            <td>今日</td>
            <td>明日</td>
            <td>
                <form action="{{ url('events/'. $event->event_hash)}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="footer">
    <div class="footer-center">
        <form action="{{ url('events')}}" method="POST">
            @csrf
            <input type="text" name="new_event_name" value="{{ old('new_event_name') }}" />
            <p class="button-round create-new">
                新規作成
            </p>
            @error ('new_event_name')
            {{ $message }}
            @enderror
            <input type="submit" value="作成する">
            {{ $msg }}
        </form>
    </div>
</div>


@endsection