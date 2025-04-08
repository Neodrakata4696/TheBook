<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hello World!') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto">
        <a href="{{route('charas.create')}}" class="block mx-4 my-4 text-center bg-blue-400 px-3 py-2 shadow-sm sm:rounded-lg">簡単！キャラクター新規作成</a>
        @if($characters->count() !== 0)
        <h2 class="px-6">最新キャラクター</h2>
        @foreach($characters as $character)
        <div class="m-4 p-4 border border-black bg-white">
            <div class="flex text-2xl border-b-2 border-black justify-between">
                <h3>{{$character->name}}</h3>
                <a href="{{ route('users.index', ['user' => $character->user->id]) }}" class="text-sky-800">{{ $character->user->name }}</a>
            </div>
                <div class="flex my-4">
                @if($character->image !== null)
                <img src="{{ asset($character->image->path) }}" class="mx-4 ml-0 mb-0 w-full max-w-44 h-full max-h-44">
                @endif
                <p>{{$character->explain}}</p>
            </div>
            <a href="{{route('charas.detail', ['chara' => $character->id])}}" class="block text-sky-800 mx-4 text-right">more</a>
        </div>
        @endforeach
        <a href="{{route('charas.index')}}" class="block mx-4 my-4 text-center bg-yellow-200 px-3 py-2 shadow-sm sm:rounded-lg">キャラクターリストへ</a>
        @endif
    </div>
</x-app-layout>
