<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($chara->name. 'を削除') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-red-500 text-xl my-3">削除したデータは元に戻りません。よろしいでしょうか。</h2>
        <form method="post" action="{{ route('charas.delete', ['chara' => $chara->id]) }}">
            <table class="bar my-3 bg-white w-full">
                <tr>
                    <th class="w-1/12 bg-yellow-300">キャラクター名</th>
                    <td class="border-l border-black">{{ $chara->name }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">画像</th>
                    <td class="border-l border-black">
                        @if($chara->image !== null)
                        <img src="{{ asset($chara->image->path)}}" class="m-2 w-full max-w-44 h-full max-h-44">
                        @endif
                    </td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">説明</th>
                    <td class="border-l border-black">{{ $chara->explain }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">もっと詳しく</th>
                    <td class="border-l border-black">{{ $chara->descript }}</td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">削除</button>
            <button type="button" onclick="history.back();" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
</x-app-layout>