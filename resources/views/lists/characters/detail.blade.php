<table class="bar">
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
    <a href="{{ route('charas.index') }}">一覧表に戻る</a>
    <a href="{{ route('charas.create') }}">新規作成</a>
    <a href="{{ route('charas.edit', ['chara' => $chara_id]) }}">このデータを編集</a>
    <a href="{{ route('charas.delete', ['chara' => $chara_id]) }}">このデータを削除</a>
</div>