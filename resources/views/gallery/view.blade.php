<section>
    <div id="galleryBox">
        <div class="my-4">
            <div class="flex flex-wrap -m-4">
                @foreach($images as $image)
                <button class="uploaded_imagen" type="button" value="{{ $image->path }}">
                    <img src="{{ asset($image->path) }}" class="m-4 w-full min-w-44 max-w-44 h-full min-h-44 max-h-44">
                </button>
                @endforeach
            </div>
            {!! $images->render() !!}
        </div>
        <script src="{{ asset('js/pagination.js') }}"></script>
        <script src="{{ asset('js/image_paste.js') }}"></script>
    </div>
</section>