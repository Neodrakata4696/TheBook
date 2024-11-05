<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('キャラクター') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="get" action="{{ route('charas.index') }}" class="flex mt-4 my-4">
            @csrf
            <input type="text" name="keyword" class="w-11/12">
            <button type="submit" class="bg-blue-500 text-white px-3 py-2 mx-auto shadow-sm sm:rounded-lg">検索</button>
        </form>
        @auth
            <a href="{{ route('charas.create') }}" class="block my-4 text-center bg-gray-200 px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
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
                <td class="border-l border-black text-sky-800"><a href="{{ route('charas.detail', ['chara' => $character->id]) }}">{{ $character->name }}</a></td>
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