<form method="post" action="{{ route('charas.edit', ['chara' => $chara_id]) }}">
    <table class="bar">
        <tr>
            <th>キャラクター名</th>
            <td><input type="text" name="name" value="{{ old('name') ?? $chara_name }}"></td>
        </tr>
        <tr>
            <th>説明</th>
            <td><input type="text" name="explain" value="{{ old('explain') ?? $chara_explain }}"></td>
        </tr>
        <tr>
            <th>もっと詳しく</th>
            <td><input type="text" name="descript" value="{{ old('descript') ?? $chara_descript }}"></td>
        </tr>
    </table>
    @csrf
    <button type="submit">編集完了</button>
</form>