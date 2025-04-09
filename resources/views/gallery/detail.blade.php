<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $image->name }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-4 flex">
            <div class="w-full max-h-full">
                <img src="{{ asset($image->path) }}" class="w-full relative bg-white">
            </div>
            <div class="px-4 sm:px-8 w-full">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h2 class="text-xl">投稿者:<a href="{{ route('users.index', ['user' => $image->user]) }}" class="text-sky-800">{{ $image->user->name }}</a></h2>
                    <h2 class="pt-4 text-xl">この画像を使用しているキャラクター</h2>
                    @foreach($charas as $chara)
                        <a href="{{ route('charas.detail', ['chara' => $chara->id]) }}" class="text-sky-800">
                            {{ $chara->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>