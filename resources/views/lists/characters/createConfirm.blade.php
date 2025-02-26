<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($chara['name']. ' の作成確認') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('charas.createConfirm') }}">
            <table class="bar my-3 bg-white w-full">
                <tr>
                    <th class="w-1/12 bg-yellow-300">キャラクター名</th>
                    <td class="border-l border-black">{{ $chara['name'] }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">画像</th>
                    <td class="border-l border-black">
                        @if($image_path !== null)
                        <img src="{{ asset($image_path) }}" class="m-4 w-full max-w-44 h-full max-h-44">
                        @endif
                    </td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">説明</th>
                    <td class="border-l border-black">{{ $chara['explain'] }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">もっと詳しく</th>
                    <td class="border-l border-black">{{ $chara['descript'] }}</td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">作成</button>
            <button type="button" onclick="history.back();" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
</x-app-layout>