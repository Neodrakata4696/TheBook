<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($story->title) }}
            </h2>
            <!--
            @if(Auth::user())
                @if($story->user->id !== Auth::user()->id)
                <form>
                    @csrf
                    @if($marked)
                    <button type="button" href="{{ route('stories.bookmark', ['story' => $story->id]) }}" class="bookmark">★</button>
                    @else
                    <button type="button" href="{{ route('stories.bookmark', ['story' => $story->id]) }}" class="bookmark">☆</button>
                    @endif
                </form>
                @endif
            @endif
            -->
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="m-4">{{ session('message') }}</p>
        <div class="bg-white my-4 p-4 border border-black">
            <div class="flex text-2xl border-b-2 border-black justify-between">
                <h3>{{$story->title}}</h3>
                <a href="{{ route('users.index', ['user' => $story->user->id]) }}" class="text-sky-800">{{ $story->user->name }}</a>
            </div>
            {{ $story->contents }}
        </div>
        <div class="toolbox">
            <a href="{{ route('stories.index') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">一覧表に戻る</a>
            @auth
            <a href="{{ route('stories.create') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
            @if($story->user->id === Auth::user()->id)
            <a href="{{ route('stories.edit', ['story' => $story->id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを編集</a>
            <a href="{{ route('stories.delete', ['story' => $story->id]) }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">このデータを削除</a>
            @endif
            @endauth
        </div>
    </div>
    <script src="{{ asset('/js/bookmark.js') }}"></script>
</x-app-layout>