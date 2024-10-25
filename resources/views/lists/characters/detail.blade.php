<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($chara_name. ' 詳細情報') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="bar my-3 bg-white w-full">
            <tr>
                <th class="w-1/12 bg-yellow-300">キャラクター名</th>
                <td class="border-l border-black">{{ $chara_name }}</td>
            </tr>
            <tr class="border-t border-black">
                <th class="w-1/12 bg-yellow-300">作成ユーザー</th>
                <td class="border-l border-black">{{ $chara_user }}</td>
            </tr>
            <tr class="border-t border-black">
                <th class="w-1/12 bg-yellow-300">説明</th>
                <td class="border-l border-black">{{ $chara_explain }}</td>
            </tr>
            <tr class="border-t border-black">
                <th class="w-1/12 bg-yellow-300">もっと詳しく</th>
                <td class="border-l border-black">{{ $chara_descript }}</td>
            </tr>
        </table>
        <div class="toolbox">
            <a href="{{ route('charas.index') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">一覧表に戻る</a>
            <a href="{{ route('charas.create') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
            @if($chara->user_id === Auth::user()->id)
            <a href="{{ route('charas.edit', ['chara' => $chara_id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを編集</a>
            <a href="{{ route('charas.delete', ['chara' => $chara_id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを削除</a>
            @endif
        </div>
    </div>
</x-app-layout>