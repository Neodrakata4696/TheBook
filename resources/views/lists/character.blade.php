@extends('layout')
@section('content')
<main>
    <table>
        <div class="create_box">
            <a href="{{ route('charas.create') }}">作成</a>
        </div>
        <tr>
            <th class="ch_id">ID</th>
            <th class="ch_name">キャラクター名</th>
            <th class="ch_attribute">属性</th>
            <th class="ch_explain">説明</th>
            <th class="ch_command">コマンド</th>
        </tr>
        @foreach($characters as $character)
        <tr>
            <td class="ch_id">{{$character->id}}</td>
            <td class="ch_name">{{$character->name}}</td>
            <td class="ch_attribute"></td>
            <td class="ch_explain">{{$character->explain}}</td>
            <td class="ch_command">
                <a href="#">詳細</a>
                <a href="#">編集</a>
                <a href="#">削除</a>
            </td>
        </tr>
        @endforeach
    </table>
</main>
@endsection