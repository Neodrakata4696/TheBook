<div class="toolbox">
    <a href="{{ route('charas.create') }}">新規作成</a>
</div>
<table class="list">
    <tr>
        <th>ID</th>
        <th>キャラクター名</th>
        <th>説明</th>
        <th>コマンド</th>
    </tr>
    @foreach($characters as $character)
    <tr>
        <td>{{ $character->id }}</td>
        <td>{{ $character->name }}</td>
        <td>{{ $character->explain }}</td>
        <td>
            <a href="{{ route('charas.detail', ['chara' => $character->id]) }}">詳細</a>
            <a href="{{ route('charas.edit', ['chara' => $character->id]) }}">編集</a>
            <a href="{{ route('charas.delete', ['chara' => $character->id]) }}">削除</a>
        </td>
    </tr>
    @endforeach
</table>