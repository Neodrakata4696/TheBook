<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('followList') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="list bg-white w-full my-3">
            <tr class="border-b-2 border-black bg-yellow-300">
                <th>ユーザー名</th>
                <th class="border-l border-black w-2/12">ボタン</th>
            </tr>
            @foreach($followeds as $followed)
            <tr class="border-t border-black">
                <td><a href="{{ route('users.index', ['user' => $followed->followed->id]) }}" class="text-sky-800">{{ $followed->followed->name }}</a></td>
                <td class="border-l border-black text-center">
                    @if($followed->followed->id !== Auth::user()->id)
                        @csrf
                        @if($followed->followed->isFollowedBy(Auth::user()))
                        <button type="button" class="bg-red-400 text-white px-3" id="follow" value="{{ route('users.follow', $followed->followed->id) }}">unfollow</button>
                        @else
                        <button type="button" class="bg-sky-400 text-white px-3" id="follow" value="{{ route('users.follow', $followed->followed->id) }}">follow</button>
                        @endif
                    @endif
                </td>
            </tr>
            <script>
                var user = document.getElementById("follow").value;
                @include('scripts.followSystem')
            </script>
            @endforeach
        </table>
    </div>
</x-app-layout>