<section>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="m-4">
            <form method="post" action="{{ route('img.upload') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="upload-image" accept="image/*">
                <button>アップロード</button>
            </form>
        </div>
    </div>
</section>