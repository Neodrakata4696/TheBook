<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                {{$user->name}}{{ __(' List') }}
            </h2>
            <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @auth
                    @if($user->id === Auth::user()->id)
                        <a href="{{ route('charas.create') }}" class="block text-center bg-gray-200 px-3 shadow-sm sm:rounded-lg">新規作成</a>
                    @endif
                @endauth
                <x-nav-link :href="route('users.followIndex', ['user' => $user->id])" :active="request()->routeIs('users.followIndex')">フォロー</x-nav-link>
                <x-nav-link :href="route('users.followerIndex', ['user' => $user->id])" :active="request()->routeIs('users.followerIndex')">フォロワー</x-nav-link>
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
            </div>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($characters->count() !== 0)
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th class="w-2/12">キャラクター名</th>
                <th class="border-l border-black">説明</th>
                @auth
                <th class="border-l border-black w-2/12">コマンド</th>
                @endauth
            </tr>
            @foreach($characters as $chara)
            <tr class="border-t border-black">
                <td class="text-sky-800"><a href="{{ route('charas.detail', ['chara' => $chara->id]) }}">{{ $chara->name }}</a></td>
                <td class="border-l border-black">{{ Str::limit($chara->explain, 95) }}</td>
                <td class="border-l border-black text-center">
                    <a href="{{ route('charas.detail', ['chara' => $chara->id]) }}">詳細</a>
                    @auth
                    @if($chara->user->id === Auth::user()->id)
                    <a href="{{ route('charas.edit', ['chara' => $chara->id]) }}">編集</a>
                    <a href="{{ route('charas.delete', ['chara' => $chara->id]) }}">削除</a>
                    @endif
                    @endauth
                </td>
            </tr>
            @endforeach
        </table>
        {!! $characters->render() !!}
        @else
        <div class="pt-8">
            <div class="text-center">このユーザーが作成したキャラクターは誰もいません</div>
        </div>
        @endif
    </div>
    @include('scripts.followSystem')
</x-app-layout>