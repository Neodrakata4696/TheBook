<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($story['title']. ' の作成確認') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('stories.createConfirm') }}">
            <table class="bar my-3 bg-white w-full">
                <tr>
                    <th class="w-1/12 bg-yellow-300">タイトル</th>
                    <td class="border-l border-black">{{ $story['title'] }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">本文</th>
                    <td class="border-l border-black">{{ $story['contents'] }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">登場キャラクター</th>
                    <td class="border-l border-black">
                        @foreach ($characters as $character)
                        {{ $character }}
                        @endforeach
                    </td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">作成</button>
            <button type="button" onclick="history.back();" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
</x-app-layout>