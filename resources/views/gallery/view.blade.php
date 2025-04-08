<section>
    <div id="galleryBox">
        <div class="my-4">
            <div class="flex flex-wrap -m-4 items-center">
                @foreach($images as $image)
                <div class="w-full max-w-44 h-full max-h-44 m-4">
                    <img src="{{ asset($image->path) }}" id="{{ $image->id }}" class="uploaded_image_selector bg-white w-full h-full" alt="{{ $image->name }}">
                </div>
                @endforeach
            </div>
            {{ $images->render('vendor.pagination.tailwind_pagination') }}
        </div>
        <script src="{{ asset('js/pagination.js') }}"></script>
        <script src="{{ asset('js/image_paste.js') }}"></script>
    </div>
</section>