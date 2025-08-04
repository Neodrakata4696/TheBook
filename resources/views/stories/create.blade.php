<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ストーリー新規作成') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif
        <form name="inputus" method="post" action="{{ route('stories.create') }}" enctype="multipart/form-data">
            <table class="bar w-full bg-white my-3">
                <tr>
                    <th class="w-1/6">タイトル</th>
                    <td><input type="text" name="title" class="w-4/12" value="{{ old('title') }}"></td>
                </tr>
                <tr>
                    <th class="w-1/6">本文</th>
                    <td class="textboard">
                        <div class="dummy_textarea" aria-hidden="true"></div>
                        <textarea type="text" name="contents" class="retextarea w-full h-full" value="{{ old('contents') }}"></textarea>
                    </td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">作成</button>
            <button type="button" onclick="history.back()" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
    <script src="{{ asset('/js/resize.js') }}"></script>
</x-app-layout>