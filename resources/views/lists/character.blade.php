@extends('layout')
@section('content')
<main>
    <table class="database">
        <div class="create_box">
            <a href="{{ route('charas.create') }}">作成</a>
        </div>
        <tr>
            <th class="table_id">ID</th>
            <th class="table_name">キャラクター名</th>
            <th class="table_explain">説明</th>
            <th class="table_command">コマンド</th>
        </tr>
        @foreach($characters as $character)
        <tr>
            <td class="table_id">{{$character->id}}</td>
            <td class="table_name">{{$character->name}}</td>
            <td class="table_explain">{{$character->explain}}</td>
            <td class="table_command">
                <a href="{{ route('charas.detail', ['chara' => $character->id]) }}">詳細</a>
                <a href="{{ route('charas.edit', ['chara_id' => $character->id]) }}">編集</a>
                <a href="{{ route('charas.delete', ['chara_id' => $character->id]) }}">削除</a>
            </td>
        </tr>
        @endforeach
    </table>
</main>
@endsection