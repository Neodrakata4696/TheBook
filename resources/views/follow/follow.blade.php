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
                        <button type="button" class="bg-red-400 text-white px-3" id="follow">unfollow</button>
                        @else
                        <button type="button" class="bg-sky-400 text-white px-3" id="follow">follow</button>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
        })

        $('#follow').on('click', function() {
            $.ajax({
                method: "POST",
                url: "route('users.follow', $followed->followed->id)",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
            })
            .done(function(res) {
                console.log(res);
                $('#follow').toggleClass('bg-sky-400 bg-red-400');
                if($('#follow').text() === 'follow'){
                    $('#follow').text('unfollow');
                }
                else{
                    $('#follow').text('follow');
                }
            })
            .fail(function() {
                alert("失敗しました。");
            });
        });
    </script>
</x-app-layout>