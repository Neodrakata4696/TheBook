<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                {{$user->name}}の画像投稿
            </h2>
            <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('users.followIndex', ['user' => $user->id])" :active="request()->routeIs('users.followIndex')">フォロー</x-nav-link>
                <x-nav-link :href="route('users.followerIndex', ['user' => $user->id])" :active="request()->routeIs('users.followerIndex')">フォロワー</x-nav-link>
                @auth
                @if($user->id !== Auth::user()->id)
                <form>
                    @csrf
                    @if($user->isFollowedBy(Auth::user()))
                    <button type="button" class="follow bg-red-400 text-white px-3" value="{{ route('users.follow', $user->id) }}">unfollow</button>
                    @else
                    <button type="button" class="follow bg-sky-400 text-white px-3" value="{{ route('users.follow', $user->id) }}">follow</button>
                    @endif
                </form>
                @endif
                @endauth
            </div>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($images->count() !== 0)
        <div class="-m-4 my-4 flex flex-wrap">
            @foreach($images as $image)
            <img src="{{ asset($image->path) }}" class="bg-white m-4 w-full max-w-44 h-full max-h-44" onclick="location.href='{{ route('images.detail', ['image' => $image->id]) }}'">
            @endforeach
        </div>
        @else
        <div class="pt-8">
            <div class="text-center">このユーザーが投稿した画像はありません</div>
        </div>
        @endif
    </div>
    <script src="{{ asset('/js/followSystem.js') }}"></script>
</x-app-layout>