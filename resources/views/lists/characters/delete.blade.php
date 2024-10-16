@extends('layout')
@section('content')
<main>
    <p class="warning">このキャラクターを削除します。よろしいですか</p>
    <form method="post" action="{{ route('charas.delete', ['chara' => $chara_id]) }}">
        <label for="name">キャラクター名</label>
        <input type="text" name="name" readonly value="{{ old('name') ?? $chara_name }}">
        <label for="explain">説明文</label>
        <input type="text" name="explain" readonly value="{{ old('explain') ?? $chara_explain }}">
        @csrf
        <button type="submit">削除</button>
    </form>
</main>
@endsection