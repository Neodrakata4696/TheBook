<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ストーリー') }}
            </h2>
            <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @auth
                    <a href="{{ route('stories.create') }}" class="block text-center bg-gray-200 px-3 shadow-sm sm:rounded-lg">新規作成</a>
                @endauth
            </div>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($stories->count() !== 0)
        <!--<form method="get" action="{{ route('charas.index') }}" class="flex mt-4 my-4">
            @csrf
            <input type="text" name="keyword" class="w-11/12">
            <button type="submit" class="bg-blue-500 text-white px-3 py-2 mx-auto shadow-sm sm:rounded-lg">検索</button>
        </form>-->
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th>タイトル</th>
                <th class="border-l border-black w-3/12">作成者</th>
            </tr>
            @foreach($stories as $story)
            <tr class="border-t border-black">
                <td class="text-sky-800"><a href="{{ route('stories.story', ['story' => $story->id]) }}">{{ $story->title }}</a></td>
                <td class="border-l border-black"><a href="{{ route('users.index', ['user' => $story->user->id]) }}" class="text-sky-800">{{ $story->user->name }}</a></td>
            </tr>
            @endforeach
        </table>
        {{ $stories->appends(Request::only('keyword'))->render() }}
        @else
        <div class="pt-8">
            <div class="text-center">ストーリーは何もありません</div>
            @auth
            <div class="text-center">まずは右上からストーリーを作成しましょう</div>
            @endauth
        </div>
        @endif
    </div>
</x-app-layout>