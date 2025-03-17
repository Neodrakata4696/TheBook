<section>
    <div id="galleryBox">
        <div class="my-4">
            <div class="flex flex-wrap -m-4 items-center">
                @foreach($images as $image)
                <button class="uploaded_imagen bg-white m-4 w-full max-w-44 h-full max-h-44" type="button" value="{{ $image->path }}" >
                    <img src="{{ asset($image->path) }}" class="w-full h-full">
                </button>
                @endforeach
            </div>
            {!! $images->render('vendor.pagination.tailwind_pagination') !!}
        </div>
        <script src="{{ asset('js/pagination.js') }}"></script>
        <script src="{{ asset('js/image_paste.js') }}"></script>
    </div>
</section>