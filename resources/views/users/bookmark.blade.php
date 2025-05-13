<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                {{$user->name}}のブックマーク
            </h2>
            <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
            </div>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white -mx-4 mt-4 p-4">
            @foreach($bookmarks as $bookmark)
            <div class="flex">
                <button type="button" href="{{ route('charas.bookmark', ['chara' => $bookmark->character->id]) }}" class="bookmark">★</button>
                <a href="{{ route('charas.detail', ['chara' => $bookmark->character->id]) }}" class="text-sky-800">{{ $bookmark->character->name }}</a>
            </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
</x-app-layout>