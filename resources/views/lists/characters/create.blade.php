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
        <form name="inputus" method="post" action="{{ route('charas.create') }}" enctype="multipart/form-data">
            <table class="bar w-full bg-white my-3">
                <tr>
                    <th class="w-1/6">キャラクター名</th>
                    <td><input type="text" name="name" class="w-4/12"></td>
                </tr>
                <tr>
                    <th class="w-1/6">説明</th>
                    <td class="textboard">
                        <div class="dummy_textarea" aria-hidden="true"></div>
                        <textarea type="text" name="explain" class="retextarea w-full h-full"></textarea>
                    </td>
                </tr>
                <tr>
                    <th class="w-1/6">もっと詳しく</th>
                    <td class="textboard">
                        <div class="dummy_textarea" aria-hidden="true"></div>
                        <textarea type="text" name="descript" class="retextarea w-full h-full"></textarea>
                    </td>
                </tr>
                <tr>
                    <th class="w-1/6">画像</th>
                    <td>
                        <input type="radio" name="i-radio" value="upload">
                        <input type="file" name="uploaded_image" id="uploaded_image" accept="image/*">
                        <p class="text-center">または</p>
                        <input type="radio" name="i-radio" value="select">
                        <input type="text" name="selected_image" id="selected_image" class="w-full max-w-[90%] px-0" value="" readonly>
                        <button type="button" id="selecter_open" x-data="" x-on:click.prevent="$dispatch('open-modal', 'image-uploader')" class="bg-blue-500 disabled:bg-gray-400 text-white px-2">選択</button>
                    </td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">作成</button>
            <button type="button" onclick="history.back()" class="bg-white px-3 py-2 shadow-sm sm:rounded-lg">戻る</button>
        </form>
        <x-modal-museum name="image-uploader">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <h2 class="text-lg font-medium text-gray-900 my-4">画像を選択してください。</h2>
                    <button type="button" x-on:click="$dispatch('close')">閉じる</button>
                </div>
                <input type="text" id="selected_image_flag" class="border-none w-full" value="" readonly>
                @include('gallery.view')
            </div>
        </x-modal-museum>
    </div>
    <script src="{{ asset('/js/resize.js') }}"></script>
    <script src="{{ asset('/js/image_paste.js') }}"></script>
</x-app-layout>