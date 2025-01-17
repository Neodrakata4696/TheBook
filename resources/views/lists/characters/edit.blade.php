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
                    <th class="w-1/6">キャラクター名</th>
                    <td><input type="text" name="name" value="{{ old('name') ?? $chara_name }}" class="w-4/12"></td>
                </tr>
                <tr>
                    <th class="w-1/6">説明</th>
                    <td class="textboard">
                        <div class="dummy_textarea" aria-hidden="true">{{ old('explain') ?? $chara_explain }}</div>
                        <textarea type="text" name="explain" class="retextarea w-full h-full">{{ old('explain') ?? $chara_explain }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th class="w-1/6">もっと詳しく</th>
                    <td class="textboard">
                        <div class="dummy_textarea" aria-hidden="true">{{ old('descript') ?? $chara_descript }}</div>
                        <textarea type="text" name="descript" class="retextarea w-full h-full">{{ old('descript') ?? $chara_descript }}</textarea>
                    </td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">編集完了</button>
            <button type="button" onclick="history.back();" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
    </div>
    <script src="{{ asset('/js/resize.js') }}"></script>
</x-app-layout>