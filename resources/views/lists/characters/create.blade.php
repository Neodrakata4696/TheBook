<form method="post" action="{{ route('charas.create') }}">
    <table class="bar">
        <tr>
            <th>キャラクター名</th>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <th>説明</th>
            <td><input type="text" name="explain"></td>
        </tr>
        <tr>
            <th>もっと詳しく</th>
            <td><input type="text" name="descript"></td>
        </tr>
    </table>
    @csrf
    <button type="submit">作成</button>
</form>