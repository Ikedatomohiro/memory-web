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
      <th>開催日</th>

      <th>操作</th>
    </tr>
    @foreach ($guests as $guest)
    <tr>
      <td>
        <a href="{{ url('guest/'. $guest->guest_hash)}}">{{ $guest->guest_name }}</a>
      </td>
      <td>今日</td>
      <td>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="footer">
  <div class="footer-center">
  </div>
</div>
@endsection