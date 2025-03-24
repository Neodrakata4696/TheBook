<section>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="m-4">
            @auth
            <form method="post" action="{{ route('img.upload') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="uploaded_image" accept="image/png, image/jpeg" required>
                <button class="bg-gray-200 px-4 float-right">アップロード</button>
            </form>
            @endauth
            @guest
            <p>画像をアップロードしたい方は、<a href="{{ route('login') }}" class="text-sky-800">ログイン</a>か、<a href="{{ route('register') }}" class="text-sky-800">ユーザー登録</a>をお願いします</p>
            @endguest
        </div>
    </div>
</section>