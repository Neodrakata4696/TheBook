<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($chara->name. ' 詳細情報') }}
            </h2>
            @if($chara->user->id !== Auth::user()->id)
            <form>
                @csrf
                @if($marked)
                <button type="button" href="{{ route('charas.bookmark', ['chara' => $chara->id]) }}" class="bookmark">★</button>
                @else
                <button type="button" href="{{ route('charas.bookmark', ['chara' => $chara->id]) }}" class="bookmark">☆</button>
                @endif
            </form>
            @endif
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="m-4">{{ session('message') }}</p>
        <div class="bg-white my-4 p-4 border border-black">
            <div class="flex text-2xl border-b-2 border-black justify-between">
                <h3>{{$chara->name}}</h3>
                <a href="{{ route('users.index', ['user' => $chara->user->id]) }}" class="text-sky-800">{{ $chara->user->name }}</a>
            </div>
            <div class="flex my-4">
                @if($chara->image !== null)
                <a href="{{ route('images.detail', ['image' => $chara->image->id]) }}" class="mx-4 ml-0 mb-0 w-full max-w-44 h-full max-h-44">
                    <img src="{{ asset($chara->image->path) }}" class="w-full h-full">
                </a>
                @endif
                <p>{{$chara->explain}}</p>
            </div>
            <p>{{$chara->descript}}</p>
        </div>
        <div class="toolbox">
            <a href="{{ route('charas.index') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">一覧表に戻る</a>
            @auth
            <a href="{{ route('charas.create') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
            @if($chara->user->id === Auth::user()->id)
            <a href="{{ route('charas.edit', ['chara' => $chara->id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを編集</a>
            <a href="{{ route('charas.delete', ['chara' => $chara->id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを削除</a>
            @endif
            @endauth
        </div>
    </div>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
</x-app-layout>