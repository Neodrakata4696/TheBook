<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($chara_name. ' 詳細情報') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="m-4">{{ session('message') }}</p>
        <div class="bg-white my-4 p-4 border border-black">
            <div class="flex text-2xl border-b-2 border-black justify-between">
                <h3>{{$chara_name}}</h3>
                <a href="{{ route('users.index', ['user' => $chara->user->id]) }}" class="text-sky-800">{{ $chara_user }}</a>
            </div>
            <div class="flex my-4">
                @if($chara_image !== null)
                <img src="{{ asset($chara_image) }}" class="mx-4 ml-0 mb-0 w-full max-w-44 h-full max-h-44">
                @endif
                <p>{{$chara_explain}}</p>
            </div>
            <p>{{$chara_descript}}</p>
        </div>
        <div class="toolbox mx-4">
            <a href="{{ route('charas.index') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">一覧表に戻る</a>
            @auth
            <a href="{{ route('charas.create') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
            @if($chara->user_id === Auth::user()->id)
            <a href="{{ route('charas.edit', ['chara' => $chara_id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを編集</a>
            <a href="{{ route('charas.delete', ['chara' => $chara_id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを削除</a>
            @endif
            @endauth
        </div>
    </div>
</x-app-layout>