@extends('layouts.app')
@section('content')

イベントリスト
<div>
    <table>
        <tr>
            <th>イベント名</th>
            <th>登録日</th>
            <th>開催日</th>
            <th>参加人数</th>
        </tr>
        <tr>
            <td>テストイベント</td>
            <td>今日</td>
            <td>明日</td>
            <td>10 名</td>
        </tr>
    </table>
</div>





<div class="footer">
    <div class="footer-center">
        <a href="{{ url('event/create')}}">
            <p class="button-round create-new">
                新規作成
            </p>
        </a>
    </div>
</div>


@endsection
