@extends('layouts.app')
@section('title', 'イベントリスト')
@section('head')
<script src="{{ asset('js/event_list.js') }}" defer></script>
@endsection('head')
@section('content')
@if (count($events) > 0)
<div>
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
        <a href="{{ route('events.show', ['event' => $event->event_hash]) }}">{{ $event['event_name'] }}</a>
      </td>
      <td>
        {{ optional($event->created_at)->format('Y年 n月 j日') }}
      </td>
      <td>
        {{ optional($event->hold_date)->format('Y年 n月 j日') }}
      </td>
      <td>
        {{ $event->guest_count }} 名
      </td>
      <td>
        <form action="{{ route('events.show', ['event' => $event->event_hash]) }}" method="POST">
          @csrf
          @method('delete')
          <input type="submit" value="削除">
        </form>
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
      <input type="text" name="new_event_name" value="{{ old('new_event_name') }}"/>
      @error ('new_event_name')
        {{ $message }}
      @enderror
      <input type="submit" value="作成する">
      {{ $msg }}
    </form>
  </div>
</div>


@endsection