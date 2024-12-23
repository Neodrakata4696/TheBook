<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($chara_name. ' 編集') }}
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
        <form method="post" action="{{ route('charas.edit', ['chara' => $chara_id]) }}">
            <table class="bar w-full bg-white my-3">
                <tr>
                    <th>キャラクター名</th>
                    <td class="w-10/12"><input type="text" name="name" value="{{ old('name') ?? $chara_name }}" class="w-4/12"></td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td class="w-10/12"><textarea type="text" name="explain" class="w-full">{{ old('explain') ?? $chara_explain }}</textarea></td>
                </tr>
                <tr>
                    <th>もっと詳しく</th>
                    <td class="w-10/12"><textarea type="text" name="descript" class="w-full">{{ old('descript') ?? $chara_descript }}</textarea></td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">編集完了</button>
            <button type="button" onclick="history.back();" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
</x-app-layout>