<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($chara_name. ' 削除') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-red-500 text-xl my-3">削除したデータは元に戻りません。よろしいでしょうか。</h2>
        <form method="post" action="{{ route('charas.delete', ['chara' => $chara_id]) }}">
            <table class="bar w-full bg-white my-3">
                <tr>
                    <th>キャラクター名</th>
                    <td class="w-10-12"><input type="text" name="name" readonly value="{{ old('name') ?? $chara_name }}" class="w-4/12"></td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td class="w-10/12"><input type="text" name="explain" readonly value="{{ old('explain') ?? $chara_explain }}" class="w-9/12"></td>
                </tr>
                <tr>
                    <th>もっと詳しく</th>
                    <td class="w-10/12"><input type="text" name="descript" readonly value="{{ old('descript') ?? $chara_descript }}" class="w-full"></td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">削除</button>
            <a href="{{ route('charas.index') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">一覧表に戻る</a>
        </form>
    </div>
</x-app-layout>