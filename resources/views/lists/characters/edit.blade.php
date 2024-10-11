@extends('layout')
@section('content')
<main>
    <form method="post" action="{{ route('charas.edit', ['chara_id' => $chara_id]) }}">
        <label for="name">キャラクター名</label>
        <input type="text" name="name" value="{{ old('name') ?? $chara_name }}">
        <label for="explain">説明文</label>
        <input type="text" name="explain" value="{{ old('explain') ?? $chara_explain }}">
        @csrf
        <button type="submit">発射ァ</button>
    </form>
</main>
@endsection