<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hello World!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="http://localhost/TheBook/charaList/create" class="block mx-4 my-4 text-center bg-gray-200 px-3 py-2 shadow-sm sm:rounded-lg">簡単！キャラクター新規作成</a>
                @if($characters->count() !== 0)
                <h2 class="px-6">最新キャラクター</h2>
                @foreach($characters as $character)
                <div class="m-4 p-4 border border-black">
                    <h3 class="text-2xl border-b-2 border-black">{{$character->name}}</h3>
                    <p class="pt-1">{{$character->explain}}</p>
                    <a href="{{route('charas.detail', ['chara' => $character->id])}}" class="text-sky-800">more</a>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
