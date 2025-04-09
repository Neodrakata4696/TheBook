<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ギャラリー') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-12">
            @include('gallery.upload')
            <div id="gallery">
                <div class="my-4">
                    <div class="flex flex-wrap -m-4 items-center">
                        @foreach($images as $image)
                        <button class="uploaded_imagen bg-white m-4 w-full max-w-44 h-full max-h-44" type="button" value="{{ $image->path }}" onclick="location.href='{{ route('images.detail', ['image' => $image->id]) }}'">
                            <img src="{{ asset($image->path) }}" class="w-full h-full">
                        </button>
                        @endforeach
                    </div>
                    {{ $images->render('vendor.pagination.tailwind_pagination') }}
                </div>
                <script src="{{ asset('js/pagination.js') }}"></script>
            </div>
        </div>
    </div>
</x-app-layout>