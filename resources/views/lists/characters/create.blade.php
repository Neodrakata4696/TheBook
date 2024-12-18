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
                    <td class="w-10/12"><textarea type="text" name="explain" class="w-full"></textarea></td>
                </tr>
                <tr>
                    <th>もっと詳しく</th>
                    <td class="w-10/12"><textarea type="text" name="descript" class="w-full text-wrap"></textarea></td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">作成</button>
            <a href="{{ route('charas.index') }}" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</a>
        </form>
    </div>
</x-app-layout>