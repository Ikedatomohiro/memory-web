@extends('layouts.app')
@section('title', 'イベント')
@section('head')
<script src="{{ asset('js/event_list.js') }}" defer></script>
@endsection('head')
@section('content')

<div>
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
</div>
<a href="{{ route('guest.create', ['event_hash' => $event->event_hash]) }}">参加者登録</a>
<a href="/">ホーム</a>
<a href="{{ route('guest.download', ['event_hash' => $event->event_hash]) }}">ダウンロード</a>

<div class="footer">
  <div class="footer-center">
  </div>
</div>
@endsection