<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('followerList') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th>ユーザー名</th>
                <th class="border-l border-black w-2/12">ボタン</th>
            </tr>
            @foreach($followings as $following)
            <tr class="border-t border-black">
                <td><a href="{{ route('charas.prindex', ['user' => $following->following->id]) }}" class="text-sky-800">{{ $following->following->name }}</a></td>
                <td class="border-l border-black text-center">
                    @if($following->following->id !== Auth::user()->id)
                        @if($following->where('following_user_id', Auth::user()->id)->where('followed_user_id', $following->following->id)->count() === 0)
                        <form method="post" action="{{ route('users.follow', ['user' => $following->following->id]) }}">
                            @csrf
                            <input type="submit" class="bg-sky-400 text-white px-3" value="follow">
                        </form>
                        @else
                        <form method="post" action="{{ route('users.unfollow', ['user' => $following->following->id]) }}">
                            @csrf
                            <input type="submit" class="bg-red-400 text-white px-3" value="unfollow">
                        </form>
                        @endif
                    @else
                        このアカウントです
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>