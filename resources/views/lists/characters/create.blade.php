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
        <form method="post" action="{{ route('charas.create') }}" enctype="multipart/form-data">
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
                        <input type="file" name="upload-image" accept="image/*">
                        <p class="text-center">または</p>
                        <input type="text" name="image" id="selectedImage" class="w-full max-w-[90%] px-0" value="" readonly>
                        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'image-uploader')" class="bg-blue-500 text-white px-2">選択</button>
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
                <input type="text" id="selectedImageFlag" class="px-0 w-full" value="" readonly>
                @include('gallery.view')
            </div>
        </x-modal-museum>
    </div>
    <script src="{{ asset('/js/resize.js') }}"></script>
    <script>
        var imagePath = document.getElementById('selectedImage');
        var imageFlag = document.getElementById('selectedImageFlag');
        $('.uploaded_img').on('click', function(event) {
            var selected = $(event.currentTarget).val();
            imagePath.value = selected;
            imageFlag.value = selected;
        });
    </script>
</x-app-layout>