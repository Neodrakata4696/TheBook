<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ギャラリー') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-4">
                    <form method="post" action="{{ route('img.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image">
                        <button>アップロード</button>
                    </form>
                </div>
            </div>
            <div class="my-4">
                <div class="flex">
                    @foreach($images as $image)
                    <img src="{{ asset($image->path) }}" class="mx-4 my-8 max-w-44 max-h-44">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>