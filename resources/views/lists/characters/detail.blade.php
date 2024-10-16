@extends('layout')
@section('content')
<main>
    <table class="detail">
        <tr>
            <th>ID</th>
            <td>{{ $chara_id }}</td>
        </tr>
        <tr>
            <th>キャラクター名</th>
            <td>{{ $chara_name }}</td>
        </tr>
        <tr>
            <th>説明</th>
            <td>{{ $chara_explain }}</td>
        </tr>
        <tr>
            <th>もっと詳しく</th>
            <td>{{ $chara_descript }}</td>
        </tr>
    </table>
    <div class="toolbox">
        <a href="{{ route('charas.index') }}">一覧に戻る</a>
        <a href="{{ route('charas.edit', ['chara' => $chara_id]) }}">編集</a>
        <a href="{{ route('charas.delete', ['chara' => $chara_id]) }}">削除</a>
    </div>
</main>
@endsection