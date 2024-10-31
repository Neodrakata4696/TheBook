<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('作成キャラクター') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @auth
        <div class="toolbox my-3">
            <a href="{{ route('charas.create') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
        </div>
        @endauth
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th style="width:3%">ID</th>
                <th class="border-l border-black w-3/12">キャラクター名</th>
                <th class="border-l border-black">説明</th>
                <th class="border-l border-black" style="width:10%">コマンド</th>
            </tr>
            @foreach($characters as $character)
            <tr class="border-t border-black">
                <td class="text-right">{{ $character->id }}</td>
                <td class="border-l border-black">{{ $character->name }}</td>
                <td class="border-l border-black">{{ $character->explain }}</td>
                <td class="border-l border-black text-center w-2/12">
                    <a href="{{ route('charas.detail', ['chara' => $character->id]) }}">詳細</a>
                    @auth
                    @if($character->user_id === Auth::user()->id)
                    <a href="{{ route('charas.edit', ['chara' => $character->id]) }}">編集</a>
                    <a href="{{ route('charas.delete', ['chara' => $character->id]) }}">削除</a>
                    @endif
                    @endauth
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>