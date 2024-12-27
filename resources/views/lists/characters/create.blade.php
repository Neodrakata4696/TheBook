<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('キャラクター新規作成') }}
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
        <form method="post" action="{{ route('charas.create') }}">
            <table class="bar w-full bg-white my-3">
                <tr>
                    <th>キャラクター名</th>
                    <td class="w-10/12"><input type="text" name="name" class="w-4/12"></td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td class="textboard w-10/12">
                        <div class="dummy_textarea" aria-hidden="true"></div>
                        <textarea type="text" name="explain" class="retextarea w-full h-full"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>もっと詳しく</th>
                    <td class="textboard w-10/12">
                        <div class="dummy_textarea" aria-hidden="true"></div>
                        <textarea type="text" name="descript" class="retextarea w-full h-full"></textarea>
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