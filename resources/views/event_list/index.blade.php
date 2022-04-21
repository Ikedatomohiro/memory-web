@extends('layouts.app')
@section('title', 'イベントリスト')
@section('head')
<script src="{{ asset('js/event_list.js') }}" defer></script>
@endsection('head')
@section('content')

<div>
  <table>
    <tr>
      <th>イベント名</th>
      <th>登録日</th>
      <th>開催日</th>
      <th>参加人数</th>
    </tr>
    @foreach ($events as $event)
    <tr>
      <td>{{ $event['event_name'] }}</td>
      <td>今日</td>
      <td>明日</td>
      <td></td>
    </tr>
    @endforeach
  </table>
</div>
<div class="footer">
  <div class="footer-center">
    <form action="{{ url('events')}}" method="POST">
      @csrf
      <input type="text" name="new_event_name" value="{{ old('new_event_name') }}"/>
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