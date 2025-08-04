<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($story['title']. ' の編集確認') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{ route('stories.editConfirm', [$story_id]) }}">
            <table class="bar my-3 bg-white w-full">
                <tr>
                    <th class="w-1/12 bg-yellow-300">キャラクター名</th>
                    <td class="border-l border-black">{{ $story['title'] }}</td>
                </tr>
                <tr class="border-t border-black">
                    <th class="w-1/12 bg-yellow-300">本文</th>
                    <td class="border-l border-black">{{ $story['contents'] }}</td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">更新</button>
            <button type="button" onclick="history.back();" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
</x-app-layout>