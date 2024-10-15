@extends('layout')
@section('content')
<main>
    <form method="post" action="{{ route('charas.create') }}">
        <label for="name">キャラクター名</label>
        <input type="text" name="name">
        <label for="explain">説明文</label>
        <input type="text" name="explain">
        @csrf
        <button type="submit">作成</button>
    </form>
</main>
@endsection