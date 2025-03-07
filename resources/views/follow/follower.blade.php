<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$user_name}}{{ __(' followerList') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($followings->count() !== 0)
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th>ユーザー名</th>
                <th class="border-l border-black w-2/12">ボタン</th>
            </tr>
            @foreach($followings as $following)
            <tr class="border-t border-black">
                <td><a href="{{ route('users.index', ['user' => $following->following->id]) }}" class="text-sky-800">{{ $following->following->name }}</a></td>
                <td class="border-l border-black text-center">
                    @if($following->following->id !== Auth::user()->id)
                        @csrf
                        @if($following->following->isFollowedBy(Auth::user()))
                        <button type="button" class="follow bg-red-400 text-white px-3" value="{{ route('users.follow', $following->following->id) }}">unfollow</button>
                        @else
                        <button type="button" class="follow bg-sky-400 text-white px-3" value="{{ route('users.follow', $following->following->id) }}">follow</button>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {!! $followings->render() !!}
        @else
        <div class="pt-8">
            <div class="text-center">このユーザーをフォローしたユーザーはいません</div>
        </div>
        @endif
    </div>
    <script src="{{ asset('/js/followSystem.js') }}"></script>
</x-app-layout>