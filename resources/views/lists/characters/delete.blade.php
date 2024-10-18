<h2 style="color: #F81212">削除したデータは元に戻りません。よろしいでしょうか。</h2>
<form method="post" action="{{ route('charas.delete', ['chara' => $chara_id]) }}">
    <table class="bar">
        <tr>
            <th>キャラクター名</th>
            <td><input type="text" name="name" readonly value="{{ old('name') ?? $chara_name }}"></td>
        </tr>
        <tr>
            <th>説明</th>
            <td><input type="text" name="explain" readonly value="{{ old('explain') ?? $chara_explain }}"></td>
        </tr>
        <tr>
            <th>もっと詳しく</th>
            <td><input type="text" name="descript" readonly value="{{ old('descript') ?? $chara_descript }}"></td>
        </tr>
    </table>
    @csrf
    <button type="submit">削除</button>
</form>