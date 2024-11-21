<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($user_name .' List') }}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('users.followIndex', ['user' => $user_id])" :active="request()->routeIs('users.followIndex')">フォロー</x-nav-link>
                <x-nav-link :href="route('users.followerIndex', ['user' => $user_id])" :active="request()->routeIs('users.followerIndex')">フォロワー</x-nav-link>
                @if($user_id !== Auth::user()->id)
                <form>
                    @csrf
                    @if($follow_check === 0)
                    <button type="button" class="bg-sky-400 text-white px-3" id="follow">follow</button>
                    @else
                    <button type="button" class="bg-red-400 text-white px-3" id="unfollow">unfollow</button>
                    @endif
                </form>
                @endif
            </div>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @auth
        @if($user_id === Auth::user()->id)
        <div class="toolbox my-3">
            <a href="{{ route('charas.create') }}" class="block my-4 text-center bg-gray-200 px-3 py-2 shadow-sm sm:rounded-lg">新規作成</a>
        </div>
        @endif
        @endauth
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th class="w-2/12">キャラクター名</th>
                <th class="border-l border-black">説明</th>
                @auth
                <th class="border-l border-black w-2/12">コマンド</th>
                @endauth
            </tr>
            @foreach($characters as $character)
            <tr class="border-t border-black">
                <td class="text-sky-800"><a href="{{ route('charas.detail', ['chara' => $character->id]) }}">{{ $character->name }}</a></td>
                <td class="border-l border-black">{{ $character->explain }}</td>
                <td class="border-l border-black text-center">
                    <a href="{{ route('charas.detail', ['chara' => $character->id]) }}">詳細</a>
                    @auth
                    @if($character->user_id === Auth::user()->id)
                    <a href="{{ route('charas.edit', ['chara' => $character->id]) }}">編集</a>
                    <a href="{{ route('charas.delete', ['chara' => $character->id]) }}">削除</a>
                    @endif
                    @endauth
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
        })
        
        $('#follow').on('click', function() {
            $.ajax({
                method: "POST",
                url: "{{ route('users.follow', ['user' => $user_id]) }}",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
            })
            .done(function(res) {
                console.log(res.follow_check);
            })
            .fail(function() {
                alert("失敗しました。");
            });
        });
        $('#unfollow').on('click', function() {
            $.ajax({
                method: "POST",
                url: "{{ route('users.unfollow', ['user' => $user_id]) }}",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
            })
            .done(function(res) {
                console.log(res);
            })
            .fail(function() {
                alert("失敗しました。");
            });
        });
    </script>
</x-app-layout>